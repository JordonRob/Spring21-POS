<?php

function openConn() {
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "securepos";

    $conn = new mysqli($dbhost, $dbuser, $dbpass);

    // Connect to the MySQL server
    if ($conn -> connect_errno) {
        echo "<div>Failed to connect to MySQL: " . $conn -> connect_error."</div>";
        exit();
    }

    // Check to see if securepos DB exists and if not create it
    if (!$conn->select_db($dbname)) {
        echo "<div>Couldn't select DB: " . $conn->error."</div>";
        if (!$conn->query("CREATE DATABASE IF NOT EXISTS ".$dbname.";")) {
            echo "<div>Couldn't create database: ".$conn->error."</div>";
        }
        echo "<div>Database has been created</div>";
        $conn->select_db($dbname);
        // We assume this is the first install so we'll create an admin user for administration.
        createAdminUser($conn);
    }
    
    createTables($conn);

    return $conn;
}

function closeConn($conn) {
    $conn -> close();
}

function createTables($conn) {
    $create_user_table = "CREATE TABLE IF NOT EXISTS `users`
    (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(60) NOT NULL,
    is_management BOOLEAN NOT NULL DEFAULT FALSE
    );";

    $create_tbl = $conn->query($create_user_table);
    if (!$create_tbl) {
        echo "<div>Table failed to create</div>";
    }
}

function createAdminUser($conn) {
    createTables($conn);
    $create_admin_user_query = "INSERT INTO `users`(`firstname`, `lastname`, `is_management`) VALUES ('ADMIN', 'USER', TRUE)";
    if ($conn->query($create_admin_user_query) === TRUE) {
        echo "<div>Administration user created.</div>";
    } else {
        echo "Error: " . $create_admin_user_query . "<br>" . $conn->error;
    }
}


?>