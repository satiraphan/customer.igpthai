<?php
	global $os,$dbc;
	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_adduser");
	
	/*
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.accctrl.account.add()")
	));
	*/


	$blueprint = array(
	array(
		array(
			"name" => "username",
			"caption" => $os->tr('add.username.caption'),
			"placeholder" => $os->tr('add.username.placeholder')
		)
	),array(
		array(
			"type" => "password",
			"name" => "password",
			"caption" => $os->tr('add.password.caption'),
			"placeholder" => $os->tr('add.password.placeholder')
		)
	),array(
		array(
			"name" => "first",
			"caption" => "Name",
			"flex" => 5,
			"placeholder" => "Firstname"
		),array(
			"name" => "surname",
			"flex" => 5,
			"placeholder" => "Surname"
		)
	),array(
		array(
			"type" => "comboboxdatabank",
			"source" => "db_title",
			"flex" => 2,
			"name" => "title",
			"caption" => "Title"
		),array(
			"type" => "combobox",
			"source" => array(
				"male" => "Male",
				"female" => "Female"
			),
			"flex-label" => 1,
			"flex" => 2,
			"name" => "gender",
			"caption" => "Gender"
		),array(
			"type" => "date",
			"name" => "dob",
			"flex-label" => 1,
			"flex" => 4,
			"placeholder" => "Date of Birth",
			"caption" => "DOB"
		)
	),array(
		array(
			"type" => "comboboxdb",
			"source" => array( 
				"table" => "os_groups",
				"value" => "id",
				"name" => "name"
			),
			"flex" => 4,
			"name" => "gid",
			"caption" => "Group"
		),array(
			"name" => "nickname",
			"caption" => "Nickname",
			"flex" => 4,
			"placeholder" => "Nickname"
		)
	),array(
		array(
			"name" => "phone",
			"caption" => "Phone",
			"flex" => 4,
			"placeholder" => "Phone Number"
		),array(
			"name" => "mobile",
			"caption" => "Mobile",
			"flex" => 4,
			"placeholder" => "Mobile Number"
		)
	),array(
		array(
			"name" => "email",
			"caption" => "E-Mail",
			"placeholder" => "E-Mail"
		)
	),array(
		array(
			"name" => "address",
			"caption" => "Address",
			"placeholder" => "Address"
		)
	),array(
		array(
			"type" => "comboboxdb",
			"source" => array( 
				"table" => "db_countries",
				"value" => "id",
				"name" => "name"
			),
			"name" => "country",
			"caption" => "Country"
		)
	),array(
		array(
			"type" => "combobox",
			"flex" => 4,
			"name" => "city",
			"caption" => "Province"
		),array(
			"type" => "combobox",
			"flex" => 4,
			"name" => "district",
			"caption" => "District"
		)
	),array(
		array(
			"type" => "combobox",
			"flex" => 4,
			"name" => "subdistrict",
			"caption" => "Subdistrict"
		),array(
			"flex" => 4,
			"name" => "postal",
			"caption" => "Postal"
		)
	)

	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i><?php echo $os->tr('main.add');?></h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.user.add()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>