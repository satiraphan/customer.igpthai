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
			d.type = $('select[name="filter_type"]').val();
			d.account = $('#tblContent').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"			,"class":"text-center",	"sWidth": "100px"  },
		{"bSort":true			,"data":"type"			,"class":"text-center",	},
		{"bSort":true			,"data":"code"			,"class":"text-center",	},
		{"bSort":true			,"data":"title"			,"class":"text-center",	},
		{"bSort":true			,"data":"date_publish"	,"class":"text-center",	},
		{"bSort":true			,"data":"date_terminate","class":"text-center",	},
		{"bSort":true			,"data":"view"			,"class":"text-center",	},
		{"bSortable":false		,"data":"user"		,"class":"text-center"  }
	],"order": [[ 2, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('content','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('content','view=lookup&id="+data[0]+"')");

		if(data.type == "gallery")
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","fa-solid fa-gallery-thumbnails","fn.navigate('content','view=gallery&id="+data[0]+"')");
		$("td", row).eq(0).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblContent','chk_content',true,function(){
	let s = '';
	$.each($("#tblContent").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
