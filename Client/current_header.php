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
            <!--<th> Image </th>-->
            <?php
            $conn = mysqli_connect("localhost", "root", "", "securepos");
            if($conn -> connect_error){
                die("Connection Failed: ". $conn -> connect_error);
            }
            $sql = "SELECT address, manager, phone, tagline, image from header";
            $result = $conn -> query($sql);

            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    echo "<tr><td>" . $row["address"] ."</td><td>" . $row["manager"] ."</td><td>" . $row["phone"] ."</td><td>" . $row["tagline"] ."</td><td>" . "</td></tr>";
                }
                echo "</table>";
            }
            else {
                echo "No past information available";
            }
            $conn -> close();
            ?>

        </tr>
    </table>
    
    <a href="header.php"><input type = "submit" class = "button" id="editbtn" value = "Edit Current Information">
    <a href="index.php"><input type = "submit" class = "button" id="returnbtn" value = "Return Home">

</body>
</html>