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
	$menu = $dbc->GetRecord("cms_menu","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_edit_menu","Edit Menu");
	$modal->initiForm("form_edit_menu");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.menu.edit()")
	));
	$modal->SetVariable(array(
		array("id",$menu['id'])
	));

$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Menu Name",
				"value" => $menu['name']
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
				),
				"value" => $menu['page_id']
			)
		),
		array(
			array(
				"type" => "checkbox",
				"name" => "status",
				"caption" => "Status",
				"text" => "เปิดการใช้งาน",
				"value" => $menu['status']==1?true:false
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
				),
				"value" => $menu['parent']	
			)
		),
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
