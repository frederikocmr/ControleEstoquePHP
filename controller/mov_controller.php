<?php

include("../dao/mov_dao.php");
$movDAO = new MovDAO();

/**
 * V
 * @package controller
 */
if(isset($_POST['id']) && ($_POST['id']=="b0df282a-0d67-40e5-8558-c9e93b7befed")){
    
    getMov();
}

//if (isset($_POST['save'])) {
//    saveMov();
//    
//}

//if (isset ($_POST['dados_movimentacao'])){
//    dadosMovimentacao();
//}
//if (isset($_POST['remove'])) {
//    removeSecao();
//}
//if (isset($_POST['get_edit_values'])){
//    editSecao();
//}

/**
 * Verificando se existe 'dados_grupo'
 * @package controller
 */
if (isset ($_POST['dados_secao'])){
    dadosSecao();
}
/**
 * Essa função pega o movimentacao 
 * @package controller
 */
function getMov(){
    global $movDAO;
    $output = $movDAO->getMov($_POST);
    
    echo json_encode($output);
}
/**
 * Função para salvar o movimentacao 
 * @package controller
 */
//function saveMov() {
//    global $movDAO;
//    $name = $_POST['name'];
//    $description = $_POST['description'];
//    $id_grupo = $_POST['id_grupo'];
//
//
//    if (isset($name) && isset($description) && isset($id_grupo)) {
//
//        $id = $movDAO->insertMov($name,$description, $id_grupo );
// 
//        $retorno = ($id >= 1 ? "Cadastrado com sucesso!" : "Erro ao cadastrar!");
//        echo $retorno;
//    } else {
//        echo "Error: " . mysqli_error($conn);
//    }
//    exit();
//}
/**
 * Função para editar os atricutos do movimentacao
 * @package controller
 */
//function editSecao() {
//    global $movDAO;
//    $name = $_POST['name'];
//    $description = $_POST['description'];
//
//
//    if (isset($name) && isset($description) && isset($id)) {
//
//        $id = $movDAO->edit($name,$description,$id );
// 
//        $retorno = ($id >= 1 ? "Editado com sucesso!" : "Erro ao editar !");
//        echo $retorno;
//    }
//    
//    exit();
//}
/**
 * Função para remover a movimentacao 
 * @package controller
 */
//function removeSecao() {
//    global $movDAO;
//    $id = $_POST['id'];
//
//    if (isset($id)) {
//
//        $ok = $movDAO->delete($id);
// 
//        $retorno = ($ok ? "Item $id deletado com sucesso!" : "Erro ao deletar!");
//        echo $retorno;
//    } 
//    exit();
//}

/**
 * Função para recuperar do banco dados do movimentacao e retornar um json
 * @package controller
 */
function dadosSecao(){
    global $movDAO;
    $dados = $movDAO->getDadosSecao();
    echo json_encode($dados);
}
