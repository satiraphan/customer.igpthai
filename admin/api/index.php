<?php
	$path = trim($_SERVER['REQUEST_URI'], '/');

	// ตัดคำว่า api/ ออก
	$path = substr($path, 4); // remove "api/"

	switch ($path) {
		case 'auth/login':
			require 'auth/login.php';
			break;
		case 'user/list':
			require 'user/list.php';
			break;
		case 'user/detail':
			require 'user/detail.php';
			break;
		default:
			http_response_code(404);
			echo json_encode(['error' => 'API route not found', 'path' => $path]);
	}
?>
