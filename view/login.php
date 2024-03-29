
<?php

/*
 *  @copyright  Copyright 2018 
 *  @author Frederiko Cesar Moreira Ribeiro
 *  @author Anna Lara Moraes Caixeta
 *  @version 1
 *  @link https://github.com/frederikocmr/controleestoque GitHub
 */


require_once "../dao/user_dao.php";
include('../controller/user_controller.php');

if (isLoggedIn()) {
    header('location: ../index.php');
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="../util/css/style.css">
        <link rel="icon" type="image/png" href="../util/images/favicon.png">
    </head>
    <body>

        <div class="header">
            <h2>Login</h2>
        </div>

        <form method="post" action="login.php">

            <?php echo display_error(); ?>

            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="username" >
            </div>
            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="password">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="login_btn">Login</button>
            </div>
            <p>
                Não possui cadastro? <a href="register.php">Cadastrar</a>
            </p>
        </form>


    </body>
</html>