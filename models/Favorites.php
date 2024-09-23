<?php

namespace models;

class Favorites extends Db
{
    function addFavorite($arr)
    {
        $sql = 'CALL AddFavorites(:mid, :pid)';
        return $this->save($sql, $arr);
    }

    function getFavoritesByMemberId($id)
    {
        $sql = 'SELECT F.ProductId, P.ProductName, P.ImageUrl, P.Price FROM Favorites AS F JOIN Product AS P ON F.ProductId = P.ProductId AND F.MemberId = :mid';
        return $this->fetchAll($sql, ['mid' => $id]);
    }

    function countFavoritesByMemberId($id)
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Favorites WHERE MemberId = :mid';
        return $this->count($sql, ['mid' => $id]);
    }

    function deleteFavorite($arr)
    {
        $sql = 'DELETE FROM Favorites WHERE MemberId = :mid AND ProductId = :pid';
        return $this->save($sql, $arr);
    }
}
