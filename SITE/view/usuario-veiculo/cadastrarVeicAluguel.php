<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

    require_once(IMPORT_MODELO);
    require_once(IMPORT_MODELO_CONTROLLER);

    require_once(IMPORT_CATEGORIA);
    require_once(IMPORT_CATEGORIA_CONTROLLER);

    require_once(IMPORT_ENDERECO);
    require_once(IMPORT_ENDERECO_CONTROLLER);

    require_once(IMPORT_CLIENTE);
    require_once(IMPORT_CLIENTE_CONTROLLER);

    $idCliente = $_SESSION['idCliente']['idCliente'];

    $controllerCliente = new controllerCliente();
    $clientes[] = new Cliente();
    $clientes = $controllerCliente->buscarCliente();

    $controllerModelo = new controllerModelo();
    $modelos[] = new Modelo();
    $modelos = $controllerModelo->listarModelos();

    $controllerCategoria = new controllerCategoria();
    $categorias[] = new Categoria();
    $categorias = $controllerCategoria->listarCategorias();

    $controllerEndereco = new controllerEndereco();
    $enderecos[] = new Endereco();
    $enderecos = $controllerEndereco->listarEnderecos();

    $router = "router('veiculos', 'inserir', '0')";

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
                <a href="<?php echo(LINK_DASHBOARD_VISUALIZAR_PERFIL); ?>">
                <div class="nav-menu-usuario">
                    <h2> <img src="../images/black-male-user-symbol.png" width="28" height="28"  alt="Usuário">Meu perfil</h2>
                </div>
                </a>

                <!-- ITEM - MENU -->
                <a href="<?php echo(LINK_DASHBOARD_NOTIFICACAO); ?>">
                <div class="nav-menu-usuario">
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
                <div class="nav-menu-usuario-clicado">
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
            <div class="conteudo-usuario" id="informacao">
                <div class="titulo-lista">VEICULOS</div>
                <form id="form" method="post" enctype="multipart/form-data">

                    <table class="dash-cad">
                        <tr>
                            <td class="titulo-dash-cad">
                                Categoria:
                            </td>
                            <td class="txt-dash">

                                <select class="slt-dash" name="sltCategoria" required>
                                <option value="">Selecione uma categoria</option>
                                    <?php foreach($categorias as $categoria){ 
                                            $selected = ($idCategoria_Veiculo == $categoria->getIdCategoria_Veiculo() ? "selected" : null);
                                    ?>
                                    <option value="<?php echo($categoria->getIdCategoria_Veiculo()); ?>" <?php echo($selected); ?>><?php echo($categoria->getNomeCategoria()); ?></option>
                                    <?php } ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Modelo:
                            </td>
                            <td class="txt-dash">

                                <select class="slt-dash" name="sltModelo" required>
                                    <option value="">Selecione um modelo</option>
                                    <?php foreach($modelos as $modelo){ 
                                            $selected = ($idModelo == $modelo->getIdModelo() ? "selected" : null);
                                    ?>
                                    <option value="<?php echo($modelo->getIdModelo()); ?>" <?php echo($selected); ?>><?php echo($modelo->getNomeModelo()); ?></option>
                                    <?php } ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Cor:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtCor" id="cor" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Altura:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtAltura" id="altura" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                Comprimento:
                            </td>
                            <td class="txt-dash">
                                <input type="text" class="input-dash" name="txtComprimento" id="comprimento" required>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad" required>
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
                                <input type="text" class="input-dash" name="txtAno" id="ano" required>
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
                            <select class="slt-dash" name="sltEndereco" required>
                                <option value="">Selecione a rua</option>
                                    <?php foreach($enderecos as $endereco){ 
                                        $selected = ($idEndereco == $endereco->getIdEndereco() ? "selected" : null);
                                    ?>
                                    <option value="<?php echo($endereco->getIdEndereco()); ?>" <?php echo($selected); ?>><?php echo($endereco->getRua() . ', ' . $endereco->getCidade() . ', ' . $endereco->getUf()); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="titulo-dash-cad">
                                <input type="button" value="Voltar" class="btn-dash" onclick="veiculo();">
                            </td>
                            <td class="titulo-dash-cad">
                                <input type="submit" value="Enviar" class="btn-dash" onclick="<?php echo($router); ?>">
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
