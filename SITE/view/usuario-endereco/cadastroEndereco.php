<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

require_once(IMPORT_CLIENTE);
require_once(IMPORT_CLIENTE_CONTROLLER);

    $idCliente = $_SESSION['idCliente']['idCliente'];
    
    $controllerCliente = new controllerCliente();
    $clientes[] = new Cliente();
    $clientes = $controllerCliente->buscarCliente();

    $rua = '';
    $complemento = '';
    $numero = '';
    $uf = '';
    $cidade = '';

$router = "router('ENDERECO', 'inserir', '0')";

if(isset($_GET['id'])){
    $rua = $endereco->getRua();
    $complemento = $endereco->getComplemento();
    $numero = $endereco->getNumero();
    $uf = $endereco->getUf();
    $cidade = $endereco->getCidade();

    $router = "router('endereco', 'atualizar', '".$endereco->getIdEndereco()."')";
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <meta http-equiv="Content-Type" content="view/text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/user.png" />
    <script type="text/javascript" src="../js/jquery.js"></script>
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
                <div class="nav-menu-usuario-clicado">
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
                <div class="nav-menu-usuario">
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
                <div class="conteudo-endereco" id="informacao">
                <div class="titulo-lista">GERENCIAR ENDEREÇOS</div>
                <form id="form" method="post" enctype="multipart/form-data">
                <div class="botoes-dash">

</div>


<table class="dash-cad">
                        
                        <tr>
                            <td class="titulo-dash-cad">
                                Rua:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtRua" value="<?php echo utf8_encode($rua)?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Numero:
                            </td>
                            <td class="txt-dash">
                                <input type="number" class="input-dash" name="txtNumber" value="<?php echo utf8_encode($numero)?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Complemento:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtComplemento" value="<?php echo utf8_encode($complemento)?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad" required>
                                Cidade:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtCidade" value="<?php echo utf8_encode($cidade)?>" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                UF:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtUf" maxlength="2" size="6" value="<?php echo utf8_encode($uf)?>" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="titulo-dash-cad">
                                <input type="button" value="Voltar" class="btn-dash" onclick="cadastrarEndereco();">
                            </td>
                            <td class="titulo-dash-cad">
                                <input type="submit" value="Enviar" class="btn-dash" onclick="<?php echo utf8_encode($router); ?>">
                            </td>
                        </tr>
                    </table>
                    </form>
    <?php ?>
                </div>
            </div>
        </div>
    </div>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>