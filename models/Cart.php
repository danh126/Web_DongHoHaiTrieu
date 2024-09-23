<?php

namespace models;

use PDOException;

class Cart extends Db
{
    function countCart($id)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Cart WHERE CartId = :id';
        return $this->fetchAll($sql, ['id' => $id]);
    }
    function getCarts($id)
    {
        $sql = 'SELECT Cart.*, ProductName, Price, ImageUrl FROM Cart JOIN Product ON Cart.ProductId = Product.ProductId AND CartId = :id';
        return $this->fetchAll($sql, ['id' => $id,]);
    }
    function getCartByCartId($id)
    {
        $sql = 'SELECT Cart.*, ProductName, Price, ImageUrl FROM Cart JOIN Product ON Cart.ProductId = Product.ProductId AND CartId = :id';
        return $this->fetchAll($sql, ['id' => $id]);
    }
    function addCart($arr)
    {
        $sql = 'CALL AddCart(:cid, :pid, :qty)';
        return $this->save($sql, $arr);
    }
    function delete($arr)
    {
        $sql = 'DELETE FROM Cart WHERE CartId = :id AND ProductId = :pid';
        return $this->save($sql, $arr);
    }
    function deleteAll($id)
    {
        $sql = 'DELETE FROM Cart WHERE CartId = :id';
        return $this->save($sql, ['id' => $id]);
    }
    function update($arr)
    {
        $sql = 'UPDATE Cart SET Quantity = :qty WHERE CartId = :id AND ProductId = :pid';
        return $this->save($sql, $arr);
    }
    function getCouponByCouponCode($coupon)
    {
        $sql = 'SELECT CouponApply FROM Coupon WHERE BINARY CouponCode = :coupon';
        return $this->fetch($sql, ['coupon' => $coupon]);
    }
}
