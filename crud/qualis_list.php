<?php 

include('../cabecalho.php');

?>

<h1>Classificações Qualis Cadastradas</h1>
<table class="bordered striped centered responsive-table">
    <thead>
    <tr>
        <th><b>Id</b></th>
        <th><b>Título</b></th>
        <th><b>Sigla</b></th>
        <th><b>Qualis</b></th>
        <th><b>ISSN</b></th>
        <th><b>Área de Avaliação</b></th>
        <th><b>Fonte</b></th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>

<?php
    function nulavel($nomeCampo, $artigo, $valorCampo) {
        if (strlen($valorCampo) > 0) {
            return nl2br($valorCampo);
        } else {
            $nenhum = $artigo == "a" ? "a" : "";
            return "
            <span class='tooltipped' data-position='bottom' data-delay='10' data-tooltip='Nenhum$nenhum $nomeCampo fornecid$artigo, ainda. Clique em editar para adicioná-l$artigo.'>
                <i class='material-icons'>not_interested</i>
            </span>
            ";
        }
    }

    $result = mysql_query("SELECT * FROM `qualis`") or trigger_error(mysql_error()); 
    while($row = mysql_fetch_array($result)) { 
        foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
        echo "<tr>";  
        echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['titulo']) . "</td>";  
        echo "<td valign='top'>" . nulavel("sigla", "a", $row['sigla']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['qualis']) . "</td>";
        echo "<td valign='top'>" . nulavel("número ISSN", "o", $row['issn']) . "</td>";
        echo "<td valign='top'>" . nulavel("Área de Avaliação", "a", $row['area_avaliacao']) . "</td>";
        echo "<td valign='top' class='tooltipped' data-position='bottom' data-delay='10' data-tooltip='".nl2br( $row['fonte'])."'>" . ( strlen($row['fonte']) > 5 ? substr($row['fonte'],0,5)."..." : $row['fonte'] ) . "</td>";
        echo "<td valign='top'>"
        ?>
        <a class="btn-floating btn waves-effect waves-light tooltipped" data-position='bottom' data-delay='10' data-tooltip='Editar classificação' href="qualis_edit.php?id=<?=$row['id']?> "><i class="material-icons">edit</i></a>
        <a class="btn-floating btn waves-effect waves-light tooltipped deep-orange lighten-5" data-position='bottom' data-delay='10' data-tooltip='Apagar classificação' href="qualis_delete.php?id=<?=$row['id']?>" onclick="if (!confirm('Tem certeza que deseja apagar esta linha?')) return false;"><i class="material-icons">delete</i></a>
        <?php
        echo "</td> "; 
        echo "</tr>"; 
    }
?>
    </tbody>
</table>
<br>
<a class="btn-floating btn-large waves-effect waves-light tooltipped blue" data-position='bottom' data-delay='10' data-tooltip='Incluir nova classificação' href="qualis_new.php"><i class="material-icons">add</i></a>


<?php include('crud_rodape.php'); ?>