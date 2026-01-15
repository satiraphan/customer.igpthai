var authentication = {
	concurrent : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		dialog_revoke : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess,
		revoke : fn.noaccess,
		append_device : fn.noaccess
	},
};
$.extend(fn.app,{authentication:authentication});
