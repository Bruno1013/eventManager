<?php
  include("includes/db.inc.php");
  // if (!isset($_SESSION["userID"])){
  //   header("location:index.php");
  // }

  $id = $_GET["ID"];
  
  $sql = "SELECT * FROM events WHERE eventsId =" . $id;
  $result = mysqli_query($conn, $sql);
  $event=mysqli_fetch_assoc($result);

  $sql = "SELECT * FROM users";
  $result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Add signup</title>
</head>
<body>
<div class="edit" style="margin-top:10em">
    <form action="includes/addSignup.inc.php?ID=<?= $id ?>" method="post">
      <div class="middle" style="margin-top:6em">
        <div>
          <h1><?= $event["eventName"] ?></h1>
          <p>User to add:</p>
          <select name="name" id="user">
            <option value="" hidden>Select here</option>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
              <option value="<?= $row["userID"] ?>"><?= $row["userName"] ?></option>
            <?php } ?> 
          </select>
        </div>
      </div>
      
      <input type="submit" name="submit"> 
    </form>
    <p style="color:red; margin-left:2em">
      <?php
        if(isset($_GET["error"])){
          if($_GET["error"] == "emptyinput"){
            echo "Fill in all fields";
          }else if($_GET["error"] == "alreadySigned"){
            echo "User already signed to event";
          }
        }
      ?>
    </p>
  </div>
</body>
</html>

