<?php
include('db/config.php');
include('Navbar.php')
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


</head>

    <body>
    <br><br><br>


        <div class="content mx-auto" style="width:50%">
        <h5 class="card-title">Voici la liste des utilisateurs:</h5>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    //On recupere les identifiants, les pseudos et les emails des utilisateurs
                    $req = mysqli_query($con,'select id, firstname, name, email from student');
                    while($dnn = mysqli_fetch_array($req))
                    {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $dnn['id']; ?></th>  
                            <td><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['firstname'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                            <td><?php echo $dnn['name'];?></td>
                            <td><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>