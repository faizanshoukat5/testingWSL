<?php
ob_start();
session_start();
include_once("../env/main-config.php");
include_once('models/selectFunction.php');
// helpers
include_once('models/uploadHelper.php');
include_once('models/escape.php');
// To download documents admission
if (isset($_POST['clientDocAdmission'])) {
	$clientID = (int)($_POST['clientDocAdmission'] ?? 0);
	$table = 'client_addmission_doc' . $_SESSION['dbNo'];
	$sql = "SELECT * FROM `" . $table . "` WHERE admission_client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $clientID);
		mysqli_stmt_execute($stmt);
		$clientData_ex = mysqli_stmt_get_result($stmt);
		mysqli_stmt_close($stmt);
	} else {
		$clientData_ex = false;
	}

	$files = [];
	foreach ($clientData_ex as $row) {
		for ($i = 1; $i <= 45; $i++) {
			$docKey = 'admission_doc' . $i;
			if (!empty($row[$docKey])) {
				$files[] = '../payagreements/' . $row[$docKey];
			}
		}
	}

	$tableClients = 'clients' . $_SESSION['dbNo'];
	$sqlClientName = "SELECT client_name FROM `" . $tableClients . "` WHERE client_id = ?";
	$stmtClientName = mysqli_prepare($con, $sqlClientName);
	if ($stmtClientName) {
		mysqli_stmt_bind_param($stmtClientName, 'i', $clientID);
		mysqli_stmt_execute($stmtClientName);
		$resClient = mysqli_stmt_get_result($stmtClientName);
		$row = mysqli_fetch_assoc($resClient);
		mysqli_stmt_close($stmtClientName);
	} else {
		$row = null;
	}
	$clientName = trim($row['client_name'] ?? '');

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
	$admissionDocDel = (int)($_POST['admissionDocDel'] ?? 0);
	$clientID = (int)($_POST['clientID'] ?? 0);
	$docType = (int)($_POST['docType'] ?? 0);

	// validate numeric doc index before using as column name
	if ($docType >= 1 && $docType <= 45) {
		$col = 'admission_doc' . $docType;
		$table = 'client_addmission_doc' . $_SESSION['dbNo'];
		$sql = "UPDATE `" . $table . "` SET `" . $col . "` = '' WHERE admission_client_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'i', $clientID);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}
} 

if (isset($_POST['clientID'])) {
	$clientID = (int)($_POST['clientID'] ?? 0);

	// handle single file upload using helper
	$finalFileName = '';
	if (!empty($_FILES['adDocument']['name'])) {
		$uploadResult = upload_single_file($_FILES['adDocument'], __DIR__ . '/../payagreements/', ['jpg','jpeg','png','gif','pdf','doc','docx'], 5*1024*1024);
		if (!$uploadResult['success']) {
			echo json_encode(['error' => $uploadResult['error']]);
			exit;
		}
		$finalFileName = $uploadResult['file'];
	}
	$docType = (int)($_POST['docType'] ?? 0);
	if ($docType >= 1 && $docType <= 45) {
		$col = 'admission_doc' . $docType;
		$table = 'client_addmission_doc' . $_SESSION['dbNo'];
		$sql = "UPDATE `" . $table . "` SET `" . $col . "` = ? WHERE admission_client_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'si', $finalFileName, $clientID);
			$del_query_ex = mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		} else {
			$del_query_ex = false;
		}
	} else {
		$del_query_ex = false;
	}
} 

