<?php
	session_start();
    $ExecutionStartTime = microtime(true);
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

    $_POST['label'] = isset($_POST['label']) ? $_POST['label'] : 'INBOX';
    $_POST['max'] = isset($_POST['max']) ? $_POST['max'] : 10;
	$token = $_POST['pageToken'] ?: null; // เปลี่ยนจาก 'page' มาเป็น 'pageToken'
	$_POST['page'] = isset($_POST['page']) ? $_POST['page'] : 1;
	$_POST['search'] = isset($_POST['search']) ? $_POST['search'] : '';

	$optParams = [
        'maxResults' => $_POST['max'],
        'labelIds'   => [$_POST['label']]
    ];

    // ถ้ามีการ Search ให้ใส่ใน q
    if (!empty($search)) {
        $optParams['q'] = $search;
    }

    // ถ้ามี Token หน้าถัดไปให้ใส่เข้าไป
    if (!empty($token)) {
        $optParams['pageToken'] = $token;
    }

	// 4. เรียกใช้ Gmail Service
	$service = new Gmail($client);
	$user = 'me';

    $aMessage = array();

	// ดึงรายการข้อความ (Messages)
	$results = $service->users_messages->listUsersMessages($user, $optParams);
	$messages = $results->getMessages();

	if ($messages) {
        // 2. เริ่มโหมด Batch Request
        $client->setUseBatch(true);
        $batch = $service->createBatch();

        foreach ($messages as $message) {
            // ดึงเฉพาะ Metadata และฟิลด์ที่จำเป็นเพื่อลดขนาดข้อมูล (ช่วยให้เร็วขึ้นอีก)
            $optParams = [
                'format' => 'metadata', 
                'metadataHeaders' => ['Subject', 'From', 'Date'],
                'fields' => 'id,labelIds,snippet,payload/headers'
            ];
            $batch->add($service->users_messages->get($user, $message->getId(), $optParams), $message->getId());
        }

        // 3. ส่ง Request ทั้งหมดไปพร้อมกัน
        $batchResults = $batch->execute();

        // 4. กลับสู่โหมดปกติเพื่อจัดการข้อมูล
        $client->setUseBatch(false);

        foreach ($messages as $message) {
            $msg = $batchResults['response-' . $message->getId()];
            
            // ตรวจสอบว่ามีข้อมูลส่งกลับมาจริง (ป้องกันเคส Error บางเมล์)
            if ($msg instanceof Google\Service\Gmail\Message) {
                $labelIds = $msg->getLabelIds() ?? [];
                $headers = $msg->getPayload()->getHeaders();
                $headerData = [];
                foreach ($headers as $header) {
                    $headerData[$header->getName()] = $header->getValue();
                }

                $rawDate = $headerData['Date'] ?? '';
                $cleanDate = preg_replace('/\s*\([^)]*\)\s*$/', '', $rawDate);
                try {
                    $date = new DateTime($cleanDate);
                } catch (Exception $e) {
                    $date = new DateTime('now');
                }

                $aMessage[] = array(
                    "id"      => $msg->getId(),
                    "starred" => in_array('STARRED', $labelIds),
                    "subject" => $headerData['Subject'] ?? '(No Subject)',
                    "snippet" => $msg->getSnippet(),
                    "from"    => $headerData['From'] ?? 'Unknown',
                    "date"    => $date->format('Y-m-d H:i:s'),
                    "labels"  => $labelIds
                );
            }
        }
    }
    

    // ตรงนี้จะทำให้เวลลาประมวลผล เกินมา 0.5 วินาที เพราะต้องรอให้ Gmail ดึงข้อมูลและประมวลผลเสร็จ
    $details = $service->users_labels->get($user, $_POST['label']);

    $totalMessages = $details->getMessagesTotal();
    $unreadMessages = $details->getMessagesUnread();
    
    //echo "Total Messages: " . $totalMessages . "\n";
    //echo "Unread Messages: " . $unreadMessages . "\n";





    $ExecutionEndTime = microtime(true);
    $ExecutionTime = $ExecutionEndTime - $ExecutionStartTime;   
    echo json_encode(array(
        "success" => true,
        "data" => $aMessage,
		"nextPageToken" => $results->getNextPageToken(),
        "totalMessages" => $totalMessages,
        "unreadMessages" => $unreadMessages,
        'caption' => ucfirst($_POST['label']),
        'executionTime' => $ExecutionTime
    ));

	$dbc->Close();
?>