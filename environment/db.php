<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "hirsh", "libme", "hirsh");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>