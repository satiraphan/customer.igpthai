
	fn.app.database.subdistrict.dialog_edit = function(id) {
		$.ajax({
			url: "apps/database/view/geography/dialog.subdistrict.edit.php",
			data: {id:id},
			type: "POST",
			dataType: "html",
			success: function(html){
				$("body").append(html);
				fn.ui.modal.setup({dialog_id : "#dialog_edit_subdistrict"});
				$("select[name=country]").select2({width:"100%"});

					fn.app.contact.address.auto_district(
						"form[name=form_editsubdistrict] select[name=country]",
						"form[name=form_editsubdistrict] select[name=city]",
						"form[name=form_editsubdistrict] select[name=district]");
					$("form[name=form_editsubdistrict] select[name=country]").val(211).change();
			}	
		});
	};
	
	fn.app.database.subdistrict.edit = function(){
		$.post('apps/database/xhr/geography/action-edit-subdistrict.php',$('form[name=form_editsubdistrict]').serialize(),function(response){
			if(response.success){
				$("#tblDatabase").DataTable().draw();
				$("#dialog_edit_subdistrict").modal('hide');
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
			
		},'json');
		return false;
	};
