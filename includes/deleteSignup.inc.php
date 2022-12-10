<?php
    require "db.inc.php";
    require "functions.inc.php";

    $name = $_GET["ID"]

    if (!isset($_SESSION["userID"])){
        header("location:.php");
    }