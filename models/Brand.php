<?php

namespace models;

class Brand extends Db
{
    function getBrandsByProduct()
    {
        $sql = 'SELECT Brand.BrandId, Brand.BrandName, COUNT(*) AS Total FROM Product JOIN Brand ON Product.BrandId = Brand.BrandId GROUP BY Brand.BrandId, Brand.BrandName';
        return $this->fetchAll($sql);
    }

    function getBrands()
    {
        $sql = 'SELECT * FROM Brand';
        return $this->fetchAll($sql);
    }

    function getBrandsLimit($page, $size)
    {
        $sql = 'SELECT Brand.BrandId, Brand.BrandName, Brand.LogoUrl FROM Brand LIMIT :index, :size';
        return $this->fetchAll($sql, ['index' => ($page - 1) * $size, 'size' => $size]);
    }

    function countBrands()
    {
        $sql = 'SELECT COUNT(*) AS Total FROM Brand';
        return $this->count($sql);
    }

    function getBrandByCategory($id)
    {
        $sql = 'SELECT Brand.BrandId, Brand.BrandName, COUNT(*) AS Total FROM Product JOIN Brand ON Product.BrandId = Brand.BrandId WHERE Product.CategoryId = :id GROUP BY Brand.BrandId, Brand.BrandName';
        return $this->fetchAll($sql, ['id' => $id]);
    }

    function getBrandBySearch($q)
    {
        $sql = 'SELECT Brand.BrandId, Brand.BrandName, COUNT(*) AS Total FROM Product JOIN Brand ON Product.BrandId = Brand.BrandId WHERE Product.ProductName LIKE :q GROUP BY Brand.BrandId, Brand.BrandName';
        return $this->fetchAll($sql, ['q' => "%{$q}%"]);
    }

    function update($arr)
    {
        $sql = 'UPDATE Brand SET BrandName = :name, LogoUrl = :logoUrl WHERE BrandId = :id';
        return $this->save($sql, $arr);
    }

    function add($arr)
    {
        $sql = 'INSERT INTO Brand(BrandName,LogoUrl) VALUES(:name,:logoUrl)';
        return $this->save($sql, $arr);
    }

    function delete($id)
    {
        $sql = 'CALL DeleteBrand(:id)';
        return $this->save($sql, ['id' => $id]);
    }
}
