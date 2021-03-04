<?php
require_once "../backend/login_check.php"
?>


<!DOCTYPE html>


<html lang="en">

<head>
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
            <button type="button" class="btn cancel" onclick="return_overlay()">Close</button>
        </form>
    </div>


    <div class="main-container">
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
                    <form>
                        <input type="search" id="pic" name="pic" placeholder="Please enter Product Identification Code 'PIDC'">
                        <button>Add</button>
                    </form>

                    <div class="cartDisplay" id="cartDisplay">
                        <?php
                        session_start();
                        require_once "../backend/dbcontroller.php";
                        $db_handle = new DBController();
                        if (!empty($_GET["action"])) {
                            switch ($_GET["action"]) {
                                case "add":
                                    if (!empty($_POST["quantity"])) {
                                        $productByCode = $db_handle->runQuery("SELECT * FROM strproducts WHERE PIDC='" . $_GET["PIDC"] . "'");
                                        $itemArray = array($productByCode[0]["PIDC"] => array('name' => $productByCode[0]["name"], 'PIDC' => $productByCode[0]["PIDC"], 'price' => $productByCode[0]["price"]));

                                        if (!empty($_SESSION["cart_item"])) {
                                            if (in_array($productByCode[0]["PIDC"], array_keys($_SESSION["cart_item"]))) {
                                                foreach ($_SESSION["cart_item"] as $k => $v) {
                                                    if ($productByCode[0]["PIDC"] == $k) {
                                                        if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                            $_SESSION["cart_item"][$k]["quantity"] = 0;
                                                        }
                                                        $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                                    }
                                                }
                                            } else {
                                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                            }
                                        } else {
                                            $_SESSION["cart_item"] = $itemArray;
                                        }
                                    }
                                    break;
                            }
                        }
                        ?>

                        <div id="shopping-cart">
                            <div class="txt-heading">Shopping Cart</div>

                            <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
                            <?php
                            if (isset($_SESSION["cart_item"])) {
                                $total_quantity = 0;
                                $total_price = 0;
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
                                                <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                                                <td><?php echo $item["code"]; ?></td>
                                                <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                                                <td style="text-align:right;"><?php echo "$ " . $item["price"]; ?></td>
                                                <td style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
                                                <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                                            </tr>
                                        <?php
                                            $total_quantity += $item["quantity"];
                                            $total_price += ($item["price"] * $item["quantity"]);
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="2" align="right">Total:</td>
                                            <td align="right"><?php echo $total_quantity; ?></td>
                                            <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                            ?>
                                <div class="no-records">Your Cart is Empty</div>
                            <?php
                            }
                            ?>
                        </div>


                    </div>
                </div>
            </div>
            <div class="info-container">
                <!--this container will contain employee and system information-->
                <div id="todaysDate"></div> <!-- displays live clock for user-->

            </div>
        </div>
        <!--END OF LEFT-SIDE DIV-->

        <!-- this set of code will belong to the right side/dynamic side of the POS-->
        <div class="right-side">
            <div class="functions">
                <div id="transaction-overlay" onclick="off_transaction()">
                    <div class="functional-buttons">
                        <button class="button2" id="discount">Employee Discount</button>
                        <!--this will not have an overlay screen-->
                        <button class="button2" id="return" onclick="return_overlay()">Returns</button><br />
                        <button class="button2" id="Open">Open Register</button>
                        <!--This will not have an overlay screen-->
                        <button class="button2" id="Miscellaneous">Misc.</button>
                    </div>

                </div>
                <div id="item-overlay" onclick="off_item()">
                    <div class="functional-buttons">
                        <button class="button2" id="price-check">Price Check</button>
                        <button class="button2" id="add-inventory" onclick="Openinventory()">Add to Inventory</button><br />
                        <button class="button2" id="receipt">Receipt</button>
                        <button class="button2" id="Miscellaneous">Misc.</button>
                    </div>
                </div>
                <!--THESE ARE OVERLAYS, THAT WILL SHOW ADDITIONAL FUNCTION BUTTONS-->
                <div id="management-overlay" onclick="off_management()">
                    <div class="functional-buttons">
                        <button class="button2" id="void" onclick="Openvoid()">Void Transaction</button>
                        <a href="add_user.php"><button class="button2" id="add-user">Add User</button></a>
                        <button class="button2" id="z-report">Z-report</button>
                        <button class="button2" id="end-of-day">End of Day Report</button>
                    </div>
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
            <!------ This is the inventory form popup--->
            <div class="inventoryform-popup" id="Inventoryform">
                <form action="/action_page.php" class="form-container">
                    <h1>Add to Inventory</h1>
                    <label for="Product"><b>Product Name:</b></label> <input type="text" placeholder="Enter Product Name" name="Product" required />
                    <br>
                    <label for="Manufacturer"><b>Manufacturer</b></label>
                    <input type="text" placeholder="Manufacturer" name="Manufacturer" required>
                    <br>
                    <label for="Price"><b>Retail Price $</b></label>
                    <input type="text" placeholder="$0.00" name="Price" required>
                    <br>
                    <label for="Stock Amount"><b>Amount in Stock:</b></label>
                    <input type="text" placeholder="0" name="Stock Amount" required>
                    <br>
                    <button type="submit" class="btn">Save</button>
                    <button type="button" class="btn cancel" onclick="Closeinventory()">Close</button>
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
                    <li class="delete" onclick="backSpace()"> < </li>

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