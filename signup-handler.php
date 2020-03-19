<?
session_start();
include_once "environment/db.php";
$fields = array("user", "pass", "first_name", "last_name");
foreach ($fields as $field) {
    $user[$field] = "'".$_POST[$field]."'";
}

#check user database
$username = $user['user'];
$query = "SELECT * FROM Users WHERE user = $username";
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        $cols = implode(", ", array_keys($user));
        $vals = implode(", ", array_values($user));
        $query = "INSERT INTO Users($cols) VALUES($vals)";
        if(!$result = $mysqli->query($query)) {
            echo $mysqli->error;
        }
        header("Location: index.php");
    }
    else {
        $_SESSION["errorMessage"] = "This account already exists!";
        header("Location: ./signup.php");
    }
}
else {
    echo "an error occurred";
}

?>