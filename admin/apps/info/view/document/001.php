<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-tag'></i> Documentation : 001 Create New Application
		<small>
			ตัวอย่างการสร้าง Application ใหม่
		</small>
	</h1>
</div>
<div class="card mb-g">
	<div class="card-body">
		<h2 class="fw-700 m-0">Create New Application
		<small class="m-0">
			ในบทเรียนนี้ผู้เรียนจะได้เห็นวิธีการสร้าง Application ใหม่อย่างละเอียด และวิธีจัดการ MCV เบื้องต้น โดยใช้ระบบ Maewnam Web UI และ ระบบจัดการบริหารของ OceanOS
			แนะนำว่าผู้อ่านควรศึกษา MCV Structure ก่อนว่ามีการทำงานอย่างไร แล้วค่อยลงมือ ปฏิบัติตาม ในบทการเรียนรู้นี้ จะมีตัวอน่างเป็นการสร้าง Application ที่ชื่อว่า Inventory
			ซึ่งจะเป็นต้นแบบในการจัดการ Porduct Category และ Brands
		</small>
		</h2>
		<ol class="list-group">
			<li class="list-group-item">สร้าง Application Directory</li>
		</ol>
		</div>
		
</div>
<div class="card mb-g">
	<div class="card-body">
		<h3 class="mt-2">1. Prepare File and Directory</h3>
		<p>เริ่มต้นจาการสร้าง File และ Directory ดังต่อไปนี้	
		</p>
		<code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			mkdir inventory<br>
			mkdir inventory/include<br>
			mkdir inventory/control<br>
			mkdir inventory/store<br>
			mkdir inventory/view<br>
		</code>
		<h3>2. Create Main Index File</h3>
		<p>index.php จะเป็นจุดเริ้มต้นของ Modules ซึ่งจะเป็นการเรียนผ่าน AJAX จากระบบ Menu</p>
		<code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			touch inventory/index.php
		</code>
		<p>หลังจากนั้นให้แก้ไขไฟร์ index.php</p>
		
		<pre class="bg-warning-50 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
&lt;?php
	include "../../config/define.php";
	include "../../include/db.php";
	include "../../include/oceanos.php";
	include "../../include/iface.php";
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);
	$panel = new ipanel($dbc,$os->auth);
	
	$panel->setApp("info","Information");
	$panel->setView(isset($_GET['view'])?$_GET['view']:'about');
	
	$panel->setMeta(array(
		array('product'		,"Product"	,'fa fa-lg fa-cubes'),
		array('category'	,"Category"	,'fa fa-lg fa-category'),
		array('brand'		,"Brand"	,'fa fa-lg fa-brand'),
	));
	
	$panel->PageBreadcrumb();
?>
&lt;script src="apps/inventory/include/interface.js"&gt;&lt;/script&gt;
&lt;div class="row"&gt;
	&lt;div class="col-xl-12"&gt;
	&lt;?php
		$panel->EchoInterface();
	?>
	&lt;/div&gt;
&lt;?div&gt;

&lt;script&gt;
	loadScript("js/datagrid/datatables/datatables.bundle.js", function(){
	loadScript("js/datagrid/datatables/datatables.export.js", function(){
	loadScript("js/dependency/moment/moment.js",function(){
	&lt;?php
		switch($panel->getView()){
			case "product":
				include "control/controller.product.view.js";
				if($os->allow("inventory","remove"))include "control/controller.product.remove.js";
				if($os->allow("inventory","add"))include "control/controller.product.add.js";
				if($os->allow("inventory","edit"))include "control/controller.product.edit.js";
				break;
			case "category":
				include "control/controller.category.view.js";
				if($os->allow("inventory","remove"))include "control/controller.category.remove.js";
				if($os->allow("inventory","add"))include "control/controller.category.add.js";
				if($os->allow("inventory","edit"))include "control/controller.category.edit.js";
				break;
			case "brand":
				include "control/controller.brand.view.js";
				if($os->allow("inventory","remove"))include "control/controller.brand.remove.js";
				if($os->allow("inventory","add"))include "control/controller.brand.add.js";
				if($os->allow("inventory","edit"))include "control/controller.brand.edit.js";
				break;
		}
	?&gt;
	});});});
