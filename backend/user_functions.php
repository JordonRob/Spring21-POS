<?php

function createUser($conn, $firstname, $lastname, $is_management, $password) {
    $create_user_query = "INSERT INTO `users`(`firstname`, `lastname`, `is_management`, `password`) VALUES ('{$firstname}','{$lastname}','{$is_management}','{$password}')";
    if (!$conn->query($create_user_query) === TRUE) {
        echo "Error: " . $create_user_query . "<br>" . $conn->error;
        if ($conn->error == "Table 'securepos.users' doesn't exist") {
            // users table doesn't exist, will create and re-run the createUser function
            createTables($conn);
            createUser($conn, $firstname, $lastname, $is_management, $password);
        }
    }
}

?>