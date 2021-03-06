<?php
@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 
require_once(IMPORT_DUVIDAS_FREQUENTES);
require_once(IMPORT_DUVIDAS_FREQUENTES_CONTROLLER);


    $controllerDuvidasFrequentes = new controllerDuvidasFrequentes();
    $duvidas = new duvidasFrequentes();
    $duvidas = $controllerDuvidasFrequentes->listarDuvidas();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="../images/anuncios.png" />
    <title>Duvidas Frequentes | Mob'Share</title>
</head>
<body>
    <div class="caixa-principal">
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <section class="content">
        <div class="caixa-padrao">
        <div class="box-duvidas">
            <div class="duvidas-titulo">
                <div class="titulo-duvidas">
                    <h2>Duvidas Frequentes</h2>
                </div>
                <div class="image-duvidas">
                    <div class="image-faq">
                        
                    </div>
                </div>
            </div>
            <div class="texto-duvidas">
            <?php
             foreach($duvidas as $duvida){
                 if($duvida->getAtivo()==1){
             ?>  
                
                    
                <div class="duvida">
                    <h2><?php echo utf8_encode($duvida->getPerguntas());?></h2> 
                  
                    <p> <?php echo utf8_encode($duvida->getResposta());?></p>
                </div> 
                    <?php
                 }}
        ?>   
             </div>
         
             
        </div>
                </div>
    </section>
    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>
    
                </div>
    </body>
    
    </html>