<?php

include("../dao/secao_dao.php");
$SecaoDAO = new SecaoDAO();
$errors = array();


if((isset($_POST['id'])) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    getSecao();
}

if (isset($_POST['save'])) {
    saveSecao();
}

if (isset($_POST['remove'])) {
    removeSecao();
}

if (isset($_POST['get_edit_values'])){
    getSecaoById();
}
if (isset($_POST['edit'])){
    editSecao();
}
function getSecao(){
    global $SecaoDAO;
    $output = $SecaoDAO->getSecao($_POST);
    echo json_encode($output);
}

function getSecaoById(){
    global $SecaoDAO;
    $output = $SecaoDAO->getSecaoById($_POST['id']);
    echo json_encode($output);
}

function saveSecao() {
    global $SecaoDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description)) {

        $id = $SecaoDAO->insertSecao($name,$description );
 
        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } 
    exit();
}

function editSecao() {
    global $SecaoDAO;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description) && isset($id)) {

        $id = $SecaoDAO->editSecao($name,$description,$id );
 
        $retorno = ($id >= 1 ? "Editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    }
    
    exit();
}
function removeSecao() {
    global $SecaoDAO;
    $id = $_POST['id'];

    if (isset($id)) {

        $ok = $SecaoDAO->deleteSecao($id);
 
        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } 
    exit();
}
