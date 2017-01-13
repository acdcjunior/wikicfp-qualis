<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Id</b></td>"; 
echo "<td><b>Nome Evento</b></td>"; 
echo "<td><b>Qualis</b></td>"; 
echo "<td><b>Fonte</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `qualis`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['nome_evento']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['qualis']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['fonte']) . "</td>";  
echo "<td valign='top'><a href=qualis_edit.php?id={$row['id']}>Edit</a></td><td><a href=qualis_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=qualis_new.php>New Row</a>"; 
?>