<?php
	session_start();
	include_once "../../../../config/define.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	include_once "../../../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$os = new oceanos($dbc);
	$country = $dbc->GetRecord("db_countries","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);
	//$modal->setParam($_POST);
	$modal->setModel("dialog_edit_country","Edit Country");
	$modal->initiForm("form_editcountry","fn.app.database.country.edit()");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.database.country.edit()")
	));
	$modal->SetVariable(array(
		array("id",$country['id'])
	));
	
	
	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Country Name",
				"value" => $country['name']
			)
		),
		array(
			array(
				"name" => "local_name",
				"caption" => "Local Name",
				"placeholder" => "Local Country Name",
				"value" => $country['local_name']
			)
		),
		array(
			array(
				"name" => "iso",
				"caption" => "ISO",
				"flex" => 4,
				"placeholder" => "Abbreviation 2 Code",
				"value" => $country['iso']
			),
			array(
				"name" => "iso3",
				"caption" => "ISO3",
				"flex" => 4,
				"placeholder" => "Abbreviation 3 Code",
				"value" => $country['iso3']
			)
		),
		array(
			array(
				"name" => "phonecode",
				"caption" => "PhoneCode",
				"placeholder" => "Country Phone Code",
				"value" => $country['phonecode']
			)
		)
	);
	
	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>