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
	
	$aPath = array();
	$aError = array();
	
	$iVariable = "iPhoto";
	$path_begin = 'binary/photo/';
	
	
	if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{
		
		$iNumber = $os->load_variable($iVariable);
		for($i=0;$i<count($_FILES['file']);$i++){
			$file = array(
				"name" => $_FILES['file']["name"][$i],
				"type" => $_FILES['file']["type"][$i],
				"tmp_name" => $_FILES['file']["tmp_name"][$i],
				"error" => $_FILES['file']["error"][$i],
				"size" => $_FILES['file']["size"][$i]
			);
			
			
			$iNumber++;
			$filename = $file['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$path = $path_begin.$iNumber.".".$ext;
			
			try{
				$uploaded = $os->upload($file,"../../../".$path);
				if(!$uploaded['success']){
					array_push($aError,$path);
				}else{
					$os->save_variable($iVariable,$iNumber);
					array_push($aPath,$path);
				}
			} catch (Exception $e) {
				array_push($aError,$e);
			}
			
		}
		
		echo json_encode(array(
			'success'=>true,
			'path' => $aPath,
			'error' => $aError
		));

		
		
	}

	$dbc->Close();
?>