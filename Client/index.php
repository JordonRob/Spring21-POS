<?php
require_once "../backend/login_check.php";
require_once "../backend/add-delete_item.php";
require_once "../backend/dbcontroller.php";
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SecurePOS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="overlay" id="return">
        <!--This is the overlay screen for returns-->
        <h1>Returns OverLay Screen</h1>
        <form action="" class="form-container">
            <label for="Product"><b>Product Name:</b></label><input type="text" placeholder="Product Name" name="Product" required />
            <br>
            <label for="Manufacturer"><b>Manufacturer</b></label>
            <input type="text" placeholder="Manufacturer" name="Manufacturer" required>
            <br>
            <label for="Price"><b>Retail Price $</b></label>
            <input type="text" placeholder="$9.99" name="Price" required>
            <br>
            <label for="Quantity"><b>Quantity:</b></label>
            <input type="text" placeholder="0" name="Quantity" required>
            <br>
            <button type="submit" class="btn">Return</button>
            <button type="button" class="btn cancel" onclick="close_returns()">Close</button>
        </form>
    </div>


    <div class="main-container" id="main-container">
        <!-- main container to hold all the elements of the SecurePOS-->

        <!-- this set of code belongs to the left side/static side of the POS-->
        <div class="left-side">
            <div class="static-container">
                <!-- this container will contain mostly static elements on the applcation-->
                <div class="function-buttons">
                    <!-- This div is for the function buttons-->
                    <button class="button" id="transaction-function" onclick="on_transaction()">Transaction Functions</button>
                    <button class="button" id="item-function" onclick="on_item()">Item Functions</button>
                    <button class="button" id="management-function" onclick="on_management()">Management Functions</button>
                    <a href="logout.php"><button class="button" id="lock-button">🔒</button></a>
                </div>

                <div class="item-description">
                    <!--This div is for the item description-->
                    <form action="index.php" method="post" id="code1">
                        <input type="search" id="code" name="code" style="background-color: rgb(253, 179, 152);" placeholder="Please enter Product Identification Code 'PIDC'">

                    </form>

                    <div class="cartDisplay" id="cartDisplay">
                        <div id="shopping-cart">

                            <?php
                            if (isset($_SESSION["cart_item"])) {
                                $total_quantity = 0;
                                $total_price = 0;
                                $coupon_amt = 0;
                                $tax = 0;
                                $final_total = 0;
                            ?>
                                <table class="tbl-cart" cellpadding="10" cellspacing="1">
                                    <tbody>
                                        <tr>
                                            <th style="text-align:left;">Name</th>
                                            <th style="text-align:left;">Code</th>
                                            <th style="text-align:right;" width="5%">Quantity</th>
                                            <th style="text-align:right;" width="10%">Unit Price</th>
                                            <th style="text-align:right;" width="10%">Price</th>
                                            <th style="text-align:center;" width="5%">Remove</th>
                                        </tr>
                                        <?php
                                        foreach ($_SESSION["cart_item"] as $item) {
                                            $item_price = $item["quantity"] * $item["price"];
                                        ?>
                                            <tr>
                                                <td><?php echo $item["name"]; ?></td>
                                                <td><?php echo $item["code"]; ?></td>
                                                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                                <td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
                                                <td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
                                                <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">🗑️</a></td>
                                            </tr>
                                        <?php
                                            $total_quantity += $item["quantity"];
                                            $total_price += ($item["price"] * $item["quantity"]);
                                            $tax += ($total_price * 0.08);
                                            $final_total = ($total_price + $tax);
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            <?php
                            } else {
                            ?>
                                <!--  <div class="no-records">Your Cart is Empty</div> -->
                            <?php
                            }
                            ?>
                        </div>

                        <div id="product-grid">
                            <!--     <div class="txt-heading">Products</div> -->
                            <?php
                            $search = empty($_POST['code']) ? '' : $_POST["code"];


                            $product_array = $db_handle->runQuery("SELECT * FROM products_new WHERE code= '$search'");
                            if (!empty($product_array)) {
                                foreach ($product_array as $key => $value) {
                            ?>
                                    <div class="product-item">
                                        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

                                            <div class="product-tile-footer">
                                                <div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
                                                <div class="product-price"><?php echo "$" . $product_array[$key]["price"]; ?></div>
                                                <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                                            </div>
                                        </form>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                            <!-- Coupon Search In Product Grid -->
                            <?php
                                $coupon_array = $db_handle->runQuery("SELECT * FROM Coupons WHERE code= '$search'");
                                if (!empty($coupon_array)) {
                                    foreach ($coupon_array as $key => $value) {
                                        $coupon_amt = $coupon_array[$key]["Price"];
                                        foreach ($_SESSION["cart_item"] as $item) {
                                        $iArray = array(0=>array('name'=>$coupon_array[$key]["Name"], 'code'=>$search, 'quantity'=>1, 'price'=>(0-$coupon_amt)));
                                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$iArray);
                            ?>
                                <div class="product-item" action = "index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                                    <form>
                                        <div class="product-tile-footer">
                                        <div class="product-title"><?php echo $coupon_array[$key]["Name"]; ?></div>
                                        <div class="product-price"><?php echo "$" . $coupon_array[$key]["Price"]; ?></div>
                                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Apply Discount" class="btnAddAction" /></div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                                     }  
                                }
                            }
                            ?>
                        </div>

                    </div>
                    <div id="final_checkout_details">
                        <table id="c_table">
                            
                            <tr>
                                <!-- This displays the Subtotal of the Transactions -->
                                <td colspan="2" align="right">Subtotal:</td>
                                <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                                <!-- This displays the tax of the Transactions -->
                                <td colspan="2" align="right">Tax:</td>
                                <td align="right"><?php echo "$" . number_format($tax, 2); ?></td>
                                <!-- This displays the final total of the Transactions -->
                                <td colspan="2" align="right">TOTAL:</td>
                                <td align="right"><?php echo "$" . number_format($final_total, 2); ?></td>
                                <td><a id="btnEmpty" href="index.php?action=empty">Empty Cart</a></td>



                                <td></td>
                            </tr>
                
                        </table>

                    </div>
                </div>
               
            </div>
            <div class="info-container">
                <!--this container will contain employee and system information-->
                <div id="todaysDate"></div> <!-- displays live clock for user-->
                <a> USER:<?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?> </a>




            </div>
        </div>
        <!--END OF LEFT-SIDE DIV-->

        <!-- this set of code will belong to the right side/dynamic side of the POS-->
        <div class="right-side">
            <div class="functions">
                <div id="transaction-overlay" onclick="off_transaction()">
                    <div class="functional-buttons">
                        <a href="index.php?action=discount"><button class="button2" id="discount" style="font-size: 32px;">Employee Discount</button></a>
                        <!--this will not have an overlay screen-->
                        <button class="button2" id="return" onclick="return_overlay()">Returns</button><br />
                        <button class="button2" id="Open" onclick="open_register()">Open Register</button>
                        <!--This will not have an overlay screen-->
                        <button class="button2" id="Micellaneous">Misc.</button>
                    </div>

                </div>
                <div id="item-overlay" onclick="off_item()">
                    <div class="functional-buttons">
                        <button class="button2" id="Priceheckform" onclick="OpenPriceCheck()">Price Check</button>
                        <button class="button2" id="add-inventory" onclick="Openinventory()">Add to Inventory</button><br />
                        <button class="button2" id="receipt">Receipt</button>
                        <button class="button2" id="add-coupons" onclick="Opencoupon()">Create Coupons</button><br />
                    </div>
                </div>
                <!--THESE ARE OVERLAYS, THAT WILL SHOW ADDITIONAL FUNCTION BUTTONS-->
                <div id="management-overlay" onclick="off_management()">
                    <div class="functional-buttons">
                        <button class="button2" id="void" onclick="Openvoid()">Void Transaction</button>
                        <a href="add_user.php"><button class="button2" id="add-user">Add User</button></a>
                        <button class="button2" id="z-report">Z-report</button>
                        <a href="header.php"><button class="button2" id="header">About</button></a>
                    </div>
                </div>

                <!------ This is the inventory form popup--->
                <div class="inventoryform-popup" id="Inventoryform">
                <form action="inventory.php" method="post" class="form-container">
                    <h1>Add to Inventory</h1>
                    <label><b>Product Name:</b></label> <input type="text" placeholder="Enter Product Name" name="name" required />
                    <br>
                    <label><b>Retail Price $</b></label>
                    <input type="text" placeholder="$0.00" name="price" required>
                    <br>
                    <label><b>Amount in Stock:</b></label>
                    <input type="text" placeholder="0" name="quantity" required>
                    <br>
                    <button type="submit" name="save" class="btn">Save</button>
                    <button type="submit" name="remove" class="btn">Remove</button>
                    <button type="button" class="btn cancel" onclick="Closeinventory()">Close</button>
                </form>
            </div>

                <!------ This is the price check form popup --->
                <?php
                $Code = "";
                if($_SERVER["REQUEST_METHOD"] == "POST")
                    {

	                $connection = mysqli_connect("localhost", "root", "theultimate50", "securepos");
	                if($connection){
		                    echo "";
	                }
	                else {
		                die("Connection failed. Reason: ". mysqli_connect_error());
	                }
                
	                $Code = $_POST["Code"];

	                $sql = "SELECT price FROM products_new WHERE Code ='". $Code ."'";

	                $results = mysqli_query($connection, $sql);

	                if(mysqli_num_rows($results)>0) {
		                while($row = mysqli_fetch_array($results)) {
                            echo "Price: " . $row[0]; 
                        }
                    }
                 }
            ?>
                <div class ="pricecheckform-popup" id = "PriceCheckform">
                    <form action="" method= "POST" class= "form-container">
                    <form method = "post">
                        Code: <input type = "text" name = "Code"> <br>
                        Price: <br>
	                    <input type = "submit" class = "btn" value = "Submit">
                        <button type="button" class="btn cancel" onclick="Closepricecheck()">Close</button> 
                        <input name="reset" type="reset" class="reset_button" />
                    </form>
                </div>

                <!------ This is the coupon form popup--->
                <div class="couponform-popup" id="Couponform">
                    <form action="/add_coup.php" method="POST" class="form-container">
                        <h1>Create Coupon</h1>
                        <label for="Product"><b>Product Name:</b></label> <input type="text" placeholder="Enter Product Name" name="Name" required />
                        <br>
                        <label for="Code"><b>Code:</b></label>
                        <input type="text" placeholder="Enter Coupon Code" name="Code" required>
                        <br>
                        <label for="Price"><b>Discount Price:</b></label>
                        <input type="text" placeholder="Enter Coupon Price" name="Price" required>
                        <br>
                        <button type="submit" class="btn">Save</button>
                        <button type="button" class="btn cancel" onclick="Closecoupon()">Close</button>
                    </form>
                </div>

            </div>

            <!---- This is the void popup--->
            <div class="voidform-popup" id="Voidform">
                <form action="" class="form-container">
                    <h2>"Are you sure you want to void this transaction?"</h2>
                    <br>
                    <br>
                    <button type="submit" class="btn">Okay</button>

                    <button type="button" class="btn cancel" onclick="Closevoid()">Close</button>
                </form>
            </div>

            <div class="keypad">
                <!-- The following code represents our number pad with button press functionality-->
                <ul id="numpad">
                    <li class="letter" name="1" value="1" id="1" onclick="addNumber(this)">1</li>
                    <li class="letter" name="2" value="2" id="2" onclick="addNumber(this)">2</li>
                    <li class="letter" name="3" value="3" id="3" onclick="addNumber(this)">3</li>

                    <li class="letter clearl" name="4" value="4" id="4" onclick="addNumber(this)">4</li>
                    <li class="letter" name="5" value="5" id="5" onclick="addNumber(this)">5</li>
                    <li class="letter" name="6" value="6" id="6" onclick="addNumber(this)">6</li>

                    <li class="letter clearl" name="7" value="7" id="7" onclick="addNumber(this)">7</li>
                    <li class="letter " name="8" value="8" id="8" onclick="addNumber(this)">8</li>
                    <li class="letter" name="9" value="9" id="9" onclick="addNumber(this)">9</li>

                    <li class="switch" name="." value="." id="." onclick="addNumber(this)">.</li>
                    <!--There is a bug with this button needs to be fixed-->
                    <li class="letter" name="0" value="0" id="0" onclick="addNumber(this)">0</li>
                    <li class="delete" onclick="backSpace()"> back </li>

                    <li class="enter">ENTER</li>
                </ul>

            </div>

            <div class="checkout">
                <button class="button3" id="cash-button">Cash</button>
                <button class="button3" id="credit-button">Credit</button>
                <button class="button3" id="debit-button">Debit</button>
            </div>

        </div>
        <!--END OF RIGHT-SIDE DIV-->
    </div>
    <!--END OF MAIN-CONTAINER-->


    <script src="script.js"></script>

    <script>
        function doDate() {
            var str = "";

            var days = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
            var months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

            var now = new Date();

            str += "Today is: " + days[now.getDay()] + ", " + now.getDate() + " " + months[now.getMonth()] + " " + now.getFullYear() + " " + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
            document.getElementById("todaysDate").innerHTML = str;

        }
        setInterval(doDate, 1000);
    </script>


</body>

</html>
