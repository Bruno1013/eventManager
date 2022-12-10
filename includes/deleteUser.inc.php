<?php

if (isset($_POST["submit"])){

    $id = $_GET["ID"];

    require "db.inc.php";
    require "functions.inc.php";



    deleteUser($conn, $id);
}
else{
    header("location:../events.php?error=access");
}