<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "cms_contents.id",
		"type" => "cms_contents.type",
		"code" => "cms_contents.code",
		"created" => "cms_contents.created",
		"updated" => "cms_contents.updated",
		"deleted" => "cms_contents.deleted",
		"title" => "cms_contents.title",
		"brief" => "cms_contents.brief",
		"data" => "cms_contents.data",
		"date_start" => "cms_contents.date_start",
		"date_end" => "cms_contents.date_end",
		"date_publish" => "cms_contents.date_publish",
		"date_terminate" => "cms_contents.date_terminate",
		"status" => "cms_contents.status",
		"view" => "cms_contents.view",
		"thumbnail" => "cms_contents.thumbnail",
		"imgs" => "cms_contents.imgs",
		"user_id" => "cms_contents.user_id",
		"user" => "os_users.name"
	);

	$table = array(
		"index" => "id",
		"name" => "cms_contents",
		"join" => array(
			array(
				"field" => "user_id",
				"table" => "os_users",
				"with" => "id"
			)
		),
		"where" => "cms_contents.type LIKE '".$_GET['type']."'"
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
