<?php

include("../dao/prod_dao.php");
$prodDAO = new ProdDAO();
$errors = array();


if((isset($_POST['id'])) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    getProd();
}

if (isset($_POST['save'])) {
    saveProd();
    
}

if (isset ($_POST['dados_grupo'])){
    dadosGrupo();
}
if (isset($_POST['remove'])) {
    removeProd();
}
if (isset($_POST['get_edit_values'])){
    getProdById();
}

if (isset($_POST['edit'])){
    editProd();
}

function getProd(){
    global $prodDAO, $errors;
    $output = $prodDAO->getProd($_POST);
    echo json_encode($output);
}

function getProdById(){
    global $prodDAO;
    $output = $prodDAO->getProdById($_POST['id']);
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
    global $prodDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];
    $id = $_POST['id'];
    $idgrupo = $_POST['id_grupo'];

    if (isset($name) && isset($description) && isset($id)) {

        $ok = $prodDAO->editProd($name,$description,$id, $idgrupo );
 
        $retorno = ($ok ? "Item $id editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
function removeProd() {
    global $prodDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $prodDAO->delete($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}


function dadosGrupo(){
    global $prodDAO;
    $dados = $prodDAO->getDadosGrupo();
    echo json_encode($dados);
}

