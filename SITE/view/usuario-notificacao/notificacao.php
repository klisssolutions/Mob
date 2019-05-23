<?php

@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]);

require_once(IMPORT_VSOLICITACAO_LOCACAO);
require_once(IMPORT_SOLICITACAO_LOCACAO);
require_once(IMPORT_SOLICITACAO_LOCACAO_DAO);
require_once(IMPORT_SOLICITACAO_LOCACAO_CONTROLLER);

require_once(IMPORT_CLIENTE);
require_once(IMPORT_CLIENTE_CONTROLLER);

$idCliente = $_SESSION['idCliente']['idCliente'];

$controllerCliente = new controllerCliente();
$clientes[] = new Cliente();
$clientes = $controllerCliente->buscarCliente();


$controllerSolicitacao_Locacao = new controllerSolicitacao_Locacao();

$solicitacao_locacoes[] = new Solicitacao_Locacao();

//$cliente = new Cliente();
//$_GET["id"] = $Solicitacao_Locacao[$i]->getIdCliente();
//$cliente = $controllerCliente->buscarCliente();

// $_GET["id"] = $solicitacao_locacao->getIdCliente();
// $solicitacao_locacoes = $controllerSolicitacao_Locacao->listarSolicitacaoLocacaoPorLocador();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <meta http-equiv="Content-Type" content="view/text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/user.png" />
    <title>Painel do Usuário </title>
</head>
<body>
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <div class="content">
        <div class="box-painel-usuario">
            <div class="menu-lateral-usuario">
                <div class="img-usuario-menu">
                <div class="imagem-usuario">
                        <img src="../../../arquivos/<?php echo ($clientes->getFotoPerfil());?>" width="180" height="180"  alt="Usuário">
                    </div>

                    <div class="nome-usuario-menu">
                        <h1><?php echo ($clientes->getNome());?></h1>
                    </div>
                </div>
                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_VISUALIZAR_PERFIL); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/black-male-user-symbol.png" width="28" height="28"  alt="Usuário">Meu perfil</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario-clicado">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Minhas notificações</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_VISUALIZAR_ENDERECO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Meus endereços</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_OPCAO_VEICULO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/car (1).png" width="28" height="28"  alt="Usuário">Meus veículos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/tag.png" width="28" height="28"  alt="Usuário">Vendas</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_HISTORICO_VEICULO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Meus históricos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_CUPONS); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Cupons</h2>
                </div>
                </a>

                <div class="nav-menu-usuario-button">
                    <h3>Sair</h3>
                </div>
            </div>
            <div class="conteudo-usuario">
                <div class="box-notificacao">
                    <h1>Minhas Notificações:</h1>
                    <?php
                    
                    foreach($solicitacao_locacoes as $solicitacao_locacao){

                        //$Solicitacao_Locacao = Solicitacao_Locacao();

                        //$cliente = new Cliente();
                        //$_GET["id"] = $Solicitacao_Locacao[$i]->getIdCliente();
                        //$cliente = $controllerCliente->buscarCliente();

                        // $foto_veiculo = new Foto_Veiculo();
                        // $marca = new Marca();
                        // $modelo = new Modelo();

                        // $_GET["id"] = $veiculos[$i]->getIdModelo();
                        // $modelo = $controllerModelo->buscarModelos();

                        // $_GET["id"] = $modelo->getIdMarca();
                        // $marca = $controllerMarca->buscarMarcas();

                        // $foto_veiculo = $controllerFoto_veiculo->listarFotoFrontal($veiculos[$i]->getIdVeiculo());
                      
                    ?>
                    <div class="notificacao">
                        <p> <?php echo($solicitacao_locacao->getNomeCliente());?> deseja alugar Honda KM 345 no dia 11/09/2015 as 11h30 com fim no 
                            16/09/2015.
                        </p>
                        <input type="button" value="aceitar" class="ipt-aceitar">
                        <input type="button" value="recusar" class="ipt-recusar">
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>