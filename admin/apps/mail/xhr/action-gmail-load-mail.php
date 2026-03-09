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
    header('Content-Type: application/json; charset=utf-8');

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


    $_POST['msg_id'] = isset($_POST['msg_id']) ? trim($_POST['msg_id']) : '';
    if(!preg_match('/^[A-Za-z0-9_-]{10,200}$/', $_POST['msg_id'])){
        echo json_encode(array(
            "success" => false,
            "msg" => "Invalid message id"
        ));
        exit;
    }

	// 4. เรียกใช้ Gmail Service
	$service = new Gmail($client);
	$user = 'me';
    try {
        $msg = $service->users_messages->get($user, $_POST['msg_id']);
    } catch (Exception $e) {
        echo json_encode(array(
            "success" => false,
            "msg" => "Unable to load mail"
        ));
        exit;
    }

    $headers = $msg->getPayload()->getHeaders();
    $data = [];
    $data['id'] = $_POST['msg_id'];
    foreach ($headers as $header) {
        if ($header->getName() == 'Subject') { $data['subject'] = htmlspecialchars($header->getValue(), ENT_QUOTES, 'UTF-8'); }
        if ($header->getName() == 'From') { $data['from'] = htmlspecialchars($header->getValue(), ENT_QUOTES, 'UTF-8'); }
        if ($header->getName() == 'To') { $data['to'] = htmlspecialchars($header->getValue(), ENT_QUOTES, 'UTF-8'); }
        if ($header->getName() == 'Date') { $data['date'] = htmlspecialchars($header->getValue(), ENT_QUOTES, 'UTF-8'); }
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

    function sanitize_mail_html($html) {
        if ($html === null || $html === '') return '';
        $html = preg_replace('#<\s*(script|style|iframe|object|embed|form|meta|link|base)[^>]*>.*?<\s*/\s*\\1\s*>#is', '', $html);
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i', '', $html);
        $html = preg_replace('/\s(href|src)\s*=\s*("|\')\s*javascript:[^"\']*\2/i', '', $html);
        return $html;
    }

    $content = getBody($msg->getPayload());
    $data['content'] = sanitize_mail_html($content);

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