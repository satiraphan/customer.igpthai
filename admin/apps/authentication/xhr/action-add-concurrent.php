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


	if($dbc->HasRecord("os_concurrents","token = '".$_POST['token']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Concurrent token is already exist.'
		));
	}else{
		$data = array(
			"#id" => "DEFAULT",
			"token" => $_POST['token'],
			"#package" => $_POST['package'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"#status" => 1,
			"#session_id" => 'NULL',
			"#user_id" => 'NULL',
			"#user_name" => 'NULL',
			"#device" => 'NULL',
			"#login" => 'NULL',
			"#connected" => 'NULL',
			"#ip_address" => 'NULL',
			"#connect_counter" => 0,
		);

		if($dbc->Insert("os_concurrents",$data)){
			$concurrent_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $concurrent_id
			));

			$concurrent = $dbc->GetRecord("os_concurrents","*","id=".$concurrent_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"concurrent-add",$concurrent_id,array("concurrents" => $concurrent));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
