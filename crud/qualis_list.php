<?php 

include('../cabecalho.php');

?>

<h1>Classificações Qualis Cadastradas</h1>
<table class="bordered striped centered responsive-table">
    <thead>
    <tr>
        <th style="width: 40%"><b>Título</b></th>
        <th style="width: 20%"><b>Sigla</b></th>
        <th style="width: 5%"><b>Qualis</b></th>
        <th style="width: 10%"><b>ISSN</b></th>
        <th style="width: 15%"><b>Área de Avaliação</b></th>
        <th style="width: 5%"><b>Fonte</b></th>
        <th style="width: 5%">&nbsp;</th>
    </tr>
    </thead>
    <tbody>

<?php
    function nulavel($nomeCampo, $artigo, $valorCampo) {
        if (strlen($valorCampo) > 0) {
            return truncavel($valorCampo, 18);
        } else {
            $nenhum = $artigo == "a" ? "a" : "";
            return "
            >
            <span class='tooltipped' data-position='bottom' data-delay='10' data-tooltip='Nenhum$nenhum $nomeCampo fornecid$artigo, ainda. Clique em editar para adicioná-l$artigo.'>
                <i class='material-icons'>not_interested</i>
            </span>
            ";
        }
    }
    function truncavel($valorCampo, $tamanhoMax) {
        return " class='tooltipped' data-delay='10' data-tooltip='".nl2br($valorCampo)."'>" . (strlen($valorCampo) > $tamanhoMax ? substr($valorCampo, 0, $tamanhoMax)."..." : $valorCampo);
    }

    $query = $db->query("SELECT * FROM `qualis`");
    while($row = $query->fetch_array(MYSQLI_ASSOC)) { 
        foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
        echo "<tr>";  
        echo "<td valign='top' class='tooltipped' data-delay='1000' data-tooltip='Id desta linha no banco: ".$row['id']."'>" . nl2br( $row['titulo']) . "</td>";  
        echo "<td valign='top' " . nulavel("sigla", "a", $row['sigla']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['qualis']) . "</td>";
        echo "<td valign='top' " . nulavel("número ISSN", "o", $row['issn']) . "</td>";
        echo "<td valign='top' " . nulavel("Área de Avaliação", "a", $row['area_avaliacao']) . "</td>";
        echo "<td valign='top' " . truncavel($row['fonte'], 5) . "</td>";
        echo "<td valign='top'>"
        ?>
        <a class="btn-floating btn waves-effect waves-light tooltipped" data-position='bottom' data-delay='10' data-tooltip='Editar classificação' href="qualis_edit.php?id=<?=$row['id']?> "><i class="material-icons">edit</i></a>
        <?php
//        <a class="btn-floating btn waves-effect waves-light tooltipped deep-orange lighten-5" data-position='bottom' data-delay='10' data-tooltip='Apagar classificação' href="qualis_delete.php?id=<?=$row['id']
// ? >" onclick="if (!confirm('Tem certeza que deseja apagar esta linha?')) return false;"><i class="material-icons">delete</i></a>
        echo "</td> "; 
        echo "</tr>"; 
    }
?>
    </tbody>
</table>
<br>
<a class="btn-floating btn-large waves-effect waves-light tooltipped blue" data-position='bottom' data-delay='10' data-tooltip='Incluir nova classificação' href="qualis_new.php"><i class="material-icons">add</i></a>


<?php include('crud_rodape.php'); ?>