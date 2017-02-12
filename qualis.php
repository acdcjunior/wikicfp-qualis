<?php

function qualis($nomeEventoComAno) {
    $nomeEventoSemAno = removerAno($nomeEventoComAno);
    
    $bySigla = getBySiglaExatamente($nomeEventoSemAno);

    $numeroDeEventosEncontradosComAMesmaSigla = sizeof($bySigla);
    if ($numeroDeEventosEncontradosComAMesmaSigla == 1) {
        return resultado($bySigla[0]['qualis'], "Apenas um evento foi encontrado com essa sigla."); 
    }
    if ($numeroDeEventosEncontradosComAMesmaSigla > 1) {
        return resultado("-", "Multiplos Qualis: ".$numeroResultados);
    } else {
        return resultado("-", "Sem Cadastro");
    }
}

/*
https://ppca-2016-2.slack.com/archives/mineracao/p1484746495000002

uma alternativa é comparar pela sigla, se achar só um, retorna essa mesmo
se retornar mais de 1, veja se o nome completo bate
se bater só com um, fechou
se não bater com nenhum calcule a distância de levenshtein e selecione o q tiver menor distância ou maior semelhança
acho q resolve, não?
agora, se tu for do Wiki pra lista de qualis, vai ter um monte de caso q não vai ter qualis associado
se for da lista de qualis pra Wiki, aí acho q vai ser mais simples e vai achar tudo

*/


function removerAno($nome) {
    return preg_replace("/(19|20)\d\d/", "", trim($nome));
}
function resultado($qualis, $razao) {
    $obj = new stdClass;
    $obj->qualis = $qualis;
    $obj->razao = $razao;
    return $obj;
}

function getBySiglaExatamente($sigla) {
    return goSQL("SELECT `qualis` FROM `qualis` WHERE `sigla` = '".mysql_real_escape_string($sigla)."'");
}

function goSQL($sql) {
    $data = array();
    
    $result = mysql_query($sql) or trigger_error(mysql_error());
    
    if ($result) {
        while($row = mysql_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}