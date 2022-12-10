
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Testing</title>
    <script src="https://kit.fontawesome.com/45cba04ef0.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="loginbox">
    <i class="fa-solid fa-user fa-3x user"></i>
    <form action="includes/login.inc.php" method="post" style="padding: 6.5em 0">
      <p>Email:</p>
      <input type="text" placeholder="Email/Username" name="name" autofocus>
      <p>Password:</p>
      <input type="password" placeholder="Password" name="password">
      
      <input type="submit" name="submit" style="margin-left:2.2em">
      <div style="margin:auto;width:60%;text-align:center;color:red">
        <?php
          if(isset($_GET["error"])){
            if($_GET["error"] == "emptyinput"){
              echo "Fill in all fields";
            }else if($_GET["error"] == "wronglogin"){
              echo "Incorrect login information";
            }
          }
        ?>
      </div>
    </form>
  </div>
</body>
</html>