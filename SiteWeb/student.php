<?php
include('db/config.php')
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<?php
include('Navbar.php')
?>
<br><br><br>


<div class="content">
    Voici la liste des utilisateurs:
    <table class="centered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
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
                    <td><?php echo $dnn['id']; ?></td>
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