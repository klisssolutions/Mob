<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

 $router = "router('CLIENTES', 'INSERIR', '0')";

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/anuncios.png"/>
    <script  src="js/jquery.js"></script>
    <script  src="js/link.js"></script>
    <title>Cadastro | Mob'Share</title>
</head>
<body>
    <div class="content-cadastro">
        <div class="caixa-padrao">
        <div class="cadastro">
        <form class="s" method="POST" action="../router.php?controller=clientes&modo=inserir" id="form" enctype="multipart/form-data">

            <div class="img-cadastro">
                <img src="images/user.png" id="prev" width="150" height="150"  alt="Foto de perfil">
            </div>

            <div class="txt-div-cadastro">
                <input class="inpt-foto" type="file" name="imgPerfil" onchange="preview(this)">
               
            </div>
            <div class="txt-cadastro">
                <h1>Nome:</h1>
                <input type="text" name="txtnome" class="ipt-cad" value="" placeholder="Digite seu nome completo" required>
            </div>
            <div class="txt-cadastro">
                <h1>E-mail:</h1>
                <input type="email" name="txtemail" class="ipt-cad" value="" placeholder="Ex: joao@gmail.com" required>
            </div>
            <div class="txt-cadastro">
                <h1>Senha:</h1>
                <input type="password" name="txtsenha" class="ipt-cad" value="" placeholder="Digite uma senha" required>
            </div>
            <div class="txt-div-cadastro">
                <h1>CPF:</h1>
                <input type="text" name="txtcpf" class="ipt-cads" value="" placeholder="XXX.XXX.XXX-XX" required>
            </div>
            <div class="txt-div-cadastro">
                <h1>Data de Nascimento:</h1>
                <input type="date" name="txtdtnasc" class="ipt-cads" value="" required>
            </div>
            <div class="txt-div-cadastro">
                <h1>Numero da CNH:</h1>
                <input type="text" name="txtcnh" class="ipt-cads" value="" placeholder="Digite sua CNH">
            </div>
            <div class="txt-div-cadastro">
                <h1>Tipo da CNH:</h1>
                <select class="ipt-cads" name="txtCategoriaCnh" >
                    <option value="">Selecione a categoria</option>
                    <option value="A">Tipo A</option>
                    <option value="B">Tipo B</option>
                    <option value="AB">Tipo AB</option>
                </select>
            </div>
            <div class="aceite-termo">
            <label>Ao clicar em cadastrar declaro que aceito os <a href="termosdeuso/termosdeuso.php"><span class="link">termos de uso.</span></a></label>
        <br><label>Já tem login?  <a href="<?php echo utf8_encode(LINK_SITE_LOGIN); ?>"><span class="link">Entrar</span></a></label>
            </div>
            <div class="aceite-termo">
                <input type="submit" class="btn-cad" value="Cadastrar"/>
            </div>
        </form>
</div>
        </div>
       
    </div>              
</body>
</html>