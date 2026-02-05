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

	if($_POST['title'] == ""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Content Name is already exist.'
		));
	}else{
		$data = array(
			"type" => $_POST['type'],
			'#updated' => 'NOW()',
			"title" => addslashes($_POST['title']),
			"brief" => addslashes($_POST['brief']),
			"data" => addslashes($_POST['data'])
		);

		if($_POST['date_start']==""){$data['#date_start'] = "NULL";}else{$data['date_start'] = $_POST['date_start'];}
		if($_POST['date_end']==""){$data['#date_end'] = "NULL";}else{$data['date_end'] = $_POST['date_end'];}
		if($_POST['date_publish']==""){$data['#date_publish'] = "NULL";}else{$data['date_publish'] = $_POST['date_publish'];}
		if($_POST['date_terminate']==""){$data['#date_terminate'] = "NULL";}else{$data['date_terminate'] = $_POST['date_terminate'];}

		if($dbc->Update("cms_contents",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$content = $dbc->GetRecord("cms_contents","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"content-edit",$_POST['id'],array("cms_contents" => $content));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
