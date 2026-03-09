<?php
	global $os,$dbc;
	$datetime = $os->LoadSetting('datetime');
	$user = $dbc->GetRecord("os_users","*","id=".$os->auth['id']);
	$setting = json_decode($user['setting'],true);

	$mail = isset($setting['mail'])?$setting['mail']:array(
		"email" => "",
		"in" => array(
			"type" => "imap",
			"server" => "",
			"username" => "",
			"password" => "",
			"security" => "none",
			"port" => ""
		),
		"out" => array(
			"type" => "smtp",
			"server" => "",
			"username" => "",
			"password" => "",
			"security" => "none",
			"port" => ""
		)
	);

	$form = new iform($dbc,$os->auth);
	$form->setForm("form_savesetting");

	$form->SetVariable(array(
		array("user_id",$user['id'])
	));

	$blueprint = array(
		array(
			array(
				"caption" => "E-mail Address",
				"name" => "setting[mail][email]",
				"placeholder" => "Your E-Mail Address",
				"value" => $mail['email']
			)
		),
		"hr",
		array(
			array(
				"type" => "combobox",
				"flex" => 2,
				"source" => array(
					array("imap","IMAP"),
					array("pop","POP3"),
					array("gmail","Gmail Auth2")
				),
				"caption" => "Incoming Server",
				"name" => "setting[mail][in][type]",
				"value" => $mail['in']['type']
			),
			array(
				"flex" => 8,
				"name" => "setting[mail][in][server]",
				"placeholder" => "Your Server Address",
				"value" => $mail['in']['server']
			)
		),
		array(
			array(
				"caption" => "Username",
				"flex" => 5,
				"name" => "setting[mail][in][username]",
				"placeholder" => "Your Username",
				"value" => $mail['in']['username']
			),
			array(
				"type" => "password",
				"flex" => 5,
				"name" => "setting[mail][in][password]",
				"placeholder" => "Your Password",
				"value" => $mail['in']['password']
			)
		),
		array(
			array(
				"type" => "combobox",
				"source" => array(
					array("none","None"),
					array("ssl","SSL"),
					array("tls","TLS")
				),
				
				"flex" => 4,
				"caption" => "Security",
				"name" => "setting[mail][in][security]",
				"value" => $mail['in']['security']
			),array(
				"flex" => 4,
				"caption" => "Port Number",
				"name" => "setting[mail][in][port]",
				"value" => $mail['in']['port']
			)
		),
		"hr",
		array(
			array(
				"type" => "combobox",
				"flex" => 2,
				"source" => array(
					array("smtp","SMTP")
				),
				"caption" => "Outgoing Server",
				"name" => "setting[mail][out][type]",
				"value" => $mail['out']['type']
			),
			array(
				"flex" => 8,
				"name" => "setting[mail][out][server]",
				"placeholder" => "Your Server Address",
				"value" => $mail['out']['server']
			)
		),
		array(
			array(
				"caption" => "Username",
				"flex" => 5,
				"name" => "setting[mail][out][username]",
				"placeholder" => "Your Username",
				"value" => $mail['out']['username']
			),
			array(
				"type" => "password",
				"flex" => 5,
				"name" => "setting[mail][out][password]",
				"placeholder" => "Your Password",
				"value" => $mail['out']['password']
			)
		),
		array(
			array(
				"type" => "combobox",
				"source" => array(
					array("none","None"),
					array("ssl","SSL"),
					array("tls","TLS")
				),
				"flex" => 4,
				"caption" => "Security",
				"name" => "setting[mail][out][security]",
				"value" => $mail['out']['security']
			),array(
				"flex" => 4,
				"caption" => "Port Number",
				"name" => "setting[mail][out][port]",
				"value" => $mail['out']['port']
			)
		),
	);

	$form->setBlueprint($blueprint);
	
?>
<div class="row gutters-sm">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<?php
					$form->EchoInterface();
				?>
			</div>
			<div class="btn_group m-3">
				<button type="button" class="btn btn-primary" onclick="fn.app.profile.save_setting_email();"><i class="fa fa-save"></i> Save Settings</button>
				<button type="button" class="btn btn-secondary" onclick="$('form[name=form_savesetting]')[0].reset();"><i class="fa fa-undo"></i> Reset</button>	
			</div>
		</div>
	</div>
</div>