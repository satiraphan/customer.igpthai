var modules = {
	const : {
		autosave : true,
		autosave_interval : 2000
	},
	list_notes : fn.noaccess,
	load_note : fn.noaccess,
	dialog_lookup : fn.noaccess,
	dialog_add : fn.noaccess,
	dialog_edit : fn.noaccess,
	dialog_remove : fn.noaccess,
	
	create : fn.noaccess,
	edit : fn.noaccess,
	remove : fn.noaccess,
	autosave : fn.noaccess,
	pin : fn.noaccess,
	unpin : fn.noaccess,
	archive : fn.noaccess,
	unarchive : fn.noaccess
};

$.extend(fn.app,{mynote:modules});