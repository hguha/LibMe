<?
include_once "db.php";
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
    default:
        $query = "";

}
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        echo "No books returned :(";
    }
    else {
        echo "<div class='content'>";
        while($book = $result->fetch_assoc()) {
            echo "<div class='book-card'>";
            echo $book["title"];
            echo "<br>";
            echo $book["isbn"];
            echo "<br>";
            echo $book["first_name"];
            echo " ";
            echo $book["last_name"];
            echo isset($book["image"]);
            echo "<img src='".($book["image"] !== null ? $book["image"] : "images/default-book-image.jpeg")."'>";
            echo "</div>";
        }
        echo "</div>";
    }
}
else {
    echo "an error occurred";
}
?>