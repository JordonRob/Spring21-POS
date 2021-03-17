<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "securepos";


        //undefined variables
        $Name = $Code = $Price = "";
        $t = time();
        $Date_Created = date('Y-m-d H:i:s', $t);
        
        // Create connection

        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);
        
        if (mysqli_connect_error()){
            die('Connect Error ('. mysqli_connect_errno() .') '. mysqli_connect_error());
        }
        
        else{
                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                    //Check if the fields are empty
                    if (empty(trim($_POST["Name"]))) {
                        $Name_Error = "Please enter a product name";
                    } else {
                        $Name = trim($_POST["Name"]);
                    }
                    if (empty(trim($_POST["Code"]))) {
                        $Code_Error = "Please enter a item discount code.";
                    } else {
                        $Code = trim($_POST["Code"]);
                    }
                    if (empty(trim($_POST["Price"]))) {
                        $Price_Error = "Please enter the coupon value.";
                    } else {
                        $Price = trim($_POST["Price"]);
                    }

                }

            $sql = "INSERT INTO Coupons (Name, Code, Price, Date_Created) values ('$Name','$Code','$Price','$Date_Created')";

            if ($conn->query($sql)){
                echo "New record is inserted sucessfully";
                }
                else{
                    echo "Error: ". $sql ."
                    ". $conn->error;

                    if($conn->error){

                        //creates Coupon table if not already created
                        
                        function createCoupon($conn, $Name, $Code, $Price) {
                            $create_coupon_query = "INSERT INTO `Coupons`(`Name`, `Code`, `Price`, `Date_Created`) VALUES ('{$Name}','{$Code}','{$Price}','{$Date_Created}')";
                            $result = $conn->query($create_coupon_query);
                            if (!$result === TRUE) {
                                echo "Error: " . $create_coupon_query . "<br>" . $conn->error;
                                if ($conn->error == "Table 'securepos.Coupons' doesn't exist") {
                                    // Coupon table doesn't exist, will create and re-run the createCoupon function
                                    createTables($conn);
                                    createCoupon($conn, $Name, $Code, $Price, $Date_Created);
                                }
                            } else {
                                echo "System Error";
                                header("location: index.php");
                            }
                        }

                    }
                }
                $conn->close();
        }

?>