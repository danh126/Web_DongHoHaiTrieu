<?php

namespace controllers;

use models\Auth;

class AdminController extends Controller
{
    function __construct()
    {
        $this->layout = '_login-admin';
        $this->meta['title'] = 'Đăng nhập quản trị';
    }

    function login()
    {
        if (!isset($_COOKIE['ADLGID'])) {
            return $this->view('manager/admin/login');
        }
        return $this->redirect('/Web_HaiTrieu/error/notFound');
    }

    function checkLogin()
    {
        if (isset($_POST['eml']) && !isset($_COOKIE['ADLGID'])) {
            $auth = new Auth();
            $email = $_POST['eml'];
            $pwd = md5($_POST['pwd']);
            $result = $auth->checkEmailLogin(['eml' => $email]);

            if ($result) {
                $checkPass = false;
                if ($pwd == $result['Password']) {
                    $arr = ['eml' => $email, 'pwd' => $pwd];

                    if ($auth->getAdmin($arr)) {
                        $checkAdmin = true;
                        $token = md5(uniqid() . uniqid() . uniqid());
                        $id =  $result['MemberId'];

                        if ($_POST['rem'] == 1) {
                            setcookie('ADLGID', $id, time() + 86000, $path = '/');
                        } else {
                            setcookie('ADLGID', $id, 0, $path = '/');
                        }

                        $data = ['id' => $token, 'mid' => $id];
                        $auth->sessionLogin($data);

                        return $this->json(['checkAdmin' => $checkAdmin]);
                    }

                    $checkAdmin = false;
                    return $this->json(['checkAdmin' => $checkAdmin]);
                }

                return $this->json(['checkPass' => $checkPass]);
            }

            $checkLogin = false;
            return $this->json(['checkLogin' => $checkLogin]);
        }
        return $this->redirect('/Web_HaiTrieu/error/notFound');
    }

    function logout()
    {
        if (isset($_COOKIE['ADLGID'])) {
            $id = $_COOKIE['ADLGID'];
            $auth = new Auth();
            if ($auth->sessionLogout($id)) {
                setcookie('ADLGID', $id, time() - 86000 * 2, $path = '/');
                unset($id);
                return $this->redirect('/Web_HaiTrieu/admin/login');
            }
        }
        return $this->redirect('/Web_HaiTrieu/admin/login');
    }
}
