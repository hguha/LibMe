<?php
    include_once "db.php";
    $user_id = $_GET["user"];
    $book_id = $_GET["book"];
    $date = date('Y-m-d H:i:s');
    $query = "INSERT INTO Held(book_id, user_id, date) VALUES($book_id, $user_id, '$date')";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    
    $query = "UPDATE Books SET on_hold=1 WHERE book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }
    header("Location: ../index.php");
?>