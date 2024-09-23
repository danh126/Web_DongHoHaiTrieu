<?php

namespace controllers;

use models\Category;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->layout = '_admin';
    }

    function index()
    {
        $this->meta['title'] = 'Quản lý danh mục sản phẩm | Hải Triều';
        if ($this->checkLoginAdmin()) {
            $admin = $this->adminProfile();
            $cat = new Category();
            $crr = $cat->getCategories();
            $data = ['admin' => $admin, 'crr' => $crr];
            return $this->view('manager/category/index', $data);
        }
    }

    function edit()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['id'])) {
                $arr = [
                    'name' => $_POST['name'], 'desc' => $_POST['desc'],
                    'url' => $_POST['categoryUrl'], 'id' => $_POST['id']
                ];

                $cat = new Category();
                if ($cat->edit($arr)) {
                    return $this->redirect('/Web_HaiTrieu/category/index');
                }
            }
        }
    }
    function add()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['name'])) {
                $arr = [
                    'name' => $_POST['name'], 'desc' => $_POST['desc'],
                    'url' => $_POST['categoryUrl']
                ];

                $cat = new Category();
                if ($cat->add($arr)) {
                    return $this->redirect('/Web_HaiTrieu/category/index');
                }
            }
        }
    }
    function delete()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $cat = new Category();

                $ret = $cat->delete($id);

                if ($ret) {
                    return $this->json($ret);
                } else {
                    return $this->json(['del' => false]);
                }
            }
        }
    }
}
