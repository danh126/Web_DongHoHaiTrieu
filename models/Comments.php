<?php

namespace models;

class Comments extends Db
{
    function addComment($arr)
    {
        $sql = 'INSERT INTO Comments(MemberId, OrderId, ProductId, Content, Score) VALUES(:mid, :orderId, :pid, :content, :score)';
        return $this->save($sql, $arr);
    }

    function countCommentsByProductId($id)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Comments WHERE ProductId = :id';
        return $this->count($sql, ['id' => $id]);
    }

    function getCommentsByProductId($id)
    {
        $sql = 'SELECT Comments.*, M.UserName, M.Avatar FROM Comments JOIN Member AS M ON Comments.MemberId = M.MemberId AND Comments.ProductId = :id';
        return $this->fetchAll($sql, ['id' => $id]);
    }

    function avgScoreByProductId($id)
    {
        $sql = 'SELECT AVG(Score) AS avgScore FROM Comments WHERE ProductId = :id';
        return $this->fetch($sql, ['id' => $id]);
    }
}
