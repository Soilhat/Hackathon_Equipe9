<?php
include('db/config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Profil d'un utilisateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>body{
            background-image: url("css/runetrra.PNG");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: 100%;
        }
        .content{
            /*font-weight: bold;*/
        background-color: white  ;
            width: 700px;
            min-height:30%;
            margin:auto;
        border-radius: 100px;
        opacity: 0.75}
        }
        .card{
        /*border-radius:10px
    }</style>
</head>
<body>

<?php
include('Navbar.php')
?>s
<br><br><br><br><br><br>

<div class="content" align="center">
    <?php
    //On verifie que lidentifiant de lutilisateur est defini
    if(isset($_GET['id']))
    {
        $id = intval($_GET['id']);
        //On verifie que lutilisateur existe
        $dn = mysqli_query($con,'select firstname, email, avatar, signup_date, rank, pseudolol, period from student where id="'.$id.'"');
        if(mysqli_num_rows($dn)>0)
        {
            $dnn = mysqli_fetch_array($dn);
            //On affiche les donnees de lutilisateur
            ?>
            Voici le profil de "<?php echo htmlentities($dnn['firstname']); ?>" :
            <table style="width:700px;">
                <tr>
                    <td><?php
                        if($dnn['avatar']!='')
                        {
                            echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Image Perso" style="max-width:200px;max-height:200px;" />';
                        }
                        else
                        {
                            echo 'Cet utilisateur n\'a pas d\'image perso.';
                        }
                        ?></td>
                    <td class="left"><h1><?php echo htmlentities($dnn['firstname'], ENT_QUOTES, 'UTF-8'); ?></h1>
                        Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br>
                        Cet utilisateur s'est inscrit le <?php echo date($dnn['signup_date']); ?><br>
                        Pseudo sur League of Legends :<?php echo htmlentities($dnn['pseudolol'], ENT_QUOTES, 'UTF-8'); ?><br>
                        Rang sur League of Legends : <?php echo htmlentities($dnn['rank'], ENT_QUOTES, 'UTF-8'); ?><br>
                        Tranche horaire de jeu : le <?php echo htmlentities($dnn['period'], ENT_QUOTES, 'UTF-8'); ?><br>
                        <a class="waves-effect waves-light btn" href="https://euw.op.gg/summoner/firstname=<?php echo $dnn['pseudolol']; ?>" target="_blank">Profil OPGG</a>
                    </td>
                </tr>
            </table>
            <?php
        }
        else
        {
            echo 'Cet utilisateur n\'existe pas.';
        }
    }
    else
    {
        echo 'L\'identifiant de l\'utilisateur n\'est pas d&eacute;fini.';
    }
    ?>
</div>
<div class="foot"></div>
</body>
</html>