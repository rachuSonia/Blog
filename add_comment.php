<?php

require('database.php');
$id = $_GET['post_id'];
if(!empty($_POST)){
		
		$pseudo = $_POST['commentaire'];
		$contenu = $_POST['name'];

		$errores=array();
		if(empty($contenu)){
			array_push($errores,'entrer un pseudo');
							}
		if(empty($pseudo)){
			array_push($errores,'entrer un commentaire');
							}

		if(count($errores==0)){

			addComments($id, $pseudo, $contenu);
			$succes='votre formulaire a bien etait envoyer !!';
							}
		

}

header('Location: users.php?id_user=' .$id);
?>