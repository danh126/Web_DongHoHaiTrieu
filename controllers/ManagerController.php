<?php

namespace controllers;

class ManagerController extends Controller
{
    function __construct()
    {
        $this->layout = "_admin";
    }
    function index()
    {
        $this->meta['title'] = 'Trang chủ quản trị | Hải Triều';

        if ($this->checkLoginAdmin()) {
            $admin = $this->adminProfile();
            $data = ['admin' => $admin];

            return $this->view('manager/home/index', $data);
        }
    }
}
