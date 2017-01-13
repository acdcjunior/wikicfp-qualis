<? 
include('config.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `qualis` SET  `nome_evento` =  '{$_POST['nome_evento']}' ,  `qualis` =  '{$_POST['qualis']}' ,  `fonte` =  '{$_POST['fonte']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='qualis_list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `qualis` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<p><b>Nome Evento:</b><br /><input type='text' name='nome_evento' value='<?= stripslashes($row['nome_evento']) ?>' /> 
<p><b>Qualis:</b><br /><input type='text' name='qualis' value='<?= stripslashes($row['qualis']) ?>' /> 
<p><b>Fonte:</b><br /><input type='text' name='fonte' value='<?= stripslashes($row['fonte']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
