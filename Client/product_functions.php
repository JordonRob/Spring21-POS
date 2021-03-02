<?php
function createProduct($conn, $ID, $PIDC, $Name, $Price) {
    $create_product_query = "INSERT INTO `strproducts`(`id`, `name`, `PIDC`, `price`) VALUES ('{$ID}','{$Name}','{$PIDC}','{$Price}')";
    $result = $conn->query($create_product_query);
    if (!$result === TRUE) {
        echo "Error: " . $create_product_query . "<br>" . $conn->error;
        if ($conn->error == "Table 'securepos.strproducts' doesn't exist") {
            // product table doesn't exist, will create and re-run the createUser function
            createTables($conn);
            createProduct($conn, $ID, $Name, $PIDC, $Price);
        }
    } else {
        return lookupProductByNameandPIDC($conn, $Name, $PIDC);
    }
}
function lookupProductByNameandPIDC($conn, $Name, $PIDC) {
    $select_query = "SELECT * FROM strproducts WHERE name = '{$Name}' AND PIDC = '{$PIDC}'";
    $result = $conn->query($select_query);

    if($result) {
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row;
            }
        } else {
            return false;
        }
    } else {
        return $conn->error;
    }
}
function doesProductExist($conn, $PIDC, $Name) {
    $select_query = "SELECT * FROM strproducts WHERE name = '{$Name}' AND PIDC = '{$PIDC}'";
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