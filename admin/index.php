<?php
	session_start();
	@ini_set('display_errors',1);

	require_once __DIR__ . '/vendor/autoload.php';

	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	$dotenv->load();

	// ฟังก์ชันสำหรับดึงค่าแบบปลอดภัย (เผื่อลืมกำหนดค่าใน .env)
	function env($key, $default = null) {
		return $_ENV[$key] ?? $default;
	}

	define("DEBUG_MODE",    env('DEBUG_MODE') === 'true');
	define("PHP_TIMEZONE",  env('TIMEZONE', 'Asia/Bangkok'));
	define("DATE_FORMAT",   env('DATE_FORMAT', 'Y-m-d H:i:s'));
	define("DEFAULT_THEME", env('DEFAULT_THEME', 'default'));
	define("DEFAULT_LANGUAGE", env('DEFAULT_LANGUAGE', 'en'));
	define("DB_NAME",       env('DB_NAME'));
	define("DB_USER",       env('DB_USER'));
	define("DB_PASS",       env('DB_PASS'));
	define("DB_SERVER",     env('DB_SERVER'));
	define("JWT_KEY",		env('JWT_KEY'));
	define("MINIO_SERVER",  env('MINIO_SERVER'));
	define("MINIO_USER",    env('MINIO_USER'));
	define("MINIO_PASS",    env('MINIO_PASS'));
	define("SYSTEM_NAME",    env('SYSTEM_NAME'));
	define("ORG_NAME",      env('ORG_NAME'));
	define("ORG_WEBSITE",   env('ORG_WEBSITE'));
	define("SERVER_MARKET", env('SERVER_MARKET'));
	define("GOOGLE_CLIENT_ID", env('GOOGLE_CLIENT_ID'));
	define("FACEBOOK_APP_ID",  env('FACEBOOK_APP_ID'));

# --- End of Configuration ---





	include_once "include/db.php";
	include_once "include/oceanos.php";
	include_once "include/nebulaos.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new nebulaos($dbc);
	$os->initial_lang("lang");
	$abox = $os;
	
	if(is_null($os->auth)){
		if(isset($_GET['register'])){
			include_once "iface/register.php";
		}else if(isset($_GET['forgotpass'])){
			include_once "iface/forgotpass.php";
		}else if(isset($_GET['landingpage'])){
			include_once "iface/landingpage.php";
		}else{
			include_once "iface/login.php";
		}
	}else{
		include_once "iface/bootstrap.php";
	}
	
	//include_once "iface/bootstrap.php";
	
	
	
	/*
	$sql = "SHOW TABLES LIKE 'variable'";
	$rst = $dbc->Query($sql);
	
	
	if($dbc->Total($rst)>0){
		
		if(is_null($abox->auth)){
			include_once "iface/login.php";
		}else{
			include_once "iface/bootstrap.php";
		}
	}else{
		
		include_once "iface/install.php";
		
	}
	*/

	$dbc->Close();
	
?>