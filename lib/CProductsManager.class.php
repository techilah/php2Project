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
            $htmlCode .= "  <a href=\"index.php?productid={$productInfo['productid']}\"><b>" . htmlentities($productInfo['productname']) . "</b></a>   " . $productInfo['unitprice'] . " " . CURRENCY . "<br/><br/>";
            $htmlCode .= " " . htmlentities($productInfo['productdescription']) . "<br/><br/>";
        }
        return $htmlCode;        
    }
    
    static function productsListToAdmin(){
        $products = self::getAllProductsFromDB();
        
        echo "<center><br/><b>Available products:</b><br/><br/>";
        foreach ($products as $productInfo) {
            echo "  <a href=\"index.php?option=edit&productid={$productInfo['productid']}\">";
            echo "<b>" . htmlentities($productInfo['productname']) . "</b></a>   " . $productInfo['unitprice'] . " " . CURRENCY;
            echo " " . htmlentities($productInfo['productdescription']) . "<br/><br/>";
        }
        
        echo "<a href=\"index.php\">Back</a>";
        return true;
    }
    
    
    static function validateProductID($productID) {
        $obj = DbSql::init();        
        
        $sql = "SELECT * FROM PRODUCTS where productid=" . (int)$productID;
        
        $product = $obj->selectArray($sql);
        if (count($product) !== 1) {
            return false;
        }
        return $product[0];
        
    }
    
    static function updateProduct($product = array()){
        if (!empty($product) && self::validateProductID($product['productid'])) {
            $obj = DbSQL::init();
            $sql = "UPDATE 
                        products 
                    SET
                        products.productname = '" . $obj->escapeString($product['productname']) . "',
                        products.unitprice= " . $product['unitprice'] . ",
                        products.productdescription = '" . $obj->escapeString($product['productdescription']) . "'    
                    WHERE products.productid = " . $product['productid'];
            $obj->updateQuery($sql);
            
        }
    }
    
    static function addProductFormToHtml() {
        echo "<center>";
        echo "<form method=\"post\" action=\"index.php?option=view\" enctype=\"multipart/form-data\">";
        echo "Product name:<input type=\"text\" name=\"productname\" value=\"\"><br/>";
        echo "Unit price:<input type=\"text\" size=5 name=\"unitprice\" value=\"\"> " . CURRENCY . "<br/>";
        echo "Product description: <input type=\"text\" name=\"productdescription\" value=\"\"><br/>";
        echo "Product file: <input type=\"file\" name=\"productfile\" if=\"productfile\"><br/>";
        echo "<input id=\"add\" type=\"submit\" name=\"submit\" value=\"Add\">";
        echo "</form>";
        echo "<a href=\"index.php\">Back</a>";
        echo "</center>";
    }
    
    static function addProduct($product, $file, $fromXML = false){
        
        $obj = DbSQL::init();
        
        if(is_uploaded_file($file['productfile']['tmp_name']) && !$fromXML) {
            $path_parts = pathinfo($file['productfile']['name']);
            $extension = $path_parts['extension'];
            $filename = uniqid() . "." . $extension;
            $filepath = __DIR__ . "\..\htdocs\images\\" . $filename;
            
            if (move_uploaded_file($file['productfile']['tmp_name'], $filepath)){
                if (!empty($product)) {

                    $sql = "INSERT INTO 
                                products 
                            (products.productname, products.unitprice, products.productdescription, products.productfilepath) 
                            values ('" . $obj->escapeString($product['productname']) . "', " . $product['unitprice'] . ", '" . $obj->escapeString($product['productdescription']) . "','" . $obj->escapeString($filename) . "')";
                    


                }
            }
            
        } else {
            $sql = "INSERT INTO 
                        products 
                    (products.productname, products.unitprice, products.productdescription, products.productfilepath) 
                    values ('" . $obj->escapeString($product['productname']) . "', " . $product['unitprice'] . ", '" . $obj->escapeString($product['productdescription']) . "','" . $obj->escapeString(DEFAULT_IMAGE_NAME) . "')";
                    
        }
        
        $obj->updateQuery($sql);
        
    }
    
            
    static function productsListToAdminDelete(){
        $products = self::getAllProductsFromDB();
        
        echo "<center><br/><b>Available products:</b><br/><br/>";
        echo "<form method=\"post\" action=\"index.php?option=view\">";
        foreach ($products as $productInfo) {
            echo "<input type=\"checkbox\" name=\"productid[]\" value=\"{$productInfo['productid']}\"> {$productInfo['productname']} <br/>";
        }
        echo "<input id=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete\">";
        echo "</form>";
        
        echo "<a href=\"index.php\">Back</a>";
        return true;
    }  
    
    static function deleteProducts($productIDs = array()){
        foreach ($productIDs as $id){
            if (!is_numeric($id)){
                return false;
            }
        }
        
        $sql = "DELETE FROM 
                    products 
                WHERE 
                    products.productid in (" . implode(",", $productIDs) . ")";
        
         $obj = DbSQL::init();
         $obj->updateQuery($sql);
    }
    
    static function productsToXML(){
        $products = self::getAllProductsFromDB();
        
        //print_r($products);
        $xml = new SimpleXMLElement('<?xml version="1.0"?><products></products>');
        foreach ($products as $key => $product){
            $xml->addChild('product');
            foreach ($product as $k => $v){
                $xml->product[$key]->addChild($k, $v);
            }
        }
        
        return $xml;        
    }
    
    static function displayXMLForm(){
        echo "<center>";
        echo "<form method=\"post\" action=\"index.php\" enctype=\"multipart/form-data\">";
        echo "Product file: <input type=\"file\" name=\"productsxml\" if=\"productfile\"><br/>";
        echo "<input id=\"import\" type=\"submit\" name=\"submit\" value=\"Import\">";
        echo "</form>";
        echo "<a href=\"index.php\">Back</a>";
        echo "</center>";
    }
    
    static function processXML($files){
        
        try {
            $xml = simplexml_load_file($files['productsxml']['tmp_name']);
        } catch (Exception $e) {
            return;
        }
        
        $obj = DbSql::init();
        $obj->begin_transaction();
        $success = true;
        
        foreach ($xml->children() as $product){
            $product = (array)$product;
            if(self::arrayHasEnoughProductData($product)){
                if(isset($product['productid'])){ 
                    if (self::validateProductID($product['productid'])){
                    } else {
                        $success = false;
                    }
                } else {
                    self::addProduct($product, null, true);
                }
            } else {
                $success = false;
            }
        
        }
        
        if ($success) {
            $obj->commit();
        } else {
            $obj->rollback();
        }
        
    }
    
    static function arrayHasEnoughProductData($product){
        if(!isset($product['productname']) || empty($product['productname'])){
            return false;
        }
        if(!isset($product['productdescription']) || empty($product['productdescription'])){
            return false;
        }
        if(!isset($product['unitprice']) || !is_numeric($product['unitprice']) || $product['unitprice'] <= 0){
            return false;
        }
        
        return true;
    }
    
    
}
