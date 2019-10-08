<?php
	require('database.php');
	$articles=articleUsers($_GET['id']);
	$article = $articles[0];
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
	<meta charset="utf-8">
	<title>editer votre article</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<a href="index.php" class="entete">ENCORE UN BLOG ?!</a>
		<a href="admin.php" class="Administration"><i class="fas fa-cogs"></i>Administration</a>
	</header>
	<main>
		<h2 class="couleur">Editer un article</h2>
		<form method="POST" action="editArticle.php">
			<input type="hidden" name="id_article" value="<?= $_GET['id'] ?>">
			
				<h3>Article</h3>
				<div>
					<label for="title">Titre :</label>
					<input type="text" name="title" id='title' value="<?= $article['title'] ?>">
				</div>
				<div>
					<label for='article'>Article :</label>
					<textarea id="article" name="article" rows="15" cols="70"><?= $article['content'] ?></textarea>
				</div>
				<div>
					<button type='submit' value='Mettre à jour'>Mettre à jour</button>
					<button type='reset' value='Annuler'><a href='admin.php'>Annuler</a></button>
				</div>
		
		</form>
	</main>

</body>
</html>