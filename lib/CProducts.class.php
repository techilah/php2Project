<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CProduct
 *
 * @author tudor
 */
class CProduct {
    private $productID;
    private $productName;
    private $productDescription;
    private $productFilePath;
    
    function __construct(array $product){
        $this->productID          = $product['productid'];
        $this->productName = $product['productname'];
        $this->productDescription = $product['productdescription'];
        $this->productFilePath    = $product['productfilepath'];
    }
    
    function productToHtml(){
        echo "<center>";
        
        echo "<img src=\"/images/{$this->productFilePath}\"  height=\"100\" width=\"100\">";
        echo "<b>{$this->productName}</b><br/><br/>";
        echo "{$this->productDescription}<br/><br/>";
        
        echo "<form method=\"post\" action=\"index.php\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"$this->productID\">";
        echo "Quantity: <input type=\"text\" size=\"4\" name=\"quantity\" value=\"1\"><br/><br/>";
        echo "<input id=\"add\" type=\"submit\" name=\"submit\" value=\"Add\">";
        echo "</form>";
        
        echo "</center>";
    }

}
