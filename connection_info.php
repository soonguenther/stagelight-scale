<?php
if( ! $included ) die("Cannot access this page directly");

$dsn = "mysql:host=mysqldb2018.cmxadjicvxtd.us-east-2.rds.amazonaws.com;dbname=ContactDB;charset=utf8mb4";
$options = [
    PDO::ATTR_EMULATE_PREPARES   => false,                  // turn off emulation mode for "real" prepared statements
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       //make the default fetch be an associative array
];

try {
    $pdo = new PDO($dsn, "mysqldb2018", "mysqldb2018", $options); // un and pw here
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('problem with db'); // check /var/log/apache2/error.log for details
}
