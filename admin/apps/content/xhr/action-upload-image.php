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

	$success = array();
	$fail = array();

	$iVariable = "iContentImageNumber";
	$path_begin = 'binary/content/';
	
	if(!$_FILES['file']){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{
		for($i=0;$i<count($_FILES['file']['name']);$i++){
			$iNumber = $os->load_variable($iVariable);
			$iNumber++;

			$_file = array(
				'name' => $_FILES['file']['name'][$i],
				'type' => $_FILES['file']['type'][$i],
				'tmp_name' => $_FILES['file']['tmp_name'][$i],
				'error' => $_FILES['file']['error'][$i],
				'size' => $_FILES['file']['size'][$i]
			);

			$filename =$_file['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$path = $path_begin.$iNumber.".".$ext;
			try{
				$uploaded = $os->upload($_file,"../../../".$path);
				if(!$uploaded['success']){
					array_push($fail,$filename." : ".$uploaded['msg']);
				}else{
					$os->save_variable($iVariable,$iNumber);
					array_push($success,$path);
				}
			}catch (Exception $e) {
				array_push($fail,$filename." : ".$e);
			}
		}

		echo json_encode(array(
			'success'=>true,
			'path' => $success,
			'failed' => $fail
		));
		
		
	}

	$dbc->Close();
?>