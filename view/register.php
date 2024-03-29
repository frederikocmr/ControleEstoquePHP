<?php

/*
 *  @copyright  Copyright 2018 
 *  @author Frederiko Cesar Moreira Ribeiro
 *  @author Anna Lara Moraes Caixeta
 *  @version 1
 *  @link https://github.com/frederikocmr/controleestoque GitHub
 */

require_once "../dao/user_dao.php";
include('../controller/user_controller.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro</title>
        <link rel="stylesheet" type="text/css" href="../util/css/style.css">
        <link rel="icon" type="image/png" href="../util/images/favicon.png">
    </head>
    <body>
        <div class="header">
            <h2>Cadastro</h2>
        </div>

        <form method="post" action="register.php">

            <?php echo display_error(); ?>

            <div class="input-group">
                <label>Usuário</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
            </div>
            
            <?php if (isAdmin()) { ?>
            <div class="input-group">
                <label>Tipo</label>
                <select name="user_type" id="user_type" >
                    <option value=""></option>
                    <option value="admin">Admin</option>
                    <option value="user">Usuário</option>
                </select>
            </div>
            <?php } ?>
            
            <div class="input-group">
                <label>Senha</label>
                <input type="password" name="password_1">
            </div>
            <div class="input-group">
                <label>Confirmar Senha</label>
                <input type="password" name="password_2">
            </div>
            <div class="input-group">
                <button type="submit" class="btn" name="register_btn">Registrar</button>
            </div>
            <p>
                Já possui cadastro? <a href="login.php">Fazer Login</a>
            </p>
        </form>
    </body>
</html>