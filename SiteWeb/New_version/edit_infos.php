<?php
include('../db/config.php');
include('header.php')
?>

<br><br>

<?php
//On verifie si lutilisateur est connecte
if(isset($_SESSION['email']))
{
	//On verifie si le formulaire a ete envoye
	if(isset($_POST['firstname'],$_POST['name'], $_POST['password'], $_POST['passverif']))
	{
		//On enleve lechappement si get_magic_quotes_gpc est active
		if(get_magic_quotes_gpc())
		{
			$_POST['firstname'] = stripslashes($_POST['firstname']);
			$_POST['name'] = stripslashes($_POST['name']);
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
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
					$name = mysqli_real_escape_string($con,$_POST['name']);
					$password = mysqli_real_escape_string($con,$_POST['password']);
					$email = mysqli_real_escape_string($con,$_POST['email']);
					//On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
					$dn = mysqli_fetch_array(mysqli_query($con,'select count(*) as nb from student where firstname="'.$firstname.'"'));
					//On verifie si le pseudo a ete modifie pour un autre et que celui-ci n'est pas deja utilise
					if($dn['nb']==0 or $_POST['email']==$_SESSION['email'])
					{
						//On modifie les informations de lutilisateur avec les nouvelles
						if(mysqli_query($con,   'update student set firstname="'.$firstname.'",name="'.$name.'", password="'.$password.'", email="'.$email.'" where id="'.mysqli_real_escape_string($con,$_SESSION['userid']).'"'))
						{
							//Si ca a fonctionne, on naffiche pas le formulaire
							$form = false;
							//On supprime les sessions firstname et userid au cas ou il aurait modifie son pseudo
							unset($_SESSION['firstname'], $_SESSION['userid']);
                            ?>
							<div class="card mx-auto" style="width:32%">
								<div class="card-body">
									<h5 class="card-title  mx-auto">Vos informations ont bien été modifiée. Vous devez vous reconnecter.</h5>
									<a href="login.php" class="btn btn-primary  mx-auto">Se connecter</a>
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
						$message = 'Un autre utilisateur utilise cette adressse mail.';
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
	<section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form text-center">
                    <h1 class="form-title">Modifier mon profil</h1>
					<br>
                    <form action="edit_infos.php" method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="firstname" id="name" placeholder="Prénom" value="<?php echo $firstname; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Nom" value="<?php echo $name; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Mot de Passe" value="<?php echo $password; ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="passverif" id="re_pass" placeholder="Confirmation Mot de passe" value="<?php echo $password; ?>" required/>
                        </div>
						<button type="submit" form="register-form" value="Modifier">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    }
    else
    {
    ?>
	<div class="card mx-auto text-center" style="width:32%">
		<div class="card-body">
			<h5 class="card-title  mx-auto">Pour accéder à cette page, vous devez être connecté</h5>
			<button href="login.php">Se connecter</button>
		</div>
	</div>
    <?php
    }
?>

	</body>
</html>