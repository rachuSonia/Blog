<?php
require('database.php');
session_start();

$id=$_GET['id_user'];

if(!isset($id) || !is_numeric($id)){
	header('Location:index.php');

}
else{
	
	if(!empty($_POST)){

		$pseudo = $_POST['commentaire'];
		$contenu = $_POST['name'];

		$errores=array();
		if(empty($contenu)){
			$errores['name']='Entrez un pseudo !';
		}

		if(empty($pseudo)){
			$errores['commentaire']='Entrez un commentaire !';
		}

		if(count($errores)==0){

			addComments($id, $pseudo, $contenu);
			$succes='Votre formulaire a bien était envoyer !!';
			unset($pseudo);
			unset($contenu);
		}

	}

	$data=articleUsers($id);
	$add=getComments($id);
}
if(isset($_SESSION['id_user'])){
	 	
	$pdo=createConnection();
   $req=$pdo->prepare('SELECT * FROM `users` WHERE `id_user`=?');
   $req->execute(array($_SESSION['id_user']));
   $userInfo=$req->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>blog</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<a href="index.php" class="entete">ENCORE UN BLOG ?!</a>
		<a href="admin.php" class="Administration"><i class="fas fa-cogs"></i>Administration</a>
	</header>
	<main>

	<?php
				if(isset($userInfo)) : ?>
				<div class="profil">
					<p> <strong><em>Bonjour</em>  <i class="far fa-smile-beam"></i></strong> <?= $userInfo['name']; ?> <?= $userInfo['nom']; ?></p>
					<a href="editUser.php"  class='couleur'><i class='fas fa-pen'></i></a>
					<a href="deconnexion.php"  class='couleur'>Se déconnecter</a>
				</div>
				<?php endif; ?>

		<h1 class="couleur"><i class="far fa-file-alt"></i>Article</h1>
		<?php
		foreach ($data as $key => $value) {
			echo "<h3 class='titre'>".$value['title']."</h3>";
			echo '<p class="titre">'.$value['content'].'</p>';
			echo '<p class="auteur">Rédiger par '.$value['name'].'</p>';
		}
		?>      
		
		<hr>

		<?php
		foreach ($add as $key => $value) {
			echo '<p><i class="fas fa-comment"></i> '.$value['content'].'</p>';
			echo '<p>Rédiger par '.$value['pseudo'].'</p><a href="delteComment.php?id_comment='
			.$value['id_comment'].'"><i class="fas supComment commentaire fa-trash"></i></a>';
			
		}
		?>
		<hr>
		<form action='users.php?id_user=<?= $id ?>' method="post">
			
				<h3><i class="fas fa-comment"></i> Nouveau  commentaire</h3>
				<div>
					<label for="radio"><strong>Pseudo :</strong></label><br>
					<input type="test" name="name" id="radio" value="<?php if(isset($contenu)) echo $contenu; ?>"> 
					<?php if(!empty($errores['name'])):?>
										<div class='erreur'>
											<?= $errores['name']; ?>
										</div>
						<?php endif; ?>
				</div>
				<div>
					<label for="comment"><strong>Commentaire :</strong></label><br>
					<textarea id="comment" name="commentaire" rows="15" cols="70"><?php if(isset($pseudo)) echo $pseudo; ?></textarea>
					<?php if(!empty($errores['commentaire'])):?>
										<div class='erreur'>
											<?= $errores['commentaire']; ?>
										</div>
						<?php endif; ?>
				</div>
				<?php if(isset($succes) && count($errores)==0) : ?>
					 <p class='succes'>
							<?= $succes; ?>
					</p>
				<?php endif; ?>
				

				<button type='submit'>Ajouter</button>
		
		</form>
	</main>
</body>
</html>