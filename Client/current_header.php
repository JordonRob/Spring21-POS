<!-- This page displays all the previously entered store information in a table -->
<!DOCTYPE html>
<html>
<head>
    <title>SecurePOS</title>
    <link rel="stylesheet" href="current_header.css">
</head>
<body>
    <header> Previously Used Store Information</header>
    <table>
        <tr>
            <th> Address </th>
            <th> Manager </th>
            <th> Phone Number </th>
            <th> Tagline </th>
            <?php
            // check connection to database
            $conn = mysqli_connect("localhost", "root", "theultimate50", "securepos");
            if($conn -> connect_error){
                die("Connection Failed: ". $conn -> connect_error);
            }

            // get the information from the database
            $sql = "SELECT address, manager, phone, tagline from header";
            $result = $conn -> query($sql);

            // print the results in a row of the table 
            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    echo "<tr><td>" . $row["address"] ."</td><td>" . $row["manager"] ."</td><td>" . $row["phone"] ."</td><td>" . $row["tagline"] ."</td><td>" . "</td></tr>";
                }
                echo "</table>";
            }
            else {
                echo "No past information available"; // print if no information has been added yet
            }
            $conn -> close();
            ?>

        </tr>
    </table>
    
    <a href="header.php"><input type = "submit" class = "button" id="editbtn" value = "Edit Current Information"> <!-- Edit the current information -->
    <a href="index.php"><input type = "submit" class = "button" id="returnbtn" value = "Return Home"> <!-- Returns back to the main application page -->

</body>
</html>