<?php

namespace models;

class Attribute extends Db
{
    function getAttributeByProductId($id)
    {
        $sql = 'SELECT Attribute.*, Value FROM Attribute LEFT JOIN ProductAttribute ON Attribute.AttributeId = ProductAttribute.AttributeId AND ProductAttribute.ProductId = :id';
        return $this->fetchAll($sql, ['id' => $id]);
    }

    function getAttribute()
    {
        $sql = 'SELECT * FROM Attribute';
        return $this->fetchAll($sql);
    }
}
