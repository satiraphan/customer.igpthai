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
	$modal->setModel("dialog_add_menu","Add Menu");
	$modal->initiForm("form_add_menu");
	$modal->setExtraClass("modal-md");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.menu.add()")
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Menu Name"
			)
		),
		array(
			array(
				"type" => "comboboxdb",
				"name" => "page_id",
				"caption" => "Page",
				"source" => array(
					"table" => "cms_pages",
					"name" => "name",
					"value" => "id",
				),
				"default" => array(
					"name" => "None",
					"value" => "null"
				)
			)
		),
		array(
			array(
				"type" => "checkbox",
				"name" => "status",
				"caption" => "Status",
				"text" => "เปิดการใช้งาน",
				"value" => true
			)
		),
		array(
			array(
				"type" => "comboboxdb",
				"name" => "parent",
				"caption" => "Parent",
				"source" => array(
					"table" => "cms_menu",
					"name" => "name",
					"value" => "id",
				),
				"default" => array(
					"name" => "None",
					"value" => "null"
				)
			)
		),
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();

?>
