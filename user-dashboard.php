<?php
include_once "user-header.php";
include_once "environment/db.php";

echo "<div class='content'>";
$username = $_SESSION['user']['user'];
$query = "SELECT * FROM CheckedOut NATURAL JOIN Books b NATURAL JOIN Users JOIN Authors a ON a.author_id = b.author_id WHERE user = '$username'";
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        echo "No books checked out";
    }
    else {
        while($book = $result->fetch_assoc()) {
            $now = date('Y-m-d H:i:s');
            echo "<div class='book-card'>";
            echo $book["title"];
            echo "<br>";
            echo "ISBN: ".$book["isbn"];
            echo "<br>";
            echo $book["first_name"];
            echo " ";
            echo $book["last_name"];
            echo "<br>";
            echo "DUE: ";
            if($book["due_date"] <= $now) {
                echo "PAST DUE";
            }
            else {
                echo (date_format(new DateTime($book["due_date"]), 'm/d/Y'));
            }
            echo "<br><a href='environment/return.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>RETURN</a>";
            // echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
            echo "</div>";
        }
    }
}
echo "</div>";
?>