<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CError
 *
 * @author tudor
 */
class CError {
    
    static function displayError(){
        echo "<center><img src=\"/images/error.jpg\"></center>";
    }
    
    static function emptyCart(){
        echo "EMPTY CART!!";
    }
}