// SOPs state
if (isset($_POST['programSOPs'])) {
	$programSOPs = (int)($_POST['programSOPs'] ?? 0);

	$table = 'austria_clients_programs' . $_SESSION['dbNo'];
	$sql = "SELECT aus_sops_status FROM `" . $table . "` WHERE status='1' AND close='1' AND aus_client_pro_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $programSOPs);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($res);
		mysqli_stmt_close($stmt);
	} else {
		$row = null;
	}
	$sopsStatus = $row['aus_sops_status'] ?? null; 
	
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
					$detailTable = 'austria_program_sops' . $_SESSION['dbNo'];
					$sqlDetail = "SELECT aus_sops_file_status, aus_sops_date, aus_sops_anynote, aus_sops_file FROM `" . $detailTable . "` WHERE status='1' AND close='1' AND aus_sops_program_id = ?";
					$stmtDetail = mysqli_prepare($con, $sqlDetail);
					if ($stmtDetail) {
						mysqli_stmt_bind_param($stmtDetail, 'i', $programSOPs);
						mysqli_stmt_execute($stmtDetail);
						$selectQuery_ex = mysqli_stmt_get_result($stmtDetail);
						mysqli_stmt_close($stmtDetail);
					} else {
						$selectQuery_ex = false;
					}
					if (mysqli_num_rows($selectQuery_ex) > 0) {
						foreach ($selectQuery_ex as $row) {
						$sopFile = $row['aus_sops_file'];
					?>
						<tr>
							<td class="breakTD"><?php echo e(ucwords($row['aus_sops_file_status']));?></td>
							<td class="breakTD"><?php echo e(date("d-m-Y", strtotime($row['aus_sops_date']))); ?></td>
							<td class="breakTD"><?php echo e($row['aus_sops_anynote']); ?></td>
							<td class="breakTD">
							<?php 
							$fileMulti = explode(',', $sopFile);
							foreach ($fileMulti as $fileName) {
								?>
								<a href="../payagreements/<?php echo e($fileName);?>" target="blank" download><?php echo e($fileName);?></a><br>
							<?php } ?>
							</td>
						</tr>
						<?php }
					} else {
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
	
<?php }
// show note from document collection
if (isset($_POST['checkAdmissionNote'])) {
	$clientID = (int)($_POST['checkAdmissionNote'] ?? 0);
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Document Collection Note <span class="text-danger">*</span>
		</legend>
		<?php 
		$table = 'client_addmission_doc' . $_SESSION['dbNo'];
		$sql = "SELECT note_admission FROM `" . $table . "` WHERE status='0' AND close='0' AND admission_client_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'i', $clientID);
			mysqli_stmt_execute($stmt);
			$res = mysqli_stmt_get_result($stmt);
			$docRow = mysqli_fetch_assoc($res);
			mysqli_stmt_close($stmt);
		} else {
			$docRow = null;
		}
		?>
		<div class="row">
			<div class="form-group col-md-12">
				<label class="form-label">Note <span class="text-danger">*</span></label> <br>
				<?php if (!empty($docRow['note_admission'] ?? '')) {
					echo e($docRow['note_admission']);
				} else {
					echo "No Note Found";
				}?>
			</div>
		</div>
	</fieldset>
<?php
}

// show note from document collection
if (isset($_POST['checkPersonalNote'])) {
	$clientID = (int)($_POST['checkPersonalNote'] ?? 0);
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Personal Note <span class="text-danger">*</span>
			</legend>
			<?php 
			$table = 'client_addmission_doc' . $_SESSION['dbNo'];
			$sql = "SELECT head_personal_note FROM `" . $table . "` WHERE status='0' AND close='0' AND admission_client_id = ?";
			$stmt = mysqli_prepare($con, $sql);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, 'i', $clientID);
				mysqli_stmt_execute($stmt);
				$res = mysqli_stmt_get_result($stmt);
				$docRow = mysqli_fetch_assoc($res);
				mysqli_stmt_close($stmt);
			} else {
				$docRow = null;
			}
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Note <span class="text-danger">*</span></label>
					<textarea class="form-control" name="personalNote" required="required" rows="5"><?php echo e($docRow['head_personal_note'] ?? ''); ?></textarea>
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
	$updateID = (int)($_POST['delAssignPrograms'] ?? 0);
	$table = 'austria_clients_programs' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET aus_program_assign = '', aus_program_assign_date = '0000-00-00', aus_assign_status = '0' WHERE aus_client_pro_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $updateID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
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
						$select_query = "SELECT * from wt_users WHERE status='1' AND close='1' AND type='austria admission team' ";
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
	$infoAdDel = (int)($_POST['infoAdDel'] ?? 0);
	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "UPDATE `" . $table . "` SET due_after_ad_info_file = '', due_after_ad_info_note = '', due_after_ad_info_date = '0000-00-00' WHERE client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $infoAdDel);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
} 

