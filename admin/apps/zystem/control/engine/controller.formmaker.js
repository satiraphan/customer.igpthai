
fn.app.zystem.engine.formmaker = {
	add : function(){
		bootbox.prompt({
			title: "Please input form name", 
			centerVertical: true,
			callback: function(result){
				if(result != null){
					$.post("apps/zystem/xhr/engine/action-form-add.php",{name:result},function(html){
						window.location.reload();
					});
				}
			}
		});
	},
	remove : function(position){
		bootbox.confirm({
			title: "Remove?",
			message: "Are you sure to remove form pos #"+position,
			buttons: {
				cancel: {
					label: '<i class="fa fa-times"></i> Cancel'
				},
				confirm: {
					label: '<i class="fa fa-check"></i> Confirm'
				}
			},
			callback: function (result) {
				if(result)
				$.post("apps/zystem/xhr/engine/action-form-remove.php",{position:position},function(html){
					window.location.reload();
				});
			}
		});
		
		
	},
	
	
	
	save : function(){
		
	},
	build : function(){
		
	},
	append : function(){
		
	},
	init : function(){
		
	}
};
