<?php session_start(); ?>
<link rel='stylesheet' href='styles/style.css'>
<link rel='stylesheet' href='styles/admin-dashboard.css'>
<div class="bg-1"></div>
<div class="bg-2"></div>
<div class="bg-3"></div>
<div class="bg-4"></div>
<div class="bg-5"></div>
<div class="header-card">
    <div class="title">Welcome, <?php echo $_SESSION["user"]["first_name"] ?>!</div>
    <br>Click to <a href='./environment/logout.php' class='logout-button'>Logout</a><br><br><br>
</div>

<div class="add-card">
    <div class="content">
        <h1>Add Book</h1>
        <form action="environment/add_book.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload"><br>
            <input name="title" placeholder="Title" id="fileToUpload"></input><br>
            <input name="author" placeholder="Author" id="fileToUpload"></input><br>
            <input type="number" name="isbn" placeholder="ISBN" id="fileToUpload"></input><br>
            <input type="submit" name="submit" value="Add"></input>
        </form>
    </div>
</div>
<div class="delete-card">
    <div class="content">
        <h1>Delete Book</h1>
        <br><br><br><br>
        <form action="environment/delete_book.php" method="POST">
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
            </select>
            <br><br><br><br><br><br><br>
            <input type="submit" value="Delete Book" name="submit">
        </form>
    </div>
</div>