<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);
	

	class myModel extends imodal{
		function body(){
			$dbc = $this->dbc;
			$menu = $dbc->GetRecord("cms_menu","*","id=".$this->param['id']);
			echo '<p>ต้องการลบเมนูนี้ใช่หรือไม่?</p>';
			echo '<h4>'.$menu['name'].'</h4>';
			
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_remove_menu","Remove Menu");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Remove","fn.app.menu.remove(".$_POST['id'].")")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
