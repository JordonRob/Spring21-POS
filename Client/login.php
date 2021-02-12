<?php
session_start();

//check if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header("location: index.php");
    exit;
}

// Load our config
$config = parse_ini_file("../backend/config.ini");

require_once "../backend/db_connection.php";

$mysqli = openConn();

// Define some empty variables
$username = $password = "";
$username_error = $password_error = "";

// Processing the form's data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if the username/ID is blank
    if(empty(trim($_POST["username"]))) {
        $username_error = "Please enter a ID.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))) {
        $password_error = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Now we validate
    if(empty($username_error) && empty($password_error)) {
        //Prepping our SELECT statement
        $sql = "SELECT id, firstname, lastname, password FROM users WHERE id = ?";

        if ($statement = $mysqli->prepare($sql)) {
            // Bind parameters
            $statement->bind_param("s", $param_username);

            // Set those parameters
            $param_username = $username;

            // Attempt execution
            if($statement->execute()) {
                // Store our result
                $statement->store_result();

                //Check to see if an entry for the given ID even exists, then veryify the password
                if ($statement->num_rows == 1) {
                    //Bind results
                    $statement->bind_result($id, $firstname, $lastname, $hashed_password);

                    if($statement->fetch()) {
                        if(password_verify($password, $hashed_password)) {
                            //Pass is correct
                            session_start();

                            //Store the data in the session vars
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["firstname"] = $firstname;
                            $_SESSION["lastname"] = $lastname;

                            //Finally redirect the user
                            header("location: index.php");
                        } else {
                            // Password was wrong, notify user
                            $password_error = "The password or ID was not valid.";
                        }
                    }
                } else {
                    // User doesn't exist so send error.
                    $username_error = "The password or ID was not valid.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later!";
            }

        }
        $mysqli->close();
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SecurePOS</title>
<link rel="stylesheet" href="login.css">
</head>

<body>
<div class = "login-container">
   
    
    <div class ="header"> 
        SECUREPOS SYSTEM
    </div>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
        <div class="form-group">
            <input class = "username" type="text" id = "username" name="username" placeholder = "ENTER ID" />
            <span class="help-block"><?php echo $username_error; ?></span>
        </div>
        <div class="form-group">
            <input class = "password" type="text" id = "password"  name="password" placeholder= "ENTER PASSWORD"/>
            <div><span class="help-block"><?php echo $password_error; ?></span></div>
        </div>
        <div class="form-group">
            <input type="submit" class="button" value="Login">
        </div>
    </form>
    <a href="register.php" style="color:white;">Register Admin Account</a>
        
    
</div>

</body>
</html>