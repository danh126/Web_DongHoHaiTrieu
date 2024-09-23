<?php

namespace controllers;

use models\Attribute;
use models\Brand;
use models\Category;
use models\Comments;
use models\Favorites;
use models\Image;
use models\Slide;
use models\Watch;

class HomeController extends Controller
{
    function index()
    {
        $slides = new Slide();
        $slide = $slides->getSlides();

        $brand = new Brand();
        $brr = $brand->getBrands();

        $srr = [];

        foreach ($slide as $s) {
            $type = $s['SlideType'];
            if (!isset($srr[$type])) {
                $srr[$type] = [];
            }
            $srr[$type][] = $s;
        }

        $page = 1;
        $size = 4;

        $watch = new Watch();
        $arr = $watch->getWatches();

        $wrr = [];
        $count = [];
        $pages = [];

        foreach ($arr as $v) {
            $k = $v['CategoryId'];
            $wrr[$k] = $watch->getWatchesByCategoryId($k, $page, $size);
            $count[$k] = $watch->countWatchesByCategoryId($k);
            $pages[$k] = ceil($count[$k] / $size);
        }

        $data = ['srr' => $srr, 'wrr' => $wrr, 'pages' => $pages, 'brr' => $brr] + $this->data();

        return $this->view('home/index', $data);
    }

    function getData()
    {
        if (isset($_POST['p'])) {
            $id = $_POST['c'];
            $page = $_POST['p'];
            $size = 4;

            $watch = new Watch();
            $data = $watch->getWatchesByCategoryId($id, $page, $size);

            return $this->json($data);
        }
    }

    function detail($id)
    {
        $watch = new Watch();
        $cat = new Category();
        $img = new Image();

        $cmt = new Comments();
        $avgScore = $cmt->avgScoreByProductId($id);

        $rating = 0;
        if ($avgScore['avgScore'] != null) {
            $rating = ceil($avgScore['avgScore']);
        }

        $irr = $img->getImagesByProductId($id);
        $o = $watch->getWatch($id);
        $c = $cat->getCategoryById($o['CategoryId']);

        $o['Watch'] = $watch->getWatchesRelation(['id' => $id, 'cid' => $o['CategoryId']]);

        $attr = new Attribute();
        $arr = $attr->getAttributeByProductId($id);

        $cmt = new Comments();
        $countCmt = $cmt->countCommentsByProductId($id);
        $getCmt = $cmt->getCommentsByProductId($id);

        $data = [
            'arr' => $arr, 'o' => $o, 'c' => $c,
            'irr' => $irr, 'cmt' => $getCmt,
            'countCmt' => $countCmt,
            'rating' => $rating
        ] + $this->data();

        return $this->view('home/detail', $data);
    }

    protected function loadDataFilter($query, $size, $arr, $wrr = null)
    {
        $q = $this->getURL();
        $min = '';
        $max = '';

        $watch = new Watch();

        $minMax = $watch->MinMaxPriceInProduct($query, $wrr);
        $minPrice = $minMax['Min'];
        $maxPrice = $minMax['Max'];

        $sql = "SELECT * FROM Product WHERE $query";
        $sqlCount = "SELECT COUNT(*) AS Total FROM Product WHERE $query";

        if (isset($_GET['brand'])) {
            $sql .= " AND BrandId IN ({$_GET['brand']})";
            $sqlCount .= " AND BrandId IN ({$_GET['brand']})";
        }

        if (isset($_GET['price'])) {
            $prices = explode(',', $_GET['price']);
            $min = $prices[0];
            $max = $prices[1];
            $sql .= " AND Price BETWEEN $min AND $max";
            $sqlCount .= " AND Price BETWEEN $min AND $max";
        }

        $sql .= " LIMIT :index, :size";
        $o = $watch->getWatchByFilter($sql, $arr);
        $total = $watch->countFilter($sqlCount, $wrr);
        $pages = ceil($total / $size);

        $data = [
            'minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'min' => $min,
            'max' => $max, 'o' => $o, 'pages' => $pages, 'q' => $q
        ] + $this->data();

        return $data;
    }

