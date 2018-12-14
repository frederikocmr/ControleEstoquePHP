<?php

include 'dbconnect.php';

class MovDAO extends Dbconnect {

    private $conn;

    public function __construct() {
        $dbcon = new parent();
        $this->conn = $dbcon->connect();
    }

//    public function select($table, $where = '', $other = '') {
//        if ($where != '') {
//            $where = 'where ' . $where;
//        }
//        $sql = " SELECT * FROM  " . $table . " " . $where . " " . $other;
//        $sele = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
//        return $sele;
//    }
    //insere dados
    public function insertMov($description, $id_secao) {

        $query = "INSERT INTO movimentacao ( descricao, id_secao) VALUES ('$description', $id_secao)";

        mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        return mysqli_insert_id($this->conn);
    }

    public function insertMovProdutos($produtos, $id) {

        try {
            foreach ($produtos as $key => $value) {
                $query = "INSERT INTO produto_movimentacao ( produto_id, movimentacao_id) VALUES ($value, $id)";

                $ok = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
            }
        } catch (Exception $e) {
            return $e;
        }

        return $ok;
    }

    //edita dados
//    public function edit($name, $description, $id) {
//
//        $query = "UPDATE  movimentacao SET nome = '$name', descricao = '$description' WHERE id = '$id'";
//
//        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
//        return $result;
//    }
    //deleta dados
//    public function delete($id) {
//
//        $query = "DELETE FROM movimentacao WHERE id = '$id'";
//
//        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
//        return $result;
//    }

    public function getMov($dados_) {
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

        $query = 'SELECT m.id, p.nome, m.descricao, s.nome as secao'
                . ' FROM produto_movimentacao pm '
                . ' INNER JOIN produto p on p.id = pm.produto_id'
                . ' INNER JOIN movimentacao m on m.id = pm.movimentacao_id'
                . ' LEFT JOIN secao s on m.id_secao = s.id';


        if (!empty($dados_['searchPhrase'])) {
            $query .= ' WHERE descricao LIKE "%' . $dados_['searchPhrase'] . '%" ';
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

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }

        $query1 = "SELECT * FROM movimentacao ";
        $result1 = mysqli_query($this->conn, $query1);
        $total_records = mysqli_num_rows($result1);

        $output = array(
            'current' => intval($dados_["current"]),
            'rowCount' => 10,
            'total' => intval($total_records),
            'rows' => $data
        );


        return $output;
    }

    public function getDadosSecao() {
        $query = "SELECT * FROM secao";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
       public function getDadosRelatorio() {
        $query = "SELECT * FROM secao";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

}
