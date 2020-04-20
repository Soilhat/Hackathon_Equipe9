<?php
include('db/config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Modifier ses informations personnelles</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/view.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            body{
                background-image: url("css/zed.jpg");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: center;
                background-size: 100%;
            }
        </style>
    </head>

    <body>
    <?php
    include('Navbar.php')
    ?>

    <br><br><br>

<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['email']))
{
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['firstname'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['rank'], $_POST['pseudolol'], $_POST['period']))
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
			$_POST['firstname'] = stripslashes($_POST['firstname']);
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['avatar'] = stripslashes($_POST['avatar']);
            $_POST['rank'] = stripslashes($_POST['rank']);
            $_POST['pseudolol'] = stripslashes($_POST['pseudolol']);
            $_POST['period'] = stripslashes($_POST['period']);
		}
		//On verifie si le mot de passe et celui de la verification sont identiques
		if($_POST['password']==$_POST['passverif'])
		{
			//On verifie si le mot de passe a 6 caracteres ou plus
			if(strlen($_POST['password'])>=6)
			{
				//On verifie si lemail est valide
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					//On echape les variables pour pouvoir les mettre dans une requette SQL
					$firstname = mysqli_real_escape_string($con,$_POST['firstname']);
					$password = mysqli_real_escape_string($con,$_POST['password']);
					$email = mysqli_real_escape_string($con,$_POST['email']);
					$avatar = mysqli_real_escape_string($con,$_POST['avatar']);
                    $rank = mysqli_real_escape_string($con,$_POST['rank']);
                    $pseudolol = mysqli_real_escape_string($con,$_POST['pseudolol']);
                    $period = mysqli_real_escape_string($con,$_POST['period']);
					//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
					$dn = mysqli_fetch_array(mysqli_query($con,'select count(*) as nb from student where firstname="'.$firstname.'"'));
					//On verifie si le pseudo a ete modifie pour un autre et que celui-ci n'est pas deja utilise
					if($dn['nb']==0 or $_POST['firstname']==$_SESSION['firstname'])
					{
						//On modifie les informations de lutilisateur avec les nouvelles
						if(mysqli_query($con,   'update student set firstname="'.$firstname.'", password="'.$password.'", email="'.$email.'", avatar="'.$avatar.'" where id="'.mysqli_real_escape_string($con,$_SESSION['userid']).'"'))
						{
							//Si ca a fonctionne, on naffiche pas le formulaire
							$form = false;
							//On supprime les sessions firstname et userid au cas ou il aurait modifie son pseudo
							unset($_SESSION['firstname'], $_SESSION['userid']);
                            ?>
                            <div class="row" align="center">
                                <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:400px">
                                    <div class="card" >
                                        <div class="card-content" align="center">
                                            <div class="message">Vos informations ont bien été modifiée. Vous devez vous reconnecter.<br>
                                                <button onclick="location.href='connexion.php'" class="btn waves-effect waves-light">Se connecter
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
						}
						else
						{
							//Sinon on dit quil y a eu une erreur
							$form = true;
							$message = 'Une erreur est survenue lors des modifications.';
						}
					}
					else
					{
						//Sinon, on dit que le pseudo voulu est deja pris
						$form = true;
						$message = 'Un autre utilisateur utilise d&eacute;j&agrave; le nom d\'utilisateur que vous d&eacute;sirez utiliser.';
					}
				}
				else
				{
					//Sinon, on dit que lemail nest pas valide
					$form = true;
					$message = 'L\'email que vous avez entr&eacute; n\'est pas valide.';
				}
			}
			else
			{
				//Sinon, on dit que le mot de passe nest pas assez long
				$form = true;
				$message = 'Le mot de passe que vous avez entr&eacute; contien moins de 6 caract&egrave;res.';
			}
		}
		else
		{
			//Sinon, on dit que les mots de passes ne sont pas identiques
			$form = true;
			$message = 'Les mot de passe que vous avez entr&eacute; ne sont pas identiques.';
		}
	}
	else
	{
		$form = true;
	}
	if($form)
	{
		//On affiche un message sil y a lieu
		if(isset($message))
		{
			echo '<strong>'.$message.'</strong>';
		}
		//Si le formulaire a deja ete envoye on recupere les donnes que lutilisateur avait deja insere
		if(isset($_POST['firstname'],$_POST['password'],$_POST['email']))
		{
			$firstname = htmlentities($_POST['firstname'], ENT_QUOTES, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$avatar = htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			//Sinon, on affiche les donnes a partir de la base de donnee
			$dnn = mysqli_fetch_array(mysqli_query($con,'select firstname,name,password,email from student where email="'.$_SESSION['email'].'"'));
			$firstname = htmlentities($dnn['firstname'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($dnn['name'], ENT_QUOTES, 'UTF-8');
			$password = htmlentities($dnn['password'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
		}
		//On affiche le formulaire
    ?>

    <div class="row" >
        <div class="col s12 m7">
            <div class="card" style="max-width:400px">
                <div class="card-content">
                    <form action="edit_infos.php" method="post">
                        Vous pouvez modifier vos informations:<br>
                        <div class="center">
                            <label for="firstname">Nom d'utilisateur</label><input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" />
							<label for="name">Nom d'utilisateur</label><input type="text" name="name" id="name" value="<?php echo $name; ?>" />
                            <label for="password">Mot de passe<span class="small">(6 caractères min.)</span></label><input type="password" name="password" id="password" value="<?php echo $password; ?>" /><br>
                            <label for="passverif">Mot de passe<span class="small">(vérification)</span></label><input type="password" name="passverif" id="passverif" value="<?php echo $password; ?>" /><br>
                            <label for="email">Email</label><input type="text" name="email" id="email" value="<?php echo $email; ?>" /><br />
                            <button class="btn waves-effect waves-light" type="submit" value="Envoyer">Submit<i class="material-icons right">send</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        }
    }
    else
    {
    ?>
    <div class="row" align="center">
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:400px">
            <div class="card" >
                <div class="card-content" align="center">
                    <div class="message">Pour accéder à cette page, vous devez être connecté<br>
                        <button onclick="location.href='connexion.php'" class="btn waves-effect waves-light">Se connecter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
?>

	</body>
</html>