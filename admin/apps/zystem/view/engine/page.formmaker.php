<?php
	global $os;
	$_GET['action'] = isset($_GET['action'])?$_GET['action']:"";
	
	$forms = json_decode($os->load_variable('aFormMaker','json'),true);
	
	if($_GET['action']=="blueprint"){
		include "view/engine/formmaker/page.blueprint.php";
		
	}else{
		
		
	
	
	
?>
<h3>
    Form Maker Engine
</h3>
<div class="button-group mb-2">
	<button onclick="fn.app.zystem.engine.formmaker.add()" class="btn btn-primary">Add</button>
</div>
<table class="table">
	<thead>
		<tr>
			<th>Form Name</th>
			<th>Type</th>
			<th>Created</th>
			<th>Updated</th>
			<th>Download</th>
		</tr>
	</thead>
	<tbody>
	<?php
	
	for($i=0;$i<count($forms);$i++){
		$form = $forms[$i];
		echo '<tr>';
			echo '<td>'.$form['name'].'</td>';
			echo '<td>'.$form['type'].'</td>';
			echo '<td>'.$form['created'].'</td>';
			echo '<td>'.$form['updated'].'</td>';
			echo '<td>';
				echo '<button onclick="fn.app.zystem.engine.formmaker.remove('.$i.')" class="btn btn-danger btn-sm mr-2">Remove</button>';
				echo '<a href="#apps/zystem/index.php?view=engine&section=formmaker&action=blueprint&form_id='.$i.'" class="btn btn-primary btn-sm mr-2">Blueprint</a>';
				echo '<button class="btn btn-warning btn-sm">Download</button>';
			echo '</td>';
		
		echo '</tr>';
	}
	?>
	</tbody>
</table>


  <div class="modal" role="dialog" style="position:relative;display:block;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<style>
.bd-example-modal {
  background-color: #fafafa;

  .modal {
    position: relative;
    top: auto;
    right: auto;
    bottom: auto;
    left: auto;
    z-index: 1;
    display: block;
  }

  .modal-dialog {
    left: auto;
    margin-right: auto;
    margin-left: auto;
  }
}
</style>
<?php
	}

?>