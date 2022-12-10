<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];

    $id = $_GET["ID"];

    require "db.inc.php";
    require "functions.inc.php";

    if(empty($name) !== false){
        header("location:../signup.add.php?error=emptyinput");
        exit();
    }

    if(alreadySigned($conn, $name, $id) !== false){
        header("location:../signup.add.php?ID=" . $id . "&error=alreadySigned");
        exit();
    }



    addSignup($conn, $name, $id);
}
else{
    header("location:../signup.add.php");
}