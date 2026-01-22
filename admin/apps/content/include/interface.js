var modules = {
		view : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		remove : fn.noaccess,
		dialog_change_status : fn.noaccess,
		change_status : fn.noaccess,
		dialog_publish : fn.noaccess,
		publish : fn.noaccess,
		lookup : fn.noaccess,
};
$.extend(fn.app,{content:modules});
