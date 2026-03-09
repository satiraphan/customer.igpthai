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


	if($dbc->HasRecord("db_tags","name = '".$_POST['name']."' AND deleted IS NULL")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Tag Name is already exist.'
		));
	}else{
		$data = array(
			"#id" =>"DEFAULT",
			"name" => $_POST['name'],
			"#key_id" => 'NULL',
			"#created" => 'NOW()',
			"#deleted" => 'NULL'
		);

		if($dbc->Insert("db_tags",$data)){
			$tag_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $tag_id
			));

			$tag = $dbc->GetRecord("db_tags","*","id=".$tag_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"tag-add",$tag_id,array("tags" => $tag));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
