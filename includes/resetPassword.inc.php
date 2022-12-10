<?php
    if (isset($_POST["submit"])) {

        $oldPassword = $_POST["oldPassword"];
        $newPassword = $_POST["newPassword"];
        

        require "db.inc.php";
        require "functions.inc.php";


        if (emptyReset($oldPassword, $newPassword) !== false) {
            header("location: ../users.resetPassword.php?error=emptyinput");
            exit();
        }else{
            $id = $_GET["ID"];
        }

        resetPassword($conn, $oldPassword, $newPassword, $id);
    }
    else{
        header("location: ../events.php");
    }