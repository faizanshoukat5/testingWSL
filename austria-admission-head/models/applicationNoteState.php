<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Add note of programs
if (isset($_POST['checkdegreeName'])) {
	$degreeName = $_POST['checkdegreeName'];
	$uniName = $_POST['checkuniversityName'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="degreeName" value="<?php echo $degreeName;?>">
		<input type="hidden" name="uniName" value="<?php echo $uniName;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Opening & Closing Date <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-3">
					<label class="form-label">University Announce Opening Date <span class="text-danger">*</span></label><br>
					<div class="radio radio-success form-check-inline">
						<input type="radio" id="yesIDDate" value="1" name="radioStep" onclick="openingYesDate();" required="required">
						<label for="yesIDDate"> Yes </label>
					</div>
					<div class="radio radio-danger form-check-inline">
						<input type="radio" id="noIDDate" value="2" name="radioStep" onclick="openingNoDate();" required="required">
						<label for="noIDDate"> No </label>
					</div>
				</div>
				<div class="form-group col-md-3" style="display: none;" id="showOpeningDate">
					<label class="form-label">Opening Date <span class="text-danger">*</span></label>
					<input type="date" name="uniOpeningDate" class="form-control" autocomplete="off" >
				</div>
				<div class="form-group col-md-3" style="display: none;" id="showClosingDate">
					<label class="form-label">Closing Date <span class="text-danger">*</span></label>
					<input type="date" name="uniClosingDate" class="form-control" autocomplete="off" >
				</div>
				<div class="form-group col-md-3">
					<div class="checkbox checkbox-success form-check-inline mt-4">
						<input type="hidden" id="hidden_applyDates" name="proapplyDates" value="0">
						<input type="checkbox" id="applyDates" name="" onclick="updUniDateHidden(this, 'hidden_applyDates');">
						<label for="applyDates"> <b>Apply Date in all Programs</b> </label>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Any Note</label>
					<textarea name="uniAnyNote" class="form-control" autocomplete="off" id="editor"></textarea>
				</div>
				<script>
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
			<div class="row">
				<div class="form-group col-md-12">
					<div class="float-right">
						<button class="btn btn-custom" type="submit" name="updUniDate"><i class="mdi mdi-upload"></i> Update</button>
					</div>
				</div>	
			</div>
		</fieldset>
	</form>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="15%">Status</th>
							<th width="15%">Opening Date</th>
							<th width="15%">Closing Date</th>
							<th width="55%">Note</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$selectQuery = "SELECT * from austria_university_dates WHERE status='1' AND close='1' AND aus_university_name ='".$uniName."' AND aus_degree_name='".$degreeName."' ORDER BY aus_dates_id DESC ";
					$selectQuery_ex = mysqli_query($con,$selectQuery);
					if (mysqli_num_rows($selectQuery_ex) > 0) {
						foreach ($selectQuery_ex as $rowDate) {
					?>
						<tr> 
							<td class="breakTD">
							<?php
							echo ($rowDate['aus_date_status'] == '1') ? 'Yes' : (($rowDate['aus_date_status'] == '2') ? 'No' : '');
							?>
							</td>
							<td class="breakTD">
								<b><?php if ($rowDate['aus_opening_date']=='0000-00-00') { }else{
									echo date("d-m-Y", strtotime($rowDate['aus_opening_date']));
								}?></b>
							</td>
							<td class="breakTD">
								<b><?php if ($rowDate['aus_closing_date']=='0000-00-00') { }
								else{
									echo date("d-m-Y", strtotime($rowDate['aus_closing_date'])); 
								}?></b>
							</td>
							<td class="breakTD text-left"><?php echo $rowDate['aus_note'] ?></td>
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
<?php
}
// CGPA Universities
if (isset($_POST['cgpadegreeName'])) {
	$degreeName = $_POST['cgpadegreeName'];
	$uniName = $_POST['cgpauniversityName'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="degreeCGPAName" value="<?php echo $degreeName;?>">
		<input type="hidden" name="uniCGPAName" value="<?php echo $uniName;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University CGPA <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">University CGPA</label>
					<input type="float" name="uniCGPA" class="form-control" required="required">
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Any Note</label>
					<textarea name="uniCGPANote" class="form-control" autocomplete="off"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-custom" type="submit" name="updUniCGPA"><i class="mdi mdi-upload"></i> Update</button>
					</div>
				</div>	
			</div>
		</fieldset>
	</form>

	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="25%">CGPA</th>
							<th width="65%">Note</th>
							<th width="10%">Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$selectQuery = "SELECT * from austria_university_cgpa WHERE status='1' AND close='1' AND aus_cgpa_uni_name='".$uniName."' AND aus_cgpa_uni_degree='".$degreeName."' ORDER BY aus_cgpa_uni_id DESC ";
					$selectQuery_ex = mysqli_query($con,$selectQuery);
					if (mysqli_num_rows($selectQuery_ex) > 0) {
						foreach ($selectQuery_ex as $row) {
					?>
						<tr>
							<td><?php echo $row['aus_uni_cgpa'];?></td>
							<td><?php echo $row['aus_cgpa_uni_note'];?></td>
							<td><?php echo $row['crt_date'];?></td>
						</tr>
					<?php } 
					}else {
						?>
						<tr>
							<td colspan="3">No data available in table</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php 
}
// Add Note for admission head for university process
if (isset($_POST['noteForAdmissionHead'])) {
	$programsclientID = $_POST['noteForAdmissionHead'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Note Details <span class="text-danger">*</span>
			</legend>
			<input type="hidden" name="updateID" value="<?php echo $programsclientID;?>">
			<?php 
			$query = "SELECT aus_document_collection_note FROM austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_pro_id='".$programsclientID."' ";
			$queryEx = mysqli_query($con,$query);
			$docRow = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Note from Documents Collection for University Process <span class="text-danger">*</span></label> <br>
					<?php if($docRow['aus_document_collection_note']!=''){
						echo $docRow['aus_document_collection_note'];
					}else{
						echo "No Note Found";
					}?>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}
// Add note of programs
if (isset($_POST['checkProgramNote'])) {
	$programID = $_POST['checkProgramNote'];
	
	$program_query = "SELECT aus_clients_id, aus_university_name, aus_program_name from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_pro_id='".$programID."' ";
	$program_query_ex = mysqli_query($con,$program_query);
	$rowCl = mysqli_fetch_assoc($program_query_ex);
	$clientID = $rowCl['aus_clients_id'];
	$uniName = $rowCl['aus_university_name'];
	$programName = $rowCl['aus_program_name'];

	$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$client_query_ex = mysqli_query($con,$client_query);
	$clientRow = mysqli_fetch_assoc($client_query_ex);
	$clientName = $clientRow['client_name'];
	$clientEmail = $clientRow['client_email'];
	$clientWhatsapp = $clientRow['client_whatapp'];
	$changingApplied = $clientRow['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);
	?>
	<div class="row">
		<div class="col-md-5">
			<div class="alert bg-dark text-warning">
				<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>WhatsApp: <strong><?php echo $clientWhatsapp;?></strong></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="alert bg-dark text-warning">
				<p>Email: <strong><?php echo $clientEmail;?></strong></p>
			</div>
		</div>
		<div class="col-md-2">
			<div class="alert bg-dark text-warning">
				<p>Degree: <strong><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></strong></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="alert bg-dark text-warning">
				<p>University: <strong><?php echo $uniName;?></strong></p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="alert bg-dark text-warning">
				<p>Program:
					<span class="font-weight-bold">
						<?php 
							$decoded = json_decode($programName, true);
							if (is_array($decoded)) {
								$output = '';
								foreach ($decoded as $key => $name) {
									$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
								}
								echo $output;
							} else {
								echo ucwords($programName);
							}
						?>
					</span>
				</p>
			</div>
		</div>
	</div>

	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="#ApplicationNote" data-toggle="tab" aria-expanded="true" class="nav-link active">
					<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
					<span class="d-none d-sm-block">Application Note </span>
				</a>
			</li>
			<li class="nav-item">
				<a href="#changingProgram" data-toggle="tab" aria-expanded="true" class="nav-link">
					<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
					<span class="d-none d-sm-block">Changing Program </span>
				</a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="tab-pane show active" id="ApplicationNote">
				<form id="formNoteApplication" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
					<div class="row">
						<div class="form-group col-md-4">
							<label class="form-label">Program Note <span class="text-danger">*</span></label><br>
							<div class="radio radio-danger form-check-inline">
								<input type="radio" id="yesIDDate" value="1" name="radioStep">
								<label for="yesIDDate"> Application Pending </label>
							</div>
							<div class="radio radio-success form-check-inline">
								<input type="radio" id="noIDDate" value="2" name="radioStep">
								<label for="noIDDate"> Application Resolves </label>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="35">
								<label class="form-label">Application Screenshot <span class="text-danger">* (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="appNoteScreenshot[]" id="uploadedFiles35" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="36">
								<label class="form-label">Any Audio Message <span class="text-danger">* (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="appNoteAudio[]" id="uploadedFiles36" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Application Note <span class="text-danger">*</span></label>
							<textarea class="form-control" name="appNoteNote" required="required"></textarea>
						</div>
						<div class="form-group col-md-12">
							<div class="float-right">
								<button class="btn btn-primary" type="button" name="updappNote" onclick="saveDataForm('formNoteApplication', 'updappNote')" id="updappNote"><i class="mdi mdi-upload"></i> Update</button>
							</div> 
						</div>
					</div>
				</form>

				<!-- table show -->
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
							<thead>
								<tr>
									<th width="5%">Sr.</th>
									<th width="15%">Note Name</th>
									<th width="20%">Pending ScreenShot</th>
									<th width="25%">Audio Message</th>
									<th width="25%">Any Note</th>
									<th width="10%">Entry By</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$sr=1;
							$query = "SELECT * FROM austria_program_report_note".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_program_id='".$programID."' ";
							$queryEx = mysqli_query($con,$query);
							if (mysqli_num_rows($queryEx) > 0) {
								while ($row = mysqli_fetch_assoc($queryEx)) {
							?>
								<tr>
									<td><?php echo $sr++;?></td>
									<td><?php echo $row['aus_pro_report_name'];?></td>
									<td class="breakTD">
									<?php 
									$fileMulti = explode(',', $row['aus_pro_report_screenshot']);
									foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
									<?php } ?>
									</td>
									<td class="breakTD">
									<?php
									if($row['aus_pro_report_audio']!=''){
										$fileMulti = explode(',', $row['aus_pro_report_audio']);
										foreach ($fileMulti as $fileName) {
										?>
										<audio controls>
											<source src="../payagreements/<?php echo $fileName; ?>" type="audio/mpeg">
												Your browser does not support the audio element.
											</audio><br>
										<?php } 
										}else{}
										?>
									</td>
									<td class="breakTD"><?php echo $row['aus_pro_report_note'];?> 
									<button type="button" class="btn btn-outline-primary btn-sm float-right" onclick="updProReport(<?php echo $row['aus_pro_report_id'];?>);"><i class="mdi mdi-square-edit-outline"></i></button></td>
									<td><?php echo ucwords($row['entry_by']);?></td>
								</tr>
								<?php } 
							}else {
								?>
								<tr>
									<td colspan="6">No data available in table</td>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>

			<div class="tab-pane show" id="changingProgram">
				<?php 
				$query = "SELECT aus_change_program_note, aus_change_program_name, aus_change_program_screenshot FROM austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_pro_id='".$programID."' ";
				$queryEx = mysqli_query($con,$query);
				$changeRow = mysqli_fetch_assoc($queryEx);
				?>
				<form id="formChangeProgram" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
					<div class="row">
						<div class="form-group col-md-8">
							<label class="form-label">Program Name <span class="text-danger">*</span></label><br>
							<input type="text" name="changeProgramName" class="form-control" autocomplete="off" required="required" value="<?php echo $changeRow['aus_change_program_name'];?>">
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="37">
								<label class="form-label">Upload ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="changeProgramScreenshot[]" id="uploadedFiles37" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
							<?php 
							if($changeRow['aus_change_program_screenshot']!=''){
							$fileMulti = explode(',', $changeRow['aus_change_program_screenshot']);
							foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
							<?php } } ?>
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Changing Note</label>
							<textarea class="form-control" name="changeProgramNote"><?php echo $changeRow['aus_change_program_note'];?></textarea>
						</div>

						<div class="col-md-12">
							<div class="float-right">
								<button class="btn btn-primary" type="button" name="updChangeProgram" onclick="saveDataForm('formChangeProgram', 'updChangeProgram')" id="updChangeProgram"><i class="mdi mdi-upload"></i> Update</button>
							</div> 
						</div>
					</div>
				</form>
			</div>

		</div>
	</fieldset>
<?php
}
// Add note of programs
if (isset($_POST['checkHeadPersonalNote'])) {
	$programID = $_POST['checkHeadPersonalNote'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>	
			<?php 
			$query = "SELECT aus_head_personal_note, aus_head_personal_documents FROM austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_pro_id='".$programID."' ";
			$queryEx = mysqli_query($con,$query);
			$changeRow = mysqli_fetch_assoc($queryEx);
			?>
			<form id="formDataHeadPersonalNote" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
				<div class="row">
					<div class="form-group col-md-6">
						<label class="form-label">Personal Note <span class="text-danger">*</span></label>
						<textarea class="form-control" name="personalHeadNote" required="required"><?php echo $changeRow['aus_head_personal_note'];?></textarea>
					</div>
					<div class="form-group col-md-6">
						<div class="agreement-container" data-agreement-id="31">
							<label class="form-label">Upload Any Document / Audio Message <span class="text-danger">* (Select Multi Files)</span></label>
							<div class="d-flex justify-content-center">
								<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
								<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
							</div>
							<input type="file" name="personalHeadDocument[]" id="uploadedFiles31" class="form-control" multiple style="display: none;">
							<div class="preview"></div>
						</div>
						<?php 
						$sr = 1;
						if($changeRow['aus_head_personal_documents']!=''){
						$fileMulti = explode(',', $changeRow['aus_head_personal_documents']);
						foreach ($fileMulti as $fileName) {
						echo $sr++.'.';?>
						<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
						<?php } } ?>
					</div>
					<div class="col-md-12">
						<div class="float-right">
							<button class="btn btn-primary" type="button" name="updateHeadNote" onclick="updApplicationForm('formDataHeadPersonalNote','updateHeadNote')" id="updateHeadNote"><i class="mdi mdi-upload"></i> Update</button>
						</div> 
					</div>
				</div>
			</form>
	</fieldset>
<?php
}
// Additional Activities Required by the University
if (isset($_POST['additionalNoteActivities'])) {
	$programID = $_POST['additionalNoteActivities'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Additional Activities Note <span class="text-danger">*</span>
		</legend>
		<form id="formDataNoteAct" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Additional Activities <span class="text-danger">*</span></label>
					<textarea class="form-control" name="addActivitiesNote" required="required"></textarea>
				</div>
				<div class="form-group col-md-6">
					<div class="agreement-container" data-agreement-id="32">
						<label class="form-label">Upload Any Document / Audio Message <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="addActivitiesDocument[]" id="uploadedFiles32" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" name="subAdditionalAct" onclick="updApplicationForm('formDataNoteAct','subAdditionalAct')" id="subAdditionalAct"><i class="mdi mdi-upload"></i> Submit</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th width="5%">Sr</th>
						<th width="13%">Status</th>
						<th width="10%">Date</th>
						<th width="37%">Note</th>
						<th width="25%">Files</th>
						<th width="10%">Entry By</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sr=1;
				$query = "SELECT * FROM austria_clients_additional_activities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_add_activity_programs_id='".$programID."' ";
				$queryEx = mysqli_query($con,$query);
				if (mysqli_num_rows($queryEx) > 0) {
					foreach ($queryEx as $row) {
				?>
					<tr>
						<td><?php echo $sr++; ?></td>
						<td><?php echo $row['aus_add_activity_status'];?></td>
						<td><?php echo $row['crt_date'];?></td>
						<td class="breakTD"><?php echo $row['aus_add_activity_note'];?></td>
						<td class="breakTD">
						<?php
						$srNo=1; 
						$fileMulti = explode(',', $row['aus_add_activity_documents']);
						foreach ($fileMulti as $fileName) {
						?>
						<?php echo $srNo; ?>:) <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
						<?php $srNo++;} ?>
						</td>
						<td><?php echo ucwords($row['entry_by']);?></td>
					</tr>
					<?php }
				}else {
					?>
					<tr>
						<td colspan="6">No data available in table</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php
}
// Update note of programs
if (isset($_POST['updProgramNote'])) {
	$updProgramNote = $_POST['updProgramNote'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>	
			<?php 
			$query = "SELECT aus_pro_report_note FROM austria_program_report_note".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_pro_report_id='".$updProgramNote."' ";
			$queryEx = mysqli_query($con,$query);
			$changeRow = mysqli_fetch_assoc($queryEx);
			?>
			<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateProgramID" value="<?php echo $updProgramNote;?>">
				<div class="row">
					<div class="form-group col-md-12">
						<label class="form-label">Update Note</label>
						<textarea class="form-control" name="updateNote"><?php echo $changeRow['aus_pro_report_note'];?></textarea>
					</div>
					<div class="col-md-12">
						<div class="float-right">
							<button class="btn btn-primary" name="updateProgramNote"><i class="mdi mdi-upload"></i> Update</button>
						</div> 
					</div>
				</div>
			</form>
	</fieldset>
<?php
}
// delete inform to client
if (isset($_POST['refundAppDel'])) {
	$programID = $_POST['refundAppDel'];
	$del_query = "UPDATE austria_clients_programs".$_SESSION['dbNo']." SET aus_program_refund_date='0000-00-00', aus_program_refund_files='', aus_program_refund_note='' WHERE aus_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}
// Add note of programs
if (isset($_POST['updHoldApplication'])) {
	$programID = $_POST['updHoldApplication'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Deadline Application <span class="text-danger">*</span>
		</legend>
		<form id="formDeadline" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-4">
					<label class="form-label">Select Hold Status <span class="text-danger">*</span></label>
					<select name="holdStatus" class="form-control" required="required">
						<option selected value disabled class="text-center">--- Select Hold Status ---</option>
						<option value="Deadline Hold">Deadline Hold</option>
						<option value="Deadline Release">Deadline Release</option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Date <span class="text-danger">*</span></label>
					<input type="date" name="holdDate" class="form-control" required="required" value="<?php echo date('Y-m-d');?>">
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="32">
						<label class="form-label">Hold File or Any Voice Message <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="holdFiles[]" id="uploadedFiles32" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Hold Note</label>
					<textarea class="form-control" name="holdNote" rows="3"></textarea>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="updatehold" onclick="saveDataForm('formDeadline', 'updatehold')" id="updatehold"><i class="mdi mdi-upload"></i> Update</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
	<!-- table show -->
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th width="5%">Sr.</th>
						<th width="10%">Date</th>
						<th width="30%">Hold Status</th>
						<th width="30%">Hold Files</th>
						<th width="50%">Hold Note</th>
					</tr>
				</thead>
				<tbody>
					<?php
				$sr=1; 
				$query = "SELECT * FROM austria_client_deadline_hold".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND programs_hold_id='".$programID."' ";
				$queryEx = mysqli_query($con,$query);
				if (mysqli_num_rows($queryEx) > 0) {
					foreach ($queryEx as $row) {
				?>
					<tr>
						<td><?php echo $sr++;?></td>
						<td><?php echo $row['hold_status'];?></td>
						<td><?php echo $row['hold_date'];?></td>
						<td class="breakTD">
						<?php 
						$fileMulti = explode(',', $row['hold_files']);
						foreach ($fileMulti as $fileName) {
						?>
						<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
						<?php } ?>
						</td>
						<td class="breakTD"><?php echo $row['hold_note'];?></td>
					</tr>
					<?php } 
				}else {
					?>
					<tr>
						<td colspan="5">No data available in table</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
<?php
}
?>