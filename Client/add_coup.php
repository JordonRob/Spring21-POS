<?php
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "securepos";


        //undefined variables
        $Name = $Code =  "";
        $Price = 0;
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
                    if (empty(trim($_POST["cname"]))) {
                        $Name_Error = "Please enter a product name";
                    } else {
                        $Name = trim($_POST["cname"]);
                    }
                    if (empty(trim($_POST["coupon_sku"]))) {
                        $Code_Error = "Please enter a item discount code.";
                    } else {
                        $Code = trim($_POST["coupon_sku"]);
                    }
                    if (empty(trim($_POST["amount_deducted"]))) {
                        $Price_Error = "Please enter the amount to be deducted.";
                    } else {
                        $Price = trim($_POST["amount_deducted"]);
                    }

                    header("location: index.php");
                }

            $sql = "INSERT INTO coupons (cname, coupon_sku, amount_deducted, date_created) values ('$Name','$Code','$Price','$Date_Created')";

            if ($conn->query($sql)){
                echo "New record is inserted sucessfully";
                header("location: index.php");
                }
                else{
                    echo "Error: ". $sql ."
                    ". $conn->error;

                    if($conn->error){

                        //creates Coupon table if not already created
                        
                        function createCoupon($conn, $Name, $Code, $Price) {
                            $create_coupon_query = "INSERT INTO `coupons`(`cname`, `coupon_sku`, `amount_deducted`, `date_created`) VALUES ('{$Name}','{$Code}','{$Price}','{$Date_Created}')";
                            $result = $conn->query($create_coupon_query);
                            if (!$result === TRUE) {
                                echo "Error: " . $create_coupon_query . "<br>" . $conn->error;
                                if ($conn->error == "Table 'securepos.coupons' doesn't exist") {
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