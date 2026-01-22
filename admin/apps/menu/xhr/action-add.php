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


	if($dbc->HasRecord("cms_menu","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Menu Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			"name" => $_POST['name'],
			"#created" => 'NOW()',
			"#updated" => 'NOW()',
			"#status" => isset($_POST['status'])?1:0,
			"#page_id" => $_POST['page_id'],
			"#ordinal" => 999,
			"#parent" => $_POST['parent'],
			"#img_id" => "NULL",
		);

		if($dbc->Insert("cms_menu",$data)){
			$menu_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $menu_id
			));

			$menu = $dbc->GetRecord("cms_menu","*","id=".$menu_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"menu-add",$menu_id,array("cms_menu" => $menu));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
