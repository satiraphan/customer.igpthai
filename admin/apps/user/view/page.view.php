<?php
	global $os;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-user mr-2"></i><?php echo $os->tr('main.appname');?></h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('user','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i><?php echo $os->tr('main.add');?></button>
			<button onclick="fn.app.user.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i><?php echo $os->tr('main.remove');?></button>
		</div>
		<div class=" table-responsive">
			<table id="tblUser" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
				<thead>
					<tr>
						<th class="text-center hidden-xs">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="chk_user" control="chk_user">
								<label class="custom-control-label" for="chk_user"></label>
							</div>
						</th>
						<th class="text-center"><?php echo $os->tr('view.username');?></th>
						<th class="text-center"><?php echo $os->tr('view.avatar');?></th>
						<th class="text-center hidden-xs"><?php echo $os->tr('view.fullname');?></th>
						<th class="text-center hidden-xs"><?php echo $os->tr('view.group');?></th>
						<th class="text-center hidden-xs"><?php echo $os->tr('view.phone');?></th>
						<th class="text-center hidden-xs"><?php echo $os->tr('view.email');?></th>
						<th class="text-center hidden-xs"><?php echo $os->tr('view.last_login');?></th>
						<th class="text-center"><?php echo $os->tr('view.action');?></th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
		<div id="selected_item">
		</div>
	</div>
</div>