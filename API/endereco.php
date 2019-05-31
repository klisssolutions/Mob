<?php

header("Content-Type: application/json; charset=UTF-8");
@session_start();
$_SESSION["importInclude"] = $_SERVER["DOCUMENT_ROOT"] . "/Mobshare/include.php";

//Require das constantes
require_once($_SESSION["importInclude"]);

//Require da classe funcionário
require_once(IMPORT_ENDERECO_CONTROLLER);

//Pegar as variáveis da url
$modo = (isset($_GET["modo"]) ? strtoupper($_GET["modo"]) : null);

//Inicia a controller
$controllerEndereco = new controllerEndereco();

$result = array(
    "Mensagem" => "Modo Inexistente"
);

if($modo == "LISTAUF"){
    $UFS = $controllerEndereco->listaUF();

    $result = array();

    array_push($result, "Selecione");

    foreach($UFS as $UF){
        array_push($result, $UF);
    }

}else if($modo == "LISTACIDADE"){
    $cidades = $controllerEndereco->listaCidadePorUF();

    $result = array();

    array_push($result, "Selecione");

    foreach($cidades as $cidade){
        array_push($result, $cidade);
    }

}
//Converter para o JSON a variavel result q é gerada pelas ações
echo utf8_encode(json_encode($result));

?>