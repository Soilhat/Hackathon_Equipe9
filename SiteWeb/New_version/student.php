<?php
include('../db/config.php');
include('header.php')
?>
    <br><br>

        <div class="container">
            <h1 class="card-title">Voici la liste des utilisateurs:</h1>
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