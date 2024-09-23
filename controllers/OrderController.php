<?php

namespace controllers;

use models\Comments;
use models\Orders;
use models\Watch;

class OrderController extends Controller
{
    function __construct()
    {
        $this->layout = '_admin';
    }

    function index()
    {
        $this->meta['title'] = 'Quản lý đơn hàng | Hải Triều';
        $page = $this->getPage();
        $size = 5;

        if ($this->checkLoginAdmin()) {
            $orders = new Orders();
            $orr = $orders->getOrders($page, $size);
            $admin = $this->adminProfile();
            $status = $orders->getStatus();
            $count = $orders->countOrders();

            $pages = ceil($count / $size);

            $data = [
                'admin' => $admin, 'orr' => $orr,
                'scc' => $status, 'page' => $page,
                'pages' => $pages
            ];

            return $this->view('manager/order/index', $data);
        }
    }

    function details()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['id'])) {
                $id = $_POST['id'];
                $orders = new Orders();

                $data = $orders->getOrderByOrderId($id);

                return $this->json($data);
            }
        }
    }

    function updateStatus()
    {
        if ($this->checkLoginAdmin()) {
            if (isset($_POST['status'])) {
                $orders = new Orders();

                if ($orders->updateStatus($_POST)) {
                    return $this->json(['updateStatus' => true]);
                }
            }
        }
    }

    function deleteOrders()
    {
        if ($this->checkLoginMember() || $this->checkLoginAdmin()) {
            if (isset($_POST['id'], $_POST['qty'], $_POST['pid'])) {

                $idOrders = $_POST['id'];
                $pid = $_POST['pid'];
                $qty = $_POST['qty'];

                $watch = new Watch();
                for ($i = 0; $i < count($pid); $i++) {
                    $watch->updateQuantityInProduct('+', [
                        'qty' => $qty[$i],
                        'pid' => $pid[$i]
                    ]);
                }

                $orders = new Orders();
                if ($orders->deleteOrders($idOrders)) {
                    return $this->json(['deleteOrders' => true]);
                }
            }
        }
    }

    function getOrders($orr)
    {
        if ($this->checkLoginMember()) {
            $arr = [];
            foreach ($orr as $o) {
                $k = $o['OrderId'];
                if (!isset($arr[$k])) {
                    $arr[$k] = [];
                }
                $arr[$k][] = $o;
            }
            return $arr;
        }
        return $this->redirect('/Web_HaiTrieu');
    }

    function myorders()
    {
        $this->layout = '_layout';
        $this->meta['title'] = 'Đơn hàng của tôi | Hải Triều';

        if ($this->checkLoginMember()) {
            $orders = new Orders();
            $orr = $orders->getOrdersByMemberId($_COOKIE['USLGID']);

            $arr = $this->getOrders($orr);
            $data = $this->data() + ['arr' => $arr];

            return $this->view('orders/myorders', $data);
        }
        return $this->redirect('/Web_HaiTrieu');
    }

    function reviewed()
    {
        if ($this->checkLoginMember()) {
            if (isset($_POST['pid'], $_POST['score'], $_POST['content'])) {

                $member = $this->memberProfile();
                $mid = $member['MemberId'];

                $cmt = new Comments();
                $arr = [
                    'mid' => $mid,
                    'orderId' => $_POST['orderId'],
                    'pid' => $_POST['pid'],
                    'content' => $_POST['content'],
                    'score' => $_POST['score']
                ];

                if ($cmt->addComment($arr)) {
                    return $this->json(['reviewed' => true]);
                }

                return $this->json(['reviewed' => false]);
            }
        }
    }

    function tracking($id)
    {
        $this->layout = '_layout';
        $this->meta['title'] = 'Theo dõi đơn hàng | Hải Triều';

        if ($this->checkLoginMember()) {
            $orders = new Orders();
            $orr = $orders->getOrderByOrderId($id);

            $arr = $this->getOrders($orr);
            $data = $this->data() + ['arr' => $arr, 'id' => $id];

            return $this->view('orders/tracking', $data);
        }
        return $this->redirect('/Web_HaiTrieu');
    }
}
