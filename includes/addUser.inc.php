<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $age = $_POST["age"];
    $country = $_POST["country"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    $admin = 2;

    require "db.inc.php";
    require "functions.inc.php";

    if(emptyInputSignup($name, $email, $username, $age, $country, $gender, $password, $admin) !== false){
        header("location:../users.add.php?error=emptyinput");
        exit();
    }
    
    if(invalidName($name) !== false){
        header("location:../users.add.php?error=invalidName");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location:../users.add.php?error=invalidEmail");
        exit();
    }


    


    createUser($conn, $name, $email, $username, $age, $country, $gender, $password, 1);
}
else{
    header("location:../users.add.php");
}