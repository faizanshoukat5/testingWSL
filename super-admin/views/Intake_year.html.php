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
			<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
			<div class="form-group col-md-12">
				<button type="button" class="btn btn-custom" data-toggle="modal" data-target=".addSession"><i class="mdi mdi-plus-circle"></i> Add Intake Year</button>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade addSession" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Add Intake Year</h4>
					</div>
					<div class="modal-body">
						<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">
									Year Details <span class="text-danger">*</span>
								</legend>
								<div class="row">
									<div class="form-group col-md-6">
                                        <label class="form-label">Starting Date <span class="text-danger">*</span></label>
                                        <input value="<?php echo date("Y-m-d");?>" class="form-control" type="date" name="startDate" autocomplete="off" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Ending Date <span class="text-danger">*</span></label>
                                        <input value="<?php echo date("Y-m-d", strtotime('+1 years'));?>" class="form-control" type="date" name="endDate" autocomplete="off" required="required">
                                    </div>
								</div>
							</fieldset>
							<div class="row">
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" type="submit" name="subSession" id="submit"><i class="mdi mdi-upload"></i> Submit</button>
									</div>
								</div>	
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
			
		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>
	</div>
</div>
<!-- card end -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="updateModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body updateModalClient">
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);

		if (pageNo == 1) {
			params.delete('page-number');
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
			url: "models/viewIntakeYearModel.php",
			data: {
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

<script type="text/javascript">
	function sessionStart(idYear) {
		var idSY = idYear;
		$.ajax({
			type:"POST",
			url:"models/intakeYearState.php",
			data: 'intakeYear='+idSY,
			success:function(data) {
				Swal.fire({
					title: 'Registration!',
					text: 'Your Client is Registered.',
					icon: 'success'
				}).then((result) => {
					window.location.href = 'dashboard';
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			}
		});
	}
</script>