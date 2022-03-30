<?php

session_start();
//memulai session
$username = $_SESSION['username'];
//mengambil username yang terdapat pada session
if ($username == "") {//apabila username tidak terisi/kosong, maka user dikembalikan ke login.php
    header("location:login.php");
}

?>