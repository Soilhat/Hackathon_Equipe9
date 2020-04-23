<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"-->
</head>
<body>
<?php
include('../db/config.php');
$req = mysqli_query($con,'select id from student');
$dnn = mysqli_fetch_array($req);
?>
<style>
    body {
        background-color : #30363D;
        color : #CBCFD4;
    }
    .container {
        background-color : #3C444C;
        border-radius : 20px;
    }
    .table {color : #CBCFD4;}
    a {
        color: #CBCFD4;
    }
    .dropdown-menu{
        background-color : #3C444C;
        color : #CBCFD4;
    }
    .dropdown-item{
        color : #CBCFD4;
    }
    input {
        background-color : #30363D;
        border-radius : 20px;
        border-style: none;
        color : #CBCFD4;
    }
    .card {
        background-color : #3C444C;
        border-radius : 20px;
    }
    button {
        border-radius : 20px;
        border-style:  none;
        background-image: linear-gradient(to right, #F27A54 0%, #A154F2 80%);
        margin-bottom: 10px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="col-sm-6 col-md-4">
        <img src="img/logo_ligne.png" width="100%" style="object-fit:cover" alt=""/>
    </div>
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
          <a class="dropdown-item" href="edit_infos.php">Modifier mon profil</a>
          <a class="dropdown-item" href="dashboard.php">Tableau de bord</a>
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