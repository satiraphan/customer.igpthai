<?php
	$type = isset($_GET['type']) ? $_GET['type'] : '';
	$credential = isset($_GET['credential']) ? $_GET['credential'] : '';

	$name = "";
	$email = "";
	$google_id = "";
	$surname = "";
	$avatar = "img/default/user.png";	

	if($type == "google") {
		// 1. Verify Token โดยส่งไปที่ Google Endpoint (ใช้ cURL แทน file_get_contents)
		$verify_url = "https://oauth2.googleapis.com/tokeninfo?id_token=" . $credential;
		
		// ใช้ cURL เพราะ allow_url_fopen อาจถูก disable บน server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $verify_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$payload = json_decode($response, true);

		$name = isset($payload['given_name']) ? $payload['given_name'] : '';
		$surname = isset($payload['family_name']) ? $payload['family_name'] : '';
		$email = isset($payload['email']) ? $payload['email'] : '';
		$google_id = isset($payload['sub']) ? $payload['sub'] : '';
		$avatar = isset($payload['picture']) ? $payload['picture'] : '';

	}else if($type=="facebook") {

		$verify_url = "https://graph.facebook.com/me?access_token=" . urlencode($credential) . "&fields=id,name,email,picture.type(large)";
		
		// ใช้ cURL เพราะ allow_url_fopen อาจถูก disable บน server
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $verify_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		$response = curl_exec($ch);
		curl_close($ch);
		
		$payload = json_decode($response, true);


		$facebook_id = isset($payload['id']) ? $payload['id'] : '';
		$email = isset($payload['email']) ? $payload['email'] : '';
		$name = isset($payload['name']) ? $payload['name'] : '';
		$name = urldecode($name);
		if (strpos($name, ' ') !== false) {
			$parts = explode(" ", $name, 2);
			$name = $parts[0];
			$surname = $parts[1];
		}
		if(isset($payload['picture']['data']['url']))$avatar = $payload['picture']['data']['url'];
	}

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="font/inter/inter.min.css">
	<link href="plugins/material-design-icons-iconfont/material-design-icons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/simplebar/simplebar.min.css">
	<link rel="stylesheet" href="css/style.min.css" id="main-css">
	<link rel="stylesheet" href="css/sidebar-gray.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
	<title>Registration</title>
</head>
<body>
	<div class="container pt-5">
		<div class="row justify-content-center">
			<div class="col-md-auto d-flex justify-content-center">
				<div class="card shadow">
					<div class="card-header bg-primary text-white flex-column">
						<h4 class="text-center mb-0">ระบบลงทะเบียน</h4>
						<div class="text-center opacity-50 font-italic">
							<?php
							if($type=="google") {
								echo "Register with Google Account";
							} else if($type=="facebook") {
								echo "Register with Facebook Account";
							}
							?>
						</div>
					</div>
					<div class="card-body p-4">
						<form name="register-form" id="register-form" onsubmit="return false;">
							<input type="hidden" name="type" value="<?php echo $type; ?>">
							<input type="hidden" name="google_id" value="<?php echo htmlspecialchars($google_id); ?>">
							<input type="hidden" name="facebook_id" value="<?php echo htmlspecialchars($facebook_id); ?>">
							<input type="hidden" name="avatar" value="<?php echo htmlspecialchars($avatar); ?>">
							<!--
							<div class="form-group">
								<label class="font-size-sm">Organization/Busines Name</label>
								<input name="org_name" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Your Organization" autocomplete="off">
							</div>
-->
							<div class="form-group">
								<label class="font-size-sm">Fullname</label>
								<div class="row">
								<div class="col-sm-6">
									<input name="name" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Name" autocomplete="off" value="<?php echo htmlspecialchars($name); ?>">
								</div>
								<div class="col-sm-6">
									<input name="surname" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Surname" autocomplete="off" value="<?php echo htmlspecialchars($surname); ?>">
								</div>
								</div>
							</div>
							<div class="form-group">
								<label class="font-size-sm">Email address / Username</label>
								<input name="email" type="email" class="form-control bg-gray-200 border-gray-200" placeholder="yourname@yourmail.com" autocomplete="off" value="<?php echo htmlspecialchars($email); ?>">
							</div>
							<div class="form-group">
								<label class="font-size-sm">Password</label>
								<input name="password" type="password" class="form-control bg-gray-200 border-gray-200" placeholder="Password" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-size-sm">Password</label>
								<input name="repassword" type="password" class="form-control bg-gray-200 border-gray-200" placeholder="Confirm Password" autocomplete="off">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="agreeCheck">
									<label class="custom-control-label" for="agreeCheck">I agree with </label>
									<a href="javascript:void(0)"><u>terms and conditions</u></a>
								</div>
							</div>
							<button type="button" class="btn btn-primary btn-block" onclick="fn.register();">Register</button>
						</form>
						<!-- /LOG IN FORM -->

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Plugins -->
	<!-- JS plugins goes here -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="plugins/bootbox/bootbox.min.js"></script>
	<script src="js/app.nebulaos.js"></script>
</body>

</html>