&lt;/script&gt;
		</pre>
		<div class="height-1 mb-3"></div>
			<h3>3. Create inteface.js File</h3>
		<p>นโยบายของระบบเราจะใช้ interface.js เป็นการสร้าง function ล่วงหน้าสำหรับระบบจัดการ เพื่อทำงานร่วมกับ Permission</p>
		
		<code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			touch inventory/include/inteface.js
		</code>
		<p>หลังจากนั้นให้แก้ไขไฟร์ inteface.js</p>
		
		<pre class="bg-warning-50 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
var inventory = {
	product : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess
	},
	category : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess
	},
	brand : {
		dialog_lookup : fn.noaccess,
		dialog_add : fn.noaccess,
		dialog_edit : fn.noaccess,
		dialog_remove : fn.noaccess,
		add : fn.noaccess,
		edit : fn.noaccess,
		remove : fn.noaccess
	},
};
$.extend(fn.app,{inventory:inventory});
		</pre>
		<div class="height-1 mb-3"></div>
	<h3>4. Create Each Modules Under Application</h3>
		<p>หลัจากนั้นเราจะสร้าง File ที่จำเป็นสำหรับ Moudles 3 ตัวที่อยู่ใน Application ดังต่อไปนี้</p>
		<code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			touch inventory/control/controller.brand.add.js<br>
			touch inventory/control/controller.brand.edit.js<br>
			touch inventory/control/controller.brand.lookup.js<br>
			touch inventory/control/controller.brand.remove.js<br>
			touch inventory/control/controller.brand.view.js<br>
			touch inventory/control/controller.category.add.js<br>
			touch inventory/control/controller.category.edit.js<br>
			touch inventory/control/controller.category.lookup.js<br>
			touch inventory/control/controller.category.remove.js<br>
			touch inventory/control/controller.category.view.js<br>
			touch inventory/control/controller.product.add.js<br>
			touch inventory/control/controller.product.edit.js<br>
			touch inventory/include/control/controller.product.lookup.js<br>
			touch inventory/control/controller.product.remove.js<br>
			touch inventory/control/controller.product.view.js<br><br>
			touch inventory/store/store-brand.php<br>
			touch inventory/store/store-category.php<br>
			touch inventory/store/store-product.php<br><br>
			touch inventory/view/dialog.brand.add.php<br>
			touch inventory/view/dialog.brand.edit.php<br>
			touch inventory/view/dialog.brand.lookup.php<br>
			touch inventory/view/dialog.brand.remove.php<br>
			touch inventory/view/dialog.category.add.php<br>
			touch inventory/view/dialog.category.edit.php<br>
			touch inventory/view/dialog.category.lookup.php<br>
			touch inventory/view/dialog.category.remove.php<br>
			touch inventory/view/dialog.product.add.php<br>
			touch inventory/view/dialog.product.edit.php<br>
			touch inventory/view/dialog.product.lookup.php<br>
			touch inventory/view/dialog.product.remove.php<br>
			touch inventory/view/pageb.brand.php<br>
			touch inventory/view/pageb.category.php<br>
			touch inventory/view/pageb.product.php<br><br>
			touch inventory/xhr/action-add-brand.php<br>
			touch inventory/xhr/action-add-category.php<br>
			touch inventory/xhr/action-add-product.php<br>
			touch inventory/xhr/action-edit-brand.php<br>
			touch inventory/xhr/action-edit-category.php<br>
			touch inventory/xhr/action-edit-product.php<br>
			touch inventory/xhr/action-load-brand.php<br>
			touch inventory/xhr/action-load-category.php<br>
			touch inventory/xhr/action-load-product.php<br>
			touch inventory/xhr/action-remove-brand.php<br>
			touch inventory/xhr/action-remove-category.php<br>
			touch inventory/xhr/action-remove-product.php<br>
		</code>
		<p>หลังจากนั้นก็เขียนระบบ ในแต่ละ Moudles</p>
		
		<pre class="bg-warning-50 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">

		</pre>
		<div class="height-1 mb-3"></div>
		
	</div>
