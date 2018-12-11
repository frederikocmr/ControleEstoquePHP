<?php
include("../dao/user_dao.php");
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
                <a href="home.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Controle de Estoque</a>
                <a href="prod_group.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white" title="Produtos"><i class="fa fa-cubes"></i></a>
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
                    <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-shadow w3-margin-bottom w3-hide-small">
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
                                    <h2 class="w3-text-theme" style="text-shadow:1px 1px 0 #444">Produtos</h2>
                                    <hr class="w3-clear">
                                    <div class="w3-bar">
                                        <button class="w3-bar-item w3-button w3-theme-l1" style="width:50%" ><i class="fa fa-book"></i> Visualizar</button>
                                        <button class="w3-bar-item w3-button w3-theme-l2" style="width:50%" onclick="document.getElementById('id01').style.display = 'block'"><i class="fa fa-plus-square"></i> Cadastrar</button>
                                    </div>
                                    <hr class="w3-clear">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w3-container w3-card w3-white w3-round w3-margin"><br>

                        <table id="grid-data" class="table table-condensed table-hover table-striped w3-table-all" id="display_area">
                            <thead>
                                <tr class="w3-theme-d1 w3-hover-text-theme">
                                    <th data-column-id="id" data-type="numeric">ID</th>
                                    <th data-column-id="nome">Nome</th>
                                    <th data-column-id="descricao" data-order="desc">Descrição</th>
                                    <th data-column-id="gpnome" data-order="desc">Grupo do Produto</th>
                                    <th data-column-id="option" data-formatter="option" data-sortable="false">Opções</th>
                                </tr>
                            </thead>
                        </table>
                        <hr class="w3-clear">
                    </div>
                </div>
            </div>
            <br>
            <hr class="w3-clear">
            <br>
            <hr class="w3-clear">
        </div>
        <br>

        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-theme-d1"> 
                    <span onclick="document.getElementById('id01').style.display = 'none'" 
                          class="w3-button w3-display-topright">&times;</span>
                    <h2>Cadastrar Produto</h2>
                </header>
                <form class="w3-container">
                    <br>
                    <p>
                        <label for="name">Nome</label>
                        <input class="w3-input"  type="text" name="name" id="name">
                    </p>     
                    <p>
                        <label for="name">Descrição</label>
                        <input class="w3-input"  type="text" name="description" id="description">
                    </p>  
                    <br>
                    </p>     
                    <p>
                        <label for="id_grupo">Grupo</label>
                        <select class="w3-input"   name="id_grupo" id="id_grupo">

                        </select>
                    </p>  
                    <br>
                </form>
                <footer class="w3-container w3-theme-l1">
                    <div class="w3-bar">
                        <button class="w3-bar-item w3-button w3-theme-l1" style="width:50%" onclick="document.getElementById('id01').style.display = 'none'" ><i class="fa fa-mail-reply"></i> Cancelar</button>
                        <button class="w3-bar-item w3-button w3-theme-d1" style="width:50%" id="submit_btn"><i class="fa fa-check"></i> Cadastrar</button>
                    </div>
                </footer>
            </div>
        </div>

        <footer class="w3-container w3-theme-d5">
            <p >Criado por Anna Lara e Frederiko Cesar</p>
        </footer>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="../util/js/jquery-3.3.1.min.js"></script>
        <script src="../util/js/bootstrap.min.js"></script>
        <link rel='stylesheet' href='../util/bootgrid/jquery.bootgrid.min.css'>
        <script src="../util/bootgrid/jquery.bootgrid.min.js"></script>

        <script >
                            $(document).ready(function () {
                                dadosGrupo();

                                var grid = $("#grid-data").bootgrid({
                                    ajax: true,
                                    post: function ()
                                    {
                                        /* To accumulate custom parameter with the request object */
                                        return {
                                            id: "b0df282a-0d67-40e5-8558-c9e93b7befed"
                                        };
                                    },
                                    url: "../controller/prod_controller.php",
                                    formatters: {
                                        "option": function (column, row)
                                        {
                                            return "<button type=\"button\" class=\"btn btn-xs btn-default option-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-pencil\"></span></button> " +
                                                    "<button type=\"button\" class=\"btn btn-xs btn-default option-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash-o\"></span></button>";
                                        }
                                    }
                                }).on("loaded.rs.jquery.bootgrid", function ()
                                {
                                    /* Executes after data is loaded and rendered */
                                    grid.find(".option-edit").on("click", function (e) {
                                        editarDados($(this).data("row-id"));
                                    }).end().find(".option-delete").on("click", function (e) {
                                        removerDados($(this).data("row-id"));
                                    });
                                });

                                // save comment to database
                                $(document).on('click', '#submit_btn', function () {
                                    var name = $('#name').val();
                                    var description = $('#description').val();
                                    var id_grupo = $('#id_grupo').val();
                                    $.ajax({
                                        url: '../controller/prod_controller.php',
                                        type: 'POST',
                                        data: {
                                            'save': 1,
                                            'name': name,
                                            'description': description,
                                            'id_grupo': id_grupo,
                                        },
                                        success: function (response) {

                                            $('#name').val('');
                                            $('#description').val('');
                                            $('#id_grupo').val('');
                                            alert(response);

                                            $('button[title=Atualizar]').click();
                                        }
                                    });
                                });

                                function editarDados(id) {
                                    //implementar função que faz post em ajax para o prod_controller 
                                    // semelhante ao cadastro acima...
                                    var id_grupo = $('#id_grupo').val();
                                    var name = $('#name').val();
                                    var description = $('#description').val();
                                    $.ajax({
                                        url: '../controller/prod_controller.php',
                                        type: 'POST',
                                        data: {
                                            'edit': 1,
                                            'name': name,
                                            'description': description,
                                            'id': id,
                                            'id_grupo': id_grupo,
                                        },
                                        success: function (response) {

                                            $('#name').val('');
                                            $('#description').val('');
                                            $('#id').val('');
                                            $('#id_grupo').val('');
                                            alert(response);

                                            $('button[title=Atualizar]').click();
                                        }
                                    });

                                    console.log(id);
                                }

                                function removerDados(id) {
                                    //implementar função que faz post em ajax para o prod_controller 
                                    // semelhante ao cadastro acima...

                                    $(document).on('click', '#submit_exc', function () {
                                        var id = $('#id').val();
                                        $.ajax({
                                            url: '../controller/prod_controller.php',
                                            type: 'POST',
                                            data: {
                                                'save': 1,
                                                'id': id
                                            },
                                            success: function (response) {
                                                $('#id').val('');
                                                alert(response);
                                                $('button[title=Atualizar]').click();
                                            }
                                        });
                                    });

                                    console.log(id);
                                }
                                function dadosGrupo() {
                                    $.ajax({
                                        url: '../controller/prod_controller.php',
                                        type: 'POST',
                                        data: {
                                            'dados_grupo': 1,
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                            console.log(response);
                                            var html = '';
                                            $.each(response, function (key, val) {;
                                                html += '<option value="' + val.id + '">' + val.nome + '</option>';
                                            });
                                            $("#id_grupo").append(html);
                                        }
                                    });
                                }
                            });
        </script>
    </body>

</html> 
