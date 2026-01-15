<?php
	global $os;

	//$user = $this->dbc->GetRecord("os_users","*","id=".$_SESSION['auth']['user_id']);
	//$setting = json_decode($user['setting'],true);
	
	$modal = new iform($this->dbc,$this->auth);
	$modal->setForm("form_appbuilder");
	
	$item = json_decode($os->load_variable('aAppBuilder','json'),true);
	
	$subitem = array();
	if(isset($item['subapp'])){
		for($i=0;$i<count($item['subapp']);$i++){
			array_push($subitem,array(
				array(
					"flex" => 1,
					"type" => 'button',
					"name" => '<i class="fa fa-times" aria-hidden="true"></i>',
					"class" => "btn btn-danger",
					"onclick" => "$(this).parent().parent().remove();",
				),array(
					"caption" => "Appname",
					"flex-label" => 1,
					"flex" => 4,
					"name" => "subapp[]",
					"placeholder" => "Application Name",
					"value" => $item['subapp'][$i]
				),array(
					"caption" => "Caption",
					"flex-label" => 1,
					"flex" => 5,
					"name" => "subcaption[]",
					"placeholder" => "Caption",
					"value" => $item['subcaption'][$i]
				),array(
					"caption" => "Method",
					"name" => "method[]",
					"placeholder" => "Method",
					"value" => $item['method'][$i]
				)
			));
		}
	}


	$subpage = array();
	if(isset($item['page_name'])){
		for($i=0;$i<count($item['page_name']);$i++){
			array_push($subpage,array(
				array(
					"flex" => 1,
					"type" => 'button',
					"name" => '<i class="fa fa-times" aria-hidden="true"></i>',
					"class" => "btn btn-danger",
					"onclick" => "$(this).parent().parent().remove();",
				),array(
					"flex" => 2,
					"type" => 'combobox',
					"name" => "page_type[]",
					"source" => array(
						array("page","Page"),
						array("dialog","Dialog")
					),
					"value" => $item['page_type'][$i]
				),array(
					"flex" => 2,
					"name" => "page_name[]",
					"placeholder" => "Application Name",
					"value" => $item['page_name'][$i]
				),array(
					"flex" => 2,
					"name" => "page_caption[]",
					"placeholder" => "Caption",
					"value" => $item['page_caption'][$i]
				),array(
					"flex" =>2,
					"name" => "page_icon[]",
					"placeholder" => "Icon",
					"value" => $item['page_icon'][$i]
				),
			));
		}
	}
	
	$blueprint = array(
		array(
			"group" => "setting_group",
			"type" => "tablist",
			"items" => array(
				array(
					"group" => "group_a",
					"name" => "General",
					"type" => "tab",
					"items" => array(
						array(
							array(
								"caption" => "Name",
								"flex" => 4,
								"name" => "appname",
								"placeholder" => "Application Name",
								"value" => $item['appname']
							),array(
								"caption" => "Icon",
								"flex-label" => 1,
								"flex" => 5,
								"name" => "icon",
								"placeholder" => "Icon Code",
								"value" => $item['icon']
							)
						),
						array(
							array(
								"caption" => "Caption",
								"name" => "name",
								"placeholder" => "Caption",
								"value" => $item['name']
							)
						),
						array(
							array(
								"type" => "combobox",
								"caption" => "Type",
								"source" => array(
									array("standard","Standard"),
									array("method","Method Only"),
									array("page","Page Style")
								),
								"name" => "type",
								"placeholder" => "Caption",
								"value" => $item['type']
							)
						)
					)
				),
				array(
					"group" => "group_b",
					"name" => "Subapp",
					"type" => "tab",
					"items" => array(
						array(
							array(
								"type" => "button",
								"class" => "btn btn-primary",
								"name" => "Add Subapp",
								"onclick" => "fn.app.zystem.engine.builder.append_subapp()"
							)
						),array(
							"group" => "sub_app_zone",
							"items" => $subitem
						)
					)
				),
				array(
					"group" => "group_c",
					"name" => "Page Mode",
					"type" => "tab",
					"items" => array(
						array(
							array(
								"type" => "button",
								"class" => "btn btn-primary",
								"name" => "Add Paging",
								"onclick" => "fn.app.zystem.engine.builder.append_pageapp()"
							)
						),array(
							"group" => "sub_page_zone",
							"items" => $subpage
						)
					)
				)
			)
		),'hr',
		array(
			"group" => "btn_control",
			"type" => "inline",
			"items" => array(
				array(
					"inline" => true,
					"type" => "button",
					"class" => "btn btn-primary mr-2",
					"name" => "Build",
					"onclick" => "fn.app.zystem.engine.builder.build()"
				),array(
					"inline" => true,
					"type" => "button",
					"class" => "btn btn-warning",
					"name" => "Save",
					"onclick" => "fn.app.zystem.engine.builder.save()"
				)
			)
		)
	);
	
	
	
	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();

?>