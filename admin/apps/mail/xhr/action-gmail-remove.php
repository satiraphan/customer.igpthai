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
	$client->addScope(\Google\Service\Gmail::GMAIL_SEND);
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
    
	$service = new \Google\Service\Gmail($client);
	$user = 'me';

	// Ensure we have an array of IDs from the POST request
	$messageIds = $_POST['item'] ?? [];

	if (!empty($messageIds) && is_array($messageIds)) {
		$batchRequest = new \Google\Service\Gmail\BatchModifyMessagesRequest();
		$batchRequest->setIds($messageIds);

		// 1. Add TRASH label
		$batchRequest->setAddLabelIds(['TRASH']);

		// 2. IMPORTANT: Remove INBOX (and others) so it actually "disappears" 
		// from the current view and moves fully to the Trash.
		$batchRequest->setRemoveLabelIds(['INBOX', 'UNREAD']);

		try {
			$service->users_messages->batchModify($user, $batchRequest);
			echo json_encode(['success' => true, 'msg' => 'ลบสำเร็จ']);
		} catch (Exception $e) {
			echo json_encode(['success' => false, 'msg' => 'ลบไม่สำเร็จ: ' . $e->getMessage()]);
		}
	} else {
		echo json_encode(['success' => false, 'msg' => 'ไม่พบ ID ที่ต้องการลบ']);
	}
	
	$dbc->Close();
?>