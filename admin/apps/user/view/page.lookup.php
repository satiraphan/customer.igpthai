<?php
	global $os,$dbc;

	$user = $dbc->GetRecord("os_users","*","id=".$_GET['id']);
	$contact = $dbc->GetRecord("os_contacts","*","id=".$user['contact']);
	$address = $dbc->GetRecord("os_address","*","contact=".$contact['id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>User Lookup</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">User</dt><dd class="col-sm-9">'.$user['id'].'</dd>';
			echo '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'.$user['name'].'</dd>';
			echo '<dt class="col-sm-3">Display</dt><dd class="col-sm-9">'.$user['display'].'</dd>';
			echo '<dt class="col-sm-3">Status</dt><dd class="col-sm-9">'.$user['status'].'</dd>';
			echo '<dt class="col-sm-3">Created</dt><dd class="col-sm-9">'.$user['created'].'</dd>';
			echo '<dt class="col-sm-3">Updated</dt><dd class="col-sm-9">'.$user['updated'].'</dd>';
			echo '<dt class="col-sm-3">Validated</dt><dd class="col-sm-9">'.$user['validated'].'</dd>';
			echo '<dt class="col-sm-3">Last Login</dt><dd class="col-sm-9">'.$user['last_login'].'</dd>';
			echo '<dt class="col-sm-3">GID</dt><dd class="col-sm-9">'.$user['gid'].'</dd>';
			echo '<dt class="col-sm-3">Contact</dt><dd class="col-sm-9">'.$user['contact'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>