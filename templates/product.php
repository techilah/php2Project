<?php

if (isset($_GET['productid']) && is_numeric($_GET['productid'])){
        if (isset($_SESSION['cart']) && $_SESSION['cart']->productIsInCart($_GET['productid'])){
            $_SESSION['cart']->getProductFromCart($_GET['productid'])->productToHtmlInProductPage();
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

