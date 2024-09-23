<?php

namespace controllers;

use models\Auth;
use models\Cart;
use models\Customer;
use models\Orders;
use models\Watch;

class CartController extends Controller
{
    function loadData()
    {
        $data = $this->data();
        return $data;
    }

    function index()
    {
        $this->meta['title'] = 'Giỏ hàng | Hải Triều';

        if (isset($_SESSION['cart']) && !isset($_SESSION['checkout'])) {
            $carts = new Cart();
            $cart = $carts->getCarts($_SESSION['cart']);
            $data = $this->loadData() + ['cart' => $cart];
            return $this->view('cart/index', $data);
        }
        $data = $this->loadData();
        return $this->view('cart/index', $data);
    }

    function add($id)
    {
        $cart = new Cart();

        if (isset($_SESSION['cart'])) {
            $cid = $_SESSION['cart'];
        } else {
            $cid = 'watch_' . uniqid();
            $_SESSION['cart'] = $cid;
        }

        if (isset($_POST['qty'])) {
            $qty = $_POST['qty'];
            $addCart = $cart->addCart(['cid' => $cid, 'pid' => $id, 'qty' => $qty]);
            return $this->json($addCart);
        }

        $qty = 1;
        $cart->addCart(['cid' => $cid, 'pid' => $id, 'qty' => $qty]);
        return $this->redirect('/Web_HaiTrieu/cart');
    }

    function delete()
    {
        if (isset($_SESSION['cart'], $_POST['id'])) {
            $cart = new Cart();
            $ret = $cart->delete(['id' => $_SESSION['cart'], 'pid' =>  $_POST['id']]);

            return $this->json($ret);
        }
        return $this->redirect('/Web_HaiTrieu');
    }

    function update()
    {
        if (isset($_SESSION['cart'], $_POST['id'], $_POST['qty'])) {
            $cart = new Cart();
            $ret = $cart->update([
                'qty' => $_POST['qty'], 'id' => $_SESSION['cart'],
                'pid' => $_POST['id']
            ]);

            return $this->json($ret);
        }
    }

    function coupon()
    {
        if (isset($_SESSION['cart'], $_POST['total'], $_POST['coupon'])) {
            $cart = new Cart();
            $total = $_POST['total'];
            $coupon = $_POST['coupon'];
            $row = $cart->getCouponByCouponCode($coupon);

            if ($row) {
                $discount = $total * $row['CouponApply'];
                $finalTotal = $total - $discount;
                return $this->json(['discount' => $discount, 'finalTotal' => $finalTotal]);
            }
        }
    }

    function checkout()
    {
        $this->meta['title'] = 'Đặt hàng | Hải Triều';
        if (isset($_SESSION['cart']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $_SESSION['checkout'] = true;
            $subTotal = $_POST['subTotal'];
            $finalTotal = $_POST['finalTotal'];

            $idCart = $_SESSION['cart'];
            $carts = new Cart();
            $cart = $carts->getCartByCartId($idCart);

            $arr = [
                'cart' => $cart, 'qtyCart' => $this->countQuantityProductInCart(),
                'subTotal' => $subTotal, 'finalTotal' => $finalTotal
            ];
            $data = $this->loadData() + $arr;

            return $this->view('cart/checkout', $data);
        }
        return $this->redirect('/Web_HaiTrieu/cart');
    }

    protected function autoOrderId()
    {
        $prefix = "NTD";
        $date = date("Ymd");
        $randomString = substr(md5(uniqid(mt_rand(), true)), 0, 5);

        $orderCode = $prefix . $date . $randomString;
        return strtoupper($orderCode);
    }

    protected function customerCheckout($addCustomer, $checkCustomer)
    {
        $cus = new Customer();
        $o = $cus->getCustomer($checkCustomer);
        if ($o != null) {
            $cusId = $o['CustomerId'];
        } else {
            $cusId = $cus->add($addCustomer);
        }
        return $cusId;
    }

    protected function memberCheckout($updateMember)
    {
        $auth = new Auth();
        $memberProfile = $this->memberProfile();

        if (empty($memberProfile['Phone'])) {
            $arr = ['username' => $memberProfile['UserName']] + $updateMember + ['id' => $memberProfile['MemberId']];
            $auth->update($arr);
        }

        return $memberProfile['MemberId'];
    }

    protected function addOrders($addOrders, $fieldName, $idCart, $idOrders)
    {
        $order = new Orders();
        $order->addOrder($addOrders, $fieldName);

        $cat = new Cart();
        $prr = $cat->getCarts($idCart);

        $watch = new Watch();

        for ($i = 0; $i < count($prr); $i++) {
            $odrr = [
                'oid' => $idOrders, 'pid' => $prr[$i]['ProductId'],
                'qty' => $prr[$i]['Quantity'], 'price' => $prr[$i]['Price']
            ];
            $order->addDetails($odrr);

            $watch->updateQuantityInProduct('-', [
                'qty' => $prr[$i]['Quantity'],
                'pid' => $prr[$i]['ProductId']
            ]);
        }
    }

    function doCheckout()
    {
        if (isset($_SESSION['cart']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $idCart = $_SESSION['cart'];
            $idOrders = $this->autoOrderId();

            if (!$this->checkLoginMember()) {
                $addCustomer = [
                    'fname' => $_POST['fname'], 'eml' => $_POST['eml'],
                    'phone' => $_POST['phone'], 'address' => $_POST['address']
                ];

                $checkCustomer = ['eml' => $_POST['eml'], 'phone' => $_POST['phone']];
                $customerId = $this->customerCheckout($addCustomer, $checkCustomer);

                $addOrdersCustomer = [
                    'id' => $idOrders, 'cusId' => $customerId, 'od' => $_POST['od'],
                    'note' => $_POST['note'], 'total' => $_POST['total']
                ];

                $this->addOrders($addOrdersCustomer, 'CustomerId', $idCart, $idOrders);
            } else {
                $updateMember = [
                    'fname' => $_POST['fname'], 'phone' => $_POST['phone'],
                    'address' => $_POST['address']
                ];

                $memberId = $this->memberCheckout($updateMember);

                $addOrdersMember = [
                    'id' => $idOrders, 'cusId' => $memberId, 'od' => $_POST['od'],
                    'note' => $_POST['note'], 'total' => $_POST['total']
                ];

                $this->addOrders($addOrdersMember, 'MemberId', $idCart, $idOrders);
            }

            $cat = new Cart();
            if ($cat->deleteAll($_SESSION['cart'])) {
                $_SESSION['orders-success'] = true;
                unset($_SESSION['cart']);
                return $this->json(['checkout' => true, 'orderId' => $idOrders]);
            }
        }
    }

    function checkmark($id)
    {
        $this->meta['title'] = 'Đặt hàng thành công | Hải Triều';

        if ($_SESSION['orders-success']) {
            $data = $this->loadData() + ['orderId' => $id, 'qtyCart' => $this->countQuantityProductInCart()];
            unset($_SESSION['orders-success']);
            return $this->view('cart/checkmark', $data);
        }
        return $this->redirect('/Web_HaiTrieu');
    }

    function resetCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['checkout'])) {
            unset($_SESSION['checkout']);
            return $this->redirect('/Web_HaiTrieu/cart');
        }
    }
}
