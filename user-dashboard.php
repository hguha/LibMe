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
            // $book["due_date"] = date_format(new DateTime($book["due_date"]), 'm/d/Y');
            array_push($books, $book);
        }
    }
}
echo "got here";

//holds
$holds = array();
$query = "SELECT * FROM Held NATURAL JOIN Books b NATURAL JOIN Users JOIN Authors a ON a.author_id = b.author_id WHERE user = '$username'";
if($result = $mysqli->query($query)) {
    // echo $result->num_rows;exit;
    if($result->num_rows > 0) {
        while($book = $result->fetch_assoc()) {
            // $book["due_date"] = date_format(new DateTime($book["due_date"]), 'm/d/Y');
            array_push($holds, $book);
        }
    }
}
//display everything so beautifully
    echo "<div class='content'>";
    echo "<div class='row'>";
        echo "<div style='border-right:1px solid black' class='col'>";
        echo "<div class='home-indicator'>Checked Out</div>";
            if(count($books)) {
                foreach ($books as $book) {
                    echo "<div class='row book-card'>";
                    echo "<div style='text-align: center' class='col'>";
                        echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
                    echo "</div>";
                    echo "<div class='info col'>";
                        echo "<span class='title'>".$book["title"]."</span>";
                        echo "<br>";
                        echo "<span class='isbn'>"."ISBN: ".$book["isbn"]."</span>";
                        echo "<br>";
                        echo "<span class='author'>".$book["first_name"];
                        echo " ";
                        echo $book["last_name"]."</span>";
                        echo "<br>";
                        echo "DUE: ".$book["due_date"];
                        echo "<br>";
                        echo "<br><a href='environment/return.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>RETURN</a>";
                        echo "</div>";
                    echo "</div>";
                }
            }
            else {
                echo "<div style='text-align:center'>No Books Checked Out</div>";
            }
        echo "</div>";
        echo "<div style='border-right:1px solid black' class='col'>";
        echo "<div class='home-indicator'>Holds</div>";
            if(count($holds)) {
                foreach ($holds as $book) {
                    echo "<div class='row book-card'>";
                    echo "<div style='text-align: center' class='col'>";
                        echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
                    echo "</div>";
                    echo "<div class='info col'>";
                        echo "<span class='title'>".$book["title"]."</span>";
                        echo "<br>";
                        echo "<span class='isbn'>"."ISBN: ".$book["isbn"]."</span>";
                        echo "<br>";
                        echo "<span class='author'>".$book["first_name"];
                        echo " ";
                        echo $book["last_name"]."</span>";
                        echo "<br>";
                        echo "<br><a href='environment/unhold.php?user=".$book["user_id"]."&book=".$book["book_id"]."'>UNHOLD</a>";                        echo "</div>";
                    echo "</div>";
                }
            }
            else {
                echo "<div style='text-align:center'>No Books On Hold</div>";
            }
        echo "</div>";
    echo "</div>";
    echo "</div>";
?>