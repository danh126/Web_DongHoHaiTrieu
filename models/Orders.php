<?php

namespace models;

use PDOException;

class Orders extends Db
{
    function addOrder($orr, $fieldName)
    {
        $sql = "INSERT INTO Orders(OrderId, $fieldName, Note, OrderDiscount, TotalAmount) VALUES (:id, :cusId, :note, :od, :total)";
        return $this->save($sql, $orr);
    }

    function addDetails($odrr)
    {
        $sql = 'INSERT INTO OrderDetails(OrderId, ProductId, Quantity, Price) VALUES (:oid, :pid, :qty, :price)';
        return $this->save($sql, $odrr);
    }

    function getOrderByOrderId($id)
    {
        $sql = 'CALL GetOrderByOrderId(:id)';
        return $this->fetchAll($sql, ['id' => $id]);
    }

    function getOrders($page, $size)
    {
        $sql = "CALL GetOrders(:idx, :size)";
        return $this->fetchAll($sql, ['idx' => ($page - 1) * $size, 'size' => $size]);
    }

    function countOrders()
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Orders';
        return $this->count($sql);
    }

    function getStatus()
    {
        $sql = "SELECT * FROM StatusOrders";
        return $this->fetchAll($sql);
    }

    function updateStatus($arr)
    {
        $sql = 'UPDATE Orders SET Status = :status WHERE OrderId = :id';
        return $this->save($sql, $arr);
    }

    function deleteOrders($id)
    {

        $sql = 'CALL DeleteOrders(:id)';
        return $this->save($sql, ['id' => $id]);
    }

    function getOrdersByMemberId($id)
    {
        $sql = 'CALL GetOrdersByMemberId(:id)';
        return $this->fetchAll($sql, ['id' => $id]);
    }

    function countOrdersByMemberId($id)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Orders WHERE MemberId = :id';
        return $this->count($sql, ['id' => $id]);
    }
}
