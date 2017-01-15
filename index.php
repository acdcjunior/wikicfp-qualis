<?php

include('qualis.php');

$url = 'http://www.wikicfp.com/cfp/call?conference=data%20mining';
$html = file_get_contents($url);

$dom = new DOMDocument();

libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXpath($dom);
$tabelaCallForPapers = $xpath->query("//table[./tr/td[contains(text(), 'Event')]]")->item(0);

// add qualis header
$trHeader = $tabelaCallForPapers->childNodes->item(0);
$tdQualisHeader = $dom->createElement('td', 'Qualis'); 
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
        
        $tdQualis = $dom->createElement('td', $qualisDoEvento); 
        $tdQualisRowspan = $dom->createAttribute('rowspan');
        $tdQualisRowspan->value = '2';
        $tdQualis->appendChild($tdQualisRowspan);

        // echo "\n-".$dom->saveXML($tdNomeConf)."\n";
        // echo "--".$dom->saveXML($tdNomeConf->nextSibling)."\n\n\n";
        $tr->insertBefore($tdQualis, $tdNomeConf); 
    }
}


echo "<html>
<head>
<base href='$url'>
</head>
<body>
URL Referência: <a href='$url'>$url<a><br>
<button type='button' onclick='javascript:location.href = window.location + \"crud\"; return false;'>Clique aqui para editar a base de classificações qualis</button>
<hr>
<h1 style='color: red'>Atenção: As classificações qualis abaixo não estão corretas, são dados de testes, apenas.</h1>
<hr>";

echo $dom->saveXML($tabelaCallForPapers);

echo "<hr id=fim></body></html><!-- fim! -->";