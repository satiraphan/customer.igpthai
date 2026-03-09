<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../../config/define.php";
	include "../../../include/db.php";
	include "../../../include/oceanos.php";
	include "../../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	require '../../../vendor/autoload.php';
	
	use Google\Client;
	use Google\Service\Gmail;

	$secret = json_decode($os->load_variable('aGoogleAuth','json'),true);
	if($secret == null){
		 echo json_encode(array(
            "success" => false,
             "msg" => "No Google Auth configuration found."
        ));
		exit;
	}

	$client = new Client();
	$client->setAuthConfig($secret); // ไฟล์ที่โหลดมาจาก Google Cloud
	$client->addScope(Gmail::GMAIL_READONLY);
	$client->setAccessType('offline');
	$client->setPrompt('consent');
	$client->setRedirectUri('http://maewnam.thddns.net:10580/callback/googe-auth.php');

	if($dbc->HasRecord("os_user_auth","user_id = '".$os->auth['id']."' AND provider = 'google'")) {
		$auth = $dbc->GetRecord("os_user_auth","token","user_id = '".$os->auth['id']."' AND provider = 'google'");
		if($auth['token'] == '') {
			 echo json_encode(array(
                "success" => false,
                "msg" => "No access token found. Please authenticate."
            ));
            exit;
		}else{
			$accessToken = json_decode($auth['token'], true);
			$client->setAccessToken($accessToken);
		}
	}

	if ($client->isAccessTokenExpired()) {
		// ถ้ามี Refresh Token ให้ขอใหม่
		if ($client->getRefreshToken()) {
            echo json_encode(array(
                "success" => false,
                "msg" => "Access token expired. Please refresh the token."
            ));
            exit;
		} else {
            echo json_encode(array(
                "success" => false,
                "msg" => "Access token expired and no refresh token available. Please re-authenticate."
            ));
            exit;
		}
	}

    $_POST['msg_id'] = isset($_POST['msg_id']) ? $_POST['msg_id'] : '';

	// 4. เรียกใช้ Gmail Service
	$service = new Gmail($client);
    
    $messageId = $_POST['msg_id']; // ไอดีของเมล์ที่ต้องการติดดาว
    $mods = new Google\Service\Gmail\ModifyMessageRequest();
    $mods->setAddLabelIds(['STARRED']); // เพิ่ม label STARRED

    try {
        $service->users_messages->modify('me', $messageId, $mods);
        echo json_encode(['success' => true, 'msg' => 'Starred successfully']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'msg' => $e->getMessage()]);
    }

	
	$dbc->Close();
?>