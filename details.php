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
        <div class="card mx-auto" style="width: 50rem; border : none">
            <h1 class="text-center">Detail POST</h1>
            <form action="inputcomment.php" method="get">
            <?php
                $id = $_GET['id'];
                $sqlPost = "select * from tweets where id='$id'";
                $queryPost = mysqli_query($conn,$sqlPost);
                $bykData = mysqli_num_rows($queryPost);

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
                            <td><input type="hidden" name="id" id="id" value="<?= $idPost ?>" ></td>
                        </tr>
                        <tr>
                            <td>
                                <p>
                                    <?php print $isiTweet ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p style="font-size: 18px; font-weight:bold">Comments:</p>
                                <?php
                                    $sqlComment = "select * from comment where idPost ='$id'";
                                    $queryComment = mysqli_query($conn, $sqlComment);
                                    $bykData = mysqli_num_rows($queryComment);
                                    $userLogin = $_SESSION['username'];

                                    for ($i=1; $i <= $bykData ; $i++) {
                                        //looping untuk mencari semua komentar yang ada pada post bersangkutan
                                        $comments = mysqli_fetch_array($queryComment);
                                        $idComment = $comments['id'];
                                        $username = $comments['username'];
                                        $comment = $comments['comment'];
                                ?>
                                <p>
                                    <span style="font-weight: bold;">
                                        <?= $username ?> :
                                    </span>
                                    <input type="hidden" name="idComment" id="idComment" value="<?= $idComment ?>">
                                    <?= $comment ?>

                                    <?php
                                        if ($userLogin == $username) {?>
                                            //
                                        <a href="#" value="Delete" onclick="f_delete(<?= $idComment ?>)" style="text-decoration: none; color:red;">Delete</a>
                                        or
                                        <a href="#" value="Delete" onclick="f_edit(<?= $idComment ?>)" style="text-decoration: none; color:blue;">Edit</a>
                                    <?php
                                        }
                                    ?>
                                    
                                </p>
                                <?php
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="comment" id="comment" placeholder="Comment...">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="f_cancel()">Back</button>
				                <button type="submit" value="saveComment" name="cmd" id="cmd">Add Comment</button>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            </form>
        </div> 
<script>
    function f_cancel(){
        //kembali ke index setelah melihat detil post
		location.href = "index.php";
    }
    function f_delete(idComment){
        //mengirimkan data untuk proses menghapus comment
        location.href = "inputcomment.php?id="+idComment+ "&cmd=deleteComment";
    }
    function f_edit(idComment){
        //mengirimkan data untuk proses mengedit comment
		location.href = "editcomment.php?id="+idComment;
    }
</script>
</body>
</html>