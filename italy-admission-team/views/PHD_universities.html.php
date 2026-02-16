<?php 
$uniName = $_GET['university-name'];
$clientDegree = $_GET['client-degree'];

if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<!-- filter -->
<div class="card">
	<div class="card-body">
		<div class="row">
			<input type="hidden" name="" value="<?php echo $uniName;?>" id="uniName">
			<input type="hidden" name="" value="<?php echo $clientDegree;?>" id="clientDegree">
			<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
			<div class="form-group col-md-6 col-lg-3">
				<label>Client Status</label>
				<select class="form-control" name="client-convert-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-convert-status">
					<option value="all" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="New Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'New Client' ? 'selected' : '' ?>>New Client</option>
					<option value="Old Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Client' ? 'selected' : '' ?>>Old Client</option>
					<option value="Old Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Converted Client' ? 'selected' : '' ?>>Old Converted Client</option>
					<option value="Italy Old Client 2024" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Old Client 2024' ? 'selected' : '' ?>>Italy Old Client 2024</option>
					<option value="Austria Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Austria Converted Client' ? 'selected' : '' ?>>Austria Converted Client</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Country From</label>
				<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
					<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
					<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
					<option value="Saudi Arabia" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
				</select>
			</div>

			<div class="form-group col-md-6 col-lg-3">
				<label>Admission Status</label>
				<select class="form-control" name="admission-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="admission-status">
					<option value="all" <?= isset($_GET['admission-status']) && $_GET['admission-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="waiting" <?= isset($_GET['admission-status']) && $_GET['admission-status'] == 'waiting' ? 'selected' : '' ?>>waiting</option>
					<option value="Acceptance" <?= isset($_GET['admission-status']) && $_GET['admission-status'] == 'Acceptance' ? 'selected' : '' ?>>Acceptance</option>
					<option value="Rejection" <?= isset($_GET['admission-status']) && $_GET['admission-status'] == 'Rejection' ? 'selected' : '' ?>>Rejection</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Applied Status</label>
				<select class="form-control" name="applied-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="applied-status">
					<option value="all" <?= isset($_GET['applied-status']) && $_GET['applied-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="One Time Account Create" <?= isset($_GET['applied-status']) && $_GET['applied-status'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
				</select>
			</div>
		</div>

		<div class="alert alert-primary mt-1">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-7">
							<h5><?php echo $uniName;?></h5>
						</div>
						<?php 
						$selectQuery = "SELECT italy_opening_date, italy_closing_date, italy_note FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='$uniName' AND italy_degree_name='phd' ORDER BY italy_dates_id DESC LIMIT 1";
						$result = mysqli_query($con, $selectQuery);
						$dateRow = mysqli_fetch_assoc($result);
						if ($dateRow) {
							$openingDate = $dateRow['italy_opening_date'];
							$closingDate = $dateRow['italy_closing_date'];
						?>
						<div class="col-md-5">
							<?php if($openingDate!='0000-00-00' && $closingDate!='0000-00-00'){ ?>
							<h5><span data-toggle="tooltip" data-placement="top" title="Opening Date"><?php echo date('d-m-Y', strtotime($openingDate)); ?></span> / <span data-toggle="tooltip" data-placement="top" title="Closing Date"><?php echo date('d-m-Y', strtotime($closingDate)); ?></span></h5>
							<?php } ?>
						</div>
						<?php 
						}else{
						?>
						<div class="col-md-5"></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="float-left">
						<?php 
						$selectQuery = "SELECT italy_uni_cgpa FROM italy_university_cgpa WHERE status='1' AND close='1' AND italy_cgpa_uni_name ='$uniName' AND italy_cgpa_uni_degree='phd' ORDER BY italy_cgpa_uni_id DESC LIMIT 1";
						$result = mysqli_query($con, $selectQuery);
						$uniRow = mysqli_fetch_assoc($result);
						if($uniRow){
						$uniCGPA = $uniRow['italy_uni_cgpa'];
						?>
						<h5>Uni CGPA: <span data-toggle="tooltip" data-placement="top" title="University CGPA"><?php echo $uniCGPA;?></span></h5>
						<?php } ?>
					</div>
					<?php if($dateRow['italy_note']!=''){ ?>
					<div class="float-right">
						<span id="blink" class="text-danger"><b>Note:</b></span> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".addUniNote"><i class="mdi mdi-eye"></i></button>
					</div>
					<?php } ?>
				</div>

			</div>
		</div>
		<!--  Modal content for the above example -->
		<div class="modal fade addUniNote" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">University Opening & Closing Note</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 text-left">
								<?php echo $dateRow['italy_note'];?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- Model Close -->
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

		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="dataTables_length" id="datatable_length">
					<label>Show 
						<select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm" onchange="viewClientsFilter(1)" id="selectPage">
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="500">500</option>
						</select> 
					entries</label>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div class="float-right">
					<label>Search:<input type="text" name="" class="form-control form-control-sm" onkeyup="viewClientsFilter(1)" id="clientIDGet" style="margin-left: 0.5em; display: inline-block; width: auto;"></label>
				</div>
			</div>
		</div>

		<div id="loader" style="display: none;">
			<div class="loader">
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
			</div>
		</div>
		<!-- show data from model name start from view -->
		<div id="showClientsModel"></div>
	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});
	function viewClientsFilter(page) {
		var uniName = $("#uniName").val();
		var clientDegree = $("#clientDegree").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var admissionStatus = $("#admission-status").val();
		var appliedStatus = $("#applied-status").val();

		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();

		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (convertStatus!=='all') {
			params.set('client-convert-status', convertStatus);
		}else{
			params.delete('client-convert-status');
		}
		if (clientCountry!=='all') {
			params.set('client-country', clientCountry);
		}else{
			params.delete('client-country');
		}
		if (clientDegree!=='all') {
			params.set('client-degree', clientDegree);
		}else{
			params.delete('client-degree');
		}
		if (admissionStatus!=='all') {
			params.set('admission-status', admissionStatus);
		}else{
			params.delete('admission-status');
		}
		if (appliedStatus!=='all') {
			params.set('applied-status', appliedStatus);
		}else{
			params.delete('applied-status');
		}
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		} else {
			params.set('page-number', pageNo);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else{
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModel").hide();
		// Perform the AJAX request

		$.ajax({
			type: "POST",
			url: "models/viewAllClientsUniModel.php",
			data: {
				checkuniName: uniName,
				checkclientDegree: clientDegree,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkadmissionStatus: admissionStatus,
				checkappliedStatus: appliedStatus,
				checkselectPage: selectPage,
				pageNumber: pageNo,
				checkclientDetails: clientIDGet,
			},
			success: function(data) {
				// alert(data);
				$("#loader").hide();
				$("#showClientsModel").html(data);
				$("#showClientsModel").show();
			}
		});
	}
</script>