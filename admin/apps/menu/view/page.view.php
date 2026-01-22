<?php
	global $os, $dbc;
?>

<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.app.menu.dialog_add()" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.menu.sort()" class="btn btn-outline-primary" ><i class="fa fa-trash mr-1"></i>Sort</button>
		</div>
		<table id="tblMenu" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center" width="20"></th>
					<th class="text-center" width="100"></th>
					<th class="text-center">ชื่อเมนู</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">หน้า</th>
					<th class="text-center"></th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sql = "SELECT * FROM cms_menu WHERE parent IS NULL ORDER BY ordinal ASC";
			$rst = $dbc->Query($sql);
			while($line = $dbc->Fetch($rst)){
				echo '<tr id="menu_'.$line['id'].'">';
					echo '<td class="text-center move-node  btn-in-row">';
						echo '<i class="fa-solid fa-arrows-up-down-left-right"></i>';
					echo '</td>';
					echo '<td class="text-center text-nowrap">';
						echo '<button class="btn btn-sm btn-outline-primary" onclick="fn.app.menu.dialog_edit('.$line['id'].')"><i class="fa fa-edit"></i></button> ';
						echo '<button class="btn btn-sm btn-outline-danger" onclick="fn.app.menu.dialog_remove('.$line['id'].')"><i class="fa fa-trash"></i></button>';
					echo '<td>'.$line['name'].'</td>';
					echo '<td class="text-center">';
					if($line['status']==1){
						echo '<span class="badge badge-success">Active</span>';
					}else{
						echo '<span class="badge badge-secondary">Inactive</span>';
					}
					if($line['page_id']!=null){
						$page = $dbc->GetRecord("cms_pages","*","id=".$line['page_id']);
						echo '<td>'.$page['name'].'</td>';
					}else{
					echo '<td>---</td>';
					}
					echo '<td>'.$line['name'].'</td>';
				echo '</tr>';

				if($dbc->HasRecord("cms_menu","parent=".$line['id'])){
					$sub = $dbc->Query("SELECT * FROM cms_menu WHERE parent=".$line['id']." ORDER BY ordinal ASC");
					while($subline = $dbc->Fetch($sub)){
						echo '<tr id="menu_'.$subline['id'].'">';
							echo '<td class="text-center move-node btn-in-row">';
								echo '<i class="fa-solid fa-arrows-up-down-left-right"></i>';
							echo '</td>';
							echo '<td class="text-center text-nowrap">';
								echo '<button class="btn btn-sm btn-outline-primary" onclick="fn.app.menu.dialog_edit('.$subline['id'].')"><i class="fa fa-edit"></i></button> ';
								echo '<button class="btn btn-sm btn-outline-danger" onclick="fn.app.menu.dialog_remove('.$subline['id'].')"><i class="fa fa-trash"></i></button>';
							echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;└&nbsp;'.$subline['name'].'</td>';
							echo '<td class="text-center">';
							if($subline['status']==1){
								echo '<span class="badge badge-success">Active</span>';
							}else{
								echo '<span class="badge badge-secondary">Inactive</span>';			
							}
							if($subline['page_id']!=null){
								$page = $dbc->GetRecord("cms_pages","*","id=".$subline['page_id']);
								echo '<td>'.$page['name'].'</td>';
							}else{
								echo '<td>---</td>';
							}
							echo '<td>'.$subline['name'].'</td>';
						echo '</tr>';
					}
				}

			}

				
			?>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
