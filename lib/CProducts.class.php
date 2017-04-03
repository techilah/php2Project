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
    private $unitPrice;
    private $productFilePath;
    private $quantity;
    
    function __construct($product = array(), $quantity = 1){
        if(!empty($product)) {
            if($this->setQuantity($quantity)) {
                $this->productID          = $product['productid'];
                $this->productName = $product['productname'];
                $this->productDescription = $product['productdescription'];
                $this->productFilePath    = $product['productfilepath'];
                $this->quantity = $quantity;
                $this->unitPrice = $product['unitprice'];
            } else {
                throw new InvalidArgumentException('$foo should consists of letters only');
            }
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
        echo "Quantity: <input type=\"text\" size=\"4\" name=\"quantity\" value=\"{$this->quantity}\"><br/>";
        echo "Price: ". $this->unitPrice * $this->quantity . " " . CURRENCY . "<br/><br/>";
        echo "<input id=\"add\" type=\"submit\" name=\"submit\" value=\"Add\">";
        echo "</form>";
        
        echo "</center>";
    }
    
    function productToHtmlInAdmin(){
        echo "<center>";
        echo "<form method=\"post\" action=\"index.php?option=view\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"$this->productID\">";
        echo "Product name:<input type=\"text\" name=\"productname\" value=\"{$this->productName}\"><br/>";
        echo "Unit price:<input type=\"text\" size=5 name=\"unitprice\" value=\"{$this->unitPrice}\"> " . CURRENCY . "<br/>";
        echo "Product description: <input type=\"text\" name=\"productdescription\" value=\"{$this->productDescription}\"><br/>";
        echo "<input id=\"edit\" type=\"submit\" name=\"submit\" value=\"Edit\">";
        echo "</form>";
        echo "</center>";
    }
    
    function productToHtmlInCart(){
        echo "<center>";
        
        echo "<img src=\"/images/{$this->productFilePath}\"  height=\"100\" width=\"100\">";
        echo "{$this->quantity} X <b><a href=\"index.php?productid={$this->productID}\"><b>{$this->productName}</b></a></b>";
        echo "  ". $this->unitPrice * $this->quantity . " " . CURRENCY;
        
        echo "<form method=\"post\" action=\"index.php\">";
        echo "<input type=\"hidden\" name=\"productid\" value=\"$this->productID\">";
        echo "<input id=\"delete\" type=\"submit\" name=\"submit\" value=\"Delete\">";
        echo "</form>";
        
        echo "</center>";
    }
    
    function toEmail(){
        return "{$this->quantity} X {$this->productName} (id: {$this->productID}) => " . $this->unitPrice * $this->quantity . " " . CURRENCY . "\n\n";
    }


}
