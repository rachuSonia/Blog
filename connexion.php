<?php
require('database.php');
session_start();

if(!empty($_POST) && isset($_POST)){
        $password=sha1 ($_POST['password']);
        $mail=htmlspecialchars($_POST['mail']);
        
        if(!empty($password) && !empty($mail)){
            $pdo=createConnection();
            $req=$pdo->prepare('SELECT * FROM `users` WHERE `e_mail`=? AND `mot_passe`=?');
            $req->execute(array($mail,$password));

            $userExist=$req->rowCount();
            if($userExist==1){
                $userConnect=$req->fetch();
                $_SESSION['id_user']=$userConnect['id_user'];
                $_SESSION['mot_passe']=$userConnect['mot_passe'];
                $_SESSION['e_mail']=$userConnect['e_mail'];
               header('Location:index.php?id='.$_SESSION['id_user']);
            }
            else{$errors='Identifiant ou mot de passe incorrecte !!';}
        }
        else{ $errors='Tout les champs doivent etre complétés !!'; } 
}

?>
<!--if($data!=false){
    $_SESSION['mail']=$_POST['mail'];
    $_SESSION['password']=$_POST['password'];
    $hash=$data[0]['mot_passe'];
    $check = $password == $hash;
    if($check){
        $_SESSION['user']=$data;
      
    }-->
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
		<a href="blog.php" class="entete">ENCORE UN BLOG ?!</a>
		
	</header>
	<main>
        <div class="userConnect">
            <h2>Heureux de vous revoir</h2>
            <p>Vous n'avez pas de compte ?</p>
            <a href="register.php">Inscrivez-vous?</a>
        </div>
        <form method="POST">
        
                <h3>Inforamtions d'authentification</h3>
                <div>
                    <label for="mail">E-mail :</label>
                    <input type='email' name='mail' id='mail'>
                </div>
                <div>
                    <label for="password">Mot de passe :</label>
                    <input type='password' name='password' id='password'>
                </div>
                <?php if(isset($errors)) : ?>
                    <p class="erreur"><?= $errors; ?></p>
                <?php endif; ?>
               
            <button type="submit">Se connecter</button>
            <button type="reset"><a href="blog.php">Annuler</a></button>
            
        </form>
    </main>
</body>
</html>