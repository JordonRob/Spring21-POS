<?php
include '../backend/db_connection.php';

$conn = openConn();

echo "Connected successfully";

closeConn($conn);

?>