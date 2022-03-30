<?php
include "koneksi.php";
include "secure.php";

$cmd = $_GET['cmd'];
$id = $_GET['id'];
$username = $_SESSION['username'];

if ($cmd == "saveComment") {
    //melakukan post comment
    $comment = $_GET['comment']; //mengambil value dari variabel dengan name="comment"
    $commentText = explode("#",$comment); //memecah strings dengan hashtag ke bentuk array
    array_splice($commentText,1); //mengubah parameter array yang tersedia
    $commentDB = implode(" ",$commentText); //menyatukan kembali array menjadi string untuk dimasukkan kedalam database

    $commentHashtags = explode("#",$comment); //memecah strings dengan hashtag ke bentuk array
    array_splice($commentHashtags,0,1); //mengubah parameter array yang tersedia

    $sqlLastId = "SELECT id FROM tweets WHERE id=(SELECT max(id) FROM tweets);";//mengambil id terbesar di table tweets
    $queryLastId = mysqli_query($conn,$sqlLastId);//menjalankan sql last id
    $row = mysqli_fetch_array($queryLastId);//mengambil last id 
    array_splice($row,1);//memastikan parameter array yang terambil hanya 1 
    $idDB = implode(" ",$row);//mengubah array menjadi string
    $idDBNew = (int)"$idDB" + 1;//mengubah string idDB menjadi int kemudian menambahkan 1 untuk menjadi idPost

    foreach ($commentHashtags as $value) { //looping array untuk memasukkan setiap parameter kedalam database
        $sqlHashtag = "insert into tags(tagcomment,idPost) values('$value','$idDBNew')";
	    $queryHashtag = mysqli_query($conn, $sqlHashtag) or die($sqlHashtag);
    }

    $tagDB = implode(" ",$commentHashtags); //menyatukan array menjadi string untuk dimasukkan kedalam database

    $sql = "insert into comment(comment,commentText,tagComment,idPost,username) values('$comment','$commentDB','$tagDB','$id','$username')";
	$query = mysqli_query($conn, $sql) or die($sql);
}else if ($cmd == "deleteComment") {
    //melakukan delete komen
    $sql = "delete from comment where id='$id'";
    $query = mysqli_query($conn, $sql) or die($sql);
}else if ($cmd == "Update") {
    //melakukan edit komen
    $comment = $_GET['comment']; //mengambil value dari variabel dengan name="comment"
    $commentText = explode("#",$comment); //memecah strings dengan hashtag ke bentuk array
    array_splice($commentText,1); //mengubah parameter array yang tersedia
    $commentDB = implode(" ",$commentText); //menyatukan kembali array menjadi string untuk dimasukkan kedalam database

    $commentHashtags = explode("#",$comment); //memecah strings dengan hashtag ke bentuk array
    array_splice($commentHashtags,0,1); //mengubah parameter array yang tersedia

    $sqlLastId = "SELECT id FROM tweets WHERE id=(SELECT max(id) FROM tweets);"; //mengambil id terbesar di table tweets
    $queryLastId = mysqli_query($conn,$sqlLastId); //menjalankan sql last id
    $row = mysqli_fetch_array($queryLastId);//mengambil last id 
    array_splice($row,1);//memastikan parameter array yang terambil hanya 1 
    $idDB = implode(" ",$row);//mengubah array menjadi string
    $idDBNew = (int)"$idDB" + 1;//mengubah string idDB menjadi int kemudian menambahkan 1 untuk menjadi idPost

    foreach ($commentHashtags as $value) {
        $sqlHashtag = "insert into tags(tagComment, idPost) values('$value','$idDBNew')";
	    $queryHashtag = mysqli_query($conn, $sqlHashtag) or die($sqlHashtag);
    }

    $tagDB = implode(" ",$commentHashtags);

    $sql = "update comment set comment = '$comment', commentText = '$commentDB', tagComment = '$tagDB' where id = '$id'";
    echo $sql;
    $query = mysqli_query($conn, $sql) or die($sql);
}

header("location:index.php");

?>