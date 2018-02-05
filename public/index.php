<?php
	//phpinfo();
	$db = new PDO('mysql:host=db;dbname=test;charset=UTF-8', 'root', '');
	$ret = $db->query('select * from user');
	$rows = $ret->fetchAll(PDO::FETCH_ASSOC);
	foreach ($rows as $index => $row) {
		echo "$index: -----------------";
		print_r($row);
	}
	echo "query string --------------";
	print_r($_SERVER);
	//echo file_get_contents(realpath(__DIR__ . '/index.html'));
