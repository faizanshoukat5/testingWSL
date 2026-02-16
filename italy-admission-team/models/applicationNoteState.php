<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Add note of programs
if (isset($_POST['checkProgramNote'])) {
	$programID = $_POST['checkProgramNote'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Note <span class="text-danger">*</span>
		</legend>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a href="#applicationNote" data-toggle="tab" aria-expanded="true" class="nav-link active">
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
			<div class="tab-pane show active" id="applicationNote">
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
								<label for="yesIDDate"> Application Resolves </label>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="21">
								<label class="form-label">Application Screenshot <span class="text-danger"> (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="appNoteScreenshot[]" id="uploadedFiles21" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="22">
								<label class="form-label">Any Audio Message <span class="text-danger"> (Select Multi Audio)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="appNoteAudio[]" id="uploadedFiles22" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Application Note <span class="text-danger">*</span></label>
							<textarea class="form-control" name="appNoteNote" required="required" rows="5"></textarea>
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
								<tr id="<?php echo $row['italy_pro_report_id'];?>">
									<td><?php echo $sr;?></td>
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
				$query = "SELECT italy_change_program_note, italy_change_program_name, italy_change_program_screenshot FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programID."' ";
				$queryEx = mysqli_query($con,$query);
				$changeRow = mysqli_fetch_assoc($queryEx);
				?>
				<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
					<div class="row">
						<div class="form-group col-md-8">
							<label class="form-label">Program Name <span class="text-danger">*</span></label><br>
							<input type="text" name="changeProgramName" class="form-control" autocomplete="off" required="required" value="<?php echo $changeRow['italy_change_program_name'];?>" readonly="">
						</div>
						<div class="form-group col-md-4">
							<label class="form-label">Upload Screenshot <span class="text-danger"> (Select Multi Files)</span></label>
							<input type="file" name="changeProgramScreenshot[]" class="form-control" autocomplete="off"  multiple="" readonly="readonly" disabled="">
							<?php 
							$fileMulti = explode(',', $changeRow['italy_change_program_screenshot']);
							foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
							<?php } ?>
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Changing Note</label>
							<textarea class="form-control" name="changeProgramNote" rows="5" disabled=""><?php echo $changeRow['italy_change_program_note'];?></textarea>
						</div>
					</div>
				</form>
			</div>
		</div>
	</fieldset>
<?php
}

// Add personal note of programs
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
		<form id="formNoted" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Personal Note</label>
					<textarea class="form-control" name="personalNote" rows="5" required="required"><?php echo $changeRow['italy_program_personal_note'];?></textarea>
				</div>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="upPersonalNote" onclick="saveDataForm('formNoted', 'upPersonalNote')" id="upPersonalNote"><i class="mdi mdi-upload"></i> Update</button>
					</div> 
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
		<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Personal Note <span class="text-danger">*</span></label>
					<textarea class="form-control" name="personalHeadNote" rows="5" required="required" disabled=""><?php echo $changeRow['italy_head_personal_note'];?></textarea>
				</div>
			</div>
			<div class="form-group col-md-12">
				<label class="form-label">Upload Any Document / Audio Message <span class="text-danger">(Select Multi Files)</span></label>
				<input type="file" class="form-control" name="personalHeadDocument[]" multiple="" readonly="readonly" disabled="">
				<?php 
				$fileMulti = explode(',', $changeRow['italy_head_personal_documents']);
				foreach ($fileMulti as $fileName) {
				?>
				<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
				<?php } ?>
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
		<form id="formAddAct" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $programID;?>">
			<div class="row">
				<div class="form-group col-md-8">
					<label class="form-label">Additional Activities <span class="text-danger">*</span></label>
					<textarea id="editor" class="form-control" name="addActivitiesNote" required="required"></textarea>
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="13">
						<label class="form-label">Upload Any Document / Audio Message <span class="text-danger">(Select multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="addActivitiesDocument[]" id="uploadedFiles13" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<script type="text/javascript">
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
					$('.dropify').dropify();
					document.getElementById('subAdditionalAct').addEventListener('click', function (event) {
						var editorContent = CKEDITOR.instances.editor.getData().trim();
						if (!editorContent) {
							event.preventDefault();
						}
					});
				</script>
				<div class="col-md-12">
					<div class="float-right">
						<button class="btn btn-primary" type="button" name="subAdditionalAct" onclick="saveDataForm('formAddAct', 'subAdditionalAct')" id="subAdditionalAct"><i class="mdi mdi-upload"></i> Submit</button>
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
				if (mysqli_num_rows($queryEx) > 0) {
					foreach ($queryEx as $row) {
					?>
					<tr>
						<td><?php echo $sr++; ?></td>
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
		$query = "SELECT italy_pro_report_note FROM italy_program_report_note".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_pro_report_id='".$updProgramNote."' ";
		$queryEx = mysqli_query($con,$query);
		$changeRow = mysqli_fetch_assoc($queryEx);
		?>
		<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateProgramID" value="<?php echo $updProgramNote;?>">
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Update Note</label>
					<textarea class="form-control" name="updateNote" rows="5"><?php echo $changeRow['italy_pro_report_note'];?></textarea>
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
					</tr>
				<?php }else {
					?>
					<tr>
						<td colspan="2">No data available in table</td>
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
		<form id="formApost" enctype="multipart/form-data" class="parsley-examples">
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
						<button class="btn btn-primary" type="button" name="updApostille" onclick="saveDataForm('formApost', 'updApostille')" id="updApostille"><i class="mdi mdi-upload"></i> Upload</button>
					</div> 
				</div>
			</div>
		</form>
	</fieldset>
<?php
}

?>