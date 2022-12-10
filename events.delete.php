<?php
  include("includes/db.inc.php");
  // if (!isset($_SESSION["userID"])){
  //   header("location:index.php");
  // }

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
    <title>Event delete</title>
</head>
<body>
  <div class="edit" style="filter:blur(1.5px);">
    <form action="" method="post">
      <div class="middle">
        <div>
          <p>Name:</p>
          <input type="text" placeholder="Name" name="name" value="<?= $row["eventName"] ?>" readonly>
          <p>Type:</p>
          <select name="type" id="type" value="conference" >
            <option value="" disabled hidden>Select here</option>
            <option id = "Festival" value="Festival" disabled="true">Festival</option>
            <option id = "Conference" value="Conference" disabled="true" >Conference</option>
            <option id = "Sports" value="Sports" disabled="true" >Sports</option>
            <option id ="Religious" value="Religious" disabled="true" >Religious</option>
          </select>
          <p>Schedule:</p>
          <input type="text" placeholder="Schedule" name="email" value="<?= $row["eventSchedule"] ?>" readonly>
        </div>
        <div style="margin-left:3em">
          <p>Capacity:</p>
          <input type="number" placeholder="Number" name="capacity" value="<?= $row["eventCapacity"] ?>" readonly>
          <p>Country:</p>
          <input type="text" placeholder="Country" name="country" value="<?= $row["eventCountry"] ?>" readonly>
        </div>
      </div>
      

      <div style="display:flex; justify-content:center;">
            <input type="submit" value="Submit" disabled> 
            <input type="reset" value="Reset" disabled>     
      </div>
    </form>
  </div>

  <form action="includes/deleteEvent.inc.php?ID=<?= $id ?>" method="post" class="coverUp">
    <p>Are you sure you want to delete this event?</p>
    <input type="submit" name="submit" value="Yes">
    <button onclick="window.location.href = 'events.php';">No</button>
  </form>
    
</body>
</html>

<script>
  document.getElementById("<?= $row["eventType"] ?>").setAttribute("selected", "selected"); 
</script>