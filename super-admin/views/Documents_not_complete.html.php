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
		<!-- doc confirm form client -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="docModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Document Confirm</h4>
					</div>
					<div class="modal-body docModalClient">

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
$ajaxUrl = "models/viewDocNotCompleteModel.php";
include ('components/AllFiltersFunction.php');
?>
<script type="text/javascript">
	// check documents client function
	function documentClients(idclient) {
		var idclient = idclient;
		// alert(idclient);
		$.ajax({
			type: "POST",
			url: "models/documentState.php",
			data:'clientDocuments='+idclient,
			success: function(data){
				$(".docModalClient").html(data);
				$("#docModalClient").modal('show');
			}
		});
	};
</script>