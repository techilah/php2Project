<?php

/**
 * Description of CShoppingCart
 *
 * @author tudor
 */
class CShoppingCart {
    
    private $products = array();
    private $firstName = '';
    private $lastName = '';
    private $email = '';
    
    function addProduct($idProduct, $quantity){
        
        
        if (array_key_exists($idProduct, $this->products)) {
            if($this->products[$idProduct]->setQuantity($quantity)){
                return true;
            } else {
                return false;
            }
        } else {
            if ($productArray = CProductsManager::validateProductID($idProduct)) {
                try {
                    $this->products[$idProduct] = new CProduct($productArray,$quantity);
                } catch (Exception $e) {
                }
                return true;
            } else {
                return false;
            }
        }
    }
    
    function deleteProduct($idProduct){
        if (array_key_exists($idProduct, $this->products)) {
            unset($this->products[$idProduct]);
        }
    }
    
    function cartToHtml(){
        if(!empty($this->products)) {
            foreach ($this->products as $product) {
                $product->productToHtmlInCart();
            }
            echo "<center><form method=\"post\" action=\"index.php\">";
            echo "<br/><input id=\"placeorder\" type=\"submit\" name=\"submit\" value=\"Place Order\">";
            echo "</form></center>";
        }
    }
    
    function showOrderFormHtml(){
        echo "<center><form method=\"post\" action=\"index.php\">";
        echo "First name: <input type=\"text\" name=\"fname\" value=\"{$this->firstName}\"><br/>";
        echo "Last name: <input type=\"text\" name=\"lname\" value=\"{$this->lastName}\"><br/>";
        echo "Email: <input type=\"text\" name=\"email\" value=\"{$this->email}\"><br/>";
        echo "<input id=\"finalize\" type=\"submit\" name=\"submit\" value=\"Finalize\">";
        echo "</form></center>";
    }
    
    function productIsInCart($idProduct){
        if (array_key_exists($idProduct, $this->products)) {
            return true;
        } else {
            return false;
        }
    }
    
    function getProductFromCart($idProduct){
        if (array_key_exists($idProduct, $this->products)) {
            return $this->products[$idProduct];
        } else {
            return false;
        }
    }
    
    function validateOrderData($firstName, $lastName, $email){
        
        $ok = true;
        if(!empty($firstName) && strlen($firstName) > 1 ){
            $this->firstName = $firstName;
        } else {
            $ok = false;
            $this->firstName = '';
        }
        if(!empty($lastName) && strlen($lastName) > 1 ){
            $this->lastName = $lastName;
        }  else {
            $ok = false;
            $this->lastName = '';
        }
        if(!$this->email = filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->email = '';
            $ok = false;
        }
        return $ok;
    }
    
    function hasCustomerInformation(){
        if (!empty($this->firstName) || !empty($this->lastName) || !empty($this->email)){
            return true;
        } else {
            return false;
        }
    }
    
    function placeOrder(){
        //sent an email;
        echo '<script>alert("Order was successfuly placed!!!");</script>';
    }
    
    function isEmpty(){
        return empty($this->products) ? true : false;

    }
}
