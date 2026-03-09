<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

    $sql = "SELECT * FROM db_tags WHERE name LIKE '%".$_GET['key']."%' ORDER BY name ASC LIMIT 20";
    $tags = $dbc->Query($sql);
    $results = array();
    while($tag = $dbc->Fetch($tags)){
        $results[] = array(
            'id' => $tag['id'],
            'text' => $tag['name']
        );
    } 

    echo json_encode(array(
        'results' => $results
    ));

	$dbc->Close();
?>
