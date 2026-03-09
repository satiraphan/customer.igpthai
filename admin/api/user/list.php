<?php
/**
 * Unified Authentication API
 * Supports: Password, Google OAuth, Facebook OAuth
 */
session_start();
header('Content-Type: application/json');

@ini_set('display_errors', 1);
include_once "../config/define.php";
include_once "../include/db.php";
include_once "../include/concurrent.php";

date_default_timezone_set(DEFAULT_TIMEZONE);

$dbc = new dbc;
$dbc->Connect();

$sql = "SELECT id,name,gid FROM os_users WHERE status = 1";
$rst = $dbc->Query($sql);
$users = array();
while($line = $dbc->Fetch($rst)) {
    $users[] = $line;
} 

http_response_code(200);
echo json_encode(array(
    "success" => true,
    "users" => $users
));


$dbc->Close();
?>
