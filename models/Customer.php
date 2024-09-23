<?php

namespace models;

class Customer extends Db
{
    function add($crr)
    {
        $sql = 'INSERT INTO Customer(FullName, Email, Phone, Address) VALUES(:fname, :eml,:phone, :address)';
        return $this->saveGetId($sql, $crr);
    }

    function getCustomer($arr)
    {
        $sql = 'SELECT CustomerId FROM Customer WHERE Email = :eml AND Phone = :phone';
        return $this->fetch($sql, $arr);
    }
}
