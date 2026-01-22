<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('content','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.content.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
		</div>
		<table id="tblContent" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_content" control="chk_content">
							<label class="custom-control-label" for="chk_content"></label>
						</div>
					</th>
					<th class="text-center">Name</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
