<?php

include('cabecalho.php');
include('qualis.php');

$url = 'http://www.wikicfp.com/cfp/call?conference=data%20mining';
$html = file_get_contents($url);

function criarAtributo($dom, $pai, $nomeAtributo, $valorAtributo) {
    $atributo = $dom->createAttribute($nomeAtributo);
    $atributo->value = $valorAtributo;
    $pai->appendChild($atributo);
}
function criarTooltip($dom, $elemento, $texto) {
    criarAtributo($dom, $elemento, 'class', 'tooltipped');
    criarAtributo($dom, $elemento, 'data-position', 'bottom');
    criarAtributo($dom, $elemento, 'data-delay', '10');
    criarAtributo($dom, $elemento, 'data-tooltip', $texto);
}

$dom = new DOMDocument();

libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXpath($dom);
$tabelaCallForPapers = $xpath->query("//table[./tr/td[contains(text(), 'Event')]]")->item(0);

// add qualis header
$trHeader = $tabelaCallForPapers->childNodes->item(0);

$tdQualisHeader = $dom->createElement('td', 'Qualis');
criarTooltip($dom, $tdQualisHeader, 'Passe o mouse sobre o qualis para entender como ele foi calculado.');
$icone = $dom->createElement('i', 'info_outline'); 
criarAtributo($dom, $icone, 'class', 'material-icons');
$tdQualisHeader->appendChild($icone);

$trHeader->insertBefore($tdQualisHeader, $trHeader->childNodes->item(1));

foreach ($tabelaCallForPapers->childNodes as $tr) {
    // remove checkbox column
    $tds = $xpath->query('td[./input]', $tr);
    foreach ($tds as $td) {
        $tr->removeChild($td);
    }
    
    // add qualis col
    $tdSiglaConfEncontrada = $xpath->query('td[@rowspan=2]', $tr);
    if ($tdSiglaConfEncontrada->length > 0) {
        $tdNomeConfEncontrada = $xpath->query('td[@rowspan=2]/following-sibling::td', $tr);
        $tdNomeConf = $tdNomeConfEncontrada->item(0);
        
        $qualisDoEvento = qualis($tdSiglaConfEncontrada->item(0)->textContent);
        
        $tdQualis = $dom->createElement('td', $qualisDoEvento->qualis); 
        $tdQualisAtributoRowspan = $dom->createAttribute('rowspan');
        $tdQualisAtributoRowspan->value = '2';
        $tdQualis->appendChild($tdQualisAtributoRowspan);
        
        criarTooltip($dom, $tdQualis, $qualisDoEvento->razao);

        // echo "\n-".$dom->saveXML($tdNomeConf)."\n";
        // echo "--".$dom->saveXML($tdNomeConf->nextSibling)."\n\n\n";
        $tr->insertBefore($tdQualis, $tdNomeConf); 
    }
}


echo "<hr>
URL Referência: <a href='$url'>$url</a><br>
<hr>
<style>
    table, tr, td {
        border: 1px solid white;
        border-collapse: collapse;
        padding: 2px 10px 2px 10px;
    }
    table > tbody > tr:nth-child(1) > td {
        font-size: 130%;
        font-weight: bold;
        text-align: center;
    }
</style>";

$tableHtmlAsString = $dom->saveXML($tabelaCallForPapers);

echo str_replace('src="/cfp/images/new.gif"', "src='http://www.wikicfp.com/cfp/images/new.gif'", $tableHtmlAsString);

echo "<hr id=fim></body></html><!-- fim! -->";