<?php
function emptyInputSignup($name, $email, $username, $age, $country, $gender, $password, $admin){
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($age) || empty($country) || empty($gender) || empty($password) || empty($admin)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidName($name){
    $result;
    if(!preg_match("/^[a-zA-Z]*$/", $name)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}


function uidExists($conn, $username, $email){ //function to check if user exists for sign up and also to fetch information for login
    $sql = "SELECT * FROM users WHERE userUID = ? OR userEmail = ?"; //check if email or username already exists
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
}   

function createUser($conn, $name, $email, $username, $age, $country, $gender, $password, $admin){ //function to check if user exists for sign up and also to fetch information for login
    $sql = "INSERT INTO users (userName,userEmail,userUID, userAge, userCountry, userGender, userPassword, userAdmin) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssisssi", $name, $email, $username, $age, $country, $gender, $hashedPassword, $admin);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php?error=none");
}



function emptyInputEdit($name, $email, $username, $age, $country, $gender, $admin){
    $result;
    if(empty($name) || empty($email) || empty($username) || empty($age) || empty($country) || empty($gender) || empty($admin)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function emptyInputLogin($name, $password){
    $result;
    if(empty($name) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password){
    $uidExists = uidExists($conn, $username, $password);

    if ($uidExists === false) {
        header("location: ../index.php?error=wronglogin");
        exit();
    }

    $passwordHashed = $uidExists["userPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
         header("location: ../index.php?error=wronglogin");
         exit();
    }else if($checkPassword === true){
        $_SESSION["userID"] = $uidExists["userID"];
        $_SESSION["userName"] = $uidExists["userName"];
        $_SESSION["userAge"] = $uidExists["userAge"];
        $_SESSION["userGender"] = $uidExists["userGender"];
        $_SESSION["userCountry"] = $uidExists["userCountry"];
        header("location: ../users.php");
        exit();

    }
}

function emptyReset($oldPassword, $newPassword){
    $result;
    if(empty($oldPassword) || empty($newPassword)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function testePassword($conn, $password, $id){
    $sql = "SELECT userPassword FROM users WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);

    $passwordHashed = $row["userPassword"];
    
    $result;

    if(password_verify($password, $passwordHashed)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function resetPassword($conn, $oldPassword, $newPassword, $id){
    
    $option = testePassword($conn, $oldPassword, $id);


    if($option === false){
        header("location:db.inc.php");
    }else{
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET userPassword = ? WHERE userID = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "si", $hashedPassword, $id);
        mysqli_stmt_execute($stmt);

        header("location:../users.edit.php?ID=" . $id);
    }
}

function createEvent($conn, $name, $type, $capacity, $country, $schedule){
    $sql = "INSERT INTO events (eventName, eventType, eventCapacity, eventCountry, eventSchedule) VALUES (?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "ssiss", $name, $type, $capacity, $country, $schedule);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../events.php?error=none");
}

function emptyInputEvent($name, $type, $capacity, $country, $schedule){
    $result;
    if(empty($name) || empty($type) || empty($capacity) || empty($country) || empty($schedule)){
        $result = true;
    }else {
        $result = false;
    }
    return $result;
}

function updateUser($conn, $name, $email, $username, $age, $country, $gender, $admin, $id){ //function to check if user exists for sign up and also to fetch information for login
    $sql = "UPDATE users SET userName = ?, userEmail = ?, userUID = ?, userAge = ?, userCountry = ? , userGender = ?, userAdmin = ? WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../users.edit.php?error=stmtfailed&ID=" . $id);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssissii", $name, $email, $username, $age, $country, $gender, $admin, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php?error=none");
}

function updateEvent($conn, $name, $type, $capacity, $country, $schedule, $id){ //function to check if user exists for sign up and also to fetch information for login
    $sql = "UPDATE events SET eventName = ?, eventType = ?, eventCapacity = ?, eventCountry = ? , eventSchedule = ? WHERE eventsID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../events.edit.php?error=stmtfailed&ID=" . $id);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssi", $name, $type, $capacity, $country, $schedule, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../events.php?error=none");
}

function deleteEvent($conn, $id){
    $sql = "DELETE FROM events WHERE eventsId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../events.edit.php?error=stmtfailed&ID=" . $id);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../events.php?error=none");
}

function deleteUser($conn, $id){
    $sql = "DELETE FROM users WHERE userID = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../events.edit.php?error=stmtfailed&ID=" . $id);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php?error=none");
}

function addSignup($conn, $name, $id){
    $sql = "INSERT INTO signups (userID, eventId) VALUES (?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "ii", $name, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../eventsView.php?ID=" . $id . "&error=none");
}

function alreadySigned($conn, $name, $id){
    $sql = "SELECT * FROM signups WHERE userID = ? AND eventId = ?"; //check if email or username already exists
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ii", $name, $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    
    if($row = mysqli_fetch_assoc($resultData)){
        $result = true;
        return $result;
    }else{
        $result = false;
        return $result;
    }
}