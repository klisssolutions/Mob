<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]);
if(isset($_SESSION['idCliente'])){
    if($_SESSION['idCliente'] != null){
        header("location: " . LINK_SITE_HOME);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="view/images/anuncios.png" />
    <title>Login</title>
</head>
<body>
    <div class="caixa-principal">
    
    <div class="content-login">
        <form class="login" method="POST" action="../router.php?controller=clientes&modo=logar">
            <div class="img-login">
               <a href="<?php echo utf8_encode(LINK_SITE_HOME); ?>"><img src="images/logo.png" width="364" height="150"  alt="MobShare"></a>
            </div>
            <div class="txt-login">
                <h1>Login:</h1>
                <input type="text" name="txtemail" class="input-login">
            </div>
            <div class="txt-login">
                <h1>Senha:</h1>
                <input type="password" name="txtsenha" class="input-login">
            </div>
            <div class="btn-login">
                <button class="btn-login-form">Entrar</button>
                <p>Não é cadastrado?  <a href="<?php echo utf8_encode(LINK_SITE_CADASTRO); ?>"><span class="link">Cadastrar!</span></a></p>
            </div>
        </form>
        <div class="rodape-login">
        </div>
    </div>
    
</div>
</body>
</html>