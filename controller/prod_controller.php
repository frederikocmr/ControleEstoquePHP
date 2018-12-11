<?php

include("../dao/prod_dao.php");
$prodDAO = new ProdDAO();
$errors = array();


if(isset($_POST['id'])){

    getProd();
}

if (isset($_POST['save'])) {
    saveProd();
    
}

if (isset ($_POST['dados_grupo'])){
    dadosGrupo();
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
function editProd() {
    global $prodDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description) && isset($id)) {

        $id = $prodDAO->editProd($name,$description,$id );
 
        $retorno = ($id >= 1 ? "Editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
function deleteProd() {
    global $prodDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($id)) {

        $id = $prodDAO->deleteProd($id);
 
        $retorno = ($id >= 1 ? "Deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}

function dadosGrupo(){
    global $prodDAO;
    $dados = $prodDAO->getDadosGrupo();
    echo json_encode($dados);
}

