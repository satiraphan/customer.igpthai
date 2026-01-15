<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edituser");

	if(!$dbc->HasRecord("os_users","id=".$_GET['id'])){
		echo "No Users";
	}

	$user = $dbc->GetRecord("os_users","*","id=".$_GET['id']);
	$contact = $dbc->GetRecord("os_contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("os_address","*","contact=".$contact['id']);

	$modal->SetVariable(array(
		array("user_id",$user['id']),
		array("contact_id",$contact['id']),
		array("address_id",$address['id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "username",
				"caption" => "Name",
				"placeholder" => "User Name",
				"value" => $user['name']
			)
		),array(
			array(
				"type" => "password",
				"name" => "password",
				"caption" => "Password",
				"placeholder" => "Leave blank is No Change"
			)
		),array(
			array(
				"name" => "first",
				"caption" => "Name",
				"flex" => 5,
				"placeholder" => "Firstname",
				"value" => $contact['name']
			),array(
				"name" => "surname",
				"flex" => 5,
				"placeholder" => "Surname",
				"value" => $contact['surname']
			)
		),array(
			array(
				"type" => "comboboxdatabank",
				"source" => "db_title",
				"flex" => 2,
				"name" => "title",
				"caption" => "Title",
				"value" => $contact['title']
			),array(
				"type" => "combobox",
				"source" => array(
					"male" => "Male",
					"female" => "Female"
				),
				"flex-label" => 1,
				"flex" => 2,
				"name" => "gender",
				"caption" => "Gender",
				"value" => $contact['gender']
			),array(
				"type" => "date",
				"name" => "dob",
				"flex-label" => 1,
				"flex" => 4,
				"placeholder" => "Date of Birth",
				"caption" => "DOB",
				"value" => $contact['dob']
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
				"caption" => "Group",
				"value" => $user['gid']
			),array(
				"name" => "nickname",
				"caption" => "Nickname",
				"flex" => 4,
				"placeholder" => "Nickname",
				"value" => $contact['nickname']
			)
		),array(
			array(
				"name" => "phone",
				"caption" => "Phone",
				"flex" => 4,
				"placeholder" => "Phone Number",
				"value" => $contact['phone']
			),array(
				"name" => "mobile",
				"caption" => "Mobile",
				"flex" => 4,
				"placeholder" => "Mobile Number",
				"value" => $contact['mobile']
			)
		),array(
			array(
				"name" => "email",
				"caption" => "E-Mail",
				"placeholder" => "E-Mail",
				"value" => $contact['email']
			)
		),array(
			array(
				"name" => "address",
				"caption" => "Address",
				"placeholder" => "Address",
				"value" => $address['address']
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
				"caption" => "Country",
				"value" => $address['country']
			)
		),array(
			array(
				"type" => "comboboxdb",
				"source" => array( 
					"table" => "db_cities",
					"value" => "id",
					"name" => "name",
					"where" => "country = ".$address['country']
				),
				"flex" => 4,
				"name" => "city",
				"caption" => "Province",
				"value" => $address['city']
			),array(
				"type" => "comboboxdb",
				"source" => array( 
					"table" => "db_districts",
					"value" => "id",
					"name" => "name",
					"where" => "city = ".$address['city']
				),
				"flex" => 4,
				"name" => "district",
				"caption" => "District",
				"value" => $address['district']
			)
		),array(
			array(
				"type" => "comboboxdb",
				"source" => array( 
					"table" => "db_subdistricts",
					"value" => "id",
					"name" => "name",
					"where" => "district = ".$address['district']
				),
				"flex" => 4,
				"name" => "subdistrict",
				"caption" => "Subdistrict",
				"value" => $address['subdistrict']
			),array(
				"flex" => 4,
				"name" => "postal",
				"caption" => "Postal",
				"value" => $address['postal']
			)
		)
		
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Add User</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.user.edit()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>