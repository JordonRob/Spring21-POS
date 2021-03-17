<?php
function createCoupon($conn, $Name, $Code, $Price) {
    $create_coupon_query = "INSERT INTO `Coupons`(`Name`, `Code`, `Price`, `Date Created`) VALUES ('{$Name}','{$Code}','{$Price}')";
    $result = $conn->query($create_coupon_query);
    if (!$result === TRUE) {
        echo "Error: " . $create_coupon_query . "<br>" . $conn->error;
        if ($conn->error == "Table 'securepos.Coupons' doesn't exist") {
            // Coupon table doesn't exist, will create and re-run the createCoupon function
            createTables($conn);
            createCoupon($conn, $Name, $Code, $Price);
        }
    } else {
        echo "System Error";
    }
}
function doesCouponExist($conn, $Name, $Code) {
    $select_query = "SELECT * FROM Coupons WHERE Name = '{$Name}' AND Code = '{$Code}'";
    $result = $conn->query($select_query);

    if ($result) {
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }

}

?>
