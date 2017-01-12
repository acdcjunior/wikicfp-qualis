<?php

$url = 'http://www.wikicfp.com/cfp/call?conference=data%20mining';
$html = file_get_contents($url);

$dom = new DOMDocument();

libxml_use_internal_errors(true);
$dom->loadHTML($html);
libxml_clear_errors();


$xpath = new DOMXpath($dom);
$nodelist = $xpath->query("//table[./tr/td[contains(text(), 'Event')]]");
foreach ($nodelist as $table) {
    foreach ($table->childNodes as $tr) {
        $tds = $xpath->query('td[./input]', $tr);
        foreach ($tds as $td) {
            $tr->removeChild($td);
        }
    }
}


echo "<html>
<head>
<base href='$url'>
</head>
<body>
Url Base: <a href='$url'>$url<a>
<hr id=begin>";

echo $dom->saveXML($nodelist->item(0));

echo "<hr id=fim></body></html><!-- fim! -->";