<?php

require '/../../lib/loader.php';
session_start();

if(CLogin::isLoggedIn() && isset($_GET['option']) && $_GET['option'] === 'export'){
    $xml = CProductsManager::productsToXML();
    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename="products.xml"');

    echo $xml->asXML();
    exit();

}

?>

<link rel="stylesheet" type="text/css" href="/css/styles.css" />
<div id="header" class="header_class">
    <?php
        require("/../../templates/header.php");
    ?>
    
</div>

<div id="admin" class="admin_class">
    <?php
        require("/../../templates/admin.php");
    ?>
    
</div>
