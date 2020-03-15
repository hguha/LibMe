<?
session_start();
if(!empty($_SESSION["user"])) {
    require_once './user-dashboard.php';
} else {
    require_once './login.php';
}
?>