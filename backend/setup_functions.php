<?php

function createTables($conn) {
    $create_user_table = "CREATE TABLE IF NOT EXISTS `users`
    (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(60) NOT NULL,
    is_management BOOLEAN NOT NULL DEFAULT FALSE,
    password VARCHAR(255) NOT NULL
    );";

    $create_tbl = $conn->query($create_user_table);
    if (!$create_tbl) {
        echo "<div>Table failed to create</div>";
    }
}

?>