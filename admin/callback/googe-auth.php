<?php
	session_start();
	@ini_set('display_errors',1);
	include "../config/define.php";
	include "../include/db.php";
	include "../include/oceanos.php";
    
    $dbc = new dbc;
    $dbc->Connect();

require '../vendor/autoload.php';

$reDirectUri = 'https://' . $_SERVER['HTTP_HOST'] . '/callback/googe-auth.php';

use Google\Client;
use Google\Service\Gmail;

$client = new Client();
$client->setAuthConfig('../apps/mail/client_secrets.json');
$client->addScope(Gmail::GMAIL_READONLY);
$client->setAccessType('offline');
$client->setPrompt('consent');
$client->setRedirectUri($reDirectUri);

if (!isset($_GET['code'])) {
    http_response_code(400);
    echo 'Missing authorization code.';
    exit;
}

$accessToken = $client->fetchAccessTokenWithAuthCode($_GET['code']);
if (array_key_exists('error', $accessToken)) {
    http_response_code(400);
    echo 'Error fetching token: ' . $accessToken['error'];
    exit;
}



$returnTo = '/apps/mail/index.php';
$userId = null;
if (isset($_GET['state']) && is_string($_GET['state'])) {
    $candidate = $_GET['state'];
    if ($candidate !== '' && $candidate[0] === '/' && strpos($candidate, '//') !== 0) {
        $returnTo = $candidate; 
    }

    $stateFragment = $candidate;
    $hashPos = strpos($stateFragment, '#');
    if ($hashPos !== false) {
        $stateFragment = substr($stateFragment, $hashPos + 1);
    }

    $queryPos = strpos($stateFragment, '?');
    if ($queryPos !== false) {
        $query = substr($stateFragment, $queryPos + 1);
        parse_str($query, $stateQuery);
        if (isset($stateQuery['uid']) && $stateQuery['uid'] !== '') {
            $userId = $stateQuery['uid'];
        }
    }
}

$data = array('token' => json_encode($accessToken));
$dbc->Update("os_user_auth",$data,"user_id = '".$userId."' AND provider = 'google'");


$dbc->Close();

header('Location: ' . $returnTo);
exit;
