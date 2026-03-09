fn.ui.datatable.init();
$("#tblFile").data( "selected", [] );
$("#tblFile").DataTable({
	"bStateSave": true,
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": {
		"url": "apps/file/store/store-file.php",	
		"data": function ( d ) {
			d.account = $('#tblFile').attr('account');
		}
	},
	"aoColumns": [
		{"bSortable":false		,"data":"id"		,"class":"text-center text-nowrap" , "sWidth": "80px"  },
		{"bSortable":false		,"data":"id"		,"class":"text-center",	"sWidth": "20px"  },
		{"bSort":true			,"data":"name"	,"class":"text-center",	},
		{"bSort":true			,"data":"uploaded"	,"class":"text-center",	},
		{"bSort":true			,"data":"mime"	,"class":"text-center",	},
		{"bSort":true			,"data":"size"	,"class":"text-center",	},
		{"bSearchable":false			,"data":"tags"		,"class":"text-center"  }
	],"order": [[ 1, "desc" ]],
	"createdRow": function ( row, data, index ) {
		var selected = false,checked = "",s = '';
		s = '';
		s += fn.ui.button("btn btn-xs btn-danger mr-1","far fa-trash","fn.app.file.dialog_remove("+data.id+")");
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-tags","fn.navigate('file','view=edit&id="+data[0]+"')");
		s += '<a href="'+data.path+'" target="_blank" download="'+data.name+'">';
			s += '<button class="btn btn-xs btn-outline-dark mr-1">';
		s += '<i class="fa fa-download"></i></button></a>';
		s += fn.ui.button("btn btn-xs btn-outline-dark mr-1","far fa-eye","fn.navigate('file','view=lookup&id="+data[0]+"')");
		$("td", row).eq(0).html(s);
	}
});
