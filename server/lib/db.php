<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database {
    
    static $instance;
    public static function getInstance(){
        if(!isset(self::$instance)){
            $host="localhost";
            $user="root";
            $password="";
            $database="mcar";
            self::$instance=  mysqli_connect($host, $user, $password, $database);
            self::$instance->set_charset('utf8');
            self::$instance->query("SET timezone ='+8:00'");
        }
        return self::$instance;
    }
}