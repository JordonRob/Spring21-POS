<?php
        $connection = mysqli_connect("localhost", "root", "");
        $db = mysqli_select_db($connection, 'securepos');

        if(isset($_GET['PIDC']))
        {
            $PIDC = $_GET['PIDC'];

            $query = "SELECT price FROM 'strproducts' where PIDC = '$PIDC'";
            $query_run = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($query_run))
            {
                ?>

                <h1> <?php echo "Price: " . $row['price'] ?> </h1>

                <?php
            }
        }
?>