<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $type = $_POST["type"];
    $capacity = $_POST["capacity"];
    $country = $_POST["country"];
    $schedule = $_POST["schedule"];

    $id = $_GET["ID"];

    require "db.inc.php";
    require "functions.inc.php";

    if(emptyInputEvent($conn, $name, $type, $capacity, $country, $schedule) !== false){
        header("location:../events.add.php?error=emptyinput");
        exit();
    }



    updateEvent($conn, $name, $type, $capacity, $country, $schedule, $id);
}
else{
    header("location:../users.edit.php");
}