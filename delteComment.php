<?php

require('database.php');
$id=$_GET['id_comment'];
deleteComment($id);
header('Location:users.php');


?>
