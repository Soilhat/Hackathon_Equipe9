<?php
include('db/config.php')
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Test</title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <br><br><br>

    <style>
        body {font-family: "Lato", sans-serif}
        .mySlides {display: none
        }
        a:link {
            text-decoration:none;
        }
    </style>

    <body>

    <?php
    include('Navbar.php')
    ?>
    <?php

    $query = "SELECT * FROM `questionnaire` ORDER BY `idQ` DESC LIMIT 1";
    if ($result = mysqli_query($con, $query)) {

        /* Récupère un tableau associatif */
        while ($row = mysqli_fetch_row($result)) {
            $data = array_splice($row, 2);
            $interet = $data[8];
            $data = array_splice($data, 0, 7);
            array_push($data, $interet);
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            echo $data;
            $command = "C:\Users\soilh\Anaconda3\python.exe ../ml_scripts/predict.py $data 2>&1";
            shell_exec("activate base");
            $output = shell_exec($command);
            echo $output;
            var_dump($output);
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