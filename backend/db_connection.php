<?php

require_once "user_functions.php";
require_once "setup_functions.php";

$config = parse_ini_file("config.ini");

function openConn() {

    global $config;

    $conn = new mysqli($config["db_host"], $config["db_user"], $config["db_password"]);

    // Connect to the MySQL server
    if ($conn -> connect_errno) {
        echo "<div>Failed to connect to MySQL: " . $conn -> connect_error."</div>";
        exit();
    }

    // Check to see if securepos DB exists and if not create it
    if (!$conn->select_db($config["db_name"])) {
        echo "<div>Couldn't select DB: " . $conn->error."</div>";
        if (!$conn->query("CREATE DATABASE IF NOT EXISTS ".$config["db_name"].";")) {
            echo "<div>Couldn't create database: ".$conn->error."</div>";
        }
        echo "<div>Database has been created</div>";
        $conn->select_db($config["db_name"]);
        // We assume this is the first install so we'll create an admin user for administration.
        createUser($conn, "ADMIN", "USER", TRUE, "12345678");
    }
    
    createTables($conn);

    return $conn;
}

function closeConn($conn) {
    $conn -> close();
}

?>