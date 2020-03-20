<? session_start(); ?>
<?
echo("Welcome, ".$_SESSION["user"]["first_name"]."!");
echo "<br>Click to <a href='./environment/logout.php' class='logout-button'>Logout</a><br><br><br>";
?>

<!-- UPLOAD BOOK -->
<form action="environment/add_book.php" method="POST" enctype="multipart/form-data">
Upload Book:<br>
    <input type="file" name="fileToUpload" id="fileToUpload"><br>
    <input name="title" placeholder="Title" id="fileToUpload"></input><br>
    <input name="author" placeholder="Author" id="fileToUpload"></input><br>
    <input type="number" name="isbn" placeholder="ISBN" id="fileToUpload"></input><br>
    <textarea name="description" placeholder="Description" id="fileToUpload"></textarea><br>
    <input type="submit" name="submit" value="Add"></input>
</form>

<!-- DELETE BOOK -->
<form action="environment/delete_book.php" method="post" enctype="multipart/form-data">
    Delete Book:
    <select name="book">
    <?php
    include_once "environment/db.php";
    $query = "SELECT * FROM Books";
    if($result = $mysqli->query($query)) {
        while($user = $result->fetch_assoc()) {
            echo "<option value=\"" . $user["book_id"] . "\">" . $user["title"] . "</option>";
        }
    }
    ?>
    </select><br><br>
    <input type="submit" value="Delete Book" name="submit">
</form>