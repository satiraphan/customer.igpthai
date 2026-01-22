fn.ui.datatable.init();
$("#tblContent").data( "selected", [] );
$("#tblContent").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/content/store/store-content.php",	
		"data": function ( d ) {
			d.account = $('#tblContent').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblContent").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_content",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('content','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('content','view=lookup&id="+data[0]+"')");
		$("td", row).eq(2).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblContent','chk_content',true,function(){
	let s = '';
	$.each($("#tblContent").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
