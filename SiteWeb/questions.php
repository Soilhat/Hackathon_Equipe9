<?php
include('db/config.php')
?>
<?php
include('Navbar.php')
?>
<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Test</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
        <br><br><br>
    <body>
    <?php
    //On verifie que le formulaire a ete envoye
    if(isset($_POST['niveau'],$_POST['options'], $_POST['matiereP'], $_POST['matiereD'], $_POST['pref1']))
    {
        //On enleve lechappement si get_magic_quotes_gpc est active
        if(get_magic_quotes_gpc())
        {
            $_POST['niveau'] = stripslashes($_POST['niveau']);
            $_POST['options'] = stripslashes($_POST['options']);
            $_POST['matiereP'] = stripslashes($_POST['matiereP']);
            $_POST['matiereD'] = stripslashes($_POST['matiereD']);
            $_POST['pref1'] = stripslashes($_POST['pref1']);
            $_POST['pref2'] = stripslashes($_POST['pref2']);
            $_POST['voyage'] = stripslashes($_POST['voyage']);
            $_POST['interet'] = stripslashes($_POST['interet']);

        }
            $niveau = mysqli_real_escape_string($con,$_POST['niveau']);
            $options = mysqli_real_escape_string($con,$_POST['options']);
            $matiereP = mysqli_real_escape_string($con,$_POST['matiereP']);
            $matiereD = mysqli_real_escape_string($con,$_POST['matiereD']);
            $pref1 = mysqli_real_escape_string($con,$_POST['pref1']);
            $pref2 = mysqli_real_escape_string($con,$_POST['pref2']);
            $voyage = mysqli_real_escape_string($con,$_POST['voyage']);
            $interet = mysqli_real_escape_string($con,$_POST['interet']);
            //On recupere le nombre d'utilisateurs pour donner un identifiant a l'utilisateur actuel
            $dn2 = mysqli_num_rows(mysqli_query($con,'select id from student where email = "'.$_SESSION['email'].'"'));
            $id = $dn2;
            echo $niveau,$options,$id,$_SESSION['email'];
            //On enregistre les informations dans la base de donnee
            $query = 'insert into questionnaire(idStudent, niveau, options, matiereP, matiereD, pref1, pref2, voyage, interet, objectifs,travailler)
            values ('.$id.',"'.$niveau.'", "'.$options.'", "'.$matiereP.'", "'.$matiereD.'", "'.$pref1.'", "'.$pref2.'", "'.$voyage.'", "'.$interet.'","","")';
            if(mysqli_query($con,$query))
            {
                //Si ca a fonctionne, on naffiche pas le formulaire
                $form = false;
                header('Location: home.php');
                exit();
            }
            else
            {
                //Sinon on dit quil y a eu une erreur
                $form = true;
                $message = mysqli_error($con);//'Une erreur est survenue lors de l\'inscription.';
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
        {?><div class="row" >
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
    }
        ?>






    <br><br>
    <div class="card mx-auto" style="width:35%">
<form action="questions.php" method="post">
  <h5 class="card-header">Questionnaire</h5>
  <div class="card-body">


    <h5 class="card-title">Niveau d'études</h5>
    <!--<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>-->
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="Seconde">Seconde</option>
                <option value="Première">Première</option>
                <option value="Terminale">Terminale</option>
            </select>


            <h5 class="card-title">Options</h5>
            <select value=" ptions"class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="Arts">Arts</option>
                <option value="Biologie et écologie">Biologie et écologie</option>
                <option value="Histoire-géographie, géopolitique et sciences politiques">Histoire-géographie, géopolitique et sciences politiques</option>
                <option value="Humanités, littérature et philosophie">Humanités, littérature et philosophie</option>
                <option value="Langues">Langues</option>
                <option value="Littérature, Langues et cultures de l'Antiquité">Littérature, Langues et cultures de l'Antiquité</option>
                <option value="Mathématiques">Mathématiques</option>
                <option value="Numérique et sciences informatiques">Numérique et sciences informatiques</option>
                <option value="Physique-chimie">Physique-chimie</option>
                <option value="Sciences de la vie et de la Terre">Sciences de la vie et de la Terre</option>
                <option value="Sciences de l'ingénieur">Sciences de l'ingénieur</option>
                <option value="Sciences économiques et sociales">Sciences économiques et sociales</option>
            </select>


            <h5 class="card-title">Quelles matières du tronc commun te plait le plus :</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="FR">Français</option>
                <option value="HG">Histoire-géographie</option>
                <option value="EMC">Enseignement moral et civique</option>
                <option value="LV">Langue vivante A et langue vivante B</option>
                <option value="EPS">Education physique et sportive</option>
                <option value="ES">Enseignement scientifique</option>
                <option value="PHI">Philosophie</option>
            </select>


            <h5 class="card-title">Quelles matières du tronc commun te plait le moins :</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="FR">Français</option>
                <option value="HG">Histoire-géographie</option>
                <option value="EMC">Enseignement moral et civique</option>
                <option value="LV">Langue vivante A et langue vivante B</option>
                <option value="EPS">Education physique et sportive</option>
                <option value="ES">Enseignement scientifique</option>
                <option value="PHI">Philosophie</option>
            </select>

            <h5 class="card-title">Vous préférez :</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="Dessiner ou peindre">Dessiner ou peindre</option>
                <option value="Jouer aux échecs ou à un jeu de réflexion">Jouer aux échecs ou à un jeu de réflexion</option>
                <option value="Monter un meuble en kit">Monter un meuble en kit</option>
            </select>


            <h5 class="card-title">Vous préférez :</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="Vous inscrire à un club ou une association">Vous inscrire à un club ou une association</option>
                <option value="Gérer votre budget">Gérer votre budget</option>
                <option value="Réparer un objet">Réparer un objet</option>
            </select>

            <h5 class="card-title">Aimes tu voyager ?</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="oui">Oui</option>
                <option value="non">Non</option>
            </select>

            <h5 class="card-title">Quesl sont tes centres d'intérêts ?</h5>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" style="width:50%">
                <option selected>Choose...</option>
                <option value="Musique">Musique</option>
                <option value="Sport">Sport</option>
                <option value="Lecture">Lecture</option>
                <option value="Jeux Video">Jeux Video</option>
                <option value="Bénévolat">Bénévolat</option>
                <option value="Théâtre">Théâtre</option>
                <option value="Photographie">Photographie</option>
                <option value="Cuisine">Cuisine</option>
            </select>

            <h5 class="card-title">Quesl sont tes objectifs ?</h5>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="7" style="width:50%"value="objectfis"></textarea>
        

    <button type="submit" class="btn btn-primary float-right">Submit</button>
  </div>
  </form>
</div>
    </body>

</html>