<?php

   require('database.php');
   $id=$_POST['id_article'];
   $title=$_POST['title'];
   $content=$_POST['article'];

editArticle($id, $title, $content);

header('Location: admin.php');

?>