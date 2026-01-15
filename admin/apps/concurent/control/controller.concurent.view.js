$('#tblConcurrent').DataTable({
	"autoWidth" : true,
	"processing": true,
	"serverSide": true,
	"ajax": "apps/concurent/store/store-concurent.php",
	"aoColumns": [
		{"bSortable": true	,"data":"id"},
		{"bSortable": false	,"data":"token"},
		{"bSortable": false	,"data":"package"},
		{"bSortable": false	,"data":"created","class":"text-nowrap"},
		{"bSortable": false	,"data":"updated","class":"text-nowrap"},
		{"bSortable": false	,"data":"status"},
		{"bSortable": false	,"data":"session_id"},
		{"bSortable": false	,"data":"user_id"},
		{"bSortable": false	,"data":"user_name"},
		{"bSortable": false	,"data":"device"},
		{"bSortable": false	,"data":"login","class":"text-nowrap"},
		{"bSortable": false	,"data":"connected","class":"text-nowrap"},
		{"bSortable": false	,"data":"ip_address"},
		{"bSortable": false	,"data":"connect_counter"},
		{"bSortable": false	,"data":"display"}
	]
});


function RunRealtime(){
	setTimeout(() => {
		console.log($("#realtime").val());
		if($("#realtime").prop("checked")){
			$("#tblConcurrent").DataTable().draw();
			RunRealtime()
		}
	},1000);
	
}

$("#realtime").change(function(){
	RunRealtime();
});


/*
clearInterval(timer);
// Start timer
var timer = setInterval(fncName, 1000);
// End timer
timer = false;

$('#tblConcurrent').

setInterval(function () {element.innerHTML += "Hello"}, 1000);
*/