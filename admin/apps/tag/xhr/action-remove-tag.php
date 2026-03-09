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

	foreach($_POST['items'] as $item){
		$tag = $dbc->GetRecord("db_tags","*","id=".$item);
		$dbc->Update("db_tags",array(
			"#deleted" => "NOW()"
		),"id=".$item);	
		$os->save_log(0,$_SESSION['auth']['user_id'],"tag-delete",$id,array("tags" => $tag));
	}

	$dbc->Close();
?>
