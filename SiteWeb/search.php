<?php
include('db/config.php')
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="css/view.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background-image: url("css/kayle.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: 100%;
        }
        html{
            height:100%;
        }
        body{
            background-color:black;
            height:100%;
            margin:0;
            padding:0;
        }
        .content{
            width:512px;
            min-height:100%;
            background-color:#fff;
            margin:auto;
            opacity:0.75;
        }
    </style>
</head>
<body>

<?php
include('Navbar.php')
?>
<div class="content">
<br><br>

<h1 align="center">Trouver des joueurs</h1>
<br/>
<form align="center" method="post"  name="searchform">

    <input type="text" name="pseudolol" placeholder="Pseudo LoL">

    <select name="rank">
        <option value="" disabled selected>Rank</option>
        <option value="iron" >Iron</option>
        <option value="bronze" >Bronze</option>
        <option value="silver" >Silver</option>
        <option value="gold" >Gold</option>
        <option value="platinum" >Platinum</option>
        <option value="diamond" >Diamond</option>
        <option value="master" >Master</option>
        <option value="grandmaster" >GrandMaster</option>
        <option value="challenger" >Challenger</option>
    </select>

    <select name="period">
        <option value="" disabled selected>Période</option>
        <option value="matin" >Matin</option>
        <option value="midi" >Midi</option>
        <option value="soir" >Soir</option>
        <option value="nuit" >Nuit</option>
    </select>

    <!--<button class="btn waves-effect waves-light" type="submit" name="submit" value="Rechercher">Rechercher</button>-->
    <input type="submit" name="submit" value="Rechercher">
</form>
<?php
//Verification que le champs n'est pas vide
if(isset($_POST['submit'])){
    //if(!empty($_POST['rank'])){
        if(isset($_POST['rank'])){
            $recherche=$_POST['rank'];}
        else{$recherche= NULL;}
        if(isset($_POST['pseudolol'])){
            $recherche2=$_POST['pseudolol'];}
        else{$recherche2= NULL;}
        if(isset($_POST['period'])){
            $recherche3=$_POST['period'];}
        else{$recherche3= NULL;}

        $sql="SELECT id, firstname, rank, pseudolol, period FROM student WHERE  pseudolol LIKE '%".$recherche2."%' AND rank LIKE '%" . $recherche . "%' AND period LIKE '%".$recherche3."%'  ";
    ?>
    <br>
    <div align="center">
    <table class="centered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nom d'utilisateur</th>
                <th>Rank</th>
                <th>Pseudo LoL</th>
                <th>Période</th>
            </tr>
        </thead>
        <tbody>
            <?php
             $result=mysqli_query($con,$sql) or die("Erreur MySQL : ".mysqli_error($con));
            //loop through results
            while($row=mysqli_fetch_array($result)){
                $id=$row['id'];
                $firstname=$row['firstname'];
                $rank=$row['rank'];
                $period=$row['period'];
                $pseudolol=$row['pseudolol'];

                ?>
                <tr>
                    <td ><?php echo $id; ?></td>
                    <td><a href="profile.php?id=<?php echo $id; ?>"><?php echo htmlentities($firstname, ENT_QUOTES, 'UTF-8'); ?></a></td>
                    <!--<td><?php //echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>-->
                    <td><?php echo $rank;?></td>
                    <td><?php echo $pseudolol;?></td>
                    <td><?php echo $period;?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    </div>
    </div>
        <?php }
?>