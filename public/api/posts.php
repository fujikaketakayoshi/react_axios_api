<?php

$dbh = new PDO('mysql:host=localhost;dbname=axios_api', 'fjkk', '');

$result = null;

if (isset($_GET['id'])) {
	$sth = $dbh->query('SELECT * FROM posts WHERE id = ' . $dbh->quote($_GET['id']));
	$sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
}else{
// 全件出力
}

	
header("Access-Control-Allow-Origin: *");
echo json_encode($result);