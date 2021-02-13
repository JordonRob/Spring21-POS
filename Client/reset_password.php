<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Include config file
$config = parse_ini_file("../backend/config.ini");

require_once "../backend/db_connection.php";
require_once "../backend/user_functions.php";

$mysqli = openConn();
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Checks input for errors
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Something went wrong.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SecurePOS</title>
<link rel="stylesheet" href="reset.css">
</head>
<body>


<div class = 'reset-container'>

    <div class = 'header'>
        SECUREPOS SYSTEM
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"> 
        <div class="form-group">
            <input class = "username" type="text" id = "username" name="username" placeholder = "ENTER ID" />
            <span class="help-block"><?php echo $username_error; ?></span>
        </div>
        <div class="form-group">
            <input class = "new_password" type="text" id = "new_password"  name="new_password" placeholder= "ENTER NEW PASSWORD"/>
            <div><span class="help-block"><?php echo $password_error; ?></span></div>
        </div>
        <div class="form-group">
            <input type="submit" class="button" value="Submit">
        </div>
    </form>
    <a href="register.php" style="color:white;" <?php echo ($adminUserExists) ? 'hidden' : ''?> >Register Admin Account</a>


</div>
</body>
</html>