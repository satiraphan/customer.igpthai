<?php
	session_start();
	include_once "../../../config/define.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);
	$concurrent = $dbc->GetRecord("os_concurrents","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_edit_concurrent","Edit Concurrent");
	$modal->initiForm("form_editconcurrent");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.authentication.concurrent.edit()")
	));
	$modal->SetVariable(array(
		array("id",$concurrent['id'])
	));

	
	$blueprint = array(
		array(
			array(
				"name" => "token",
				"caption" => "Token",
				"placeholder" => "Token",
				"value" => $concurrent['token']
			)
		),array(
			array(
				"name" => "package",
				"caption" => "Package",
				"type" => "combobox",
				"source" => array(
					array(1,"Novice"),
					array(2,"Professional"),
					array(3,"Advance")
				),
				"value" => $concurrent['package']
			)
		),array(
			array(
				"type" => "custom",
				"caption" => "Device",
				"html" => '<button onclick="fn.app.authentication.concurrent.append_device()" class="btn btn-primary">Add Device</button><div id="device_list"></div>',
			)
		)
	);
	

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
