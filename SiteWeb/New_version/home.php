<?php
include('../db/config.php');

    include('header.php');

    $query = "SELECT * FROM `questionnaire` ORDER BY `idQ` DESC LIMIT 1";
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
            $output = shell_exec($command);
            echo utf8_encode($output);
        }
    
        /* Libère le jeu de résultats */
        mysqli_free_result($result);
    }
    else
    {
        echo mysqli_error($con);
    }
    ?>
   

    </body>
    
</html>