</div>  
<div class="card mb-g">
	<div class="card-body">
		<h2 class="fw-700 mb-g">
		File Structure
		<small>
		This webapp toolkit comes with a flexible file structure that can be easily used for small to large scope projects. This section will explains app's file structure and how to adapt it to your project.
		</small>
		</h2>
		<ul>
			<li>index.php</li>
			<li>control</li>
			<ul>
				<li>controller.brand.add.js</li>
				<li>controller.brand.edit.js</li>
				<li>controller.brand.lookup.js</li>
				<li>controller.brand.remove.js</li>
				<li>controller.brand.view.js</li>
				<li>controller.category.add.js</li>
				<li>controller.category.edit.js</li>
				<li>controller.category.lookup.js</li>
				<li>controller.category.remove.js</li>
				<li>controller.category.view.js</li>
				<li>controller.product.add.js</li>
				<li>controller.product.edit.js</li>
				<li>controller.product.lookup.js</li>
				<li>controller.product.remove.js</li>
				<li>controller.product.view.js</li>
			</ul>
			<li>include</li>
			<ul>
				<li>interface.js</li>
			</ul>
			<li>store</li>
			<ul>
				<li>store-brand.php</li>
				<li>store-category.php</li>
				<li>store-product.php</li>
			</ul>
			<li>view</li>
			<ul>
				<li>dialog.brand.add.php</li>
				<li>dialog.brand.edit.php</li>
				<li>dialog.brand.lookup.php</li>
				<li>dialog.brand.remove.php</li>
				<li>dialog.category.add.php</li>
				<li>dialog.category.edit.php</li>
				<li>dialog.category.lookup.php</li>
				<li>dialog.category.remove.php</li>
				<li>dialog.product.add.php</li>
				<li>dialog.product.edit.php</li>
				<li>dialog.product.lookup.php</li>
				<li>dialog.product.remove.php</li>
				<li>pageb.brand.php</li>
				<li>pageb.category.php</li>
				<li>pageb.product.php</li>
			</ul>
			<li>xhr</li>
			<ul>
				<li>action-add-brand.php</li>
				<li>action-add-category.php</li>
				<li>action-add-product.php</li>
				<li>action-edit-brand.php</li>
				<li>action-edit-category.php</li>
				<li>action-edit-product.php</li>
				<li>action-load-brand.php</li>
				<li>action-load-category.php</li>
				<li>action-load-product.php</li>
				<li>action-remove-brand.php</li>
				<li>action-remove-category.php</li>
				<li>action-remove-product.php</li>
			</ul>
		</ul>
	</div>
</div>
                       
<div class="card mb-g">
	<div class="card-body">
		<h3 class="fw-500">
		Product Support
		<small>
		Customer support for SmartAdmin WebApp
		</small>
		</h3>
		<p>All support questions related to HTML and/or CSS will be honored. Issues that are encountered on the Seed versions of specific flavors of SmartAdmin are covered by their <a href="https://www.gotbootstrap.com/intel_introduction.html" target="_blank">respective authors</a>, but will be limited to HTML and/or CSS issues. If you need assistance with a technical issue that is currently not covered by the FAQ, you will need to have purchased a Full license of that flavor and contact the respective author for further assistance. The Full version links will be added to the <a href="https://www.gotbootstrap.com/info_app_flavors.html" target="_blank">Flavors</a> page once they are made available.</p>
	</div>
</div>