<?php
require_once "../dao/user_dao.php";
include('../controller/user_controller.php');

if (!isAdmin()) {
    $_SESSION['msg'] = "É necessário fazer login antes!";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Página Inicial Administrador</title>
        <link rel="stylesheet" type="text/css" href="../util/css/style.css">
        <style>
            .header {
                background: #003366;
            }
            button[name=register_btn] {
                background: #003366;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h2>Admin - Página Inicial</h2>
        </div>
        <div class="content">
            <!-- Notificação -->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="error success" >
                    <h3>
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>

            <!-- Info do usuário logado -->
            <div class="profile_info">
                <img src="../util/images/avatar1.png" alt="usuario" >

                <div>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <strong><?php echo $_SESSION['user']['username']; ?></strong>

                        <small>
                            <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                            <br>
                            <a href="home.php?logout='1'" style="color: red;">sair</a>
                            &nbsp; <a href="register.php"> + adicionar usuário</a>
                        </small>

                    <?php endif ?>
                </div>
            </div>



        </div>

    </body>
</html>