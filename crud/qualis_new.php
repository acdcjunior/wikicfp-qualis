<?php

include('crud_cabecalho.php');

if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `qualis` ( `nome_evento` ,  `qualis` ,  `fonte`  ) VALUES(  '{$_POST['nome_evento']}' ,  '{$_POST['qualis']}' ,  '{$_POST['fonte']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Linha adicionada.<br />"; 
echo "<a href='qualis_list.php'>Voltar para listagem</a>"; 
} 
?>

<div class="container">
    <div class="row">
        <h1>Nova Classificação Qualis de Evento</h1>
    </div>
    <div class="row">
        <form action='' method='POST' class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="nome_evento" name='nome_evento' required><label for="nome_evento">Sigla do Evento (Ex.: BRCOM, IEEE-ICDDM, etc.)</label>
            </div>
          </div>
          <div class="row">
              <label>Classificação Qualis do Evento</label>
              <select id="qualis" name='qualis' required class="browser-default">
                <option value="" disabled selected>Selecione a classificação Qualis deste evento</option>
                <option>C
                <option>B5
                <option>B4
                <option>B3
                <option>B2
                <option>B1
                <option>A2
                <option>A1
              </select>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" id="fonte" name='fonte' required><label for="fonte">Onde esse valor de Qualis foi obtido? (Ex.: site oficial, google, outros.)</label>
            </div>
          </div>
          <div class="row">
            <input type='hidden' value='1' name='submitted' /> 
            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
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

<?php include('crud_rodape.php'); ?>