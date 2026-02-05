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
			'msg'=>'เหตุผล: หัวข้อไม่ควรเว้นว่าง'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			"type" => $_POST['type'],
			"#code" => 'NULL',
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#deleted' => 'NULL',
			"title" => addslashes($_POST['title']),
			"brief" => addslashes($_POST['brief']),
			"data" => addslashes($_POST['data']),
			"#status" => 1,
			"#view" => 0,
			"thumbnail" => '[]',
			"#imgs" => 'NULL',
			"#user_id" => $os->auth['id']
		);

		if($_POST['date_start']==""){$data['#date_start'] = "NULL";}else{$data['date_start'] = $_POST['date_start'];}
		if($_POST['date_end']==""){$data['#date_end'] = "NULL";}else{$data['date_end'] = $_POST['date_end'];}
		if($_POST['date_publish']==""){$data['#date_publish'] = "NULL";}else{$data['date_publish'] = $_POST['date_publish'];}
		if($_POST['date_terminate']==""){$data['#date_terminate'] = "NULL";}else{$data['date_terminate'] = $_POST['date_terminate'];}

		if($dbc->Insert("cms_contents",$data)){
			$content_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $content_id
			));

			$code = "CT-".str_pad($content_id,8,"0",STR_PAD_LEFT);
			$dbc->Update("cms_contents",array(
				"code" => $code
			),"id=".$content_id);

			$content = $dbc->GetRecord("cms_contents","*","id=".$content_id);
			$os->save_log(0,$os->auth['id'],"content-add",$content_id,array("cms_contents" => $content));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
