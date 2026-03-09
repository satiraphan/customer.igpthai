<?php
	session_start();
	include_once "../../../../config/define.php";
	@ini_set('display_errors',1);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	include_once "../../../../include/db.php";
	include_once "../../../../include/oceanos.php";
	include_once "../../../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	
	$os = new oceanos($dbc);
	$modal = new imodal($dbc,$os->auth);
	$modal->setModel("dialog_notify_setting_email","Email Setting");
	$modal->initiForm("form_notify_setting_email");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.setting.notify.save_setting_email()")
	));

	$setting = json_decode($os->load_variable("aNotifyEmailSetting","json"), true);

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "type",
				"caption" => "Type",
				"source" => array(
					array("smtp","SMTP Server"),
					array("gmail","Gmail")
				),
				"value" => isset($setting['type']) ? $setting['type'] : "smtp"
			)
		),array(
			array(
				"type" => "text",
				"name" => "server",
				"caption" => "Server",
				"placeholder" => "stmp.yourserver.com",
				"value" => isset($setting['server']) ? $setting['server'] : ""
			)
		),array(
			array(
				"type" => "text",
				"name" => "username",
				"caption" => "Username",
				"placeholder" => "Username",
				"value" => isset($setting['username']) ? $setting['username'] : ""
			)
		),array(
			array(
				"type" => "text",
				"name" => "password",
				"caption" => "Password",
				"placeholder" => "Password",
				"value" => isset($setting['password']) ? $setting['password'] : ""
			)
		),array(
			array(
				"type" => "text",
				"name" => "port",
				"caption" => "Port",
				"placeholder" => "Port",
				"value" => isset($setting['port']) ? $setting['port'] : "25"
			)
		),array(
			array(
				"type" => "combobox",
				"name" => "security",
				"caption" => "Security",
				"source" => array(
					array("none","None"),
					array("ssl","SSL"),
					array("tls","TLS")
				),
				"value" => isset($setting['security']) ? $setting['security'] : "none"
			)
		)
	);
	
	
	
	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>