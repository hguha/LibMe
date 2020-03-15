<?
    session_start();
    echo("<head><link rel='stylesheet' href='style.css'></head>");
    echo($_SESSION["user"]);
    echo($_SESSION["pass"]);
?>