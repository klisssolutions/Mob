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

require_once(IMPORT_SOLICITACAO_LOCACAO_CONTROLLER);
require_once(IMPORT_SOLICITACAO_LOCACAO);

if(isset($_GET["alugar"])){
    $_GET["id"] = $_SESSION['idVeiculo'];

    echo utf8_encode("<script>alert('Locação solicitada.')</script>");

    $controllerSolicitacao = new controllerSolicitacao_Locacao();
    $_GET["idCliente"] = $_SESSION['idCliente']['idCliente'];
    $_GET["idVeiculo"] = $_SESSION['idVeiculo'];
    $_GET["txtHorarioInicio"] = $_GET["diaInicio"] . " " . $_GET["horaInicio"];
    $_GET["txtHorarioFim"] = $_GET["diaTermino"] . " " . $_GET["horaTermino"];

    $controllerSolicitacao->inserirSolicitacao_Locacao();
}

$controllerVeiculo = new controllerVeiculo();
$controllerFoto_veiculo = new controllerFoto_Veiculo();
$controllerMarca = new controllerMarca();
$controllerModelo = new controllerModelo();

$veiculo = new Veiculo();

$id = $_GET["id"];
$_SESSION['idVeiculo'] = $id;

$veiculo = $controllerVeiculo->buscarVeiculo();
$foto_veiculo = new Foto_Veiculo();
$marca = new Marca();
$modelo = new Modelo();
$modelo = $controllerModelo->buscarModelo($veiculo->getIdModelo());
$_GET["id"] = $modelo->getIdMarca();
$marca = $controllerMarca->buscarMarcas();
$foto_veiculo = $controllerFoto_veiculo->listarFotoFrontal($veiculo->getIdVeiculo());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="images/anuncios.png" />
    <title><?php echo utf8_encode($marca->getNomeMarca() . " " . $modelo->getNomeModelo());?> | Mob'Share</title>
</head>

<body>
    <!-- HEADER DO MENU-->
    <?php require_once(HEADER);?>
    <!-- CAIXA QUE SEGURA O CONTEÚDO EMBAIXO DO MENU -->
    <div class="content">
        <div class="caixa-dados-veiculo">    
        <div class="caixa-padrao">
            <div class="dados-veiculo">
                <div class="foto-dados-veiculo">
                        <img src="<?php echo utf8_encode('/Mobshare/arquivos/'.$foto_veiculo->getFotoVeiculo()) ?>" width="610" height="400" alt="veiculo">
                </div>
                <form method="GET">
                <div class="usuario-dados-veiculo">
                    <h2>Marca: <?php echo utf8_encode($marca->getNomeMarca());?></h2>
                    <h1><?php echo utf8_encode($modelo->getNomeModelo());?></h1>
                    <h2>Ano: 2016</h2>
                    <h1>R$ <?php echo utf8_encode($veiculo->getValorHora()); ?>/H</h1>
                    <h3><img src="../images/5estrelas.png" width="200" height="35" alt="veiculo"></h3>
                </div>
                <?php if(isset($_SESSION['idCliente']['idCliente'])):?>
                <div class="box-locar">
                <p>
                Inicio:  <input class="inpt-data" type="date" name="diaInicio" id="diaComeco" required>
                <input class="inpt-hora" type="time" name="horaInicio" id="horaComeco" required> 

                Fim:                             
                <input class="inpt-data" type="date" name="diaTermino" id="diaTermino" required>
                <input class="inpt-hora" type="time" name="horaTermino" id="horaTermino" required>
                </p>
                <input type="submit" value="Quero alugar este!" class="inpt-dados" name="alugar">
                </div>
            </div>
                <?php endif; ?>
                
                </form>
            
                </div>
                
            </div>
        </div>
    </div>

    <!-- RODAPÉ-->
    <?php require_once(FOOTER);?>
    <script>
        function horas(){
            dataComeco = new Date(diaComeco.value + " " + horaComeco.value);
            dataTermino = new Date(diaTermino.value + " " + horaTermino.value);
            horasAluguel = Math.abs(dataComeco.getTime() - dataTermino.getTime()) / 3600000;

            alert(horasAluguel);
        }
    </script>

</body>

</html>
