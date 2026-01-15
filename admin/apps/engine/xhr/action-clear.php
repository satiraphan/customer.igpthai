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
	
	$unlink = "";
	$action = array();
	$removed = false;
	
	switch($_POST['type']){
		case "contact":
			$contact = $dbc->GetRecord("os_contacts","*","id=".$_POST['id']);
			if($contact['avatar']!=""){
				$unlink = "../../../".$contact['avatar'];
				$removed = true;
				$dbc->Update("os_contacts",array("#avatar"=>"NULL"),"id=".$_POST['id']);
			}
			break;
		case "customer":
			$customer = $dbc->GetRecord("customers","*","id=".$_POST['id']);
			if($customer['type']=="both"){
				$organization = $dbc->GetRecord("organizations","*","id=".$customer['org_id']);
				if($organization['logo']!=""){
					$unlink = "../../../".$organization['logo'];
					$removed = true;
					$dbc->Update("organizations",array("#logo"=>"NULL"),"id=".$customer['org_id']);
				}
			}else if($customer['type']=="organization"){
				$organization = $dbc->GetRecord("organizations","*","id=".$customer['org_id']);
				if($organization['logo']!=""){
					$unlink = "../../../".$organization['logo'];
					$removed = true;
					$dbc->Update("organizations",array("#logo"=>"NULL"),"id=".$customer['org_id']);
				}
			}else{
				$contact = $dbc->GetRecord("os_contacts","*","id=".$customer['contact']);
					if($contact['avatar']!=""){
					$unlink = "../../../".$contact['avatar'];
					$removed = true;
					$dbc->Update("os_contacts",array("#avatar"=>"NULL"),"id=".$customer['contact']);
				}
			}
			break;
		case "profile":
			$contact = $dbc->GetRecord("os_contacts","*","id=".$_POST['id']);
			if($contact['avatar']!=""){
				$unlink = "../../../".$contact['avatar'];
				$removed = true;
				$dbc->Update("os_contacts",array("#avatar"=>"NULL"),"id=".$_POST['id']);
			}
			break;
		case "brand":
			$brand = $dbc->GetRecord("brands","*","id=".$_POST['id']);
			if($brand['img']!=""){
				$unlink = "../../../".$brand['img'];
				$removed = true;
				$dbc->Update("brands",array("#img"=>"NULL"),"id=".$_POST['id']);
			}
			break;
		case "category":
			$category = $dbc->GetRecord("categories","*","id=".$_POST['id']);
			if($category['img']!=""){
				$unlink = "../../../".$category['img'];
				$removed = true;
				$dbc->Update("categories",array("#img"=>"NULL"),"id=".$_POST['id']);
			}
			break;
	}
	
	if($unlink!="")if(file_exists($unlink))unlink($unlink);
	
	if($removed){
		echo json_encode(array(
			'success'=>true
		));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "No file to remove"
		));
	}
	
	$dbc->Close();
?>