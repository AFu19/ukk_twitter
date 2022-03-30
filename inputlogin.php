<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sqlLogin = "select * from users where username = '$username' and password ='$password'"; //mencari data username dan password yang diinput user
$queryLogin = mysqli_query($conn, $sqlLogin) or die($sqlLogin);
$cek = mysqli_num_rows($queryLogin); //mengecek jika data username dan password yang diinput memang ada

if ($cek == 1) {
    //memulai session dan mengirimkan username
    $_SESSION['username'] = $username;

    header("location:index.php");
    //mengirim user ke index
}else{
    ?>
    <script>
        alert("kamu tidak memiliki akses login");
        location.href = "login.php";
        //apabila user tidak memasukkan akun yang benar maka akan muncul alert dan dikembalikan ke halaman login.php
    </script>
<?php
}
?>