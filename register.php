<?php
require('database.php');

if(!empty($_POST) && isset($_POST)){
    $name=htmlspecialchars($_POST['lastName']);
    $prenom=htmlspecialchars($_POST['firstName']);
    $mail=htmlspecialchars($_POST['mail']);
    $mail2=htmlspecialchars($_POST['mail2']);
    $password=sha1($_POST['mdp1']);
    $password2=sha1($_POST['mdp2']);

    $errors=array();
          
        if(empty($name)){
            $errors['lastName']='entrez votre nom !!';
        }
        if(empty($prenom)){
            $errors['firstName']='entrez votre Prénom !!';
        }
        if(empty($mail)){
            $errors['mail']='entrez votre mail !!';
        }
        if(empty($password)){
            $errors['mdp1']='entrez votre mot de passe !!';
        }

        if($mail==$mail2){
            if(filter_var($mail,FILTER_VALIDATE_EMAIL)){
                    $pdo=createConnection();
                    $req=$pdo->prepare('SELECT `e_mail` FROM `users` WHERE `e_mail`=?');
                    $req->execute(array($mail));
                
                    $mailExist=$req->rowCount();
                    
                        if($mailExist==0){
                            if($password==$password2){
                                
                                if(count($errors)==0){

                                    $succes='Votre compte à bien étais créer !!    <a href="connexion.php">Me connecter </a>';
                                    addUsers($name,$prenom,$mail,$password);
                                    unset($name);
                                    unset($prenom);
                                    unset($mail);
                                    unset($password);
                                }
                            
                            }
                            else{$errors['mdp2']='vos mots de passe ne correspendent pas !!';}
                        }
                        else{$errors['mail2']="Mail déja utiliser !!";}
                        
            }
             else{$errors['mail2']="Votre mail n'est pas valide !!";}
        }
        else{$errors['mail2']='Vos mails ne correspendent pas !!';}
        
	
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
        <div class="userConnect">
            <h2>Bienvenue sur mon Blog</h2>
            <p>Vous avez déja un compte ?</p>
            <a href="connexion.php">Connectez-vous?</a>
        </div>
        <form method="POST" action='register.php'>
        
                <h3>Identité et coordonnées</h3>
                <div>
                    <label for="lastName">Nom :</label>
                    <input type='text' name='lastName' id='lastName' value='<?php if(isset($name)) echo $name; ?>' placeholder="Votre Nom">
                    <?php if(!empty($errors['lastName'])):?>
										<div  class='erreur'>
											<?= $errors['lastName']; ?>
										</div>
						<?php endif; ?>
                </div>
                <div>
                    <label for="name">Prénom :</label>
                    <input type='text' name='firstName' id='name' value='<?php if(isset($prenom)) echo $prenom; ?>' placeholder="Votre Prénom">
                    <?php if(!empty($errors['firstName'])):?>
										<div  class='erreur'>
											<?= $errors['firstName']; ?>
										</div>
						<?php endif; ?>
                </div>
                <div>
                    <label for="mail">E-mail :</label>
                    <input type='text' name='mail' id='mail' value='<?php if(isset($mail)) echo $mail; ?>' placeholder="Votre Mail">
                    <?php if(!empty( $errors['mail'])):?>
										<div  class='erreur'>
											<?= $errors['mail']; ?>
										</div>
						<?php endif; ?>
                </div>
                <div>
                    <label for="mail2">Confirmez votre mail :</label>
                    <input type='text' name='mail2' id='mail2' placeholder="confirmez votre mail">
                    <?php if(!empty($errors['mail2'])):?>
										<div  class='erreur'>
											<?= $errors['mail2']; ?>
										</div>
						<?php endif; ?>
                </div>
                <div>
                    <label for="password">Choisissez un mot de passe :</label>
                    <input type='password' name='mdp1' id='password' placeholder="Votre mot de passe">
                    <?php if(!empty($errors['mdp1'])):?>
										<div  class='erreur'>
											<?= $errors['mdp1']; ?>
										</div>
						<?php endif; ?>
                 </div>  
                 <div>
                    <label for="mdp2">Confirmez votre mot de passe :</label>
                    <input type='password' name='mdp2' id='mdp2' placeholder="confirmez votre mot de passe">
                    <?php if(!empty($errors['mdp2'])):?>
										<div  class='erreur'>
											<?= $errors['mdp2']; ?>
										</div>
						<?php endif; ?>
                 </div>  


               
            <button type="submit">Je m'inscris</button>
            <button type="reset"><a href="blog.php">Annuler</a></button>
        </form>
        
        <?php if(isset($succes) && count($errors)==0) : ?>
					 <p class='succes'>
							<?= $succes; ?>
					</p>
				<?php endif; ?>
    </main>
</body>
</html>