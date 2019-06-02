<header>
<div class="caixa-padrao">
    <!-- onde fica o login-->
    <div class="logotipo">
        <div class="img-logotipo">
            <a href="<?php echo utf8_encode(LINK_SITE_HOME); ?>">
                <img src="<?php echo utf8_encode(LINK_IMAGEM_LOGO); ?>" width="440" height="180"  alt="MobShare">
            </a>
        </div>
    </div>
    <!-- menu de navegação do cabeçalho -->
    <div class="menu-header">
        <nav class="menu-item">
        <li>
            <ul><a href="<?php echo utf8_encode(LINK_SITE_ANUNCIO); ?>">Anuncios</a></ul>
            <ul><a href="<?php echo utf8_encode(LINK_SITE_FUNCIONA); ?>">Como funciona</a></ul>
            <ul ><a href="<?php echo utf8_encode(LINK_SITE_MES); ?>">Melhores do Mês</a></ul>
            <ul class="ocultar"><a href="<?php echo utf8_encode(LINK_SITE_TERMO); ?>">Termos de Uso</a></ul>
            <ul class="ocultar"><a href="<?php echo utf8_encode(LINK_SITE_DUVIDA); ?>">Duvidas</a></ul>
            <ul class="ocultar"><a href="<?php echo utf8_encode(LINK_SITE_PARCEIRO); ?>">Parceiros</a></ul>
        </li>
        </nav>
    </div>
    <!-- caixa onde ficará o botão de login-->
    <div class="box-login">
        <?php if(!(isset($_SESSION['idCliente']))){ ?>
            <a href="<?php echo utf8_encode(LINK_SITE_LOGIN); ?>">
                <div class="botao-login">
                    Login
                </div>
            </a>
            <div class="texto-cadastrar">
            <a href="<?php echo utf8_encode(LINK_SITE_CADASTRO); ?>">
                <h1>ou faça seu Cadastro!</h1>
            </a>
            </div>
        <?php }else{ 
            require_once(IMPORT_CLIENTE);
            require_once(IMPORT_CLIENTE_CONTROLLER);

            $cliente = new Cliente();
            $clienteController = new controllerCliente();

            $_GET["id"] = $_SESSION['idCliente']['idCliente'];
            $cliente = $clienteController->buscarCliente();
            
            ?>
            <a href="<?php echo utf8_encode(LINK_SITE_SAIR); ?>">
                <div class="botao-login">
                    Sair
                </div>
            </a>
            <div class="texto-cadastrar">
                <a href="<?php echo utf8_encode(LINK_DASHBOARD_VISUALIZAR_PERFIL); ?>"><h1><?php echo utf8_encode($cliente->getNome()); ?></h1></a>
            </div>
        <?php } ?>
    </div>    
    </div>
</header>