<?php
/*
    Projeto: Mobshare
    Autor: Leonardo
    Data Criação: 02/04/2019
    Data Modificação: 
    Conteudo Modificação: 
    Autor da Modificação: 
    Objetivo da classe: CRUD da classe de veiculo
*/

//Import do arquivo de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

class veiculoDAO{

    private $conex;

    public function __construct(){
        //Import da classe do banco para todos os métodos
        require_once(IMPORT_CONEXAO);

        //Instancia da classe conexão
        $this->conex = new conexaoMySQL();
    }

     public function selecionarUltimoInserido(){
        $sql = "select max(idVeiculo) as idVeiculo from veiculo";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);

        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        if($rsVeiculo = $select->fetch(PDO::FETCH_ASSOC)){
            $idVeiculo = $rsVeiculo ['idVeiculo'];
        }

        $this->conex->closeDataBase();
        return($idVeiculo);
    }

    //Inserir um registro no banco de dados.
    public function insert(Veiculo $veiculo){
        $sql = INSERT . TABELA_VEICULO . " 
        (cor, altura, comprimento, largura, valorHora, 
        ano, quilometragem, idCategoria_Veiculo, idModelo, 
        idEndereco, idCliente)
        VALUES (
        '".$veiculo->getCor()."',
        '".$veiculo->getAltura()."',
        '".$veiculo->getComprimento()."',
        '".$veiculo->getLargura()."',
        '".$veiculo->getValorHora()."',
        '".$veiculo->getAno()."',
        '".$veiculo->getQuilometragem()."',
        '".$veiculo->getIdCategoriaVeiculo()."',
        '".$veiculo->getIdModelo()."',
        '".$veiculo->getIdEndereco()."',
        '".$veiculo->getIdCliente()."')";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
    
            $idVeiculo = $this->selecionarUltimoInserido();
            //Fecha a conexão com o BD
            $this->conex->closeDataBase();
            return $idVeiculo;            
            //echo utf8_encode($sql);
        }else{
            $erro = true;
            $this->conex->closeDataBase();
            return $erro;  
        }

    }

    //Deletar um registro no banco de dados.
    public function delete($id){
        $sql = DELETE . TABELA_VEICULO . " where idVeiculo =".$id;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $erro = false;
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }

    //Atualiza um registro no banco de dados.
    public function update(Veiculo $veiculo){
       $sql = UPDATE . TABELA_VEICULO . " 
        SET cor = '".$veiculo->getCor()."',
            altura = '".$veiculo->getAltura()."',
            comprimento = '".$veiculo->getComprimento()."',
            largura = '".$veiculo->getLargura()."',
            valorHora = '".$veiculo->getValorHora()."',
            ano = '".$veiculo->getAno()."',
            quilometragem = '".$veiculo->getQuilometragem()."',
            idEndereco = '".$veiculo->getIdEndereco()."',
            idModelo = '".$veiculo->getIdModelo()."',
            idCategoria_Veiculo = '".$veiculo->getIdCategoriaVeiculo()."'
        WHERE idVeiculo = '".$veiculo->getIdVeiculo()."';";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();
        echo utf8_encode($sql);
        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $idVeiculo = $this->selecionarUltimoInserido();
            echo utf8_encode('<script>alert("Veiculo Atualizado com sucesso")</script>');
            $erro = false;
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }

    //Lista todos os registros do banco de dados.
    public function selectAll(){
        $sql = SELECT.TABELA_VEICULO ." order by rand()";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        while($rsVeiculos=$select->fetch(PDO::FETCH_ASSOC)){
            $listVeiculos[] = new Veiculo();
            $listVeiculos[$cont]->setIdVeiculo($rsVeiculos["idVeiculo"]);
            $listVeiculos[$cont]->setIdCategoriaVeiculo($rsVeiculos["idCategoria_Veiculo"]);
            $listVeiculos[$cont]->setIdCliente($rsVeiculos["idCliente"]);
            $listVeiculos[$cont]->setIdModelo($rsVeiculos["idModelo"]);
            $listVeiculos[$cont]->setCor($rsVeiculos["cor"]);
            $listVeiculos[$cont]->setAltura($rsVeiculos["altura"]);
            $listVeiculos[$cont]->setComprimento($rsVeiculos["comprimento"]);
            $listVeiculos[$cont]->setLargura($rsVeiculos["largura"]);
            $listVeiculos[$cont]->setValorHora($rsVeiculos["valorHora"]);
            $listVeiculos[$cont]->setAno($rsVeiculos["ano"]);
            $listVeiculos[$cont]->setQuilometragem($rsVeiculos["quilometragem"]);
            
            $listVeiculos[$cont]->setIdEndereco($rsVeiculos["idEndereco"]);
            
            $cont++;
        }

        $this->conex->closeDataBase();
        return($listVeiculos);
    }

    public function selectAllCliente($cliente){
        $sql = SELECT.TABELA_VEICULO . " where idCliente= " . $cliente;


        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        $listVeiculos[] = new veiculo;
        $listVeiculos = null;
        while($rsVeiculos=$select->fetch(PDO::FETCH_ASSOC)){
            $listVeiculos[] = new Veiculo();
            $listVeiculos[$cont]->setIdVeiculo($rsVeiculos["idVeiculo"]);
            $listVeiculos[$cont]->setIdCategoriaVeiculo($rsVeiculos["idCategoria_Veiculo"]);
            $listVeiculos[$cont]->setIdCliente($rsVeiculos["idCliente"]);
            $listVeiculos[$cont]->setIdModelo($rsVeiculos["idModelo"]);
            $listVeiculos[$cont]->setCor($rsVeiculos["cor"]);
            $listVeiculos[$cont]->setAltura($rsVeiculos["altura"]);
            $listVeiculos[$cont]->setComprimento($rsVeiculos["comprimento"]);
            $listVeiculos[$cont]->setLargura($rsVeiculos["largura"]);
            $listVeiculos[$cont]->setValorHora($rsVeiculos["valorHora"]);
            $listVeiculos[$cont]->setAno($rsVeiculos["ano"]);
            $listVeiculos[$cont]->setQuilometragem($rsVeiculos["quilometragem"]);
            
            $listVeiculos[$cont]->setIdEndereco($rsVeiculos["idEndereco"]);
            
            $cont++;
        }

        $this->conex->closeDataBase();
        return($listVeiculos);
    }

    //Seleciona um registro pelo ID.
    public function selectById($id){
        $sql = SELECT . TABELA_VEICULO . " WHERE idVeiculo=".$id;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);

        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        if($rsVeiculo = $select->fetch(PDO::FETCH_ASSOC)){
            $veiculo = new Veiculo();
            $veiculo->setIdVeiculo($rsVeiculo["idVeiculo"]);
            $veiculo->setIdCategoriaVeiculo($rsVeiculo["idCategoria_Veiculo"]);
            $veiculo->setIdCliente($rsVeiculo["idCliente"]);
            $veiculo->setIdModelo($rsVeiculo["idModelo"]);
            $veiculo->setCor($rsVeiculo["cor"]);
            $veiculo->setAltura($rsVeiculo["altura"]);
            $veiculo->setComprimento($rsVeiculo["comprimento"]);
            $veiculo->setLargura($rsVeiculo["largura"]);
            $veiculo->setValorHora($rsVeiculo["valorHora"]);
            $veiculo->setAno($rsVeiculo["ano"]);
            $veiculo->setQuilometragem($rsVeiculo["quilometragem"]);
            $veiculo->setIdEndereco($rsVeiculo["idEndereco"]);
        }

        $this->conex->closeDataBase();
        return($veiculo);
    }

    public function filtrarVeiculos($marca, $modelo){
        $sql = SELECT.TABELA_VEICULO;

        if($modelo != "0"){
            $sql = $sql . " where idModelo =" . $modelo  ;    
        }else{
            $sql = $sql . " where idModelo <>" . $modelo ;
        }
        if($marca != "0"){
            $sql = $sql . " and idModelo in(select idModelo from modelo where idMarca = ".$marca.")"  ;    
        }

        // if($KM != "padrao"){
        //     if($KM = "500000"){
        //         $sql = $sql . " and quilometragem > ".$KM  ;
        //     }else if($KM = "0"){
        //         $sql = $sql . " and quilometragem = ".$KM  ;   
        //     }else{
        //         $sql = $sql . " and quilometragem < ".$KM  ;
        //     }
        //     echo utf8_encode($KM);
        // }

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
    
        $listVeiculos[] = new Veiculo();
        $listVeiculos = null;
        while($rsVeiculos=$select->fetch(PDO::FETCH_ASSOC)){
            $veiculo = new Veiculo();
            $veiculo->setIdVeiculo($rsVeiculos["idVeiculo"]);
            $veiculo->setIdCategoriaVeiculo($rsVeiculos["idCategoria_Veiculo"]);
            $veiculo->setIdCliente($rsVeiculos["idCliente"]);
            $veiculo->setIdModelo($rsVeiculos["idModelo"]);
            $veiculo->setCor($rsVeiculos["cor"]);
            $veiculo->setAltura($rsVeiculos["altura"]);
            $veiculo->setComprimento($rsVeiculos["comprimento"]);
            $veiculo->setLargura($rsVeiculos["largura"]);
            $veiculo->setValorHora($rsVeiculos["valorHora"]);
            $veiculo->setAno($rsVeiculos["ano"]);
            $veiculo->setQuilometragem($rsVeiculos["quilometragem"]);
            $veiculo->setIdEndereco($rsVeiculos["idEndereco"]);
            
            $listVeiculos[$cont] = $veiculo;
            
            $cont++;
        }

        $this->conex->closeDataBase();

        return($listVeiculos);
    }
}
?>
