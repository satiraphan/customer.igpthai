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
	<title>Registeration</title>
</head>
<body>
	<div class="container pt-5">
		<div class="row justify-content-center">
			<div class="col-md-auto d-flex justify-content-center">
				<div class="card shadow">
					<div class="card-header bg-primary text-white flex-column">
						<h4 class="text-center mb-0">Registeration Form</h4>
						<div class="text-center opacity-50 font-italic">Poise Technology Co.,Ltd.</div>
					</div>
					<div class="card-body p-4">
						<form name="register-form" id="register-form" onsubmit="alert();fn.register();return false;">
							<div class="form-group">
								<label class="font-size-sm">Organization/Busines Name</label>
								<input name="org_name" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Your Organization" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-size-sm">Fullname</label>
								<div class="row">
								<div class="col-sm-6">
									<input name="name" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Name" autocomplete="off">
								</div>
								<div class="col-sm-6">
									<input name="surname" type="text" class="form-control bg-gray-200 border-gray-200" placeholder="Surname" autocomplete="off">
								</div>
								</div>
							</div>
							<div class="form-group">
								<label class="font-size-sm">Email address</label>
								<input name="email" type="email" class="form-control bg-gray-200 border-gray-200" placeholder="yourname@yourmail.com" autocomplete="off">
							</div>
							<div class="form-group">
								<label class="font-size-sm">Password</label>
								<input name="password" type="password" class="form-control bg-gray-200 border-gray-200" placeholder="Password" autocomplete="off">
							</div>
							<div class="form-group">
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="agreeCheck">
									<label class="custom-control-label" for="agreeCheck">I agree with </label>
									<a href="javascript:void(0)"><u>terms and conditions</u></a>
								</div>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Register</button>
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

