<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

require_once(IMPORT_V_HISTORICO_LOCACAO);
require_once(IMPORT_LOCACAO_CONTROLLER);

require_once(IMPORT_CLIENTE);
require_once(IMPORT_CLIENTE_CONTROLLER);

$idCliente = $_SESSION['idCliente']['idCliente'];
$clientes[] = new Cliente();
$controllerCliente = new controllerCliente();
$controllerLocacao = new controllerLocacao();
$clientes = $controllerCliente->buscarCliente();

$_GET["id"] = $_SESSION['idCliente']['idCliente'];

$locacoes[] = new vhistorico_locacao();
$locacoes = null;
$locacoes = $controllerLocacao->listarHistoricoLocacaoPorLocador();
$usuario = $controllerCliente->buscarCliente();

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <meta http-equiv="Content-Type" content="view/text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/user.png" />
    <script type="text/javascript" src="../js/link.js"></script>
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
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_VISUALIZAR_PERFIL); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/black-male-user-symbol.png" width="28" height="28"  alt="Usuário">Meu perfil</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Notificações</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_VISUALIZAR_ENDERECO); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Meus endereços</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_OPCAO_VEICULO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/car (1).png" width="28" height="28"  alt="Usuário">Meus veículos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario">
                    <h2><img src="../images/tag.png" width="28" height="28"  alt="Usuário">Vendas</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_HISTORICO_VEICULO); ?>">
                <div class="nav-menu-usuario-clicado">
                    <h2> <img src="../images/script.png" width="28" height="28"  alt="Usuário">Meus históricos</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_CUPONS); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/coupon.png" width="28" height="28"  alt="Usuário">Cupons</h2>
                </div>
                </a>

                <div class="nav-menu-usuario-button">
                    <h3>Sair</h3>
                </div>
            </div>
            <div class="conteudo-usuario">
                <div class="titulo-lista">VEICULOS</div>
                <?php
                if(!is_null($locacoes)):
                foreach($locacoes as $locacao):
                    $data = new DateTime($locacao->getHorarioInicio());
                    $dataInicio = date_format($data, "d/m/Y H:i");
                    $data = new DateTime($locacao->getHorarioFim());
                    $dataFim = date_format($data, "d/m/Y H:i");
                    if($locacao->getIdCliente() == $usuario->getIdCliente()):
                        $_GET["id"] = $locacao->getIdDono();
                        $locador = $controllerCliente->buscarClienteDono();
            ?>

                <div class="box-veiculo">
                    <div class="texto-modelo">
                        <label class="negrito">Dono: </label> <?php echo utf8_encode($locador->getNome());?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Veiculo: </label> <?php echo utf8_encode($locacao->getVeiculo());?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Data Locação: </label> <?php echo utf8_encode($dataInicio);?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Data Devolução: </label> <?php echo utf8_encode($dataFim);?>
                    </div>
                    <?php if(!$locacao->getDevolvido()): ?>
                    <div class="texto-ano">
                        <a href="devolucao.php?modo=devolver&id=<?php echo utf8_encode($locacao->getIdLocacao()); ?>">
                            <input type="button" value="Devolver">
                        </a>
                    </div>
                    <?php endif; ?>
                    <br>
                    <br>
                    <br>

                </div>
                <?php
                    else: 
                        $_GET["id"] = $locacao->getIdCliente();
                        $cliente = $controllerCliente->buscarCliente();
                ?>

                <div class="box-veiculo">
                    <div class="texto-modelo">
                        <label class="negrito">Cliente: </label> <?php echo utf8_encode($cliente->getNome());?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Veiculo: </label> <?php echo utf8_encode($locacao->getVeiculo());?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Data Locação: </label> <?php echo utf8_encode($dataInicio);?>
                    </div>

                    <div class="texto-modelo">
                        <label class="negrito">Data Devolução: </label> <?php echo utf8_encode($dataFim);?>
                    </div>
                    
                    <?php if(!$locacao->getRecebido()): ?>
                    <div class="texto-ano">
                        <a href="devolucao.php?modo=receber&id=<?php echo utf8_encode($locacao->getIdLocacao()); ?>">
                            <input type="button" value="Receber">
                        </a>
                    </div>
                    <?php endif; ?>
                    <br>
                    <br>
                    <br>

                </div>

                 <?php 
                        endif;
                    endforeach;
                endif;
                 ?>
            </div>
        </div>
    </div>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>