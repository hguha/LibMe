<?php
//get the data
include_once "user-header.php";
include_once "environment/db.php";

//books
$books = array();
$username = $_SESSION['user']['user'];
$query = "SELECT * FROM CheckedOut NATURAL JOIN Books b NATURAL JOIN Users JOIN Authors a ON a.author_id = b.author_id WHERE user = '$username'";
if($result = $mysqli->query($query)) {
    if($result->num_rows > 0) {
        while($book = $result->fetch_assoc()) {
            $book["due_date"] = date_format(new DateTime($book["due_date"]), 'm/d/Y');
            array_push($books, $book);
        }
    }
}
//holds
$holds = array();
$query = "SELECT * FROM Held NATURAL JOIN Books b NATURAL JOIN Users JOIN Authors a ON a.author_id = b.author_id WHERE user = '$username'";
if($result = $mysqli->query($query)) {
    if($result->num_rows > 0) {
        while($book = $result->fetch_assoc()) {
            $holds["due_date"] = date_format(new DateTime($book["due_date"]), 'm/d/Y');
            array_push($holds, $book);
        }
    }
}
?>

<?
//display everything so beautifully
    echo "<div class='content'>";
    echo "<div class='row'>";
        echo "<div style='background:gray' class='col'>";
            if(count($books)) {
                foreach ($books as $book) {
                    echo "<div class='book-card'>";
                        echo $book["title"];
                        echo $book["first_name"]. " ".$book["last_name"];
                        echo $book["due_date"];
                        echo "<br><a href='environment/return.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>RETURN</a>";
                    echo "</div>";
                }
            }
            else {
                echo "No books!";
            }
        echo "</div>";
        echo "<div class='col'>";
            if(count($holds)) {
                foreach ($holds as $book) {
                    echo "<div class='book-card'>";
                        echo $book["title"];
                        echo $book["first_name"]. " ".$book["last_name"];
                        echo $book["due_date"];
                        echo "<br><a href='environment/unhold.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>UNHOLD</a>";
                    echo "</div>";
                }
            }
            else {
                echo "No holds!";
            }
        echo "</div>";
    echo "</div>";
    echo "</div>";
?>