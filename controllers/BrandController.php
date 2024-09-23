<?php

namespace controllers;

use models\Brand;

class BrandController extends Controller
{

    function __construct()
    {
        $this->layout = '_admin';
    }

    function index()
    {
        $this->meta['title'] = 'Quản lý thương hiệu | Hải Triều';
        $page = $this->getPage();
        $size = 4;

        if ($this->checkLoginAdmin()) {
            $admin = $this->adminProfile();
            $brand = new Brand();
            $brr = $brand->getBrandsLimit($page, $size);
            $count = $brand->countBrands();

            $pages = ceil($count / $size);

            $data = [
                'admin' => $admin, 'brr' => $brr,
                'page' => $page, 'pages' => $pages
            ];

            return $this->view('manager/brand/index', $data);
        }
    }

    function edit()
    {
        if ($this->checkLoginAdmin() && isset($_POST['id'], $_POST['name'])) {
            if (isset($_FILES['f']['name'][0])) {
                $url = "../Web_HaiTrieu/public/images/brand/{$_POST['logoUrl']}";
                if (file_exists($url)) {
                    unlink($url);
                }

                $random = uniqid() . uniqid();
                $logoUrl = $this->uploadfile($_FILES['f'], "../Web_HaiTrieu/public/images/brand/", $random);
                $_POST['logoUrl'] = $logoUrl;
            }

            $brand = new Brand();
            $ret = $brand->update([
                'name' => $_POST['name'],
                'logoUrl' => $_POST['logoUrl'], 'id' => $_POST['id']
            ]);

            if ($ret) {
                return $this->redirect('/Web_HaiTrieu/brand/index');
            }
        }
    }

    function add()
    {
        if ($this->checkLoginAdmin() && isset($_POST['name'])) {
            if (isset($_FILES['f']['name'][0])) {
                $random = uniqid() . uniqid();
                $logoUrl = $this->uploadfile($_FILES['f'], "../Web_HaiTrieu/public/images/brand/", $random);
                $_POST['logoUrl'] = $logoUrl;
            }

            $brand = new Brand();
            $ret = $brand->add([
                'name' => $_POST['name'],
                'logoUrl' => $_POST['logoUrl']
            ]);

            if ($ret) {
                return $this->redirect('/Web_HaiTrieu/brand/index');
            }
        }
    }

    function delete()
    {
        if ($this->checkLoginAdmin() && isset($_POST['id'])) {
            $brand = new Brand();
            $ret = $brand->delete($_POST['id']);

            if ($ret) {
                return $this->json($ret);
            }
            return $this->json(['delete' => false]);
        }
    }
}
