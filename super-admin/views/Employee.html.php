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
				<div class="float-right">
					<button type="button" class="btn btn-custom" data-toggle="modal" data-target=".addEmployee"><i class="mdi mdi-plus-circle"></i> Add Employee</button>
				</div>
			</div>
		</div>
		<!--  Modal content for the above example -->
		<div class="modal fade addEmployee" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Add Employee</h4>
					</div>
					<div class="modal-body">
						<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">
									Employee Details <span class="text-danger">*</span>
								</legend>
								<div class="row">
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">First Name <span class="text-danger">*</span></label>
										<input type="text" name="fname" class="form-control" required="required" placeholder="Enter First Name" autocomplete="off">
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Last Name <span class="text-danger">*</span></label>
										<input type="text" name="lname" class="form-control" required="required" placeholder="Enter Last Name" autocomplete="off">
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Phone No <span class="text-danger">*</span></label>
										<input type="number" name="phoneno" class="form-control" required="required" placeholder="923XXXXXXXXX" autocomplete="off">
									</div>
									<div class="form-group col-md-4"> 
										<label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
										<div class="input-group">
											<div id="radioBtn" class="btn-group col-md-12" style="padding: 0;">
												<a class="btn btn-danger btn-sm active" data-toggle="gender" data-title="Male"><i class="mdi mdi-gender-male"></i><br>Male</a>
												<a class="btn btn-danger btn-sm notActive" data-toggle="gender" data-title="Female"><i class="mdi mdi-gender-female"></i><br>Female</a>
												<a class="btn btn-danger btn-sm notActive" data-toggle="gender" data-title="Other"><i class="mdi mdi-gender-transgender"></i><br>Other</a>
											</div>
											<input type="hidden" name="gender" id="gender" value="Male">
										</div>
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Select Role<span class="text-danger">*</span></label>
										<select class="form-control" data-toggle='select2' name="userType" required="required" autocomplete="off">
											<option selected value disabled class="text-center">--- Select Role ---</option>
											<option value="sale department">Sale Department</option>
											<option value="team manager">Team Manager</option>
											<option value="accountant">Accountant</option>
											
											<optgroup label="Documents Collections">
												<option value="documents collections">Documents Collections</option>
												<option value="documents collections france">Documents Collections France</option>
												<option value="documents collections team">Documents Collections Team</option>
											</optgroup>
											<optgroup label="Austria Country">
												<option value="austria admission head">Austria Admission Head</option>
												<option value="austria admission team">Austria Admission Team</option>
												<option value="austria university sop">Austria University SOP's</option>
												<option value="austria visa team">Austria Visa Team</option>
											</optgroup>
											<optgroup label="Czech Republic Country">
												<option value="czech republic admission head">Czech Republic Admission Head</option>
												<option value="czech republic admission team">Czech Republic Admission Team</option>
												<option value="czech republic university sop">Czech Republic University SOP's</option>
												<option value="czech republic visa team">Czech Republic Visa Team</option>
											</optgroup>
											<optgroup label="France Country">
												<option value="france admission head">France Admission Head</option>
												<option value="france admission team">France Admission Team</option>
												<option value="france university sop">France University SOP's</option>
											</optgroup>
											<optgroup label="Italy Country">
												<option value="italy admission head">Italy Admission Head</option>
												<option value="italy admission team">Italy Admission Team</option>
												<option value="italy university sop">Italy University SOP's</option>
											</optgroup>
											<optgroup label="Canada Country">
												<option value="canada admission head">Canada Admission Head</option>
											</optgroup>
											<option value="IELTS Enrollment">IELTS Enrollment</option>
											<option value="Data Collections">Data Collections</option>
											<option value="Call Center Head">Call Center Head</option>
											<option value="Call Center">Call Center</option>
										</select>
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Designation <span class="text-danger">*</span></label>
										<input type="text" name="designation" class="form-control" required="required" placeholder="Enter designation" autocomplete="off">
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">User Name <span class="text-danger">*</span></label>
										<input type="text" name="userName" class="form-control" required="required" placeholder="Enter User Name" autocomplete="off" id="username" onkeyup="checkUserName();">
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Email <span class="text-danger">*</span></label>
										<input type="email" name="email" class="form-control" required="required" placeholder="info@gmail.com" autocomplete="off" id="email" onkeyup="checkEmail();">
									</div>
									<div class="form-group col-lg-4 col-md-6">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<div class="input-group">
											<input class="form-control" type="password" name="password" required="required" placeholder="Enter Confirm password" id="password" onkeyup="checkPassword();">
											<div class="input-group-append">
												<span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="newPasswordShow();">
													<i class="mdi mdi-eye" id="newShowEye"></i>
													<i class="mdi mdi-eye-off d-none" id="newHideEye"></i>
												</span>
											</div>
										</div>
									</div>
									
									<div class="col-md-12" id="already-msg"></div>
								</div>
							</fieldset>
							<div class="row">
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" name="subEmp" id="submit"><i class="mdi mdi-upload"></i> Submit</button>
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

		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>
	</div>
</div>
<!-- end row -->

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
			url: "models/viewEmployeeModel.php",
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
	$('#radioBtn a').on('click', function(){
		var sel = $(this).data('title');
		var tog = $(this).data('toggle');
		$('#'+tog).prop('value', sel);
		
		$('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
		$('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');
	});
	
	function editEmployee(idemp) {
		var idemp = idemp;
		// alert(idemp);
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'employee_edit='+idemp,
			success: function(data){
				$(".showModalTitle").html('Update Employee');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//del employee
	function delC(idemp) {
		var idemp = idemp;
		$.ajax({
			type:"POST",
			url:"getState.php",
			data: 'employee_del='+idemp,
			success:function(data) {
				var rowh = "#"+idemp;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};
	function checkEmail() {
		var empemail = document.getElementById('email').value;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:{
				checkEmpemail:empemail,
			},
			success: function(data){
				if (data == ""){
					$('#submit').attr('disabled', false);
					$('#already-msg').empty();
				}
				else{
					$('#submit').attr('disabled', true);
					$('#already-msg').html("<div class='alert alert-danger' style = 'text-align : center;'>This <strong>Email</strong> is already added!</div>");
				}     
			}
		});
	};
	function newPasswordShow() {
		var x = document.getElementById("password");
		var show_eye = document.getElementById("newShowEye");
		var hide_eye = document.getElementById("newHideEye");
		hide_eye.classList.remove("d-none");
		if (x.type === "password") {
			x.type = "text";
			show_eye.style.display = "none";
			hide_eye.style.display = "block";
		} else {
			x.type = "password";
			show_eye.style.display = "block";
			hide_eye.style.display = "none";
		}
	};


	function otherPortal(idemp) {
		var idemp = idemp;
		$.ajax({
			type: "POST",
			url: "models/employeePortalLogin.php",
			data: 'employeePortal=' + idemp,
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
	};

</script>