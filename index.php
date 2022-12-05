<?php
?>
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
      <input type="text" placeholder="Email/Username" name="email" autofocus>
      <p>Password:</p>
      <input type="password" placeholder="Password" name="password">
      
      <input type="submit" style="margin-left:2.2em">
    </form>
  </div>
</body>
</html>