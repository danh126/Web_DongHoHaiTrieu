<?php

namespace controllers;

use models\Auth;
use models\Member;

class MemberController extends Controller
{
    function __construct()
    {
        $this->layout = '_admin';
    }

    function index()
    {
        $this->meta['title'] = 'Quản lý người dùng | Hải Triều';

        if ($this->checkLoginAdmin()) {
            $member = new Member();
            $mrr = $member->getMembers();

            $admin = $this->adminProfile();

            $data = ['admin' => $admin, 'mrr' => $mrr];

            return $this->view('manager/member/index', $data);
        }
    }

    function roles($id)
    {
        $this->meta['title'] = 'Phân quyền người dùng | Hải Triều';

        if ($this->checkLoginAdmin()) {
            $member = new Member();
            $obj = $member->getMemberByMemberId($id);

            $role = $member->getRoleByMember($id);

            $admin = $this->adminProfile();

            $data = ['admin' => $admin, 'obj' => $obj, 'id' => $id, 'role' => $role];

            return $this->view('manager/member/roles', $data);
        }
    }

    function addRole()
    {
        if ($this->checkLoginAdmin() && isset($_POST['rid'], $_POST['mid'])) {
            $member = new Member();
            $ret = $member->addRoleByMember($_POST);

            return $this->json($ret);
        }
    }
}
