<?
session_start();
$user = $_POST["username"];
$pass = $_POST["password"];

#check database
$mysqli = new mysqli("mysql.eecs.ku.edu", "hirsh", "libme", "hirsh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$query = "SELECT * FROM Users WHERE user = '$user' AND pass= '$pass'";
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        $_SESSION["errorMessage"] = "Invalid Credentials you dummy!";
        header("Location: ./index.php");
    }
    else {
        $user = $result->fetch_assoc();
        $_SESSION["user"] = $user["user"];
        $_SESSION["pass"] = $user["user"];
        $_SESSION["first_name"] = $user["user"];
        $_SESSION["last_name"] = $user["user"];
        header("Location: user-dashboard.php");
    }
}
else {
    echo "an error occurred";
}
?>