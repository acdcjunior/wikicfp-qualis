<?php

/*
    https://ppca-2016-2.slack.com/archives/mineracao/p1484746495000002

    ATENCAO: O ALGORITMO AINDA NAO FOI IMPLEMENTADO, ESTA SO COMECANDO
    
    Sugestao inicial:
    - Comparar pela sigla, se achar só um, retorna essa mesmo
    - Se retornar mais de 1, ver se titulo bate
        - Se bater só com um, retorna
        - Se não bater com nenhum calcular edit distance e selecionar o de menor distancia
        
    IMPORTANTE: O campo sigla a ser usado eh o campo `SIGLA_EFETIVA`, que eh preenchido
    com um valor sintetico (gerado), mesmo quando o evento nao teve sigla cadastrada.

*/
function calcularClassificacaoQualis($nomeEventoComAno) {
    $nomeEventoSemAno = removerAno($nomeEventoComAno);
    
    $bySigla = getBySiglaExatamente($nomeEventoSemAno);

    $numeroDeEventosEncontradosComAMesmaSigla = sizeof($bySigla);
    if ($numeroDeEventosEncontradosComAMesmaSigla == 1) {
        return resultado($bySigla[0]['qualis'], "Apenas um evento foi encontrado para essa sigla.<br>Título: ".$bySigla[0]['titulo']);
    }
    if ($numeroDeEventosEncontradosComAMesmaSigla > 1) {
        $result = "";
        for($i = 0; $i < sizeof($bySigla); $i++) {
            $result .= "<br>Sigla: ".$bySigla[$i]['sigla_efetiva'].
                "<br>Qualis: ".$bySigla[$i]['qualis'].
                "<br>Título: ".$bySigla[$i]['titulo']."<br>";
        }
        return resultado("Vários*", "Multiplos Qualis: ".$numeroDeEventosEncontradosComAMesmaSigla." foram encontrados para essa sigla: ".$result);
    } else {
        return resultado("-", "Nenhuma classificacao encontrada para essa sigla.");
    }
}




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
    global $db;
    return goSQL("SELECT `qualis`, `titulo`, `sigla_efetiva` FROM `qualis` WHERE `sigla_efetiva` = '".$db->real_escape_string($sigla)."'");
}

function goSQL($sql) {
    global $db;
    $data = array();
    
    $query = $db->query($sql);

    while($row = $query->fetch_array(MYSQLI_ASSOC)) {
        $data[] = $row;
    }
    return $data;
}