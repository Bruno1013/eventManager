<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $age = $_POST["age"];
    $country = $_POST["country"];
    $gender = $_POST["gender"];
    $admin = 2;

    $id =$_GET["ID"];

    require "db.inc.php";
    require "functions.inc.php";

    if(emptyInputEdit($name, $email, $username, $age, $country, $gender, $admin) !== false){
        header("location:../events.add.php?error=emptyinput");
        exit();
    }



    updateUser($conn, $name, $email, $username, $age, $country, $gender, 1, $id);
}
else{
    header("location:../users.edit.php");
}