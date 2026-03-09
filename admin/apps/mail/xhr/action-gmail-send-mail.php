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
    
	$service = new Gmail($client);
	$user = 'me';

    $to      =  $_POST['to'] ?? '';
    $subject =  $_POST['subject'] ?? '';
    $messageText = $_POST['body'] ?? '';

    // 2. สร้างโครงสร้าง Email (RFC 2822)
    $rawMessageString = "To: $to\r\n";
    $rawMessageString .= "Subject: =?utf-8?B?" . base64_encode($subject) . "?=\r\n"; // รองรับภาษาไทยใน Subject
    $rawMessageString .= "MIME-Version: 1.0\r\n";
    $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n"; // ส่งเป็น HTML
    $rawMessageString .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $rawMessageString .= $messageText;

    // 3. เข้ารหัสเป็น Base64Url (Gmail API ต้องการฟอร์แมตนี้)
    $base64SafeMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_', '=' => ''));

    // 4. สร้าง Object สำหรับส่ง
    $msg = new Google\Service\Gmail\Message();
    $msg->setRaw($base64SafeMessage);

    // 5. คำสั่งส่ง (Send)
    try {
        $service->users_messages->send('me', $msg);
        echo json_encode(['success' => true, 'msg' => 'ส่งอีเมลเรียบร้อยแล้ว']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'msg' => 'ส่งไม่สำเร็จ: ' . $e->getMessage()]);
    }

	
	$dbc->Close();
?>