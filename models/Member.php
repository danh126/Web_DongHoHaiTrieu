<?php

namespace models;

class Member extends Db
{
    function getMembers()
    {
        $sql = 'SELECT MemberId, Email, UserName, Gender FROM Member';
        return $this->fetchAll($sql);
    }

    function getMemberByMemberId($id)
    {
        $sql = 'SELECT MemberId, Email, UserName, Gender FROM Member WHERE MemberId = :id';
        return $this->fetch($sql, ['id' => $id]);
    }

    function getRoleByMember($id)
    {
        $sql = 'CALL GetRoleByMember(:mid)';
        return $this->fetchAll($sql, ['mid' => $id]);
    }

    function addRoleByMember($arr)
    {
        $sql = 'CALL AddMemberInRole(:mid, :rid)';
        return $this->save($sql, $arr);
    }
}
