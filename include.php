<?php
/*
    Projeto: MobShare
    Autor: Igor
    Data Criação: 23/03/2019
    Data Modificação: 04/06/2019
    Conteudo Modificação: Include CSS
    Autor da Modificação: Igor
    Objetivo: Arquivo com constantes para usar em outras classes
*/

//Verificaa se o arquivo já foi importado
if(!isset($incluso)){
	ini_set('display_errors', 1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    //Set uma variável para verificar se o arquivo foi importado
    $incluso = true;
    /*---------------------------------------------------------------*/
    /*--------------------------- FUNÇÕES ---------------------------*/
    /*---------------------------------------------------------------*/
    //Essa função recebe o número de permissão e o número do módulo para
    //verificar se tem acesso ao módulo
    function acessoModulo($permissoes, $modulo){
        //Retira as permissões dos módulos anteriores para comparar
        $permissoesModulo = $permissoes % ($modulo*2);
        //Verificar se a permissão é maior ou igual ao módulo se for
        //ele tem acesso ao módulo(bit ligado)
        if($permissoesModulo >= $modulo){
            return true;
        }else{
            return false;
        }
    }

    //Função para tratar a imagem recebida do upload
    function enviarImagem($item){
        $foto = $item['name'];
        $tamanho_foto = $item['size'];
        $tamanho_foto = round($tamanho_foto/1024);
        $ext_foto = strrchr($foto, ".");
        $nome_foto = pathinfo($foto, PATHINFO_FILENAME);
        $nome_foto = md5(uniqid(time()).$nome_foto);
        $diretorio = RAIZ_IMPORT . "/arquivos/";
        $extensao = array(".jpg",".png",".jpeg");
        if(in_array($ext_foto, $extensao)){
            if($tamanho_foto<=2000){
                $foto_tmp = $item['tmp_name'];
                $arquivo = $nome_foto.$ext_foto;
                
                if(move_uploaded_file($foto_tmp, $diretorio.$arquivo)){
                    return $arquivo;
                }else{
                    $arquivo = null;
                    return $arquivo;
                }
                return $arquivo;
            }
        }
        return $arquivo;
    }
    //Função para gerar um alert no JS
    function alert($texto){
        return "<script>alert('".$texto."');</script>";
    }

    /*----------------------------------------------------------------------*/
    /*--------------------------- BANCO DE DADOS ---------------------------*/
    /*----------------------------------------------------------------------*/

    //Constantes de Banco de dados
    define("SELECT","SELECT * FROM ");
    define("INSERT","INSERT INTO ");
    define("UPDATE","UPDATE ");
    define("DELETE","DELETE FROM ");
    define("ERRO_SCRIPT","Erro de script.<br>");
    define("SUCESSO_SCRIPT","Script executado com sucesso.<br>");

    //Constantes com o nome das tabelas
    define("TABELA_FUNCIONARIO", "usuario_web");
    define("TABELA_NIVEL", "nivel");
    define("TABELA_PARCEIRO", "parceiro");
    define("TABELA_FUNCIONAMENTO", "funcionamento");
    define("TABELA_CLIENTE", "cliente");
    define("TABELA_VEICULO", "veiculo");
    define("TABELA_FOTO_VEICULO", "foto_veiculo");
    define("TABELA_TERMOS", "termo");  
    define("TABELA_AVALIACAO_VEICULO", "avaliacao_veiculo");
    define("TABELA_AVALIACAO_CLIENTE", "avaliacao_cliente");
    define("TABELA_AVALIACAO", "avaliacao");
    define("TABELA_MARCA", "marca");
    define("TABELA_MODELO","modelo");
    define("TABELA_FALE_CONOSCO","fale_conosco");
    define("TABELA_DUVIDAS_FREQUENTES","pergunta_frequente");
    define("TABELA_CHAT","mensagem_chat");
    define("TABELA_CATEGORIA","categoria_veiculo");
    define("TABELA_ENDERECO","endereco");
    define("TABELA_TIPO","tipo_veiculo");
    define("TABELA_SOLICITACAO_LOCACAO","solicitacao_locacao");
	define("TABELA_BANNER", "banner");
    define("TABELA_CANCELAMENTO", "cancelamento");
    define("TABELA_LOCACAO", "locacao");

    //Constantes com o nome das views
    define("VIEW_VEICULO", "vpendencia_veiculo");
    define("VIEW_USUARIO", "vpendencia_cliente");
    define("VIEW_AVALIACAO_VEICULO", "vavaliacao_veiculo");
    define("VIEW_ANUNCIOS", "vanuncios_mobile");
    define("VIEW_DETALHE_VEICULO", "vdetalhes_veiculo");
	define("VIEW_LOCACAO", "v_detalhes_locacao");
    define("VIEW_CANCELAMENTO", "vvisualizacao_cancelamento");
    
    /*---------------------------------------------------------------*/
    /*--------------------------- NÚMEROS ---------------------------*/
    /*---------------------------------------------------------------*/

    //Permissao de modulos cada módulo. Cada módulo terá 1 bit, se estiver ligado
    //significa que ele terá acesso ao módulo
    define("MODULO_FUNCIONARIO",    0b1000000);
    define("MODULO_MARKETING",      0b0100000);
    define("MODULO_LOCACAO",        0b0010000);
    define("MODULO_PAGINA",         0b0001000);
    define("MODULO_APROVACAO",      0b0000100);
    define("MODULO_CANCELAMENTO",   0b0000010);
    define("MODULO_MODELO",         0b0000001);

    //Constantes de pendencia
    define("PENDENCIA_ABERTA",  0b1);
    define("PENDENCIA_FECHADA", 0b0);

    /*--------------------------------------------------------------*/
    /*--------------------------- PASTAS ---------------------------*/
    /*--------------------------------------------------------------*/

    //Constantes com endereço da pasta para importar
    define("PASTA_RAIZ" , $_SERVER["DOCUMENT_ROOT"]);
    define("PASTA_PROJETO", "/Mobshare");
    define("PASTA_LINK", "http://www.mob.com.br");
    //define("PASTA_LINK", "http://localhost");
    define("RAIZ_IMPORT", PASTA_RAIZ . PASTA_PROJETO);
    define("RAIZ_LINK", PASTA_LINK . PASTA_PROJETO);

    /*---------------------------------------------------------------*/
    /*--------------------------- CLASSES ---------------------------*/
    /*---------------------------------------------------------------*/

    //Import de conexão com o banco
    define("IMPORT_CONEXAO", RAIZ_IMPORT . "/model/DAO/conexaoMySQL.php");

    //Imports de nível
    define("IMPORT_NIVEL", RAIZ_IMPORT . "/model/nivelClass.php");
    define("IMPORT_NIVEL_DAO", RAIZ_IMPORT . "/model/DAO/nivelDAO.php");
    define("IMPORT_NIVEL_CONTROLLER", RAIZ_IMPORT . "/controller/controllerNivel.php");

    //Imports de funcionario
    define("IMPORT_FUNCIONARIO", RAIZ_IMPORT . "/model/funcionarioClass.php");
    define("IMPORT_FUNCIONARIO_DAO", RAIZ_IMPORT . "/model/DAO/funcionarioDAO.php");
    define("IMPORT_FUNCIONARIO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerFuncionario.php");

    //Imports de pendencia
    define("IMPORT_PENDENCIA", RAIZ_IMPORT . "/model/pendenciaClass.php");
    define("IMPORT_PENDENCIA_DAO", RAIZ_IMPORT . "/model/DAO/pendenciaDAO.php");
    define("IMPORT_PENDENCIA_CONTROLLER", RAIZ_IMPORT . "/controller/controllerPendencia.php");

    //Imports de Parceiros
    define("IMPORT_PARCEIRO", RAIZ_IMPORT . "/model/parceiroClass.php");
    define("IMPORT_PARCEIRO_DAO", RAIZ_IMPORT . "/model/DAO/parceiroDAO.php");
    define("IMPORT_PARCEIRO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerParceiro.php");

    //Imports de Funcionamento
    define("IMPORT_FUNCIONAMENTO", RAIZ_IMPORT . "/model/funcionamentoClass.php");
    define("IMPORT_FUNCIONAMENTO_DAO", RAIZ_IMPORT . "/model/DAO/funcionamentoDAO.php");
    define("IMPORT_FUNCIONAMENTO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerFuncionamento.php");

    //Imports de clientes
    define("IMPORT_CLIENTE", RAIZ_IMPORT . "/model/clienteClass.php");
    define("IMPORT_CLIENTE_DAO", RAIZ_IMPORT . "/model/DAO/clienteDAO.php");
    define("IMPORT_CLIENTE_CONTROLLER", RAIZ_IMPORT . "/controller/controllerCliente.php");

    //Imports de veiculo
    define("IMPORT_VEICULO", RAIZ_IMPORT . "/model/veiculoClass.php");
    define("IMPORT_VEICULO_DAO", RAIZ_IMPORT . "/model/DAO/veiculoDAO.php");
    define("IMPORT_VEICULO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerVeiculo.php");

    //Imports de foto veiculo
    define("IMPORT_FOTO_VEICULO", RAIZ_IMPORT . "/model/foto_veiculoClass.php");
    define("IMPORT_FOTO_VEICULO_DAO", RAIZ_IMPORT . "/model/DAO/foto_veiculoDAO.php");
    define("IMPORT_FOTO_VEICULO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerFoto_Veiculo.php");

    //Imports de endereço
    define("IMPORT_ENDERECO", RAIZ_IMPORT . "/model/enderecoClass.php");
    define("IMPORT_ENDERECO_DAO", RAIZ_IMPORT . "/model/DAO/enderecoDAO.php");
    define("IMPORT_ENDERECO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerEndereco.php"); 
    
    //Imports de banner
    define("IMPORT_BANNER", RAIZ_IMPORT . "/model/bannerClass.php");
    define("IMPORT_BANNER_DAO", RAIZ_IMPORT . "/model/DAO/bannerDAO.php");
    define("IMPORT_BANNER_CONTROLLER", RAIZ_IMPORT . "/controller/controllerBanner.php");

    //Imports de categorias
    define("IMPORT_CATEGORIA", RAIZ_IMPORT . "/model/categoriaClass.php");
    define("IMPORT_CATEGORIA_DAO", RAIZ_IMPORT . "/model/DAO/categoriaDAO.php");
    define("IMPORT_CATEGORIA_CONTROLLER", RAIZ_IMPORT . "/controller/controllerCategoria.php");

    //Imports de marca
    define("IMPORT_MARCA", RAIZ_IMPORT . "/model/marcaClass.php");
    define("IMPORT_MARCA_DAO", RAIZ_IMPORT . "/model/DAO/marcaDAO.php");
    define("IMPORT_MARCA_CONTROLLER", RAIZ_IMPORT . "/controller/controllerMarca.php");
    
    //Imports de modelo de veiculo
    define("IMPORT_MODELO", RAIZ_IMPORT . "/model/modeloClass.php");
    define("IMPORT_MODELO_DAO", RAIZ_IMPORT . "/model/DAO/modeloDAO.php");
    define("IMPORT_MODELO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerModelo.php");

    //Imports de termos
    define("IMPORT_TERMOS", RAIZ_IMPORT . "/model/termosClass.php");
    define("IMPORT_TERMOS_DAO", RAIZ_IMPORT . "/model/DAO/termosDAO.php");
    define("IMPORT_TERMOS_CONTROLLER", RAIZ_IMPORT . "/controller/controllerTermos.php");

    //Imports da avaliação do veiculo
    define("IMPORT_AVALIACAO_VEICULO", RAIZ_IMPORT . "/model/avaliacaoVeiculoClass.php");
    define("IMPORT_AVALIACAO_VEICULO_DAO", RAIZ_IMPORT . "/model/DAO/avaliacaoVeiculoDAO.php");
    define("IMPORT_AVALIACAO_VEICULO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerAvaliacaoVeiculo.php");

    //imports da avaliacao
    define("IMPORT_AVALIACAO", RAIZ_IMPORT . "/model/avaliacaoClass.php");
    define("IMPORT_AVALIACAO_DAO", RAIZ_IMPORT . "/model/DAO/avaliacaoDAO.php");
    define("IMPORT_AVALIACAO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerAvaliacao.php");

    //Imports Fale Conosco
    define("IMPORT_FALE_CONOSCO", RAIZ_IMPORT . "/model/faleConoscoClass.php");
    define("IMPORT_FALE_CONOSCO_DAO", RAIZ_IMPORT . "/model/DAO/faleConoscoDAO.php");
    define("IMPORT_FALE_CONOSCO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerFaleConosco.php");
   
    // Imports Dúvidas Frequentes 
    define("IMPORT_DUVIDAS_FREQUENTES", RAIZ_IMPORT . "/model/duvidasFrequentesClass.php");
    define("IMPORT_DUVIDAS_FREQUENTES_DAO", RAIZ_IMPORT . "/model/DAO/duvidasFrequentesDAO.php");
    define("IMPORT_DUVIDAS_FREQUENTES_CONTROLLER", RAIZ_IMPORT ."/controller/controllerDuvidasFrequentes.php");

    //Imports de cancelamento
    define("IMPORT_CANCELAMENTO", RAIZ_IMPORT . "/model/cancelamentoClass.php");
    define("IMPORT_CANCELAMENTO_DAO", RAIZ_IMPORT . "/model/DAO/cancelamentoDAO.php");
    define("IMPORT_CANCELAMENTO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerCancelamento.php");

    //Imports de Vvisualizacao_cancelamento
    define("IMPORT_VVISUALIZACAO_CANCELAMENTO", RAIZ_IMPORT . "/model/vvisualizacao_cancelamentoClass.php");
    define("IMPORT_VVISUALIZACAO_CANCELAMENTO_DAO", RAIZ_IMPORT . "/model/DAO/vvisualizacao_cancelamentoDAO.php");
    //define("IMPORT_CANCELAMENTO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerCancelamento.php");

    //Imports de v_detalhes_locacao
    define("IMPORT_V_DETALHES_LOCACAO", RAIZ_IMPORT . "/model/v_detalhes_locacaoClass.php");
    define("IMPORT_V_DETALHES_LOCACAO_DAO", RAIZ_IMPORT . "/model/DAO/v_detalhes_locacaoDAO.php");
    define("IMPORT_V_DETALHES_LOCACAO_CONTROLLER", RAIZ_IMPORT . "/controller/controllerV_detalhes_locacao.php");

    //import anuncios mobile
    define("IMPORT_ANUNCIOS", PASTA_RAIZ . PASTA_PROJETO . "/model/anunciosClass.php");
    define("IMPORT_ANUNCIOS_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/anunciosDAO.php");
    define("IMPORT_ANUNCIOS_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerAnuncios.php");

    //import chat
    define("IMPORT_CHAT", PASTA_RAIZ . PASTA_PROJETO . "/model/chatClass.php");
    define("IMPORT_CHAT_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/chatDAO.php");
    define("IMPORT_CHAT_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerChat.php");
    
    define("IMPORT_TIPO", PASTA_RAIZ . PASTA_PROJETO . "/model/tipoClass.php");
    define("IMPORT_TIPO_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/tipoDAO.php");
    define("IMPORT_TIPO_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerTipo.php");

    //import anuncios mobile
    define("IMPORT_ACESSORIO", PASTA_RAIZ . PASTA_PROJETO . "/model/acessorioClass.php");
    define("IMPORT_ACESSORIO_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/acessorioDAO.php");
    define("IMPORT_ACESSORIO_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerAcessorio.php");    

    //import anuncios mobile
    define("IMPORT_VSOLICITACAO_LOCACAO", PASTA_RAIZ . PASTA_PROJETO . "/model/vsolicitacao_locacaoClass.php");
    define("IMPORT_SOLICITACAO_LOCACAO", PASTA_RAIZ . PASTA_PROJETO . "/model/solicitacao_locacaoClass.php");
    define("IMPORT_SOLICITACAO_LOCACAO_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/solicitacao_locacaoDAO.php");
    define("IMPORT_SOLICITACAO_LOCACAO_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerSolicitacao_locacao.php");    

    define("IMPORT_V_HISTORICO_LOCACAO", PASTA_RAIZ . PASTA_PROJETO . "/model/vhistorico_locacaoClass.php");
    define("IMPORT_V_HISTORICO_LOCACAO_DAO", PASTA_RAIZ . PASTA_PROJETO . "/model/DAO/vhistorico_locacaoDAO.php");
    define("IMPORT_LOCACAO_CONTROLLER", PASTA_RAIZ . PASTA_PROJETO . "/controller/controllerLocacao.php");    
    
    /*---------------------------------------------------------------*/
    /*--------------------------- PÁGINAS ---------------------------*/
    /*---------------------------------------------------------------*/

    //Import do header e footer do SITE
    define("HEADER", RAIZ_IMPORT . "/SITE/view/header.php");
    define("FOOTER", RAIZ_IMPORT . "/SITE/view/footer.php");

    //Imports de páginas do cms
    define("IMPORT_CMS_HOME", RAIZ_IMPORT . "/CMS/view/home.php");
    define("IMPORT_CMS_LOGIN", RAIZ_IMPORT . "/CMS/view/login.php");
    define("IMPORT_CMS_INDEX", RAIZ_IMPORT . "/CMS/index.php");

    //Import páginas de nível
    define("IMPORT_CMS_CADASTRO_NIVEL", RAIZ_IMPORT . "/CMS/view/nivel/nivel.php");

    //Import páginas de funcionario
    define("IMPORT_CMS_CADASTRO_FUNCIONARIO", RAIZ_IMPORT . "/CMS/view/funcionario/funcionario.php");

    //Import páginas de parceiro
    define("IMPORT_CMS_CADASTRO_PARCEIRO", RAIZ_IMPORT . "/CMS/view/parceiro/parceiro.php");

    //Import páginas de funcionamento
    define("IMPORT_CMS_CADASTRO_FUNCIONAMENTO", RAIZ_IMPORT . "/CMS/view/comoFunciona/comoFunciona.php");

    //Import páginas de banner
    define("IMPORT_CADASTRO_BANNER", RAIZ_IMPORT . "/CMS/view/banner/banner.php");

    //Import da página de marcas
    define("IMPORT_CADASTRO_MARCAS", RAIZ_IMPORT . "/CMS/view/marcasemodelos/marcas.php");

    //Import da página de modelos
    define("IMPORT_CADASTRO_MODELOS", RAIZ_IMPORT . "/CMS/view/marcasemodelos/modelos.php");

    //Import das paginas de termo
    define("IMPORT_CADASTRO_TERMO", RAIZ_IMPORT . "/CMS/view/termos/termos.php");

    //Import páginas de pendencia
    define("IMPORT_CMS_CADASTRO_PENDENCIA_USUARIO", RAIZ_IMPORT . "/CMS/view/aprovacao/aprovacaoUsuario.php");
    define("IMPORT_CMS_CADASTRO_PENDENCIA_VEICULO", RAIZ_IMPORT . "/CMS/view/aprovacao/aprovacaoVeiculo.php");

    //Imports de páginas do SITE
    define("IMPORT_SITE_HOME", RAIZ_IMPORT . "/SITE/view/home.php");
    define("IMPORT_SITE_LOGIN", RAIZ_IMPORT . "/SITE/view/login.php");
    define("IMPORT_SITE_INDEX", RAIZ_IMPORT . "/SITE/index.php");

    //Import páginas de Fale Conosco 
    define("IMPORT_CADASTRO_FALE_CONOSCO", RAIZ_IMPORT . "/CMS/view/faleConosco/faleConosco.php");
    
    //Import páginas de Duvidas Frequentes
    define("IMPORT_CADASTRO_DUVIDAS", RAIZ_IMPORT . "/CMS/view/duvidasFrequentes/duvidas.php");

    //Import notificação
    define("IMPORT_NOTIFICACAO", RAIZ_IMPORT . "/SITE/view/usuario-notificacao/notificacao.php");

    /*---------------------------------------------------------------*/
    /*--------------------------- ERROS -----------------------------*/
    /*---------------------------------------------------------------*/
    
    //Erro de modo API
    define("MSG_MODO_ERRO", "Modo inválido.");

    //Mensagens de login
    define("MSG_LOGIN_ERRO", "Login ou senha inválidos.");

    //Mensagens de nível
    define("MSG_INSERIR_NIVEL_ERRO", "Não foi possível inserir o nível.");
    define("MSG_INSERIR_NIVEL_SUCESSO", "Nível inserido.");
    define("MSG_ATUALIZAR_NIVEL_ERRO", "Não foi possível atualizar o nível.");
    define("MSG_ATUALIZAR_NIVEL_SUCESSO", "Nível atualizado.");
    define("MSG_EXCLUIR_NIVEL_ERRO", "Não foi possível excluir o nível.");
    define("MSG_EXCLUIR_NIVEL_SUCESSO", "Nível excluído.");

    //Mensagens de funcionários
    define("MSG_INSERIR_FUNCIONARIO_ERRO", "Não foi possível inserir o funcionário.");
    define("MSG_INSERIR_FUNCIONARIO_SUCESSO", "Funcionário inserido.");
    define("MSG_ATUALIZAR_FUNCIONARIO_ERRO", "Não foi possível atualizar o funcionário.");
    define("MSG_ATUALIZAR_FUNCIONARIO_SUCESSO", "Funcionário atualizado.");
    define("MSG_EXCLUIR_FUNCIONARIO_ERRO", "Não foi possível excluir o funcionário.");
    define("MSG_EXCLUIR_FUNCIONARIO_SUCESSO", "Funcionário excluído.");

    //Mensagens de parceiros
    define("MSG_INSERIR_PARCEIRO_ERRO", "Não foi possível inserir o parceiro.");
    define("MSG_INSERIR_PARCEIRO_SUCESSO", "Parceiro inserido.");
    define("MSG_ATUALIZAR_PARCEIRO_ERRO", "Não foi possível atualizar o parceiro.");
    define("MSG_ATUALIZAR_PARCEIRO_SUCESSO", "Parceiro atualizado.");
    define("MSG_EXCLUIR_PARCEIRO_ERRO", "Não foi possível excluir o parceiro.");
    define("MSG_EXCLUIR_PARCEIRO_SUCESSO", "Parceiro excluído.");

    //Mensagens de funcionamento
    define("MSG_INSERIR_FUNCIONAMENTO_ERRO", "Não foi possível inserir o funcionamento.");
    define("MSG_INSERIR_FUNCIONAMENTO_SUCESSO", "Funcionamento inserido.");
    define("MSG_ATUALIZAR_FUNCIONAMENTO_ERRO", "Não foi possível atualizar o funcionamento.");
    define("MSG_ATUALIZAR_FUNCIONAMENTO_SUCESSO", "Funcionamento atualizado.");
    define("MSG_EXCLUIR_FUNCIONAMENTO_ERRO", "Não foi possível excluir o funcionamento.");
    define("MSG_EXCLUIR_FUNCIONAMENTO_SUCESSO", "Funcionamento excluído.");

    //Mensagens de termo
    define("MSG_INSERIR_TERMO_ERRO", "Não foi possível inserir o termo.");
    define("MSG_INSERIR_TERMO_SUCESSO", "Termo inserido.");
    define("MSG_ATUALIZAR_TERMO_ERRO", "Não foi possível atualizar o termo.");
    define("MSG_ATUALIZAR_TERMO_SUCESSO", "Termo atualizado.");
    define("MSG_EXCLUIR_TERMO_ERRO", "Não foi possível excluir o termo.");
    define("MSG_EXCLUIR_TERMO_SUCESSO", "Termo excluído.");

    //Mensagens de marca
    define("MSG_INSERIR_MARCA_ERRO", "Não foi possível inserir a marca.");
    define("MSG_INSERIR_MARCA_SUCESSO", "Marca inserida.");
    define("MSG_ATUALIZAR_MARCA_ERRO", "Não foi possível atualizar a marca.");
    define("MSG_ATUALIZAR_MARCA_SUCESSO", "Marca atualizada.");
    define("MSG_EXCLUIR_MARCA_ERRO", "Não foi possível excluir a marca.");
    define("MSG_EXCLUIR_MARCA_SUCESSO", "Marca excluída.");

    //Mensagens de modelo
    define("MSG_INSERIR_MODELO_ERRO", "Não foi possível inserir o modelo.");
    define("MSG_INSERIR_MODELO_SUCESSO", "Modelo inserido.");
    define("MSG_ATUALIZAR_MODELO_ERRO", "Não foi possível atualizar o modelo.");
    define("MSG_ATUALIZAR_MODELO_SUCESSO", "Modelo atualizado.");
    define("MSG_EXCLUIR_MODELO_ERRO", "Não foi possível excluir o modelo.");
    define("MSG_EXCLUIR_MODELO_SUCESSO", "Modelo excluído.");

    //Mensagens de duvidas
    define("MSG_INSERIR_DUVIDA_ERRO", "Não foi possível inserir a duvida.");
    define("MSG_INSERIR_DUVIDA_SUCESSO", "Duvida inserida.");
    define("MSG_ATUALIZAR_DUVIDA_ERRO", "Não foi possível atualizar a duvida.");
    define("MSG_ATUALIZAR_DUVIDA_SUCESSO", "Duvida atualizada.");
    define("MSG_EXCLUIR_DUVIDA_ERRO", "Não foi possível excluir a duvida.");
    define("MSG_EXCLUIR_DUVIDA_SUCESSO", "Duvida excluída.");

    //Mensagens de fale
    define("MSG_INSERIR_FALE_ERRO", "Não foi possível inserir o fale.");
    define("MSG_INSERIR_FALE_SUCESSO", "Fale inserido.");
    define("MSG_EXCLUIR_FALE_ERRO", "Não foi possível excluir o fale.");
    define("MSG_EXCLUIR_FALE_SUCESSO", "Fale excluído.");

    //Mensagens de pendência
    define("MSG_ATUALIZAR_PENDENCIA_ERRO", "Não foi possível atualizar a pendência.");
    define("MSG_ATUALIZAR_PENDENCIA_SUCESSO", "Pendência atualizado.");
    
    //Mensagens de cancelamento
    define("MSG_ACEITAR_ERRO", "Não foi possível aceitar o cancelamento.");
    define("MSG_ACEITAR_SUCESSO", "Cancelamento aceito.");
    define("MSG_RECUSAR_ERRO", "Não foi possível recusar o cancelamento.");
    define("MSG_RECUSAR_SUCESSO", "Cancelamento recusado.");

    //Mensagens de parceiros
    define("MSG_INSERIR_VEICULO_ERRO", "Não foi possível inserir o veiculo.");
    define("MSG_INSERIR_VEICULO_SUCESSO", "Insira uma imagem.");
    define("MSG_ATUALIZAR_VEICULO_ERRO", "Não foi possível atualizar o veiculo.");
    define("MSG_ATUALIZAR_VEICULO_SUCESSO", "Veiculo atualizado.");
    define("MSG_EXCLUIR_VEICULO_ERRO", "Não foi possível excluir o veiculo.");
    define("MSG_EXCLUIR_VEICULO_SUCESSO", "Veiculo excluído.");

    /*---------------------------------------------------------------*/
    /*--------------------------- ALERTAS ---------------------------*/
    /*---------------------------------------------------------------*/

    //Alerta de Login
    define("ALERT_LOGIN_ERRO", alert(MSG_LOGIN_ERRO));

    //Alertas de nível
    define("ALERT_INSERIR_NIVEL_ERRO", alert(MSG_INSERIR_NIVEL_ERRO));
    define("ALERT_INSERIR_NIVEL_SUCESSO", alert(MSG_INSERIR_NIVEL_SUCESSO));
    define("ALERT_ATUALIZAR_NIVEL_ERRO", alert(MSG_ATUALIZAR_NIVEL_ERRO));
    define("ALERT_ATUALIZAR_NIVEL_SUCESSO", alert(MSG_ATUALIZAR_NIVEL_SUCESSO));
    define("ALERT_EXCLUIR_NIVEL_ERRO", alert(MSG_EXCLUIR_NIVEL_ERRO));
    define("ALERT_EXCLUIR_NIVEL_SUCESSO", alert(MSG_EXCLUIR_NIVEL_SUCESSO));
    
    //Alertas de veiculos
    define("ALERT_INSERIR_VEICULO_ERRO", alert(MSG_INSERIR_VEICULO_ERRO));
    define("ALERT_INSERIR_VEICULO_SUCESSO", alert(MSG_INSERIR_VEICULO_SUCESSO));
    define("ALERT_ATUALIZAR_VEICULO_ERRO", alert(MSG_ATUALIZAR_VEICULO_ERRO));
    define("ALERT_ATUALIZAR_VEICULO_SUCESSO", alert(MSG_ATUALIZAR_VEICULO_SUCESSO));
    define("ALERT_EXCLUIR_VEICULO_ERRO", alert(MSG_EXCLUIR_VEICULO_ERRO));
    define("ALERT_EXCLUIR_VEICULO_SUCESSO", alert(MSG_EXCLUIR_VEICULO_SUCESSO));
    //Alertas de funcionários
    define("ALERT_INSERIR_FUNCIONARIO_ERRO", alert(MSG_INSERIR_FUNCIONARIO_ERRO));
    define("ALERT_INSERIR_FUNCIONARIO_SUCESSO", alert(MSG_INSERIR_FUNCIONARIO_SUCESSO));
    define("ALERT_ATUALIZAR_FUNCIONARIO_ERRO", alert(MSG_ATUALIZAR_FUNCIONARIO_ERRO));
    define("ALERT_ATUALIZAR_FUNCIONARIO_SUCESSO", alert(MSG_ATUALIZAR_FUNCIONARIO_SUCESSO));
    define("ALERT_EXCLUIR_FUNCIONARIO_ERRO", alert(MSG_EXCLUIR_FUNCIONARIO_ERRO));
    define("ALERT_EXCLUIR_FUNCIONARIO_SUCESSO", alert(MSG_EXCLUIR_FUNCIONARIO_SUCESSO));
    
    //Alertas de parceiros
    define("ALERT_INSERIR_PARCEIRO_ERRO", alert(MSG_INSERIR_PARCEIRO_ERRO));
    define("ALERT_INSERIR_PARCEIRO_SUCESSO", alert(MSG_INSERIR_PARCEIRO_SUCESSO));
    define("ALERT_ATUALIZAR_PARCEIRO_ERRO", alert(MSG_ATUALIZAR_PARCEIRO_ERRO));
    define("ALERT_ATUALIZAR_PARCEIRO_SUCESSO", alert(MSG_ATUALIZAR_PARCEIRO_SUCESSO));
    define("ALERT_EXCLUIR_PARCEIRO_ERRO", alert(MSG_EXCLUIR_PARCEIRO_ERRO));
    define("ALERT_EXCLUIR_PARCEIRO_SUCESSO", alert(MSG_EXCLUIR_PARCEIRO_SUCESSO));
    
    //Alertas de funcionamentos
    define("ALERT_INSERIR_FUNCIONAMENTO_ERRO", alert(MSG_INSERIR_FUNCIONAMENTO_ERRO));
    define("ALERT_INSERIR_FUNCIONAMENTO_SUCESSO", alert(MSG_INSERIR_FUNCIONAMENTO_SUCESSO));
    define("ALERT_ATUALIZAR_FUNCIONAMENTO_ERRO", alert(MSG_ATUALIZAR_FUNCIONAMENTO_ERRO));
    define("ALERT_ATUALIZAR_FUNCIONAMENTO_SUCESSO", alert(MSG_ATUALIZAR_FUNCIONAMENTO_SUCESSO));
    define("ALERT_EXCLUIR_FUNCIONAMENTO_ERRO", alert(MSG_EXCLUIR_FUNCIONAMENTO_ERRO));
    define("ALERT_EXCLUIR_FUNCIONAMENTO_SUCESSO", alert(MSG_EXCLUIR_FUNCIONAMENTO_SUCESSO));

    //Alertas de termo
    define("ALERT_INSERIR_TERMO_ERRO", alert(MSG_INSERIR_TERMO_ERRO));
    define("ALERT_INSERIR_TERMO_SUCESSO", alert(MSG_INSERIR_TERMO_SUCESSO));
    define("ALERT_ATUALIZAR_TERMO_ERRO", alert(MSG_ATUALIZAR_TERMO_ERRO));
    define("ALERT_ATUALIZAR_TERMO_SUCESSO", alert(MSG_ATUALIZAR_TERMO_SUCESSO));
    define("ALERT_EXCLUIR_TERMO_ERRO", alert(MSG_EXCLUIR_TERMO_ERRO));
    define("ALERT_EXCLUIR_TERMO_SUCESSO", alert(MSG_EXCLUIR_TERMO_SUCESSO));

    //Alertas de marca
    define("ALERT_INSERIR_MARCA_ERRO", alert(MSG_INSERIR_MARCA_ERRO));
    define("ALERT_INSERIR_MARCA_SUCESSO", alert(MSG_INSERIR_MARCA_SUCESSO));
    define("ALERT_ATUALIZAR_MARCA_ERRO", alert(MSG_ATUALIZAR_MARCA_ERRO));
    define("ALERT_ATUALIZAR_MARCA_SUCESSO", alert(MSG_ATUALIZAR_MARCA_SUCESSO));
    define("ALERT_EXCLUIR_MARCA_ERRO", alert(MSG_EXCLUIR_MARCA_ERRO));
    define("ALERT_EXCLUIR_MARCA_SUCESSO", alert(MSG_EXCLUIR_MARCA_SUCESSO));

    //Alertas de modelo
    define("ALERT_INSERIR_MODELO_ERRO", alert(MSG_INSERIR_MODELO_ERRO));
    define("ALERT_INSERIR_MODELO_SUCESSO", alert(MSG_INSERIR_MODELO_SUCESSO));
    define("ALERT_ATUALIZAR_MODELO_ERRO", alert(MSG_ATUALIZAR_MODELO_ERRO));
    define("ALERT_ATUALIZAR_MODELO_SUCESSO", alert(MSG_ATUALIZAR_MODELO_SUCESSO));
    define("ALERT_EXCLUIR_MODELO_ERRO", alert(MSG_EXCLUIR_MODELO_ERRO));
    define("ALERT_EXCLUIR_MODELO_SUCESSO", alert(MSG_EXCLUIR_MODELO_SUCESSO));

    //Alertas de fale
    define("ALERT_INSERIR_DUVIDA_ERRO", alert(MSG_INSERIR_DUVIDA_ERRO));
    define("ALERT_INSERIR_DUVIDA_SUCESSO", alert(MSG_INSERIR_DUVIDA_SUCESSO));
    define("ALERT_ATUALIZAR_DUVIDA_ERRO", alert(MSG_ATUALIZAR_DUVIDA_ERRO));
    define("ALERT_ATUALIZAR_DUVIDA_SUCESSO", alert(MSG_ATUALIZAR_DUVIDA_SUCESSO));
    define("ALERT_EXCLUIR_DUVIDA_ERRO", alert(MSG_EXCLUIR_DUVIDA_ERRO));
    define("ALERT_EXCLUIR_DUVIDA_SUCESSO", alert(MSG_EXCLUIR_DUVIDA_SUCESSO));

    //Alertas de duvida
    define("ALERT_INSERIR_FALE_ERRO", alert(MSG_INSERIR_FALE_ERRO));
    define("ALERT_INSERIR_FALE_SUCESSO", alert(MSG_INSERIR_FALE_SUCESSO));
    define("ALERT_EXCLUIR_FALE_ERRO", alert(MSG_EXCLUIR_FALE_ERRO));
    define("ALERT_EXCLUIR_FALE_SUCESSO", alert(MSG_EXCLUIR_FALE_SUCESSO));

    //Alertas de pendência
    define("ALERT_ATUALIZAR_PENDENCIA_ERRO", alert(MSG_ATUALIZAR_PENDENCIA_ERRO));
    define("ALERT_ATUALIZAR_PENDENCIA_SUCESSO", alert(MSG_ATUALIZAR_PENDENCIA_SUCESSO));

    //Alertas de cancelamento
    define("ALERT_ACEITAR_ERRO", alert(MSG_ACEITAR_ERRO));
    define("ALERT_ACEITAR_SUCESSO", alert(MSG_ACEITAR_SUCESSO));
    define("ALERT_RECUSAR_ERRO", alert(MSG_RECUSAR_ERRO));
    define("ALERT_RECUSAR_SUCESSO", alert(MSG_RECUSAR_SUCESSO));

    /*-------------------------------------------------------------*/
    /*--------------------------- LINKS ---------------------------*/
    /*-------------------------------------------------------------*/

    //Constantes que criam os links das páginas
    define("LINK_SITE_INDEX", RAIZ_LINK . "/SITE/index.php");
    define("LINK_SITE_ANUNCIO", RAIZ_LINK . "/SITE/view/anuncios/anuncios.php");
    define("LINK_SITE_FUNCIONA", RAIZ_LINK . "/SITE/view/comofunciona/comofunciona.php");
    define("LINK_SITE_MES", RAIZ_LINK . "/SITE/view/avaliacoesdomes/avaliacoesdomes.php");
    define("LINK_SITE_LOGIN", RAIZ_LINK . "/SITE/view/login.php");
    define("LINK_SITE_TERMO", RAIZ_LINK . "/SITE/view/termosdeuso/termosdeuso.php");
    define("LINK_SITE_DUVIDA", RAIZ_LINK . "/SITE/view/duvidasfreq/duvidasfreq.php");
    define("LINK_SITE_PARCEIRO", RAIZ_LINK . "/SITE/view/parceiros/parceiros.php");
    define("LINK_SITE_CONTATO", RAIZ_LINK . "/SITE/view/faleconosco/faleconosco.php");
    define("LINK_SITE_HOME", RAIZ_LINK . "/SITE/view/home.php");
    define("LINK_SITE_SAIR", RAIZ_LINK . "/SITE/index.php?destroy");
    define("LINK_SITE_HISTORICO", RAIZ_LINK . "/SITE/view/usuario-veiculo/historicoVeic.php");
    define("LINK_SITE_CADASTRO", RAIZ_LINK . "/SITE/view/cadastro.php");

    //Constantes com os links do CSS
    define("LINK_CSS", RAIZ_LINK . "/SITE/view/css/style.css");

    //Constantes com os links das imagens
    define("LINK_IMAGEM_LOGO", RAIZ_LINK . "/SITE/view/images/logo.png");
    define("LINK_IMAGEM_FACEBOOK", RAIZ_LINK . "/SITE/view/images/social-facebook.png");
    define("LINK_IMAGEM_PLUS", RAIZ_LINK . "/SITE/view/images/social-plus.png");
    define("LINK_IMAGEM_INSTAGRAM", RAIZ_LINK . "/SITE/view/images/social-instagram.png");
    define("LINK_IMAGEM_TWITTER", RAIZ_LINK . "/SITE/view/images/social-twitter.png");
    define("LINK_IMAGEM_LINKEDIN", RAIZ_LINK . "/SITE/view/images/social-linkedin.png");
    define("LINK_IMAGEM_MAPA", RAIZ_LINK . "/SITE/view/images/map.png");
    define("LINK_IMAGEM_FONE", RAIZ_LINK . "/SITE/view/images/phone-call.png");
    define("LINK_IMAGEM_EMAIL", RAIZ_LINK . "/SITE/view/images/envelope.png");

    //Constantes com os links da dahsboard
    define("LINK_DASHBOARD_VISUALIZAR_PERFIL", RAIZ_LINK . "/SITE/view/usuario-perfil/visualizarUsuario.php");
    define("LINK_DASHBOARD_EDITAR_PERFIL", RAIZ_LINK . "/SITE/view/usuario-perfil/edicaoUsuario.php");
    define("LINK_DASHBOARD_VISUALIZAR_ENDERECO", RAIZ_LINK . "/SITE/view/usuario-endereco/enderecoUsuario.php");
    define("LINK_DASHBOARD_EDITAR_ENDERECO", RAIZ_LINK . "/SITE/view/usuario-endereco/cadastroEndereco.php");
    define("LINK_DASHBOARD_CADASTRAR_VEICULO_ALUGUEL", RAIZ_LINK . "/SITE/view/usuario-veiculo/cadastrarVeicAluguel.php");
    define("LINK_DASHBOARD_CADASTRAR_VEICULO_VENDA", RAIZ_LINK . "/SITE/view/usuario-veiculo/cadastrarVeicVenda.php");
    define("LINK_DASHBOARD_VEICULO_DEVOLUCAO", RAIZ_LINK . "/SITE/view/usuario-veiculo/devolucao.php");
    define("LINK_DASHBOARD_HISTORICO_VEICULO", RAIZ_LINK . "/SITE/view/usuario-veiculo/historicoVeic.php");
    define("LINK_DASHBOARD_LISTA_VEICULO_ALUGUEL", RAIZ_LINK . "/SITE/view/usuario-veiculo/listaVeicAluguel.php");
    define("LINK_DASHBOARD_LISTA_VEICULO_VENDA", RAIZ_LINK . "/SITE/view/usuario-veiculo/listaVeicVenda.php");
    define("LINK_DASHBOARD_OPCAO_VEICULO", RAIZ_LINK . "/SITE/view/usuario-veiculo/usuarioVeiculo.php");
    define("LINK_DASHBOARD_NOTIFICACAO", RAIZ_LINK . "/SITE/view/usuario-notificacao/notificacao.php");
    define("LINK_DASHBOARD_CUPONS", RAIZ_LINK . "/SITE/view/usuario-cupons/visualizarCupons.php");
}
?>