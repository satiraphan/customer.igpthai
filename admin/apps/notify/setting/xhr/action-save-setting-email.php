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
	
	$setting = json_decode($os->load_variable("aNotifyEmailSetting","json"), true);

	if($_POST['type'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Type is required"
		));
		exit;
	}else if($_POST['server'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Server is required"
		));
		exit;
	}else if($_POST['username'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Username is required"
		));
		exit;
	}else if($_POST['password'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Password is required"
		));
		exit;
	}else if($_POST['port'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Port is required"
		));
		exit;
	}else if($_POST['security'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=> "Security is required"
		));
		exit;
	}else{
		$os->save_variable("aNotifyEmailSetting",json_encode($setting,JSON_UNESCAPED_UNICODE));
		$os->save_log(0,$_SESSION['auth']['user_id'],"notify-setting-email","edit",array("setting" => $setting));
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));

	}
	
	
	
	
	
	
	$dbc->Close();
?>