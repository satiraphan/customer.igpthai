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

	if (isset($_POST['access_token']) && isset($_POST['facebook_id'])) {
		$facebook_id = $_POST['facebook_id'];
		$access_token = $_POST['access_token'];

		// 1. Verify Token โดยส่งไปที่ Facebook Graph API (ใช้ cURL แทน file_get_contents)
		$verify_url = "https://graph.facebook.com/me?access_token=" . urlencode($access_token) . "&fields=id,name,email";
		
		// ใช้ cURL เพราะ allow_url_fopen อาจถูก disable บน server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $verify_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$payload = json_decode($response, true);

		// ตรวจสอบความถูกต้องของ Payload และ Facebook ID
		if ($payload && isset($payload['id']) && $payload['id'] === $facebook_id) {

			$fb_id = $payload['id'];
			$email = isset($payload['email']) ? $payload['email'] : '';
			$name = isset($payload['name']) ? $payload['name'] : '';

			// 2. ค้นหาข้อมูลใน Database
			if ($dbc->hasRecord("os_user_auth","provider = 'facebook' AND auth_id = '".$dbc->Escape_String($fb_id)."'")) {

				$auth = $dbc->GetRecord("os_user_auth","*","provider = 'facebook' AND auth_id = '".$dbc->Escape_String($fb_id)."'");
				
				if ($auth) {
					// ทำการ Login
					if($concurrent->allow()){
						echo json_encode($concurrent->login($auth['user_id']));
					}else{
						echo json_encode(array(
							"success" => false,
							"msg" => "Concurrent is Limited!"
						));
					}
				} else {
					echo json_encode(["success" => false, "msg" => "User record not found for this contact."]);
				}
			} else {
				// ไม่พบ User (Registration Flow)
				echo json_encode([
					"success" => false,
					"action" => "register",
					"msg" => "Account not linked. Please contact admin.",
					'token' => $access_token,
					"facebook_id" => $fb_id,
					"email" => $email,
					"name" => $name
				]);
			}
		} else {
			echo json_encode(["success" => false, "msg" => "Invalid Facebook Token or ID mismatch"]);
		}
	} else {
		echo json_encode(["success" => false, "msg" => "Missing credential"]);
	}
	
	$dbc->Close();
?>
