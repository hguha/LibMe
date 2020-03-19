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
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script> -->
<!-- // echo $book["title"]; -->
<!-- // $now = date('Y-m-d H:i:s');
// echo "<div class='book-card'>";
// echo "<br><a href='environment/return.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>RETURN</a>";
// // echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
// echo "</div>"; -->