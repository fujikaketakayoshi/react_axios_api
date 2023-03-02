<?php

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Allow-Methods: POST, PUT, PATCH, DELETE, OPTIONS');
    exit;
}

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

$json = file_get_contents('php://input');
$data = json_decode($json, true);


error_log(var_export($data, true) . "\n", 3, './log.txt');

$dbh = new PDO('mysql:host=localhost;dbname=axios_api', 'fjkk', '');

$result = null;

// error_log(var_export($_POST, true), 3, './log.txt');

if ( isset($data['id']) ) {
	$sql = 'DELETE FROM posts WHERE id = ?';
	$sth = $dbh->prepare($sql);
	$result = $sth->execute([$data['id']]);
}

echo json_encode($result);
