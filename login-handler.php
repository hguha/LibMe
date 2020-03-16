<?
session_start();
include_once "environment/db.php";
$user = $_POST["username"];
$pass = $_POST["password"];
#I wanted to use one login page for the admins and the users for no reason other than convienance.
#It will be easy to change if that's what we would rather do

#check user database
$query = "SELECT * FROM Users WHERE user = '$user' AND pass= '$pass'";
if($result = $mysqli->query($query)) {
    if($result->num_rows === 0) {
        #if no users, check admin database
        $query = "SELECT * FROM Admin WHERE user = '$user' AND pass= '$pass'";
        if($result = $mysqli->query($query)) {
            if($result->num_rows === 0) {
                $_SESSION["errorMessage"] = "Invalid Credentials you dummy!";
                header("Location: ./index.php");
            }
            #if no admins, the user just doesn't exist
            else {
                $user = $result->fetch_assoc();
                #store user data in the session to be accessed anywhere in the app
                $_SESSION["user"] = $user;
                header("Location: admin-dashboard.php");
            }
        }

    }
    else {
        $user = $result->fetch_assoc();
        #store user data in the session to be accessed anywhere in the app
        $_SESSION["user"] = $user;
        header("Location: user-dashboard.php");
    }
}
else {
    echo "an error occurred";
}
?>