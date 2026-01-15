<?php
	session_start();
	include_once "../../../../config/define.php";
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	include_once "../../include/engine.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	
	$forms = json_decode($os->load_variable('aFormMaker','json'),true);
	
	try {
		
		array_splice($forms,$_POST['position'],1);
		$item = $os->save_variable('aFormMaker',json_encode($forms,JSON_UNESCAPED_UNICODE));	
		
		echo json_encode(array(
			'success'=>true,
			'msg'=> "Passed"
		));
		
	} catch (Exception $e) {
		echo json_encode(array(
			'success'=>false,
			'msg'=> 'Caught exception: ',  $e->getMessage(), "\n"
		));
	}
	
	
	$dbc->Close();
?>