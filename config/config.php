<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'fiot_losses');

// define('DB_SERVER', '192.168.1.100');
// define('DB_USERNAME', 'hdvn');
// define('DB_PASSWORD', 'Hdvn@01234');
// define('DB_NAME', 'fiot_hdvn_losses');

date_default_timezone_set("Asia/Ho_Chi_Minh");
/* Attempt to connect to MySQL database */
// public $abc = "ABCBCBASBACBASCB";
$connect = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
// $connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
mysqli_set_charset($connect, 'UTF8');

$servername = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname =DB_NAME;


$connectPDO = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password); 
// Check connection
if($connect->connect_error){
    die("ERROR: Could not connect. " . $connect->connect_error);
}
?>