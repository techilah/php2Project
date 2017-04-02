<?php

if( isset($_SESSION['cart']) && !$_SESSION['cart']->isEmpty() ) {
    if(isset($_POST['submit']) && $_POST['submit'] === 'Finalize') {
        if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && $_SESSION['cart']->validateOrderData($_POST['fname'], $_POST['lname'],  $_POST['email'])) {
            
            $_SESSION['cart']->placeOrder();
            unset($_SESSION['cart']);
        }
    }
}

if(isset($_POST['submit']) && $_POST['submit'] === 'Add'){
    if (isset($_POST['productid']) && is_numeric($_POST['productid'])){
        if (!isset($_SESSION['cart'])) { 
            $_SESSION['cart'] = new CShoppingCart();
        }
        $_SESSION['cart']->addProduct($_POST['productid'], $_POST['quantity']);
    } 
}

if(isset($_POST['submit']) && $_POST['submit'] === 'Delete'){
    if (isset($_POST['productid']) && is_numeric($_POST['productid'])){
        if (isset($_SESSION['cart'])) { 
            $_SESSION['cart']->deleteProduct($_POST['productid']);
        }
    }
}

if( isset($_SESSION['cart']) && !$_SESSION['cart']->isEmpty() ) {
    $_SESSION['cart']->cartToHtml();
    if((isset($_POST['submit']) && $_POST['submit'] === 'Place Order') || ($_SESSION['cart']->hasCustomerInformation())){
        $_SESSION['cart']->showOrderFormHtml();
    }
} else {
    CError::emptyCart();
}