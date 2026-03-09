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
			$items = isset($this->param['item'])?$this->param['item']:array();
			$removable = true;

			echo "<div class='alert alert-danger' role='alert'>";
				echo "<h4 class='alert-heading'>ต้องการลบรายการเหล่านี้หรือไม่?</h4>";
				echo "<p>ต้องการลบจำนวน " . count($items) . " รายการ</p>";
			echo "</div>";
			echo '<form id="form-remove-mail">';
				echo '<input type="hidden" name="type" value="gmail">';
			foreach($items as $item){
				echo '<input type="hidden" name="item[]" value="'.$item.'">';
			}
			echo '</form>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_remove_mail","Remove Mail");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Remove","fn.app.mail.gmail.remove()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
