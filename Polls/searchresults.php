<?php

if(!isset($_POST['search'])) {
	header("Location:index.php"); 
}

$search_sq;="";
$search_query=mysql_query($search_sql);
$search_rs=mysql_fetch_assoc($search_query);



?>