<?php

namespace models;

use PDO;
use PDOException;

abstract class Db
{
    protected $pdo;
    function __construct()
    {
        try {
            $options = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_FOUND_ROWS => TRUE, PDO::ATTR_EMULATE_PREPARES => FALSE];
            $host = 'localhost';
            $dbname = 'Watch';
            $username = 'root';
            $password = '';
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
        } catch (PDOException $v) {
            var_dump($v);
        }
    }
    protected function count($sql, $arr = null)
    {
        $row = $this->fetch($sql, $arr);
        if ($row != null) {
            return $row['Total'];
        }
        return 0;
    }

    function fetchAll($sql, $arr = null)
    {
        if ($arr != null) {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($arr);
        } else {
            $stmt = $this->pdo->query($sql);
        }
        $arr = $stmt->fetchAll();
        $stmt->closeCursor();
        return $arr;
    }

    function fetch($sql, $arr = null)
    {
        if ($arr != null) {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($arr);
        } else {
            $stmt = $this->pdo->query($sql);
        }
        $row = null;
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
        }
        $stmt->closeCursor();
        return $row;
    }

    function save($sql, $arr)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arr);
        $ret = $stmt->rowCount();
        return $ret;
    }

    function saveGetId($sql, $arr)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($arr);
        $id = $this->pdo->lastInsertId(); //trả về id
        return $id;
    }

    function __destruct()
    {
        unset($this->pdo);
    }
}
