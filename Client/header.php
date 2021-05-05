<!---This page allows the manager to change the store information---->
<?php

require_once "../backend/user_functions.php";
require_once '../backend/db_connection.php';

$servername = "localhost";
$username = "root";
$password = "";
$db = "securepos";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";


/*
Test Case:
$sql = "INSERT INTO header (address, manager, phone, tagline, image) VALUES ('1 hawk drive', 'admin user', '(123)456-7890', 'securepos!', 'image.jpeg')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  $conn->close(); */


//Define empty variables
$result = $address = $manager = $phone = $tagline = "";
$address_Error = $manager_Error = $phone_Error = $tagline_Error = "";


//Check request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["address"]))) {
        $address_Error = "Please enter an address.";
    } else {
        $address = trim($_POST["address"]);
    }
    if (empty(trim($_POST["manager"]))) {
        $manager_Error = "Please enter the manager on duty.";
    } else {
        $manager = trim($_POST["manager"]);
    }
    if (empty(trim($_POST["phone"]))) {
        $phone_Error = "Please enter the phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }
    if (empty(trim($_POST["tagline"]))) {
        $tagline_Error = "Please enter the company tagline.";
    } else {
        $tagline = trim($_POST["tagline"]);
    }

    // insert the inputted information into the database table
    $sql = "INSERT INTO header (address, manager, phone, tagline, image) values ('$address','$manager','$phone','$tagline')";

    if ($conn->query($sql) == TRUE){
        echo "";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            $conn->close();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecurePOS</title>
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <div class="header-form">


        <div class="header">
            ABOUT
        </div>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" autocomplete="off">
        <div class="center">
                <input class="address" id="address" name="address" placeholder="Enter Address" /> <!-- Text box for address input -->
                <p class="help-block"><?php echo $address_Error; ?></p>
            </div>
            <div class="center">
                <input class="manager" id="manager" name="manager" placeholder="Enter Manager" /> <!-- Text box for manager name input -->
                <p class="help-block"><?php echo $manager_Error; ?></p>
            </div>
            <div class="center">
                <input class="phone" name="phone" id="phone" placeholder="Enter Phone Number" /> <!-- Text box for phone number input -->
                <p class="help-block"><?php echo $phone_Error; ?></p>
            </div>
            <div class="center">
                <input class="tagline" name="tagline" id="tagline" placeholder="Enter Tagline" /> <!-- Text box for company tagline input -->
                <p class="help-block"><?php echo $tagline_Error; ?></p>
            </div>
    
        <input type="submit" class="button1" value="Edit Information" /> <!-- Edit/Add the inputted information in the database button -->
           <p class="help-block"> <?php echo $result ?> </p>
        </form>
        
        <a href="current_header.php"><input type = "submit" class = "button2" id="editbtn" value = "Back"> <!-- Returns back to the table of information page -->
        

        <form method = "POST" action = "index.php">
            <div class="center">
                <input type = "submit" class = "button2" id="returnbtn" value = "Return Home"> <!-- Returns back to the main application page -->
            </div>
        </form>
        
    </div>

</body>

</html>