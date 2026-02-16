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
					$selectQuery = "SELECT * from italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='".$uniName."' AND italy_degree_name='".$degreeName."' ORDER BY italy_dates_id DESC ";
					$selectQuery_ex = mysqli_query($con,$selectQuery);
					if (mysqli_num_rows($selectQuery_ex) > 0) {
						foreach ($selectQuery_ex as $rowDate) {
					?>
						<tr> 
							<td class="breakTD">
							<?php if($rowDate['italy_date_status']=='1'){?>
								Yes
							<?php }elseif($rowDate['italy_date_status']=='2'){ ?>
								No
							<?php }else{ ?>
							<?php } ?>
							</td>
							<td class="breakTD">
								<b><?php if ($rowDate['italy_opening_date']=='0000-00-00') { }else{
									echo date("d-m-Y", strtotime($rowDate['italy_opening_date']));
								}?></b>
							</td>
							<td class="breakTD">
								<b><?php if ($rowDate['italy_closing_date']=='0000-00-00') { }
								else{
									echo date("d-m-Y", strtotime($rowDate['italy_closing_date'])); 
								}?></b>
							</td>
							<td class="breakTD text-left"><?php echo $rowDate['italy_note'] ?></td>
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
				<table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="25%">CGPA</th>
							<th width="65%">Note</th>
							<th width="10%">Date</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$selectQuery = "SELECT * from italy_university_cgpa WHERE status='1' AND close='1' AND italy_cgpa_uni_name='".$uniName."' AND italy_cgpa_uni_degree='".$degreeName."' ORDER BY italy_cgpa_uni_id DESC ";
						$selectQuery_ex = mysqli_query($con,$selectQuery);
						foreach ($selectQuery_ex as $row) {
					?>
						<tr>
							<td><?php echo $row['italy_uni_cgpa'];?></td>
							<td><?php echo $row['italy_cgpa_uni_note'];?></td>
							<td><?php echo $row['crt_date'];?></td>
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
			$query = "SELECT italy_document_collection_note FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programsclientID."' ";
			$queryEx = mysqli_query($con,$query);
			$docRow = mysqli_fetch_assoc($queryEx);
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Note from Documents Collection for University Process <span class="text-danger">*</span></label> <br>
					<?php if($docRow['italy_document_collection_note']!=''){
						echo $docRow['italy_document_collection_note'];
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
	
	$program_query = "SELECT italy_clients_id, italy_university_name, italy_program_name from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
	$program_query_ex = mysqli_query($con,$program_query);
	$rowCl = mysqli_fetch_assoc($program_query_ex);
	$clientID = $rowCl['italy_clients_id'];
	$uniName = $rowCl['italy_university_name'];
	$programName = $rowCl['italy_program_name'];

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
				<p>Program: <strong><?php echo $programName;?></strong></p>
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
				<form id="formAppNote" enctype="multipart/form-data" class="parsley-examples">
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
								<button class="btn btn-primary" type="button" name="updappNote" onclick="saveDataForm('formAppNote', 'updappNote')" id="updappNote"><i class="mdi mdi-upload"></i> Update</button>
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
							$query = "SELECT * FROM italy_program_report_note".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_program_id='".$programID."' ";
							$queryEx = mysqli_query($con,$query);
							if (mysqli_num_rows($queryEx) > 0) {
								while ($row = mysqli_fetch_assoc($queryEx)) {
							?>
								<tr>
									<td><?php echo $sr++;?></td>
									<td><?php echo $row['italy_pro_report_name'];?></td>
									<td class="breakTD">
									<?php 
									$fileMulti = explode(',', $row['italy_pro_report_screenshot']);
									foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
									<?php } ?>
									</td>
									<td class="breakTD">
									<?php
									if($row['italy_pro_report_audio']!=''){
										$fileMulti = explode(',', $row['italy_pro_report_audio']);
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
									<td class="breakTD"><?php echo $row['italy_pro_report_note'];?> 
									<button type="button" class="btn btn-outline-primary btn-sm float-right" onclick="updProReport(<?php echo $row['italy_pro_report_id'];?>);"><i class="mdi mdi-square-edit-outline"></i></button></td>
									<td><?php echo ucwords($row['entry_by']);?></td>
								</tr>
								<?php } 
							} else {
								?>
								<tr>
									<td colspan="6">No data available in table</td>
								</tr>
							<?php }?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="tab-pane show" id="changingProgram">
				<?php 
				$query = "SELECT italy_change_program_note, italy_change_program_name, italy_change_program_screenshot  FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
				$queryEx = mysqli_query($con,$query);
				$changeRow = mysqli_fetch_assoc($queryEx);
				?>
				<form id="formChangeProgram" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
					<div class="row">
						<div class="form-group col-md-8">
							<label class="form-label">Program Name <span class="text-danger">*</span></label><br>
							<input type="text" name="changeProgramName" class="form-control" autocomplete="off" required="required" value="<?php echo $changeRow['italy_change_program_name'];?>">
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
							if($changeRow['italy_change_program_screenshot']!=''){
							$fileMulti = explode(',', $changeRow['italy_change_program_screenshot']);
							foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
							<?php } } ?>
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Changing Note</label>
							<textarea class="form-control" name="changeProgramNote"><?php echo $changeRow['italy_change_program_note'];?></textarea>
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
if (isset($_POST['checkPersonalNote'])) {
	$programID = $_POST['checkPersonalNote'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>	
			<?php 
			$query = "SELECT italy_program_personal_note FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
			$queryEx = mysqli_query($con,$query);
			$changeRow = mysqli_fetch_assoc($queryEx);
			?>
			<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
				<div class="row">
					<div class="form-group col-md-12">
						<label class="form-label">Personal Note</label>
						<textarea class="form-control" name="personalNote" disabled><?php echo $changeRow['italy_program_personal_note'];?></textarea>
					</div>
				</div>
			</form>
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
		$query = "SELECT italy_head_personal_note, italy_head_personal_documents FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
		$queryEx = mysqli_query($con,$query);
		$changeRow = mysqli_fetch_assoc($queryEx);
		?>
		<form id="formHeadPersonal" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Personal Note <span class="text-danger">*</span></label>
					<textarea class="form-control" name="personalHeadNote" required="required"><?php echo $changeRow['italy_head_personal_note'];?></textarea>
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
					if($changeRow['italy_head_personal_documents']!=''){
					$fileMulti = explode(',', $changeRow['italy_head_personal_documents']);
					foreach ($fileMulti as $fileName) {
					?>
					<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
					<?php } } ?>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="updateHeadNote" onclick="saveDataForm('formHeadPersonal', 'updateHeadNote')" id="updateHeadNote"><i class="mdi mdi-upload"></i> Update</button>
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
		<form id="formAdditionalNote" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Additional Activities <span class="text-danger">*</span></label>
					<textarea id="editor" class="form-control" name="addActivitiesNote" required="required"></textarea>
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
				<script type="text/javascript">
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
					document.getElementById('subAdditionalAct').addEventListener('click', function (event) {
						var editorContent = CKEDITOR.instances.editor.getData().trim();
						if (!editorContent) {
							event.preventDefault();
						}
					});
				</script>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="subAdditionalAct" onclick="saveDataForm('formAdditionalNote', 'subAdditionalAct')" id="subAdditionalAct"><i class="mdi mdi-upload"></i> Submit</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-bordered mt-2">
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
					$query = "SELECT * FROM italy_clients_additional_activities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_add_activity_programs_id='".$programID."' ";
					$queryEx = mysqli_query($con,$query);
					foreach ($queryEx as $row) {
					?>
					<tr>
						<td><?php echo $sr; ?></td>
						<td><?php echo $row['italy_add_activity_status'];?></td>
						<td><?php echo $row['crt_date'];?></td>
						<td class="breakTD"><?php echo $row['italy_add_activity_note'];?></td>
						<td class="breakTD">
						<?php
						$srNo=1; 
						$fileMulti = explode(',', $row['italy_add_activity_documents']);
						foreach ($fileMulti as $fileName) {
						?>
						<?php echo $srNo; ?>:) <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
						<?php $srNo++;} ?>
						</td>
						<td><?php echo ucwords($row['entry_by']);?></td>
					</tr>
					<?php $sr++; } ?>
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
			$query = "SELECT italy_pro_report_note FROM italy_program_report_note".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_pro_report_id='".$updProgramNote."' ";
			$queryEx = mysqli_query($con,$query);
			$changeRow = mysqli_fetch_assoc($queryEx);
			?>
			<form id="formProNote" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateProgramID" value="<?php echo $updProgramNote;?>">
				<div class="row">
					<div class="form-group col-md-12">
						<label class="form-label">Update Note</label>
						<textarea class="form-control" name="updateNote"><?php echo $changeRow['italy_pro_report_note'];?></textarea>
					</div>
					<div class="col-md-12">
						<div class="float-right">
							<button class="btn btn-primary" type="button" name="updateProgramNote" onclick="saveDataForm('formProNote', 'updateProgramNote')" id="updateProgramNote"><i class="mdi mdi-upload"></i> Update</button>
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
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_refund_date='0000-00-00', italy_program_refund_files='', italy_program_refund_note='' WHERE italy_client_pro_id='".$programID."'";
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
		<form id="formHoldApp" enctype="multipart/form-data" class="parsley-examples">
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
					<div class="agreement-container" data-agreement-id="38">
						<label class="form-label">Hold File or Any Voice Message <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="holdFiles[]" id="uploadedFiles38" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Hold Note</label>
					<textarea class="form-control" name="holdNote" rows="3"></textarea>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="updatehold" onclick="saveDataForm('formHoldApp', 'updatehold')" id="updatehold"><i class="mdi mdi-upload"></i> Update</button>
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
				$query = "SELECT * FROM italy_client_deadline_hold".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND programs_hold_id='".$programID."' ";
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
				} else {
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
// Code of Send Pre Enrollment from dream direct 

// delete send to pre enrollment
if (isset($_POST['sendPreDel'])) {
	$programID = $_POST['sendPreDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_direct_pre='0', italy_send_to_pre_proof='', italy_send_to_pre_note='', italy_send_to_pre_date='0000-00-00' WHERE italy_client_pro_id='".$programID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// delete assign pre enrollment
if (isset($_POST['assignPreDel'])) {
	$assignID = $_POST['assignPreDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_pre_assign_to='0', italy_pre_assign_date='0000-00-00', italy_pre_program_name='' WHERE italy_client_pro_id='".$assignID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}
// Diect pre enrollment
if (isset($_POST['assignDirectPreDel'])) {
	$assignID = $_POST['assignDirectPreDel'];
	$del_query = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_program_assign='0', italy_program_assign_date='0000-00-00', italy_pre_program_name='', italy_assign_status='0' WHERE italy_client_pro_id='".$assignID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

if (isset($_POST['preEnrollmentSend'])) {
	$preEnrollmentSend = $_POST['preEnrollmentSend'];

	$query = "SELECT * FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$preEnrollmentSend."' ";
	$queryEx = mysqli_query($con,$query);
	$row = mysqli_fetch_assoc($queryEx);
	$clientID = $row['italy_clients_id'];
	$preProof = $row['italy_send_to_pre_proof'];
	$preNote = $row['italy_send_to_pre_note'];
	$preDate = $row['italy_send_to_pre_date'];
	$oldProgramName = $row['italy_program_name'];
	// $changedProName = $row['italy_change_program_name'];
	$preProgramName = $row['italy_pre_program_name'];

	$preAssignTo = $row['italy_pre_assign_to'];
	$preAssignDate = $row['italy_pre_assign_date'];

	$preDirectAssignTo = $row['italy_program_assign'];
	$preDirectAssignDate = $row['italy_program_assign_date'];

	$preDirectApply = $row['italy_direct_pre'];
	$dreamApply = $row['italy_dream_id'];
	$directApply = $row['italy_direct_apply'];

	$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$client_query_ex = mysqli_query($con,$client_query);
	$rowCl = mysqli_fetch_assoc($client_query_ex);
	$clientName = $rowCl['client_name'];
	$clientEmail = $rowCl['client_email'];
	$clientWhatapp = $rowCl['client_whatapp'];
	$changingApplied = $rowCl['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);
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
		<div class="col-md-12">
			<div class="alert bg-dark text-warning">
				<p>Program:
					<span class="font-weight-bold">
						<?php 
						$changedProgramName = $row['italy_change_program_name'] ? "<br>" . ucwords($row['italy_change_program_name']) : '';
						if (empty($programName)) {
							echo $changedProgramName;
						} else {
							$decoded = json_decode($programName, true);
							if (is_array($decoded)) {
								$output = '';
								foreach ($decoded as $key => $name) {
									$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
								}
								echo $output . $changedProgramName;
							} else {
								echo ucwords($programName) . $changedProgramName;
							}
						}
						?>
					</span>
				</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="35%">Proof</th>
								<th width="40%">Any Note</th>
								<th width="15%">Date</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php if($preProof!=''){ ?>
							<tr>
								<td class="breakTD">
								<?php 
								$fileMulti = explode(',', $preProof);
								foreach ($fileMulti as $fileName) {
								?>
								<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
								<?php } ?>
								</td>
								<td class="breakTD"><?php echo $preNote;?></td>
								<td><?php echo $preDate;?></td>
								<td>
									<button class="btn btn-danger btn-sm" type="button" onclick="del(delSendPre,<?php echo $preEnrollmentSend;?>);"><i class="mdi mdi-trash-can"></i> </button>
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
				<div class="col-md-12">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">
							Pre Enrollment Client Proof <span class="text-danger">*</span>
						</legend>
						<form id="formPreEnroll" enctype="multipart/form-data" class="parsley-examples">
							<input type="hidden" name="updateProgramID" value="<?php echo $preEnrollmentSend;?>">
							<div class="row">
								<div class="form-group col-md-12">
									<div class="agreement-container" data-agreement-id="33">
										<label class="form-label">Send To Pre Enrollment Proof <span class="text-danger">* (Select Multi Files)</span></label>
										<div class="d-flex justify-content-center">
											<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
											<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
										</div>
										<input type="file" name="sendPreProof[]" id="uploadedFiles33" class="form-control" required="required" multiple style="display: none;">
										<div class="preview"></div>
									</div>
								</div>
								<div class="form-group col-md-12">
									<label class="form-label">Note</label>
									<textarea class="form-control" name="sendPreNote"></textarea>
								</div>
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-primary" type="button" name="sendPreEnroll" onclick="saveDataForm('formPreEnroll', 'sendPreEnroll')" id="sendPreEnroll"><i class="mdi mdi-upload"></i> Update</button>
									</div> 
								</div>
							</div>
						</form>
					</fieldset>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="40%">Program Name</th>
								<th width="25%">Assign To</th>
								<th width="25%">Date</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php if($preAssignTo!='0'){ 
								$wt_query = mysqli_query($con, "SELECT fname, lname FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$preAssignTo."' ");
								if ($wtrow = mysqli_fetch_assoc($wt_query)) {
									$wtName = $wtrow['fname']." ".$wtrow['lname'];
								}
							?>
							<tr>
								<td><?php echo $preProgramName;?></td>
								<td><?php echo ucwords($wtName);?></td>
								<td><?php echo $preAssignDate;?></td>
								<td>
									<button class="btn btn-danger btn-sm" type="button" onclick="del(delPreAssign,<?php echo $preEnrollmentSend;?>);"><i class="mdi mdi-trash-can"></i> </button>
								</td>
							</tr>
							<?php } ?>
							<?php if($preDirectAssignTo!='0' && $preDirectApply=='1' && $dreamApply=='0' && $directApply=='0'){ 
								$wt_query = mysqli_query($con, "SELECT fname, lname FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$preDirectAssignTo."' ");
								if ($wtrow = mysqli_fetch_assoc($wt_query)) {
									$wtName = $wtrow['fname']." ".$wtrow['lname'];
								}
							?>
							<tr>
								<td><?php echo $preProgramName;?></td>
								<td><?php echo ucwords($wtName);?></td>
								<td><?php echo $preDirectAssignDate;?></td>
								<td>
									<button class="btn btn-danger btn-sm" type="button" onclick="del(delPreDirectAssign,<?php echo $preEnrollmentSend;?>);"><i class="mdi mdi-trash-can"></i> </button>
								</td>
							</tr>
							<?php }else{ ?>
							<tr>
								<td colspan="4">No data available in table</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<div class="col-md-12">
					<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
						<input type="hidden" name="updateID" value="<?php echo $preEnrollmentSend;?>">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">
								Assign Pre Enrollment <span class="text-danger">*</span>
							</legend>
							<div class="row">
								<?php if($preDirectApply=='1' && $dreamApply=='0' && $directApply=='0'){
									$applyID=1;
								}else{
									$applyID=2;
								}?>
								<input type="hidden" name="directPre" value="<?php echo $applyID;?>">
								<div class="form-group col-md-12">
									<label>Program Name <span class="text-danger">*</span></label>
									<input type="text" name="assignProgramName" class="form-control" required="required" placeholder="Enter Pre Enrollment Program Name">
								</div>
								<div class="form-group col-md-12">
									<label class="form-label">Select Team <span class="text-danger">*</span></label>
									<select class="form-control" data-toggle='select2' name="assignProgramPre" autocomplete="off" required="required">
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
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" type="submit" name="updProPre"><i class="mdi mdi-upload"></i> Update</button>
									</div>
								</div>
							</div>
						</fieldset>
						<script type="text/javascript">$('[data-toggle="select2"]').select2();$(".parsley-examples").parsley();</script>
					</form>
				</div>

			</div>
		</div>

	</div>
	
<?php
}

// Acceptance Letter View
if (isset($_POST['checkAcceptance'])) {
	$programAppliedID = $_POST['checkAcceptance'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Acceptance Letter <span class="text-danger">*</span>
			</legend>
			<?php 
			$select_query="SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programAppliedID."' ";
			$queryEx = mysqli_query($con,$select_query);
			$row = mysqli_fetch_assoc($queryEx);
			$clientID = $row['italy_clients_id'];
			$directApply = $row['italy_direct_apply'];
			$dreamApply = $row['italy_dream_id'];
			$programNo1DirectStatus = $row['italy_direct_program1_status'];
			$programNo1DirectScreenshot = $row['italy_direct_program1_screenshot'];
			$programNo1DirectNote = $row['italy_direct_program1_note'];
			$programNo1DirectDate = $row['italy_direct_program1_date'];

			$programNo2DirectStatus = $row['italy_direct_program2_status'];
			$programNo2DirectScreenshot = $row['italy_direct_program2_screenshot'];
			$programNo2DirectNote = $row['italy_direct_program2_note'];
			$programNo2DirectDate = $row['italy_direct_program2_date'];

			$programNo1DreamStatus = $row['italy_dream_program1_status'];
			$programNo1DreamScreenshot = $row['italy_dream_program1_screenshot'];
			$programNo1DreamNote = $row['italy_dream_program1_note'];
			$programNo1DreamDate = $row['italy_dream_program1_date'];

			$programNo2DreamStatus = $row['italy_dream_program2_status'];
			$programNo2DreamScreenshot = $row['italy_dream_program2_screenshot'];
			$programNo2DreamNote = $row['italy_dream_program2_note'];
			$programNo2DreamDate = $row['italy_dream_program2_date'];
			?>
			<div class="row">
				<?php if($directApply=='1'){ ?>
				<div class="col-md-12">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="10%">Name</th>
								<th width="15%">Status</th>
								<th width="30%">ScreenShot</th>
								<th width="35%">Note</th>
								<th width="10%">Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Program 1</td>
								<td><?php echo $programNo1DirectStatus;?></td>
								<td class="breakTD"><?php
								$sr=1; 
								$fileMulti = explode(',', $programNo1DirectScreenshot);
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++;} ?></td>
								<td class="breakTD"><?php echo $programNo1DirectNote;?></td>
								<td><?php if($programNo1DirectDate=='0000-00-00'){}else{ echo $programNo1DirectDate; }?></td>
							</tr>
							<tr>
								<td>Program 2</td>
								<td><?php echo $programNo2DirectStatus;?></td>
								<td class="breakTD"><?php 
								$fileMulti = explode(',', $programNo2DirectScreenshot);
								$sr=1;
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++; } ?></td>
								<td class="breakTD"><?php echo $programNo2DirectNote;?></td>
								<td><?php if($programNo2DirectDate=='0000-00-00'){}else{ echo $programNo2DirectDate; }?></td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php }if($dreamApply=='1'){ ?>
				<div class="col-md-12">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="10%">Name</th>
								<th width="15%">Status</th>
								<th width="30%">ScreenShot</th>
								<th width="35%">Note</th>
								<th width="10%">Date</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Program 1</td>
								<td><?php echo $programNo1DreamStatus;?></td>
								<td class="breakTD"><?php
								$sr=1; 
								$fileMulti = explode(',', $programNo1DreamScreenshot);
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++;} ?></td>
								<td class="breakTD"><?php echo $programNo1DreamNote;?></td>
								<td><?php if($programNo1DreamDate=='0000-00-00'){}else{ echo $programNo1DreamDate; }?></td>
							</tr>
							<tr>
								<td>Program 2</td>
								<td><?php echo $programNo2DreamStatus;?></td>
								<td class="breakTD"><?php 
								$fileMulti = explode(',', $programNo2DreamScreenshot);
								$sr=1;
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++; } ?></td>
								<td class="breakTD"><?php echo $programNo2DreamNote;?></td>
								<td><?php if($programNo2DreamDate=='0000-00-00'){}else{ echo $programNo2DreamDate; }?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<?php }else{ ?>
					<div class="col-md-12">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="30%">Status</th>
								<th width="40%">ScreenShot</th>
								<th width="30%">Note</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$select_query="SELECT client_self_acceptance_file, client_self_acceptance_note, client_self_acceptance_file2, client_self_acceptance_note2 from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
							$queryEx = mysqli_query($con,$select_query);
							$rowCl = mysqli_fetch_assoc($queryEx);
							$programNo1SelfScreenshot = $rowCl['client_self_acceptance_file'];
							$programNo1SelfNote = $rowCl['client_self_acceptance_note'];
							$programNo1SelfScreenshot2 = $rowCl['client_self_acceptance_file2'];
							$programNo1SelfNote2 = $rowCl['client_self_acceptance_note2'];
							?>
							<tr>
								<td>Self Acceptance</td>
								<td class="breakTD"><?php
								$sr=1; 
								$fileMulti = explode(',', $programNo1SelfScreenshot);
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++;} ?></td>
								<td class="breakTD"><?php echo $programNo1SelfNote;?></td>
							</tr>
							<?php if($programNo1SelfScreenshot2!=''){ ?>
							<tr>
								<td>Self Acceptance 2</td>
								<td class="breakTD"><?php
								$sr=1; 
								$fileMulti = explode(',', $programNo1SelfScreenshot2);
								foreach ($fileMulti as $fileName) {
								?>
								<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php $sr++;} ?></td>
								<td class="breakTD"><?php echo $programNo1SelfNote2;?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<?php } ?>
			</div>
		</fieldset>
	</form>
<?php
}

// Upload apostille document
if (isset($_POST['apostilleUploadDoc'])) {
	$clientID = $_POST['apostilleUploadDoc'];
	?>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th width="15%">Status</th>
						<th width="75%">Documents</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				$select_query="SELECT apostille_document from client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
				$queryEx = mysqli_query($con,$select_query);
				$rowCl = mysqli_fetch_assoc($queryEx);
				$apostilleDoc = $rowCl['apostille_document'];
				?>
					<?php if($apostilleDoc!=''){ ?>
					<tr>
						<td>Apostille Document</td>
						<td class="breakTD">
							<?php
							$sr=1; 
							$fileMulti = explode(',', $apostilleDoc);
							foreach ($fileMulti as $fileName) {
							?>
							<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
							<?php $sr++;} ?>
						</td>
						<td>
							<button class="btn btn-danger btn-sm" type="button" onclick="del(delApos,<?php echo $clientID;?>);"><i class="mdi mdi-trash-can"></i> </button>
						</td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Apostille Document <span class="text-danger">*</span>
		</legend>
		<form id="formApostille" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
			<div class="row">
				<div class="form-group col-md-6">
					<div class="agreement-container" data-agreement-id="40">
						<label class="form-label">Upload Apostille Document <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="apostilleDocument[]" id="uploadedFiles40" class="form-control" required="required" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" name="updApostille" onclick="saveDataForm('formApostille', 'updApostille')" id="updApostille"><i class="mdi mdi-upload"></i> Upload</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
<?php
}

if (isset($_POST['delApoDoc'])) {
	$clientID = $_POST['delApoDoc'];

	$clientApos = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET apostille_document='' WHERE admission_client_id='".$clientID."' ";
	$clientApos_ex = mysqli_query($con, $clientApos);
}

?>