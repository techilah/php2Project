<?php

require '/../../lib/loader.php';
session_start();

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
