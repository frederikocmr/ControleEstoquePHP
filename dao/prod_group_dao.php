<?php

/*
 *  Copyright 2018, Frederiko Cesar Moreira Ribeiro
 *  GitHub: https://github.com/frederikocmr
 */
include 'dbconnect.php';

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
    
    //insere dados
    public function insertProdGroup($name, $description) {

        $query = "INSERT INTO grupo_produto (nome, descricao) VALUES ('{$name}', '{$description}')";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_insert_id($this->conn);
    }
    //edita dados
    public function editProdGroup($name, $description, $id) {

        $query = "UPDATE  grupo_produto SET nome = '$name', descricao = '$description' WHERE id = '$id'";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return true;
    }
    //deleta dados
    public function deleteProdGroup($id) {

        $query = "DELETE FROM  grupo_produto WHERE id = '$id'";
        
        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return true;
    }

    public function getProdGroup($dados_) {
        $data = array();
        $records_per_page = 10;
        $start_from = 0;
        $current_page_number = 0;
        
        if (isset($dados_['rowCount'])) {
            $records_per_page = $dados_['rowCount'];
        }

        if (isset($dados_['current'])) {
            $current_page_number = $dados_['current'];
        }

        $start_from = ($current_page_number - 1) * $records_per_page;

        $query = " SELECT * FROM grupo_produto ";

        if (!empty($dados_['searchPhrase'])) {
            $query .= ' WHERE nome LIKE "%' . $dados_['searchPhrase'] . '%" ';
        }

        $orderBy = '';

        if (isset($dados_['sort']) && is_array($dados_['sort'])) {
            foreach ($dados_['sort'] as $key => $value) {
                $orderBy .= `$key $value, `;
            }
        } else {
            $query .= ' ORDER BY id DESC ';
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . substr($orderBy, 0, -2);
        }

        if ($records_per_page != -1) {
            $query .= ' LIMIT ' . $start_from . ", " . $records_per_page;
        }
        
        $result = mysqli_query($this->conn, $query);
        
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        
        $query1 = "SELECT * FROM grupo_produto";
        $result1 = mysqli_query($this->conn, $query1);
        $total_records = mysqli_num_rows($result1);
        
        $output = array (
          'current' => intval($dados_["current"]),
          'rowCount' => 10,
          'total'    => intval($total_records),
          'rows'     => $data
        );
        
        return $output;
    }
    
}
