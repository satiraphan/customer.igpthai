$("#tblTable").data( "selected", [] );
$('#tblTable').DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/accctrl/store/store-user.php",
	
	"aoColumns": [
		{"bSortable": false	,"data":"id", "sWidth": "20px",	 "sClass" : "hidden-xs text-center"},
		{"bSort" : true		,"data":"username",				 "sClass" : "text-center"},
		{"bSortable": false	,"data":"email", 				"sClass" : "hidden-xs text-center"},
		{"bSortable": true	,"data":"last_login", 			"sClass":"text-center hidden-xs"},
		{"bSortable": false	,"data":"id", 					"sClass" : "text-center", "sWidth": "30px" }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblTable").data("selected")) !== -1 ) {
			$(row).addClass('selected');
			selected = true;
		}
		$('td', row).eq(0).html(fn.ui.checkbox("chk_user",data[0],selected));
		
		$('td', row).eq(2).html('<input class="form-control data-q1">');
		$('td', row).eq(3).html('<input class="form-control data-q2">');
		$('td', row).eq(4).html('<input class="form-control data-q3">');
		
		
	}
});
fn.ui.datatable.selectable('#tblTable','chk_user');


func_test_sent_ajax = function(){
	
	let data = [];
	
	
	
	$("span[name=chk_user].fa-check-square").each(function(){
		let tr = $(this).parent().parent();
		let aa = {
			id : $(this).attr("data"),
			q1 : tr.find(".data-q1").val(),
			q2 : tr.find(".data-q2").val(),
			q3 : tr.find(".data-q3").val(),
		}
		
		
		data.push(aa);
		
	});
	
	
	$.post("#",{data:data},function(){
		
	});
	
	
	
	console.log(data);
}