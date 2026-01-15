<?php
	session_start();
	@ini_set('display_errors',1);
	include_once "../../config/define.php";
	include_once "../../include/db.php";
	include_once "../../include/concurrent.php";
	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$concurrent = new concurrent($dbc);
	
	$facebook_id = isset($_POST['facebook_id']) ? $_POST['facebook_id'] : '';
	$name = isset($_POST['name']) ? $_POST['name'] : '';
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$access_token = isset($_POST['access_token']) ? $_POST['access_token'] : '';
	
	if(empty($facebook_id)) {
		echo json_encode(array(
			"success" => false,
			"msg" => "Invalid Facebook ID"
		));
		$dbc->Close();
		exit;
	}
	
	// Verify Facebook access token (optional but recommended)
	$verify_url = "https://graph.facebook.com/me?access_token=" . $access_token . "&fields=id,name,email";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $verify_url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);
	curl_close($ch);
	
	$fb_data = json_decode($response, true);
	
	if(isset($fb_data['id']) && $fb_data['id'] == $facebook_id) {
		// Check if user exists with this Facebook ID
		if($dbc->HasRecord("os_contacts","facebook LIKE '".$facebook_id."'")){
			$contact = $dbc->GetRecord("os_contacts","id","facebook LIKE '".$facebook_id."'");
			$user = $dbc->GetRecord("os_users","*","contact = ".$contact['id']);
			echo $concurrent->login($user['id']);
		} else {
			// Check if email exists
			if(!empty($email) && $dbc->HasRecord("os_contacts","email LIKE '".$email."'")){
				// Link Facebook to existing account
				$contact = $dbc->GetRecord("os_contacts","id","email LIKE '".$email."'");
				$dbc->UpdateData("os_contacts", array("facebook" => $facebook_id), "id = ".$contact['id']);
				
				$user = $dbc->GetRecord("os_users","*","contact = ".$contact['id']);
				echo $concurrent->login($user['id']);
			} else {
				// Auto-register new user (optional)
				echo json_encode(array(
					"success" => false,
					"msg" => "User not found. Please register first or contact administrator.",
					"facebook_id" => $facebook_id,
					"email" => $email,
					"name" => $name
				));
			}
		}
	} else {
		echo json_encode(array(
			"success" => false,
			"msg" => "Invalid Facebook access token"
		));
	}
	
	$dbc->Close();
?>
