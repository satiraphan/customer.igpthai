<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "db_tags.id",
		"name" => "db_tags.name",
		"key_id" => "db_tags.key_id",
		"created" => "db_tags.created",
		"deleted" => "db_tags.deleted",
		"key_name" => "db_tag_keys.name"
	);

	$table = array(
		"index" => "id",
		"name" => "db_tags",
		"where" => "deleted IS NULL",
		"join" => array(
			array(
				"field" => "key_id",
				"table" => "db_tag_keys",
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
