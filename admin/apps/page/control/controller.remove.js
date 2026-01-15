	fn.app.page.dialog_remove = function() {
		var item_selected = $("#tblPage").data("selected");
		$.ajax({
			url: "apps/page/view/dialog.remove.php",
			type: "POST",
			data: {item:item_selected},
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_remove_page"});
			}
		});
	};

	fn.app.page.remove = function(){
		$.post("apps/page/xhr/action-remove.php",$("form[name=form_remove_page]").serialize(),function(response){
			if(response.success){
				$("#tblPage").data("selected",[]);
				$("#tblPage").DataTable().draw();
				$("#dialog_remove_page").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
