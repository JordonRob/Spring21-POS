<?php

function createUser($conn, $firstname, $lastname, $is_management, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $create_user_query = "INSERT INTO `users`(`firstname`, `lastname`, `is_management`, `password`) VALUES ('{$firstname}','{$lastname}','{$is_management}','{$password_hash}')";
    $result = $conn->query($create_user_query);
    if (!$result === TRUE) {
        echo "Error: " . $create_user_query . "<br>" . $conn->error;
        if ($conn->error == "Table 'securepos.users' doesn't exist") {
            // users table doesn't exist, will create and re-run the createUser function
            createTables($conn);
            createUser($conn, $firstname, $lastname, $is_management, $password);
        }
    } else {
        return lookupUserByFirstnameAndLastname($conn, $firstname, $lastname);
    }
}

function lookupUserByFirstname($conn, $firstname) {
    $select_query = "SELECT * FROM users WHERE firstname = '{$firstname}'";
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

function lookupUserByFirstnameAndLastname($conn, $firstname, $lastname) {
    $select_query = "SELECT * FROM users WHERE firstname = '{$firstname}' AND lastname = '{$lastname}'";
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

function doesUserExist($conn, $firstname, $lastname) {
    $select_query = "SELECT * FROM users WHERE firstname = '{$firstname}' AND lastname = '{$lastname}'";
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