<?php

include("../dao/mov_dao.php");
$movDAO = new MovDAO();
$errors = array();


if(isset($_POST['id'])){

    getProd();
}

if (isset($_POST['save'])) {
    saveProd();
    
}

if (isset ($_POST['dados_produto'])){
    dadosProduto();
}
if (isset($_POST['remove'])) {
    removeSecao();
}
if (isset($_POST['get_edit_values'])){
    editSecao();
}

function getProd(){
    global $prodDAO, $errors;
    $output = $prodDAO->getProd($_POST);
    echo json_encode($output);
}

function saveProd() {
    global $prodDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id_grupo = $_POST['id_grupo'];


    if (isset($name) && isset($description) && isset($id_grupo)) {

        $id = $prodDAO->insertProd($name,$description, $id_grupo );
 
        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
function editSecao() {
    global $prodDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description) && isset($id)) {

        $id = $prodDAO->edit($name,$description,$id );
 
        $retorno = ($id >= 1 ? "Editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
function removeSecao() {
    global $prodDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $prodDAO->delete($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}


function dadosProduto(){
    global $movDAO;
    $dados = $movDAO->getDadosProduto();
    echo json_encode($dados);
}

