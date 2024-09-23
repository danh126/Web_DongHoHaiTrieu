<?php

namespace controllers;

use models\Auth;
use models\Category;

class AuthController extends Controller
{
    function index()
    {
        if (!isset($_COOKIE['USLGID'])) {
            $cat = new Category();
            $crr = $cat->getCategories();
            $qtyCart = $this->countQuantityProductInCart();
            $member = $this->memberProfile();
            $data = ['crr' => $crr, 'qtyCart' => $qtyCart, 'member' => $member];
            return $this->view('auth/index', $data);
        } else {
            return $this->redirect('/Web_HaiTrieu');
        }
    }

    function register()
    {
        if (isset($_POST['user']) && empty($_COOKIE['USLGID'])) {
            $auth = new Auth();
            $_POST['id'] = md5(uniqid() . uniqid());
            $data = ['id' => $_POST['id'], 'eml' => $_POST['eml'], 'user' => $_POST['user'], 'gender' => $_POST['gender'], 'pwd' => $_POST['pwd']];
            return $this->json($auth->add($data));
        } else {
            return $this->redirect('/Web_HaiTrieu');
        }
    }

    function login()
    {
        if (isset($_POST['eml']) && empty($_COOKIE['USLGID'])) {
            $auth = new Auth();
            $pwd = md5($_POST['pwd']);
            $result = $auth->checkEmailLogin(['eml' => $_POST['eml']]);
            if ($result) {
                $checkPass = false;
                if ($pwd == $result['Password']) {
                    $checkPass = true;
                    $token = md5(uniqid() . uniqid() . uniqid());
                    $id =  $result['MemberId'];
                    if ($_POST['rem'] == 1) {
                        setcookie('USLGID', $id, time() + 8600, $path = '/');
                    } else {
                        setcookie('USLGID', $id, 0, $path = '/');
                    }
                    $data = ['id' => $token, 'mid' => $id];
                    $auth->sessionLogin($data);
                    return $this->json(['checkPass' => $checkPass]);
                } else {
                    return $this->json(['checkPass' => $checkPass]);
                }
            } else {
                $checkLogin = false;
                return $this->json(['checkLogin' => $checkLogin]);
            }
        } else {
            return $this->redirect('/Web_HaiTrieu');
        }
    }

    function logout()
    {
        if (isset($_COOKIE['USLGID'])) {
            $id = $_COOKIE['USLGID'];
            $auth = new Auth();
            if ($auth->sessionLogout($id)) {
                setcookie('USLGID', $id, time() - 8600 * 2, $path = '/');
                unset($id);
                return $this->redirect('/Web_HaiTrieu');
            }
        } else {
            return $this->redirect('/Web_HaiTrieu');
        }
    }

    function profile()
    {
        if (isset($_COOKIE['USLGID'])) {
            $member = $this->memberProfile();
            $data = $this->data() + ['member' => $member];
            return $this->view('auth/profile', $data);
        }
    }

    function update()
    {
        if (isset($_COOKIE['USLGID'], $_POST['fname'])) {
            $auth = new Auth();
            $_POST['id'] = $_COOKIE['USLGID'];
            if ($auth->update($_POST)) {
                return $this->json(['update' => true]);
            }
        }
    }

    function uploadAvatar()
    {
        if (isset($_COOKIE['USLGID'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
                    $oldF = "../{$_POST['oldImg']}";
                    if (file_exists($oldF)) {
                        unlink($oldF);
                    }
                    $random = uniqid();
                    $imageUrl = $this->uploadfile($_FILES['file'], '../Web_HaiTrieu/public/images/avatar/', $random);
                    $arr = ['url' => $imageUrl, 'id' => $_COOKIE['USLGID']];
                    $auth = new Auth();
                    if ($auth->uploadAvatar($arr)) {
                        return $this->json(['uploadAvt' => true]);
                    }
                }
            }
        }
    }

    function changePass()
    {
        if (isset($_COOKIE['USLGID'], $_POST['oldPass'])) {
            $oldPass = md5($_POST['oldPass']);
            $newPass = md5($_POST['newPass']);
            $arr = ['oldPass' => $oldPass, 'id' => $_COOKIE['USLGID']];
            $auth = new Auth();
            $check = $auth->checkOldPass($arr);
            if ($check) {
                $auth->changePass(['pass' => $newPass, 'id' => $_COOKIE['USLGID']]);
                return $this->json(['changePass' => true]);
            } else {
                return $this->json(['oldPass' => false]);
            }
        }
    }
}
