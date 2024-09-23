<?php

namespace controllers;

use models\Attribute;
use models\Brand;
use models\Category;
use models\Image;
use models\ProductAttribute;
use models\Watch;

class ProductController extends Controller
{
    function __construct()
    {
        $this->layout = '_admin';
    }

    function getCategories()
    {
        $cat = new Category();
        $crr = $cat->getCategories();
        return $crr;
    }

    function index()
    {
        $this->meta['title'] = 'Quản lý sản phẩm';
        $page = $this->getPage();
        $size = 10;

        if ($this->checkLoginAdmin()) {
            $watch = new Watch();
            $wrr = $watch->getWatchAll($page, $size);
            $total = $watch->countWatches();

            $pages = ceil($total / $size);
            $admin = $this->adminProfile();

            $data = [
                'wrr' => $wrr, 'admin' => $admin,
                'page' => $page, 'pages' => $pages
            ];

            return $this->view('manager/product/index', $data);
        }
    }

    function add()
    {
        $this->meta['title'] = 'Thêm sản phẩm | Hải Triều';

        if ($this->checkLoginAdmin()) {
            $admin = $this->adminProfile();
            $crr = $this->getCategories();

            $brand = new Brand();
            $brr = $brand->getBrands();

            $attr = new Attribute();
            $arr = $attr->getAttribute();

            $data = ['admin' => $admin, 'crr' => $crr, 'brr' => $brr, 'arr' => $arr];

            return $this->view('manager/product/add', $data);
        }
    }

    function doAdd()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['cid'])) {
                if (isset($_FILES['fb']) && $_FILES['fb']['name']) {
                    $random = uniqid() . uniqid();
                    $url =  $this->uploadfile($_FILES['fb'], "../Web_HaiTrieu/public/images/product/", $random);
                    $_POST['url'] = $url;
                }

                $watch = new Watch();
                $data = [
                    'cid' => $_POST['cid'], 'bid' => $_POST['bid'], 'name' => $_POST['name'],
                    'desc' => $_POST['desc'], 'price' => $_POST['price'],
                    'qty' => $_POST['qty'], 'url' => $_POST['url']
                ];

                $id = $watch->add($data);

                if (isset($_FILES['f']) && $_FILES['f']['name']) {
                    $arr = $this->uploadfiles($_FILES['f'], $id);
                    $img = new Image();

                    foreach ($arr as $v) {
                        $img->add($v);
                    }

                    $ids = $_POST['ids'];
                    $values = $_POST['values'];
                    $pro = new ProductAttribute();

                    for ($i = 0; $i < count($ids); $i++) {
                        $prr = ['pid' => $id, 'attrId' => $ids[$i], 'value' => $values[$i]];
                        $pro->add($prr);
                    }

                    return $this->redirect('/Web_HaiTrieu/product/index');
                }
            }
        }
    }

    function edit()
    {
        $this->meta['title'] = 'Cập nhật sản phẩm | Hải Triều';
        if ($this->checkLoginAdmin()) {
            $id = $_GET['id'];
            $page = $_GET['page'];

            $admin = $this->adminProfile();
            $crr = $this->getCategories();

            $brand = new Brand();
            $brr = $brand->getBrands();
            $watch = new Watch();
            $o = $watch->getWatch($id);
            $img = new Image();
            $irr = $img->getImagesByProductId($id);
            $attr = new Attribute();

            $arr = $attr->getAttributeByProductId($id);

            $data = [
                'arr' => $arr, 'page' => $page, 'admin' => $admin,
                'crr' => $crr, 'brr' => $brr, 'o' => $o, 'irr' => $irr
            ];

            return $this->view('manager/product/edit', $data);
        }
    }

    function doEdit()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['cid'])) {
                $id = $_GET['id'];
                $page = $_GET['page'];

                if (isset($_FILES['fb']) && $_FILES['fb']['name']) {
                    $url = "../Web_HaiTrieu/public/images/product/{$_POST['url']}";
                    if (file_exists($url)) {
                        unlink($url);
                    }

                    $random = uniqid() . uniqid();
                    $url = $this->uploadfile($_FILES['fb'], "../Web_HaiTrieu/public/images/product/", $random);
                    $_POST['url'] = $url;
                }

                $watch = new Watch();
                $wrr = [
                    'cid' => $_POST['cid'], 'bid' => $_POST['bid'],
                    'name' => $_POST['name'], 'desc' => $_POST['desc'],
                    'price' => $_POST['price'], 'qty' => $_POST['qty'],
                    'url' => $_POST['url'], 'id' => $id
                ];

                $watch->update($wrr);

                if (isset($_FILES['f']) && !empty($_FILES['f']['name'][0])) {
                    $arr = $this->uploadfiles($_FILES['f'], $id);
                    $img = new Image();

                    foreach ($arr as $v) {
                        $img->add($v);
                    }
                }

                $ids = $_POST['ids'];
                $values = $_POST['values'];
                $pro = new ProductAttribute();

                for ($i = 0; $i < count($ids); $i++) {
                    $prr = ['pid' => $id, 'attrId' => $ids[$i], 'value' => $values[$i]];
                    $pro->add($prr);
                }

                return $this->redirect("/Web_HaiTrieu/product/index/?page={$page}");
            }
        }
    }

    function delete()
    {
        if ($this->checkLoginAdmin() && isset($_POST['pid'])) {
            $watch = new Watch();
            $result = $watch->delete($_POST['pid']);

            if ($result) {
                return $this->json(['delete' => true]);
            }
        }

        return $this->redirect('/Web_HaiTrieu/product/index');
    }
}
