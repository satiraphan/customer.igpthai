<?php
  global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_page");

	$page = $dbc->GetRecord("cms_pages","*","id=".$_GET['id']);
  $sql = "SELECT id,type,code,title FROM cms_contents WHERE status = 1";
  $rst = $dbc->Query($sql);
  $contents = array();
  while($line = $dbc->Fetch($rst)){
    array_push($contents,
      array(
        "id" => $line['id'],
        "type" => $line['type'],
        "code" => $line['code'],
        "title" => $line['title'],
        "text" => $line['code']." : (".$line['type'].") ".$line['title']
      )
    );
  }

?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Layout Designer</h5>
	</div>	
	<div id="designer-view" class="card-body" data-layout='<?php echo $page['layout'];?>' data-contents='<?php echo json_encode($contents); ?>'>
    <div class="block-row-nomove">
		  <div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_row(this)">+</button></div>
    </div>
<!--
    <div class="block-row">
      <div class="designer-row">
        <div class="block-actions">
          <button class="action-btn move-anchor" ><i class="fa-solid fa-arrows-alt"></i></button>
          <button class="action-btn" onclick="fn.app.page.layout.remove_row(this)" title="ลบ"><i class="fa-solid fa-trash"></i></button>
          <select class="" onchange="fn.app.page.layout.change_column(this)" title="เปลี่ยนคอลัมน์">
            <option value="12">1 คอลัมน์</option>
            <option value="6-6">2 คอลัมน์ เท่ากัน</option>
            <option value="4-4-4">3 คอลัมน์ เท่ากัน</option>
            <option value="8-4">2 คอลัมน์ 8:4</option>
            <option value="4-8">2 คอลัมน์ 4:8</option>
            <option value="3-3-3-3">4 คอลัมน์ เท่ากัน</option>
          </select>
        </div>
			<div class="row block-content">
				<div class="col-12 row block-content" data-col="12">
          <div class="col-6 designer-col">
            <select class="form-control">
              <option value="header">Header</option>
              <option value="footer">Footer</option>
              <option value="sidebar">Sidebar</option>
              <option value="content">Content</option>
					  </select>
          </div>
          <div class="col-6 designer-col">
            <select class="form-control">
              <option value="header">Header</option>
              <option value="footer">Footer</option>
              <option value="sidebar">Sidebar</option>
              <option value="content">Content</option>
					  </select>
          </div>
		      <div class="hr-plus"><button type="button" class="btn-plus" onclick="fn.app.page.layout.append_content(this)">+</button></div>';
				</div>
			</div>
		</div>
-->

	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.page.save_layout(<?php echo $page['id'];?>)"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>

<style>
.hr-plus {
  position: relative;
  width: 100%;
  margin: 10px 0;
  text-align: center;
}

.hr-plus::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  width: 100%;
  height: 1px;
  background: #ddd;
  transform: translateY(-50%);
}

.btn-plus {
  position: relative;
  z-index: 1;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  border: 1px solid #ccc;
  background: #fff;
  cursor: pointer;
  font-size: 18px;
  line-height: 30px;
  padding: 0;
}

.btn-plus:hover {
  background: #f5f5f5;
}


/*
.hr-plus {
  opacity: 0;
  transition: opacity 0.2s;
}
	
.hr-plus:hover {
  opacity: 1;
}

*/

.designer-row{
  border: 2px dashed #ddd;
}

.designer-col {
  position: relative;
  min-height: 80px;
  background: #fff;
  padding: 10px;
  transition: border-color .2s;
}

.designer-col:hover {
  border-color: #0d6efd;
}

/* Toolbar */
.block-actions {
  position: relative;
  top: -14px;
  right: -14px;
  display: flex;
  gap: 6px;
  opacity: 1;
  transition: .2s;
}



.designer-col:hover .block-actions {
  opacity: 1;
}

.move-anchor{
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #fff;
  line-height: 26px;
  text-align: center;

}

/* Icon Button */
.action-btn {
  border: 1px solid #ccc;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  background: #fff;
  font-size: 14px;
  line-height: 26px;
  text-align: center;
  box-shadow: 0 1px 4px rgba(0,0,0,.15);
}

.action-btn:hover {
  background: #0d6efd;
  color: #fff;
  border-color: #0d6efd;
}

.block-content{
	margin-top: 20px;
	margin-left:0px;
	margin-right:0px;
}

.designer-col{
  border: 1px solid #ccc;
}
.content-block:not(.no-move){
	margin-top: 20px;
}

.content-item .block-actions .action-btn ,.content-item .block-actions .move-anchor-content{
  margin-top: 6px;
}
</style>