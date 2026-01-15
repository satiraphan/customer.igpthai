<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/concurrent.php";
	include "../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	if(isset($_SESSION['auth'])){
		if($os->allow($_POST['appname'],"view")){
			echo json_encode(true);
		}else if(in_array($_POST['appname'],array("profile"))){
			echo json_encode(true);
		}else{
			echo json_encode(false);
		}
	}else{
		echo json_encode(false);
	}
	
	$dbc->Close();
?>