<!DOCTYPE html>
<html lang="en">   

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<title> Price Check Form</title>
<link rel="stylesheet" href="price_check.css">
</head>

<body>
    <div class="price-check-container">

        <div class = "header">
                Price Check
        </div>
        <div>
           <form action = " " method = "POST" >
                <input type = "text" name = "PIDC" class = "btn" placeholder = "ENTER PIDC">
                <input type="submit" name = "search" class = "btn" value = "Find Price"> 
            </form> 

        <?php
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, 'securepos');

        if(isset($_POST['search']))
        {
            $PIDC = $_POST['PIDC'];

            $query = "SELECT price FROM 'strproducts' where PIDC = '$PIDC'";
            $query_run = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($query_run))
            {
                ?>

                <h1> <?php echo $row['price'] ?> </h1>

                <?php
            }
        }
        ?>
        </div>


    <form method = "POST" action = "index.php">
            <div class="PIDCbox">
                <input type = "submit" class = "button" id="returnbtn" value = "Return Home">
            </div>
    </form>

</body>
</html>
