<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Degree delete
if (isset($_POST['clientDelDegree'])) {
	$preDegId = $_POST['clientDelDegree'];
	$del_query = "UPDATE previous_client_degrees SET close='0' WHERE pre_degree_id='".$preDegId."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

//pre client degree check
// if (isset($_POST['preCheckDegree'])) {
// 	$degreeName = $_POST['preCheckDegree'];
// 	$resQuery = "SELECT pre_degree_name from previous_client_degrees WHERE status='1' AND close='1' AND AND TRIM(LOWER(pre_degree_name)) = TRIM(LOWER('$degreeName'))";
// 	$resQuery_ex = mysqli_query($con,$resQuery);
// 	if ($resQuery_ex && mysqli_num_rows($resQuery_ex) > 0) {
// 		echo "yes";
// 	} else {
// 		echo "error";
// 	}
// }
if (isset($_POST['preCheckDegree'])) {
	$degreeName = trim($_POST['preCheckDegree']);
	$degreeName = mysqli_real_escape_string($con, $degreeName);
	$resQuery = "SELECT pre_degree_name FROM previous_client_degrees WHERE status='1' AND close='1'";
	$resQuery_ex = mysqli_query($con, $resQuery);
	$found = false;
	while ($row = mysqli_fetch_assoc($resQuery_ex)) {
		if (strtolower(trim($row['pre_degree_name'])) == strtolower($degreeName)) {
			$found = true;
		}
	}
	if ($found) {
		echo "yes";
	} else {
		echo "error";
	}
}


// updated previous client degree
if (isset($_POST['clientEditDegree'])) {
	$preDegID = $_POST['clientEditDegree'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Note Details <span class="text-danger">*</span>
			</legend>
			<input type="hidden" name="updateID" value="<?php echo $preDegID;?>">
			<?php 
			$query = "SELECT * FROM previous_client_degrees WHERE status='1' AND close='1' AND pre_degree_id='".$preDegID."' ";
			$queryEx = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-lg-12 col-md-12">
					<label class="form-label">Client's Previous Degree Name <span class="text-danger">*</span></label>
					<input type="text" name="preDegreeName" class="form-control" required="required" autocomplete="off" value="<?php echo $row['pre_degree_name'];?>" onkeyup="checkPreDegree(1)" id="preDegreeName1">
				</div>
				<div class="col-md-12" id="already-msg1"></div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" name="updPreDegree" id="submitBtn"><i class="mdi mdi-upload"></i> Update</button>
				</div> 
			</div>
		</div>
	</form>
<?php
}

?>