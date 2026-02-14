<?php
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
$wtID = $_GET['check-processing-team-status'];
$selectQuery = "SELECT wt_id, fname, lname FROM wt_users WHERE status='1' AND close='1' AND type='austria admission team' AND wt_id='".$wtID."' ";
$selectQuery_ex = mysqli_query($con, $selectQuery);
if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
	$dataRow = mysqli_fetch_assoc($selectQuery_ex);
}
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button type="button" class="btn btn-info" onclick="viewProcessingTeam(<?php echo $wtID;?>);">Show <b><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?></b> Dashboard</button>
				</div>
				<div class="float-right">
					<button type="button" class="btn btn-primary mr-2" onclick="loginProcessingTeam(<?php echo $wtID;?>);"> Login to <b><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?></b> Portal</button>
				</div>
			</div>
		</div>

		<div id="loaderTeam" style="display: none;">
			<div class="loader">
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
				<div class="inner_loader"></div>
			</div>
		</div>
		<!-- show data from model name start from view -->
		<div id="showTeamDashboardModel"></div>

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

		<input type="hidden" name="" value="<?php echo $wtID;?>" id="wtID">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<div class="row">
			<div class="form-group col-md-6 col-lg-4">
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
			<div class="form-group col-md-6 col-lg-2">
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
			<div class="form-group col-md-6 col-lg-2">
				<label>Degree</label>
				<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree"> 
					<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
					<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
					<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-2">
				<label>Date from </label>
				<input type="date" name="start-date" class="form-control" required="required" value="<?= isset($_GET['start-date']) ? $_GET['start-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="start-date">
			</div>
			<div class="form-group col-md-6 col-lg-2">
				<label>Date To </label>
				<input type="date" name="end-date" class="form-control" required="required" value="<?= isset($_GET['end-date']) ? $_GET['end-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="end-date">
			</div>


			<div class="col-md-12">
				<div class="alert alert-primary">
					<h5><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?> </h5>
				</div>
			</div>
		</div>
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
		var startDate = $("#start-date").val(); 
		var endDate = $("#end-date").val();
		var wtID = $("#wtID").val();

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
		if (startDate && endDate) {
			params.set('start-date', startDate);
			params.set('end-date', endDate);
		}else{
			params.delete('start-date');
			params.delete('end-date');
		}
		
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		}else {
			params.set('page-number', pageNo);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else {
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModel").hide();
		// Perform the AJAX request

		$.ajax({
			type: "POST",
			url: "models/viewProcessingTeamModel.php",
			data: {
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkstartDate: startDate,
				checkendDate: endDate,
				checkwtID: wtID,
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

<script type="text/javascript">
	function viewProcessingTeam(wtID) {
		var wtID = wtID;
		$("#loaderTeam").show();
		$("#showTeamDashboardModel").hide();

		$.ajax({
			type: "POST",
			url: "models/viewTeamDashboardModel.php",
			data: {
				checkwtID: wtID,
			},
			success: function(data) {
				// alert(data);
				$("#loaderTeam").hide();
				$("#showTeamDashboardModel").html(data);
				$("#showTeamDashboardModel").show();
			}
		});
	}

	function loginProcessingTeam(wtID) {
		var wtID = wtID;
		$.ajax({
			type: "POST",
			url: "models/viewTeamDashboardModel.php",
			data: {
				teamPortalID: wtID,
			},
			success: function(response) {
				var data = JSON.parse(response);
				Swal.fire(
					'Login!',
					'Portal login successfully.',
					'success'
				).then(() => {
					setTimeout(function () {
						window.location.href = data.redirect;
					}, 1000);
				});
			}
		});
	}
</script>