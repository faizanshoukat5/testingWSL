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
// Admission document delete
if (isset($_POST['admissionDocDel'])) {
	$admissionDocDel = $_POST['admissionDocDel'];
	$clientID = $_POST['clientID'];
	$docType = $_POST['docType'];

	$del_query = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc$docType='' WHERE admission_client_id='$clientID'";
	$del_query_ex = mysqli_query($con, $del_query);
}

if (isset($_POST['clientID'])) {
	$clientID = $_POST['clientID'];

	if (!empty($_FILES['adDocument']['name'])) {
		$fileName = $_FILES['adDocument']['name'];
		$tmpFile = $_FILES['adDocument']['tmp_name'];
		$safeFileName = preg_replace('/[^\w.]+/', '', $fileName);
		echo $finalFileName = date('d-m-Y') . '_' . date('H-i-s') . '_' . $safeFileName;
		move_uploaded_file($tmpFile, '../payagreements/' . $finalFileName);
	}
	$docType = $_POST['docType'];
	$del_query = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc$docType='$finalFileName' WHERE admission_client_id='$clientID'";
	$del_query_ex = mysqli_query($con, $del_query);
}

// SOPs state
if (isset($_POST['programSOPs'])) {
	$programSOPs = $_POST['programSOPs'];

	$select_query = "SELECT italy_sops_status FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programSOPs."'";
	$select_query_ex = mysqli_query($con, $select_query);
	$row = mysqli_fetch_assoc($select_query_ex);
	$sopsStatus = $row['italy_sops_status'];
	
	if ($sopsStatus=='4') {
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
					foreach ($select_query_ex as $row) {
						$sopFile = $row['italy_sops_file'];
					?>
						<tr>
							<td class="breakTD"><?php echo ucwords($row['italy_sops_file_status']);?></td>
							<td class="breakTD"><?php echo date("d-m-Y", strtotime($row['italy_sops_date'])) ?></td>
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
	
<?php }
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

// show note from document collection
if (isset($_POST['checkPersonalNote'])) {
	$clientID = $_POST['checkPersonalNote'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Personal Note <span class="text-danger">*</span>
			</legend>
			<?php 
			$query = "SELECT head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$clientID."' ";
			$queryEx = mysqli_query($con,$query);
			$docRow = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Note <span class="text-danger">*</span></label>
					<textarea class="form-control" name="personalNote" required="required" rows="5"><?php echo $docRow['head_personal_note'];?></textarea>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updPersonalNote"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>
		</div>
	</form>
<?php
}

if (isset($_POST['delAssignPrograms'])) {
	$updateID = $_POST['delAssignPrograms'];

	$updatePro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_assign='', italy_program_assign_date='0000-00-00', italy_assign_status='0' WHERE italy_client_pro_id ='".$updateID."'";
	$updatePro_ex = mysqli_query($con, $updatePro);
}

// programs assign state
if (isset($_POST['programAssign'])) {
	$programAssign = $_POST['programAssign'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $programAssign;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Assign Program <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Select Team <span class="text-danger">*</span></label>
					<select class="form-control" data-toggle='select2' name="assignProgram" autocomplete="off" required="required">
						<option selected value disabled class="text-center">--- Select Team ---</option>
						<?php 
						$select_query = "SELECT * from wt_users WHERE status='1' AND close='1' AND type='italy admission team' ";
						$select_query_ex = mysqli_query($con,$select_query);
						foreach ($select_query_ex as $row) {
						?>
						<option value="<?php echo $row['wt_id'];?>"> <?php echo ucwords($row['fname']." ".$row['lname']);?> </option>
						<?php } ?>
					</select>
				</div>
				
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updPro"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>	
		</div>
		<script type="text/javascript">$('[data-toggle="select2"]').select2();$(".parsley-examples").parsley();</script>
	</form>
<?php }

// Add Due after admission Acceptance page Code

if (isset($_POST['infoAdDel'])) {
	$infoAdDel = $_POST['infoAdDel'];
	$delQuery = "UPDATE clients".$_SESSION['dbNo']." SET due_after_ad_info_file='', due_after_ad_info_note='', due_after_ad_info_date='0000-00-00' WHERE client_id='".$infoAdDel."'";
	$delQuery_ex = mysqli_query($con, $delQuery);
}

if (isset($_POST['infoVisaDel'])) {
	$infoVisaDel = $_POST['infoVisaDel'];
	$delQuery = "UPDATE clients".$_SESSION['dbNo']." SET due_after_visa_info_file='', due_after_visa_info_note='', due_after_visa_info_date='0000-00-00' WHERE client_id='".$infoVisaDel."'";
	$delQuery_ex = mysqli_query($con, $delQuery);
}

if (isset($_POST['afterAcceptanceDue'])) {
	$clientID = $_POST['afterAcceptanceDue'];
	?>
	<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
	<?php 
	$select_query = "SELECT client_name, client_email, client_whatapp, client_applied, due_after_ad_info_file, due_after_ad_info_note, due_after_ad_info_date from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	$row = mysqli_fetch_assoc($select_query_ex);
	$clientName = $row['client_name'];
	$clientEmail = $row['client_email'];
	$clientWhatapp = $row['client_whatapp'];
	$changingApplied = $row['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);

	$dueInfoFile = $row['due_after_ad_info_file'];
	$dueInfoNote = $row['due_after_ad_info_note'];
	$dueInfoDate = $row['due_after_ad_info_date'];
	?>
	<div class="row">
		<div class="col-md-4">
			<div class="alert bg-dark text-warning">
				<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Email: <strong><?php echo $clientEmail;?></strong></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="alert bg-dark text-warning">
				<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
			</div>
		</div>
	</div>

	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Due After Acceptance <span class="text-danger">*</span>
		</legend>
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a href="#infoPayDue" data-toggle="tab" aria-expanded="true" class="nav-link active">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">Inform to Client Pay the after Admission Dues</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#payAdmissionDues" data-toggle="tab" aria-expanded="true" class="nav-link">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">After Admission Dues Received by Client </span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane show active" id="infoPayDue">
						<div class="row">
							<div class="form-group col-md-12">
								<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
									<thead>
										<tr>
											<th width="35%">Inform to Client to Pay the After Admission Due</th>
											<th width="40%">Any Note</th>
											<th width="15%">Date</th>
											<th width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if($dueInfoFile!=''){ ?>
										<tr>
											<td class="breakTD"><?php 
											$fileMulti = explode(',', $dueInfoFile);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
											<?php } ?></td>
											<td class="breakTD"><?php echo $dueInfoNote;?></td>
											<td><?php echo $dueInfoDate;?></td>
											<td>
												<button class="btn btn-danger btn-sm" type="button" onclick="del(delInfoAd,<?php echo $clientID;?>);"><i class="mdi mdi-trash-can"></i> </button>
											</td>
										</tr>
									<?php } else {
										?>
										<tr>
											<td colspan="4">No data available in table</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="form-group col-md-12">
								<form id="formInfoDues" enctype="multipart/form-data" class="parsley-examples">
									<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
									<div class="row">
										<div class="form-group col-md-4">
											<div class="agreement-container" data-agreement-id="20">
												<label class="form-label">Inform to Client to Pay the After Admission Due <span class="text-danger">* (Select Multi Files)</span></label>
												<div class="d-flex justify-content-center">
													<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
													<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
												</div>
												<input type="file" name="dueAdInfoFile[]" required="required" id="uploadedFiles20" class="form-control" multiple style="display: none;">
												<div class="preview"></div>
											</div>
										</div>
										<div class="form-group col-md-8">
											<label class="form-label">Note</label>
											<textarea class="form-control" name="dueAdInfoNote"><?php echo $dueInfoNote;?> </textarea>
										</div>
										<div class="col-md-12">
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="dueAdInfo" onclick="saveDataForm('formInfoDues', 'dueAdInfo')" id="dueAdInfo"><i class="mdi mdi-upload"></i> Update </button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="payAdmissionDues">
						<div class="row">
							<div class="form-group col-md-12">
								<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
									<thead>
										<tr>
											<th width="15%">Dues Status</th>
											<th width="15%">Payment Method</th>
											<th width="15%">Received Amount</th>
											<th width="15%">File Screenshot</th>
											<th width="15%">Remaining Amount</th>
											<th width="10%">Date</th>
											<th width="15%">Any Note</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$selectDues = "SELECT * from italy_clients_admission_dues".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_dues_id='".$clientID."' ";
									$selectDues_ex = mysqli_query($con,$selectDues);
									if (mysqli_num_rows($selectDues_ex) > 0) {
										foreach ($selectDues_ex as $row) {
									?>
										<tr>
											<td><?php echo $row['italy_dues_status'];?></td>
											<td><?php echo $row['italy_dues_payment_method'];?></td>
											<td><?php echo $row['italy_dues_received'];?></td>
											<td class="breakTD"><?php $fileMulti = explode(',', $row['italy_dues_screenshot']);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?></td>
											<td><?php echo $row['italy_dues_remaining'];?></td>
											<td><?php echo $row['italy_dues_date'];?></td>
											<td><?php echo $row['italy_dues_note'];?></td>
										</tr>
										<?php }
									} else {
										?>
										<tr>
											<td colspan="7">No data available in table</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="form-group col-md-12">
								<form id="formPaidDues" enctype="multipart/form-data" class="parsley-examples">
									<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
									<div class="row">
										<div class="form-group col-md-3">
											<label class="form-label">Dues Status <span class="text-danger">*</span></label>
											<select class="form-control" name="duesStatus" required="required" onchange="showDueStatus();" id="duesStatus">
												<option selected value disabled class="text-center">--- Select Dues Status ---</option>
												<option value="Client Pays the Full Payment">Client Pays the Full Payment</option>
												<option value="Client Pays Half Payment">Client Pays Half Payment</option>
												<option value="Client Pays Remaining Payment">Client Pays Remaining Payment</option>
											</select>
										</div>
										<div class="form-group col-md-3">
											<label class="form-label">Dues Status <span class="text-danger">*</span></label>
											<select class="form-control" name="duesPaymentMethod" required="required">
												<option selected value disabled class="text-center">--- Select Dues Payment Method ---</option>
												<?php
												$payMethod = select('payment_method', $con);
												foreach ($payMethod as $row) {
													?>
													<option value="<?= $row['paymethod_name']; ?>"><?= ucwords($row['paymethod_name']); ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group col-md-2">
											<label>Received Amount <span class="text-danger">*</span></label>
											<input type="number" name="duesReceived" class="form-control" required="required">
										</div>
										<div class="form-group col-md-4">
											<div class="agreement-container" data-agreement-id="21">
												<label class="form-label">After Admission Dues Received by Client <span class="text-danger">* (Select Multi Files)</span></label>
												<div class="d-flex justify-content-center">
													<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
													<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
												</div>
												<input type="file" name="dueAdPaidFile[]" required="required" id="uploadedFiles21" class="form-control" multiple style="display: none;">
												<div class="preview"></div>
											</div>
										</div>
										<div class="form-group col-md-6" id="showDueRemain" style="display: none;">
											<label>Remaining Amount <span class="text-danger">*</span></label>
											<input type="number" name="duesRemaining" class="form-control">
										</div>
										<div class="form-group col-md-6" id="showDueDate" style="display: none;">
											<label>Date <span class="text-danger">*</span></label>
											<input type="date" name="duesDate" class="form-control">
										</div>
										<div class="form-group col-md-12">
											<label class="form-label">Note</label>
											<textarea class="form-control" name="dueAdPaidNote"></textarea>
										</div>
										<div class="col-md-12">
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="dueAdPaid" onclick="saveDataForm('formPaidDues', 'dueAdPaid')" id="dueAdPaid"><i class="mdi mdi-upload"></i> Update </button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
<?php }

// Visa Dues Clear
if (isset($_POST['afterVisaDue'])) {
	$clientID = $_POST['afterVisaDue'];
	 
	$select_query = "SELECT client_name, client_email, client_whatapp, client_applied, due_after_visa_info_file, due_after_visa_info_note, due_after_visa_info_date, due_after_visa_received, due_after_visa_pay_method, due_after_visa_paid_file, due_after_visa_paid_note, due_after_visa_paid_date from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	$row = mysqli_fetch_assoc($select_query_ex);
	$clientName = $row['client_name'];
	$clientEmail = $row['client_email'];
	$clientWhatapp = $row['client_whatapp'];
	$changingApplied = $row['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);

	$dueInfoFile = $row['due_after_visa_info_file'];
	$dueInfoNote = $row['due_after_visa_info_note'];
	$dueInfoDate = $row['due_after_visa_info_date'];

	$duePaidReceived = $row['due_after_visa_received'];
	$duePaidPayMethod = $row['due_after_visa_pay_method'];
	$duePaidFile = $row['due_after_visa_paid_file'];
	$duePaidNote = $row['due_after_visa_paid_note'];
	$duePaidDate = $row['due_after_visa_paid_date'];
	?>
	<div class="row">
		<div class="col-md-4">
			<div class="alert bg-dark text-warning">
				<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Email: <strong><?php echo $clientEmail;?></strong></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="alert bg-dark text-warning">
				<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
			</div>
		</div>
	</div>

	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Dues After Visa <span class="text-danger">*</span>
		</legend>
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a href="#infoPayDue" data-toggle="tab" aria-expanded="true" class="nav-link active">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">Inform to Client Pay the after Visa Dues</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#payAdmissionDues" data-toggle="tab" aria-expanded="true" class="nav-link">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">After Visa Dues Received by Client </span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane show active" id="infoPayDue">
						<div class="row">
							<div class="form-group col-md-12">
								<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
									<thead>
										<tr>
											<th width="35%">Inform to Client to Pay the After Visa Due</th>
											<th width="40%">Any Note</th>
											<th width="15%">Date</th>
											<th width="10%">Action</th>
										</tr>
									</thead>
									<tbody>
									<?php if($dueInfoFile!=''){ ?>
										<tr>
											<td class="breakTD"><?php 
											$fileMulti = explode(',', $dueInfoFile);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
											<?php } ?></td>
											<td class="breakTD"><?php echo $dueInfoNote;?></td>
											<td><?php echo $dueInfoDate;?></td>
											<td>
												<button class="btn btn-danger btn-sm" type="button" onclick="del(delInfoVisa,<?php echo $clientID;?>);"><i class="mdi mdi-trash-can"></i> </button>
											</td>
										</tr>
									<?php } else {
										?>
										<tr>
											<td colspan="4">No data available in table</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="form-group col-md-12">
								<form id="formInfoVisa" enctype="multipart/form-data" class="parsley-examples">
									<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
									<div class="row">
										<div class="form-group col-md-5">
											<div class="agreement-container" data-agreement-id="25">
												<label class="form-label">Inform to Client to Pay the After Visa Due <span class="text-danger">* (Select Multi Files)</span></label>
												<div class="d-flex justify-content-center">
													<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
													<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
												</div>
												<input type="file" name="dueAdInfoFile[]" required="required" id="uploadedFiles25" class="form-control" multiple style="display: none;">
												<div class="preview"></div>
											</div>
										</div>
										<div class="form-group col-md-7">
											<label class="form-label">Note</label>
											<textarea class="form-control" name="dueAdInfoNote"><?php echo $dueInfoNote;?> </textarea>
										</div>
										<div class="col-md-12">
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="dueVisaInfo" onclick="saveDataForm('formInfoVisa', 'dueVisaInfo')" id="dueVisaInfo"><i class="mdi mdi-upload"></i> Update </button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="payAdmissionDues">
						<div class="row">
							<div class="form-group col-md-12">
								<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
									<thead>
										<tr>
											<th width="15%">Payment Method</th>
											<th width="15%">Received Amount</th>
											<th width="15%">File Screenshot</th>
											<th width="10%">Date</th>
											<th width="15%">Any Note</th>
										</tr>
									</thead>
									<tbody>
									<?php if($duePaidFile!=''){ ?>
										<tr>
											<td><?php echo $duePaidPayMethod;?></td>
											<td><?php echo $duePaidReceived;?></td>
											<td class="breakTD"><?php $fileMulti = explode(',', $duePaidFile);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?></td>
											<td><?php echo $duePaidDate;?></td>
											<td><?php echo $duePaidNote;?></td>
										</tr>
									<?php } else {
										?>
										<tr>
											<td colspan="5">No data available in table</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="form-group col-md-12">
								<form id="formPaidVisa" enctype="multipart/form-data" class="parsley-examples">
									<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
									<div class="row">
										<div class="form-group col-md-4">
											<label class="form-label">Payment Method <span class="text-danger">*</span></label>
											<select class="form-control" name="duesPaymentMethod" required="required">
												<option selected value disabled class="text-center">--- Select Dues Payment Method ---</option>
												<?php
												$payMethod = select('payment_method', $con);
												foreach ($payMethod as $row) {
												?>
												<option value="<?= $row['paymethod_name']; ?>"><?= ucwords($row['paymethod_name']); ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label>Received Amount <span class="text-danger">*</span></label>
											<input type="number" name="duesReceived" class="form-control" required="required">
										</div>
										<div class="form-group col-md-4">
											<div class="agreement-container" data-agreement-id="26">
												<label class="form-label">After Visa Dues Received by Client <span class="text-danger">* (Select Multi Files)</span></label>
												<div class="d-flex justify-content-center">
													<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
													<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
												</div>
												<input type="file" name="dueAdPaidFile[]" required="required" id="uploadedFiles26" class="form-control" multiple style="display: none;">
												<div class="preview"></div>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label class="form-label">Note</label>
											<textarea class="form-control" name="dueAdPaidNote"></textarea>
										</div>
										<div class="col-md-12">
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="dueVisaPaid" onclick="saveDataForm('formPaidVisa', 'dueVisaPaid')" id="dueVisaPaid"><i class="mdi mdi-upload"></i> Update </button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</fieldset>
<?php }

// show note from document collection
if (isset($_POST['uploadAcceptance'])) {
	$clientID = $_POST['uploadAcceptance'];
	$appliedDegree = $_POST['appliedDegree'];
	?>
	<form id="formSelfAccept1" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<input type="hidden" name="clientDegree" value="<?php echo $appliedDegree;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Self Received Acceptance 1 <span class="text-danger">*</span>
			</legend>
			<?php 
			$query = "SELECT client_id, client_self_acceptance_file, client_self_acceptance_note FROM clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
			$queryEx = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($queryEx);

			$query = "SELECT italy_university_name, italy_program_name, italy_direct_pre FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_intake='Self Acceptance' ";
			$queryEx = mysqli_query($con,$query);
			$proRow = null;
			if ($queryEx && mysqli_num_rows($queryEx) > 0) {
				$proRow = mysqli_fetch_assoc($queryEx);
			}
			?>
			<div class="row">
				<div class="form-group col-md-5">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="selfUniName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['italy_university_name']) ? htmlspecialchars($proRow['italy_university_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-5">
					<label class="form-label">Program Name <span class="text-danger">*</span></label>
					<input type="text" name="selfProName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['italy_program_name']) ? htmlspecialchars($proRow['italy_program_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Pre Enrollment Status <span class="text-danger">*</span></label>
					<select class="form-control" name="selfPreStatus" required="required">
						<?php if(!isset($proRow['italy_direct_pre'])){ ?>
						<option selected disabled value class="text-center">--- Pre Enrollment ---</option>
						<?php }else{ ?>
						<option value="<?php echo isset($proRow['italy_direct_pre']) && $proRow['italy_direct_pre'] == 1 ? 'Yes' : 'No'; ?>"> <?php echo isset($proRow['italy_direct_pre']) && $proRow['italy_direct_pre'] == 1 ? 'Yes' : 'No'; ?> </option>
						<?php } ?>
						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="22">
						<label class="form-label">Upload Acceptance <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="selfFiles[]" required="required" id="uploadedFiles22" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
					<?php 
					if($row['client_self_acceptance_file']!=''){
					$fileMulti = explode(',', $row['client_self_acceptance_file']);
					foreach ($fileMulti as $fileName) {
					?>
					<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
					<?php } } ?>
				</div>
				<div class="form-group col-md-8">
					<label class="form-label">Note</label>
					<textarea class="form-control" name="selfNote"><?php echo $row['client_self_acceptance_note'];?></textarea>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="button" name="updSelfAccept" onclick="saveDataForm('formSelfAccept1', 'updSelfAccept')" id="updSelfAccept"> <?= $row['client_self_acceptance_file']=='' ? '' : ''; ?><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>	
		</div>
	</form>

	<form id="formSelfAccept2" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<input type="hidden" name="clientDegree" value="<?php echo $appliedDegree;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Self Received Acceptance 2 <span class="text-danger">*</span>
			</legend>
			<?php 
			$query = "SELECT client_id, client_self_acceptance_file2, client_self_acceptance_note2 FROM clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
			$queryEx = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($queryEx);

			$query = "SELECT italy_university_name, italy_program_name, italy_direct_pre FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_intake='Self Acceptance2'";
			$queryEx = mysqli_query($con,$query);
			$proRow = null;
			if ($queryEx && mysqli_num_rows($queryEx) > 0) {
				$proRow = mysqli_fetch_assoc($queryEx);
			}
			?>
			<div class="row">
				<div class="form-group col-md-5">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="selfUniName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['italy_university_name']) ? htmlspecialchars($proRow['italy_university_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-5">
					<label class="form-label">Program Name <span class="text-danger">*</span></label>
					<input type="text" name="selfProName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['italy_program_name']) ? htmlspecialchars($proRow['italy_program_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Pre Enrollment Status <span class="text-danger">*</span></label>
					<select class="form-control" name="selfPreStatus" required="required">
						<?php if(!isset($proRow['italy_direct_pre'])){ ?>
						<option selected disabled value class="text-center">--- Pre Enrollment ---</option>
						<?php }else{ ?>
						<option value="<?php echo isset($proRow['italy_direct_pre']) && $proRow['italy_direct_pre'] == 1 ? 'Yes' : 'No'; ?>"> <?php echo isset($proRow['italy_direct_pre']) && $proRow['italy_direct_pre'] == 1 ? 'Yes' : 'No'; ?> </option>
						<?php } ?>
						
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="23">
						<label class="form-label">Upload Acceptance <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="selfFiles[]" required="required" id="uploadedFiles23" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
					<?php 
					if($row['client_self_acceptance_file2']!=''){
					$fileMulti = explode(',', $row['client_self_acceptance_file2']);
					foreach ($fileMulti as $fileName) {
					?>
					<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
					<?php } } ?>
				</div>
				<div class="form-group col-md-8">
					<label class="form-label">Note</label>
					<textarea class="form-control" name="selfNote"><?php echo $row['client_self_acceptance_note2'];?></textarea>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="button" name="updSelfAccept2" onclick="saveDataForm('formSelfAccept2', 'updSelfAccept2')" id="updSelfAccept2"> <?= $row['client_self_acceptance_file2']=='' ? '' : ''; ?><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>	
		</div>
	</form>
<?php
}


// change Intake Year
if (isset($_POST['intakeYearChange'])) {
	$clientID = $_POST['intakeYearChange'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Intake Year <span class="text-danger">*</span>
			</legend>
			<?php 
			$query = "SELECT client_intake_year FROM clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
			$queryEx = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Intake Year <span class="text-danger">*</span></label>
					<select class="form-control" name="intakeYear" required="required" autocomplete="off">
						<option value="<?php echo $row['client_intake_year'];?>"><?php echo $row['client_intake_year'];?></option>
						<option value="26-27">2026-2027</option>
						<option value="Both">2025-2026/2026-2027(Both)</option>
						<option value="27-28">2027-2028</option>
					</select>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updIntake"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>
		</div>
	</form>
<?php
}

// programs assign state
if (isset($_POST['assignWhatsAppAgent'])) {
	$clientID = $_POST['assignWhatsAppAgent'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Assign Client to Admission WhatsApp Agent <span class="text-danger">*</span>
			</legend>
			<?php 
			$query = "SELECT country_agent_assign_to, country_agent_assign_date FROM clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
			$queryEx = mysqli_query($con,$query);
			$row = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Select Agent <span class="text-danger">*</span></label>
					<select class="form-control" data-toggle='select2' name="assignAdmissionAgent" autocomplete="off" required="required">
						<option value="<?php echo $row['country_agent_assign_to'];?>"><?php if (empty($row['country_agent_assign_to'])) { echo '--- Select Agent ---'; } else { echo $row['country_agent_assign_to']; } ?></option>
						<option value="Asima">Asima</option>
						<option value="Kanwal">Kanwal</option>
						<option value="Laiba">Laiba</option>
						<option value="Sholmiyat">Sholmiyat</option>
						<option value="Hira">Hira</option>
						<option value="Kashaf">Kashaf</option>
						<option value="Jawairia">Jawairia</option>
						<option value="Amna Shafqat">Amna Shafqat</option>
						<option value="Zainab">Zainab</option>
						<option value="Bisma">Bisma</option>
					</select>
				</div>
				<div class="form-group col-md-5">
					<label class="form-label">Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="enterPassword" class="form-control" required="required" onkeyup="agentPasswordCheck()" id="enterPassword">
				</div>
				<div class="col-md-1">
					<div class="float-right">
						<label class="form-label">Delete <span class="text-danger">*</span></label>
						<button class="btn btn-danger" type="button" name="" onclick="delAgent(<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button>
					</div>
				</div>	
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updAgent" id="agentBtn" disabled=""><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>	
		</div>
		<script type="text/javascript">$('[data-toggle="select2"]').select2();$(".parsley-examples").parsley();</script>
	</form>

<?php }


// programs assign state
if (isset($_POST['deleteWhatsAppAgent'])) {
	$clientID = $_POST['deleteWhatsAppAgent'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Delete Client to Admission WhatsApp Agent <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="enterPassword" class="form-control" required="required" onkeyup="agentPasswordCheck()" id="enterPassword">
				</div>	
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="delAgent" id="agentBtn" disabled=""><i class="mdi mdi-upload"></i> Delete</button>
				</div>
			</div>	
		</div>
		<script type="text/javascript">$(".parsley-examples").parsley();</script>
	</form>

<?php }


?>