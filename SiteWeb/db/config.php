<?php

//On demarre les sessions
session_start();

//On se connecte a la base de donnee
$con=mysqli_connect("localhost","root","","student");

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_select_db($con,"student");

?>