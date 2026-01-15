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


	if($dbc->HasRecord("cms_pages","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Page Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			"name" => $_POST['name'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#deleated' => 'NULL',
			//"layout" => $_POST['layout'],
			"#status" => 0,
			"#view" => 0,
		);

		if($dbc->Insert("cms_pages",$data)){
			$page_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $page_id
			));

			$page = $dbc->GetRecord("cms_pages","*","id=".$page_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"page-add",$page_id,array("cms_pages" => $page));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
