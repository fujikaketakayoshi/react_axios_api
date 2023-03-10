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

$dbh = new PDO('mysql:host=localhost;dbname=axios_api', 'fjkk', '');

$result = null;

// error_log(var_export($_POST, true), 3, './log.txt');

if ( isset($data['title']) && isset($data['body']) ) {
	$sql = 'INSERT INTO posts (title, body) VALUE (?, ?)';
	$sth = $dbh->prepare($sql);
	$result = $sth->execute([$data['title'], $data['body']]);
}

echo json_encode($result);