<?php
    if (isset($_POST["submit"])) {

        $username = $_POST["name"];
        $password = $_POST["password"];

        require "db.inc.php";
        require "functions.inc.php";

        if (emptyInputLogin($username, $password) !== false) {
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        loginUser($conn, $username, $password);
    }
    else{
        header("location: ../index.php");
    }