<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "os_files.id",
		"name" => "os_files.name",
		"path" => "os_files.path",
		"size" => "os_files.size",
		"mime" => "os_files.mime",
		"bucket" => "os_files.bucket",
		"deleted" => "os_files.deleted",
		"uploader" => "os_files.uploader",
		"uploaded" => "os_files.uploaded",
		"tags" => "GROUP_CONCAT(db_tags.name SEPARATOR ',')"
	);

	$table = array(
		"index" => "id",
		"name" => "os_files",
		"join" => array(
			array(
				"field" => "uploader",
				"table" => "os_users",
				"with" => "id"
			),
			array(
				"field" => "id",
				"table" => "os_file_tags",
				"with" => "file_id"
			),
			array(
				"join" => "os_file_tags",
				"field" => "tag_id",
				"table" => "db_tags",
				"with" => "id"
			)
		),
		"where" => "os_files.deleted IS NULL",
		"groupby" => "os_files.id"
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);

	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
