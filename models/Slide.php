<?php

namespace models;

class Slide extends Db
{
    function getSlides()
    {
        $sql = 'SELECT * FROM Slide';
        return $this->fetchAll($sql);
    }
}
