<?php

if (isset($_POST["submit"])){
    $name = $_POST["name"];
    $type = $_POST["type"];
    $capacity = $_POST["capacity"];
    $country = $_POST["country"];
    $schedule = $_POST["schedule"];

    require "db.inc.php";
    require "functions.inc.php";

    if(emptyInputEvent($name, $type, $capacity, $country, $schedule) !== false){
        header("location:../events.add.php?error=emptyinput");
        exit();
    }


    createEvent($conn, $name, $type, $capacity, $country, $schedule);
}
else{
    header("location:../events.add.php");
}