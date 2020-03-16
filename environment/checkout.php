<?php
    include_once "db.php";
    $user_id = $_GET["user"];
    $book_id = $_GET["book"];
    $query = "INSERT INTO CheckedOut(book_id, user_id) VALUES($book_id, $user_id)";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    $query = "UPDATE Books SET checked_out=1 WHERE book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    header("Location: index.php");
?>