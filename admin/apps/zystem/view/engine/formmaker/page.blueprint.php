<?php
	$form = $forms[$_GET['form_id']];

?>

<div class="button-group mb-2">
	<button onclick="window.history.back();" class="btn btn-primary">Back</button>
</div>

<div class="button-group mb-2">
	<button class="btn btn-primary">Add Rows</button>
	<button class="btn btn-primary">Add Form</button>
</div>
<div id="form_editor">
	<form class="form-horizontal" role="form" onsubmit=";return false;">
		<div class="form-group row">
			<label class="xitem col-sm-2 col-form-label text-right">Token</label>
			<div class="xitem col-sm-10">
				<input type="" class="form-control" name="token" placeholder="Token">
			</div>
		</div>
		
		<div class="form-group row">
			<label class="xitem col-sm-2 col-form-label text-right">Token</label>
			<div class="xitem col-sm-10">
				<input type="" class="form-control" name="token" placeholder="Token">
			</div>
		</div>
		
		<div class="form-group row">
			<label class="xitem col-sm-2 col-form-label text-right">Token2</label>
			<div class="xitem col-sm-10">
				<input type="" class="form-control" name="token" placeholder="Token">
			</div>
		</div>
		<div class="form-group row">
			<label class="xitem col-sm-2 col-form-label text-right">Token4</label>
			<div class="xitem col-sm-10">
				<input type="" class="form-control" name="token" placeholder="Token">
			</div>
		</div>
	</form>
</div>
<style>
	#form_editor > form > .row{
		border : dashed 1px #F00;
	}


</style>
<script>
$(function(){
	$("#form_editor form").Sortable();
	
});
</script>