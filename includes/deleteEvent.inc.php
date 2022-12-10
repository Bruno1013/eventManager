<?php

if (isset($_POST["submit"])){

    $id = $_GET["ID"];

    require "db.inc.php";
    require "functions.inc.php";



    deleteEvent($conn, $id);
}
else{
    header("location:../events.php?error=access");
}