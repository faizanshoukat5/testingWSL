<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<form action="" method="get" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
					<?php include ('components/AllFiltersHtml.php'); ?>
				</form>

			</div>
		</div>

		<!-- Track client -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="viewModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Track Client</h4>
					</div>
					<div class="modal-body viewModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- bank confirm form the super admin -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle" id="myLargeModalLabel"> </h4>
					</div>
					<div class="modal-body showModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>

	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
<?php
$ajaxUrl = "models/viewPaymentNotConfirmModel.php";
include ('components/AllFiltersFunction.php');
?>
<script type="text/javascript">
	function payConfirmClient(idpay) {
		var idpay = idpay;
		// alert(idpay);
		$.ajax({
			type: "POST",
			url: "models/accountPayState.php",
			data:'clientPayConfirm='+idpay,
			success: function(data){
				// alert(data);
				$(".showModalTitle").html('Client Payment Confirmation');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Bank confirm from the admin function
	function bankConfirm(idbank) {
		var idbank = idbank;
		// alert(idbank);
		$.ajax({
			type: "POST",
			url: "models/accountPayState.php",
			data:'bankPayConfirm='+idbank,
			success: function(data){
				// alert(data);
				$(".showModalTitle").html('Bank Payment Confirm');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Manager confirm from the Manager Software
	function managerConfirm(idMan) {
		var idMan = idMan;
		// alert(idMan);
		$.ajax({
			type: "POST",
			url: "models/accountPayState.php",
			data:'managerConfirm='+idMan,
			success: function(data){
				// alert(data);
				$(".showModalTitle").html('Manager Receipt Confirm');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>