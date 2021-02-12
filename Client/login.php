<?php
session_start();

//Check if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.html");
    exit;
}

// Load our config
$config = parse_ini_file("../backend/config.ini");

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
        $link = openConn();
        //Prepping our SELECT statement
        $sql = "SELECT id, firstname, lastname, password FROM users WHERE id = ?";

        if ($statement = mysqli_prepare($link, $sql)) {
            // Bind parameters
            mysqli_stmt_bind_param($statement, "s", $param_username);

            // Set those parameters
            $param_username = $username;

            // Attempt execution
            if(mysqli_stmt_execute($statement)) {
                // Store our result
                mysqli_stmt_store_result($statement);

                //Check to see if an entry for the given ID even exists, then veryify the password
                if (mysqli_stmt_num_rows($statement) == 1) {
                    //Bind results
                    mysqli_stmt_bind_result($statement, $id, $firstname, $lastname, $hashed_password);

                    if(mysqli_stmt_fetch($statement)) {
                        if(password_verify($password, $hashed_password)) {
                            //Pass is correct
                            session_start();

                            //Store the data in the session vars
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["firstname"] = $firstname;
                            $_SESSION["lastname"] = $lastname;

                            //Finally redirect the user
                            header("location: index.html");
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

            // Now we close the MySQL connection
            closeConn($link);
        }
        closeConn($link);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SecurePOS</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="login.js"></script>
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
            <span class="help-block"><?php echo $password_error; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="button" value="Login">
        </div>
    </form>
        
    
</div>

</body>
</html>