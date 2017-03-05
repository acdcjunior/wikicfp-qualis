<?php

include('../cabecalho.php');
include('../calculo/calcularSiglaSintetica.php');

if (isset($_POST['submitted'])) { 
  foreach($_POST AS $key => $value) { $_POST[$key] = $db->real_escape_string($value); } 
  
  $titulo = "{$_POST['titulo']}";
  $siglaEfetiva = trim("{$_POST['sigla']}");
  if (empty($siglaEfetiva)) {
    $siglaEfetiva = calcularSiglaSintetica($titulo);
  }
  
  $sql = "
    INSERT INTO `qualis`
    (
      `issn`,
      `sigla`,
      `sigla_efetiva`,
      `titulo`,
      `qualis`,
      `area_avaliacao`,
      `fonte`
    )
    VALUES
    (
      '{$_POST['issn']}',
      '{$_POST['sigla']}',
      '$siglaEfetiva',
      '$titulo',
      '{$_POST['qualis']}',
      '{$_POST['area_avaliacao']}',
      '{$_POST['fonte']}'
    )
    "; 

  if ($db->query($sql) === TRUE) {
    echo "<h2>Linha adicionada com sucesso.</h2>"; 
    echo "<a href='qualis_list.php'>Voltar para listagem.</a>"; 
  } else {
    echo "Erro: " . $sql . "<br>" . $db->error;
  }
  

  return;
} 

include('qualis_formulario.php');

qualisFormulario('Nova Classificação Qualis', 'Inserir', $row);

include('crud_rodape.php');