<?php
// /* Database credentials. Assuming you are running MySQL
// server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'gbin');
 
// /* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// // Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Server in the this format: <computer>\<instance name> or 
// <server>,<port> when using a non default port number


?>