<?php 

include('crud_cabecalho.php');

?>

<h1>Lista de Classificações Qualis Cadastradas</h1>
<table class="bordered striped centered responsive-table">
    <thead>
    <tr>
        <th><b>Id</b></th>
        <th><b>Sigla do Evento</b></th>
        <th><b>Qualis</b></th>
        <th><b>Fonte</b></th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>

<?php
    $result = mysql_query("SELECT * FROM `qualis`") or trigger_error(mysql_error()); 
    while($row = mysql_fetch_array($result)) { 
        foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
        echo "<tr>";  
        echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['nome_evento']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['qualis']) . "</td>";  
        echo "<td valign='top'>" . nl2br( $row['fonte']) . "</td>";
        echo "<td valign='top'>"
        ?>
        <a class="btn-floating btn-large waves-effect waves-light" href="qualis_edit.php?id=<?=$row['id']?>"><i class="material-icons">edit</i></a>
        <a class="btn-floating btn-large waves-effect waves-light" href="qualis_delete.php?id=<?=$row['id']?>" onclick="if (!confirm('Tem certeza que deseja apagar esta linha?')) return false;"><i class="material-icons">delete</i></a>
        <?php
        echo "</td> "; 
        echo "</tr>"; 
    }
?>
    </tbody>
</table>
<a class="btn-floating btn-large waves-effect waves-light" href="qualis_new.php"><i class="material-icons">add</i></a>


<?php include('crud_rodape.php'); ?>