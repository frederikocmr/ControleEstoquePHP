<?php

/*
 *  Copyright 2018, Frederiko Cesar Moreira Ribeiro
 *  GitHub: https://github.com/frederikocmr
 */

include 'dbconnect.php';

class UserDAO extends Dbconnect {

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

    public function insertUser($username, $email, $user_type, $password) {

        $query = " INSERT INTO users (username, email, user_type, password) "
                . " VALUES('$username', '$email', '$user_type', '$password') ";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_insert_id($this->conn);
    }

    // Retorna os dados do usuário de acordo com ID informado
    public function getUserById($id) {
        $query = " SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($this->conn, $query);

        $user = mysqli_fetch_assoc($result);
        return $user;
    }

    public function getUser($username, $password) {
        $query = " SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1 ";
        return mysqli_query($this->conn, $query);
    }
    
    public function checkIfUserExists($username) {
        $query = " SELECT * FROM users WHERE username='$username' LIMIT 1 ";
        return mysqli_query($this->conn, $query);
    }

    public function getConn() {
        return $this->conn;
    }

}
