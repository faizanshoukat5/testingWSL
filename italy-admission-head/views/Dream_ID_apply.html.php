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
		var checkApplication = $("#check-application").val();

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
		if (checkApplication!=='all') {
			params.set('check-application', checkApplication);
		}else{
			params.delete('check-application');
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
			url: "models/viewDreamIDApplyModel.php",
			data: {
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientDegree: clientDegree,
				checkcheckApplication: checkApplication,
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
	document.addEventListener("contextmenu", function (e) {
		if (e.target.tagName === "BUTTON" && e.target.disabled) {
			e.preventDefault();
		}
	});
	document.addEventListener('auxclick', function(e) {
		if (e.button === 1) {
			e.preventDefault();
			e.stopPropagation();
		}
	});
</script>