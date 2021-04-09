<?php

require_once "../backend/user_functions.php";
require_once '../backend/db_connection.php';
include("upload_image.php");

$servername = "localhost";
$username = "username";
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
$result = $address = $manager = $phone = $tagline = $image = "";
$address_Error = $manager_Error = $phone_Error = $tagline_Error = $image_Error ="";


//Check request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["address"]))) {
        $address_Error = "Please enter a address #.";
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
    if (empty(trim($_POST["image"]))) {
        $image_Error = "Please enter the logo.";
    } else {
        $image = trim($_POST["image"]);
    } 

    $sql = "INSERT INTO header (address, manager, phone, tagline, image) values ('$address','$manager','$phone','$tagline','$image')";

    if ($conn->query($sql) == TRUE){
        echo "";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
            $conn->close();
    }

?>

<!---This page allows the manager to change the store information---->
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
                <input class="address" id="address" name="address" placeholder="Enter Address" />
                <p class="help-block"><?php echo $address_Error; ?></p>
            </div>
            <div class="center">
                <input class="manager" id="manager" name="manager" placeholder="Enter Manager" />
                <p class="help-block"><?php echo $manager_Error; ?></p>
            </div>
            <div class="center">
                <input class="phone" name="phone" id="phone" placeholder="Enter Phone Number" />
                <p class="help-block"><?php echo $phone_Error; ?></p>
            </div>
            <div class="center">
                <input class="tagline" name="tagline" id="tagline" placeholder="Enter Tagline" />
                <p class="help-block"><?php echo $tagline_Error; ?></p>
            </div>

      <!--  <div class= "image">
            <form action="upload_image.php" method="POST" enctype="multipart/form-data">
                <h3> Select Image File to Upload: </h3>
                <input type="file" name="file">
                <input type="submit" name="submit" value="Upload">
            </form>
        </div> -->


        <input type="submit" class="button1" value="Edit Information" />
            <p class="help-block"> <?php echo $result ?> </p>
        </form>
            

        <form method = "POST" action = "index.php">
            <div class="center">
                <input type = "submit" class = "button2" id="returnbtn" value = "Return Home">
            </div>
        </form>
        
    </div>

</body>

</html>