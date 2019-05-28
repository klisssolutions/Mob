<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

require_once(IMPORT_TERMOS);
require_once(IMPORT_TERMOS_CONTROLLER);


$controllerTermos = new controllerTermos();
$termos[] = new Termos();
$termos = $controllerTermos->listarTermos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/anuncios.png" />
    <title>Termos de Uso | Mob'Share</title>
</head>
<body>
    <div class="caixa-principal">
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <section class="content">
        <div class="box-termos">
            <div class="image-termos">
                <div class="caixa-padrao">
                <div class="texto-sob-imagem">
                    <h2>Termos de Uso</h2>
                </div>
            </div>              
            </div>
            <div class="caixa-padrao">
            <div class="texto-termos">
            <?php
                foreach($termos as $termo){
                    if($termo->getAtivo()== 1){
            ?>
                <div class="termo">
                    <p> 
                    <?php echo($termo->getTexto());?> 
                    </p>
                </div>
            <?php }} ?> 
            </div>
                    </div>
        </div>

    </section>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>
                    </div>
    </body>

</html>