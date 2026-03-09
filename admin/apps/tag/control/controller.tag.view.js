$("#tblTag").data( "selected", [] );
$("#tblTag").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/tag/store/store-tag.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"name"	},
		{"bSort":true			,"data":"key_name"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblTag").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_tag",data[0],selected));
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-pen","fn.app.tag.tag.dialog_edit("+data[0]+")");
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-link","fn.app.tag.tag.dialog_mapping("+data[0]+")");

		$("td", row).eq(3).html(s);
	}
});
fn.ui.datatable.selectable("#tblTag","chk_tag");
