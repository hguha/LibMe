<?
include_once "environment/db.php";
include_once "user-header.php";

$searchType = $_POST["type"];
$content = $_POST["content"];
switch($searchType) {
    case "author":
        $query = "SELECT * FROM Books NATURAL JOIN Authors WHERE CONCAT(first_name, ' ', last_name) = '$content'";
        break;
    case "isbn":
        $query = "SELECT * FROM Books NATURAL JOIN Authors WHERE isbn = $content";
        break;
    case "title":
        $query = "SELECT * FROM Books NATURAL JOIN Authors WHERE title = '$content'";
        break;
    case "keywords":
        $query = "SELECT * FROM Books NATURAL JOIN Authors WHERE title LIKE '%$content%' OR first_name LIKE '%$content%' OR last_name LIKE '%$content%' OR isbn LIKE '%$content%' OR CONCAT(first_name, ' ', last_name) LIKE '%$content%'";
        break;
    default:
        $query = "";
}
echo $query;
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        echo "No books returned :(";
    }
    else {
        echo "<div class='content'>";
        echo "<h1>Books that match \"".$content."\"</h1><hr>";
        while($book = $result->fetch_assoc()) {
            //check if we've already held this book
            $book_id = $book['book_id'];
            $user_id = $_SESSION["user"]["user_id"];
            $query = "SELECT * FROM Held WHERE book_id = $book_id AND user_id = $user_id";
            if($result2 = $mysqli->query($query)) {
                if($result2->num_rows > 0) {
                    $held = $result2->fetch_assoc();
                }
            }
            else {
                echo $mysqli->error;
            }

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
                if ($book["checked_out"]) {
                    echo "CHECKED OUT<br>";
                    //you can't place your own book on hold
                    if($book["checked_out"] !== $_SESSION["user"]["user_id"]) {
                        if($held["book_id"] == $book_id) {
                            echo "HELD";
                        }
                        else {
                            echo "<a href='environment/hold.php?user=".$user_id."&book=".$book_id."'>PLACE HOLD</a>";
                        }
                    }
                } 
                else {
                    echo "<a href='environment/checkout.php?user=".$user_id."&book=".$book_id."'>CHECK OUT</a>";
                }
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
}
else {
    echo "an error occurred";
}
?>