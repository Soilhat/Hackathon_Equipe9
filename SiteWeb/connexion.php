<?php
include('db/config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>body{
            background-image: url("css/Shen.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: 100%;

        }
        *{
            color:black;
        }
    </style>
</head>
<body>
<?php
include('Navbar.php')
?>

<br><br><br><br><br>
<?php
//Si lutilisateur est connecte, on le deconecte
if(isset($_SESSION['email']))
{
    //On le deconecte en supprimant simplement les sessions email et userid
    unset($_SESSION['email'], $_SESSION['userid']);
    ?>
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:400px" id="band"><p>Vous avez bien été déconnecté</p><p>Vous allez être redirigé</p></div>
    <?php
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
    if($form)
    {
        //On affiche un message sil y a lieu
        if(isset($message))
        {
            echo '<div class="message">'.$message.'</div>';
        }
        //On affiche le formulaire
        ?>
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:400px" >
            <h2 class="w3-wide">Connexion</h2>
            <p class="w3-justify"><div class="content">
                <form action="connexion.php" method="post">
                    <!--Veuillez entrer vos identifiants pour vous connecter:<br />-->
                    <div class="center">
                        <label for="email">Email</label><input type="text" name="email" id="email" value="<?php echo htmlentities($oemail, ENT_QUOTES, 'UTF-8'); ?>" /><br />
                        <label for="password">Mot de passe</label><input type="password" name="password" id="password" /><br />
                        <button class="btn waves-effect waves-light" type="submit" value="Connexion">Connexion
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
?>
</body>
</html>