<?php
    include_once "db.php";
    $user_id = $_GET["user"];
    $book_id = $_GET["book"];

    //remove from checkedout list
    $query = "DELETE FROM CheckedOut WHERE user_id=$user_id AND book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }

    //update the books table to show it's free
    $query = "UPDATE Books SET checked_out=0 WHERE book_id = $book_id";
    if(!$result = $mysqli->query($query)) {
        echo $mysqli->error;
    }

    //if there is a hold on the book, need to check out for that user
    $query = "SELECT * FROM Held WHERE book_id = $book_id ORDER BY date";
    if($result = $mysqli->query($query)) {
        if($result->num_rows > 0) {
            $held = $result->fetch_assoc();
            $user_id = $held["user_id"];
            $book_id = $held["book_id"];
            $query = "DELETE FROM Held WHERE user_id=$user_id AND book_id = $book_id";
            if(!$result = $mysqli->query($query)) {
                echo $mysqli->error;
            }
    
            if($result->num_rows == 1) {
                $query = "UPDATE Books SET on_hold=0 WHERE book_id = $book_id";
                if(!$result = $mysqli->query($query)) {
                    echo $mysqli->error;
                }
            }
            header("Location: ./checkout.php?user=$user_id&book=$book_id");
        }
        else {
            header("Location: ../index.php");
        }
    }
    else {
        echo $mysqli->error;
    }
?>