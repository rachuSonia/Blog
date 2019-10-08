<?php
	require('database.php');

	$id=$_GET['id'];
	delteArticle($id);
	header('Location:admin.php');


?>