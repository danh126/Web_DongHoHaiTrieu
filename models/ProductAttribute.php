<?php

namespace models;

class ProductAttribute extends Db
{
    function add($arr)
    {
        $sql = 'CALL AddProductAttribute(:pid, :attrId, :value)';
        return $this->save($sql, $arr);
    }
}
