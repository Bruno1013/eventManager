<?php
    include("includes/db.inc.php");
    if (!isset($_SESSION["userID"])){
        header("location:index.php");
    }

    $sql = "SELECT * FROM events";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Events</title>
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
        <h1 style="text-align:center; color:white; padding-top:0.5em">Events</h1>
        <div class = "table" >
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Schedule</th>
                        <th>Country</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        
                        <tr>
                            <td><a href="eventsView.php?ID=<?= $row["eventsId"] ?>" style="color: #009879;"><?= $row["eventName"] ?></a></td>
                            <td><?= $row["eventType"] ?></td>
                            <td><?= $row["eventCapacity"] ?></td>
                            <td><?= $row["eventSchedule"] ?></td>
                            <td><?= $row["eventCountry"] ?></td>
                            <td><a href=" <?= "events.edit.php?ID=" . $row["eventsId"]?> "><button style="background-color:#32a852">Edit</button></a></td>
                            <td><a href=" <?= "events.delete.php?ID=" . $row["eventsId"]?> "> <button style="background-color:red">Delete</button></a></td>
                        </tr>

                    <?php } ?>  
                    
                </tbody>
            </table>
        </div>
        <div style="display:flex; justify-content:center; margin-bottom:2em">
            <a href="events.add.php"><button>Add Event</button></a>
        </div>
    </div>
</body>
</html>