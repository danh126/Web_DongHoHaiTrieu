<?php

namespace controllers;

use models\Auth;
use models\Cart;
use models\Category;
use models\Favorites;
use models\Orders;

abstract class Controller
{
    protected $layout = "_layout";
    protected $meta = ['title' => 'Trang chủ | Hải Triều', 'description' => 'Đồng hồ đeo tay chính hãng!'];

    protected function view($url = null, $arr = null)
    {
        if ($arr && is_array($arr)) {
            extract($arr);
        }

        if ($url == null) {
            require_once("views/shared/{$this->layout}.php");
        } else {
            require_once("views/shared/{$this->layout}.php");
        }
    }

    protected function json($arr)
    {
        header('Content-Type:application/json;charset=utf8');
        echo json_encode($arr);
    }

    protected function redirect($url)
    {
        header("location:$url");
    }

    protected function countQuantityProductInCart()
    {
        $cart = new Cart();
        if (isset($_SESSION['cart'])) {
            $qtyCart = $cart->countCart($_SESSION['cart']);
            $qtyCart = $qtyCart[0]['Total'];
            return $qtyCart;
        }

        $qtyCart = 0;
        return $qtyCart;
    }

    protected function memberProfile()
    {
        if (isset($_COOKIE['USLGID'])) {
            $auth = new Auth();
            $id = $_COOKIE['USLGID'];
            $arr = $auth->getMemberInSession($id);

            $favorites = new Favorites();
            $countFavorites = $favorites->countFavoritesByMemberId($id);

            $orders = new Orders();
            $count = $orders->countOrdersByMemberId($id);

            return $arr + [
                'favorites' => $countFavorites,
                'countOrders' => $count
            ];
        }
    }

    protected function checkLoginMember()
    {
        if (isset($_COOKIE['USLGID'])) {
            return true;
        } else {
            return false;
        }
    }

    protected function checkLoginAdmin()
    {
        if (isset($_COOKIE['ADLGID'])) {
            return true;
        } else {
            return $this->redirect('/Web_HaiTrieu/error/unauthorized');
        }
    }

    protected function adminProfile()
    {
        if (isset($_COOKIE['ADLGID'])) {
            $auth = new Auth();
            $id = $_COOKIE['ADLGID'];
            $arr = $auth->getMemberInSession($id);
            return $arr;
        }
    }

    protected function getURL()
    {
        $url = $_GET;
        unset($url['page']);
        $url = http_build_query($url);
        $url = $url ? $url . '&' : '';
        return $url;
    }

    protected function getPage()
    {
        if (empty($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        return $page;
    }

    protected function uploadfile($file, $folder, $random)
    {
        $arr = explode(".", $file['name']);
        $ext = $arr[count($arr) - 1];
        $imgUrl = $random . "." . $ext;
        move_uploaded_file($file['tmp_name'], $folder . $imgUrl);
        return $imgUrl;
    }

    protected function uploadfiles($file, $id)
    {
        $arr = [];
        $fname = $file['name'];
        for ($i = 0; $i < count($fname); $i++) {
            $ext = pathinfo($fname[$i], PATHINFO_EXTENSION);
            $name = uniqid() . uniqid() . '.' . $ext;
            move_uploaded_file($file['tmp_name'][$i], "../Web_HaiTrieu/public/images/imgdetails/" . $name);
            $arr[] = ['url' => $name, 'type' => $file['type'][$i], 'size' => $file['size'][$i], 'pid' => $id];
        }
        return $arr;
    }

    function data()
    {
        $cat = new Category();
        $crr = $cat->getCategories();
        $qtyCart = $this->countQuantityProductInCart();
        $member = $this->memberProfile();
        $data = ['crr' => $crr, 'qtyCart' => $qtyCart, 'member' => $member];
        return $data;
    }
}
