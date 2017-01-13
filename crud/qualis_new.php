<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `qualis` ( `nome_evento` ,  `qualis` ,  `fonte`  ) VALUES(  '{$_POST['nome_evento']}' ,  '{$_POST['qualis']}' ,  '{$_POST['fonte']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='qualis_list.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Nome Evento:</b><br /><input type='text' name='nome_evento'/> 
<p><b>Qualis:</b><br /><input type='text' name='qualis'/> 
<p><b>Fonte:</b><br /><input type='text' name='fonte'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
