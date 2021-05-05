<?php 
require_once "../backend/database.php";
    
if(isset($_POST['Return'])){  //checks to see if the form was submitted
//variables for each section of form
  echo "FORM";
    $PID = $_POST['PID'];
    $TID = $_POST['TID'];
    $timestamp = $_POST['timestamp'];
    $EID = $_POST['EID'];
    $reason = $_POST['reason'];


  
//insertion into database
   
       $query = "REPLACE INTO `returns`(PID,TID,timestamp,EID,reason) VALUES('$PID','$TID','$timestamp','$EID','$reason')";
   
       
  //checks to see if any errors
    if ((mysqli_query($conn, $query))){
            echo "New record created successfully !";
        ?> <link rel="stylesheet" href="add_user.css"> <form method = "POST" action = "index.php"> <div class="center">
        <input type = "submit" class = "button" id="returnbtn" value = "Return Home"><?php         }
    else {
            echo "Error: " . $query . "
    " . mysqli_error($conn);
         }
         mysqli_close($conn);
    }
    ?>
