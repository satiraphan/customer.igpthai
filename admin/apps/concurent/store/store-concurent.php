<?php
	session_start();
	ini_set('display_errors',1);
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";
	
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new datastore;
	$dbc->Connect();
	
	$columns = array(
		"id" => "os_concurrents.id",
		"token" => "os_concurrents.token",
		"package" => "os_concurrents.package",
		"created" => "os_concurrents.created",
		"updated" => "os_concurrents.updated",
		"status" => "os_concurrents.status",
		"session_id" => "os_concurrents.session_id",
		"user_id" => "os_concurrents.user_id",
		"user_name" => "os_concurrents.user_name",
		"device" => "os_concurrents.device",
		"login" => "os_concurrents.login",
		"connected" => "os_concurrents.connected",
		"ip_address" => "os_concurrents.ip_address",
		"connect_counter" => "os_concurrents.connect_counter",
		"display" => "os_users.display",
	);
	
	$table = array(
		"index" => "id",
		"name" => "os_concurrents",
		"join" => array(
			array(
				"field" => "user_id",
				"table" => "os_users",
				"with" => "id"
			)
		)
	);
	
	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());
	
	$dbc->Close();

?>



