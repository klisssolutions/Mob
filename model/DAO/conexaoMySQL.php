<?php
/*
    Projeto: Mobshare
    Autor: Igor
    Data Criação: 23/03/2019
    Data Modificação:
    Conteudo Modificação:
    Autor da Modificação:
    Objetivo da classe: Criar a conexão com o BD MySQL
*/
define("MSG_ERRO_CONEXAO", "Erro ao tentar se conectar com o banco de dados");

class conexaoMySQL{
    private $server;
    private $user;
    private $password;
    private $database;

    public function __construct(){
        // $this ->server = "192.168.1.1";
        // $this ->user = "mob";
        // $this ->password = "kliss123";
        // $this ->database = "dbmob";

        $this ->server = "localhost";
        $this ->user = "root";
        $this ->password = "@dba3636";
        $this ->database = "mydb";
    }

    //Abre conexão com o BD
    public function connectDataBase(){
        try{
            $conexao = new PDO("mysql:host=".$this->server.";dbname=".$this->database, $this->user,$this->password, null);
            return $conexao;
        }catch(PDOException $erro){
            echo utf8_encode(MSG_ERRO_CONEXAO."<br>
                Linha:".$erro->getLine()."<br>
                Mensagem:".$erro->getMessage()
            );
        }
    }

    //Fecha conexão com o BD
    public function closeDataBase(){
        //Pode usar um dos dois comandos abaixo para fechar a conexao
        $conexao = null;
        //Destrói a variável
        unset($conexao);
    }
}
?>