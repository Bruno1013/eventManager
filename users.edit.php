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
    <title>Edit User</title>
</head>
<body>
  <div class="edit">
    <div>
      <form action="includes/updateUser.inc.php?ID= <?= $id ?>" method="post">
        <div class="middle">
          <div style="width:30%">
            <p>Name:</p>
            <input type="text" placeholder="Name" name="name" value="<?= $row["userName"] ?>" min="1" max="100">
            <p>Gender:</p>
            <select name="gender" id="gender">
              <option value="" disabled hidden>Select here</option>
              <option id = "Male" value="Male">Male</option>
              <option id = "Female" value="Female">Female</option>
              <option id = "Other" value="Other">Other</option>
            </select>
            <p>Email:</p>
            <input type="email" placeholder="Email" name="email" value="<?= $row["userEmail"] ?>">
          </div>
          <div style="margin-left:3em; width:30%">
            <p>Age:</p>
            <input type="number" placeholder="Number" name="age" value="<?= $row["userAge"] ?>" min="1" max="100">
            <p>Country:</p>
            <input type="text" placeholder="Country" name="country" value="<?= $row["userCountry"] ?>">
            <p>Username:</p>
            <input type="text" placeholder="Username" name="username" value="<?= $row["userUID"] ?>">
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


  
</body>
</html>

<script>
  document.getElementById("<?= $row["userGender"] ?>").setAttribute("selected", "selected"); 
</script>
