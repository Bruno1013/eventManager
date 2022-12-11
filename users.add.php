<?php
  include("includes/db.inc.php");
  if (!isset($_SESSION["userID"])){
    header("location:index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add user</title>
</head>
<body>
<div class="edit">
    <form action="includes/addUser.inc.php" method="post">
      <div class="middle">
        <div>
          <p>Name:</p>
          <input type="text" placeholder="Name" name="name" min="1" max="100">
          <p>Gender:</p>
          <select name="gender" id="gender">
            <option value="" hidden>Select here</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select>
          <p>Email:</p>
          <input type="email" placeholder="Email" name="email">
        </div>
        <div style="margin-left:3em">
          <p>Age:</p>
          <input type="number" placeholder="Number" name="age">
          <p>Country:</p>
          <input type="text" placeholder="Country" name="country">
          <p>Username:</p>
          <input type="text" placeholder="Username" name="username">
        </div>
      </div>
      <div style="width:30%; margin:auto; margin-bottom:2em">
        <p>Password:</p>
        <input type="text" placeholder="Password" name="password">
      </div>
      
          <input type="submit" name="submit"> 
    </form>
  </div>

  <div style="text-align:center; color:red; margin-top:1em">
    <?php
      if(isset($_GET["error"])){
        if($_GET["error"] == "emptyinput"){
          echo "Fill in all fields";
        }else if($_GET["error"] == "stmtfailed"){
          echo "SQL statement failed to initialize";
        }else if($_GET["error"] == "invalidName"){
          echo "Please type a valid name";
        }else if($_GET["error"] == "invalidEmail"){
          echo "Please type a valid email";
        }
      }
    ?>
  </div>
</body>
</html>

