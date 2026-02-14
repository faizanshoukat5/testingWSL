<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<!-- filter -->
<div class="card">
	<div class="card-body">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<div class="row">
			<div class="form-group col-md-6 col-lg-3">
				<label>Client Status</label>
				<select class="form-control" data-toggle='select2' name="client-convert-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-convert-status">
					<option value="all" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="New Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'New Client' ? 'selected' : '' ?>>New Client</option>
					<option value="Old Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Client' ? 'selected' : '' ?>>Old Client</option>
					<option value="Old Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Converted Client' ? 'selected' : '' ?>>Old Converted Client</option>
					<option value="Italy Old Client 2024" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Old Client 2024' ? 'selected' : '' ?>>Italy Old Client 2024</option>
					<option value="Italy Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Converted Client' ? 'selected' : '' ?>>Italy Converted Client</option>
					<option value="Austria Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Austria Converted Client' ? 'selected' : '' ?>>Austria Converted Client</option>
					<option value="France Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'France Converted Client' ? 'selected' : '' ?>>France Converted Client</option>
					<option value="Czech Republic Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Czech Republic Converted Client' ? 'selected' : '' ?>>Czech Republic Converted Client</option>
					<option value="Canada Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Canada Converted Client' ? 'selected' : '' ?>>Canada Converted Client</option>
					<option value="USA Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'USA Converted Client' ? 'selected' : '' ?>>USA Converted Client</option>
					<option value="Process Transferred to Another Applicant" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Process Transferred to Another Applicant' ? 'selected' : '' ?>>Process Transferred to Another Applicant</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Country From</label>
				<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
					<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
					<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
					<option value="Saudi Arabia" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
					<option value="Qatar" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Qatar' ? 'selected' : '' ?>>Qatar</option>
					<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Degree</label>
				<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree"> 
					<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
					<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
					<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Process Status</label>
				<select class="form-control" name="process-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="process-status">
					<option value="all" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Only Admission Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Only Admission Process' ? 'selected' : '' ?>>Only Admission Process</option>
					<option value="Overall Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Overall Process (Admission + Visa)' ? 'selected' : '' ?>>Overall Process (Admission + Visa)</option>
					<option value="Direct Visa" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Have Accepted Letter (Only Visa)' ? 'selected' : '' ?>>Have Accepted Letter (Only Visa)</option>
				</select>
			</div>

			<div class="form-group col-md-3">
				<label>Intake</label>
				<select class="form-control" name="intake-year" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="intake-year">
					<option value="all" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="25-26" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '25-26' ? 'selected' : '' ?>>2025-2026</option>
					<option value="26-27" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '26-27' ? 'selected' : '' ?>>2026-2027</option>
					<option value="Both" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'Both' ? 'selected' : '' ?>>2025-2026/2026-2027(Both)</option>
				</select>
			</div>

			<div class="form-group col-md-6 col-lg-3">
				<label>Checklist Status</label>
				<select class="form-control" name="checklist-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="checklist-status">
					<option value="all" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Super Legalization Checklist Not Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Super Legalization Checklist Not Sent Clients' ? 'selected' : '' ?>>Super Legalization Checklist Not Sent Clients</option>
					<option value="Super Legalization Checklist Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Super Legalization Checklist Sent Clients' ? 'selected' : '' ?>>Super Legalization Checklist Sent Clients</option>
					<option value="Nostrification Checklist Not Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Nostrification Checklist Not Sent Clients' ? 'selected' : '' ?>>Nostrification Checklist Not Sent Clients</option>
					<option value="Nostrification Checklist Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Nostrification Checklist Sent Clients' ? 'selected' : '' ?>>Nostrification Checklist Sent Clients</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>SOP's Status</label>
				<select class="form-control" name="sop-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="sop-status">
					<option value="all" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Sops Assign Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'Sops Assign Clients' ? 'selected' : '' ?>>Sop's Assign Clients</option>
					<option value="SOPs Not Assign Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'SOPs Not Assign Clients' ? 'selected' : '' ?>>SOP's Not Assign Clients</option>
					<option value="SOPs Received Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'SOPs Received Clients' ? 'selected' : '' ?>>SOP's Received Clients</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Assign To</label>
				<select class="form-control" name="assign-to" required="required" autocomplete="off" data-toggle="select2" onchange="viewClientsFilter(1)" id="assign-to">
					<option value="all" <?= isset($_GET['assign-to']) && $_GET['assign-to'] == 'all' ? 'selected' : '' ?>>All</option>
					<?php
					$wtUser = "SELECT wt_id, fname, lname FROM wt_users WHERE close='1' AND status='1' AND type='austria admission team' ";
					$wtUser_ex = mysqli_query($con, $wtUser);
					foreach ($wtUser_ex as $row) {
						$selected = isset($_GET['assign-to']) && $_GET['assign-to'] == $row['wt_id'] ? 'selected' : '';
						?>
						<option value="<?= $row['wt_id']; ?>" <?= $selected ?>><?= ucwords($row['fname']." ".$row['lname']); ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-2">
				<label>Assign</label>
				<select class="form-control" data-toggle='select2' name="assign-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-programs">
					<option value="all" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="All Not Assign Client" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Client' ? 'selected' : '' ?>>All Not Assign Client</option>
					<option value="All Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Assign Programs' ? 'selected' : '' ?>>All Assign Programs</option>
					<option value="All Not Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Programs' ? 'selected' : '' ?>>All Not Assign Programs</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Applied</label>
				<select class="form-control" name="applied-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="applied-programs">
					<option value="all" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="All Applied Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'All Applied Programs' ? 'selected' : '' ?>>All Applied Programs</option>
					<option value="New Assign But Not Applied Clients" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'New Assign But Not Applied Clients' ? 'selected' : '' ?>>New Assign But Not Applied Clients</option>
					<option value="My Pending Programs Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Programs Report' ? 'selected' : '' ?>>My Pending Programs Report</option>
					<option value="I Have Resolved the Pending Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'I Have Resolved the Pending Report' ? 'selected' : '' ?>>I Have Resolved the Pending Report</option>
					<option value="All Universities Admission Rejected Clients" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'All Universities Admission Rejected Clients' ? 'selected' : '' ?>>All Universities Admission Rejected Clients</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-4">
				<label>Check Application</label>
				<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
					<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Admission Application Form Fill" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Form Fill' ? 'selected' : '' ?>>Admission Application Form Fill</option>
					<option value="Admission Application Submitted" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Submitted' ? 'selected' : '' ?>>Admission Application Submitted</option>
					<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
					<option value="Inform to Client to Pay Application Fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform to Client to Pay Application Fee' ? 'selected' : '' ?>>Inform to Client to Pay Application Fee</option>
					<option value="Application Fee Paid By Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Application Fee Paid By Client' ? 'selected' : '' ?>>Application Fee Paid By Client</option>
					
					<option value="Waiting for Admission decision" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
					<option value="Acceptance Letter Received Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
					<option value="University Admission Rejected Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
					
					<option value="After Verification Dues Clear Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'After Verification Dues Clear Clients' ? 'selected' : '' ?>>After Verification Dues Clear Clients</option>
					<option value="After Verification Dues Remaining Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'After Verification Dues Remaining Clients' ? 'selected' : '' ?>>After Verification Dues Remaining Clients</option>
					<option value="After Verification Dues Not Clear Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'After Verification Dues Not Clear Clients' ? 'selected' : '' ?>>After Verification Dues Not Clear Clients</option>
					<option value="Additional Activities Required by University Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Clients' ? 'selected' : '' ?>>Additional Activities Required by University Clients</option>
					<option value="Additional Activities Required by University Task Completed" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Task Completed' ? 'selected' : '' ?>>Additional Activities Required by University Task Completed</option>
					<option value="Deadline Hold" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Deadline Hold' ? 'selected' : '' ?>>Deadline Hold</option>
					<option value="Deadline Release" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Deadline Release' ? 'selected' : '' ?>>Deadline Release</option>
					<option value="Self Received Acceptance" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Self Received Acceptance' ? 'selected' : '' ?>>Self Received Acceptance</option>
					<option value="Advance Remaining Payment Not Clear Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Advance Remaining Payment Not Clear Clients' ? 'selected' : '' ?>>Advance Remaining Payment Not Clear Clients</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>University Wise</label>
				<select class="form-control" data-toggle='select2' name="university-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="university-status">
					<option value="all" <?= isset($_GET['university-status']) && $_GET['university-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<?php
					$uniDetails = "SELECT aus_uni_name FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' GROUP BY aus_uni_name";
					$uniDetails_ex = mysqli_query($con, $uniDetails);
					while ($addRow = mysqli_fetch_assoc($uniDetails_ex)) {
						$selected = isset($_GET['university-status']) && $_GET['university-status'] == $addRow['aus_uni_name'] ? 'selected' : '';
						?>
					<option value="<?php echo $addRow['aus_uni_name'];?>" <?= $selected;?>> <?php echo $addRow['aus_uni_name'];?>
					</option>
					<?php } ?>
				</select>
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

		<!-- Add Note to Document Collection -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient1" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle1" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient1">

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
		var processStatus = $("#process-status").val();
		var intakeYear = $("#intake-year").val();
		var checklistStatus = $("#checklist-status").val();
		var sopStatus = $("#sop-status").val();
		var assignPrograms = $("#assign-programs").val();
		var appliedPrograms = $("#applied-programs").val(); 
		var checkApplication = $("#check-application").val();
		var uniStatus = $("#university-status").val();
		var assignTo = $("#assign-to").val();
		
		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (convertStatus !== 'all') {
			params.set('client-convert-status', convertStatus);
		} else {
			params.delete('client-convert-status');
		}
		if (clientCountry !== 'all') {
			params.set('client-country', clientCountry);
		} else {
			params.delete('client-country');
		}
		if (clientDegree !== 'all') {
			params.set('client-degree', clientDegree);
		} else {
			params.delete('client-degree');
		}
		if (processStatus !== 'all') {
			params.set('process-status', processStatus);
		} else {
			params.delete('process-status');
		}
		if (intakeYear !== 'all') {
			params.set('intake-year', intakeYear);
		} else {
			params.delete('intake-year');
		}
		if (checklistStatus !== 'all') {
			params.set('checklist-status', checklistStatus);
		} else {
			params.delete('checklist-status');
		}
		if (sopStatus !== 'all') {
			params.set('sop-status', sopStatus);
		} else {
			params.delete('sop-status');
		}
		if (assignPrograms !== 'all') {
			params.set('assign-programs', assignPrograms);
		} else {
			params.delete('assign-programs');
		}
		if (appliedPrograms !== 'all') {
			params.set('applied-programs', appliedPrograms);
		} else {
			params.delete('applied-programs');
		}
		if (checkApplication !== 'all') {
			params.set('check-application', checkApplication);
		} else {
			params.delete('check-application');
		}
		if (uniStatus !== 'all') {
			params.set('university-status', uniStatus);
		} else {
			params.delete('university-status');
		}
		if (assignTo !== 'all') {
			params.set('assign-to', assignTo);
		} else {
			params.delete('assign-to');
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
				url: "models/viewAllClientsModel.php",
				data: {
					checkconvertStatus: convertStatus,
					checkclientCountry: clientCountry,
					checkclientDegree: clientDegree,
					checkprocessStatus: processStatus,
					checkintakeYear: intakeYear,
					checkchecklistStatus: checklistStatus,
					checksopStatus: sopStatus,
					checkassignPrograms: assignPrograms,
					checkappliedPrograms: appliedPrograms,
					checkcheckApplication: checkApplication,
					checkuniStatus: uniStatus,
					checkassignTo: assignTo,
					pageNumber: pageNo,
					checkclientDetails: clientIDGet,
					checkselectPage: selectPage,
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
<?php 
include ("js-helpers/allClients.php");
?>