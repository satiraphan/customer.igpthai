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
	$user = 'me';
    $msg = $service->users_messages->get($user, $_POST['msg_id']);

    $headers = $msg->getPayload()->getHeaders();
    $data = [];
    $data['id'] = $_POST['msg_id'];
    foreach ($headers as $header) {
        if ($header->getName() == 'Subject') { $data['subject'] = $header->getValue(); }
        if ($header->getName() == 'From') { $data['from'] = $header->getValue(); }
        if ($header->getName() == 'To') { $data['to'] = $header->getValue(); }
        if ($header->getName() == 'Date') { $data['date'] = $header->getValue(); }
    }

    function getBody($payload) {
        $body = "";
        if ($payload->getBody()->getData()) {
            $body = $payload->getBody()->getData();
        } else {
            $parts = $payload->getParts();
            foreach ($parts as $part) {
                if ($part->getMimeType() == 'text/html') { // ดึงแบบ HTML
                    $body = $part->getBody()->getData();
                    break;
                } else if ($part->getMimeType() == 'text/plain') { // ถ้าไม่มี HTML เอาแบบข้อความธรรมดา
                    $body = $part->getBody()->getData();
                }
            }
        }
        // ถอดรหัสจาก Base64URL เป็นข้อความปกติ
        $sanitizedData = strtr($body, '-_', '+/');
        return base64_decode($sanitizedData);
    }

    $content = getBody($msg->getPayload());
    $data['content'] = $content;

    $parts = $msg->getPayload()->getParts();
    $attachments = [];
    foreach ($parts as $part) {
        if ($part->getFilename() && $part->getBody()->getAttachmentId()) {
            $attachments[] = [
                'filename' => $part->getFilename(),
                'attachmentId' => $part->getBody()->getAttachmentId(),
                'mimeType' => $part->getMimeType()
            ];
        }
    }

    $data['attachments'] = $attachments; 

    function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g') {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        return $url;
    }

    // วิธีใช้: แยกอีเมลออกจาก String "Name <email@example.com>"
    preg_match('/<(.*?)>/', $data['from'], $matches);
    $senderEmail = isset($matches[1]) ? $matches[1] : $data['from'];
    $avatarUrl = get_gravatar($senderEmail);
    $data['avatar'] = $avatarUrl;

    echo json_encode(array(
        "success" => true,
        "data" => $data
    ));

	
	$dbc->Close();
?>