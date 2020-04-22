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
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            if(mysqli_query($con,'insert into questions(idQ, niveau, options, matiereP, matiereD, pref1, pref2, voyage, interet) 
            values ('.$id.',"'.$niveau.'", "'.$options.'", "'.$matiereP.'", "'.$matiereD.'", "'.$pref1.'", "'.$pref2.'", "'.$voyage.'", "'.$interet.'")'))
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
                $message = 'Une erreur est survenue lors de l\'inscription.';
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
    <div class="w3-container">
    <div class="w3-card w3-white w3-round w3-margin" style="width:40%"><br>
    <form action="questions.php" method="post">
        <h4 class="w3-center">Questionnaire</h4><br>
        <hr class="w3-clear">
        <div name="Q1">
            <p>Question 1 :</p>
            <label for="niveau">Niveau d'études</label>
            <select name="niveau" required>
                <option value=""></option>
                <option value="Seconde">Seconde</option>
                <option value="Première">Première</option>
                <option value="Terminale">Terminale</option>
            </select>
        </div>
        <hr class="w3-clear">
        <div name="Q2">
            <p>Question 2 :</p>
            <label for="options">Options</label>
            <select name="options" required>
                <option value=""></option>
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
        </div><br>
        <hr class="w3-clear">
        <div name="Q3">
            <p>Question 3 :</p>
            <label for="matiereP">Quelles matières du tronc commun te plait le plus :</label>
            <select name="matiereP" required>
            <option value=""></option>
                <option value="FR">Français</option>
                <option value="HG">Histoire-géographie</option>
                <option value="EMC">Enseignement moral et civique</option>
                <option value="LV">Langue vivante A et langue vivante B</option>
                <option value="EPS">Education physique et sportive</option>
                <option value="ES">Enseignement scientifique</option>
                <option value="PHI">Philosophie</option>
            </select>
        </div><br>
        <hr class="w3-clear">
        <div name="Q4">
            <p>Question 4 :</p>
            <label for="matiereD">Quelles matières du tronc commun te plait le moins :</label>
            <select name="matiereD" required>
                <option value=""></option>
                <option value="FR">Français</option>
                <option value="HG">Histoire-géographie</option>
                <option value="EMC">Enseignement moral et civique</option>
                <option value="LV">Langue vivante A et langue vivante B</option>
                <option value="EPS">Education physique et sportive</option>
                <option value="ES">Enseignement scientifique</option>
                <option value="PHI">Philosophie</option>
            </select>
        </div><br>
        <hr class="w3-clear">
        <div name="Q5">
            <p>Question 5 :</p>
            <label for="pref1">Vous préferez :</label>
            <select name="pref1" required>
                <option value=""></option>
                <option value="Dessiner ou peindre">Dessiner ou peindre</option>
                <option value="Jouer aux échecs ou à un jeu de réflexion">Jouer aux échecs ou à un jeu de réflexion</option>
                <option value="Monter un meuble en kit">Monter un meuble en kit</option>
            </select>
        </div><br>
        <hr class="w3-clear">
        <div name="Q6">
            <p>Question 6 :</p>
            <label for="pref2">Vous préferez :</label>
            <select name="pref2" required>
                <option value=""></option>
                <option value="Vous inscrire à un club ou une association">Vous inscrire à un club ou une association</option>
                <option value="Gérer votre budget">Gérer votre budget</option>
                <option value="Réparer un objet">Réparer un objet</option>
            </select>
        </div><br>
        <hr class="w3-clear">
        <div name="Q7">
            <p>Question 7 :</p>
            <label for="voyage">Voyage</label>
            <select name="voyage" required>
                <option value=""></option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>
        </div><br>
        <hr class="w3-clear">
        <div name="Q8">
            <p>Question 8 :</p>
            <label for="">Objetcifs</label>
            <textarea id="objectifs" name="objectifs" rows="5" cols="33">
            </textarea>
        </div><br>
        <hr class="w3-clear">
        <div name="Q1">
            <p>Question 9 :</p>
            <label for="interet">Centres d'intérêts</label>
            <select name="interet" required>
                <option value=""></option>
                <option value="Musique">Musique</option>
                <option value="Sport">Sport</option>
                <option value="Lecture">Lecture</option>
                <option value="Jeux Video">Jeux Video</option>
                <option value="Bénévolat">Bénévolat</option>
                <option value="Théâtre">Théâtre</option>
                <option value="Photographie">Photographie</option>
                <option value="Cuisine">Cuisine</option>
            </select>
        </div><br>
        <button class="btn waves-effect waves-light" type="submit" value="survey">Valider
        </button><br><br>
        </form>
      </div>
      </div>
    </body>

</html>