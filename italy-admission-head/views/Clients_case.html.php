<?php 
$caseStatus = $_GET['client-case-status'];

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
				<div class="alert alert-info">
					<?php if($caseStatus=='1'){ ?>
					<h5><b>Case WithDraw </b></h5>
					<?php }elseif($caseStatus=='2'){ ?>
					<h5><b>Case Refund </b></h5>
					<?php }elseif($caseStatus=='3'){ ?>
					<h5><b>Case On Hold </b></h5>
					<?php } ?>
				</div>
			</div>
			<div class="col-md-12 col-lg-12">
				<form action="" method="get" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="client-case-status" value="<?php echo $caseStatus;?>" id="client-case-status">
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
		var caseStatus = $("#client-case-status").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientDegree = $("#client-degree").val();
		var intakeYear = $("#intake-year").val();

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
			url: "models/viewClientCaseModel.php",
			data: {
				checkcaseStatus: caseStatus,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkintakeYear: intakeYear,
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

<?php 
include ("js-helpers/allClients.php");
?>