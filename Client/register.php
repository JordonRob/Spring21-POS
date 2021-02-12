<?php

require_once "../backend/user_functions.php";
require_once "../backend/db_connection.php";

$conn = openConn();

$result = createUser($conn, "ADMIN", "USER", TRUE, "12345678");


echo "New ADMIN user with ID ".$conn->insert_id." created with password 12345678";
echo '<div><a href="login.php">Back to login</a></div>';

$conn->close();
?>