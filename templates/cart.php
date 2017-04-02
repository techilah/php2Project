<?php

if(isset($_POST['submit']) && $_POST['submit'] === 'Add'){
    if (isset($_POST['productid']) && is_numeric($_POST['productid'])){
        if (isset($_SESSION['cart']) && array_key_exists($_POST['productid'], $_SESSION['cart'])){
            $productInCart = new CProduct();
            $productInCart = unserialize($_SESSION['cart'][$_POST['productid']]);
            if (!$productInCart->setQuantity($_POST['quantity'])) {
                CError::displayError();
            } else {
                $_SESSION['cart'][$_POST['productid']] = serialize($productInCart);
            }
        } else {
            if ($prod = CProductsManager::validateProductID($_POST['productid'])){
                $_SESSION['cart'][$_POST['productid']] = serialize(new CProduct($prod, $_POST['quantity']));
            }
        }
    } 
}

if( isset($_SESSION['cart']) && !empty($_SESSION['cart']) ) {
    foreach ($_SESSION['cart'] as $cartProductsSerialized){
        $cartProduct = unserialize($cartProductsSerialized);
        $cartProduct->productToHtmlInCart();
    }
} else {
    CError::emptyCart();
}