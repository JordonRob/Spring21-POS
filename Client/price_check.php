<?php

require_once "../backend/add-delete_item.php";
require_once "../backend/dbcontroller.php";

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "securepos";

        // Create connection
        $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

       $search = empty($_POST['code']) ? '' : $_POST["code"];
                            $product_array = $db_handle->runQuery("SELECT * FROM products WHERE code = '$search'");
                            if (!empty($product_array)) {
                                foreach ($product_array as $key => $value) {
                                    echo "$" . $product_array[$key]["price"];
                                }
                            }
                            else {
                                echo "0 Results";
                            }      
        $conn->close();
?>
<html>
        <form method = "POST" action = "index.php" class="form-container">
            <div class="pcheck-popup">
                <input type = "submit" class = "button" id="returnbtn" value = "Return Home">
            </div>
        </form>
</html>