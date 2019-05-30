<?php
/*
    Projeto: Mobshare
    Autor: Igor
    Data Criação: 23/03/2019
    Data Modificação:28/03/2019
    Conteudo Modificação: Uso do arquivo de constantes
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
            case "PARCEIROS":

            require_once(IMPORT_PARCEIRO_CONTROLLER);

            $controllerParceiro = new controllerParceiro();

            switch ($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    $controllerParceiro->inserirParceiro();

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>parceiro();</script>");
                break;

                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $controllerParceiro->excluirParceiro();

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>parceiro();</script>");
                break;

                case "BUSCAR":
                    $parceiro = $controllerParceiro->buscarParceiro();

                    require_once(IMPORT_CADASTRO_PARCEIRO);

                break;

                case "ATUALIZAR":
                    $controllerParceiro->atualizarParceiro();

                    echo utf8_encode("<script>parceiro();</script>");
                break;
            }

            break;


            //FIM PARCEIROS

            case "CLIENTES":
            //Import da controller de cliente
            require_once(IMPORT_CLIENTE_CONTROLLER);

            //Instancia da controller de cliente
                $controllerCliente = new controllerCliente();
                switch ($modo){
                    
                    case "LOGAR":
                    $idCliente = $controllerCliente->logar();

                    require_once(IMPORT_SITE_INDEX);
                    break;

                    case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    
                    $controllerCliente->inserirCliente(1);

                    //Encaminha para a pagina de usuario
                    echo utf8_encode("<script>alert('Cliente cadastrado. Por favor faça seu Login');</script>");
                    
                    echo utf8_encode("<script>window.location.replace('" . LINK_SITE_LOGIN . "');</script>");
                    
                    break;
                }
            break;
            switch ($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    
                    
                    $controllerCliente->inserirCliente(1);

                    //Encaminha para a pagina de usuario
                    echo utf8_encode("<script>alert('Cliente cadastrado. Por favor faça seu Login');</script>");
                    
                    require_once(IMPORT_SITE_LOGIN);
                    
                break;
            }
            switch ($modo){
                case "BUSCAR":
                    //Chamando o método de inserir um novo funcionario
                    
                    
                    $user = $controllerCliente->buscarCliente();

                    //Encaminha para a pagina de usuario
                    
                    var_dump($user);

                    require_once(IMPORT_SITE_USUARIO);
                    
                break;
            }
            switch ($modo){
                case "ATUALIZAR":
                    //Chamando o método de inserir um novo funcionario
                    
                    $controllerCliente->atualizarCliente();

                    echo utf8_encode("<script>verPerfil()</script>");

                    //Encaminha para a pagina de usuario
                    
                    require_once(IMPORT_SITE_USUARIO);
                    
                break;
            }

            break;
            

        case "FUNCIONAMENTO":

            require_once(IMPORT_FUNCIONAMENTO_CONTROLLER);

            $controllerFuncionamento = new controllerFuncionamento();

            switch ($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo funcionario
                    $controllerFuncionamento->inserirFuncionamento();

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>comoFunciona();</script>");
                break;

                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $controllerFuncionamento->excluirFuncionamento();

                    //Encaminha para a pagina de funcionario
                    echo utf8_encode("<script>comoFunciona();</script>");
                break;

                case "BUSCAR":
                    $funcionamento = $controllerFuncionamento->buscarFuncionamento();

                    require_once(IMPORT_CADASTRO_FUNCIONAMENTO);

                break;

                case "ATUALIZAR":
                    $controllerFuncionamento->atualizarFuncionamento();

                    echo utf8_encode("<script>comoFunciona();</script>");
                break;
            }       
        break;

        case "ENDERECO":

        require_once(IMPORT_ENDERECO_CONTROLLER);

        $controllerEndereco = new controllerEndereco();

        switch ($modo){
            case "INSERIR":
                //Chamando o método de inserir um novo funcionario
                $controllerEndereco->inserirEndereco();

                //Encaminha para a pagina de funcionario
                
                echo utf8_encode("<script>cadastrarEndereco();</script>");

            break;

            case "EXCLUIR":
                //Chama o método para excluir o funcionario
                $controllerEndereco->excluirEndereco();

                //Encaminha para a pagina de funcionario
                echo utf8_encode("<script>cadastrarEndereco();</script>");
            break;

            case "BUSCAR":
                $endereco = $controllerEndereco->buscarEndereco();

                require_once(IMPORT_CADASTRO_ENDERECO);

            break;

            case "ATUALIZAR":
                $controllerEndereco->atualizarEndereco();

                echo utf8_encode("<script>cadastrarEndereco();</script>");
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
                $controllerTermos->inserirTermos();

                //Encaminha para a pagina de TERMOS
                echo utf8_encode("<script>termos();</script>");
                break;

            case "EXCLUIR":
                $controllerTermos->excluirTermos();

                //Encaminha para a pagina de TERMOS
                echo utf8_encode("<script>termos();</script>");
                break;

            case "BUSCAR":
                $termo = $controllerTermos->buscarTermo();

                require_once(IMPORT_CADASTRO_TERMO);
                break;

            case "ATUALIZAR":
                $controllerTermos->atualizarTermos();

                echo utf8_encode("<script>termos();</script>");
                break;
        }
        break;

/*        case "MARCAS":

        //Import da controller de TERMOS
        require_once(IMPORT_MARCAS_CONTROLLER);
                
        //Instancia da controller de TERMOS
        $controllerMarca = new controllerMarca();

        switch($modo){
            case "INSERIR":
                //Chamando o método de inserir um novo TERMO
                $controllerMarca->inserirMarcas();

                //Encaminha para a pagina de TERMOS
                echo utf8_encode("<script>marcas();</script>");
                break;

            case "EXCLUIR":
                $controllerMarca->excluirMarcas();

                //Encaminha para a pagina de TERMOS
                echo utf8_encode("<script>marcas();</script>");
                break;

            case "BUSCAR":
                $marca = $controllerMarca->buscarMarcas();

                require_once(IMPORT_CADASTRO_MARCAS);
                break;

            case "ATUALIZAR":
                $controllerMarca->atualizarMarcas();

                echo utf8_encode("<script>marcas();</script>");
                break;
        }
        break;

*/

