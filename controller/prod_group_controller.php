<?php

include("../dao/prod_group_dao.php");
$prodGroupDAO = new ProdGroupDAO();
$errors = array();


if(isset($_POST['id'])){

    getProdGroup();
}

if (isset($_POST['save'])) {
    saveProdGroup();
    
}

function getProdGroup(){
    global $prodGroupDAO, $errors;
    $output = $prodGroupDAO->getProdGroup($_POST);
    echo json_encode($output);
}

function saveProdGroup() {
    global $prodGroupDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description)) {

        $id = $prodGroupDAO->insertProdGroup($name,$description );
 
        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
function editProdGroup() {
    global $prodGroupDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($name) && isset($description) && isset($id)) {

        $id = $prodGroupDAO->editProdGroupProdGroup($name,$description,$id );
 
        $retorno = ($id >= 1 ? "Editado com sucesso!" : "Erro ao editar !");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
function deleteProdGroup() {
    global $prodGroupDAO, $errors;
    $name = $_POST['name'];
    $description = $_POST['description'];


    if (isset($id)) {

        $id = $prodGroupDAO->deleteProdGroup($id);
 
        $retorno = ($id >= 1 ? "Deletado com sucesso!" : "Erro ao deletar!");
        echo $retorno;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    exit();
}
