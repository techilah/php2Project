<?php

if (is_numeric($_GET['productid']) && ($productDetails = CProductsManager::validateProductID($_GET['productid']))) {
//    print_r($productDetails);
    $product = new CProduct($productDetails);
    $product->productToHtmlinProductPage();
} else {
    CError::displayError();
}

