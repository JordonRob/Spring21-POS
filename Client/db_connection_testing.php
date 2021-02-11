<?php
include '../backend/db_connection.php';

$conn = openConn();

echo "<div>Connected successfully</div>";

closeConn($conn);

?>