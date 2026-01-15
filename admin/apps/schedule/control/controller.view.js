fn.ui.datatable.init();
$("#tblSchedule").data( "selected", [] );
$("#tblSchedule").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/schedule/store/store-schedule.php",	
		"data": function ( d ) {
			d.account = $('#tblSchedule').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSortable":false		,"data":"id"		,"class":"text-center" , "sWidth": "80px"  },
		{"bSort":true					,"data":"name"	,"class":"text-center",	},
		{"bSort":true					,"data":"type"	,"class":"text-center",	},
		{"bSort":true					,"data":"created"	,"class":"text-center",	},
		{"bSort":true					,"data":"updated"	,"class":"text-center",	}
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblSchedule").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox_custom("chk_schedule",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.navigate('schedule','view=edit&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('schedule','view=lookup&id="+data[0]+"')");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-calendar","fn.navigate('schedule','view=schedule&id="+data[0]+"')");
		$("td", row).eq(1).html(s);
	}
});
fn.ui.datatable.selectable_custom('#tblSchedule','chk_schedule',true,function(){
	let s = '';
	$.each($("#tblSchedule").data("selected"), function( index, value ) {
		s += '<span class="badge rounded-pill badge-dark p-2 mr-1">'+value+'</span>';
	});
	$("#selected_item").html(s);
});
