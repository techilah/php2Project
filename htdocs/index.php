<?php

require '/../lib/loader.php';
session_start();

?>

<link rel="stylesheet" type="text/css" href="/css/styles.css" />
<div id="header" class="header_class">
    <?php
        require("/../templates/header.php");
    ?>
    
</div>

<div class="wrapper">
    <div id="products" class="products_listing">
        <?php
            require("/../templates/products.php");
        ?>
    </div>

    <div id="cart" class="shopping_cart">
        <?php
        
            if(isset($_GET['productid'])) {
                require("/../templates/product.php");
            } else {
                require("/../templates/cart.php");
            }
            ?>
    </div>
</div>

