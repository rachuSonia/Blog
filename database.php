<?php
/*la fonction qui connect ma base de donnée la page d'acceuil */
function createConnection() {
	$db=new PDO ('mysql:host=localhost;dbname=blog;charset=utf8','root','');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $db;
}
function listPosts(){
	$pdo=createConnection();
	$req=$pdo->prepare('SELECT id_posts, title, content, publication_date, posts.id_user, posts.id_categories, categories.name AS categoryName, users.name AS userName 
		FROM `posts` JOIN `categories` ON `posts`.`id_categories`=`categories`.`id_categories` 
		JOIN `users` ON `users`.`id_user`=`posts`.`id_user`');  
	$req->execute();
	$result=$req->fetchAll(PDO::FETCH_ASSOC);
	return $result;
}



/*la fonction qui lit les articles et le formulaire des commantaires*/
function articleUsers($id){
	$pdo=createConnection();
	$req=$pdo->prepare('SELECT * 
		FROM `posts` JOIN `categories` ON `posts`.`id_categories`=`categories`.`id_categories` 
		JOIN `users` ON `users`.`id_user`=`posts`.`id_user` WHERE `posts`.`id_posts`= ?');
	$req->execute(array($id));
	$data=$req->fetchAll(PDO::FETCH_ASSOC);
	return $data;

}


/*fonction qui ajoute les commentaire a la base de donnée*/
function addComments($postId, $pseudo,$content){
	$pdo=createConnection();
	$req=$pdo->prepare('INSERT INTO `comment`(`pseudo`,`content`, `id_posts`, `email`, `publication_date`) 
						VALUES (:pseudo,:commentaire, :idposts, "", NOW())');

	$req->execute(array(
		':pseudo' => $pseudo,
		':commentaire' => $content,
		':idposts' => $postId));
}


/*fonction qui recupere les commentaire de la base d edonnée*/
function getComments($id){
 	$pdo=createConnection();
 	$req=$pdo->prepare('SELECT * FROM `comment` WHERE `id_posts`=?');

 	$req->execute (array($id));

 	$add=$req->fetchAll(PDO::FETCH_ASSOC);
 	return $add;
}


/*fonction qui insere un nouveau article rediger dans la base de donnée*/
function addArticle($title,$article,$userId,$categoriesId){

	$pdo=createConnection();
	$req=$pdo->prepare('INSERT INTO `posts` (`title`,`content`,`id_user`,`id_categories`,`publication_date`) 
		VALUES (:title,:content,:iduser,:idcategoris,NOW())');
	$req->execute(array(
		':title'=>$title,
		':content'=>$article,
		':iduser'=>$userId,
		':idcategoris'=>$categoriesId));
}


/*fonction qui recupere le userName a partir de la table users*/
function addUsersName(){
	 $pdo=createConnection();
	 $req=$pdo->prepare('SELECT `id_user`,`name` FROM `users`');
	 $req->execute();
	 $user=$req->fetchAll(PDO::FETCH_ASSOC);
	 return $user;

}


/*fonction qui recupere name de la categorie choisie a partir de la table categories*/
function addCategoriesName(){
	 $pdo=createConnection();
	 $req=$pdo->prepare('SELECT `id_categories`,`name` FROM `categories`');
	 $req->execute();
	 $categories=$req->fetchAll(PDO::FETCH_ASSOC);
	 return $categories;
 
}


/*fonction qui edite un article*/
function editArticle($id, $title, $content){
	$pdo=createConnection();
	$req=$pdo->prepare('UPDATE `posts` SET `title`=?,`content`=? WHERE id_posts=?');
	$req->execute(array($title,$content,$id));
}

/*fonction qui supprime un article*/
function delteArticle($id){
	$pdo=createConnection();
	$req=$pdo->prepare('DELETE FROM `posts` WHERE `id_posts`=?');
	$req->execute(array($id));
}


/*fonction qui supprime un commentaire dans le fichier users.php*/
function deleteComment($id){
	$pdo=createConnection();
	$req=$pdo->prepare('DELETE FROM `comment` WHERE `id_comment`=?');
	$req->execute(array($id));
}

/* fonction qui insere dans la base de donnée users les nouveaux utilisateurs qui s'inscrivent*/
function addUsers($name,$nom,$e_mail,$mot_passe){
	$pdo=createConnection();
	$req=$pdo->prepare('INSERT INTO `users` (`name`,`nom`,`e_mail`,`mot_passe`)
						VALUE (:name,:nom,:e_mail,:mot_passe)');
			$req->execute(array(
				':name' => $name,
				':nom' => $nom,
				':e_mail' => $e_mail,
				':mot_passe' => $mot_passe
			));
}

/* fonction qui recuper les données d'un utilisateur par rapport a son mail pour se connecter*/

function getUserByMail($email){
	$pdo=createConnection();
	$req=$pdo->prepare('SELECT `e_mail`,`mot_passe` FROM `users` WHERE `e_mail`=?');
	$req->execute(array($email));

	$add=$req->fetchAll(PDO::FETCH_ASSOC);
 	return $add;
}
// fonction qui rècupère les informations d'un utilisateur à partir de la base de donnée pour les éditers
function updateProfilUser($id){
	$pdo=createConnection();
	$req=$pdo->prepare('SELECT * FROM `users` WHERE `id_user`=?');
	$req->execute(array($id));
	$add=$req->fetchAll(PDO::FETCH_ASSOC);
	return $add;
}

// fonction qui èdite un profil d'un utlisateur
function editProfilUser($id, $firstName, $lastName,$mail,$password){
	$pdo=createConnection();
	$req=$pdo->prepare('UPDATE `users` SET `name`=?,`nom`=?, `e_mail`=?,`mot_passe`=? WHERE id_user=?');
	$req->execute(array($firstName, $lastName,$mail,$password,$id));
}
?>

