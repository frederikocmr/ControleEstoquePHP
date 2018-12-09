<?php
session_start();

class Dbconnect {
    public function connect(){
         $host = 'localhost';
         $user = 'root';
         $pass = '';
         $db = 'controleestoque';
         $connection = mysqli_connect($host,$user,$pass,$db); 
         return $connection;
     }
}