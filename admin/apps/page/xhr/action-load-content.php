<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$contents = array();
	$sql = "SELECT * FROM cms_contents WHERE status = 1";
	$rst = $dbc->Query($sql);
	while($line = $dbc->Fetch($rst)){
		$contents[] = $line;
	}

	echo json_encode(array(
		'success'=>true,
		'contents'=>$contents
	));

	$dbc->Close();
?>
