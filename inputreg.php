<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sqlRegister = "insert into users(username, password) values('$username', '$password')";
//memasukkan data username dan password baru
$queryRegister = mysqli_query($conn, $sqlRegister) or die($sqlRegister);

header("location:login.php");
?>