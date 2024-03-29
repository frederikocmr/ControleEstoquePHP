<?php

/*
 *  Copyright 2018, Frederiko Cesar Moreira Ribeiro
 *  GitHub: https://github.com/frederikocmr
 */

$userDAO = new UserDAO();
$username = "";
$email = "";
$errors = array();

// Chamada da função register() caso register_btn for clicado
if (isset($_POST['register_btn'])) {
    register();
}

// Chamada da função login() caso register_btn for clicado
if (isset($_POST['login_btn'])) {
    login();
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    echo __DIR__;
    header("location: ../view/login.php");
}

// Registrar usuário
function register() {
    global $userDAO, $errors;

    // Recupera todos os inputs do form
    $username = e($_POST['username']);
    $email = e($_POST['email']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

    // validação do form
    verificaCampos($username, $email, $password_1, $password_2);

    // Registra o usuário caso não há erros no formulário
    if (count($errors) == 0) {
        // Encripta a senha para salvar no banco...

        if (!(mysqli_num_rows($userDAO->checkIfUserExists($username)) == 1)) {

            if (isset($_POST['user_type'])) {
                $user_type = e($_POST['user_type']);
                $userDAO->insertUser($username, $email, $user_type, md5($password_1));

                $_SESSION['success'] = "Novo usuário criado com sucesso!";
                header('location: home.php');
            } else {
                // Pega o ID do usuário conectado
                $logged_in_user_id = $userDAO->insertUser($username, $email, 'user', (md5($password_1)));

                // Coloca o usuário na sessão
                $_SESSION['user'] = $userDAO->getUserById($logged_in_user_id);
                $_SESSION['success'] = "Usuário logado!";
                header('location: ../index.php');
            }
        } else {
            array_push($errors, "Usuário já existe com estas credenciais!");
        }
    }
}

function verificaCampos($username, $email, $password_1, $password_2) {
    global $errors;

    if (empty($username)) {
        array_push($errors, "Campo Usuário é obrigatório!");
    }
    if (empty($email)) {
        array_push($errors, "Campo Email é obrigatório!");
    }
    if (empty($password_1)) {
        array_push($errors, "Campo Senha é obrigatório!");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "As duas senhas não são iguais!");
    }

    return $errors;
}

// Faz login do usuário
function login() {
    global $userDAO, $username, $errors;

    // Recupera informações do form
    $username = e($_POST['username']);
    $password = e($_POST['password']);

    // Validação dos dados
    if (empty($username)) {
        array_push($errors, "Campo Usuário é obrigatório!");
    }
    if (empty($password)) {
        array_push($errors, "Campo Senha é obrigatório!");
    }

    // Tenta logar caso nenhum erro é encontrado
    if (count($errors) == 0) {
        $password = md5($password);

        $results = $userDAO->getUser($username, $password);

        // se usuário encontrado...
        if (mysqli_num_rows($results) == 1) {
            // Verifica se o tipo é admin ou user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] === 'admin') {

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Você logou como ADMIN";
                header('location: home.php');
            } else {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "Usuário logado!";
                echo "teste";
                header('location: ../index.php');
            }
        } else {
            array_push($errors, "Usuário ou senha inválidas!");
        }
    }
}

//verifica se usuário está logado na sessão
function isLoggedIn() {
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

//verifica se usuário é admin
function isAdmin() {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

// escape string
function e($val) {
    global $userDAO;
    return mysqli_real_escape_string($userDAO->getConn(), trim($val));
}

function display_error() {
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}
