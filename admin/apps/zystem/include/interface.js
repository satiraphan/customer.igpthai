var zystem = {
	engine : {
		builder : {
			dialog_build : fn.noaccess,
			build : fn.noaccess,
			append_subapp : fn.noaccess,
			append_subpage : fn.noaccess
		},
		concurrent : {
			reset : fn.noaccess
		},
		formmaker : {
			reset : fn.noaccess
		}
	},
	core : {
		initial : {
			save_core : fn.noaccess
		},
		license : {
			create : fn.noaccess
		},
		variable : {
			dialog_add : fn.noaccess,
			dialog_edit : fn.noaccess,
			dialog_remove : fn.noaccess,
			add : fn.noaccess,
			edit : fn.noaccess,
			remove : fn.noaccess
		}
	}
};

$.extend(fn.app,{zystem:zystem});