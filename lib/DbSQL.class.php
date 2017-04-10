<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbSQL
 *
 * @author tudor
 */
class DbSQL {
    
    private static $_instance;
    private $conn;
    private $statement;
    
    private function __construct(){
        $this->conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASS, DB_NAME);        
    }
    
    public static function init(){
        if(self::$_instance == null){
            self::$_instance = new self();
        }
        return self::$_instance;            
    }
    
    public function selectArray($sql){
        $result = $this->conn->query($sql);
        $retval = [];
        
        while ($row = $result->fetch_assoc()){
            $retval[] = $row;
        }
        
        return $retval;
    }
    
    function escapeString($string){
        return $this->conn->real_escape_string($string);
    }
    
    public function updateQuery($sql){
        $result = $this->conn->query($sql);

        return $this->conn->affected_rows;
    }
    
    public function begin_transaction() {
        return $this->conn->begin_transaction();
    }
    
    public function commit() {
        return $this->conn->commit();
    }
    
    public function rollback(){
        return $this->conn->rollback();
    }
    
}
