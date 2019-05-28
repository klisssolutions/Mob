<?php

@session_start();
@$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";
require_once($_SESSION["importInclude"]); 

require_once(IMPORT_VEICULO);
require_once(IMPORT_VEICULO_CONTROLLER);

require_once(IMPORT_FOTO_VEICULO_CONTROLLER);
require_once(IMPORT_FOTO_VEICULO);

require_once(IMPORT_MODELO_CONTROLLER);
require_once(IMPORT_MODELO);

require_once(IMPORT_MARCA_CONTROLLER);
require_once(IMPORT_MARCA);

require_once(IMPORT_BANNER_CONTROLLER);
require_once(IMPORT_BANNER);

require_once(IMPORT_AVALIACAO_VEICULO_CONTROLLER);
require_once(IMPORT_AVALIACAO_VEICULO);

require_once(IMPORT_AVALIACAO_CONTROLLER);
require_once(IMPORT_AVALIACAO);

$controllerVeiculo = new controllerVeiculo();
$controllerFoto_veiculo = new controllerFoto_Veiculo();
$controllerMarca = new controllerMarca();
$controllerModelo = new controllerModelo();
$controllerBanner = new controllerBanner();
$controllerAvaliacaoVeiculo = new controllerAvaliacaoVeiculo();
$controllerAvaliacao = new controllerAvaliacao();


$veiculos[] = new Veiculo();
$avaliacaoVeiculos[] = new AvaliacaoVeiculo();
$avaliacao[] = new Avaliacao();
$banners[] = new Banner();

$banners = $controllerBanner->listarBanners();
$veiculos = $controllerVeiculo->listarVeiculos();
$avaliacaoVeiculos = $controllerAvaliacaoVeiculo->listarAvaliacaoVeiculos();
$avaliacao = $controllerAvaliacao->listarAvaliacao();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/header.png" />
    <title>Pagina Inicial | MobShare</title>
</head>

<body>
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <div class="content">
    <!-- caixa da imagem -->
        <div class="caixa-pesquisa-imagem">
            <div class="caixa-padrao">
            <div class="caixa-inf">
                <div class="cor-div">
                    <h1>Tenha praticidade nas suas viagens!</h1>
                    <p>Faça locações com a Mobshare e aproveite
                        o que temos a oferecer!
                    </p>
                </div>
            </div>
</div>
        </div>
        <!-- caixa dos veículos -->
        <div class="caixa-padrao">
        <div class="caixa-veiculos-home">
            <div class="caixa-itens-home">
                <nav class="menu-veiculos">
                    <a>Em destaque: </a>
                </nav>
            </div>
            <!-- caixa dos veiculos -->
            <div class="caixa-veiculos">
                <?php
                $i= 0;
                 while($i < count($veiculos)){

                    $foto_veiculo = new Foto_Veiculo();
                    $marca = new Marca();
                    $modelo = new Modelo();
                    $avaliacaoVeiculo = new AvaliacaoVeiculo();
                    $avaliacao = new Avaliacao();


                    $modelo = $controllerModelo->buscarModelos($veiculos[$i]->getIdModelo());
                    $_GET["id"] = $modelo->getIdMarca();
                    $marca = $controllerMarca->buscarMarcas();
                    $foto_veiculo = $controllerFoto_veiculo->listarFotoFrontal($veiculos[$i]->getIdVeiculo());
                    $avaliacaoVeiculo = $controllerAvaliacaoVeiculo->pegarAvaliacaoPorVeiculo($veiculos[$i]->getIdVeiculo());
                      
            ?>
                <!-- caixa onde fica a informaçao do veiculo -->
                <div class="box-veiculo">
                    <div class="img-veiculo">
                        <img src="<?php echo('/Mobshare/arquivos/'.$foto_veiculo->getFotoVeiculo()) ?>" width="320" height="225" alt="<?php echo($modelo->getNomeModelo())?>">
                    </div>
                    <div class="texto-modelo">
                        <?php echo($modelo->getNomeModelo())?>
                    </div>
                    <div class="texto-km">
                        Marca: <?php echo($marca->getNomeMarca())?>
                    </div>
                    <div class="texto-regiao">
                        Ano: <?php echo($veiculos[$i]->getAno())?>

                    </div>
                    <div class="texto-avaliacao">
                    <img src="images/5estrelas.png" width="150" height="30" alt="veiculo">

                    </div>
                    <div class="botao-veiculo">
                        <a href="locacao/dadosVeiculo.php?id=<?php echo ($veiculos[$i]->getIdVeiculo()); ?>">Veja mais</a>
                    </div>
                </div>

                <?php
                    $i++;
                    }
                ?>

            </div>
                </div>
                <?php
                $i = 0;
                while($i < count($banners)){
                if($i%2){

        ?>
        
        <div class="caixa-padrao">
            <div class="caixa-como-funciona">
                <div class="texto-como-funciona">
                        <h1><?php echo($banners[$i]->getTitulo())?></h1>
                        <p><?php echo($banners[$i]->getTexto())?></p>
                        <a href="<?php echo($banners[$i]->getHref())?>">
                            <h2><?php echo($banners[$i]->getNomeBotao())?></h2>
                        </a>
                </div>
                <div class="img-como-funciona">
                    <img class="cm-segunda-imagem" src="<?php echo('/Mobshare/arquivos/'.$banners[$i]->getImagem())?>" width="600" height="590" alt="<?php echo($banners[$i]->getTitulo())?>">
                </div>
            
            </div>

                <?php
                $i++;
            }else{
        ?>
      <div class="caixa-como-funciona">
                <div class="img-como-funciona">
                    <img class="cm-primeira-imagem" src="<?php echo('/Mobshare/arquivos/'.$banners[$i]->getImagem())?>" width="600" height="480" alt="<?php echo($banners[$i]->getTitulo())?>">
                </div>
                <div class="texto-como-funciona">
                    <h1><?php echo($banners[$i]->getTitulo())?></h1>
                    <p><?php echo($banners[$i]->getTexto())?></p>
                    <a href="<?php echo($banners[$i]->getHref())?>">
                        <h2><?php echo($banners[$i]->getNomeBotao())?></h2>
                    </a>
                </div>
                
        </div>   
            </div> 
            <?php
            $i++;
                }
                }
            ?>
            
        </div>
    </div>

    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>

</body>

</html>
