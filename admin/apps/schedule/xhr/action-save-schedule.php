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

	
		$data = array(
			'type' => $_POST['type'],
			'data' => addslashes($_POST['data']),
			'#updated' => 'NOW()',
		);

		if($dbc->Update("os_schedules",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$schedule = $dbc->GetRecord("os_schedules","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"schedule-save",$_POST['id'],array("os_schedules" => $schedule));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
