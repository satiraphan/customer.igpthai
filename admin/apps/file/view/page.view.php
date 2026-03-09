<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.app.file.dialog_upload()" class="btn btn-outline-danger" ><i class="fa fa-upload mr-1"></i>Upload</button>
		</div>
		<table id="tblFile" class="table table-striped table-bordered table-hover" width="100%">
			<thead>
				<tr>
					<th class="text-center">Action</th>
					<th class="text-center">ID</th>
					<th class="text-center">File Name</th>
					<th class="text-center">Uploaded</th>
					<th class="text-center">Mine</th>
					<th class="text-center">Size</th>
					<th class="text-center">Tag</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
