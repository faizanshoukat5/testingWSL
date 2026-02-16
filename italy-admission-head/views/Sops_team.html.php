<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
$wtID = $_GET['check-sops-team-status'];
$selectQuery = "SELECT wt_id, fname, lname FROM wt_users WHERE status='1' AND close='1' AND type='italy university sop' AND wt_id='".$wtID."' ";
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
					<button type="button" class="btn btn-info" onclick="viewSOPSTeam(<?php echo $wtID;?>);">Show <b><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?></b> Dashboard</button>
				</div>
				<div class="float-right">
					<button type="button" class="btn btn-primary mr-2" onclick="loginSOPTeam(<?php echo $wtID;?>);"> Login to <b><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?></b> Portal</button>
				</div>
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

		<div class="row">
			<input type="hidden" name="" value="<?php echo $wtID;?>" id="wtID">
			<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
			<div class="form-group col-md-6 col-lg-4">
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
			<div class="form-group col-md-6 col-lg-4">
				<label>Country From</label>
				<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
					<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
					<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
					<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-4">
				<label>Degree</label>
				<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree"> 
					<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
					<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Date from <span class="text-danger">*</span></label>
				<input type="date" name="start-date" class="form-control" required="required" value="<?= isset($_GET['start-date']) ? $_GET['start-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="start-date">
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Date To <span class="text-danger">*</span></label>
				<input type="date" name="end-date" class="form-control" required="required" value="<?= isset($_GET['end-date']) ? $_GET['end-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="end-date">
			</div>


			<div class="col-md-12">
				<div class="alert alert-primary">
					<h5><?php echo ucwords($dataRow['fname']." ".$dataRow['lname']);?> </h5>
				</div>
			</div>
		</div>
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
			<div class="col-md-6">
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
			url: "models/viewSOPsTeamModel.php",
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
	function viewSOPSTeam(wtID) {
		var wtID = wtID;
		$("#loaderTeam").show();
		$("#showTeamDashboardModel").hide();

		$.ajax({
			type: "POST",
			url: "models/viewSOPsDashboardModel.php",
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

	function loginSOPTeam(wtID) {
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