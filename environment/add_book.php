<?php
session_start();
include_once "db.php";
$fields = array("title", "description", "isbn");
foreach ($fields as $field) {
    $book[$field] = "'".$_POST[$field]."'";
}
$author = explode(" ", $_POST["author"], 2);
$first = $author[0];
$last = $author[1];
$query = "SELECT * FROM Authors WHERE first_name='$first' AND last_name='$last'";
if($result = $mysqli->query($query)) {
    if($result->num_rows) {
        $auth = $result->fetch_assoc();
        $book["author_id"] = "'".$auth["author_id"]."'";
    }
    else {
        $query = "INSERT INTO Authors(first_name, last_name) VALUES('$first', '$last')";
        if(!$result = $mysqli->query($query)) {
            echo $mysqli->error;
        }
    }
}
else {
    echo $mysqli->error;
}

if(!isset($book["author_id"])) {
    $book["author_id"] = "'".$mysqli->insert_id."'"; 
};

if(isset($_FILES["fileToUpload"])) {
    $book["image"] = "'images/".$_FILES["fileToUpload"]["name"]."'";
};
$isbn = $book['isbn'];
$query = "SELECT * FROM Books WHERE isbn=$isbn";
if($result = $mysqli->query($query)) {
    if($result->num_rows) {
        echo "This copy of this book already exists!";
        header("Location: ../index.php");
    }
}
$cols = implode(", ", array_keys($book));
$vals = implode(", ", array_values($book));
$query = "INSERT INTO Books($cols) VALUES($vals)";
if(!$result = $mysqli->query($query)) {
    echo $mysqli->error;
}
header("Location: ../index.php");
//Upload the image to the server
if(isset($_FILES["fileToUpload"])) {
    $book["image"] = $_FILES["fileToUpload"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check == false) {
            echo "File is not an image.";
            unset($_FILES["fileToUpload"]);
            $uploadOk = false;
            
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        unset($_FILES["fileToUpload"]);
        $uploadOk = false;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        unset($_FILES["fileToUpload"]);
        $uploadOk = false;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
        unset($_FILES["fileToUpload"]);
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        unset($_FILES["fileToUpload"]);
    // if everything is ok, try to upload file
    } 
    else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            unset($_FILES["fileToUpload"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
            unset($_FILES["fileToUpload"]);
        }
    }
}

?>