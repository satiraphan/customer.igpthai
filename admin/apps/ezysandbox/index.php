<?php
	session_start();
	@ini_set('display_errors',1);
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
?>
<div class="row">
  <div class="col-md-12 btn-area btn-group mb-2">
    <button class="btn btn-primary" onclick="add_step()">Add Step</button>
  </div>
  <hr>
  <div class="col-md-6">
    <div id="work_zone">
</div>
  </div>
</div>
<script>

  function add_step(){
    let s = '';
    s += '<div class="card mb-2">';
      s += '<div class="card-header bg-secondary">';
        s += '<select class="form-control" onChange="onChangeItem(this)">';
            s += '<option>Please Select Step</option>';
            s += '<option value="1">Buddle</option>';
            s += '<option value="2">Pattern</option>';
            s += '<option value="3">More</option>';
          s += '</select>';
      s += '</div>';
      s += '<div class="step-work card-body">';
      /*
        s += '<h5 class="card-title">Special title treatment</h5>';
        s += '<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>';
        s += '<a href="#" class="btn btn-primary">Go somewhere</a>';
        */
      s += '</div>';
    s += '</div>';
    $("#work_zone").append(s);
  }

  function onChangeItem(me){
    let s = '';
    console.log($(me).val());
    switch($(me).val()){
      case "1":
        s += '<button class="btn btn-xs">Add product</button>';
        s += '<table class="table table-bordered mt-2">';
          s += '<thead>';
            s += '<tr>';
              s += '<th>Product ID</th>';
              s += '<th>Product Code</th>';
              s += '<th>Name</th>';
              s += '<th>Amount</th>';
              s += '<th>Setting</th>';
            s += '</tr>';
          s += '</thead>';
          s += '<tbody>';
            s += '<tr>';
              s += '<td>001</td>';
              s += '<td>AAA</td>';
              s += '<td>Product A</td>';
              s += '<td><input type="number" value="1" class="form-control form-contorl-sm"></td>';
              s += '<td>-</td>';
            s += '</tr>';
            s += '<tr>';
              s += '<td>002</td>';
              s += '<td>BBB</td>';
              s += '<td>Product B</td>';
              s += '<td><input type="number" value="1" class="form-control form-contorl-sm"></td>';
              s += '<td>-</td>';
            s += '</tr>';
          s += '</tobdy>';
        s += '</table>';
        break;
      case "2":
        s += '<select class="form-control" multiple">';
            s += '<option>Pattern A</option>';
            s += '<option>Pattern B</option>';
            s += '<option>Pattern C</option>';
            s += '<option>Pattern D</option>';
            s += '<option>Pattern E</option>';
          s += '</select>';
        break;
      case "3":
        s += '<textarea class="form-control" placeholder="Please insert Detail"></textarea>';
        s += '<input type="checkbox"> Cleaning';
        s += '<input type="checkbox"> XYZ';
        break;
    }
    $(me).parent().parent().find(".step-work").html(s);
  }



  var plugins = [];
	App.loadPlugins(plugins, null).then(() => {
		App.checkAll();
	}).then(() => App.stopLoading())
</script>
<?php
  $dbc->Close();
?>