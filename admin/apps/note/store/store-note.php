<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "os_notes.id",
		"title" => "os_notes.title",
		"content" => "os_notes.content",
		"created" => "os_notes.created",
		"updated" => "os_notes.updated",
		"deleted" => "os_notes.deleted",
		"user_id" => "os_notes.user_id",
		"pinned" => "os_notes.pinned",
		"username" => "os_users.name"
	);

	$table = array(
		"index" => "id",
		"name" => "os_notes",
		"join" => array(
			array(
				"field" => "user_id",
				"table" => "os_users",
				"with" => "id"
			)
		),
		"where" => "os_notes.deleted IS NULL"
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
