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
	$file_path = '../../../binary/patch.zip';
	$active_dir = '../../../';
	$output = shell_exec("pwd");
	print_r($output);

	$command = "unzip $file_path";

	//exec("unzip $file_path -d $active_dir",$output,$code);
	$output = shell_exec($command);
	
	
	print_r($output);


	
/*
	$zip = new ZipArchive;
	$res = $zip->open('../../../binary/patch.zip');
	if ($res === TRUE) {
		$zip->extractTo('../../../');
		$zip->close();
  	echo json_encode(array(
			'success'=>true
		));
	} else {
		echo json_encode(array(
			'success'=>false,
			'msg'=>"File Not Ready"
		));
	}
*/

	$dbc->Close();
?>