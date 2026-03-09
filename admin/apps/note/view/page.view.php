<?php
	global $os;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('note','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.note.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
		</div>
		<div class="row">
			<div class="col-4">
				<table id="tblNote" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
					<thead>
						<tr>
							<th class="text-center">Action</th>
							<th class="text-center">รายการ</th>
							<th class="text-center">Created</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<div class="col-8">
				<div id="note_screen">

				</div>
			</div>
		</div>
		
		<div id="selected_item">
		</div>
	</div>
</div>
<style>
	#tblNote tbody tr.selected {
		background-color: #A9A9A9;
		color: white;
	}
</style>