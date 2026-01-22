<?php
	$menu_content = json_decode(file_get_contents("apps/menu.json"),true);
	$menu_type = $os->load_variable("menutype","string");

	$user = $dbc->GetRecord("os_users","*","id=".$os->auth['id']);
	$setting = json_decode($user['setting'],true);
	if(isset($setting['theme']) && $setting['theme']!=""){
		$theme = $setting['theme'];
	}else{
		$theme = "dark";
	}
?>
<!doctype html>
<html lang="<?php echo $_SESSION['lang'];?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="font/inter/inter.min.css" id="font-css">
	<link rel="stylesheet" href="plugins/material-design-icons-iconfont/material-design-icons.min.css">
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="plugins/simplebar/simplebar.min.css">

	<link rel="stylesheet" href="css/modern/style.css" id="main-css">

	<link rel="stylesheet" href="css/sidebar-<?php echo $theme;?>.min.css" id="theme-css"> <!-- options: blue,cyan,dark,gray,green,pink,purple,red,royal,ash,crimson,namn,frost -->
	<link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
	<link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
	<link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
	<script src="https://kit.fontawesome.com/8230990db5.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/core.css">

	<title><?php echo SYSTEM_NAME;?></title>
</head>

<body class="<?php if($menu_type=="topnav")echo'sticky-navbar';?>">
	<?php include_once "comp/loader.php";?>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar header -->
		<div class="sidebar-header">
			<a href="#" class="logo">
				<img src="img/igp-logo.png" alt="Logo" id="main-logo"style="filter:brightness(0) invert(1);"><?php echo SYSTEM_NAME;?>
			</a>
			<a href="#" class="nav-link nav-icon rounded-circle ml-auto" data-toggle="sidebar">
				<i class="material-icons">close</i>
			</a>
		</div>
		<!-- /Sidebar header -->

		<!-- Sidebar body -->
		<div class="sidebar-body">
			<ul class="nav treeview mb-4" id="menu" data-accordion>
				<li class="nav-label">APPLICATION</li>
				<?php $os->load_menu($menu_content);?>
			</ul>
			
			
		</div>
		<!-- /Sidebar body -->
	</div>
	<!-- /Sidebar -->

	<!-- Main -->
	<div class="main">
		<!-- Main header -->
		<div class="main-header">
			<?php
				if($menu_type=="topnav"){
					echo '<a href="#" class="logo d-none d-lg-flex">';
						echo '<img src="img/logo.svg" alt="Logo" id="main-logo">';
						echo $os->tr("global.application");
					echo '</a>';
				}
			?>
			<a class="nav-link nav-link-faded rounded-circle nav-icon<?php if($menu_type=="topnav")echo' d-lg-none';?>" href="#" data-toggle="sidebar"><i class="material-icons">menu</i></a>
			<form action="#apps/search/index.php" method="GET" class="form-inline ml-3 d-none d-md-flex">
				<span class="input-icon">
					<i class="material-icons">search</i>
					<input name="param" type="text" placeholder="Search..." class="form-control bg-gray-200 border-gray-200 rounded-lg">
				</span>
			</form>
			<?php
			if($os->load_variable("needreload")=="yes")echo'<a class="btn btn-warning ml-2" href="javascript:;" onclick="fn.system.reload()">Need Reload</a>';
			if($os->load_variable("needrestart")=="yes")echo'<a class="btn btn-danger ml-2" href="javascript:;" onclick="fn.system.restart()">Need Restart</a>';
			?>
			
			<ul class="nav nav-circle ml-auto">
				<li class="nav-item d-md-none">
					<a class="nav-link nav-link-faded nav-icon" data-toggle="modal" href="#html/ajax/searchModal"><i class="material-icons">search</i></a>
				</li>
				<li class="nav-item d-none d-sm-block mr-2">
					<input readonly id="online_debug" type="text" class="form-control">
				</li>
				<li class="nav-item d-none d-sm-block">
					<div class="custom-control custom-switch mt-2">
						<input id="bOnline" class="custom-control-input" type="checkbox" name="bOnline" value="yes" checked="">
						<label for="bOnline" class="custom-control-label">Online</label>
					</div>
				</li>
				<li class="nav-item d-none d-sm-block"><a class="nav-link nav-link-faded nav-icon" href="" id="refreshPage"><i class="material-icons">refresh</i></a></li>
				<?php include "part/iface_notify.php";?>
				<li class="nav-item dropdown ml-2">
					<a class="nav-link nav-link-faded rounded nav-link-img dropdown-toggle px-2" href="#" data-toggle="dropdown" data-display="static">
						<img src="<?php echo $os->auth['avatar']; ?>" onerror="this.onerror=null; this.src='img/default/noimage.png';" class="rounded-circle mr-2">
						<span class="d-none d-sm-block"><?php echo $os->auth['name']; ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right pt-0 overflow-hidden">
						<div class="media align-items-center bg-primary text-white px-4 py-3 mb-2">
							<img src="<?php echo $os->auth['avatar']; ?>" onerror="this.onerror=null; this.src='img/default/noimage.png';" class="rounded-circle" width="50" height="50">
							<div class="media-body ml-2 text-nowrap">
								<h6 class="mb-0"><?php echo $os->auth['display']; ?></h6>
								<span class="text-gray-400 font-size-sm"><?php echo $os->auth['group']; ?></span>
							</div>
						</div>
						<a class="dropdown-item has-icon" href="#apps/profile/index.php"><i class="mr-2" data-feather="user"></i><?php echo $os->tr("auth.profile");?></a>
						<a class="dropdown-item has-icon" href="javascript:void(0)" onclick="fn.dialog.change_language();"><i class="mr-2" data-feather="globe"></i><?php echo $os->tr("auth.language");?></a>
						<a class="dropdown-item has-icon" href="#apps/setting/index.php"><i class="mr-2" data-feather="settings"></i><?php echo $os->tr("auth.setting");?></a>
						<a class="dropdown-item has-icon text-danger" href="javascript:void(0)" onclick="fn.logout();"><i class="mr-2" data-feather="log-out"></i><?php echo $os->tr("auth.signout");?></a>
					</div>
				</li>
			</ul>
		</div>
		<!-- /Main header -->
		<?php
			if($menu_type=="topnav"){
				$os->load_topmenu($menu_content);
			}
		?>
		<!-- Main body -->
		<div class="main-body">
			AJAX CONTENT GOES HERE
		</div>
		<!-- /Main body -->

	</div>
	<!-- /Main -->
	<?php
	echo '<script>';
	echo "\n".'const ln = '.($os->get_lang_json()).";\n";
	echo '</script>';
	?>
	<!-- Main Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="plugins/simplebar/simplebar.min.js"></script>
	<script src="plugins/feather-icons/feather.min.js"></script>
	<script src="js/script.min.js"></script>
	<script src="plugins/bootbox/bootbox.min.js"></script>
	<script src="js/ajax.js" id="ajax-js"></script>
	<script src="plugins/jquery-cookie/jquery.cookie.js"></script>
	<script src="js/app.nebulaos.js"></script>
	<script src="js/app.nebulaos.ui.js"></script>
	<!-- Plugins -->
	<!-- JS plugins goes here -->
	<script>
		App.ajax({
			'container': '.main-body',
			'default': '#apps/dashboard/index.php',
			'breadcrumb': false
		})
	</script>

</body>

</html>