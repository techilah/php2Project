<?php

if (isset($_GET['productid']) && is_numeric($_GET['productid'])){
        if (isset($_SESSION['cart']) && array_key_exists($_GET['productid'], $_SESSION['cart'])){
            $productInCart = new CProduct();
            $productInCart = unserialize($_SESSION['cart'][$_GET['productid']]);
            $productInCart->productToHtmlInProductPage();
        } else if ($productDetails = CProductsManager::validateProductID($_GET['productid'])){
            
            //    print_r($productDetails);
            $product = new CProduct($productDetails);
            $product->productToHtmlInProductPage();
        } else {
                CError::displayError();
        }
} else {
    CError::displayError();
}

