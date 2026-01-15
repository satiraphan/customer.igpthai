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

	foreach($_POST['items'] as $item){
		$cloud = $dbc->GetRecord("os_users","*","id=".$item);
		$dbc->Delete("os_users","id=".$item);
		$os->save_log(0,$_SESSION['auth']['user_id'],"cloud-delete",$id,array("os_users" => $cloud));
	}

	$dbc->Close();
?>
