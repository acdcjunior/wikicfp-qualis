<?php

include('crud_cabecalho.php');

$id = (int) $_GET['id']; 
$db->query("DELETE FROM `qualis` WHERE `id` = '$id' "); 
echo (mysql_affected_rows()) ? "Linha apagada.<br /> " : "Nada apagado.<br /> "; 

?> 

<a href='qualis_list.php'>Voltar para listagem</a>

<?php include('crud_rodape.php'); ?>