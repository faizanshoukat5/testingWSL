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
		</div>
		<input type="hidden" name="client-case-status" value="<?php echo $caseStatus;?>" id="client-case-status">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<?php include ('components/AllFiltersHtml.php'); ?>
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
		var caseStatus = $("#client-case-status").val();
		var countryName = $("#country-name").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientCase = $("#client-case").val();
		var clientDegree = $("#client-degree").val();
		var startDate = $("#start-date").val(); 
		var endDate = $("#end-date").val();
		var clientStatus = $("#client-status").val();
		var processStatus = $("#process-status").val();
		var intakeYear = $("#intake-year").val();

		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (countryName!== 'all') {
			params.set('country-name', countryName);
		}else {
			params.delete('country-name');
		}
		if (convertStatus!== 'all') {
			params.set('client-convert-status', convertStatus);
		}else {
			params.delete('client-convert-status');
		}
		if (clientCountry!== 'all') {
			params.set('client-country', clientCountry);
		}else {
			params.delete('client-country');
		}
		if (clientCase!== 'all') {
			params.set('client-case', clientCase);
		}else {
			params.delete('client-case');
		}
		if (clientDegree!== 'all') {
			params.set('client-degree', clientDegree);
		}else {
			params.delete('client-degree');
		}
		if (startDate || endDate) {
			params.set('start-date', startDate);
			params.set('end-date', endDate);
		}else {
			params.delete('start-date');
			params.delete('end-date');
		}
		if (clientStatus!== 'all') {
			params.set('client-status', clientStatus);
		}else {
			params.delete('client-status');
		}
		if (processStatus!== 'all') {
			params.set('process-status', processStatus);
		}else {
			params.delete('process-status');
		}
		if (intakeYear!== 'all') {
			params.set('intake-year', intakeYear);
		}else {
			params.delete('intake-year');
		}
		if (pageNo == 1) {
			params.delete('page-number');
		}else {
			params.set('page-number', pageNo);
		}

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
			url: "models/viewClientCaseModel.php",
			data: {
				checkcaseStatus: caseStatus,
				checkcountryName: countryName,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientCase: clientCase,
				checkclientDegree: clientDegree,
				checkstartDate: startDate,
				checkendDate: endDate,
				checkclientStatus: clientStatus,
				checkprocessStatus: processStatus,
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