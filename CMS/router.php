<?php
/*
    Projeto: Mobshare
    Autor: Igor
    Data Criação: 23/03/2019
    Data Modificação:20/04/2019
    Conteudo Modificação: Constante de alert
    Autor da Modificação:Igor
    Objetivo: Arquivo de rota que realiza ações
*/

$controller = null;
$modo = null;
$id = null;

//Import da classe de constantes
@session_start();
require_once($_SESSION["importInclude"]); 

if(isset($_GET["controller"])){
    //Sempre serão enviadas pela view
    $controller = strtoupper($_GET["controller"]);
    $modo = strtoupper($_GET["modo"]);

    switch($controller){
        case "NIVEIS":
            //Import da controller de nivel
            require_once(IMPORT_NIVEL_CONTROLLER);
                    
            //Instancia da controller de nivel
            $controllerNivel = new controllerNivel();

            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo nivel
                    $erro = $controllerNivel->inserirNivel();

                    //Mostra mensagem de erro ou sucesso
                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_NIVEL_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_NIVEL_SUCESSO);
                    }

                    //Encaminha para a pagina de nivel
                    echo utf8_encode("<script>nivel();</script>");
                    break;
                case "ATUALIZAR":
                    //Chamando o método de atualizar nivel
                    $erro = $controllerNivel->atualizarNivel();

                    //Mostra mensagem de erro ou sucesso
                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_NIVEL_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_NIVEL_SUCESSO);
                    }

                    //Encaminha para a pagina de nivel
                    echo utf8_encode("<script>nivel();</script>");
                    break;
                case "EXCLUIR":
                    //Chama o método para excluir o nivel
                    $erro = $controllerNivel->excluirNivel();

                    //Mostra mensagem de erro ou sucesso
                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_NIVEL_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_NIVEL_SUCESSO);
                    }

                    //Encaminha para a pagina de nivel
                    echo utf8_encode("<script>nivel();</script>");
                    break;
                case "BUSCAR":
                    //Chama o método para pegar o nível escolhido
                    $nivel = $controllerNivel->buscarNivel();

                    //Pega a pagina de cadastro de niveis para editar o nivel escolhido
                    require_once(IMPORT_CMS_CADASTRO_NIVEL);
                    break;
            }
            break;

        case "FUNCIONARIOS":

            //Import da controller de nivel
            require_once(IMPORT_FUNCIONARIO_CONTROLLER);
                    
            //Instancia da controller de nivel
            $controllerFuncionario = new controllerFuncionario();

            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    $erro = $controllerFuncionario->inserirFuncionario();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_FUNCIONARIO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_FUNCIONARIO_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>funcionario();</script>");
                    break;

                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $erro = $controllerFuncionario->excluirFuncionario();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_FUNCIONARIO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_FUNCIONARIO_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>funcionario();</script>");
                    break;

                case "BUSCAR":
                    $funcionario = $controllerFuncionario->buscarFuncionario();

                    require_once(IMPORT_CMS_CADASTRO_FUNCIONARIO);
                    break;

                case "ATUALIZAR":
                    $erro = $controllerFuncionario->atualizarFuncionario();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_FUNCIONARIO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_FUNCIONARIO_SUCESSO);
                    }

                    echo utf8_encode("<script>funcionario();</script>");
                    break;

                case "LOGAR":
                    $idFuncionario = $controllerFuncionario->logar();
                    //Verifica se retornou um funcionário corretamente para mostrar um erro
                    if(!$idFuncionario){
                        echo utf8_encode(ALERT_LOGIN_ERRO);
                    }

                    require_once(IMPORT_CMS_INDEX);
                    break;

            }
            break;

        case "PARCEIROS":

            require_once(IMPORT_PARCEIRO_CONTROLLER);

            $controllerParceiro = new controllerParceiro();

            switch ($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    $erro = $controllerParceiro->inserirParceiro();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_PARCEIRO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_PARCEIRO_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>parceiro();</script>");
                break;

                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $erro = $controllerParceiro->excluirParceiro();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_PARCEIRO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_PARCEIRO_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>parceiro();</script>");
                break;

                case "BUSCAR":
                    $parceiro = $controllerParceiro->buscarParceiro();

                    require_once(IMPORT_CMS_CADASTRO_PARCEIRO);

                break;

                case "ATUALIZAR":
                    $erro = $controllerParceiro->atualizarParceiro();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_PARCEIRO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_PARCEIRO_SUCESSO);
                    }

                    echo utf8_encode("<script>parceiro();</script>");
                break;
            }

            break;
            

        case "FUNCIONAMENTO":

            require_once(IMPORT_FUNCIONAMENTO_CONTROLLER);

            $controllerFuncionamento = new controllerFuncionamento();

            switch ($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    $erro = $controllerFuncionamento->inserirFuncionamento();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_FUNCIONAMENTO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_FUNCIONAMENTO_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>comoFunciona();</script>");
                break;

                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $erro = $controllerFuncionamento->excluirFuncionamento();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_FUNCIONAMENTO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_FUNCIONAMENTO_ERRO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>comoFunciona();</script>");
                break;

                case "BUSCAR":
                    $funcionamento = $controllerFuncionamento->buscarFuncionamento();

                    require_once(IMPORT_CMS_CADASTRO_FUNCIONAMENTO);

                break;

                case "ATUALIZAR":
                    $erro = $controllerFuncionamento->atualizarFuncionamento();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_FUNCIONAMENTO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_FUNCIONAMENTO_SUCESSO);
                    }

                    echo utf8_encode("<script>comoFunciona();</script>");
                break;
            }
        break;

        case "PENDENCIAUSUARIO":

            require_once(IMPORT_PENDENCIA_CONTROLLER);

            $controllerPendencia = new controllerPendencia();

            switch ($modo){
                case "BUSCAR":
                    $pendencia = $controllerPendencia->buscarPendencia("USUARIO");

                    require_once(IMPORT_CMS_CADASTRO_PENDENCIA_USUARIO);

                break;

                case "ATUALIZAR":
                    $erro = $controllerPendencia->atualizarPendencia("USUARIO");

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_PENDENCIA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_PENDENCIA_SUCESSO);
                    }

                    echo utf8_encode("<script>aprovacaoUsuario();</script>");
                break;
            }
        break;

        case "PENDENCIAVEICULO":

            require_once(IMPORT_PENDENCIA_CONTROLLER);

            $controllerPendencia = new controllerPendencia();

            switch ($modo){
                case "BUSCAR":
                    $pendencia = $controllerPendencia->buscarPendencia("VEICULO");

                    require_once(IMPORT_CMS_CADASTRO_PENDENCIA_VEICULO);

                break;

                case "ATUALIZAR":
                    $erro = $controllerPendencia->atualizarPendencia("VEICULO");

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_PENDENCIA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_PENDENCIA_SUCESSO);
                    }

                    echo utf8_encode("<script>aprovacaoVeiculo();</script>");
                break;
            }       
        break;

        case "TERMOS":

            //Import da controller de TERMOS
            require_once(IMPORT_TERMOS_CONTROLLER);
                    
            //Instancia da controller de TERMOS
            $controllerTermos = new controllerTermos();
    
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo TERMO
                    $erro = $controllerTermos->inserirTermos();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_TERMO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_TERMO_SUCESSO);
                    }
    
                    //Encaminha para a pagina de TERMOS
                    echo utf8_encode("<script>termo();</script>");
                    break;
    
                case "EXCLUIR":
                    $erro = $controllerTermos->excluirTermos();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_TERMO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_TERMO_SUCESSO);
                    }
    
                    //Encaminha para a pagina de TERMOS
                    echo utf8_encode("<script>termo();</script>");
                    break;
    
                case "BUSCAR":
                    $termo = $controllerTermos->buscarTermo();
    
                    require_once(IMPORT_CADASTRO_TERMO);
                    break;
    
                case "ATUALIZAR":
                    $erro = $controllerTermos->atualizarTermos();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_TERMO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_TERMO_SUCESSO);
                    }
    
                    echo utf8_encode("<script>termo();</script>");
                    break;
            }
            break;

            case "MARCA":

            //Import da controller de Marcas
            require_once(IMPORT_MARCA_CONTROLLER);
                    
            //Instancia da controller de Marcas
            $controllerMarca = new controllerMarca();
    
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir uma nova Marca
                    $erro = $controllerMarca->inserirMarcas();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_MARCA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_MARCA_SUCESSO);
                    }
    
                    //Encaminha para a pagina de Marcas
                    echo utf8_encode("<script>listaMarcas();</script>");
                    break;
    
                case "EXCLUIR":
                    $erro = $controllerMarca->excluirMarcas();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_MARCA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_MARCA_SUCESSO);
                    }
    
                    //Encaminha para a pagina de Marcas
                    echo utf8_encode("<script>listaMarcas();</script>");
                    break;
    
                case "BUSCAR":
                    $marca = $controllerMarca->buscarMarcas();
    
                    require_once(IMPORT_CADASTRO_MARCAS);
                    break;  
    
                case "ATUALIZAR":
                    $erro = $controllerMarca->atualizarMarcas();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_MARCA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_MARCA_SUCESSO);
                    }
    
                    echo utf8_encode("<script>listaMarcas();</script>");
                    break;
            }
            break;

            case "MODELO":

            //Import da controller de Marcas
            require_once(IMPORT_MODELO_CONTROLLER);
                    
            //Instancia da controller de Marcas
            $controllerModelo = new controllerModelo();
    
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir uma nova Marca
                    $erro = $controllerModelo->inserirModelos();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_MODELO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_MODELO_SUCESSO);
                    }
    
                    //Encaminha para a pagina de Marcas
                    echo utf8_encode("<script>listaModelos();</script>");
                break;
    
                case "EXCLUIR":
                    $erro = $controllerModelo->excluirModelos();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_MODELO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_MODELO_SUCESSO);
                    }
    
                    //Encaminha para a pagina de Marcas
                    echo utf8_encode("<script>listaModelos();</script>");
                break;
    
                case "BUSCAR":
                    $modelo = $controllerModelo->buscarModelos();
    
                    require_once(IMPORT_CADASTRO_MODELOS);
                break;  
    
                case "ATUALIZAR":
                    $erro = $controllerModelo->atualizarModelos();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_MODELO_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_MODELO_SUCESSO);
                    }
    
                    echo utf8_encode("<script>listaModelos();</script>");
                break;
            }
        break;

        case "BANNER":
     
            
        require_once(IMPORT_BANNER_CONTROLLER);

        $controllerBanner= new controllerBanner();

        
        switch($modo){

            case "INSERIR":

               $controllerBanner->inserir();
            
               echo utf8_encode("<script>banner();</script>");
            break;

            case "EXCLUIR":

            $controllerBanner->excluir();
            
            echo utf8_encode("<script>banner();</script>");
            break;    
            
            case "BUSCAR":

            $banner = new Banner();
            $banner = $controllerBanner->buscarBanner();
            
            require_once(IMPORT_CADASTRO_BANNER);
            break;   

            case "ATUALIZAR":

           
                $controllerBanner->atualizar();
                
                echo utf8_encode("<script>banner();</script>");
            break;                  

        }  
        
    break;        

        case "DUVIDAS":
            
            //Import da controller de DuvidasFrequentes
            require_once(IMPORT_DUVIDAS_FREQUENTES_CONTROLLER);
                    
            //Instancia da controller de DuvidasFrequentes
            $controllerDuvidasFrequentes = new controllerDuvidasFrequentes();  
            
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo Duvidas Frequentes
                    $erro = $controllerDuvidasFrequentes->inserirDuvida();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_DUVIDA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_DUVIDA_SUCESSO);
                    }

                    //Encaminha para a pagina de Duvidas Frequentes
                    echo utf8_encode("<script>duvida();</script>");
                    break;
                     
                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $erro = $controllerDuvidasFrequentes->excluirDuvida();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_DUVIDA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_DUVIDA_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>duvida();</script>");
                    break;
                       
                case "ATUALIZAR":
                    $erro = $controllerDuvidasFrequentes->atualizarLista();

                    if($erro){
                        echo utf8_encode(ALERT_ATUALIZAR_DUVIDA_ERRO);
                    }else{
                        echo utf8_encode(ALERT_ATUALIZAR_DUVIDA_SUCESSO);
                    }

                    echo utf8_encode("<script>duvida();</script>");
                    break;        
            
                case "BUSCAR":
                    $duvidasFrequentes = $controllerDuvidasFrequentes->buscarDuvidas();
                    require_once(IMPORT_CADASTRO_DUVIDAS);
                    
                    break;    
            }
           break; 
            
            case"FALE_CONOSCO":
                //Import da controller de DuvidasFrequentes
                require_once(IMPORT_FALE_CONOSCO_CONTROLLER);

                //Instancia da controller de DuvidasFrequentes
                $controllerFaleConosco = new controllerFaleConosco();  
            
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo Duvidas Frequentes
                    $erro = $controllerFaleConosco->inserirFaleConosco();

                    if($erro){
                        echo utf8_encode(ALERT_INSERIR_FALE_ERRO);
                    }else{
                        echo utf8_encode(ALERT_INSERIR_FALE_SUCESSO);
                    }

                    //Encaminha para a pagina de Duvidas Frequentes
                    echo utf8_encode("<script>faleConosco();</script>");
                    break;
                     
                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $erro = $controllerFaleConosco->excluirFaleConosco();

                    if($erro){
                        echo utf8_encode(ALERT_EXCLUIR_FALE_ERRO);
                    }else{
                        echo utf8_encode(ALERT_EXCLUIR_FALE_SUCESSO);
                    }

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>faleConosco();</script>");
                    break;
                }
                
                
                case "CANCELAMENTO":
                    require_once(IMPORT_CANCELAMENTO_CONTROLLER);
                    $controllerCancelamento= new controllerCancelamento();
        
                    switch($modo){
                        case "ACEITAR":
                            $erro = $controllerCancelamento->aceitarCancelamento();
                            if($erro){
                                echo utf8_encode(ALERT_ACEITAR_ERRO);
                            }else{
                                echo utf8_encode(ALERT_ACEITAR_SUCESSO);
                            }
                            echo utf8_encode("<script>cancelamento();</script>");
                        break;  
                        
                        case "RECUSAR":
                            $erro = $controllerCancelamento->recusarCancelamento();
                            if($erro){
                                echo utf8_encode(ALERT_RECUSAR_ERRO);
                            }else{
                                echo utf8_encode(ALERT_RECUSAR_SUCESSO);
                            }
                        
                            echo utf8_encode("<script>cancelamento();</script>");
                        break;                  
        
                    }
                 
                 break;          
        
        
            }
        }
        
?>