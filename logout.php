<?php session_start();

session_destroy();
//menghancurkan/mengakhiri session logins
header("location:login.php");
 ?>