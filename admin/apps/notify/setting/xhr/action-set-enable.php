<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	$setting = json_decode($os->load_variable("aNotifySetting","json"), true);

	$enable_key = "notify_" . $_POST['type'] . "_enabled";
	$setting[$enable_key] = ($_POST['enable'] == "true") ? true : false;

	
	if($_POST['type'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Type is required"
		));
		exit;
	}else{
		$os->save_variable("aNotifySetting",json_encode($setting,JSON_UNESCAPED_UNICODE));
		$os->save_log(0,$_SESSION['auth']['user_id'],"notify-setting","edit",array("setting" => $setting));
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Setting updated"
		));

	}
	
	
	
	
	
	
	$dbc->Close();
?>