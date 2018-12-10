<?php

/*
 *  Copyright 2018, Frederiko Cesar Moreira Ribeiro
 *  GitHub: https://github.com/frederikocmr
 */


class ProdGroupDAO extends Dbconnect {

    private $conn;

    public function __construct() {
        $dbcon = new parent();
        $this->conn = $dbcon->connect();
    }

    public function select($table, $where = '', $other = '') {
        if ($where != '') {
            $where = 'where ' . $where;
        }
        $sql = " SELECT * FROM  " . $table . " " . $where . " " . $other;
        $sele = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        return $sele;
    }

    public function insertProdGroup($name, $description) {

        $query =  "INSERT INTO comments (name, comment) VALUES ('{$name}', '{$description}')";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_insert_id($this->conn);
    }



}
