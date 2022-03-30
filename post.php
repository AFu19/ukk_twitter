<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
    .card{
        margin-top: 10rem;
    }
</style>
</head>
<body>
<?php
include "koneksi.php";
include "secure.php";
?>
    <button class="button home" onclick="f_home()">Back to Home</button>
    <form action="input.php" method="get">
        <div class="card mx-auto" style="width: 25rem; border : none">
            <h1 class="text-center">MAKE A POST</h1>
            <textarea name="tweet" id="tweet" cols="50" rows="5" maxlength="250"></textarea>
            <br>
            <button type="submit" id="cmd" name="cmd" value="save">POST</button>
        </div>
    </form>
<script>
    function f_home(){
        //mengembalikan user ke halaman index.php
        location.href = "index.php";
    }
</script>
</body>
</html>