<?php 
$uniName = $_GET['university-name'];
$clientDegree = $_GET['degree-name'];

if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<!-- filter -->
<div class="card">
	<div class="card-body">
		<input type="hidden" name="" value="<?php echo $uniName;?>" id="uniName">
		<input type="hidden" name="" value="<?php echo $clientDegree;?>" id="clientDegree">
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
					<option value="Qatar" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Qatar' ? 'selected' : '' ?>>Qatar</option>
					<option value="Oman" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Oman' ? 'selected' : '' ?>>Oman</option>
					<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
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
					<option value="27-28" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '27-28' ? 'selected' : '' ?>>2027-2028</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-6">
				<label>Check Admission Application</label>
				<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
					<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Assign But Not Applied" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Assign But Not Applied' ? 'selected' : '' ?>>Assign But Not Applied</option>
					<optgroup label="Admission Status">
						<option value="Waiting for Admission decision" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
						<option value="Acceptance Letter Received Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
						<option value="University Admission Rejected Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
					</optgroup>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-6">
				<label>Pre Enrollment Status</label>
				<select class="form-control" name="enrollment-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="enrollment-status"> 
					<option value="all" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Proof Upload but Not Assign" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'Proof Upload but Not Assign' ? 'selected' : '' ?>>Proof Upload but Not Assign</option>
					<option value="All Not Assign" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'All Not Assign' ? 'selected' : '' ?>>All Not Assign</option>
					<option value="Assign But Not Applied" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'Assign But Not Applied' ? 'selected' : '' ?>>Assign But Not Applied</option>
					<option value="Assign and Applied" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'Assign and Applied' ? 'selected' : '' ?>>Assign and Applied</option>
					<option value="One Time Account Create" <?= isset($_GET['enrollment-status']) && $_GET['enrollment-status'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
				</select>
			</div>
		</div>
		<div class="row">
			<input type="hidden" name="degreeName" value="pre enrollment" id="degreeName">
			<input type="hidden" name="universityName" value="<?php echo $uniName;?>" id="universityName">
			<div class="col-md-12">
				<div class="float-right">
					<button type="button" class="btn btn-custom" onclick="openingClosingDate();"><i class="mdi mdi-plus-circle"></i> Add Opening & Closing Date</button>
				</div>
			</div>
		</div>
		<div class="alert alert-primary mt-1">
			<div class="row">
				<div class="col-md-7">
					<h5><?php echo $uniName;?></h5>
				</div>
				<?php 
				$selectQuery = "SELECT italy_opening_date, italy_closing_date, italy_note FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='$uniName' AND italy_degree_name='pre enrollment' ORDER BY italy_dates_id DESC LIMIT 1";
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

		<!-- Add Note -->
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

		<!-- Add Note -->
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
<!-- script file include using php -->
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
		var uniName = $("#uniName").val();
		var clientDegree = $("#client-degree").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var intakeYear = $("#intake-year").val();
		var applicationStatus = $("#check-application").val();
		var enrollStatus = $("#enrollment-status").val();

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
		if (applicationStatus!=='all') {
			params.set('check-application', applicationStatus);
		}else{
			params.delete('check-application');
		}
		if (enrollStatus!=='all') {
			params.set('enrollment-status', enrollStatus);
		}else{
			params.delete('enrollment-status');
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
			url: "models/viewPreEnrollmentUniversitiesModel.php",
			data: {
				checkuniName: uniName,
				checkclientDegree: clientDegree,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkintakeYear: intakeYear,
				checkcheckApplication: applicationStatus,
				checkenrollStatus: enrollStatus,
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
	// opening closing date of universities
	function openingClosingDate() {
		var degreeName = $("#degreeName").val();
		var universityName = $("#universityName").val();
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data: {
				checkdegreeName: degreeName,
				checkuniversityName: universityName,
			},
			success: function(data){
				$(".showModalTitle").html('Add Opening & Closing Date');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	function updUniDateHidden(checkbox, hiddenId) {
		document.getElementById(hiddenId).value = checkbox.checked ? 1 : 0;
	}
</script>
<script type="text/javascript">
	function openingYesDate() {
		var yesIDDate =	$('#yesIDDate').val();
		if (yesIDDate == 1) {
			document.getElementById("showOpeningDate").style.display = "block";
			document.getElementById("showClosingDate").style.display = "block";
			// Setting the required attribute using vanilla JS
			document.querySelector("#showOpeningDate input").setAttribute('required', true);
			document.querySelector("#showOpeningDate input").style.borderBottom = '2px solid #e33244';

			document.querySelector("#showClosingDate input").setAttribute('required', true);
			document.querySelector("#showClosingDate input").style.borderBottom = '2px solid #e33244';
		} else {
			document.getElementById("showOpeningDate").style.display = "none";
			document.getElementById("showClosingDate").style.display = "none";
			// Removing the required attribute
			document.querySelector("#showOpeningDate input").removeAttribute('required');
			document.querySelector("#showClosingDate input").removeAttribute('required');
		}
	}

	function openingNoDate() {
		var noIDDate =	$('#noIDDate').val();
		if (noIDDate==2) {
			document.getElementById("showOpeningDate").style.display = "none";
			document.getElementById("showClosingDate").style.display = "none";
			document.querySelector("#showOpeningDate input").removeAttribute('required');
			document.querySelector("#showClosingDate input").removeAttribute('required');
		}else{
			document.getElementById("showOpeningDate").style.display = "block";
			document.getElementById("showClosingDate").style.display = "block";
			document.querySelector("#showOpeningDate input").setAttribute('required', true);
			document.querySelector("#showOpeningDate input").style.borderBottom = '2px solid #e33244';
			document.querySelector("#showClosingDate input").setAttribute('required', true);
			document.querySelector("#showClosingDate input").style.borderBottom = '2px solid #e33244';
		}
	}
</script>

<?php 
include ("js-helpers/allClients.php");
?>