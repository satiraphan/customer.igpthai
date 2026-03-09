var modules = {
	gmail : {
		list_mail : fn.noaccess,
		list_label : fn.noaccess,
		load_mail : fn.noaccess,
		star : fn.noaccess,
		star_mail : fn.noaccess,
		unstar_mail : fn.noaccess,
		send_mail : fn.noaccess,
		list_mail_next_page : fn.noaccess,
		list_mail_prev_page : fn.noaccess,
		dialog_delete_mail : fn.noaccess,
		delete_mail : fn.noaccess,
		restore_mail : fn.noaccess,
		set_label : fn.noaccess,
		dialog_move : fn.noaccess,
		move : fn.noaccess
	}
};
$.extend(fn.app,{mail:modules});
