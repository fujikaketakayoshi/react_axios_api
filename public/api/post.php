<?php

$dbh = new PDO('mysql:host=localhost;dbname=axios_api', 'fjkk', '');

$result = null;

// error_log(var_export($_POST, true), 3, './log.txt');


if ( isset($_POST['title']) && isset($_POST['body']) ) {
	$sql = 'INSERT INTO posts (title, body) VALUE (?, ?)';
	$sth = $dbh->prepare($sql);
	$result = $sth->execute([$_POST['title'], $_POST['body']]);
}

header("Access-Control-Allow-Origin: *");
echo json_encode($result);