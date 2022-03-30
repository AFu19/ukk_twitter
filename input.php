<?php
include "koneksi.php";
include "secure.php";

$tweet = $_GET['tweet'];
$cmd = $_GET['cmd'];
$id = $_GET['id'];
$username = $_SESSION['username'];

if ($cmd == "save") {
    //memasukkan data ke table tweets
    $tweetText = explode("#",$tweet); //memecah strings dengan hashtag ke bentuk array
    array_splice($tweetText,1); //mengubah parameter array yang tersedia
    $tweetDB = implode(" ",$tweetText); //menyatukan kembali array menjadi string untuk dimasukkan kedalam database

    $tweetHashtags = explode("#",$tweet);//memecah strings dengan hashtag ke bentuk array
    array_splice($tweetHashtags,0,1); //mengubah parameter array yang tersedia

    $sqlLastId = "SELECT id FROM tweets WHERE id=(SELECT max(id) FROM tweets);"; //mengambil id terbesar di table tweets
    $queryLastId = mysqli_query($conn,$sqlLastId); //menjalankan sql last id
    $row = mysqli_fetch_array($queryLastId); //mengambil last id 
    array_splice($row,1); //memastikan parameter array yang terambil hanya 1 
    $idDB = implode(" ",$row); //mengubah array menjadi string
    $idDBNew = (int)"$idDB" + 1; //mengubah string idDB menjadi int kemudian menambahkan 1 untuk menjadi idPost

    foreach ($tweetHashtags as $value) { //looping array untuk memasukkan setiap parameter kedalam database
        $sqlHashtag = "insert into tags(tagTweet,idPost) values('$value','$idDBNew')";
	    $queryHashtag = mysqli_query($conn, $sqlHashtag) or die($sqlHashtag);
    }

    $tagDB = implode(" ",$tweetHashtags); //menyatukan array menjadi string untuk dimasukkan kedalam database

    $sql = "insert into tweets(tweet,tweetText,tagTweet,username) values('$tweet','$tweetDB','$tagDB','$username')";
	$query = mysqli_query($conn, $sql) or die($sql);
}else if ($cmd == "delete") {
    //menghapus data dari table tweets
	$sql = "delete from tweets where id='$id'";
    $query = mysqli_query($conn, $sql) or die($sql);
}else if ($cmd == "Update") {
    //mengubah data yang sudah ada di table tweets
    $tweetText = explode("#",$tweet);
    array_splice($tweetText,1);
    $tweetDB = implode(" ",$tweetText);

    $tweetHashtags = explode("#",$tweet);
    array_splice($tweetHashtags,0,1);
    foreach ($tweetHashtags as $value) {
        $sqlHashtag = "insert into tags(tagTweet,idPost) values('$value','$id')";
	    $queryHashtag = mysqli_query($conn, $sqlHashtag) or die($sqlHashtag);
    }
    $tagDB = implode(" ",$tweetHashtags);

    $sql = "update tweets set tweet = '$tweet', tweetText = '$tweetDB',tagTweet = '$tagDB' where id = '$id'";
    $query = mysqli_query($conn, $sql) or die($sql);
}

header("location:index.php");

?>