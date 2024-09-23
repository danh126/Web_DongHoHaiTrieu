<?php

namespace models;

use PDOException;

class Watch extends Db
{
    function getWatcheLimit($page, $size)
    {
        $sql = 'SELECT * FROM Product LIMIT :index,:size';
        return $this->fetchAll($sql, ['index' => ($page - 1) * $size, 'size' => $size]);
    }

    function getWatches()
    {
        $sql = 'SELECT * FROM Product';
        return $this->fetchAll($sql);
    }

    function countWatches()
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Product';
        return $this->count($sql);
    }

    function getWatchesByCategoryId($id, $page, $size)
    {
        $sql = 'SELECT * FROM Product WHERE CategoryId = :id LIMIT :index, :size';
        return $this->fetchAll($sql, ['id' => $id, 'index' => ($page - 1) * $size, 'size' => $size]);
    }

    function countWatchesByCategoryId($id)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Product WHERE CategoryId = :id';
        return $this->count($sql, ['id' => $id]);
    }

    function getWatch($id)
    {
        $sql = 'SELECT * FROM Product WHERE ProductId = :id';
        return $this->fetch($sql, ['id' => $id]);
    }

    function getWatchesRelation($arr)
    {
        $sql = 'SELECT * FROM Product WHERE ProductId != :id AND CategoryId = :cid';
        return $this->fetchAll($sql, $arr);
    }

    function countSearch($q)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Product WHERE ProductName LIKE :q';
        return $this->count($sql, ['q' => "%$q%"]);
    }

    function search($q, $page, $size)
    {
        $sql = 'SELECT * FROM Product WHERE ProductName LIKE :q LIMIT :index,:size';
        return $this->fetchAll($sql, ['q' => "%$q%", 'index' => ($page - 1) * $size, 'size' => $size]);
    }

    function getWatchByFilter($sql, $arr = null)
    {
        return $this->fetchAll($sql, $arr);
    }

    function countFilter($sql, $arr = null)
    {
        return $this->count($sql, $arr);
    }

    function getWatchAll($page, $size)
    {
        $sql = 'SELECT P.*, B.BrandName, C.CategoryName FROM Product AS P JOIN Brand AS B ON P.BrandId = B.BrandId JOIN Category AS C ON P.CategoryId = C.CategoryId ORDER BY P.ProductId ASC LIMIT :index,:size';
        return $this->fetchAll($sql, ['index' => ($page - 1) * $size, 'size' => $size]);
    }

    function add($arr)
    {
        $sql = 'INSERT INTO Product(CategoryId, BrandId, ProductName, Description, Price, Quantity, ImageUrl) VALUES(:cid,:bid,:name,:desc,:price,:qty,:url)';
        return $this->saveGetId($sql, $arr);
    }

    function update($arr)
    {
        $sql = 'UPDATE Product SET CategoryId = :cid, BrandId = :bid, ProductName = :name, Description = :desc, Price = :price, Quantity = :qty, ImageUrl = :url WHERE ProductId = :id';
        return $this->save($sql, $arr);
    }

    function MinMaxPriceInProduct($query, $arr)
    {
        $sql = "SELECT MIN(Price) AS Min, MAX(Price) AS Max FROM Product WHERE $query";
        return $this->fetch($sql, $arr);
    }

    function updateQuantityInProduct($update, $arr)
    {
        $sql = "UPDATE Product SET Quantity = Quantity $update :qty WHERE ProductId = :pid";
        return $this->save($sql, $arr);
    }

    function delete($id)
    {
        $sql = 'CALL DeleteProduct(:pid)';
        return $this->save($sql, ['pid' => $id]);
    }
}
