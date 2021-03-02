<?php

require_once "../backend/user_functions.php";
require_once "../backend/db_connection.php";

// Define empty values
$result = $firstname = $lastname = $password = "";
$firstname_error = $lastname_error = $password_error = "";

//Process data
// Check if request is a post
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Check if the fields are empty
    if (empty(trim($_POST["firstname"]))) {
        $firstname_error = "Please enter a firstname.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }
    if (empty(trim($_POST["lastname"]))) {
        $lastname_error = "Please enter a lastname.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }
    if (empty(trim($_POST["password"]))) {
        $password_error = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    $conn = openConn();
    if (!doesUserExist($conn, $firstname, $lastname)) {
        $user = createUser($conn, $firstname, $lastname, 0, $password);
        $result = "Added new user with ID {$user["id"]}";
        header("location: index.php");
    } else {
        $result = "A user with that first and last name already exists. If you'd like to create another user with that name please add a number to their lastname.";
    }
    $conn->close();
}



?>
<!---This page allows the manager to add a new user with an unused username and password---->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePOS</title>
    <link rel="stylesheet" href="add_user.css">
</head>

<body>
    <div class="new-user-container">


        <div class="header">
            ADD NEW USER
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" autocomplete="off">
            <div class="center">
                <input class="username" id="firstname" name="firstname" placeholder="ENTER FIRSTNAME" />
                <p class="help-block"><?php echo $firstname_error; ?></p>
            </div>
            <div class="center">
                <input class="username" id="lastname" name="lastname" placeholder="ENTER LASTNAME" />
                <p class="help-block"><?php echo $lastname_error; ?></p>
            </div>
            <div class="center">
                <input autocomplete="new-password" class="password" name="password" type="password" id="password" placeholder="ENTER PASSWORD" />
                <p class="help-block"><?php echo $password_error; ?></p>
            </div>
            <input type="submit" class="button" value="Add User" />
            <p class="help-block"><?php echo $result ?></p>
        </form>

        <form method = "POST" action = "index.php">
            <div class="center">
                <input type = "submit" class = "button" id="returnbtn" value = "Return Home">
            </div>
        </form>
        
    </div>

</body>

</html>