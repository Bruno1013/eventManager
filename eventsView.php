<?php
    include("includes/db.inc.php");
    if (!isset($_SESSION["userID"])){
        header("location:index.php");
    }

    $id = $_GET["ID"];

    $sql = "SELECT * FROM events WHERE eventsId=" . $id; //For name of event
    $result = mysqli_query($conn, $sql);
    $event = mysqli_fetch_assoc($result);


    $sql = "SELECT * FROM signups LEFT JOIN users ON signups.userId = users.userID WHERE Signups.eventId = " . $id;
    $result = mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Signups</title>
</head>
<body>
    <header>
        <nav>
            <ul class="navLinks">
                <li><a href="">Events</a></li>
                <li><a href="users.php">Users</a></li>
            </ul>
        </nav>
        <a href="includes/logout.inc.php"><button>Sign off</button></a>
    </header>

    <div>
        <h1 style="text-align:center; color:white; padding-top:0.5em"><?= $event["eventName"] ?></h1>
        <h2 style="text-align:center; color:white;">Signups</h2>
        <div class = "table" >
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($signups = mysqli_fetch_assoc($result)) { ?>
                        
                        <tr>
                            <td><?= $signups["userName"] ?></td>
                            <td><?= $signups["userAge"] ?></td>
                            <td><?= $signups["userGender"] ?></td>
                            <td><?= $signups["userCountry"] ?></td>
                            <td><button onclick="window.location.href = 'includes/deleteSignup.inc.php?ID=<?= $id ?>';" style="background-color:red">Delete</button></td>
                        </tr>

                    <?php } ?>  
                    
                </tbody>
            </table>
        </div>
        <div style="display:flex; justify-content:center">
            <button onclick="window.location.href = 'signup.add.php?ID=<?= $id?>';">Add signup</button>
        </div>
    </div>
</body>
</html>