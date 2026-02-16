<?php
ob_start();
session_start();
include_once("../env/main-config.php");
include_once('models/selectFunction.php');
// To download documents admission
if (isset($_POST['clientDocAdmission'])) {
	$clientID = $_POST['clientDocAdmission'];
	$clientData = "SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='" . $clientID . "'";
	$clientData_ex = mysqli_query($con, $clientData);

	$files = [];
	foreach ($clientData_ex as $row) {
		for ($i = 1; $i <= 45; $i++) {
			$docKey = 'admission_doc' . $i;
			if (!empty($row[$docKey])) {
				$files[] = '../payagreements/' . $row[$docKey];
			}
		}
	}
	$clientQuery = "SELECT client_name FROM clients".$_SESSION['dbNo']." WHERE client_id='".$clientID."' ";
	$clientQuery_ex = mysqli_query($con, $clientQuery);
	$row = mysqli_fetch_assoc($clientQuery_ex);
	$clientName = trim($row['client_name']);

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

// show note from document collection
if (isset($_POST['checkAdmissionNote'])) {
	$clientID = $_POST['checkAdmissionNote'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Document Collection Note <span class="text-danger">*</span>
		</legend>
		<?php 
		$query = "SELECT note_admission FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$clientID."' ";
		$queryEx = mysqli_query($con,$query);
		$docRow = mysqli_fetch_assoc($queryEx);
		?>
		<div class="row">
			<div class="form-group col-md-12">
				<label class="form-label">Note <span class="text-danger">*</span></label> <br>
				<?php if($docRow['note_admission']!=''){
					echo $docRow['note_admission'];
				}else{
					echo "No Note Found";
				}?>
			</div>
		</div>
	</fieldset>
<?php
}

// Add note of programs
if (isset($_POST['checkProgramNote'])) {
	$programID = $_POST['checkProgramNote'];
	?>
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>
		<?php 
		$query = "SELECT italy_program_status, italy_program_resolves_note, italy_program_pending_note FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
		$queryEx = mysqli_query($con,$query);
		$docRow = mysqli_fetch_assoc($queryEx);
		?>
		<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Program Note <span class="text-danger">*</span></label><br>
					<div class="radio radio-danger form-check-inline">
						<input type="radio" id="yesIDDate" value="1" name="radioStep" <?php if($docRow['italy_program_status']=='1'){echo 'checked';}?>>
						<label for="yesIDDate"> Application Pending </label>
					</div>
					<div class="radio radio-success form-check-inline">
						<input type="radio" id="noIDDate" value="2" name="radioStep" <?php if($docRow['italy_program_status']=='2'){echo 'checked';}?>>
						<label for="yesIDDate"> Application Resolves </label>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Application Pending Note</label>
					<textarea class="form-control" name="pendingNote" rows="5"><?php echo $docRow['italy_program_pending_note'];?></textarea>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Application Resloves Note </label>
					<textarea class="form-control" name="reslovesNote" rows="5"><?php echo $docRow['italy_program_resolves_note'];?></textarea>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" name="upProgramNote"><i class="mdi mdi-upload"></i> Update</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
<?php
}

// SOPs state
if (isset($_POST['programSOPs'])) {
	$programSOPs = $_POST['programSOPs'];

	$select_query = "SELECT italy_sops_status FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programSOPs."'";
	$select_query_ex = mysqli_query($con, $select_query);
	$row = mysqli_fetch_assoc($select_query_ex);
	$sopsStatus = $row['italy_sops_status'];
	
	if ($sopsStatus!='0') {
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="10%">Sop's Status</th>
							<th width="10%">Date</th>
							<th width="40%">Note</th>
							<th width="40%">File</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$select_query = "SELECT * from italy_program_sops".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_sops_program_id ='".$programSOPs."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					if (mysqli_num_rows($select_query_ex) > 0) {
						foreach ($select_query_ex as $row) {
						$sopFile = $row['italy_sops_file'];
					?>
						<tr>
							<td class="breakTD"><?php echo ucwords($row['italy_sops_file_status']);?></td>
							<td class="breakTD"><?php echo date("d-m-Y", strtotime($row['italy_sops_date']));?></td>
							<td class="breakTD"><?php echo $row['italy_sops_anynote'] ?></td>
							<td class="breakTD">
							<?php 
							$fileMulti = explode(',', $sopFile);
							foreach ($fileMulti as $fileName) {
								?>
								<a href="../payagreements/<?php echo $fileName;?>" target="blank" download><?php echo $fileName;?></a><br>
							<?php } ?>
							</td>
						</tr>
					<?php }
					}else {
						?>
						<tr>
							<td colspan="4">No data available in table</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php }else{ ?>
	<div class="alert alert-primary text-center">
		<strong>SOP's are Not upload</strong>
	</div>
	<?php } ?>

	<div class="row">
		<div class="col-md-12">
			<form id="formSOPUpload" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateID" value="<?php echo $programSOPs;?>">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						SOP's Program <span class="text-danger">*</span>
					</legend>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="agreement-container" data-agreement-id="20">
								<label class="form-label">Choose Files <span class="text-danger">* (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="sopFile[]" required="required" id="uploadedFiles20" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
						<div class="form-group col-md-6">
							<label class="form-label">Any Note</label>
							<textarea name="sopAnyNote" class="form-control" autocomplete="off"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<button class="btn btn-custom" type="button" name="updSOPS" onclick="saveDataForm('formSOPUpload', 'updSOPS')" id="updSOPS"><i class="mdi mdi-upload"></i> Update</button>
							</div>
						</div>	
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	
<?php }

?>