if (isset($_POST['afterAcceptanceDue'])) {
	$clientID = $_POST['afterAcceptanceDue'];
	?>
	<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
	<?php 
	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "SELECT client_name, client_email, client_whatapp, client_applied, due_after_ad_info_file, due_after_ad_info_note, due_after_ad_info_date FROM `" . $table . "` WHERE status='1' AND close='1' AND client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $clientID);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($res);
		mysqli_stmt_close($stmt);
	} else {
		$row = null;
	}
	$clientName = $row['client_name'] ?? '';
	$clientEmail = $row['client_email'] ?? '';
	$clientWhatapp = $row['client_whatapp'] ?? '';
	$changingApplied = $row['client_applied'] ?? '[]';
	$appliedChanging = json_decode($changingApplied, true);

	$dueInfoFile = $row['due_after_ad_info_file'] ?? '';
	$dueInfoNote = $row['due_after_ad_info_note'] ?? '';
	$dueInfoDate = $row['due_after_ad_info_date'] ?? '';
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
			Due After Verification <span class="text-danger">*</span>
		</legend>
		<div class="row">
			<div class="col-md-12">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a href="#infoPayDue" data-toggle="tab" aria-expanded="true" class="nav-link active">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">Inform to Client Pay the after Verification Dues</span>
						</a>
					</li>
					<li class="nav-item">
						<a href="#payAdmissionDues" data-toggle="tab" aria-expanded="true" class="nav-link">
							<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
							<span class="d-none d-sm-block text-warning">After Verification Dues Received by Client </span>
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
											<th width="35%">Inform to Client to Pay the After Verification Due</th>
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
										<?php }else {
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
												<label class="form-label">Inform to Client to Pay the After Verification Due <span class="text-danger">* (Select Multi Files)</span></label>
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
									$duesTable = 'austria_clients_admission_dues' . $_SESSION['dbNo'];
		$sqlDues = "SELECT * FROM `" . $duesTable . "` WHERE status='1' AND close='1' AND aus_client_dues_id = ?";
									$stmtDues = mysqli_prepare($con, $sqlDues);
		if ($stmtDues) {
			mysqli_stmt_bind_param($stmtDues, 'i', $clientID);
			mysqli_stmt_execute($stmtDues);
			$selectDues_ex = mysqli_stmt_get_result($stmtDues);
			mysqli_stmt_close($stmtDues);
		} else {
			$selectDues_ex = false;
		}
									if (mysqli_num_rows($selectDues_ex) > 0) {
										foreach ($selectDues_ex as $row) {
									?>
										<tr>
											<td><?php echo $row['aus_dues_status'];?></td>
											<td><?php echo $row['aus_dues_payment_method'];?></td>
											<td><?php echo $row['aus_dues_received'];?></td>
											<td class="breakTD"><?php $fileMulti = explode(',', $row['aus_dues_screenshot']);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?></td>
											<td><?php echo $row['aus_dues_remaining'];?></td>
											<td><?php echo $row['aus_dues_date'];?></td>
											<td><?php echo $row['aus_dues_note'];?></td>
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
								<form id="formDuesPaid" enctype="multipart/form-data" class="parsley-examples">
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
												<label class="form-label">After Verification Dues Received by Client <span class="text-danger">* (Select Multi Files)</span></label>
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
												<button class="btn btn-custom" type="button" name="dueAdPaid" onclick="saveDataForm('formDuesPaid', 'dueAdPaid')" id="dueAdPaid"><i class="mdi mdi-upload"></i> Update </button>
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
<?php
}


// Visa Dues Clear
if (isset($_POST['afterVisaDue'])) {
	$clientID = $_POST['afterVisaDue'];
	 
	$table = 'clients' . $_SESSION['dbNo'];
	$sql = "SELECT client_name, client_email, client_whatapp, client_applied, due_after_visa_info_file, due_after_visa_info_note, due_after_visa_info_date, due_after_visa_received, due_after_visa_pay_method, due_after_visa_paid_file, due_after_visa_paid_note, due_after_visa_paid_date FROM `" . $table . "` WHERE status='1' AND close='1' AND client_id = ?";
	$stmt = mysqli_prepare($con, $sql);
	if ($stmt) {
		mysqli_stmt_bind_param($stmt, 'i', $clientID);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		$row = mysqli_fetch_assoc($res);
		mysqli_stmt_close($stmt);
	} else {
		$row = null;
	}
	$clientName = $row['client_name'] ?? '';
	$clientEmail = $row['client_email'] ?? '';
	$clientWhatapp = $row['client_whatapp'] ?? '';
	$changingApplied = $row['client_applied'] ?? '[]';
	$appliedChanging = json_decode($changingApplied, true);

	$dueInfoFile = $row['due_after_visa_info_file'] ?? '';
	$dueInfoNote = $row['due_after_visa_info_note'] ?? '';
	$dueInfoDate = $row['due_after_visa_info_date'] ?? '';

	$duePaidReceived = $row['due_after_visa_received'] ?? '';
	$duePaidPayMethod = $row['due_after_visa_pay_method'] ?? '';
	$duePaidFile = $row['due_after_visa_paid_file'] ?? '';
	$duePaidNote = $row['due_after_visa_paid_note'] ?? '';
	$duePaidDate = $row['due_after_visa_paid_date'] ?? '';
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
										<?php }else {
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
	<form id="formSelfAccept" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<input type="hidden" name="clientDegree" value="<?php echo $appliedDegree;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Self Received Acceptance <span class="text-danger">*</span>
			</legend>
			<?php 
$table = 'clients' . $_SESSION['dbNo'];
		$sql = "SELECT client_id, client_self_acceptance_file, client_self_acceptance_note FROM `" . $table . "` WHERE status='1' AND close='1' AND client_id = ?";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'i', $clientID);
			mysqli_stmt_execute($stmt);
			$res = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($res);
			mysqli_stmt_close($stmt);
		} else {
			$row = null;
		}

			$progTable = 'austria_clients_programs' . $_SESSION['dbNo'];
		$sql = "SELECT aus_university_name, aus_program_name FROM `" . $progTable . "` WHERE status='1' AND (close='1' OR close='0') AND aus_change_program_status='0' AND aus_clients_id = ? AND aus_intake = 'Self Acceptance'";
		$stmt = mysqli_prepare($con, $sql);
		if ($stmt) {
			mysqli_stmt_bind_param($stmt, 'i', $clientID);
			mysqli_stmt_execute($stmt);
			$queryEx = mysqli_stmt_get_result($stmt);
			$proRow = mysqli_fetch_assoc($queryEx) ?: null;
			mysqli_stmt_close($stmt);
		} else {
			$proRow = null;
		}

			?>
			<div class="row">
				<div class="form-group col-md-4">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="selfUniName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['aus_university_name']) ? htmlspecialchars($proRow['aus_university_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Program Name <span class="text-danger">*</span></label>
					<input type="text" name="selfProName" class="form-control" required="required" autocomplete="off" value="<?php echo isset($proRow['aus_program_name']) ? htmlspecialchars($proRow['aus_program_name']) : ''; ?>">
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="22">
						<label class="form-label">Upload Acceptance <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="selfFiles[]" required="required" id="uploadedFiles22" class="form-control" multiple style="display: none;">
						<div class="preview">
							<?php
							if (!empty($row['client_self_acceptance_file'] ?? '')) {
								$savedFiles = explode(',', $row['client_self_acceptance_file']);
								foreach ($savedFiles as $savedFile) {
									$savedFile = trim($savedFile);
									$filePath = "../payagreements/" . $savedFile;
									$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
									?>
									<div class="preview" data-file-name="<?php echo $savedFile; ?>"
										style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
										<a href="<?php echo $filePath; ?>" target="_blank">
											<?php
											if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
												echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
											} else {
												echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666;'>📄</div>";
											}
											?>
										</a>
									</div>
									<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Note</label>
					<textarea class="form-control" name="selfNote"><?php echo e($row['client_self_acceptance_note'] ?? ''); ?></textarea>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updSelfAccept" <?= ($row['client_self_acceptance_file'] ?? '')=='' ? '' : 'disabled'; ?> onclick="saveDataForm('formSelfAccept', 'updSelfAccept')" id="updSelfAccept"><i class="mdi mdi-upload"></i> Update</button>
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
			$table = 'clients' . $_SESSION['dbNo'];
			$sql = "SELECT client_intake_year FROM `" . $table . "` WHERE status='1' AND close='1' AND client_id = ?";
			$stmt = mysqli_prepare($con, $sql);
			if ($stmt) {
				mysqli_stmt_bind_param($stmt, 'i', $clientID);
				mysqli_stmt_execute($stmt);
				$res = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($res);
				mysqli_stmt_close($stmt);
			} else {
				$row = null;
			}
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Intake Year <span class="text-danger">*</span></label>
					<select class="form-control" name="intakeYear" required="required" autocomplete="off">
						<option value="<?php echo $row['client_intake_year'] ?? '';?>"><?php echo $row['client_intake_year'] ?? '';?></option>
						<option value="Both">2025-2026/2026-2027(Both)</option>
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
if (isset($_POST['teamPortalID'])) {
	$empID = $_POST['teamPortalID'];

	$select_query = "SELECT * FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$empID."'";
	$select_query_ex = mysqli_query($con, $select_query);

	if (mysqli_num_rows($select_query_ex) > 0) {
		$row = mysqli_fetch_assoc($select_query_ex);
		$userName = $row['user_name'];
		$password = $row['password'];

		session_unset();
		session_destroy();
		setcookie('user_id', '', time() - 3600, '/');
		setcookie('user_email', '', time() - 3600, '/');
		setcookie('final_pass', '', time() - 3600, '/');
		setcookie('user_type', '', time() - 3600, '/');
		setcookie('user_name', '', time() - 3600, '/');
		setcookie('uname', '', time() - 3600, '/');

		session_start();

		$log_sql = "SELECT * FROM wt_users WHERE user_name = ? AND password = ?";
		$stmtLog = mysqli_prepare($con, $log_sql);
		if ($stmtLog) {
			mysqli_stmt_bind_param($stmtLog, 'ss', $userName, $password);
			mysqli_stmt_execute($stmtLog);
			$log_sql_ex = mysqli_stmt_get_result($stmtLog);
			mysqli_stmt_close($stmtLog);
		} else {
			$log_sql_ex = false;
		} 

		if (mysqli_num_rows($log_sql_ex) == 1) {
			$row = mysqli_fetch_assoc($log_sql_ex);

			$_SESSION['user_id'] = $row['wt_id'];
			setcookie('user_id', $row['wt_id'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['final_pass'] = $row['password'];
			setcookie('final_pass', $row['password'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_name'] = $row['user_name'];
			setcookie('user_name', $row['user_name'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_email'] = $row['email'];
			setcookie('user_email', $row['email'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_type'] = $row['type'];
			setcookie('user_type', $row['type'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['uname'] = $row['fname'] . " " . $row['lname'];
			setcookie('uname', $_SESSION['uname'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['phone'] = $row['phone'];
			setcookie('phone', $row['phone'], time() + (60 * 60 * 24 * 30), '/');
			$_SESSION['user_designation'] = $row['designation'];
			setcookie('user_designation', $row['designation'], time() + (60 * 60 * 24 * 30), '/');

			$_SESSION['user_image'] = $row['user_image'];
			setcookie('user_image', $row['user_image'], time() + (60 * 60 * 24 * 30), '/');

		$select_session = "SELECT * FROM session_active WHERE active_user_id = ?";
		$stmtSess = mysqli_prepare($con, $select_session);
		if ($stmtSess) {
			$uid = (int)($_SESSION['user_id'] ?? 0);
			mysqli_stmt_bind_param($stmtSess, 'i', $uid);
			mysqli_stmt_execute($stmtSess);
			$select_session_ex = mysqli_stmt_get_result($stmtSess);
			mysqli_stmt_close($stmtSess);
		} else {
			$select_session_ex = false;
		}
			foreach($select_session_ex as $session_value){
				$_SESSION['dbNo'] = $session_value['active_session_id'];
				setcookie('dbNo', $_SESSION['dbNo'],time()+(60*60*24*30),'/');

				$_SESSION['s_date'] = $session_value['s_date'];
				setcookie('s_date', $_SESSION['s_date'],time()+(60*60*24*30),'/');
				$_SESSION['e_date'] = $session_value['e_date'];
				setcookie('e_date', $_SESSION['e_date'],time()+(60*60*24*30),'/');
			}

			// Prepare response with redirection path
			$response = array();
			if ($_SESSION['user_type'] == 'admin') {
				$response['redirect'] = '../super-admin/dashboard';
			}
			elseif ($_SESSION['user_type'] == 'sale department') {
				$response['redirect'] = '../sale-department/dashboard';
			}
			elseif ($_SESSION['user_type'] == 'team manager') {
				$response['redirect'] = '../team-manager/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'accountant') {
				$response['redirect'] = '../accountant/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'documents collections' || $_SESSION['user_type'] == 'documents collections france') {
				$response['redirect'] = '../documents-collections/dashboard';
			}
			// Austria Country 
			elseif ($_SESSION['user_type'] == 'austria admission head') {
				$response['redirect'] = '../austria-admission-head/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria admission team') {
				$response['redirect'] = '../austria-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria visa team') {
				$response['redirect'] = '../austria-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'austria university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			} 
			// italy country
			elseif ($_SESSION['user_type'] == 'italy admission head') {
				$response['redirect'] = '../italy-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy admission team') {
				$response['redirect'] = '../italy-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy visa team') {
				$response['redirect'] = '../italy-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'italy university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}
			// czech republic country
			elseif ($_SESSION['user_type'] == 'czech republic admission head') {
				$response['redirect'] = '../czech-republic-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic admission team') {
				$response['redirect'] = '../czech-republic-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic visa team') {
				$response['redirect'] = '../czech-republic-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'czech republic university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}
			// france country
			elseif ($_SESSION['user_type'] == 'france admission head') {
				$response['redirect'] = '../france-admission-head/admission-dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france admission team') {
				$response['redirect'] = '../france-admission-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france visa team') {
				$response['redirect'] = '../france-visa-team/dashboard';
			} 
			elseif ($_SESSION['user_type'] == 'france university sop') {
				$response['redirect'] = '../university-sop-team/dashboard';
			}

			elseif ($_SESSION['user_type'] == 'IELTS Enrollment') {
				$response['redirect'] = '../ielts-enrollment/dashboard';
			}

			echo json_encode($response);
		}
	}
}
?>