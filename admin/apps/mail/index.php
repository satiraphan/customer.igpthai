<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	//$os->initial_lang("lang");
	$panel = new ipanel($dbc,$os->auth);
	
	$panel->setApp("mail","E-mail");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'view');
	
	$panel->setMeta(array(
		array('view' ,'view',	'far fa-eye')
	));

	require '../../vendor/autoload.php';
		
	use Google\Client;
	use Google\Service\Gmail;

	$reDirectUri = 'https://' . $_SERVER['HTTP_HOST'] . '/callback/googe-auth.php';
	$in_setting = $os->auth['setting']['mail']['in']['type'] ?? 'none';

	$secret = json_decode($os->load_variable('aGoogleAuth','json'),true);
	if($secret == null){
		echo '<div class="alert alert-danger">No Google Auth configuration found.</div>';
		echo '<script>App.stopLoading();</script>';
		exit;
	}

	if($in_setting == 'none') {
		echo '<div class="text-danger">No email provider selected.</div>';
		echo '<script>App.stopLoading();</script>';
		exit;
	}else if($in_setting == 'gmail') {
		// 1. ตั้งค่า Client
		$client = new Client();

		$client->setAuthConfig($secret); // ไฟล์ที่โหลดมาจาก Google Cloud
		$client->addScope(Gmail::GMAIL_READONLY);
		$client->addScope(Gmail::GMAIL_SEND);
		$client->addScope(Gmail::GMAIL_MODIFY);
		$client->setAccessType('offline');
		$client->setPrompt('consent');
		$client->setRedirectUri($reDirectUri);

		if($dbc->HasRecord("os_user_auth","user_id = '".$os->auth['id']."' AND provider = 'google'")) {
			$auth = $dbc->GetRecord("os_user_auth","token","user_id = '".$os->auth['id']."' AND provider = 'google'");
			if($auth['token'] == '') {
				$returnTo = '/#/mail/?uid=' . urlencode($os->auth['id']);
				$client->setState($returnTo);
				$authUrl = $client->createAuthUrl();
				echo '<script>window.location.replace(' . json_encode($authUrl) . ');</script>';
				echo '<noscript><a href="' . htmlspecialchars($authUrl, ENT_QUOTES, 'UTF-8') . '">Continue</a></noscript>';
				exit;
			}else{
				$accessToken = json_decode($auth['token'], true);
				$client->setAccessToken($accessToken);
			}
		}

		if ($client->isAccessTokenExpired()) {
			// ถ้ามี Refresh Token ให้ขอใหม่
			if ($client->getRefreshToken()) {
				$client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
				$data = array(
					'token' => json_encode($client->getAccessToken())
				);
				$dbc->Update("os_user_auth",$data,"user_id = '".$os->auth['id']."' AND provider = 'google'");
			} else {
				$returnTo = '/#/mail/?uid=' . urlencode($os->auth['id']);
				$client->setState($returnTo);
				$authUrl = $client->createAuthUrl();
				echo '<script>window.location.replace(' . json_encode($authUrl) . ');</script>';
				echo '<noscript><a href="' . htmlspecialchars($authUrl, ENT_QUOTES, 'UTF-8') . '">Continue</a></noscript>';
				exit;
			}
		}

	}

	$panel->EchoViewInterface();
	include "view/dialog.compose.php";
?>
	

<script>
	var plugins = [
		'apps/mail/include/interface.js',
		'plugins/noty/noty.min.css',
		'plugins/noty/noty.min.js',
		'plugins/summernote/summernote-bs4.css',
		'plugins/summernote/summernote-bs4.min.js',
	];
	App.loadPlugins(plugins, null).then(() => {
		//App.checkAll();
	<?php
		switch($panel->getView()){
			case "view":
				include "control/controller.view.js";
				if($in_setting == 'gmail')include "control/controller.gmail.js";
				break;
		}
	?>
	}).then(() => App.stopLoading())
</script>
<?php
	$dbc->Close();
?>