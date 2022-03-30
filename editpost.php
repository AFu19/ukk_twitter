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
            <h1 class="text-center">EDIT POST</h1>
            <form action="input.php" method="get">
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
                                <input type="text" size="50" name="tweet" id="tweet" value="<?= $isiTweet?>" maxlength="250">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button onclick="f_cancel()">Cancel</button>
				                <button type="submit" value="Update" name="cmd" id="cmd">Update</button>
                            </td>
                        </tr>
                    </table>
                </div>
            <?php } ?>
            </form>
        </div> 
<script>
    function f_cancel(){
        //membatalkan pengeditan post
		location.href = "index.php";
    }
</script>
</body>
</html>