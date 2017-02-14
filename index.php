<?php

include('cabecalho.php');
include('calculo/calcularClassificacaoQualis.php');


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

function obterWiki($url) {
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
            
            $qualisDoEvento = calcularClassificacaoQualis($tdSiglaConfEncontrada->item(0)->textContent);
            
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
    
    $tableHtmlAsString = $dom->saveXML($tabelaCallForPapers);

    return "<hr>
            URL Referência: <a href='$url'>$url</a>
            <br>" . 
            str_replace('<a href="/cfp/servlet/', '<a href="http://www.wikicfp.com/cfp/servlet/',
                str_replace('src="/cfp/images/new.gif"', "src='http://www.wikicfp.com/cfp/images/new.gif'",
                    $tableHtmlAsString
                )
            );
}

?>
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
    table > tbody > tr > td:nth-child(1) { width: 24%; }
    table > tbody > tr > td:nth-child(2) { width: 8%; }
    table > tbody > tr > td:nth-child(3) { width: 23%; }
    table > tbody > tr > td:nth-child(4) { width: 23%; }
    table > tbody > tr > td:nth-child(5) { width: 22%; }
</style>

<?= obterWiki('http://www.wikicfp.com/cfp/call?conference=data%20mining') ?>
<?= obterWiki('http://www.wikicfp.com/cfp/call?conference=data%20mining&page=2') ?>

<script>
    $(document).ready(function() {
        $('.tooltipped').each(function(index, element) {
            var span = $('#' + $(element).attr('data-tooltip-id') + '>span:first-child');
            span.before($(element).attr('data-tooltip'));
            span.remove();
        });
    });
</script>
<hr id=fim>
- Código fonte completo: <a href="https://github.com/acdcjunior/wikicfp-qualis">https://github.com/acdcjunior/wikicfp-qualis</a><br>
- Função que determina o Qualis com base no título/sigla do evento vs. o que está no banco: <a href="https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularClassificacaoQualis.php">https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularClassificacaoQualis.php</a><br>
- Função de geração de siglas sintéticas para eventos carregados sem siglas: <a href="https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularSiglaSintetica.php">https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularSiglaSintetica.php</a><br>
</body>
</html>