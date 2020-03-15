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
    echo "<table>";
    while($user = $result->fetch_assoc()) {
        echo($user["first_name"]);
        echo(" ");
    }
}
if(false) {
    header("Location: index.php");
    $_SESSION["user"] = $user;
    $_SESSION["pass"] = $pass;
}
?>