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

	$modal = new imodal($dbc,$os->auth);
	$modal->setModel("dialog_add_concurrent","Add Concurrent");
	$modal->initiForm("form_addconcurrent");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.authentication.concurrent.add()")
	));

	$blueprint = array(
		array(
			array(
				"name" => "token",
				"caption" => "Token",
				"placeholder" => "Token"
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
				)
			)
		),array(
			array(
				"type" => "input-group",
				"caption" => "Input",
				"items" => array(
					array(
						"type" => "icon",
						"icon" => "fa fa-pen"
					),
					array(
						"name" => "token2",
						"caption" => "Token2",
						"placeholder" => "Token2"
					
					)
				)
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();

?>
