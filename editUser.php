<?php
require('database.php');
session_start();


if(isset($_SESSION['id_user'])) {
  
    $updates=updateProfilUser($_SESSION['id_user']);
    $update = $updates[0];
}


if(isset($_POST['newLastName']) && !empty($_POST['newLastName']) && $_POST['newLastName'] != $update['name'] 
    && isset($_POST['newFirstName']) && !empty($_POST['newFirstName']) && $_POST['newFirstName'] != $update['nom']
    && isset($_POST['newMail']) && !empty($_POST['newMail']) && $_POST['newMail'] != $update['e_mail']
    && isset($_POST['newMdp1']) && !empty($_POST['newMdp1']) && $_POST['newMdp1'] != $update['mot_passe']){

        $newLastName=htmlspecialchars($_POST['newLastName']);
        $newFirstName=htmlspecialchars($_POST['newFirstName']);
        $newMail=htmlspecialchars($_POST['newMail']);
        $newPassword=htmlspecialchars($_POST['newMdp1']);

        $pdo=createConnection();
        $req=$pdo->prepare('UPDATE `users` SET `name`=?,`nom`=?, `e_mail`=?,`mot_passe`=? WHERE id_user=?');
        $req->execute(array($newLastName,$newFirstName,$newMail,$newPassword,$_SESSION['id_user']));
        header('Location:index.php?id='.$_SESSION['id_user']);
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
		<a href="blog.php" class="entete">ENCORE UN BLOG ?!</a>
		
	</header>
	<main>
   
        <form method="POST" action='editUser.php'>
                <h3>Editer mon profil !!</h3>
                <div>
                    <label for="newLastName">Nom :</label>
                    <input type='text' name='newLastName' id='newLastName' value="<?php echo $update['name']; ?>" placeholder="Votre Nouveau Nom">
                  
                </div>
                <div>
                    <label for="newName">Prénom :</label>
                    <input type='text' name='newFirstName' id='newName' value="<?php echo $update['nom']; ?>" placeholder="Votre Nouveau Prénom">
                   
                </div>
                <div>
                    <label for="newMail">E-mail :</label>
                    <input type='mail' name='newMail' id='newMail' value="<?php echo $update['e_mail']; ?>" placeholder="Votre Nouveau Mail">
                   
                </div>
                <div>
                    <label for="newPassword">Choisissez un mot de passe :</label>
                    <input type='password' name='newMdp1' id='newPassword' placeholder="Votre Nouveau mot de passe">
                    
                 </div>  
                  


               
            <button type="submit">Mettre à jour mon profil </button>
            <button type="reset"><a href="index.php?id="<?php $_SESSION['id_user']; ?>>Annuler</a> </button>
        </form>
   <?php
  
   ?>
       
    </main>
</body>
</html>