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
    <title>Reset password</title>
</head>
<body>
  <div class="edit">
    <form action="<?=" includes/resetPassword.inc.php?ID=" . $id?>" method="post" style="margin-top:5em">
        <div class="middle">
            <div style="width:30%">
            <p>Old password:</p>
            <input type="password" placeholder="Name" name="oldPassword" >
            <p>New password:</p>
            <input type="password" placeholder="Username" name="newPassword">
            </div>
        </div>
      
        <div style="display:flex; justify-content:center;">
            <input type="submit" name="submit">     
        </div>
        <div style="text-align:center; color:red; margin-top:1em">
        <?php
          if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
              echo "Fill in all fields";
            }else if($_GET["error"] == "stmtfailed"){
              echo "SQL statement failed to initialize";
            }else if($_GET["error"] == "wrongPassword"){
              echo "Old password doesn't match password in database";
            }
          }
        ?>
      </div>
    </form>
  </div>
  <div style="display:flex; justify-content:center; margin-top:1em">
    <button class="reset" onclick="window.location.href = 'users.edit.php?ID=<?=$id;?> ';">Cancel operation</button>
  </div>
  
</body>
</html>