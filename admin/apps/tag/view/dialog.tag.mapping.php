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
	$tag = $dbc->GetRecord("db_tags","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_mapping_tag","Mapping Tag");
	$modal->initiForm("form_mappingtag");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.tag.tag.mapping()")
	));
	$modal->SetVariable(array(
		array("id",$tag['id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Tag Name",
				"value" => $tag['name'],
				"disabled" => true
			)
		),
		array(
			array(
				"type" => "comboboxdb",
				"name" => "key_id",
				"caption" => "Key",
				"source" => array(
					"table" => "db_tag_keys",
					"name" => "name",
					"value" => "id"
				),
				"default" => array(
					"name" => "ไม่ระบุ",
					"value" => "NULL",
				),

				"value" => $tag['key_id']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>