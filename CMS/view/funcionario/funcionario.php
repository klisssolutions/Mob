<?php
  @session_start();
  require_once($_SESSION["importInclude"]); 

  //Instância de níveis para colocar na combobox
  require_once(IMPORT_NIVEL);
  require_once(IMPORT_NIVEL_CONTROLLER);
  
  $controllerNivel = new controllerNivel();
  $niveis[] = new Nivel();
  $niveis = $controllerNivel->listarNiveis();


  $nome = '';
  $email = '';
  $senha = '';
  $idNivel = '';

  $router = "router('funcionarios', 'inserir', '0')";

  if(isset($funcionario)){
    $nome = $funcionario->getNome();
    $email = $funcionario->getEmail();
    $senha = $funcionario->getSenha();
    $idNivel = $funcionario->getIdNivel();

    $router = "router('funcionarios', 'atualizar', '".$funcionario->getIdUsuarioWeb()."')";

  }


?>

<div class="titulo-func-lista">GERENCIAMENTO DE FUNCIONARIO</div>

<form id="form" method="post">

    <table class="func-cad">
        <tr>
            <td class="titulo-func-cad">
            Nome:
            </td>
            <td class="txt-func">
              <input type="text" class="input-func" name="txtnome" maxlength="25" value="<?php echo utf8_encode($nome)?>" size="20" required>
            </td>
        </tr>
        <tr>
            <td class="titulo-func-cad">
            E-mail:
            </td>
            <td class="txt-func">
              <input type="email" class="input-func" name="txtemail" maxlength="25" value="<?php echo utf8_encode($email)?>" size="20" required>
            </td>
        </tr>
        <tr>
            <td class="titulo-func-cad">
                Senha
            </td>
            <td class="txt-func">
              <input type="password"  class="input-func" name="txtsenha" maxlength="10" value="<?php echo utf8_encode($senha)?>" size="20" required>
            </td>
        </tr>
        <tr>
            <td class="titulo-func-cad">
            Nivel:
            </td>
            <td class="txt-func">
              <select   class="slt-func" name="cbbnivel"required>
                <option value="">Selecione um nível</option>
                <?php foreach($niveis as $nivel){ 
                        $selected = ($idNivel == $nivel->getIdNivel() ? "selected" : null);
                ?>
                  <option value="<?php echo utf8_encode($nivel->getIdNivel()); ?>" <?php echo utf8_encode($selected); ?>><?php echo utf8_encode($nivel->getNome()); ?></option>
                <?php } ?>
              </select>
            </td>
        </tr>
        
        <tr>
            <td class="titulo-func-cad">
            <input type="button" value="Voltar" class="btn-fun" onclick="funcionario();">
            </td>
            <td class="titulo-func-cad">
              <input type="submit" value="Enviar" class="btn-fun" onclick="<?php echo utf8_encode($router)?>">
            </td>
        </tr>
    </table>

</form>
