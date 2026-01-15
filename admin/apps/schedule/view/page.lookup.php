<?
	global $os,$dbc;
	$schedule = $dbc->GetRecord("os_users","*","id=".$_GET['id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Schedule Lookup</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$schedule['id'].'</dd>';
			echo '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'.$schedule['name'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
