<?php
ob_start();
session_start();
include_once("../env/main-config.php");
include_once('models/selectFunction.php');
include_once('models/queries.php');

////////////////////////////////////////////////
/////////////////////Data Backup//////////////////
///////////////////////////////////////////////
if (isset($_POST['data_backup'])) {
	//Core function
	function backup_tables($host, $user, $pass, $dbname, $tables = '*',$con) {
		// Check connection
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			exit;
		}
		mysqli_query($con, "SET NAMES 'utf8'");
		//get all of the tables
		if($tables == '*'){
			$tables = array();
			$result = mysqli_query($con, 'SHOW TABLES');
			while($row = mysqli_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		$return = '';
		//cycle through
		foreach($tables as $table){
			$result = mysqli_query($con, 'SELECT * FROM '.$table);
			$num_fields = mysqli_num_fields($result);
			$num_rows = mysqli_num_rows($result);
			$return.= 'DROP TABLE IF EXISTS '.$table.';';
			$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";
			$counter = 1;
			//Over tables
			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysqli_fetch_row($result)){
					if($counter == 1){
						$return.= 'INSERT INTO '.$table.' VALUES(';
					} else{
						$return.= '(';
					}
					//Over fields
					for($j=0; $j<$num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = str_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					if($num_rows == $counter){
						$return.= ");\n";
					} else{
						$return.= "),\n";
					}
					++$counter;
				}
			}
			$return.="\n\n\n";
		}
		//save file
		date_default_timezone_set('Asia/Karachi');
		$fileName = '../backup/'.date('H-i-s___d-m-Y').'.sql';
		$handle = fopen($fileName,'w+');
		fwrite($handle,$return);
		if(fclose($handle)){
			echo "Done, the file name is: ".$fileName;
			exit; 
		}
	}
	//Call the core function
	backup_tables($dbhost, $dbuser, $dbpass, $dbname, $tables,$con);
}

// To download documents admission
if (isset($_POST['clientDocAdmission'])) {
	$clientID = $_POST['clientDocAdmission'];
	$clientData = "SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='" . $clientID . "'";
	$clientData_ex = mysqli_query($con, $clientData);

	$files = [];
	foreach ($clientData_ex as $row) {
		for ($i = 1; $i <= 32; $i++) {
			$docKey = 'admission_doc' . $i;
			if (!empty($row[$docKey])) {
				$files[] = '../payagreements/' . $row[$docKey];
			}
		}
	}
	$clientName = "SELECT client_name FROM clients".$_SESSION['dbNo']." WHERE client_id='".$clientID."' ";
	$clientName_ex = mysqli_query($con, $clientName);
	$row = mysqli_fetch_assoc($clientName_ex);
    $clientName = $row['client_name'];

	$zip = new ZipArchive();
	$zipFileName = 'admissionDocument('.$clientName.').zip';
	$zipFilePath = '../' . $zipFileName;
	if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
		foreach ($files as $file) {
			if (file_exists($file)) {
				$zip->addFile($file, basename($file));
			}
		}
		$zip->close();
		echo json_encode(['zipFile' => $zipFilePath]);
	} else {
		echo json_encode(['error' => 'Could not create zip file']);
	}
}

// Employee email check
if (isset($_POST['checkEmpemail'])) {
	$checkEmpemail_id = $_POST['checkEmpemail'];
	$select_query = "SELECT * from wt_users WHERE close='1' AND status='1' AND active_status='1' ";
	$select_query_ex = mysqli_query($con,$select_query);
	if($select_query_ex){
		foreach ($select_query_ex as $row){
			if (strcasecmp($row['email'], $checkEmpemail_id) == 0) {
				echo "yes";
			}
		}
	}else{
		echo "error";
	}
}
// Employee delete
if (isset($_POST['employee_del'])) {
	$emp_id = $_POST['employee_del'];
	$close = 0;
	$del_query = "UPDATE wt_users SET close = '".$close."' WHERE wt_id = '".$emp_id."'";
	$del_query_ex = mysqli_query($con,$del_query);
}	
// Employee Edit
if (isset($_POST['employee_edit'])) {
	$emp_id = $_POST['employee_edit'];
	$select_query = "SELECT * from wt_users WHERE status = '1' AND close='1' AND wt_id='".$emp_id."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		?>
		<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">
					Employee Details <span class="text-danger">*</span>
				</legend>
				<input type="hidden" name="updateID" value="<?php echo $emp_id;?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label class="form-label">First Name <span class="text-danger">*</span></label>
						<input type="text" name="fname" class="form-control" required="required" value="<?php echo $row['fname'];?>" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Last Name <span class="text-danger">*</span></label>
						<input type="text" name="lname" class="form-control" required="required" value="<?php echo $row['lname'];?>" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Phone No <span class="text-danger">*</span></label>
						<input type="number" name="phoneno" class="form-control" required="required" value="<?php echo $row['phone'];?>" autocomplete="off">
					</div>
					<div class="form-group col-lg-4 col-md-6">
						<label class="form-label">Select Gender <span class="text-danger">*</span></label>
						<select class="form-control" name="gender" required="required" autocomplete="off">
							<option value="<?php echo $row['gender'] ?>"><?php echo $row['gender'];?></option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Select Role<span class="text-danger">*</span></label>
						<select class="form-control" data-toggle='select2' name="userType" required="required" autocomplete="off">
							<option value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
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
					<div class="form-group col-md-4">
						<label class="form-label">Designation <span class="text-danger">*</span></label>
						<input type="text" name="designation" class="form-control" required="required" value="<?php echo $row['designation'];?>" autocomplete="off">
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">User Name <span class="text-danger">*</span></label>
						<input type="text" name="userName" class="form-control" required="required" value="<?php echo $row['user_name'];?>" autocomplete="off" disabled="">
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Email <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" required="required" value="<?php echo $row['email'];?>" autocomplete="off" disabled="">
					</div>
				</div>
			</fieldset>
			<script type="text/javascript">$('[data-toggle="select2"]').select2();</script>
			<div class="row">
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-custom" type="submit" name="updEmp" ><i class="mdi mdi-upload"></i> Update</button>
					</div>
				</div>	
			</div>
		</form>
	<?php } ?>
<?php }

?>