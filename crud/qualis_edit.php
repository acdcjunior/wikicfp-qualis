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
      `sigla`          = '{$_POST['sigla']}',
      `sigla_efetiva`  = '$siglaEfetiva',
      `titulo`         = '$titulo',
      `qualis`         = '{$_POST['qualis']}',
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
    echo "<a href='qualis_list.php'>Voltar para listagem.</a>"; 
    return;
  }

  $row = $db->query("
    SELECT `sigla`, `sigla_efetiva`, `titulo`, `qualis`, `fonte`, COLUMN_JSON(`metadados`) as metadados
    FROM `qualis`
    WHERE `id` = '$id'
  ")->fetch_array();

  include('qualis_formulario.php');

  qualisFormulario('Editar Classificação Qualis', 'Editar', $row);
}

include('crud_rodape.php');