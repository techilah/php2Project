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
    private $quantity;
    
    function __construct($product = array(), $quantity = 1){
        if(!empty($product)) {
            $this->productID          = $product['productid'];
            $this->productName = $product['productname'];
            $this->productDescription = $product['productdescription'];
            $this->productFilePath    = $product['productfilepath'];
            $this->quantity = 1;
        }
    }
    
        
    function setQuantity($quantity) {
        if (is_numeric($quantity) && (int)$quantity > 0){
            $this->quantity = (int)$quantity;
            return true;
        } else {
            return false;
        }
    }
    
    function productToHtmlInProductPage(){
        echo "<center>";
        
        echo "<img src=\"/images/{$this->productFilePath}\"  height=\"100\" width=\"100\">";
        echo "<b>{$this->productName}</b><br/><br/>";
        echo "{$this->productDescription}<br/><br/>";
        
        echo "<form method=\"post\" action=\"index.php\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"$this->productID\">";
        echo "Quantity: <input type=\"text\" size=\"4\" name=\"quantity\" value=\"{$this->quantity}\"><br/><br/>";
        echo "<input id=\"add\" type=\"submit\" name=\"submit\" value=\"Add\">";
        echo "</form>";
        
        echo "</center>";
    }
    
    function productToHtmlInCart(){
        echo "<center>";
        
        echo "<img src=\"/images/{$this->productFilePath}\"  height=\"100\" width=\"100\">";
        echo "<b><a href=\"index.php?productid={$this->productID}\"><b>{$this->productName}</b></a></b>";
        echo "  X  {$this->quantity}";
        
        echo "<form method=\"post\" action=\"index.php\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"$this->productID\">";
        echo "<input id=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete\">";
        echo "</form>";
        
        echo "</center>";
    }


}