    function watch()
    {
        $cat = new Category();

        if (isset($_GET['id']) && $_GET['id'] <= 3) {
            $page = $this->getPage();
            $id = $_GET['id'];
            $size = 4;

            $c = $cat->getCategoryById($id);

            $query = 'CategoryId = :id';
            $arr = ['id' => $id, 'index' => ($page - 1) * $size, 'size' => $size];
            $wrr = ['id' => $id];


            $brand = new Brand();
            $brr = $brand->getBrandByCategory($id);

            $data = $this->loadDataFilter($query, $size, $arr, $wrr) + [
                'page' => $page,
                'c' => $c,
                'id' => $id,
                'brr' => $brr
            ];

            $this->meta['title'] = "{$c['CategoryName']} | Hải Triều";

            return $this->view('home/watch', $data);
        }
        return $this->redirect('/Web_HaiTrieu');
    }

    function category()
    {
        $this->meta['title'] = 'Tất cả danh mục | Hải Triều';
        $page = $this->getPage();
        $size = 9;

        $arr = ['index' => ($page - 1) * $size, 'size' => $size];
        $query = '1=1';
        $brand = new Brand();
        $brr = $brand->getBrandsByProduct();
        $data = $this->loadDataFilter($query, $size, $arr) + [
            'page' => $page,
            'brr' => $brr
        ];

        return $this->view('home/category', $data);
    }

    function contact()
    {
        $this->meta['title'] = 'Liên hệ | Hải Triều';
        $data = $this->data();
        return $this->view('home/contact', $data);
    }

    function search()
    {
        $this->meta['title'] = 'Kết quả tìm kiếm | Hải Triều';
        $size = 9;

        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $page = $this->getPage();
            $defaut = ['page' => $page, 'search' => $q];

            $arr = ['q' => "%{$q}%", 'index' => ($page - 1) * $size, 'size' => $size];
            $wrr = ['q' => "%{$q}%"];

            $brand = new Brand();
            $brr = $brand->getBrandBySearch($q);
            $message = "Kết quả tìm kiếm cho từ khóa '{$q}'";

            $data = $this->loadDataFilter("ProductName LIKE :q", $size, $arr, $wrr) + $defaut + [
                'brr' => $brr,
                'message' => $message,
            ];

            if (empty($data['o'])) {
                $arr = ['index' => ($page - 1) * $size, 'size' => $size];
                $brr = $brand->getBrandsByProduct();
                $message = "Không tìm thấy kết quả tìm kiếm cho từ khóa '{$q}'";
                $data = $this->loadDataFilter("1=1", $size, $arr) + $defaut + [
                    'brr' => $brr,
                    'message' => $message,
                ];
            }

            return $this->view('home/search', $data);
        }

        return $this->redirect('/Web_HaiTrieu');
    }

    function favorites()
    {
        if ($this->checkLoginMember()) {
            $member = $this->memberProfile();
            $memberId = $member['MemberId'];
            $favorites = new Favorites();
            $data = $this->data() + [
                'frr' => $favorites->getFavoritesByMemberId($memberId)
            ];

            return $this->view('home/favorite', $data);
        }
        return $this->redirect('/Web_HaiTrieu/auth');
    }

    function actionFavorite($action)
    {
        $idProduct = $_POST['id'];
        $member = $this->memberProfile();
        $memberId = $member['MemberId'];
        $favorites = new Favorites();
        $ret = $favorites->$action(['mid' => $memberId, 'pid' => $idProduct]);
        return $ret;
    }

    function doFavorite()
    {
        if ($this->checkLoginMember() && isset($_POST['id'])) {
            $result = $this->actionFavorite('addFavorite');
            return $this->json($result);
        }

        return $this->json(['favorites' => false]);
    }

    function deleteFavorite()
    {
        if ($this->checkLoginMember() && isset($_POST['id'])) {
            $result = $this->actionFavorite('deleteFavorite');
            return $this->json($result);
        }

        return $this->redirect('/Web_HaiTrieu/auth');
    }
}
