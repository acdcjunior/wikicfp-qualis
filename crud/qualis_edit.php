<?php

include('crud_cabecalho.php');

if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `qualis` SET  `nome_evento` =  '{$_POST['nome_evento']}' ,  `qualis` =  '{$_POST['qualis']}' ,  `fonte` =  '{$_POST['fonte']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Linha editada.<br />" : "Nada Mudou. <br />"; 
echo "<a href='qualis_list.php'>Voltar para listagem</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `qualis` WHERE `id` = '$id' ")); 
?>

<div class="container">
    <div class="row">
        <h1>Editar Classificação Qualis de Evento</h1>
    </div>
    <div class="row">
        <form action='' method='POST' class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="nome_evento" name='nome_evento' required value='<?= stripslashes($row['nome_evento']) ?>'><label for="nome_evento">Sigla do Evento (Ex.: BRCOM, IEEE-ICDDM, etc.)</label>
            </div>
          </div>
          <div class="row">
              <label>Classificação Qualis do Evento</label>
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
              <input type="text" class="validate" id="fonte" name='fonte' required value='<?= stripslashes($row['fonte']) ?>'><label for="fonte">Onde esse valor de Qualis foi obtido? (Ex.: site oficial, google, outros.)</label>
            </div>
          </div>
          <div class="row">
            <input type='hidden' value='1' name='submitted' /> 
            <button class="btn waves-effect waves-light" type="submit" name="action">Edita Linha
              <i class="material-icons right">send</i>
            </button>
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