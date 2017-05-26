<script src="<?=base_url()?>assets/admin_lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/js/jquery-ui.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/fastclick/fastclick.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/app.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/demo.js"></script>
<script src="<?=base_url()?>assets/admin_lte/js/raphael-min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/knob/jquery.knob.js"></script>
<script src="<?=base_url()?>assets/admin_lte/js/moment.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/daterangepicker/daterangepicker.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/fastclick/fastclick.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/app.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/demo.js"></script>

<script type="text/javascript">

// log in
$("#sign_in").click(function() {
	if ($("#user").val() == "" || $("#pwd").val() == "") {
		alert("Please fill out all fields.");
		return;
	}

	$("#bar_div").removeClass("hide");
	$("#message").html("<p>Validating access.. <p>").removeClass("hide");
	$("#loading_bar").animate({ "width": "100%" }, "slow");
   	$.ajax({
       	type: "POST",
       	url: "<?=base_url()?>login/log_in",
       	data: {
           	user: $("#user").val(),
           	pwd: $("#pwd").val()
       	},
       	success: function(data) {
           	var obj = $.parseJSON(data);
           	if (obj.code == "99") {
				$("#bar_div").addClass("hide");
				$("#message").html("<p style='color:red'><b>"+obj.msg+"<b><p>");
				return;
           	}

           	$("#bar_div").removeClass("hide");
			$("#message").html("<p style='color:green'><b>"+obj.msg+"<b><p>");
			window.location.href = "<?=base_url()?>home/homepage";
       	}
	});
});
 
$("#user, #pwd").bind("keypress",function(e){
    if(e.which === 13) $("#sign_in").click();
});

//------- Selecting Prize Type -------//

$("#prize_category").change(function(){
	hideConfirm();
	var category = $("#prize_category option:selected").val();
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/prizes",
		data: { category: category},
		success: function(data){
			var obj = $.parseJSON(data);

			if (obj.code != "00") {
				alert(obj.msg);
				return;
			}

			$("#prize_type").empty().append("<option value='0'> --- Select --- </option>");
			for (i = 0; i < obj.msg.length; i++) {
				$("#prize_type").append("<option value='"+obj.msg[i].prize_id+"' data="+obj.msg[i].winner_count+"> "+obj.msg[i].prize_name+" </option>");
			}
			if ($("#prize_type").val() != "0") $("#prize_type").change();

		}
	});
});

$("#prize_type").change(function(){
	hideConfirm();
	var count = $("#prize_type option:selected").attr("data");
 	$('#winners').val(count);
});
//------------------------------------------//

//------- Select Winner From Entries -------//
$("#btnDraw").click(function() {
	if ($("#category").val() == 0 || $("#prize_category").val() == 0 || $("#prize_type").val() == 0 || $("#winners").val() == "") {
		alert("Please fill out all fields.");
		return;
	}

	$("#modal-info").show();
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/draw_winners", //controller
		data: { 
			category:$("#category option:selected").text(),
			winners:$("#winners").val()
		},

		success: function(data){
			$("#modal-info").hide();
			var obj = $.parseJSON(data),
				IDs = "";

			if (obj.code != "00") {
      			$("#confirm_div").addClass("hide");
				alert(obj.msg);
				return;
			}

			//clear table
			$("#tbody_winner").empty();

			//insert data to table
			for (i = 0; i < obj.msg.length; i++) {
				$("#tbody_winner").append(
					"<tr>",
						"<td style='text-align:center'><h3>"+obj.msg[i].pk+"</h3></td>",
						"<td style='text-align:center'><h3>"+obj.msg[i].fname+" "+obj.msg[i].lname+"</h3></td>",
						"<td style='text-align:center'><h3>"+obj.msg[i].product +"</h3></td>",
						"<td style='text-align:center'><h3>"+obj.msg[i].description +"</h3></td>",
						"<td style='text-align:center'><h3>"+obj.msg[i].tran_date +"</h3></td>",
        	"</tr>"
        	);
        		IDs = IDs + obj.msg[i].record_id + "|";
      		}

      		$("#record_id").val(IDs);
      		$("#confirm_div").removeClass("hide");
		}
	});
});

//------- Confirm Winners -------//
$("#btnConfirm").click(function() {
	$("#modal-info").show();
	$("#draw_form").attr('action', '<?=base_url()?>home/confirm_draw').submit();
});
//--//

//------- Upload Entries -------//
$("#btnEntry").click(function() {
	if ($("#category").val() == 0 || $("#filename").val() == "") {
		alert("Please fill out all fields.");
		return;
	}
	$("#modal-info").show();
    $("#entry_form").attr('action', '<?=base_url()?>home/upload_entries').submit();
});
//--//

$("#category").change(function() {
	hideConfirm();
	$("#promo_desc").val($("#category option:selected").text());
});

$("#btnReport").click(function() {
	if ($("#category").val() == 0 || $("#extract").val() == 0) {
		alert("Please fill out all fields.");
		return;
	}

	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/report_list",
		data: {
			category: $("#category").val(),
			criteria: $("#extract").val()
		},
		success: function(data) {
			
		}
	});
});

$("#btnCancel").click(function() {
	window.location.href = window.location.href;
});

function hideConfirm()
{
	$("#tbody_winner").empty();
	$("#confirm_div").addClass("hide");
}

</script>