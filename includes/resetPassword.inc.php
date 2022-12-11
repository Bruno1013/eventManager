<?php
    if (isset($_POST["submit"])) {

        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        

        require "db.inc.php";
        require "functions.inc.php";

        $id = $_GET["ID"];


        if (emptyReset($oldPassword, $newPassword) !== false) {
            header("location: ../users.resetPassword.php?ID=" . $id ."&error=emptyinput");
            exit();
        }

        resetPassword($conn, $oldPassword, $newPassword, $id);
    }
    else{
        header("location: ../events.php");
    }