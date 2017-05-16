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
	var category	=	$("#category option:selected").val();
	// var prize_category	=	$("#prize_category option:selected").val();
	// var prize_type	=	$("#prize_type option:selected").val();
	// alert(category);
	// if(category = "Major"){
	// 		type.set
	// }

	$("#tbl_winners").show();
		$.ajax({
			type: "POST",
			url: "<?=base_url()?>home/draw", //controller
			data: { 
				// prize_category:prize_category
				// prize_type:prize_type
				category:category
			},
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
    $("#entry_form").attr('action', '<?=base_url()?>home/upload_entries').submit();
});

$("#btnReport").click(function() {
    alert(1);
});

$("#btnConfirm").click(function() {
    alert(1);
});

$("#prize_category").change(function(){
	// var category = this.element.val();
	var category	=	$("#prize_category option:selected").val();
	// alert(category);
	// if(category = "Major"){
	// 		type.set
	// }
	$.ajax({
		type: "POST",
		url: "<?=base_url()?>home/prizes", //controller
		data: { category: category},
		success: function(data){
			var obj = $.parseJSON(data);

			$("#prize_type").empty();
			for (i = 0; i < obj.length; i++) {
				$("#prize_type").append("<option value="+obj[i].winner_count+"> "+obj[i].prize_name+" </option>");
			}
		}
	});
});

$("#prize_type").change(function(){
	var count = $(this).val();
	alert(count);
 	$('#winners').val(count);
});

</script>