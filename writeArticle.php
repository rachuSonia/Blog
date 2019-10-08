<?php
	require('database.php');
	if(!empty($_POST)){
		$title=$_POST['title'];
		$article=$_POST['article'];
		$iduser=$_POST['auteur'];
		$idcategoris=$_POST['articles'];

		$errors=array();
		if(empty($title)){
			$errors['title']='Entrez un titre !';
		}
		if(empty($article)){
			$errors['article']='Saisissez votre article !';
		}
		
		if(count($errors)==0){
			addArticle($title,$article,$iduser,$idcategoris);
			header('Location: admin.php');
			unset($title);
			unset($article);

		}
		
	}
	$user=addUsersName();
		$categories=addCategoriesName();
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset="utf-8">
	<title>rédiger un article</title>
		 <link href="https://fonts.googleapis.com/css?family=Nanum+Gothic" rel="stylesheet">
		 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<a href="index.php" class="entete">ENCORE UN BLOG ?!</a>
		<a href="admin.php" class="Administration"><i class="fas fa-cogs"></i>Administration</a>
	</header>
	<main>
		<h3 class='couleur'><i class='fas fa-pen'></i> Rédiger un nouvel article</h3>
		<form method="POST">
			
				<h3><i class="far fa-sticky-note"></i> Nouvel article</h3>
				<div>
					<label for="title">Titre :</label>
					<input type="text" name="title" id='title' value='<?php if(isset($title)) echo $title; ?>'>
					<?php if(!empty($errors['title'])):?>
										<div class='erreur'>
											<?= $errors['title']; ?>
										</div>
						<?php endif; ?>
				</div>
				<div>
					<label for='article'>Article :</label>
					<textarea id="article" name="article" rows="15" cols="70"><?php if(isset($article)) echo $article; ?></textarea>
					<?php if(!empty($errors['article'])):?>
										<div class='erreur'>
											<?= $errors['article']; ?>
										</div>
						<?php endif; ?>
				</div>
				<div>
					<label id="auteur">Auteur :</label>
					<select for="auteur" name="auteur">
					<?php
						foreach ($user as $key => $value) {
							echo '<option value="'.$value['id_user'].'">'.$value['name'].'</option>';
						}


					?>
					</select>
				</div>
				<div>
					<label for="catigories">Catégories :</label>
					<select name="articles">
						<?php
							foreach ($categories as $key => $value) {
								echo '<option value="'.$value['id_categories'].'">'.$value['name'].'</option>';
							}

						?>
					</select>
				</div>
				
				<div>
					<button type='submit' value='Publier'>Publier</button>
					<button type='reset' value='Annuler'><a href='admin.php'>Annuler</a></button>
				</div>
		
		</form>
	</main>
</body>
</html>