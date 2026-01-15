<?php
	session_start();
	use thiagoalessio\TesseractOCR\TesseractOCR;
	require_once "../../../vendor/autoload.php";

	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	
	
	@ini_set('display_errors',1);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$bError = false;

	$iVariable = "iOCRNumber";
	$path_begin = 'binary/ocr/';

	if($_FILES['file']['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please upload photo"
		));
	}else{
		$iNumber = $os->load_variable($iVariable);
		$iNumber++;
		
		$filename = $_FILES['file']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$path = $path_begin.$iNumber.".".$ext;
		
		try{
			$uploaded = $os->upload($_FILES['file'],"../../../".$path);
			if(!$uploaded['success']){
				$bError = true;
				echo json_encode(array(
					'success'=>false,
					'msg' => $uploaded['msg']
				));
			}else{
				$os->save_variable($iVariable,$iNumber);
				$bError = false;
				
			}
		} catch (Exception $e) {
			$bError = true;
			echo json_encode(array(
				'success'=>false,
				'msg' => $e
			));
		}

		if(!$bError){
			/*
			$ocr = new TesseractOCR($path);
			$ocr->lang('eng','tha');
			$ocr->executable('/usr/local/Cellar/tesseract/4.1.1/bin/tesseract');
			echo $ocr->run();
			*/

			$text =  (new TesseractOCR("../../../".$path))->lang('tha','eng')->executable('tesseract')->run();
			echo json_encode(array(
				'success'=>true,
				'path' => "$path",
				'text' => trim($text)
			));
		}
		
	}

	$dbc->Close();
?>