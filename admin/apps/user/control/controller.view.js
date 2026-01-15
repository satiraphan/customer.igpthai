fn.ui.datatable.init();

$("#tblUser").data( "selected", [] );
$('#tblUser').DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/user/store/store-user.php",
		"data": function ( d ) {
			d.account = $('#tblUser').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable": false	,"data":"id",	 		"class" : "hidden-xs text-center unselectable","width": "20px"},
		{"bSortable": true	,"data":"username",		"class" : "text-center"},
		{"bSortable": false	,"data":"avatar", 		"class" : "text-center","width": "40px"},
		{"bSortable": true	,"data":"fullname",		"class" : "hidden-xs"},
		{"bSortable": true	,"data":"groupname",	"class" : "text-center"},
		{"bSortable": false	,"data":"phone", 		"class" : "hidden-xs text-center"},
		{"bSortable": false	,"data":"email", 		"class" : "hidden-xs text-center"},
		{"bSortable": true	,"data":"last_login",	"class"	: "text-center hidden-xs"},
		{"bSortable": false	,"data":"id",			"class" : "text-center", "width": "80px" }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblUser").data("selected")) !== -1 ) {
			$(row).addClass('selected');
			selected = true;
		}
		$('td', row).eq(0).html(fn.ui.checkbox_custom("chk_user",data.id,selected));

		$('td', row).eq(2).html('<a href="javascript:void(0)" onclick="fn.app.engine.file.dialog_file(\'contact\','+data.contact_id+')"><img class="img-circle" style="height:25px;" src="'+data.avatar+'" onerror=this.src=\'img/default/noimage.png\';""></a>');
		
		s = '';
		if(data.phone)
		s += '<a href="tel:'+data.phone+'" class="badge bg-color-darken">'+fn.ui.numberic.phone(data.phone)+'</a>';
		
		if(data.mobile)
		s += '<a href="tel:'+data.mobile+'" class="badge bg-color-orange">'+fn.ui.numberic.phone(data.mobile)+'</a>';
		$('td', row).eq(5).html(s);
		
			

		s = '';
		if(data.last_login=="-"){
				s += 'Never Login';
		}else{
			var d = new Date(data.last_login);
			s +=  moment(data.last_login).format("YYYY-MM-DD HH:mm:ss");
		}
		$('td', row).eq(7).html(s);


		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('user','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('user','view=lookup&id="+data[0]+"')");
		$('td', row).eq(8).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblUser','chk_user',true,function(){
	let s = '';
	$.each($("#tblUser").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>'
	});
	$("#selected_item").html(s);
});