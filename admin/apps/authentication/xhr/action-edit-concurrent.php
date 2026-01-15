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

	if($dbc->HasRecord("os_concurrents","token = '".$_POST['token']."' AND id != ".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Concurrent token is already exist.'
		));
	}else{
		
		$devices = array();
		
		foreach($_POST['device'] as $item){
			array_push($devices,$item);
		}
		
		
		$data = array(
			"token" => $_POST['token'],
			"#package" => $_POST['package'],
			"device" => join(",",$devices),
			'#updated' => 'NOW()'
		);

		if($dbc->Update("os_concurrents",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$concurrent = $dbc->GetRecord("os_concurrents","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"concurrent-edit",$_POST['id'],array("concurrents" => $concurrent));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
