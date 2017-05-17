<script src="<?=base_url()?>assets/admin_lte/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/plugins/fastclick/fastclick.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/app.min.js"></script>
<script src="<?=base_url()?>assets/admin_lte/dist/js/demo.js"></script>
<script src="<?=base_url()?>assets/admin_lte/js/jquery-ui.min.js"></script>
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

$("#btnDraw").click(function() {
	var category = $("#category option:selected").val();

	$("#tbl_winners").show();
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/draw",
		data: { category: category },
		success: function(data){
			var obj = $.parseJSON(data);
			alert(obj);
			alert(data);
			$("#prize_type").empty();
				for (i = 0; i < obj.length; i++) {
				
			}
		}
	});
});

$("#btnEntry").click(function() {
	if ($("#category").val() == 0 || $("#filename").val() == "") {
		alert("Please fill out all fields.");
		return;
	}

    $("#entry_form").attr('action', '<?=base_url()?>home/upload_entries').submit();
});

$("#category").change(function() {
	$("#promo_desc").val($("#category option:selected").text());
});

$("#btnReport").click(function() {
    $("#tbl_reports").show();
});

$("#btnConfirm").click(function() {
    alert(1);
});

$("#prize_category").change(function(){
	var category	=	$("#prize_category option:selected").val();
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/prizes",
		data: { category: category},
		success: function(data){
			var obj = $.parseJSON(data);

			$("#prize_type").empty().append("<option value='0'> select </option>");
			for (i = 0; i < obj.length; i++) {
				$("#prize_type").append("<option value="+obj[i].winner_count+"> "+obj[i].prize_name+" </option>");
			}
			if ($("#prize_type").val() != "0") $("#prize_type").change();

		}
	});
});

$("#prize_type").change(function(){
	var count = $(this).val();
 	$('#winners').val(count);
});

</script>