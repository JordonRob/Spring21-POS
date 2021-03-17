<?php
require_once "../backend/coupon_functions.php";
require_once "../backend/conn.php";

//Define empty variables
$result = $Name = $Code = $Price = "";
$Name_Error = $Code_Error = $Price_Error = "";
$Date_Created = date('Y-m-d H:i:s');

//Process data
// Check if request is a post

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

    header("location: index.php");

}

?>