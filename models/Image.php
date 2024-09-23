<?php

namespace models;

class Image extends Db
{
    function add($arr)
    {
        $sql = 'INSERT INTO Image(ImageUrl, ImageType, ImageSize, ProductId) VALUES(:url, :type, :size, :pid)';
        return $this->save($sql, $arr);
    }
    function getImagesByProductId($id)
    {
        $sql = 'SELECT Image.*, Product.ProductId FROM Image JOIN Product ON Image.ProductId = Product.ProductId AND Image.ProductId = :id';
        return $this->fetchAll($sql, ['id' => $id]);
    }
}
