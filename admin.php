<?php
	require('database.php');
	$result=listPosts();
	

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>administration</title>
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
		<h3><i class="fas fa-cogs"></i>Panneau d'administration</h3>
		<a class='couleur' href="writeArticle.php">Rédiger un nouvel article</a>
		<table>
			<tr>
				<th>Titre</th>
				<th>Articles</th>
				<th>Auteur</th>
				<th>Catégorie</th>
			</tr>
			<?php 

				foreach ($result as $key => $value) {
					echo "<tr>";
					echo "<td><a href='users.php?id_user=".$value['id_posts']."' class='couleur'>".$value['title']."</a></td>";
					echo "<td>".$value['content']."</td>";
					echo "<td>".$value['userName']."</td>";
					echo "<td>".$value['categoryName']."<a class='couleur' href='editer.php?id=" . $value['id_posts'] . "'><i class='fas fa-pen'></i></a><a class='couleur' href='delete.php?id=".$value['id_posts']."'><i class='fas fa-times'></i></a></td>";
					echo "</tr>";
				}
			?>
			
			</table>	
	</main>
		
</body>
</html>