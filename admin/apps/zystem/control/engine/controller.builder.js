fn.app.zystem.engine.builder.save = function(){
	$.post('apps/zystem/xhr/engine/action-builder-save.php',$('form[name=form_appbuilder]').serialize(),function(response){
		if(response.success){
			fn.notify.successbox('Save Complete', "Save");
		}else{
			fn.notify.warnbox(response.msg,"Oops...");
		}
	},'json');
	return false;
}

fn.app.zystem.engine.builder.build = function(){
	$.post('apps/zystem/xhr/engine/action-build.php',$('form[name=form_appbuilder]').serialize(),function(response){
		if(response.success){
			fn.notify.successbox('Click <a target="_blank" href="'+response.path+'">here</a> to Download File', "Download Files");
		}else{
			fn.notify.warnbox(response.msg,"Oops...");
		}
	},'json');
	return false;
}

fn.app.zystem.engine.builder.append_subapp = function(){
	var s = '';

		s += '<div class="form-group row">';
			s += '<div class="col-sm-1"><button class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button></div>';
			s += '<label class="col-sm-1 col-form-label text-right">Appname</label>';
			s += '<div class="col-sm-4">';
				s += '<input type="text" class="form-control" name="subapp[]" placeholder="Application Name">';
			s += '</div>';
			s += '<label class="col-sm-1 col-form-label text-right">Caption</label>';
			s += '<div class="col-sm-5">';
				s += '<input type="text" class="form-control" name="subcaption[]" placeholder="Caption">';
			s += '</div>';
			
			s += '<label class="col-sm-2 col-form-label text-right">Method</label>';
			s += '<div class="col-sm-10">';
				s += '<input type="text" class="form-control" name="method[]" placeholder="Method" value="add,edit,remove">';
			s += '</div>';
		s += '</div>';
		
	$('#sub_app_zone').append(s);

}
fn.app.zystem.engine.builder.append_pageapp = function(){
	var s = '';
		s += '<div class="form-group row">';
			s += '<div class="col-sm-1">';
					s += '<button class="btn btn-danger" onclick="$(this).parent().parent().remove();"><i class="fa fa-times" aria-hidden="true"></i></button>';
			s += '</div>';
			s += '<div class="col-sm-2">';
				s += '<select type="text" class="form-control" name="page_type[]">';
					s += '<option value="page">Page</option>';
					s += '<option value="dialog">Dialog</option>';
				s += '</select>';
			s += '</div>';
			s += '<div class="col-sm-2">';
				s += '<input type="text" class="form-control" name="page_name[]" placeholder="Page Name">';
			s += '</div>';
			s += '<div class="col-sm-2">';
				s += '<input type="text" class="form-control" name="page_caption[]" placeholder="Caption">';
			s += '</div>';
			s += '<div class="col-sm-2">';
			s += '<input type="text" class="form-control" name="page_icon[]" value="fa fa-house" placeholder="Icon">';
			s += '</div>';
		s += '</div>';
	$('#sub_page_zone').append(s);

}
