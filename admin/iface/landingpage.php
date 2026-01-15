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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<title>NebulaOS - Landing Page</title>
	<style>
		.app-card {
			transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
			cursor: pointer;
			border: none;
			height: 100%;
		}
		.app-card:hover {
			transform: translateY(-5px);
			box-shadow: 0 8px 25px rgba(0,0,0,0.15);
		}
		.app-icon {
			font-size: 2.5rem;
			margin-bottom: 1rem;
			color: #007bff;
		}
		.hero-section {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			color: white;
			padding: 4rem 0;
		}
		.section-title {
			margin-bottom: 3rem;
			color: #333;
		}
	</style>
</head>
<body>
	<!-- Hero Section -->
	<div class="hero-section">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<h1 class="display-4 font-weight-bold mb-3">Welcome to NebulaOS</h1>
					<p class="lead mb-4">Comprehensive Business Management Platform</p>
					<p class="mb-0">Poise Technology Co.,Ltd.</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Main Applications Section -->
	<div class="container py-5">
		<div class="row">
			<div class="col-12">
				<h2 class="section-title text-center">Available Applications</h2>
			</div>
		</div>
		
		<!-- Main Apps Row -->
		<div class="row mb-5">
			<!-- Dashboard -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/dashboard/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-tachometer-alt app-icon"></i>
						<h5 class="card-title">Dashboard</h5>
						<p class="card-text text-muted">Main overview and analytics</p>
					</div>
				</div>
			</div>

			<!-- Ezy Sandbox -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/ezysandbox/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-code app-icon"></i>
						<h5 class="card-title">Ezy Sandbox</h5>
						<p class="card-text text-muted">Development and testing environment</p>
					</div>
				</div>
			</div>

			<!-- Authentication -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/authentication/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-key app-icon"></i>
						<h5 class="card-title">Authentication</h5>
						<p class="card-text text-muted">User authentication management</p>
					</div>
				</div>
			</div>

			<!-- Schedule -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/schedule/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-calendar app-icon"></i>
						<h5 class="card-title">Schedule</h5>
						<p class="card-text text-muted">Task and event scheduling</p>
					</div>
				</div>
			</div>

			<!-- Sandbox -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/sandbox/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-flask app-icon"></i>
						<h5 class="card-title">Sandbox</h5>
						<p class="card-text text-muted">Experimental features</p>
					</div>
				</div>
			</div>

			<!-- Concurrent -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/concurent/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-sync app-icon"></i>
						<h5 class="card-title">Concurrent</h5>
						<p class="card-text text-muted">Concurrent processing</p>
					</div>
				</div>
			</div>

			<!-- Logger -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/logger/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-history app-icon"></i>
						<h5 class="card-title">Logger</h5>
						<p class="card-text text-muted">System logs and monitoring</p>
					</div>
				</div>
			</div>

			<!-- Contact -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/contact/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-address-book app-icon"></i>
						<h5 class="card-title">Contact</h5>
						<p class="card-text text-muted">Contact management</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Menu Section -->
		<div class="row mb-5">
			<div class="col-12">
				<h3 class="section-title text-center">Additional Features</h3>
			</div>
			
			<!-- Notification -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/notify/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-bell app-icon"></i>
						<h5 class="card-title">Notification</h5>
						<p class="card-text text-muted">System notifications</p>
					</div>
				</div>
			</div>

			<!-- Customer -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/customer/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-users app-icon"></i>
						<h5 class="card-title">Customer</h5>
						<p class="card-text text-muted">Customer management</p>
					</div>
				</div>
			</div>

			<!-- Category -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/category/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-tags app-icon"></i>
						<h5 class="card-title">Product Category</h5>
						<p class="card-text text-muted">Product categorization</p>
					</div>
				</div>
			</div>

			<!-- Information -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/info/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-info-circle app-icon"></i>
						<h5 class="card-title">Information</h5>
						<p class="card-text text-muted">System information</p>
					</div>
				</div>
			</div>
		</div>

		<!-- Administration Section -->
		<div class="row">
			<div class="col-12">
				<h3 class="section-title text-center">Administration</h3>
			</div>
			
			<!-- Settings -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/setting/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-cog app-icon"></i>
						<h5 class="card-title">Settings</h5>
						<p class="card-text text-muted">System configuration</p>
					</div>
				</div>
			</div>

			<!-- Access Control -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/accctrl/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-shield-alt app-icon"></i>
						<h5 class="card-title">Access Control</h5>
						<p class="card-text text-muted">User permissions</p>
					</div>
				</div>
			</div>

			<!-- Database -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/database/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-database app-icon"></i>
						<h5 class="card-title">Database</h5>
						<p class="card-text text-muted">Database management</p>
					</div>
				</div>
			</div>

			<!-- User Management -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/user/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-user-friends app-icon"></i>
						<h5 class="card-title">User Management</h5>
						<p class="card-text text-muted">User administration</p>
					</div>
				</div>
			</div>

			<!-- System -->
			<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card app-card shadow-sm h-100" onclick="window.location.href='apps/zystem/index.php'">
					<div class="card-body text-center">
						<i class="fas fa-microchip app-icon"></i>
						<h5 class="card-title">System</h5>
						<p class="card-text text-muted">System monitoring</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg-dark text-white py-4 mt-5">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<p class="mb-0">&copy; 2025 Poise Technology Co.,Ltd. All rights reserved.</p>
				</div>
			</div>
		</div>
	</footer>

	<!-- Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="plugins/bootbox/bootbox.min.js"></script>
	<script src="js/app.nebulaos.js"></script>
</body>

</html>

