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
			<div class="col-md-12">
				<form action="" method="get" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
					<div class="row">
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
							<label>Degree</label>
							<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree">
								<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
								<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
								<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
								<option value="mbbs" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
								<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-3">
							<label>Intake</label>
							<select class="form-control" name="intake-year" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="intake-year">
								<option value="all" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'all' ? 'selected' : '' ?>>All</option>
								<option value="25-26" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '25-26' ? 'selected' : '' ?>>2025-2026</option>
								<option value="26-27" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '26-27' ? 'selected' : '' ?>>2026-2027</option>
								<option value="Both" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'Both' ? 'selected' : '' ?>>2025-2026/2026-2027(Both)</option>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label>University Wise</label>
							<select class="form-control" data-toggle='select2' name="university-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="university-status">
								<option value="all" <?= isset($_GET['university-status']) && $_GET['university-status'] == 'all' ? 'selected' : '' ?>>All</option>
								<?php
								$uniDetails = "SELECT italy_uni_name FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2025' GROUP BY italy_uni_name";
								$uniDetails_ex = mysqli_query($con, $uniDetails);
								while ($addRow = mysqli_fetch_assoc($uniDetails_ex)) {
									$selected = isset($_GET['university-status']) && $_GET['university-status'] == $addRow['italy_uni_name'] ? 'selected' : '';
								?>
								<option value="<?php echo $addRow['italy_uni_name'];?>" <?= $selected;?>> <?php echo $addRow['italy_uni_name'];?>
								</option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label>Applied</label>
							<select class="form-control" name="applied-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="applied-programs">
								<option value="all" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'all' ? 'selected' : '' ?>>All</option>
								<option value="All Assign Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'All Assign Programs' ? 'selected' : '' ?>>All Assign Programs</option>
								<option value="Total Applied Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'Total Applied Programs' ? 'selected' : '' ?>>Total Applied Programs</option>
								<option value="My Pending Programs Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Programs Report' ? 'selected' : '' ?>>My Pending Programs Report</option>
								<option value="My Pending Report Resolves by Admission Head" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Report Resolves by Admission Head' ? 'selected' : '' ?>>My Pending Report Resolves by Admission Head</option>

								<option value="One Time Account Create" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label>Self & WSL Acceptance Pre Enrollment Process</label>
							<select class="form-control" data-toggle='select2' name="pre-accept-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="pre-accept-process">
								<option value="all" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'all' ? 'selected' : '' ?>>All</option>
								<option value="New Pre Enrollment Application Received" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'New Pre Enrollment Application Received' ? 'selected' : '' ?>>New Pre Enrollment Application Received</option>
								<optgroup label="Application Checking">
									<option value="Applications Rechecked by Clients and Submit by Team" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Applications Rechecked by Clients and Submit by Team' ? 'selected' : '' ?>>Applications Rechecked by Clients and Submit by Team</option>
									<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
									<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
								</optgroup>
								<optgroup label="Admission Status">
									<option value="Waiting for Admission decision" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
									<option value="Summary Letter Received Clients" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Summary Letter Received Clients' ? 'selected' : '' ?>>Summary Letter Received Clients</option>
									<option value="Summary Letter Rejected Clients" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Summary Letter Rejected Clients' ? 'selected' : '' ?>>Summary Letter Rejected Clients</option>
								</optgroup>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>

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
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientDegree = $("#client-degree").val();
		var intakeYear = $("#intake-year").val();
		var uniStatus = $("#university-status").val();
		var appliedPrograms = $("#applied-programs").val();
		var preAcceptProcess = $("#pre-accept-process").val();

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
		if (intakeYear!=='all') {
			params.set('intake-year', intakeYear);
		}else{
			params.delete('intake-year');
		}
		if (uniStatus!=='all') {
			params.set('university-status', uniStatus);
		}else{
			params.delete('university-status');
		}
		if (appliedPrograms!=='all') {
			params.set('applied-programs', appliedPrograms);
		}else{
			params.delete('applied-programs');
		}
		if (preAcceptProcess!=='all') {
			params.set('pre-accept-process', preAcceptProcess);
		}else{
			params.delete('pre-accept-process');
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
			url: "models/viewPreEnrollmentClientsModel.php",
			data: {
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkintakeYear: intakeYear,
				checkuniStatus: uniStatus,
				checkappliedPrograms: appliedPrograms,
				checkpreAcceptProcess: preAcceptProcess,
				checkselectPage: selectPage,
				pageNumber: pageNo,
				checkclientDetails: clientIDGet,
			},
			success: function(data) {
				$("#loader").hide();
				$("#showClientsModel").html(data);
				$("#showClientsModel").show();
			}
		});
	}
</script>