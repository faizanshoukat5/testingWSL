<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<div class="card">
	<div class="card-body">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<?php include ('components/AllFiltersHtml.php'); ?>
		<!-- Track client Modal -->
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
		
		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>
		
	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
<?php
$ajaxUrl = "models/viewClientsModel.php";
include ('components/AllFiltersFunction.php');
?>