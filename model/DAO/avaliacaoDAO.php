<?php
/*
    Projeto: Mobshare
    Autor: Emanuelly
    Data Criação: 11/04/2019
    Data Modificação: 
    Conteudo Modificação: 
    Autor da Modificação: 
    Objetivo da classe: Select da Classe de Avaliação
*/

//Import do arquivo de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

class avaliacaoDAO{

    private $conex;

    public function __construct(){
        //require_once(IMPORT_AVALIACAO_VEICULO);

        //Import da classe DAO, para inserir no BD
        //require_once(IMPORT_AVALIACAO_VEICULO_DAO);
        //Import da classe do banco para todos os métodos
        require_once(IMPORT_CONEXAO);

        //Instancia da classe conexão
        $this->conex = new conexaoMySQL();
    }

    public function selecionarUltimoIdAvaliacao(){
        $sql = "select max(idAvaliacao) as idAvaliacao from " . TABELA_AVALIACAO;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);

        $idAvaliacao=0;
        if($rsAvalicao=$select->fetch(PDO::FETCH_ASSOC)){
            $idAvaliacao = $rsAvalicao['idAvaliacao'];
        }

        $this->conex->closeDataBase();

        return($idAvaliacao);
    }


    //idAvaliado é o id de quem estará sendo avaliado (veiculo ou cliente), o tipo de avaliacao será se é veiculo ou cliente
    public function insert(Avaliacao $avaliacao, $tipoAvaliacao){


        

        $sql = INSERT . TABELA_AVALIACAO . " 
        (nota, depoimento, idLocacao)
        VALUES (
        ".$avaliacao->getNota().",
        '".$avaliacao->getDepoimento()."',
        ".$avaliacao->getIdLocacao().")";



            
 

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //Executa no BD o script Insert e retorna verdadeiro/falso
        if($PDO_conex->query($sql)){
            $idAvaliacao = $this->selecionarUltimoIdAvaliacao();
            
            $erro = $this->amarrarAvaliacao($tipoAvaliacao, $idAvaliacao, $avaliacao->getIdLocacao());
        }else{
            $erro = true;
        }
        //Fecha a conexão com o BD
        $this->conex->closeDataBase();
        return $erro;
    }


    
    public function amarrarAvaliacao($tipoAvaliacao, $idAvaliacao, $idLocacao){

        
        if(strtoupper($tipoAvaliacao) == "VEICULO"){
            $sql = INSERT . TABELA_AVALIACAO_VEICULO . " 
            (idVeiculo, idAvaliacao)
            VALUES (
            (select idVeiculo from solicitacao_locacao as sl join locacao as l 
            on sl.idSolicitacao_Locacao = l.idSolicitacao_Locacao where 
            l.idLocacao = ".$idLocacao."),    
            ".$idAvaliacao.")";
            
        }else if(strtoupper($tipoAvaliacao) == "CLIENTE"){
            $sql = INSERT . TABELA_AVALIACAO_CLIENTE . " 
            (idCliente, idAvaliacao)
            VALUES (
            (select idCliente from solicitacao_locacao as sl join locacao as l 
            on sl.idSolicitacao_Locacao = l.idSolicitacao_Locacao where 
            l.idLocacao = ".$idLocacao."),    
            ".$idAvaliacao.")";
        }

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

   


    //Deletar um registro no banco de dados.
    public function delete($id){
        $sql = DELETE . TABELA_AVALIACAO . " where idAvaliacao =".$id;

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



    //Lista todos os registros do banco de dados.
    public function selectAll(){
        $sql = SELECT.TABELA_AVALIACAO;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* instaciar antes do while serve para não dá erro
        quando não houver nenhum registro*/
        $listAvaliacao[] = new Avaliacao();
        $listAvaliacao = null;
        while($rsAvalicao=$select->fetch(PDO::FETCH_ASSOC)){
            $avaliacao = new Avaliacao();
            $avaliacao->setIdAvaliacao($rsAvalicao["idAvaliacao"]);
            $avaliacao->setNota($rsAvalicao["nota"]);
            $avaliacao->setDepoimento($rsAvalicao["depoimento"]);
            $avaliacao->setIdLocacao($rsAvalicao["idLocacao"]);

            $listAvaliacao[$cont] = $avaliacao;
            $cont++;
        }

        $this->conex->closeDataBase();

        return($listAvaliacao);

    }

    public function selectById($id){
        $sql = SELECT . TABELA_AVALIACAO . " WHERE idAvaliacao =".$id;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);

        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        if($rsAvalicao=$select->fetch(PDO::FETCH_ASSOC)){
            $avaliacao = new Avaliacao();
            $avaliacao->setIdAvaliacao($rsAvalicao["idAvaliacao"]);
            $avaliacao->setNota($rsAvalicao["nota"]);
            $avaliacao->setDepoimento($rsAvalicao["depoimento"]);
            $avaliacao->setIdLocacao($rsAvalicao["idLocacao"]);
        }

        $this->conex->closeDataBase();

        return($avaliacao);
    }

}

?>