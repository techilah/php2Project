<?php

/**
 * Description of CLogin
 *
 * @author tudor
 */
class CLogin {
    
    static function isLoggedIn (){
        if (isset($_SESSION['username'])) {
            return $_SESSION['username'];
        } else {
            return false;
        }
    }
    
    static function displayLoginForm(){
        echo "<center><form method=\"post\" action=\"\"><br/><br/><br/>";
        echo "Username: <input type=\"text\" name=\"username\" value=\"\"><br/><br/>";
        echo "Password: <input type=\"password\" name=\"password\" value=\"\"><br/><br/>";
        echo "<input id=\"login\" type=\"submit\" name=\"login\" value=\"Login\"><br/>";
        echo "</form></center>";
    }
    
    static function checkLogin($username, $password){
        $obj = DbSql::init();        
        
        $sql = "SELECT * FROM users where username = '" . $obj->escapeString($_POST['username']) . "' and password = '" . $obj->escapeString($_POST['password']) . "'";
        
        $result = $obj->selectArray($sql);
        if (count($result) === 1) {
            return true;
        } else {
            return false;
        } 
    }
    
    static function logout(){
        if (isset($_SESSION['username'])) {
            unset($_SESSION['username']);
        }
    }
}
