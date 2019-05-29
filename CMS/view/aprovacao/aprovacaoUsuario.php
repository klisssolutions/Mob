<?php
  @session_start();
  require_once($_SESSION["importInclude"]); 
  define("MARCADO", "checked");

  if(isset($pendencia)){
    $idPendencia = $pendencia->getIdPendencia();
    $nome = $pendencia->getNome();
    $id = $pendencia->getId();
    $motivo = $pendencia->getMotivo();
    $aberto = $pendencia->getAberto();
    $router = "router('pendenciausuario', 'atualizar', ".$idPendencia.")";
    
    //Verifica se tem as permissões para marcar as caixas de permissoes
    $chkAberto = ($aberto ? MARCADO : null);
  }
?>

<div class="titulo-func-lista">APROVAÇÃO DE CADASTRO</div>
<form id="form" method="POST">

<table class="func-cad">
          <tr>
              <td class="titulo-func-cad">
                  Nome:
              </td>
              <td class="titulo-func-cad">
                <?php echo utf8_encode($nome); ?>
              </td>
          </tr>
          <tr>
              <td class="titulo-func-cad">
                  ID:
              </td>
              <td class="titulo-func-cad">
              <?php echo utf8_encode($id); ?>
              </td>
          </tr>
          <tr>
              <td class="titulo-func-cad">
                  Motivo:
              </td>
              <td class="titulo-func-cad">
                <textarea name="txtDescricao" class="input-func2" required><?php echo utf8_encode($motivo); ?></textarea>
              </td>
          </tr>
          <tr>
              <td class="titulo-func-cad">
                  Aberto:
              </td>
              <td class="titulo-func-cad">
                
                  <input type="checkbox" name="chkaberto" <?php echo utf8_encode($chkAberto); ?>>
                </select>
              </td>
          </tr>
          <tr>
              <td class="titulo-func-cad">
                <input type="submit" value="Aceitar" class="btn-fun" onclick="<?php echo utf8_encode($router);?>">
              </td>
          </tr>
  </table>

</form>