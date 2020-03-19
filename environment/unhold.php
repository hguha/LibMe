<?php
    include_once "db.php";
    $user_id = $_GET["user"];
    $book_id = $_GET["book"];

    //remove from holds list
    $query = "DELETE FROM Held WHERE user_id=$user_id AND book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }

    //update the books table to show it's free
    $query = "UPDATE Books SET on_hold=0 WHERE book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
?>