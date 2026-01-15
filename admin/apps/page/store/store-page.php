<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "cms_pages.id",
		"name" => "cms_pages.name",
		"created" => "cms_pages.created",
		"updated" => "cms_pages.updated",
		"layout" => "cms_pages.layout",
		"status" => "cms_pages.status",
		"view" => "cms_pages.view",
	);

	$table = array(
		"index" => "id",
		"name" => "cms_pages",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
