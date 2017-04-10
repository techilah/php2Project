<?php

/**
 * Description of CAdmin
 *
 * @author tudor
 */
class CAdmin {
    static function displayAdminOption(){
        echo "<center>";
        echo "<b>OPTIONS:</b><br/><br/>";
        echo "<a href=\"index.php?option=view\"><b>View products</b></a></b><br/><br/>";
        echo "<a href=\"index.php?option=add\"><b>Add product</b></a></b><br/><br/>";
        echo "<a href=\"index.php?option=delete\"><b>Delete product</b></a></b><br/><br/>";
        echo "<a href=\"index.php?option=import\"><b>Import products XML</b></a></b><br/><br/>";
        echo "<a href=\"index.php?option=export\"><b>Export products XML</b></a></b><br/><br/>";
        echo "<a href=\"index.php?option=logout\"><b>Logout</b></a></b><br/><br/>";
        echo "</center>";
    }
}
