<?php
require_once "dao/user_dao.php";
include('controller/user_controller.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "É necessário logar primeiro!";
    header('location: view/login.php');
}

if (isAdmin()) {
    header('location: view/home.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Inicial</title>
        <link rel="stylesheet" type="text/css" href="util/css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Página Inicial</h2>
        </div>
        <div class="content">
            <!-- Notificações  -->
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
                <img src="util/images/user_profile.png" alt="usuario" >

                <div>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <strong><?php echo $_SESSION['user']['username']; ?></strong>

                        <small>
                            <i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
                            <br>
                            <a href="index.php?logout='1'" style="color: red;">sair</a>
                        </small>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </body>
</html>