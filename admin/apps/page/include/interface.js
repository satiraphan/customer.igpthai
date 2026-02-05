var modules = {
		save_layout : fn.noaccess,
		view : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		remove : fn.noaccess,
		layout : {
			remove_row : fn.noaccess,
			append_row : fn.noaccess,
			append_content : fn.noaccess,
			change_column : fn.noaccess,
			load_content : fn.noaccess,
			load_layout : fn.noaccess,
			save_layout : fn.noaccess,
			content : {
				create : fn.noaccess
			}
		}
};
$.extend(fn.app,{page:modules});
