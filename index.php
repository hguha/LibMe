<?
session_start();
if(!empty($_SESSION["user"])) {
    if($_SESSION["user_type"] == "admin") {
        require_once './admin-dashboard.php';
    }
    else {
        require_once './user-dashboard.php';
    }
} else {
    require_once './login.php';
}
?>