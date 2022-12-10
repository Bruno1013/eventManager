<?php
    include("includes/db.inc.php");
    if (!isset($_SESSION["userID"])){
        header("location:index.php");
    }

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    
    $sql = "SELECT * FROM users WHERE userID =" . $_SESSION["userID"];
    $resultData = mysqli_query($conn, $sql);
    $loggedIn = mysqli_fetch_assoc($resultData);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Users</title>
</head>
<body>
    <header>
        <nav>
            <ul class="navLinks">
                <li><a href="events.php">Events</a></li>
                <li><a href="">Users</a></li>
            </ul>
        </nav>
        <a href="includes/logout.inc.php"><button>Sign off</button></a>
    </header>

    <div>
        <h1 style="text-align:center; color:white; padding-top:0.5em">Users</h1>
        <div class = "table" >
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Country</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="activeRow">
                        <td><?=$loggedIn["userName"]?></td>
                        <td><?=$loggedIn["userAge"]?></td>
                        <td><?=$loggedIn["userGender"]?></td>
                        <td><?=$loggedIn["userCountry"]?></td>
                        <td><a href="<?= "users.edit.php?ID=" . $_SESSION["userID"] ?>"><button style="background-color:#32a852">Edit</button></a></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <?php while($row = mysqli_fetch_assoc($result)) {
                        if($row["userID"] == $_SESSION["userID"]){}
                        else{ ?>
                        
                        <tr>
                            <td><?= $row["userName"] ?></td>
                            <td><?= $row["userAge"] ?></td>
                            <td><?= $row["userGender"] ?></td>
                            <td><?= $row["userCountry"] ?></td>
                            <td><a href=" <?= "users.edit.php?ID=" . $row["userID"] ?>"><button style="background-color:#32a852">Edit</button></a></td>
                            <td><a href=" <?= "users.delete.php?ID=" . $row["userID"] ?>"><button style="background-color:red">Delete</button></a></td>
                        </tr>

                    <?php }} ?>   
                    
                </tbody>
            </table>
        </div>
        <div style="display:flex; justify-content:center; margin-bottom:2em">
            <a href="users.add.php"><button>Add User</button></a>
        </div>
    </div>
</body>
</html>