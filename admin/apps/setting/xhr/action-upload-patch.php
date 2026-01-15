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
	$os->set_upload_allow("zip");
	
	$path_begin = 'binary/';

	if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload file"
		));
	}else{
		$filename = $_FILES['file']['name'];
		$path = $path_begin."patch.zip";
		
		try{
			$uploaded = $os->upload($_FILES['file'],"../../../".$path);
			if(!$uploaded['success']){
				echo json_encode(array(
					'success'=>false,
					'msg' => $uploaded['msg']
				));
			}else{
				echo json_encode(array(
					'success'=>true,
					'path' => "$path"
				));
			}
		} catch (Exception $e) {
			echo json_encode(array(
				'success'=>false,
				'msg' => $e
			));
		}
		
	}

	$dbc->Close();
?>