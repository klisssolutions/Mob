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
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <meta http-equiv="Content-Type" content="view/text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/user.png" />
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
                <form id="form" method="post" enctype="multipart/form-data">


                    <table class="dash-cad">
                        <tr>
                            <td class="titulo-dash-cad">
                                Categoria:
                            </td>
                            <td class="txt-dash">

                                <select class="slt-dash" name="sltAtivo" required>
                                    <option value="1">Ativado</option>
                                    <option value="0">Desativado</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Modelo:
                            </td>
                            <td class="txt-dash">

                                <select class="slt-dash" name="sltAtivo" required>
                                    <option value="1">Ativado</option>
                                    <option value="0">Desativado</option>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Cor:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtCor" id="cor">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Altura:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtAltura" id="altura">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Comprimento:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtComprimento" id="comprimento">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Largura:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtLargura" id="largura">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Valor Hora:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtValor" id="valor">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Ano:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtAno" id="ano">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Quilometragem:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtQuilometragem" id="quilometragem">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Endereço:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtCor" id="cor">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                <input type="button" value="Voltar" class="btn-dash" onclick="veiculo();">
                            </td>
                            <td class="titulo-dash-cad">
                                <input type="submit" value="Enviar" class="btn-dash" onclick="<?php echo utf8_encode($router); ?>">
                            </td>
                        </tr>
                    </table>





                    <table class="dash-cad">
                        <tr>
                            <td class="titulo-dash-cad">
                                Titulo:
                            </td>
                            <td class="txt-dash">
                                <input type="text" size="25" class="input-dash" name="txtTitulo" required value="<?php echo utf8_encode($titulo)?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Cor:
                            </td>
                            <td class="txt-dash">
                                <input type="file" name="imgFoto" id="foto" accept="image/*" onchange="preview(this)" value="<?php echo utf8_encode($foto)?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <img src="<?php echo utf8_encode($foto); ?>" id="prev">
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Descrição:
                            </td>
                            <td class="txt-dash">
                                <textarea name="txtDescricao" class="input-dash" required><?php echo utf8_encode($descricao)?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                <input type="button" value="Voltar" class="btn-dash" onclick="veiculo();">
                            </td>
                            <td class="titulo-dash-cad">
                                <input type="submit" value="Enviar" class="btn-dash" onclick="<?php echo utf8_encode($router); ?>">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>
