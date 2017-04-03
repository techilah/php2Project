<?php

if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']) && !CLogin::isLoggedIn()) {
    if (CLogin::checkLogin($_POST['username'], $_POST['password'])){
        $_SESSION['username'] = $_POST['username'];
    }
}

if(!CLogin::isLoggedIn()) {
    CLogin::displayLoginForm();
    die();
}

if (isset($_POST['submit']) && $_POST['submit'] === 'Edit' && is_numeric($_POST['productid']) && is_numeric($_POST['unitprice']) && $_POST['unitprice'] > 0  && !empty($_POST['productname'])){
    CProductsManager::updateProduct($_POST);
}

if (isset($_POST['submit']) && $_POST['submit'] === 'Add' && !empty($_POST['productname']) && is_numeric($_POST['unitprice']) && $_POST['unitprice'] > 0 && !empty($_FILES['productfile'])){
    CProductsManager::addProduct($_POST, $_FILES);
}

if (isset($_POST['submit']) && $_POST['submit'] === 'Delete' && !empty($_POST['productid']) ){
    CProductsManager::deleteProducts($_POST['productid']);
}


if (isset($_GET['option']) && $_GET['option'] === 'view'){
    CProductsManager::productsListToAdmin();
    die();
}

if (isset($_GET['option']) && $_GET['option'] === 'add'){
    CProductsManager::addProductFormToHtml();
    die();
}

if (isset($_GET['option']) && $_GET['option'] === 'delete'){
    CProductsManager::productsListToAdminDelete();
    die();
}

if(isset($_GET['option']) && $_GET['option'] === 'edit' && isset($_GET['productid']) && is_numeric($_GET['productid'])){
    if ($prod = CProductsManager::validateProductID($_GET['productid'])) {
        $product = new CProduct($prod);
        $product->productToHtmlInAdmin();
        die();
    }

}


CAdmin::displayAdminOption();
    




