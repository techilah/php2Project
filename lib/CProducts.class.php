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
    private $productDescription;
    private $productFilePath;
    
    function __construct(array $product){
        $productID          = $product['productid'];
        $productDescription = $product['description'];
        $productFilePath    = $product['productfilepath'];
    }

}
