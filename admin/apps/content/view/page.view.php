<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('content','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.content.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
			<select class="form-control float-right" name="filter_type" style="width:200px;" onchange="$('#tblContent').DataTable().draw();">
				<option value="%">ทั้งหมด</option>
				<option value="content">เนื้อหาทั่วไป</option>
				<option value="article">บทความ</option>
				<option value="news">ข่าวสาร</option>
				<option value="activity">กิจกรรม</option>
				<option value="gallery">แกลเลอรี่</option>
			</select>
		</div>
		<table id="tblContent" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center"></th>
					<th class="text-center">ประเภท</th>
					<th class="text-center">รหัส</th>
					<th class="text-center">ชื่อรายการ</th>
					<th class="text-center">วันที่เผยแพร่</th>
					<th class="text-center">วันที่สิ้นสุด</th>
					<th class="text-center">ยอดวิว</th>
					<th class="text-center">ผู้สร้าง</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
