<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "os_schedules.id",
		"name" => "os_schedules.name",
		"type" => "os_schedules.type",
		"data" => "os_schedules.data",
		"created" => "os_schedules.created",
		"updated" => "os_schedules.updated",
	);

	$table = array(
		"index" => "id",
		"name" => "os_schedules",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
