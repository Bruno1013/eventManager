<?php
  include("includes/db.inc.php");
  if (!isset($_SESSION["userID"])){
    header("location:index.php");
  }

  $id = $_GET["ID"];
  $sql = "SELECT * FROM events WHERE eventsId =" . $id;
  $result = mysqli_query($conn, $sql);

  $row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit event</title>
</head>
<body>
  <div class="edit">
    <form action="includes/updateEvent.inc.php?ID=<?= $id ?>" method="post">
      <div class="middle">
        <div>
          <p>Name:</p>
          <input type="text" placeholder="Name" name="name" value="<?= $row["eventName"] ?>" >
          <p>Type:</p>
          <select name="type" id="type" value="conference">
            <option value="" disabled hidden>Select here</option>
            <option id = "Festival" value="Festival">Festival</option>
            <option id = "Conference" value="Conference">Conference</option>
            <option id = "Sports" value="Sports">Sports</option>
            <option id = "Religious" value="Religious">Religious</option>
          </select>
          <p>Schedule:</p>
          <input type="text" placeholder="Schedule" name="schedule" value="<?= $row["eventSchedule"] ?>">
        </div>
        <div style="margin-left:3em">
          <p>Capacity:</p>
          <input type="number" placeholder="Number" name="capacity" value="<?= $row["eventCapacity"] ?>" min="1" max="1000000">
          <p>Country:</p>
          <input type="text" placeholder="Country" name="country" value="<?= $row["eventCountry"] ?>">
        </div>
      </div>
      

      <div style="display:flex; justify-content:center;">
            <input type="submit" value="Submit changes" name="submit"> 
            <input type="reset" value="Reset">     
      </div>
    </form>
  </div>
  <div style="display:flex; justify-content:center; margin-top:2em">
    <button onclick="window.location.href = 'events.php';">Return</button>
  </div>
</body>
</html>

<script>
  document.getElementById("<?= $row["eventType"] ?>").setAttribute("selected", "selected"); 
</script>