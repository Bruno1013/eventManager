<?php
  include("includes/db.inc.php");
  if (!isset($_SESSION["userID"])){
    header("location:index.php");
  }

  $id = $_GET["ID"];
  $sql = "SELECT * FROM users WHERE userID =" . $id;
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
    <title>Delete User</title>
</head>
<body>
  <div class="edit" style="filter:blur(1.5px)";>
    <div>
      <form action="includes/updateUser.inc.php?ID=<?= $id ?>" method="post">
        <div class="middle">
          <div style="width:30%">
            <p>Name:</p>
            <input type="text" placeholder="Name" name="name" value="<?= $row["userName"] ?>" readonly>
            <p>Gender:</p>
            <select name="gender" id="gender">
              <option value="" disabled hidden>Select here</option>
              <option id = "Male" value="Male" disabled>Male</option>
              <option id = "Female" value="Female" disabled>Female</option>
              <option id = "Other" value="Other" disabled>Other</option>
            </select>
            <p>Email:</p>
            <input type="email" placeholder="Email" name="email" value="<?= $row["userEmail"] ?>" readonly>
          </div>
          <div style="margin-left:3em; width:30%">
            <p>Age:</p>
            <input type="number" placeholder="Number" name="age" value="<?= $row["userAge"] ?>" min="1" max="100" readonly>
            <p>Country:</p>
            <input type="text" placeholder="Country" name="country" value="<?= $row["userCountry"] ?>" readonly>
            <p>Username:</p>
            <input type="text" placeholder="Username" name="username" value="<?= $row["userUID"] ?>" readonly>
          </div>
        </div>
        
        <div style="display:flex; justify-content:center;">
            <input type="submit" value="Submit changes" name="submit"> 
            <input type="reset" value="Reset">     
        </div>
      </form>
    </div>
    <div style="display:flex; justify-content:center" >
      <button class="reset" onclick="window.location.href = 'users.resetPassword.php?ID=<?=$id;?> ';">Reset Password</button>
    </div>
  </div>

  <div style="display:flex; justify-content:center; margin-top:2em">
    <button onclick="window.location.href = 'users.php';">Return</button>
  </div>
  
  <form action="includes/deleteUser.inc.php?ID=<?= $id ?>" method="post" class="coverUp">
    <p>Are you sure you want to delete this event?</p>
    <input type="submit" name="submit" value="Yes">
    <button onclick="window.location.href = 'users.php';">No</button>
  </form>


  
</body>
</html>

<script>
  document.getElementById("<?= $row["userGender"] ?>").setAttribute("selected", "selected"); 
</script>
