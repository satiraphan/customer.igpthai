	fn.app.schedule.dialog_remove = function() {
		var item_selected = $("#tblSchedule").data("selected");
		$.ajax({
			url: "apps/schedule/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_schedule"});
			}
		});
	};

	fn.app.schedule.remove = function(){
		$.post("apps/schedule/xhr/action-remove.php",$("form[name=form_remove_schedule]").serialize(),function(response){
			if(response.success){
				$("#tblSchedule").data("selected",[]);
				$("#tblSchedule").DataTable().draw();
				$("#dialog_remove_schedule").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
