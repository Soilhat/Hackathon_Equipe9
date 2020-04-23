<?php
include('../db/config.php');
include('header.php')
?>
    <br><br>
    <?php
    //Si lutilisateur est connecte, on le deconecte
    if(isset($_SESSION['email']))
    {
        //On le deconecte en supprimant simplement les sessions email et userid
        unset($_SESSION['email'], $_SESSION['userid']);
        ?>
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:400px" id="band"><p>Vous avez bien été déconnecté</p><p>Vous allez être redirigé</p></div>
        <?php
        echo '<script>window.location="home.php"</script>';
        header('Refresh:2; home.php');
        exit();

    }
    else
    {
        $oemail = '';
        //On verifie si le formulaire a ete envoye
        if(isset($_POST['email'], $_POST['password']))
        {
            //On echappe les variables pour pouvoir les mettre dans des requetes SQL
            if(get_magic_quotes_gpc())
            {
                $oemail = stripslashes($_POST['email']);
                $email = mysqli_real_escape_string($con,stripslashes($_POST['email']));
                $password = stripslashes($_POST['password']);
            }
            else
            {
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = $_POST['password'];
            }
            //On recupere le mot de passe de lutilisateur
            $req = mysqli_query($con,'select password,id from student where email="'.$email.'"');
            $dn = mysqli_fetch_array($req);
            //On le compare a celui quil a entre et on verifie si le membre existe
            if($dn['password']==$password and mysqli_num_rows($req)>0)
            {
                //Si le mot de passe es bon, on ne vas pas afficher le formulaire
                $form = false;
                //On enregistre son pseudo dans la session email et son identifiant dans la session userid
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['userid'] = $dn['id'];
                echo '<script>window.location="home.php"</script>';
                header('Location: home.php');
                exit();
                ?>
                <div class="message">Vous avez bien été connecté. Vous pouvez accéder à votre espace membre.<br />
                    <a href="<?php echo $url_home; ?>">Accueil</a></div>
                <?php
            }
            else
            {
                //Sinon, on indique que la combinaison nest pas bonne
                $form = true;
                $message = 'La combinaison que vous avez entrée n\'est pas bonne.';
            }
        }
        else
        {
            $form = true;
        }
            ?>
            <!-- Sing in  Form -->
            <section class="sign-in text-center">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <a href="sign_up.php" class="signup-image-link">Créer un compte</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Se Connecter</h2>
                            <?php if($form)
                                {
                                    //On affiche un message sil y a lieu
                                    if(isset($message))
                                    {
                                        echo '<div class="message">'.$message.'</div>';
                                    }
                                    //On affiche le formulaire
                            ?>
                            <form method="POST" action="login.php" class="register-form" id="login-form">
                                <div class="form-group">
                                    <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="email" name="email" id="email" placeholder="Email"/>
                                </div>
                                <div class="form-group">
                                    <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="password" placeholder="Password"/>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                    <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                                </div>
                                
                            </form>
                                <button type="submit" form="login-form" value="Log in">Log In</button>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }
    }
    ?>
    </body>
</html>