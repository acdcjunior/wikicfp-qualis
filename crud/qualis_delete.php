<? 
include('config.php'); 
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `qualis` WHERE `id` = '$id' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='qualis_list.php'>Back To Listing</a>