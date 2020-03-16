<?php
include_once "user-header.php";
include_once "db.php";

echo "<div class='content'>";
$username = $_SESSION['user']['user'];
$query = "SELECT * FROM CheckedOut NATURAL JOIN Books b NATURAL JOIN Users JOIN Authors a ON a.author_id = b.author_id WHERE user = '$username'";
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        echo "No books checked out";
    }
    else {
        while($book = $result->fetch_assoc()) {
            echo "<div class='book-card'>";
            echo $book["title"];
            echo "<br>";
            echo "ISBN: ".$book["isbn"];
            echo "<br>";
            echo $book["first_name"];
            echo " ";
            echo $book["last_name"];
            echo "<br>";
            echo "<a href='return.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>RETURN</a>";
            // echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
            echo "</div>";
        }
    }
}
echo "</div>";
?>