<?php
include('db/config.php');
$req = mysqli_query($con,'select id from student');
$dnn = mysqli_fetch_array($req);
?>
    <style>
        body {font-family: "Lato", sans-serif}
        a:link {
            text-decoration:none;
        }
    </style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<img src="images/logo_picto.png" width="30" height="30" class="d-inline-block align-top" alt="">
  <a class="navbar-brand" href="home.php">URSUSCHOOL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="student.php">Liste Users </a>
      </li>
      <?php
        //Si lutilisateur est connecte, on lui donne un lien pour modifier ses informations, pour voir ses messages et un pour se deconnecter
        if(isset($_SESSION['email']))
        {
            ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php if(isset($_SESSION['email'])){echo ' '.htmlentities($_SESSION['email'], ENT_QUOTES, 'UTF-8');} ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a href="profile.php?id=<?php echo $dnn['id']; ?>" class="dropdown-item" href="edit_infos.php">Mon profil</a>
          <a class="dropdown-item" href="edit_infos.php">Modifier mon profil</a>
          <a class="dropdown-item" href="dashboard">Tableau de bord</a>
          <a class="dropdown-item" href="questions.php">Mon questionnaire</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="login.php">Déconnexion</a>
        </div>
      </li>
      <?php
        }
        else
        {
        //Sinon, on lui donne un lien pour sinscrire et un autre pour se connecter
            ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Connexion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sign_up.php">Inscription</a>
      </li>
      <?php
      }
      ?>
    </ul>
  </div>
</nav>