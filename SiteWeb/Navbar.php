<?php
include('db/config.php')
?>
<!-- Navbar -->

<?php
$req = mysqli_query($con,'select id from student');
$dnn = mysqli_fetch_array($req);
?>
<style>
        body {font-family: "Lato", sans-serif}
        a:link {
            text-decoration:none;
        }
    </style>
<div class="w3-top">
    <div class="w3-bar w3-black w3-card">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="home.php" class="w3-bar-item w3-button w3-padding-large">Home</a>
        <?php
        //Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour voir ses messages et un pour se deconnecter
        if(isset($_SESSION['email']))
        {
            ?>
            <a href="profile.php?id=<?php echo $dnn['id']; ?>" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><?php if(isset($_SESSION['email'])){echo ' '.htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8');} ?></a>
            <div class="w3-dropdown-hover w3-hide-small w3-right">
                <button class="w3-padding-large w3-button" ><i class="fa fa-caret-down"></i></button>
                    <div class="w3-dropdown-content w3-bar-block w3-card-4">
                        <a href="edit_infos.php" class="w3-bar-item w3-button">Modifier mes informations</a>
                        <a href="dashboard.php" class="w3-bar-item w3-button">Tableau de bord</a>
                        <a href="login.php" class="w3-bar-item w3-button">Déconnexion</a>
                    </div>
            </div>
            <?php
        }
        else
        {
        //Sinon, on lui donne un lien pour sinscrire et un autre pour se connecter
            ?>
            <a href="sign_up.php" class="w3-bar-item w3-button w3-padding-large">Inscription</a>
            <a href="login.php" class="w3-bar-item w3-button w3-padding-large ">Connexion</a>
            <?php
        }
        ?>

        <a href="student.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Liste Utilisateur</a>
        <a href="questions.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Questionnaire</a>
        <a href="formations.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Formation</a>

        <!--<div class="w3-dropdown-hover w3-hide-small">
            <button class="w3-padding-large w3-button" title="">Autres Fonctionnalitées <i class="fa fa-caret-down"></i></button>
                <div class="w3-dropdown-content w3-bar-block w3-card-4">
                    <a href="" class="w3-bar-item w3-button">Null</a>
                    <a href="" class="w3-bar-item w3-button">None</a>
                </div>
        </div>-->


    </div>
</div>

