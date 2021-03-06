<?php
/*
    Projeto: MobShare
    Autor: Kaio
    Data Criação: 07/05/2019
    Data Modificação:
    Conteudo Modificação:
    Autor da Modificação:
    Objetivo da classe: Controller de endereços
*/

(@session_start());
require_once($_SESSION["importInclude"]);

class controllerEndereco{

    public function __construct(){
        //Import da classe nivel
        require_once(IMPORT_ENDERECO);

        //Import da classe nivelDAO, para inserir no BD
        require_once(IMPORT_ENDERECO_DAO);
    }

    public function inserirEndereco(){
        //Instancia do DAO criado para ser usado em todos os outros métodos
        $enderecoDAO = new enderecoDAO();
        
        //Verifica qual metodo esta sendo requisitado do formulario(POST ou GET)
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $rua = $_POST["txtRua"];
            $complemento = $_POST["txtComplemento"];
            $numero = $_POST["txtNumber"];
            $uf = $_POST["txtUf"];
            $cidade = $_POST["txtCidade"];

            //Instancia da classe
            $endereco = new Endereco();

            //Guardando os dados do post no objeto da classe
            $endereco->setRua($rua);
            $endereco->setComplemento($complemento);
            $endereco->setNumero($numero);
            $endereco->setUf($uf);
            $endereco->setCidade($cidade);
            

            /* Chamada para o metodo de inserir no BD, passando como parâmetro o objeto
            marcaClass que tem todos os dados que serão inseridos no banco de dados */
            $lastId = $enderecoDAO->insert($endereco);

            return $enderecoDAO->insertRelacionamento($lastId);

            
        }
    }

    public function excluirEndereco(){
        //Instancia do DAO
        $enderecoDAO = new enderecoDAO();
        //Esse id foi enviado pela view no href, o arquivo de rota é quem chamou este método
        $id = $_GET["id"];

        //Chamada para o método de excluir um nivel
        return $enderecoDAO->delete($id);
    }


    public function atualizarEndereco(){
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            $id = $_GET["id"];
            $rua = $_POST["txtRua"];
            $cidade = $_POST["txtCidade"];
            $numero = $_POST["txtNumber"];
            $uf = $_POST["txtUf"];
            $complemento = $_POST["txtComplemento"];

            //Instancia da classe
            $endereco = new Endereco();
            $enderecoDAO = new enderecoDAO();

            //Guardando os dados do post no objeto da classe
            $endereco->setIdEndereco($id);
            $endereco->setRua($rua);
            $endereco->setCidade($cidade);
            $endereco->setNumero($numero);
            $endereco->setUf($uf);
            $endereco->setComplemento($complemento);
            
            
            /* Chamada para o metodo de inserir no BD, passando como parâmetro o objeto
            contatoClass que tem todos os dados que serão inseridos no banco de dados */
            return $enderecoDAO->update($endereco);
        }
    }

    public function buscarEndereco(){
        //ARRUMAR A BUSCA para a pagina inicial
        $id = $_GET['id'];

        $enderecoDAO = new enderecoDAO();
        
        return $enderecoDAO->selectById($id);
    }

      

    public function listarEnderecos(){
        //Instancia do DAO
        $enderecoDAO = new enderecoDAO();
        return $enderecoDAO->selectAll();
    }


    public function listaUF(){
        //Instancia do DAO
        $enderecoDAO = new enderecoDAO();
        return $enderecoDAO->selecionarUF();
    }


    public function listaCidadePorUF(){
        $UF = $_GET['cbUF'];
        //Instancia do DAO
        $enderecoDAO = new enderecoDAO();
        return $enderecoDAO->selecionarCidadesPorUF($UF);
    }
}
?>