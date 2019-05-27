<?php
/*
    Projeto: Mobshare
    Autor: Kaio
    Data Criação: 07/05/2019
    Data Modificação: 
    Conteudo Modificação: 
    Autor da Modificação: 
    Objetivo da classe: CRUD da classe de veiculo
*/

//Import do arquivo de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

class enderecoDAO{

    private $conex;

    public function __construct(){
        //Import da classe do banco para todos os métodos
        require_once(IMPORT_CONEXAO);

        //Instancia da classe conexão
        $this->conex = new conexaoMySQL();
    }

public function insertRelacionamento($idEndereco){
    
        $id = $_SESSION['idCliente']['idCliente'];

 
        $sql = INSERT . " cliente_endereco
    (idCliente, idEndereco)
    VALUES (
        '".$id."',
        '".$idEndereco."')";

    

    //Abrindo conexão com o BD
    $PDO_conex = $this->conex->connectDataBase();
echo($sql);
    //Executa no BD o script Insert e retorna verdadeiro/falso
    if($PDO_conex->query($sql)){
        
        $erro = false;
        echo('<script>alert("Endereço cadastrado com sucesso");</script>');
    }else{
        echo($sql);
        $erro = true;
        echo('<script>alert("Erro no cadastro");</script>');
    }
    //Fecha a conexão com o BD
    $this->conex->closeDataBase();
    return $erro;
}

public function selecionarUltimoInserido(){
        $sql = "select max(idEndereco) as idEndereco from endereco";

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        
        echo($sql);

        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        if($rsEndereco = $select->fetch(PDO::FETCH_ASSOC)){
            $idEndereco = $rsEndereco['idEndereco'];
        }

        $this->conex->closeDataBase();
        return($idEndereco);
    }


//Inserir um registro no banco de dados.
public function insert(Endereco $endereco){
    if($endereco->getComplemento()){
        $sql = INSERT . TABELA_ENDERECO . " 
    (rua, numero, cidade, UF, complemento)
    VALUES (
        '".$endereco->getRua()."',
        '".$endereco->getNumero()."',
        '".$endereco->getCidade()."',
        '".$endereco->getUf()."',
        '".$endereco->getComplemento()."')";
    }else{
        $sql = INSERT . TABELA_ENDERECO . " 
    (rua, numero, cidade, UF)
    VALUES (
        '".$endereco->getRua()."',
        '".$endereco->getNumero()."',
        '".$endereco->getCidade()."',
        '".$endereco->getUf()."')";
    }

    

    //Abrindo conexão com o BD
    $PDO_conex = $this->conex->connectDataBase();
    //Executa no BD o script Insert e retorna verdadeiro/falso
    if($PDO_conex->query($sql)){
    
            $idEndereco = $this->selecionarUltimoInserido();
            //Fecha a conexão com o BD
            $this->conex->closeDataBase();
            return $idEndereco;            
            //echo($sql);
        }else{
            $erro = true;
            $this->conex->closeDataBase();
            return $erro;  
            echo($sql);
        }
    
}
//Deletar um registro no banco de dados.
public function delete($id){
    $sql = DELETE . TABELA_ENDERECO . " WHERE idEndereco = ".$id;

    
    //Abrindo conexão com o BD
    $PDO_conex = $this->conex->connectDataBase();
    echo($sql);
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
public function update(Endereco $endereco){
    $sql = UPDATE . TABELA_ENDERECO . "
    SET rua = '".$endereco->getRua()."', 
    numero = '".$endereco->getNumero()."',
    complemento = '".$endereco->getComplemento()."',
    cidade = '".$endereco->getCidade()."',
    UF = '".$endereco->getUf()."'
    WHERE idEndereco = '".$endereco->getIdEndereco()."';";
    
    //Abrindo conexão com o BD
    $PDO_conex = $this->conex->connectDataBase();
    echo($sql);
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
        $sql = SELECT. TABELA_ENDERECO;

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        $cont = 0;
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        while($rsEndereco=$select->fetch(PDO::FETCH_ASSOC)){
            $listEndereco[] = new Endereco();
            $listEndereco[$cont]->setIdEndereco($rsEndereco["idEndereco"]);
            $listEndereco[$cont]->setCidade($rsEndereco["cidade"]);
            $listEndereco[$cont]->setUf($rsEndereco["UF"]);
            $listEndereco[$cont]->setNumero($rsEndereco["numero"]);
            $listEndereco[$cont]->setComplemento($rsEndereco["complemento"]);
            $listEndereco[$cont]->setRua($rsEndereco["rua"]);

            $cont++;
        }

        $this->conex->closeDataBase();

        return($listEndereco);

    }


    //Seleciona um registro pelo ID.
    public function selectById($id){
        $sql = SELECT. TABELA_ENDERECO. " where idEndereco=".$id;

        

        //Abrindo conexão com o BD
        $PDO_conex = $this->conex->connectDataBase();

        //executa o script de select no bd
        $select = $PDO_conex->query($sql);
        
        /* $select->fetch no formado pdo retorna os dados do BD
        também retorna com característica do PDO como o fetch
        é necessário especificar o modelo de conversão.
        EX: PDO::FETCH_ASSOC, PDO::FETCH_ARRAY etc. */
        $rsEndereco=$select->fetch(PDO::FETCH_ASSOC);
        $endereco = new Endereco();
        $endereco->setIdEndereco($rsEndereco["idEndereco"]);
        $endereco->setRua($rsEndereco["rua"]);
        $endereco->setCidade($rsEndereco["cidade"]);
        $endereco->setUf($rsEndereco["UF"]);
        $endereco->setNumero($rsEndereco["numero"]);
        $endereco->setComplemento($rsEndereco["complemento"]);


        $this->conex->closeDataBase();

        return($endereco);
    }
}
?>