<?php

include('../cabecalho.php');
include('../calculo/calcularSiglaSintetica.php');

if (isset($_GET['id']) ) {
  $id = (int) $_GET['id']; 
  if (isset($_POST['submitted'])) { 
    foreach($_POST AS $key => $value) { $_POST[$key] = $db->real_escape_string($value); } 
    
    $titulo = "{$_POST['titulo']}";
    $siglaEfetiva = trim("{$_POST['sigla']}");
    if (empty($siglaEfetiva)) {
      $siglaEfetiva = calcularSiglaSintetica($titulo);
    }

    $sql = "
    UPDATE `qualis` SET
      `issn`           = '{$_POST['issn']}',
      `sigla`          = '{$_POST['sigla']}',
      `sigla_efetiva`  = '$siglaEfetiva',
      `titulo`         = '$titulo',
      `qualis`         = '{$_POST['qualis']}',
      `area_avaliacao` = '{$_POST['area_avaliacao']}',
      `fonte`          = '{$_POST['fonte']}'
    WHERE `id` = '$id' 
    "; 
    $db->query($sql); 
    
    echo "<br>";
    if ($db->affected_rows) {
      echo "<h2>Linha editada.</h2>";
    } else { 
      echo "<h2>Nada Mudou.</h2>"; 
    }
    echo "<a href='qualis_list.php'>Voltar para listagem</a>"; 
    return;
  } 
  
  $row = $db->query("SELECT * FROM `qualis` WHERE `id` = '$id' ")->fetch_array(); 
?>

<div class="container">
    <div class="row">
        <h1>Editar Classificação Qualis</h1>
    </div>
    <div class="row">
        <form action='' method='POST' class="col s12">
          
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="titulo" name='titulo' required value='<?= stripslashes($row['titulo']) ?>'><label for="titulo">Título (Ex.: IEEE TRANSACTIONS ON SOFTWARE ENGINEERING)</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="sigla" name='sigla' value='<?= stripslashes($row['sigla']) ?>'><label for="sigla">Sigla do Evento (Ex.: BRCOM, IEEE-ICDDM, etc.)</label>
            </div>
          </div>
          
          <div class="row">
              <label>Classificação (Estrato) Qualis do Evento</label>
              <select id="qualis" name='qualis' required class="browser-default">
                <option value="" disabled selected>Selecione a classificação Qualis deste evento</option>
                <option <?=($row['qualis'] == 'C')?'selected':''?>>C
                <option <?=($row['qualis'] == 'B5')?'selected':''?>>B5
                <option <?=($row['qualis'] == 'B4')?'selected':''?>>B4
                <option <?=($row['qualis'] == 'B3')?'selected':''?>>B3
                <option <?=($row['qualis'] == 'B2')?'selected':''?>>B2
                <option <?=($row['qualis'] == 'B1')?'selected':''?>>B1
                <option <?=($row['qualis'] == 'A2')?'selected':''?>>A2
                <option <?=($row['qualis'] == 'A1')?'selected':''?>>A1
              </select>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="issn" name='issn' value='<?= stripslashes($row['issn']) ?>'><label for="issn">ISSN (Ex.: 0098-5589)</label>
            </div>
          </div>
          
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="area_avaliacao" name='area_avaliacao' value='<?= stripslashes($row['area_avaliacao']) ?>'><label for="area_avaliacao">Área de Avaliação (Ex.: CIÊNCIA DA COMPUTAÇÃO)</label>
            </div>
          </div>
          
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="fonte" name='fonte' required value='<?= stripslashes($row['fonte']) ?>'><label for="fonte">Onde esse valor de Qualis foi obtido? (Ex.: site oficial, google, outros.)</label>
            </div>
          </div>
          
          <div class="row">
            <input type='hidden' value='1' name='submitted' /> 
            <button class="btn waves-effect waves-light" type="submit" name="action">Editar
              <i class="material-icons right">send</i>
            </button>
            <a class="btn waves-effect waves-light grey lighten-5" style='color: black' href='qualis_list.php'><i class="material-icons right">undo</i>Voltar para listagem</a>
          </div>
        </form>
    </div>
</div>
<script type="text/javascript">
  /* global $ */
  $(document).ready(function() {
    $('#qualis').material_select();
  });
</script>


<?php } ?> 

<?php include('crud_rodape.php'); ?>