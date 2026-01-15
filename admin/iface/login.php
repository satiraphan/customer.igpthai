<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="font/inter/inter.min.css">
	<link href="plugins/material-design-icons-iconfont/material-design-icons.min.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/simplebar/simplebar.min.css">
	<link rel="stylesheet" href="css/style.min.css" id="main-css">
	<link rel="stylesheet" href="css/sidebar-gray.min.css" id="theme-css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	
	<!-- Google Sign-In -->
	<meta name="google-signin-client_id" content="<?php echo GOOGLE_CLIENT_ID;?>">
	<script src="https://accounts.google.com/gsi/client" async defer></script>
	
	<title>Nebulaos Admin</title>
	<style>
		.divider-text {
			position: relative;
			text-align: center;
			margin: 15px 0;
		}
		.divider-text::before,
		.divider-text::after {
			content: '';
			position: absolute;
			top: 50%;
			width: 45%;
			height: 1px;
			background: #dee2e6;
		}
		.divider-text::before {
			left: 0;
		}
		.divider-text::after {
			right: 0;
		}
	</style>
</head>

<body class="login-page">

	<div class="container pt-5">
		<div class="row justify-content-center">
			<div class="col-md-auto d-flex justify-content-center">
				<div class="card shadow">
					<div class="card-header bg-primary text-white flex-column">
						<h4 class="text-center mb-0">Log In</h4>
						<div class="text-center opacity-50 font-italic">Nebula Operation System</div>
					</div>
					<div class="card-body p-4">

						<!-- LOG IN FORM -->
						<form id="login-form" onsubmit="fn.login();return false;">
							<div class="form-group">
								<div class="floating-label input-icon">
									<i class="material-icons">person_outline</i>
									<input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off">
									<label for="username">Username</label>
								</div>
							</div>
							<div class="form-group">
								<div class="floating-label input-icon">
									<i class="material-icons">lock_open</i>
									<input type="password" class="form-control" placeholder="Password" name="password">
									<label for="password">Password</label>
								</div>
							</div>
							<div class="form-group d-flex justify-content-between align-items-center">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="remember">
									<label class="custom-control-label" for="remember">Remember me</label>
								</div>
								<a href="?forgotpass" class="text-primary text-decoration-underline small">Forgot password ?</a>
							</div>
							<button type="submit" class="btn btn-primary btn-block">LOG IN</button>
						</form>
						
						<!-- Social Login -->
						<div class="divider-text my-3">or</div>
						
						<button type="button" class="btn btn-outline-danger btn-block mb-2" id="google-login-btn">
							<i class="fab fa-google mr-2"></i> Login with Google
						</button>
						
						<button type="button" class="btn btn-outline-primary btn-block" id="facebook-login-btn">
							<i class="fab fa-facebook mr-2"></i> Login with Facebook
						</button>
						
						<div class="text-center mt-3 small">
							Don't have an account? 
							<a href="?register" class="text-primary text-decoration-underline">Register</a>
						</div>
						<!-- /LOG IN FORM -->

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="plugins/bootbox/bootbox.min.js"></script>
	<script src="plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="js/app.nebulaos.js"></script>
	
	<!-- Facebook SDK -->
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
	
	<script>
		$(function(){
			fn.init();
			
			// Initialize Facebook SDK
			window.fbAsyncInit = function() {
				FB.init({
					appId: '<?php echo FACEBOOK_APP_ID;?>',
					cookie: true,
					xfbml: true,
					version: 'v18.0'
				});
			};
			
			// Google Sign-In Handler
			window.handleGoogleSignIn = function(response) {
				$.post("ajax/auth/action-login-google.php", {
					credential: response.credential
				}, function(result) {
					if(result.success) {
						window.location.reload();
					} else {
						fn.notify.warnbox(result.msg || "Google login failed");
					}
				}, "json").fail(function() {
					fn.notify.warnbox("Connection error");
				});
			};
			
			// Initialize Google Sign-In
			if(typeof google !== 'undefined') {
				google.accounts.id.initialize({
					client_id: '<?php echo GOOGLE_CLIENT_ID;?>',
					callback: handleGoogleSignIn
				});
			}
			
			// Google Login Button Click
			$('#google-login-btn').click(function() {
				if(typeof google !== 'undefined') {
					google.accounts.id.prompt();
				} else {
					fn.notify.warnbox("Google Sign-In not loaded");
				}
			});
			
			// Facebook Login Button Click
			$('#facebook-login-btn').click(function() {
				FB.login(function(response) {
					if (response.authResponse) {
						FB.api('/me', {fields: 'id,name,email'}, function(userInfo) {
							$.post("ajax/auth/action-login-facebook.php", {
								facebook_id: userInfo.id,
								name: userInfo.name,
								email: userInfo.email,
								access_token: response.authResponse.accessToken
							}, function(result) {
								if(result.success) {
									window.location.reload();
								} else {
									fn.notify.warnbox(result.msg || "Facebook login failed");
								}
							}, "json").fail(function() {
								fn.notify.warnbox("Connection error");
							});
						});
					} else {
						fn.notify.warnbox("Facebook login cancelled");
					}
				}, {scope: 'public_profile,email'});
			});
		});
	</script>
</body>

</html>

