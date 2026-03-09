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

	if(!$os->auth) die(json_encode(array('success'=>false,'message'=>'Authentication failed.')));
	
	$file = $dbc->GetRecord("os_files","*","id=".$_POST['id']);

	$dbc->Delete("os_file_tags","file_id=".$file['id']);
	if(isset($_POST['tags'])){
		foreach($_POST['tags'] as $tag){
			if($dbc->HasRecord("db_tags","name='".$tag."'")){
				// แท็กมีอยู่แล้ว
				$tag_record = $dbc->GetRecord("db_tags","*","name='".$tag."'");
				$tag_id = $tag_record['id'];
				// แท็กมีอยู่แล้ว

				// ถ้าแท็กถูกลบไปแล้ว ให้ทำการกู้คืน
				if($tag_record['deleted']!=null){
					$dbc->Update("db_tags",array('#deleted' => 'NULL'),"id=".$tag_id);
				}
			}else{
				$new_tag = array(
					"#id" => "DEFAULT",
					"name" => addslashes($tag),
					"#key_id" => "NULL",
					'#created' => 'NOW()',
					'#deleted' => 'NULL',
					"#color" => "NULL"
				);
				$dbc->Insert("db_tags",$new_tag);
				$tag_id = $dbc->GetID();
			}

			//ถ้ามีการเพิ่ม Tag แล้วต้องไม่เพิ่มออีก

			if(!$dbc->HasRecord("os_file_tags","file_id=".$file['id']." AND tag_id=".$tag_id)){
				$tag_data = array(
					"#id" => "DEFAULT",
					"file_id" => $file['id'],
					"tag_id" => $tag_id
				);
				$dbc->Insert("os_file_tags",$tag_data);
			}
		}

		echo json_encode(array('success'=>true,'message'=>'File tags updated successfully.'));
	}

	$dbc->Close();
?>
