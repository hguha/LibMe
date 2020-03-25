<?php
include_once "db.php";

$book_id = $_POST["book"];
//delete from books
$query = "DELETE FROM Books WHERE book_id='$book_id'";
// echo $query; exit;
if(!$result = $mysqli->query($query)) {
    echo $mysqli->error;
}

//delete from checked out
$query = "DELETE FROM CheckedOut WHERE book_id='$book_id'";
if(!$result = $mysqli->query($query)) {
    echo $mysqli->error;
}
//delete from held
$query = "DELETE FROM Held WHERE book_id='$book_id'";
if(!$result = $mysqli->query($query)) {
    echo $mysqli->error;
}

header("Location: ../index.php");

?>