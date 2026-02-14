<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<div class="card">
	<div class="card-body">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button type="button" class="btn btn-custom" data-toggle="modal" data-target=".addClientDegree"><i class="mdi mdi-plus-circle"></i> Add Client's Previous Degree</button>
				</div>
			</div>
		</div>
		<!--  Modal content for the above example -->
		<div class="modal fade addClientDegree" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Add Client's Previous Degree</h4>
					</div>
					<div class="modal-body">
						<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">
									Client's Previous Degree Details <span class="text-danger">*</span>
								</legend>
								<div class="row">
									<div class="form-group col-lg-12 col-md-12">
										<label class="form-label">Client's Previous Degree Name <span class="text-danger">*</span></label>
										<input type="text" name="preDegreeName" class="form-control" required="required" placeholder="Enter Name" autocomplete="off" onkeyup="checkPreDegree(0)" id="preDegreeName0">
									</div>
									<div class="col-md-12" id="already-msg0"></div>
								</div>
							</fieldset>
							<div class="row">
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" name="subPreDegree" id="submitBtn"><i class="mdi mdi-upload"></i> Submit</button>
									</div> 
								</div>
							</div>
						</form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

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
<!-- end row -->
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});
	function viewClientsFilter(page) {
		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		} else {
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
			url: "models/viewClientsPreviousDegreeModel.php",
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
	function editClientDegree(idDegree) {
		var idDegree = idDegree;
		// alert(idDegree);
		$.ajax({
			type: "POST",
			url: "models/clientsPreviousDegreeState.php",
			data:'clientEditDegree='+idDegree,
			success: function(data){
				$(".showModalTitle").html('Update Clients Previous Degree');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//del employee
	function delC(idDegree) {
		var idDegree = idDegree;
		$.ajax({
			type:"POST",
			url:"models/clientsPreviousDegreeState.php",
			data: 'clientDelDegree='+idDegree,
			success:function(data) {
				var rowh = "#"+idDegree;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};


	function checkPreDegree(id) {
		var preDegreeName = $("#preDegreeName"+id+"").val();
		$.ajax({
			type: "POST",
			url: "models/clientsPreviousDegreeState.php",
			data:'preCheckDegree='+preDegreeName,
			success: function(data){
				if (data=="yes"){
					$('#submitBtn').attr('disabled', true);
					$('#already-msg'+id+'').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Previous Degree</strong> is already added!</div>");
				}
				else{
					$('#submitBtn').attr('disabled', false);
					$('#already-msg'+id+'').empty();
				}
			}
		});
	}
</script>