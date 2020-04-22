<?php
include('db/config.php')
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="css/view.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">

        <!-- Font Icon -->
        <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

        <!-- Main css -->
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <?php
    include('Navbar.php')
    ?>

    <br><br><br><br><br>
    <?php
    //On verifie que le formulaire a ete envoye
    if(isset($_POST['firstname'],$_POST['name'], $_POST['password'], $_POST['passverif'], $_POST['email'])and $_POST['firstname']!='')
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
                $dn = mysqli_num_rows(mysqli_query($con,'select id from student where email="'.$email.'"'));
                if($dn==0)
                {   
                    //On recupere le nombre d'utilisateurs pour donner un identifiant a l'utilisateur actuel
                    $dn2 = mysqli_num_rows(mysqli_query($con,'select id from student'));
                    $id = $dn2+1;
                    //On enregistre les informations dans la base de donnee
                    if(mysqli_query($con,'insert into student(id, firstname, name, password, email) values ('.$id.', "'.$firstname.'", "'.$name.'", "'.$password.'", "'.$email.'")'))
                    {
                        //Si ca a fonctionne, on naffiche pas le formulaire
                        $form = false;
                        header('Location: home.php');
                        exit();
                        ?>
                        <div class="message">Vous avez bien été inscrit. Vous pouvez dorénavant vous connecter.<br />
                            <a href="login.php">Se connecter</a></div>
                        <?php
                    }
                    else
                    {
                        //Sinon on dit quil y a eu une erreur
                        $form = true;
                        $message = 'Une erreur est survenue lors de l\'inscription.';
                    }
                }
                else
                {
                    //Sinon, on dit que le pseudo voulu est deja pris
                    $form = true;
                    $message = 'L\'adresse mail est déjà utilisé par un autre compte.';
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
            $message = 'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
        }
    }
    else
    {
        $form = true;
    }
        ?>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">S'inscrire</h2>
                    <?php if($form)
                        {
                            //On affiche un message sil y a lieu
                            if(isset($message))
                            {
                                ?><div class="row" >
                                <div class="col s12 m7">
                                    <div class="card" style="max-width:400px">
                                        <div class="card-content">
                                            <div class="message"><?php echo '<div class="message">'.$message.'</div>'; ?><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><?php
                            }
                            //On affiche le formulaire
                    ?>
                    <form action="sign_up.php" method="POST" class="register-form" id="register-form">
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="firstname" id="name" placeholder="Prénom" value="<?php if(isset($_POST['firstname'])){echo htmlentities($_POST['firstname'], ENT_QUOTES, 'UTF-8');} ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="name" id="name" placeholder="Nom" value="<?php if(isset($_POST['name'])){echo htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');} ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" required/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="pass" placeholder="Mot de Passe" required/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="passverif" id="re_pass" placeholder="Confirmation Mot de passe" required/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    <a href="login.php" class="signup-image-link">Je suis déjà membre</a>
                </div>
            </div>
        </div>
    </section>
        <?php
        }
        ?>
    </body>
</html>