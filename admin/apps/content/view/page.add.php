<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_add_content");

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "type",
				"caption" => "ประเภทเนื้อหา",
				"source" => array(
					array("content","Content"),
					array("article","Article"),
					array("news","News"),
					array("activity","Activity"),
					array("gallery","Gallery")
				)
			)
		),
		array(
			array(
				"name" => "title",
				"caption" => "หัวข้อ",
				"placeholder" => "หัวข้อเนื้อหา"
			)
		),
		array(
			array(
				"type" => "textarea",
				"name" => "brief",
				"caption" => "สรุป",
				"placeholder" => "สรุปเนื้อหา หรือคำอธิบายสั้นๆ",
			)
		),
		array(
			array(
				"type" => "textarea",
				"name" => "data",
				"caption" => "เนื้อหา",
				"placeholder" => "เนื้อหา",
				"rows" => 10
			)
		),
		array(
			array(
				"type" => "date",
				"flex"=> 4,
				"name" => "date_start",
				"caption" => "วันที่เริ่มต้น",
				"placeholder" => "วันที่เริ่มต้นเนื้อหา"
			),
			array(
				"type" => "date",
				"flex"=> 4,
				"name" => "date_end",
				"caption" => "วันที่สิ้นสุด",
				"placeholder" => "วันที่สิ้นสุดเนื้อหา"
			)
		),
		array(
			array(
				"type" => "date",
				"flex"=> 4,
				"name" => "date_publish",
				"caption" => "วันที่เผยแพร่"
			),
			array(
				"type" => "date",
				"flex"=> 4,
				"name" => "date_terminate",
				"caption" => "วันที่สิ้นสุดการเผยแพร่",
				"placeholder" => "วันที่สิ้นสุดการเผยแพร่"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Add Content</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.content.add()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
