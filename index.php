<?php
	require('database.php');
	session_start();
	$result=listPosts();

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
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<a href="blog.php" class="entete">ENCORE UN BLOG ?!</a>
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
			<h1 class="couleur"><i class="fas fa-home"></i>Acceuil</h1>
			
			<?php
				foreach ($result as $key => $value) {
					echo "<h3 class='titre'><i class='far fa-hand-point-right'></i><a class='couleur' href='users.php?id_user=".$value['id_posts']."'>".$value['title']."</a></h3>";
					echo '<p class="titre">'.$value['content'].'</p>';
					echo '<p class="auteur">'.$value['userName'].'</p>';
				}

			?>
	</main>
</body>
</html>