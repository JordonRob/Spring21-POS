
<!--used for inventory table>
<?php
$servername='localhost';
$username='root';
$password='theultimate50';
$dbname = "securepos";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if(!$conn){
   die('Could not Connect My Sql:' .mysql_error());
}
?>
