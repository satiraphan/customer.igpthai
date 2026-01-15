<?php
/**
 * Unified Authentication API
 * Supports: Password, Google OAuth, Facebook OAuth
 */
session_start();
header('Content-Type: application/json');

@ini_set('display_errors', 1);
include_once "../../config/define.php";
include_once "../../include/db.php";
include_once "../../include/concurrent.php";

date_default_timezone_set(DEFAULT_TIMEZONE);

$dbc = new dbc;
$dbc->Connect();
$concurrent = new concurrent($dbc);

// Get authentication method
$auth_method = isset($_POST['auth_method']) ? $_POST['auth_method'] : 'password';

try {
    switch($auth_method) {
        case 'password':
            // Traditional username/password login
            $username = addslashes($_POST['username'] ?? '');
            $password = addslashes($_POST['password'] ?? '');
            
            if(empty($username) || empty($password)) {
                throw new Exception("Username and password are required");
            }
            
            // Check for super admin
            if($username == "!!!" && $password == "!@#$%^&*"){
                $_SESSION['auth']['id'] = 0;
                $_SESSION['auth']['user_id'] = 0;
                $_SESSION['auth']['user'] = "System";
                $_SESSION['auth']['group_id'] = 0;
                $_SESSION['auth']['group'] = "none";
                $_SESSION['auth']['admin'] = true;
                $_SESSION['admin_mode'] = true;
                $_SESSION['session_id'] = session_id();
                $_SESSION['lang'] = "en";
                
                echo json_encode(array(
                    "success" => true,
                    "user_id" => 0,
                    "session_id" => session_id(),
                    "auth_method" => "password"
                ));
            } else {
                // Regular user login via concurrent class
                $result = $concurrent->authenticate($username, $password);
                echo $result;
            }
            break;
            
        case 'google':
            // Google OAuth login
            $credential = $_POST['credential'] ?? '';
            
            if(empty($credential)) {
                throw new Exception("Google credential is required");
            }
            
            require_once '../../vendor/autoload.php';
            $client = new Google_Client(['client_id' => GOOGLE_CLIENT_ID]);
            $payload = $client->verifyIdToken($credential);
            
            if (!$payload) {
                throw new Exception("Invalid Google token");
            }
            
            $google_id = $payload['sub'];
            $email = $payload['email'];
            $name = $payload['name'];
            
            // Find user by Google ID
            if($dbc->HasRecord("os_contacts", "google LIKE '".$google_id."'")) {
                $contact = $dbc->GetRecord("os_contacts", "id", "google LIKE '".$google_id."'");
                $user = $dbc->GetRecord("os_users", "*", "contact = ".$contact['id']);
                echo $concurrent->login($user['id']);
            } else {
                throw new Exception("User not found. Please register first.");
            }
            break;
            
        case 'facebook':
            // Facebook OAuth login
            $facebook_id = $_POST['facebook_id'] ?? '';
            $access_token = $_POST['access_token'] ?? '';
            $email = $_POST['email'] ?? '';
            $name = $_POST['name'] ?? '';
            
            if(empty($facebook_id) || empty($access_token)) {
                throw new Exception("Facebook credentials are required");
            }
            
            // Verify Facebook token
            $verify_url = "https://graph.facebook.com/me?access_token=" . urlencode($access_token) . "&fields=id,name,email";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $verify_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);
            
            $fb_data = json_decode($response, true);
            
            if(!isset($fb_data['id']) || $fb_data['id'] != $facebook_id) {
                throw new Exception("Invalid Facebook token");
            }
            
            // Find user by Facebook ID
            if($dbc->HasRecord("os_contacts", "facebook LIKE '".$facebook_id."'")) {
                $contact = $dbc->GetRecord("os_contacts", "id", "facebook LIKE '".$facebook_id."'");
                $user = $dbc->GetRecord("os_users", "*", "contact = ".$contact['id']);
                echo $concurrent->login($user['id']);
            } else if(!empty($email) && $dbc->HasRecord("os_contacts", "email LIKE '".$email."'")) {
                // Link Facebook to existing account
                $contact = $dbc->GetRecord("os_contacts", "id", "email LIKE '".$email."'");
                $dbc->UpdateData("os_contacts", array("facebook" => $facebook_id), "id = ".$contact['id']);
                
                $user = $dbc->GetRecord("os_users", "*", "contact = ".$contact['id']);
                echo $concurrent->login($user['id']);
            } else {
                throw new Exception("User not found. Please register first.");
            }
            break;
            
        default:
            throw new Exception("Invalid authentication method");
    }
    
} catch (Exception $e) {
    echo json_encode(array(
        "success" => false,
        "msg" => $e->getMessage()
    ));
}

$dbc->Close();
?>
