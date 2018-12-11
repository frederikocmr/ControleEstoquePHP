<?php
require_once "../dao/user_dao.php";
include('../controller/user_controller.php');

if (!isLoggedIn()) {
    $_SESSION['msg'] = "É necessário logar primeiro!";
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
    <title>Controle de Estoque</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png"  href="../util/images/favicon.png">
    <link rel="stylesheet" href="../util/css/w3.css">
    <link rel="stylesheet" href="../util/css/w3-theme-blue-grey.css">
    <link rel='stylesheet' href='../util/css/font?family=Open+Sans'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    </style>
    <body class="w3-theme-l5">
        <!-- Navbar -->
        <div class="w3-top">
            <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);">
                <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
                <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Controle de Estoque</a>
                <a href="prod_group.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Grupos de Produtos"><i class="fa fa-cubes"></i></a>
                <a href="prod.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Produtos"><i class="fa fa-cube"></i></a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Seções"><i class="fa fa-tags"></i></a>
                <div class="w3-dropdown-hover w3-hide-small">
                    <button class="w3-button w3-padding-large" title="Movimentação"><i class="fa fa-mail-forward"></i><span class="w3-badge w3-right w3-small w3-green">2</span></button>     
                    <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:300px">
                        <a href="#" class="w3-bar-item w3-button">Cadastrar Movimentação</a>
                        <a href="#" class="w3-bar-item w3-button">Visualizar Movimentações</a>
                    </div>
                </div>
                <a href="home_user.php?logout='1'" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="SAIR">
                    <i class="fa fa-sign-out"></i> SAIR
                </a>
            </div>
        </div>

        <!-- Navbar on small screens -->
        <!--        <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
                    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
                    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
                    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
                    <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
                </div>-->

        <!-- Page Container -->
        <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
            <!-- The Grid -->
            <div class="w3-row">
                <!-- Left Column -->
                <div class="w3-col m3">
                    <!-- Profile --> 
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div class="w3-card w3-round w3-white w3-animate-left">
                            <div class="w3-container">
                                <h4 class="w3-center"><strong>Bem Vindo!</strong></h4>
                                <p class="w3-center"><img src="../util/images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                                <hr>
                                <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i> 
                                    <?php echo ucfirst($_SESSION['user']['username']); ?><small>
                                        <i  style="color: #888;">(<?php echo ($_SESSION['user']['user_type']); ?>)</i> 
                                        <br>

                                    </small>
                                </p>
                                <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> <?php echo ($_SESSION['user']['email']); ?></p>
                            </div>
                        </div>
                    <?php endif ?>
                    <br>


                    <!-- Notificações  -->
                    <div class="w3-animate-bottom w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-shadow w3-margin-bottom w3-hide-small">
                        <span onclick="this.parentElement.style.display = 'none'" class="w3-button w3-theme-l3 w3-display-topright">
                            <i class="fa fa-remove"></i>
                        </span>
                        <p><strong>Notificações</strong></p>

                        <?php if (isset($_SESSION['success'])) { ?>
                            <div class="error success" >
                                <p><button class="w3-button w3-block w3-theme-l2">
                                        <?php
                                        echo $_SESSION['success'];
                                        unset($_SESSION['success']);
                                        ?>
                                    </button></p>
                            </div>
                        <?php } else { ?>
                            <p><button class="w3-button w3-block w3-theme-l4">Nenhuma notificação</button></p>
                        <?php } ?>

                    </div>

                    <!-- End Left Column -->
                </div>

                <!-- Middle Column -->
                <div class="w3-col m9">

                    <div class="w3-row-padding">
                        <div class="w3-col m12">
                            <div class="w3-row-padding">
                                <div class="w3-third w3-container w3-margin-bottom w3-animate-right "  >
                                    <a href="prod_group.php"><img src="../util/images/boxes.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity w3-theme-shadow w3-theme-hover" ></a>
                                    <div class="w3-container w3-white w3-theme-shadow" >
                                        <p><b>Grupos de Produtos</b></p>
                                        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                                    </div>
                                </div>
                                <div class="w3-third w3-container w3-margin-bottom w3-animate-right">
                                    <a href="prod.php"><img src="../util/images/boxes2.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity w3-theme-shadow w3-theme-hover"></a>
                                    
                                    <div class="w3-container w3-white w3-theme-shadow">
                                        <p><b>Produtos</b></p>
                                        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                                    </div>
                                </div>
                                <div class="w3-third w3-container w3-animate-right">
                                    <a href="prod.php"><img src="../util/images/boxes4.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity w3-theme-shadow w3-theme-hover"></a>
                                    <div class="w3-container w3-white w3-theme-shadow">
                                        <p><b>Movimentação</b></p>
                                        <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Middle Column -->
            </div>


            <!-- End Grid -->
        </div>

        <br>
        <hr class="w3-clear">
        <br>
        <hr class="w3-clear">
        <footer class="w3-container w3-theme-d5">
            <p>Criado por Anna Lara e Frederiko Cesar</p>
        </footer>

        <script>

        </script>

    </body>
</html> 

