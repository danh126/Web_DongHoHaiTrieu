<?php

namespace models;

use PDOException;
use PDOStatement;

class Auth extends Db
{
    function add($arr)
    {
        $arr['pwd'] = md5($arr['pwd']);
        $sql = 'CALL AddMember(:id,:eml,:user,:gender,:pwd)';
        return $this->save($sql, $arr);
    }

    function checkProfileMember($check)
    {
        $sql = 'SELECT MemberId FROM Member WHERE Phone = :phone AND MemberId = :id';
        return $this->fetch($sql, $check);
    }
    function checkEmailLogin($arr)
    {
        $sql = 'SELECT MemberId, Password FROM Member WHERE Email = :eml';
        return $this->fetch($sql, $arr);
    }
    function sessionLogin($arr)
    {
        $sql = 'INSERT INTO Session(SessionId, MemberId) VALUES(:id, :mid)';
        return $this->save($sql, $arr);
    }
    function getMemberInSession($id)
    {
        $sql = 'SELECT M.MemberId, M.UserName, M.Email, M.Gender, M.FullName, M.Phone, M.Address, M.Avatar, M.DateCreat FROM Session AS S JOIN Member AS M ON S.MemberId = M.MemberId AND M.MemberId = :mid';
        return $this->fetch($sql, ['mid' => $id]);
    }
    function sessionLogout($id)
    {
        $sql = 'DELETE FROM Session WHERE MemberId = :mid';
        return $this->save($sql, ['mid' => $id]);
    }
    function getAdmin($arr)
    {
        $sql = 'CALL GetAdmin(:eml, :pwd)';
        return $this->fetch($sql, $arr);
    }
    function uploadAvatar($arr)
    {
        $sql = 'UPDATE Member SET Avatar = :url WHERE MemberId = :id';
        return $this->save($sql, $arr);
    }

    function update($arr)
    {
        $sql = 'UPDATE Member SET UserName = :username, FullName = :fname, Phone = :phone, Address = :address WHERE MemberId = :id';
        return $this->save($sql, $arr);
    }

    function checkOldPass($arr)
    {
        $sql = 'SELECT MemberId FROM Member WHERE Password = :oldPass AND MemberId = :id';
        return $this->fetch($sql, $arr);
    }
    function changePass($arr)
    {
        $sql = 'UPDATE Member SET Password = :pass WHERE MemberId = :id';
        return $this->save($sql, $arr);
    }
}
