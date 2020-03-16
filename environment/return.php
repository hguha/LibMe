<?php
    include_once "db.php";
    $user_id = $_GET["user"];
    $book_id = $_GET["book"];
    $query = "DELETE FROM CheckedOut WHERE user_id=$user_id AND book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    $query = "UPDATE Books SET checked_out=0 WHERE book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    header("Location: ../index.php");
?>