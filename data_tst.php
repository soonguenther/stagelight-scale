<?php
$included = true; // flag that tells connection info it is being "included"
include_once "connection_info.php";

$stmt = $pdo->prepare("select * from contacts");
$stmt->execute();
$arr  = $stmt->fetchAll();

if (!$arr) {
    exit('No rows');
}

echo "<body><p>All contacts</p><pre>";
var_export($arr);
echo "</pre></body>";
