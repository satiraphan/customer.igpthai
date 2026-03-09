	fn.app.mynote.edit = function(){
		$.post("apps/mynote/xhr/action-edit.php",$("form[name=form_mynote]").serialize(),function(response){
			if(response.success){
				$('a.list-group-item-action.active').removeClass('active');
				let s = '';
				s += '<div class="inner-main-header">';
					s += '<a class="nav-link nav-icon rounded-circle nav-link-faded mr-3 d-md-none" href="#" data-toggle="inner-sidebar">';
						s += ' <i class="material-icons">arrow_forward_ios</i>';
					s += '</a>';
					s += '<lable>Select Note</lable>';
				s += ' </div>';
				$('#note-screen').html(s);
				fn.app.mynote.list_note();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	fn.app.mynote.autosave = function(){
		$.post("apps/mynote/xhr/action-edit.php",$("form[name=form_mynote]").serialize(),function(response){
			if(response.success){
				$('#note-updated').text(response.updated);

				let saved_badge = '<span id="saved-badge" class="small text-success text-nowrap pt-2 mr-1"><i class="fa fa-check-circle"></i> Saved</span>';
				$('form[name=form_mynote] .media').append(saved_badge);
				setTimeout(function(){
					$('#saved-badge').fadeOut('fast',function(){
						$(this).remove();
					});
				}, 1000);

			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};

	$("textarea[name=content]").summernote({
		height: 300,
	});

	
	fn.app.mynote.pin = function(id) {
		fn.dialog.confirmbox("Confirm Box","ต้องการที่จะปักหมุดโน้ตนี้หรือไม่?", function() {
			App.startLoading();
			$.post("apps/mynote/xhr/action-pin.php", { id: id }, function(response) {
				App.stopLoading();
				if (response.success) {
					fn.app.mynote.list_note({default: id});
					fn.notify.successbox("Note pinned successfully", "Success");
				} else {
					fn.notify.warnbox(response.msg, "Oops...");
				}
			}, "json");
		});
		return false;	
	};

	fn.app.mynote.unpin = function(id) {
		fn.dialog.confirmbox("Confirm Box","ต้องการที่จะยกเลิกการปักหมุดโน้ตนี้หรือไม่?", function() {
			App.startLoading();
			$.post("apps/mynote/xhr/action-unpin.php", { id: id }, function(response) {
				App.stopLoading();
				if (response.success) {
					fn.app.mynote.list_note({default: id});
					fn.notify.successbox("Note unpinned successfully", "Success	");
				} else {
					fn.notify.warnbox(response.msg, "Oops...");
				}
			}, "json");
		});
		return false;	
	};

	fn.app.mynote.archive = function(id) {
		fn.dialog.confirmbox("Confirm Box","ต้องการที่จะเก็บโน้ตนี้หรือไม่?", function() {
			App.startLoading();
			$.post("apps/mynote/xhr/action-archive.php", { id: id }, function(response) {
				App.stopLoading();
				if (response.success) {
					fn.app.mynote.list_note({default: id});
					fn.notify.successbox("Note pinned successfully", "Success");
				} else {
					fn.notify.warnbox(response.msg, "Oops...");
				}
			}, "json");
		});
		return false;	
	};

	fn.app.mynote.unarchive = function(id) {
		fn.dialog.confirmbox("Confirm Box","ต้องการที่จะยกเลิกการเก็บโน้ตนี้หรือไม่?", function() {
			App.startLoading();
			$.post("apps/mynote/xhr/action-unarchive.php", { id: id }, function(response) {
				App.stopLoading();
				if (response.success) {
					fn.app.mynote.list_note({default: id});
					fn.notify.successbox("Note unarchived successfully", "Success	");
				} else {
					fn.notify.warnbox(response.msg, "Oops...");
				}
			}, "json");
		});
		return false;	
	};

