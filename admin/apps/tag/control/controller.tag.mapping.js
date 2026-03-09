	fn.app.tag.tag.dialog_mapping = function(id) {
		$.ajax({
			url: "apps/tag/view/dialog.tag.mapping.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_mapping_tag"});
			}
		});
	};

	fn.app.tag.tag.mapping = function(){
		$.post("apps/tag/xhr/action-mapping-tag.php",$("form[name=form_mappingtag]").serialize(),function(response){
			if(response.success){
				$("#tblTag").DataTable().draw();
				$("#dialog_mapping_tag").modal("hide");
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};
