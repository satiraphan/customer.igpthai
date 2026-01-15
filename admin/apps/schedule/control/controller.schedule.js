	fn.app.schedule.schedule = {
		save : function(){
			let type = $("select[name=type]").val();
			var data = {};
			var items = [];
			if(type == "week"){
				$(".ui-selected").each(function(){
					let item = {
						day : $(this).attr("data-day"),
						hour : $(this).attr("data-hour"),
					}
					items.push(item);
				});
				data = {
					items : items
				}
			}else if(type == "yearplan"){
				$(".ui-selected").each(function(){
					let item = {
						date : $(this).attr("data-date"),
						month : $(this).attr("data-month"),
					}
					items.push(item);
				});
				data = {
					year : $("input[name=year]").val(),
					items : items
				}
			}

			$("input[name=data]").val(JSON.stringify(data));
			$.post("apps/schedule/xhr/action-save-schedule.php",$("form[name=form_edit_schedule]").serialize(),function(response){
				if(response.success){
					window.history.back();
				}else{
					fn.notify.warnbox(response.msg,"Oops...");
				}
			},"json");
		
		},
		btn_append_weekly : function(){
			
		},
		btn_append_schedule : function(){
			
		},
		btn_append_date : function(){
			let s = '';
			s += '<li class="col-sm-12 row mb-2">';
				s += '<div class="col-sm-2 text-right"><label>From</label></div>';
				s += '<div class="col-sm-4"><input type="text" name="custom_date_from[]" class="form-control custom_date_from"></div>';
				s += '<div class="col-sm-2 text-right"><label>To</label></div>';
				s += '<div class="col-sm-4"><input type="text" name="custom_date_to[]" class="form-control custom_date_to"></div>';
			s += '</li>';
			$("#schedule_custom ol").append(s);

			
			$("#schedule_custom  div:last-child .custom_date_from").datetimepicker();
			$("#schedule_custom  div:last-child .custom_date_to").datetimepicker();
		},
		init : function(){
			$("select[name=type]").change(function(){
				var aWeek = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
				var aShortWeek = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
				let s = '';
				var data_raw = $("input[name=data]").val();
				switch($(this).val()){
					case "week":
						s += '<button class="btn btn-dark" onclick="fn.app.schedule.schedule.btn_append_date()">Add Date</buttton>';
						$(".btn-area").html(s);

						s = '';
						s += '<div class="col-12 overflow-auto">'
							s += '<table id="selectable_schedule" class="table table-sm table-bordered">';
								s += '<thead>';
									s += '<tr>';
										s += '<th class="arrow">Day/Time</th>';
										for(h=0;h<=23;h++){
											s += '<th class="text-mute arrow">'+(h < 10 ? '0' + h : h)+':00</th>';
										}
									s += '</tr>';
								s += '</thead>';
								s += '<tbody>';
									for(i in aWeek){
										s += '<tr>';
											s += '<th class="text-right">'+aShortWeek[i]+'</th>';
											for(h=0;h<=23;h++){
												s += '<td data-day="'+i+'" data-hour="'+h+'"></td>';
											}
										s += '</tr>';
									}
								s += '</tbody>';
							s += '</table>';
						s += '</div>';
						$("#schedule_zone").html(s);
						$("#selectable_schedule").selectable({
							filter: "td"
						});

						
						if(data_raw != ""){
							let data = JSON.parse(data_raw);
							console.log(data);
							for(i in data.items){
								$("td[data-day="+data.items[i].day+"][data-hour="+data.items[i].hour+"]").addClass("ui-selected");
							}
						}
						break;
					case "yearplan":
						s += '<input name="year" type="year" class="form-control"></input>';
						s += '';
						$(".btn-area").html(s);
						$("#schedule_zone").html("");

						$( "input[name=year]" ).change(function(){
							let s = '';
							let year = parseInt($(this).val());
							
							s += '<div class="row">';
							if(year > 2000 && year <3000){
								for(m=1;m<12;m++){
									let date = new Date(year +'-'+(m < 10 ? '0' + m : m)+'-01');
									let month = date.getMonth() + 1; // Month is zero-indexed, so we add 1
									let numberOfDays = new Date(year, month, 0).getDate();
									let dayOfWeek = date.getDay();
									let total_row = Math.ceil((numberOfDays+dayOfWeek)/7);
									let monthName = date.toLocaleDateString('en-US', { month: 'long' });
									
									s += '<div class="col-sm-4">';
									s += '<table class="table table-sm table-bordered">';
										s += '<thead>';
										s += '<tr>';
											s += '<th colspan="7" class="text-center bg-dark text-white">'+monthName+'</th>';
										s += '</tr>';
										s += '<tr>';
											for(dw=0;dw < 7;dw++){
												s += '<th class="text-center bg-dark text-white">'+aShortWeek[dw]+'</th>';
											}
										s += '</tr>';
										s += '</thead>';
										s += '<tbody>';
										for(r=0;r<total_row;r++){
											s += '<tr>';
											for(d=0;d < 7;d++){
												let date = (7*r)+d+1-dayOfWeek;
												let class_addon = "";
												if(date<1){
													date = "";
													class_addon = " unselectable";
												}else if(date>numberOfDays){
													date = "";
													class_addon = " unselectable";
												}
												s += '<td class="text-center'+class_addon+'" data-date="'+date+'"  data-month="'+m+'">'+date+'</td>';
											}
											s += '</tr>';
										}
										s += '</tbody>';
									s +='</table>';
									s +='</div>';
								}
							}
							s +='</div>';
							$("#schedule_zone").html(s);
							$("#schedule_zone table").selectable({
								filter: "td:not(.unselectable)",
								classes: {
									"ui-selected": "bg-primary",
									"ui-selecting": "bg-warning"
								  }
							});

							if(data_raw != ""){
								let data = JSON.parse(data_raw);
								console.log(data);
								for(i in data.items){
									$("td[data-date="+data.items[i].date+"][data-month="+data.items[i].month+"]").addClass("ui-selected bg-primary");
								}
							}
						});

						if(data_raw != ""){
							let data = JSON.parse(data_raw);
							if(typeof data.year != "undefined"){
								$("input[name=year]").val(data.year).change();
							}
						}
						
						break;
					case "custom":
						s += '<button class="btn btn-dark" onclick="fn.app.schedule.schedule.btn_append_date()">Add Date</buttton>';
						$(".btn-area").html(s);
						s = '';
						s += '<div id="schedule_custom" class="row"><ol></ol></div>';
						$("#schedule_zone").html(s);
						break;
				}

				
			});
			
			$("select[name=type]").change();
		}
	}

	
	fn.app.schedule.schedule.init();
	/*
	function(){
		$.post("apps/schedule/xhr/action-schedule.php",$("form[name=form_schedule_schedule]").serialize(),function(response){
			if(response.success){
				window.history.back();
			}else{
				fn.notify.warnbox(response.msg,"Oops...");
			}
		},"json");
		return false;
	};


	
*/