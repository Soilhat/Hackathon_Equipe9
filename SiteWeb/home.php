<?php
include('db/config.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>

    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <style>
        body {font-family: "Lato", sans-serif}
        a:link {
            text-decoration:none;
        }
    </style>

    </head>
    <body>

    <?php
    include('Navbar.php');

    $query = "SELECT * FROM `questionnaire` ORDER BY `idQ` DESC LIMIT 1";
    if ($result = mysqli_query($con, $query)) {
    

        /* Récupère un tableau associatif */
        while ($row = mysqli_fetch_row($result)) {
            $data = array_splice($row, 2);
            $interet = $data[8];
            $data = array_splice($data, 0, 7);
            array_push($data, $interet);
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
            $command = "activate hackathon2020 & python ../ml_scripts/predict.py $data 2>&1";
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