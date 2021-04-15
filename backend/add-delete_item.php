<?php

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			if(!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM products_new WHERE code='" . $_GET["code"] . "'");
				$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"]));
				
				if(!empty($_SESSION["cart_item"])) {
					if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($productByCode[0]["code"] == $k) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
			header('Location: index.php');
		break;
		case "remove":
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k) {
					if ($_GET["code"] == $k["code"]) {
						$key = array_search($k, $_SESSION["cart_item"]);
						unset($_SESSION["cart_item"][$key]);
					}
				}
			}
			header('Location: index.php');
		break;
		case "empty":
			unset($_SESSION["cart_item"]);
			header('Location: index.php');
		break;	
		case "discount":
			$total_price = 0;
			foreach ($_SESSION["cart_item"] as $item) {
				$total_price += ($item["quantity"] * $item["price"]);
			}
			$discountPrice = ($total_price * 0.10) * -1;
			$itemArray = array(0=>array('name'=>'Employee Discount', 'code'=>0, 'quantity'=>1, 'price'=>number_format($discountPrice, 2)));
			$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
			header('Location: index.php');
		break;
	}
}
?>
