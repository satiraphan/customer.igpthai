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
	
	// Handle new Google Sign-In with JWT credential
	if(isset($_POST['credential'])) {
		// Verify Google token
		require_once '../../vendor/autoload.php';
		
		$client = new Google_Client(['client_id' => GOOGLE_CLIENT_ID]);
		try {
			$payload = $client->verifyIdToken($_POST['credential']);
			if ($payload) {
				$google_id = $payload['sub'];
				$email = $payload['email'];
				$name = $payload['name'];
				
				// Check if user exists
				if($dbc->HasRecord("os_contacts","google LIKE '".$google_id."'")){
					$contact = $dbc->GetRecord("os_contacts","id","google LIKE '".$google_id."'");
					$user = $dbc->GetRecord("os_users","*","contact = ".$contact['id']);
					echo $concurrent->login($user['id']);
				} else {
					// Auto-register new user (optional)
					echo json_encode(array(
						"success" => false,
						"msg" => "User not found. Please register first or contact administrator.",
						"google_id" => $google_id,
						"email" => $email
					));
				}
			} else {
				echo json_encode(array("success" => false, "msg" => "Invalid Google token"));
			}
		} catch (Exception $e) {
			echo json_encode(array("success" => false, "msg" => "Google verification failed: " . $e->getMessage()));
		}
	}
	// Handle legacy Google Sign-In
	else if(isset($_POST['google_id'])) {
		$google_id = $_POST['google_id'];
		
		if($dbc->HasRecord("os_contacts","google LIKE '".$google_id."'")){
			$contact = $dbc->GetRecord("os_contacts","id","google LIKE '".$google_id."'");
			$user = $dbc->GetRecord("os_users","*","contact = ".$contact['id']);
			echo $concurrent->login($user['id']);
		}else{
			echo json_encode(array(
				"success" => false,
				"msg" => "User not found!"
			));
		}
	} else {
		echo json_encode(array("success" => false, "msg" => "Invalid request"));
	}
	
	$dbc->Close();
?>