case "FOTO_VEICULO":

//Import da controller de TERMOS
require_once(IMPORT_FOTO_VEICULO_CONTROLLER);
        
//Instancia da controller de TERMOS
$controllerFoto_Veiculo = new controllerFoto_Veiculo();

switch($modo){
    case "INSERIR":

        $_POST['veiculo'] = $_SESSION['idVeiculo'];
        //Chamando o método de inserir um novo TERMO
        $controllerFoto_Veiculo->inserirFoto_Veiculo();

        //Encaminha para a pagina de TERMOS
           
        echo utf8_encode("<script>veiculo();</script>");
        
        break;

    case "EXCLUIR":
        $controllerMarca->excluirMarcas();

        //Encaminha para a pagina de TERMOS
        echo utf8_encode("<script>marcas();</script>");
        break;

    case "BUSCAR":
        $marca = $controllerMarca->buscarMarcas();

        require_once(IMPORT_CADASTRO_MARCAS);
        break;

    case "ATUALIZAR":
        $controllerMarca->atualizarMarcas();

        echo utf8_encode("<script>marcas();</script>");
        break;
}
break;



case "VEICULOS":

 require_once(IMPORT_VEICULO_CONTROLLER);

 $controllerVeiculo = new controllerVeiculo();

 switch($modo){

    case "INSERIR":
    
        $idVeiculo = $controllerVeiculo->inserirVeiculo();

        echo utf8_encode($idVeiculo);

        if($erro){
            echo utf8_encode(ALERT_INSERIR_VEICULO_ERRO);
        }else{
            echo utf8_encode(ALERT_INSERIR_VEICULO_SUCESSO);

            echo utf8_encode("<script>cadastrarImagemVeiculo(". $_POST["sltCategoria"] .", " . $idVeiculo . ");</script>");
        }
        


     break;


     case "ATUALIZAR":


    
     $idVeiculo = $controllerVeiculo->atualizarVeiculo();

     echo utf8_encode($idVeiculo);
     

     echo utf8_encode("<script>veiculo();</script>");
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
     
     case "AVALIACAO_VEICULO":

            require_once(IMPORT_AVALIACAO_VEICULO_CONTROLLER);

            $controllerAvaliacaoVeiculo= new controllerAvaliacaoVeiculo();

            
            switch($modo){    
                
                case "BUSCAR":

                $avaliacaoVeiculo = new AvalicaoVeiculo();
                $avaliacaoVeiculo = $controllerAvaliacaoVeiculo->buscarAvaliacaoVeiculos();
                
                //require_once(IMPORT_CADASTRO_BANNER);
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
                    $controllerDuvidasFrequentes->inserirDuvida();
                    //Encaminha para a pagina de Duvidas Frequentes
                    echo utf8_encode("<script>duvida();</script>");
                    break;
                     
                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $controllerDuvidasFrequentes->excluirDuvida();
                    //Encaminha para a pagina de funcionario
                    
                    echo utf8_encode("<script>duvida();</script>");
                    break;
                    
                    
                 case "ATUALIZAR":
                    $controllerDuvidasFrequentes->atualizarLista();
                    echo utf8_encode("<script>duvida();</script>");
                    break;        
            
                case "BUSCAR":
                    
                    $duvidasFrequentes = $controllerDuvidasFrequentes->buscarDuvidas();
                    require_once(IMPORT_CADASTRO_DUVIDAS);
                    
                    break;    
            }
           break;

           case "SOLICITACAO":

        //Import da controller de TERMOS
        require_once(IMPORT_SOLICITACAO_LOCACAO_CONTROLLER);
                
        //Instancia da controller de TERMOS
        $controllerSolicitacao_Locacao = new controllerSolicitacao_Locacao();

        switch($modo){
            case "ACEITAR":
                //Chamando o método de inserir um novo TERMO
                $id = $_GET['id'];
                $controllerSolicitacao_Locacao->aceitarSolicitacao($id);

                //Encaminha para a pagina de TERMOS
                // echo utf8_encode("<script>marcas();</script>");
                break;

            case "RECUSAR":
                $controllerSolicitacao_Locacao->recusarSolicitacao();

                //Encaminha para a pagina de TERMOS
                // echo utf8_encode("<script>marcas();</script>");
                break;

           
        }
        break;
        case "FOTO_VEICULO":

//Import da controller de TERMOS
require_once(IMPORT_FOTO_VEICULO_CONTROLLER);
        
//Instancia da controller de TERMOS
$controllerFoto_Veiculo = new controllerFoto_Veiculo();

switch($modo){
    case "INSERIR":

        $_POST['veiculo'] = $_SESSION['idVeiculo'];
        //Chamando o método de inserir um novo TERMO
        $controllerFoto_Veiculo->inserirFoto_Veiculo();

        //Encaminha para a pagina de TERMOS
           
        echo utf8_encode("<script>veiculo();</script>");
        
        break;

    case "EXCLUIR":
        $controllerMarca->excluirMarcas();

        //Encaminha para a pagina de TERMOS
        echo utf8_encode("<script>marcas();</script>");
        break;

    case "BUSCAR":
        $marca = $controllerMarca->buscarMarcas();

        require_once(IMPORT_CADASTRO_MARCAS);
        break;

    case "ATUALIZAR":
        $controllerMarca->atualizarMarcas();

        echo utf8_encode("<script>marcas();</script>");
        break;
}
break;



case "VEICULOS":

 require_once(IMPORT_VEICULO_CONTROLLER);

 $controllerVeiculo = new controllerVeiculo();

 switch($modo){

    case "INSERIR":
    
        $idVeiculo = $controllerVeiculo->inserirVeiculo();

        echo utf8_encode($idVeiculo);

        if($erro){
            echo utf8_encode(ALERT_INSERIR_VEICULO_ERRO);
        }else{
            echo utf8_encode(ALERT_INSERIR_VEICULO_SUCESSO);

            echo utf8_encode("<script>cadastrarImagemVeiculo(". $_POST["sltCategoria"] .", " . $idVeiculo . ");</script>");
        }
        


     break;


     case "ATUALIZAR":


    
     $idVeiculo = $controllerVeiculo->atualizarVeiculo();

     echo utf8_encode($idVeiculo);
     

     echo utf8_encode("<script>veiculo();</script>");
     break; 

 }
                    
break;
        
            case "FALE_CONOSCO":
        
            //Import da controller de DuvidasFrequentes
            require_once(IMPORT_FALE_CONOSCO_CONTROLLER);

            //Instancia da controller de DuvidasFrequentes
            $controllerFaleConosco = new controllerFaleConosco();  
            
            switch($modo){
                case "INSERIR":
                    //Chamando o método de inserir um novo Duvidas Frequentes
                    $erro = $controllerFaleConosco->inserirFaleConosco();
                    //Encaminha para a pagina de Duvidas Frequentes
                   if(!$erro){
                       echo utf8_encode("<script>alert('dasdasd');</script>");
                   }
                    header("Location: view/faleconosco/faleconosco.php");
                    break;
                     
                case "EXCLUIR":
                    //Chama o método para excluir o funcionario
                    $controllerFaleConosco->excluirDuvida();
                    //Encaminha para a pagina de funcionario
                    
                    echo utf8_encode("<script>faleConosco();</script>");
                    break;
                    
                    
                 case "ATUALIZAR":
                    $controllerFaleConosco->atualizarLista();
                    echo utf8_encode("<script>faleConosco();</script>");
                    break;   
    }
            
    break;  

    }
}
?>
