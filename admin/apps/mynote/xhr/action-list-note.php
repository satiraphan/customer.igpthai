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

	$search = isset($_POST['search'])?$_POST['search']:'';
	$show_archived = $_POST['show_archived']=="true"?true:false;
	$show_deleted = $_POST['show_deleted']=="true"?true:false;

    $notes = array();
$sql = "SELECT DISTINCT n.* FROM os_notes n
        LEFT JOIN os_note_tags nt ON n.id = nt.note_id
        LEFT JOIN db_tags t ON nt.tag_id = t.id
        WHERE n.user_id = " . (int)$os->auth['id'] . " 
		" . ($show_archived ? "" : " AND n.archived IS NULL ") . "
		" . ($show_deleted ? "" : " AND n.deleted IS NULL ") . "
        AND (
            n.title LIKE '%" . $dbc->Escape_String($search) . "%' 
            OR t.name LIKE '%" . $dbc->Escape_String($search) . "%'
        )
        ORDER BY n.pinned IS NOT NULL DESC, n.created DESC";

    $rst = $dbc->Query($sql);
    while($line = $dbc->Fetch($rst)){

		$tags = array();
		$sql = "SELECT t.* FROM os_note_tags nt LEFT JOIN db_tags t ON nt.tag_id = t.id WHERE nt.note_id=".$line['id'];
		$rst_tag = $dbc->Query($sql);
		while($tag = $dbc->Fetch($rst_tag)){
			array_push($tags,$tag['name']);	
		}
		$line['tags'] = $tags;

        array_push($notes,$line);
    }
	
	echo json_encode(array(
        "success" => true,
        "notes" => $notes
    ));

	$dbc->Close();
?>