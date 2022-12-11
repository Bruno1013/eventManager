<?php
    require "db.inc.php";
    require "functions.inc.php";

    $user = $_GET["ID"];
    $event = $_GET["user"];

    if (!isset($_SESSION["userID"])){
        header("location:index.php");
    }

    deleteSignup($conn, $user, $event);
