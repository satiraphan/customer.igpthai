<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../../config/define.php";
	include "../../../include/db.php";
	include "../../../include/oceanos.php";
	include "../../../include/iface.php";
	require '../../../vendor/autoload.php';
	
	use Google\Client;
	use Google\Service\Gmail;
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

    $aLabelMain = array(
		array("INBOX","Inbox","fa fa-inbox",0,0),
		array("STARRED","Starred","fa fa-star",'warning',0),
		array("SENT","Sent","fa fa-send",0,0),
		array("SPAM","Spam","fa fa-exclamation-circle",0,0),
		array("TRASH","Trash","fa fa-trash",'secondary',0),
		array("IMPORTANT","Important","fas fa-exclamation-triangle",'warning',0)
	);

    $aLabelCategory = array(
		array("CATEGORY_SOCIAL","Social","fa fa-users",0,0),
		array("CATEGORY_UPDATES","Updates","fa fa-sync-alt",0,0),
		array("CATEGORY_FORUMS","Forums","fa fa-comments",0,0),
		array("CATEGORY_PROMOTIONS","Promotions","fa fa-tag",0,0),
		array("CATEGORY_PERSONAL","Personal","fa fa-person",0,0)
	);

    $aLabelUser = array();


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

	$results = $service->users_labels->listUsersLabels($user);
	$labels = $results->getLabels();

	$client->setUseBatch(true);
	$batch = $service->createBatch();

	foreach ($labels as $label) {
		// แทนที่จะทำงานทันที มันจะถูกสะสมไว้ใน $batch
		$batch->add($service->users_labels->get($user, $label->getId()), $label->getId());
	}

	$labelDetails = $batch->execute();
	$client->setUseBatch(false);

	foreach ($labels as $label) {
		$id = $label->getId();
    	$labelDetail = $labelDetails['response-' . $id];
		$unreadCount = $labelDetail->getMessagesUnread();
		$totalMessage = $labelDetail->getMessagesTotal();

		// ดึงชื่อ Label และประเภท (system หรือ user)
		if($label->getType() == 'user') {
			array_push($aLabelUser,array(
				$label->getId(),
				$label->getName(),
				"fa fa-tag",
				$unreadCount,
				$totalMessage
			));
		}
		if($label->getType() == 'system') {
			foreach($aLabelMain as $i => $l){
				if($l[0] == $label->getId()){
					$aLabelMain[$i][3] = $unreadCount;
					$aLabelMain[$i][4] = $totalMessage;
				}

			}
			foreach($aLabelCategory as $i => $l){
				if($l[0] == $label->getId()){
					$aLabelCategory[$i][3] = $unreadCount;
					$aLabelCategory[$i][4] = $totalMessage;
				}
			}
		}
	}

    echo json_encode(array(
        "success" => true,
        "aLabelMain" => $aLabelMain,
        "aLabelCategory" => $aLabelCategory,
        "aLabelUser" => $aLabelUser
    ));

	
	$dbc->Close();
?>