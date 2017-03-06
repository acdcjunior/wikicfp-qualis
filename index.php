<?php

include('cabecalho.php');
include('calculo/calcularClassificacaoQualis.php');

if (isset($_GET['categoria']) && trim($_GET['categoria']) !== '') {
    $categoria = urlencode(trim($_GET['categoria']));
} else {
    $categoria = urlencode('data mining');
}

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

function obterWiki($url, $first) {
    global $categoria;

    $html = file_get_contents($url);

    if (strpos($html, 'Category "'.$categoria.'" is undefined.') !== false) {
        if (!$first) {
            return "";
        }
        return "<h3>A categoria \"$categoria\" buscada não existe. Clique no botão voltar do browser e tente novamente.</h3>";
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
    criarTooltip($dom, $tdQualisHeader, "Passe o mouse sobre a classificação qualis para uma breve explicação de como ela foi calculada.<br>
                                                        Para maiores detalhes, veja os arquivos fontes referenciados no rodapé da página.");
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

            $tituloDoEvento = $tdNomeConf->textContent;
            $siglaDoEvento = $tdSiglaConfEncontrada->item(0)->textContent;

            $qualisDoEvento = calcularClassificacaoQualis($siglaDoEvento, $tituloDoEvento);
            
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


    $retorno = "<hr>
            URL Referência: <a href='$url'>$url</a>";
    if ($first) {
        $retorno .=
            "<form action='' method='GET' class=\"row\">
                <div class=\"col s12\">
                    <div class=\"row\">
                        <div class=\"input-field col s12\">
                            <i class=\"material-icons prefix\">textsms</i>
                            <input type=\"text\" id=\"categoria-input\" name='categoria' value='" . urldecode($categoria) . "'>
                            <label for=\"categoria-input\">Caso deseje, altere a <a href='http://www.wikicfp.com/cfp/allcat'>categoria</a> buscada e pressione <kbd>Enter</kbd> (se não for literalmente uma das  <a href='http://www.wikicfp.com/cfp/allcat'>categorias permitidas</a>, a busca provavelmente não trará resultados):</label>
                        </div>
                    </div>
                </div>
            </form>";
    }
    return $retorno.
            "<br>" .
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

<?= obterWiki('http://www.wikicfp.com/cfp/call?conference='.$categoria, true) ?>
<?= obterWiki('http://www.wikicfp.com/cfp/call?conference='.$categoria.'&page=2', false) ?>
<?= obterWiki('http://www.wikicfp.com/cfp/call?conference='.$categoria.'&page=3', false) ?>

<script>
    $(document).ready(function() {
        // permite HTML na tooltip
        $('.tooltipped').each(function(index, element) {
            var span = $('#' + $(element).attr('data-tooltip-id') + '>span:first-child');
            span.before($(element).attr('data-tooltip'));
            span.remove();
        });
    });
</script>
<hr id=fim>
- Código fonte completo: <a href="https://github.com/acdcjunior/wikicfp-qualis">https://github.com/acdcjunior/wikicfp-qualis</a><br>
- Para entender o que aconteceu em cada <code style="color: red">"Caso #X"</code> veja a função que determina o Qualis com base no título/sigla do evento vs. o que está no banco: <a href="https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularClassificacaoQualis.php">/calcularClassificacaoQualis.php</a><br>
- Função de geração de siglas sintéticas para eventos carregados sem siglas: <a href="https://github.com/acdcjunior/wikicfp-qualis/blob/master/calculo/calcularSiglaSintetica.php">/calcularSiglaSintetica.php</a><br>
</body>
</html>