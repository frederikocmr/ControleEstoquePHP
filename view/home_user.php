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
    <title>Tela Inicial</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Grupos de Produtos"><i class="fa fa-cubes"></i></a>
                <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Produtos"><i class="fa fa-cube"></i></a>
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
                        <div class="w3-card w3-round w3-white">
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
                    <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
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
                            <div class="w3-card w3-round w3-white">
                                <div class="w3-container w3-padding">
                                    <div class="w3-bar">
                                    <button class="w3-bar-item w3-button w3-theme-l1" style="width:50%"><i class="fa fa-book"></i> Visualizar</button>
                                    <button class="w3-bar-item w3-button w3-theme-l2" style="width:50%"><i class="fa fa-plus-square"></i> Cadastrar</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

                        <div class="w3-row">
                            <div class="w3-col s9 w3-center"> 
                                <input placeholder="Digite aqui para pesquisar" class="w3-input w3-animate-input" type="text" style="width:30%">
                            </div>
                            <div class="w3-col s3 w3-center">
                                <button type="button" class="w3-button w3-theme"><i class="fa fa-search"></i>  Pesquisar</button>
                            </div>
                        </div>

                        <span class="w3-right w3-opacity"></span>
                        <hr class="w3-clear">
                        <table class="w3-table-all">
                            <thead>
                                <tr class="w3-theme-d3 w3-hover-text-theme">
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tr class="w3-hover-theme">
                                <td>Jill</td>
                                <td>Smith</td>
                                <td> <button class="w3-button w3-circle w3-theme-d5 ">+</button></td>
                            </tr>
                            <tr class="w3-hover-theme">
                                <td>Eve</td>
                                <td>Jackson</td>
                                <td>94</td>
                            </tr>
                            <tr class="w3-hover-theme">
                                <td>Adam</td>
                                <td>Johnson</td>
                                <td>67</td>
                            </tr>
                            <tr class="w3-hover-theme">
                                <td>Bo</td>
                                <td>Nilson</td>
                                <td>35</td>
                            </tr>
                        </table>
                        <hr>
                    </div>


                    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                        <img src="../util/images/avatar6.png" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px">
                        <span class="w3-right w3-opacity">32 min</span>
                        <h4>Angie Jane</h4><br>
                        <hr class="w3-clear">
                        <p>Have you seen this?</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button> 
                        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button> 
                    </div> 

                    <!-- End Middle Column -->
                </div>


                <!-- End Grid -->
            </div>

            <!-- End Page Container -->
        </div>
        <br>

        <footer class="w3-container w3-theme-d5">
            <p>Criado por Anna Lara e Frederiko Cesar</p>
        </footer>

        <script>
            // Accordion
            function myFunction(id) {
                var x = document.getElementById(id);
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                    x.previousElementSibling.className += " w3-theme-d1";
                } else {
                    x.className = x.className.replace("w3-show", "");
                    x.previousElementSibling.className =
                            x.previousElementSibling.className.replace(" w3-theme-d1", "");
                }
            }

            // Used to toggle the menu on smaller screens when clicking on the menu button
            function openNav() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }
        </script>

    </body>
</html> 

