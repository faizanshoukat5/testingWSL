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
								$uniDetails = "SELECT italy_uni_name FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2026' GROUP BY italy_uni_name";
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
								<option value="New Assign But Not Applied Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'New Assign But Not Applied Programs' ? 'selected' : '' ?>>New Assign But Not Applied Programs</option>
								<option value="CEnT-S Pass Not Applied Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'CEnT-S Pass Not Applied Programs' ? 'selected' : '' ?>>CEnT-S Pass Not Applied Programs</option>
								<option value="My Pending Programs Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Programs Report' ? 'selected' : '' ?>>My Pending Programs Report</option>
								<option value="My Pending Report Resolves by Admission Head" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Report Resolves by Admission Head' ? 'selected' : '' ?>>My Pending Report Resolves by Admission Head</option>

								<option value="One Time Account Create" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
							</select>
						</div>

						<div class="form-group col-md-6 col-lg-4">
							<label>Check Application</label>
							<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
								<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
								<optgroup label="Check Application">
									<option value="Inform the Head to Recheck the Application By Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform the Head to Recheck the Application By Client' ? 'selected' : '' ?>>Inform the Head to Recheck the Application By Client</option>
									<option value="Applications Sent to the Head for Rechecking By Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Applications Sent to the Head for Rechecking By Clients' ? 'selected' : '' ?>>Applications Sent to the Head for Rechecking By Clients</option>
									<option value="Client Requests to Head, Changes in the Application" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Client Requests to Head, Changes in the Application' ? 'selected' : '' ?>>Client Requests to Head, Changes in the Application</option>
									<option value="Changes Complete, And Sent to Admission Head" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Changes Complete, And Sent to Admission Head' ? 'selected' : '' ?>>Changes Complete, And Sent to Admission Head</option>
									
									<option value="Client Informed, How to Pay the Application Fee By Admission Head" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Client Informed, How to Pay the Application Fee By Admission Head' ? 'selected' : '' ?>>Client Informed, How to Pay the Application Fee By Admission Head</option>
									<option value="Application Approved And Fee Paid by Client, Now Submit the Application" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Application Approved And Fee Paid by Client, Now Submit the Application' ? 'selected' : '' ?>>Application Approved And Fee Paid by Client, Now Submit the Application</option>
									<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
									<option value="Sent Admission Applied Proof to Client By Admission Head" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Sent Admission Applied Proof to Client By Admission Head' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client By Admission Head</option>
									<option value="Received Request to Fill Bergamo Enrollment Fee Form" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Received Request to Fill Bergamo Enrollment Fee Form' ? 'selected' : '' ?>>Received Request to Fill Bergamo Enrollment Fee Form</option>
									<option value="Inform to Head to Pay Bergamo Enrollment Fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform to Head to Pay Bergamo Enrollment Fee' ? 'selected' : '' ?>>Inform to Head to Pay Bergamo Enrollment Fee</option>
								</optgroup>
								<optgroup label="Additional Activities">
									<option value="Additional Activities Required by University Clients Assign by Admission Head" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Clients Assign by Admission Head' ? 'selected' : '' ?>>Additional Activities Required by University Clients Assign by Admission Head</option>
									<option value="Additional Activities Required by University Task Complete by Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Task Complete by Processing Team' ? 'selected' : '' ?>>Additional Activities Required by University Task Complete by Processing Team</option>
								</optgroup>
								<optgroup label="Admission Status">
									<option value="Waiting for Admission decision" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
									<option value="Acceptance Letter Received Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
									<option value="University Admission Rejected Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
								</optgroup>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label>Direct Pre Enrollment Process</label>
							<select class="form-control" data-toggle='select2' name="pre-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="pre-process">
								<option value="all" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'all' ? 'selected' : '' ?>>All</option>
								<optgroup label="Application Checking">
									<option value="Applications Rechecked by Clients and Submit by Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Applications Rechecked by Clients and Submit by Team' ? 'selected' : '' ?>>Applications Rechecked by Clients and Submit by Team</option>
									<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
									<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
								</optgroup>
								<optgroup label="Admission Status">
									<option value="Waiting for Admission decision" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
									<option value="Acceptance and Summary Letter Received Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Acceptance and Summary Letter Received Clients' ? 'selected' : '' ?>>Acceptance and Summary Letter Received Clients</option>
									<option value="University Admission and Summary Rejected Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'University Admission and Summary Rejected Clients' ? 'selected' : '' ?>>University Admission and Summary Rejected Clients</option>
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

		<!-- Add Note to Document Collection -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
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
<script type="text/javascript">
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});
	function debounce(func, delay) {
		let timer;
		return function(...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}
	const debouncedViewClientsFilter = debounce(viewClientsFilter, 500);
	function viewClientsFilter(page) {
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientDegree = $("#client-degree").val();
		var intakeYear = $("#intake-year").val();
		var uniStatus = $("#university-status").val();
		var appliedPrograms = $("#applied-programs").val(); 
		var applicationStatus = $("#check-application").val();
		var preProcess = $("#pre-process").val();

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
		if (applicationStatus!=='all') {
			params.set('check-application', applicationStatus);
		}else{
			params.delete('check-application');
		}
		if (preProcess!=='all') {
			params.set('pre-process', preProcess);
		}else{
			params.delete('pre-process');
		}
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		}else {
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
			url: "models/viewAllClientsModel.php",
			data: {
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkintakeYear: intakeYear,
				checkuniStatus: uniStatus,
				checkappliedPrograms: appliedPrograms,
				checkapplicationStatus: applicationStatus,
				checkpreProcess: preProcess,
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

	// Add note to Admission head
	function docAdmissionNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'checkAdmissionNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>