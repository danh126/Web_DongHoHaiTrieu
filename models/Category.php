<?php

namespace models;

class Category extends Db
{
    function getCategories()
    {
        $sql = 'SELECT * FROM Category';
        return $this->fetchAll($sql);
    }

    function getCategoryById($id)
    {
        $sql = 'SELECT * FROM Category WHERE CategoryId = :id';
        return $this->fetch($sql, ['id' => $id]);
    }

    function edit($arr)
    {
        $sql = 'UPDATE Category SET CategoryName = :name, Description = :desc, CategoryUrl = :url WHERE CategoryId = :id';
        return $this->save($sql, $arr);
    }

    function add($arr)
    {
        $sql = 'INSERT INTO Category(CategoryName,Description,CategoryUrl) VALUES(:name,:desc,:url)';
        return $this->save($sql, $arr);
    }

    function delete($id)
    {
        $sql = 'CALL DeleteCategory(:id)';
        return $this->save($sql, ['id' => $id]);
    }
}
