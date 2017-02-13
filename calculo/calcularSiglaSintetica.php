<?php

/**
 * Funcao que tenta gerar uma sigla para um dado titulo.
 * 
 * Em resumo, ela remove caracteres especiais e stop words, e entao pega
 * o primeiro caractere de cada palavra do titulo.
 */
function calcularSiglaSintetica($titulo) {
    $tituloEmMaiusculo = strtoupper($titulo);
    $tituloSemStopChars = removerStopChars($tituloEmMaiusculo);
    $tituloSemStopWords = removerStopWords($tituloSemStopChars);
    
    $words = preg_split("/[\s,_-]+/", $tituloSemStopWords);
    $sigla = "";

    foreach ($words as $w) {
      $sigla .= $w[0];
    }
    return $sigla;
}

function removerStopChars($titulo) {
    return preg_replace('/[-&\\t\\r\\n(){}\\[\\]:\\?]+/i', '', $titulo);
}
function removerStopWords($titulo) {
    $stopWords = array('A','E','DE','DO','AND','OF','FOR');
	return preg_replace('/\b(' . implode('|', $stopWords) . ')\b/', '', $titulo);
}
