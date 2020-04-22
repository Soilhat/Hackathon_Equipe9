<?php

//On demarre les sessions
if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

//On se connecte a la base de donnee
$con=mysqli_connect("localhost","root","","student");
$con->set_charset('utf8');

if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
mysqli_select_db($con,"student");

?>