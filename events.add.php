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
    <title>Add event</title>
</head>
<body>
  <div class="edit">
    <form action="includes/addEvent.inc.php" method="post">
      <div class="middle">
        <div>
          <p>Name:</p>
          <input type="text" placeholder="Name" name="name">
          <p>Type:</p>
          <select name="type" id="type" value="conference">
            <option value="" hidden >Select here</option>
            <option value="Festival">Festival</option>
            <option value="Conference">Conference</option>
            <option value="Sports">Sports</option>
            <option value="Religious">Religious</option>
          </select>
          <p>Schedule:</p>
          <input type="text" placeholder="Schedule" name="schedule">
        </div>
        <div style="margin-left:3em">
          <p>Capacity:</p>
          <input type="number" placeholder="Number" name="capacity" min="1" max="1000000">
          <p>Country:</p>
          <input type="text" placeholder="Country" name="country">
        </div>
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
        }
      }
    ?>
  </div>
</body>
</html>

