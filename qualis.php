<?php

include('database.php');

function qualis($nomeEventoComAno) {
    $nomeEventoSemAno = preg_replace("/(19|20)\d\d/", "", trim($nomeEventoComAno));
    
    $sql = "SELECT `qualis` FROM `qualis` WHERE `nome_evento` = '".mysql_real_escape_string($nomeEventoSemAno)."'";
    $result = mysql_query($sql) or trigger_error(mysql_error());
    
    $numeroResultados = (int) mysql_num_rows($result);
    if ($numeroResultados > 1) {
        return "Multiplos Qualis: ".$numeroResultados;
    } else if ($numeroResultados == 0) {
        return "Sem Cadastro";
    } else {
        $row = mysql_fetch_assoc($result);
        return $row['qualis'];
    }
}