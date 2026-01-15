$("#tblConcurrent").data( "selected", [] );
$("#tblConcurrent").DataTable({
	responsive: true,
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/authentication/store/store-concurrent.php",	
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"sClass":"hidden-xs text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"package", class : "text-center"	},
		{"bSort":true			,"data":"token"	},
		{"bSort":true			,"data":"user_name"	},
		{"bSort":true			,"data":"login"	},
		{"bSort":true			,"data":"connected"	},
		{"bSort":true			,"data":"status"	},
		{"bSortable":false		,"data":"id"		,"sClass":"text-center" , "sWidth": "80px"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		if ( $.inArray(data.DT_RowId, $("#tblConcurrent").data( "selected")) !== -1 ) {
			$(row).addClass("selected");
			selected = true;
		}
		$("td", row).eq(0).html(fn.ui.checkbox("chk_concurrent",data[0],selected));
		
		switch(data.package){
			case "1":$("td", row).eq(1).html('<span class="badge badge-dark">Novice</span>');break;
			case "2":$("td", row).eq(1).html('<span class="badge badge-primary">Professional</span>');break;
			case "3":$("td", row).eq(1).html('<span class="badge badge-danger">Advance</span>');break;
		}
		
		
		
		s = '';
		s += fn.ui.button("btn btn-xs btn-outline-dark","far fa-pen","fn.app.authentication.concurrent.dialog_edit("+data[0]+")");
		$("td", row).eq(7).html(s);
	}
});
fn.ui.datatable.selectable("#tblConcurrent","chk_concurrent");
