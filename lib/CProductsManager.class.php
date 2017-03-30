<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CProductsManager
 *
 * @author tudor
 */
class CProductsManager {
    
    static function getAllProductsFromDB(){
        
        $obj = DbSql::init();        
        
        $sql = "SELECT * FROM PRODUCTS";
        
        $products = $obj->selectArray($sql);
        
        return $products;
        
    }
    
    static function productsListToHtml(){
        $products = self::getAllProductsFromDB();
        
        $htmlCode = "";
        
        foreach ($products as $productInfo) {
            $htmlCode .= "<img src=\"/images/{$productInfo['productfilepath']}\"  height=\"42\" width=\"42\">";
            $htmlCode .= "  <a href=\"index.php?productid={$productInfo['productid']}\"><b>{$productInfo['productname']}</b></a><br/><br/>";
            $htmlCode .= " {$productInfo['productdescription']}<br/><br/>";
        }
        return $htmlCode;        
    }
    
    static function validateProductID($productID) {
        $obj = DbSql::init();        
        
        $sql = "SELECT * FROM PRODUCTS where productid={$productID}";
        
        $product = $obj->selectArray($sql);
        if (count($product) !== 1) {
            return false;
        }
        return $product[0];
        
    }
    
    
    
}
