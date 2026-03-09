<?php
	session_start();
	@ini_set('display_errors',1);
	include_once "../../config/define.php";
	include_once "../../include/db.php";
	include_once "../../include/oceanos.php";
	include_once "../../include/concurrent.php";
	
	@ini_set('display_errors',1);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	if($_POST['email']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Please insert email!'
		));
	}if($_POST['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Please insert name!'
		));
	}if($_POST['password'] != $_POST['repassword']){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Passwords do not match!'
		));
	}else if($dbc->HasRecord("os_users","name = '".$_POST['email']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Email is already exists!'
		));
	}else{
				
		$data = array(
			'#id' => "DEFAULT",
			'title' => "",
			'name' => $_POST['name'],
			'surname' => $_POST['surname'],
			'nickname' => "",
			'gender' => "",
			'email' => $_POST['email'],
			'phone' => "",
			'mobile' => "",
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'status' => 1,
			'avatar' => $_POST['avatar']
		);
		
		$dbc->Insert("os_contacts", $data);
		$contact_id = $dbc->GetID();
		
		$data = array(
			'#id' => "DEFAULT",
			'address' => "",
			'#country' => 1,
			'#city' => 1,
			'#district' => 1,
			'#subdistrict' => 1,
			'postal' => "",
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#contact' => $contact_id,
			'#organization' => 'NULL',
			'priority' => 1
		);
		
		$dbc->Insert("os_address", $data);
		$address_id = $dbc->GetID();
		
		$display_name = $_POST['email'];
		if($_POST['name']!="")$display_name = $_POST['name'];
		if($_POST['surname']!="")$display_name .= " ".$_POST['surname'];
		
		$group_id = $os->load_variable("regsiter_default_group","number");
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_POST['email'],
			'#password' =>  "SHA2('".$_POST['password']."', 224)",
			'display' => $display_name,
			'status' => 1,
			'#created' => "NOW()",
			'#updated' => "NOW()",
			'#gid' => $group_id,
			'#contact' => $contact_id,
			'setting' => json_encode(array())
			
		);
		
		if($dbc->Insert("os_users",$data)){
			$user_id = $dbc->GetID();

			if($_POST['google_id']!=""){
				$data = array(
					'#id' => "DEFAULT",
					'#user_id' => $user_id,
					'provider' => "google",
					'auth_id' => $_POST['google_id'],
					'#created' => "NOW()"
				);
				$dbc->Insert("os_user_auth",$data);
			}
			
			if($_POST['facebook_id']!=""){
				$data = array(
					'#id' => "DEFAULT",
					'#user_id' => $user_id,
					'provider' => "facebook",
					'auth_id' => $_POST['facebook_id'],
					'#created' => "NOW()"
				);
				$dbc->Insert("os_user_auth",$data);
			}
			

			echo json_encode(array(
				'success'=>true,
				'msg'=> $user_id
			));
			
			
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>