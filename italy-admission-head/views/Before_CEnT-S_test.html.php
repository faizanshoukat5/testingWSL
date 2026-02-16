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
								<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-2">
							<label>Degree</label>
							<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree"> 
								<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
								<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
								<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
								<option value="mbbs" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
								<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
							</select>
						</div>
						<div class="form-group col-md-6 col-lg-4">
							<label>CEnT-S Test Process</label>
							<select class="form-control" data-toggle='select2' name="CEnT-S-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="CEnT-S-process">
								<option value="all" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'all' ? 'selected' : '' ?>>All</option>
								<optgroup label="CEnT-S Checking">
									<option value="Inform the Client to Recheck the CEnT-S Application" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'Inform the Client to Recheck the CEnT-S Application' ? 'selected' : '' ?>>Inform the Client to Recheck the CEnT-S Application</option>
									<option value="CEnT-S Applications Sent to the client for Rechecking" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Applications Sent to the client for Rechecking' ? 'selected' : '' ?>>CEnT-S Applications Sent to the client for Rechecking</option>
									<option value="CEnT-S Test Date Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Date Clients' ? 'selected' : '' ?>>CEnT-S Test Date Clients</option>
									<option value="CEnT-S Test Fee Paid Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Fee Paid Clients' ? 'selected' : '' ?>>CEnT-S Test Fee Paid Clients</option>
									<option value="Sent Practice CEnT-S Test Video" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'Sent Practice CEnT-S Test Video' ? 'selected' : '' ?>>Sent Practice CEnT-S Test Video</option>
								</optgroup>
								<optgroup label="CEnT-S Status">
									<option value="CEnT-S Test Pass Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Pass Clients' ? 'selected' : '' ?>>CEnT-S Test Pass Clients</option>
									<option value="CEnT-S Test Fail Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Fail Clients' ? 'selected' : '' ?>>CEnT-S Test Fail Clients</option>
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
		var CEnTSProcess = $("#CEnT-S-process").val();

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
		if (CEnTSProcess!=='all') {
			params.set('CEnT-S-process', CEnTSProcess);
		}else{
			params.delete('CEnT-S-process');
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
		$.ajax({
			type: "POST",
			url: "models/viewBeforeTolcTestModel.php",
			data: {
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkCEnTSProcess: CEnTSProcess,
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