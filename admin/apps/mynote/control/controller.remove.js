	fn.app.mynote.remove = function(id) {
		fn.dialog.confirmbox("Confirm Box","คุณแน่ใจหรือไม่ที่จะลบโน้ตนี้?", function() {
			App.startLoading();
			$.post("apps/mynote/xhr/action-remove.php", { id: id }, function(response) {
				App.stopLoading();
				if (response.success) {
					fn.app.mynote.list_note();
					$('#note-screen').html('<div class="inner-main-header"><a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar"><i class="material-icons">arrow_forward_ios</i></a><lable>Select Note</lable></div>');
				} else {
					fn.notify.warnbox(response.msg, "Oops...");
				}
			}, "json");
		});
		return false;	
	};

