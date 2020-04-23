<?php
include('../db/config.php');

    include('header.php');
    if(isset($_SESSION['email']))
        {
    //On recupere le nombre d'utilisateurs pour donner un identifiant a l'utilisateur actuel
    $dn2 = mysqli_num_rows(mysqli_query($con,'select id from student where email = "'.$_SESSION['email'].'"'));
    $id = $dn2;

    $query = "SELECT * FROM `questionnaire` WHERE `idStudent` = ".$id." ORDER BY `idQ` DESC LIMIT 1";
    if ($result = mysqli_query($con, $query)) {
    

        /* Récupère un tableau associatif */
        while ($row = mysqli_fetch_row($result)) {
            $data = array_splice($row, 2);
            $interet = $data[8];
            $data = array_splice($data, 0, 7);
            array_push($data, $interet);
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            $command = "cd .. & activate hackathon2020 & python ../ml_scripts/predict.py $data 2>&1";
            shell_exec("activate base");
            $output = utf8_encode(shell_exec($command));
            ?><div class="container text-center">
            <div class="">Domaine : <?php echo $output;?></div>
            <a href="../dashboard/index.html">Voir mon Dashboard</a>
            </div>
            <?php
        }
    
        /* Libère le jeu de résultats */
        mysqli_free_result($result);
    }
    else
    {
        echo mysqli_error($con);
    }
}
    ?>
   

    </body>
    
</html>