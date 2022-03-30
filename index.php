<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
<?php
include "koneksi.php";
include "secure.php";
?>
    <a href="logout.php" class="button">Logout</a>

    
        <div class="card mx-auto" style="width: 50rem; border : none">
            <h1 class="text-center">POSTS</h1>
            <form action="input.php" method="get">
            <?php
                $sqlPost = "select * from tweets";
                $queryPost = mysqli_query($conn,$sqlPost);
                $bykData = mysqli_num_rows($queryPost);
                $userLogin = $_SESSION['username'];

                for ($i=1; $i <= $bykData ; $i++) { 
                $datas = mysqli_fetch_array($queryPost);
                $idPost = $datas['id'];
                $username = $datas['username'];
                $isiTweet = $datas['tweet'];
                $tagTweet = $datas['tagTweet'];
            ?>
                <div class="card mx-auto mb-2" style="width: 45rem; border:1; padding:8px;">
                    <table>
                        <tr>
                            <td style="font-weight : bold"><?= $username ?></td>
                            <td><input type="hidden" name="idPost" id="idPost" value="<?= $idPost ?>" ></td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <?= $isiTweet?>
                                </p>
                            </td>
                        </tr>
                        <?php 
                            if ($userLogin == $username) {
                        ?>
                        <tr>
                            <td>
                                <input type="button" value="Delete" onclick="f_delete(<?= $idPost ?>)">
				                <input type="button" value="Edit" onclick="f_edit(<?= $idPost ?>)">
                            </td>
                        </tr>
                        <?php        
                            }
                        ?>
                        <tr>
                            <td>
                                <input type="button" value="See Details" onclick="f_details(<?= $idPost ?>)">
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            </form>
            <button class="button mx-auto my-4" onclick="f_post()">Make A New Post</button>
        </div> 
<script>
    function f_post(){
        //mengirimkan data untuk melakukan post
        location.href = "post.php";
    }
    function f_delete(idPost){
        //mengirimkan data untuk melakukan delete
		location.href = "input.php?id="+idPost+ "&cmd=delete";
    }
    function f_edit(idPost){
        //mengirimkan data untuk mengedit dan mengirim user ke editpost.php
		location.href = "editpost.php?id="+idPost;
    }
    function f_details(idPost){
        //mengirimkan data serta mengirim user ke halaman detail.php
		location.href = "details.php?id="+idPost;
    }

</script>
</body>
</html>