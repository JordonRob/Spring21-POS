<?php 

$msg = "";
    
    if(isset($_POST["upload"])) {
        // Set image placement folder
        $target = "header/" . basename($_FILES['image']['name']);
        
        $conn = mysqli_connect("localhost", "root", "", "securepos");
            if($conn -> connect_error){
                die("Connection Failed: ". $conn -> connect_error);
            }
        
            $image = $_FILES['image']['name'];

            $sql = "INSERT INTO header (image) VALUES ('$image')";
            mysqli_query($conn, $sql);

            if(move_uploaded_file($_FILES['image']['temp_name'], $target)){
                $msg = "Image uploaded successfully";
            }
            else{
                $msg = "There was a problem uploading that image";
            }
    }
?>