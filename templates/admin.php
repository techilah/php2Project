<?php

if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password']) && !CLogin::isLoggedIn()) {
    if (CLogin::checkLogin($_POST['username'], $_POST['password'])){
        $_SESSION['username'] = $_POST['username'];
    }
}

if(!CLogin::isLoggedIn()) {
    CLogin::displayLoginForm();
}


