<?php 
$programAppliedID = $_GET['program-applied-id'];
?>
<style type="text/css">
	p{margin-bottom: 0.3rem; font-size: 1rem;}
	h4{margin-bottom: 0.3rem;}
	ul li{font-size: 1rem}
	video { width: 100%; }
	.fontSteps{ font-size: 1.5rem; }
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
		color: #ffa91c !important;
		border-bottom: 4px solid #ffa91c;
		border-right: 1px solid #ffa91c;
	}
	.nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.navSuccess.active {
		color: #32c861 !important;
		border-bottom: 4px solid #32c861;
		border-right: 1px solid #32c861;
	}
</style>
<?php 
$select_query="SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programAppliedID."' ";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);
$clientID = $row['italy_clients_id'];
$uniName = $row['italy_university_name'];
$programName = $row['italy_program_name'];
$preProgramName = $row['italy_pre_program_name'];
$degreeName = $row['italy_client_degree'];

$preStep1 = $row['italy_pre_step1'];

$preStep2 = $row['italy_pre_step2'];
$preUsername = $row['italy_pre_username'];
$prePassword = $row['italy_pre_password'];
$preLink = $row['italy_pre_link'];
$preScreenShot = $row['italy_pre_screenshot'];

$preStep3 = $row['italy_pre_step3'];
$preUpUsername = $row['italy_preup_username'];
$preUpPassword = $row['italy_preup_password'];
$preUpLink = $row['italy_preup_link'];
$preUpScreenShot = $row['italy_preup_screenshot'];
$preStep4 = $row['italy_pre_step4'];

$preinformScreenshot = $row['italy_pre_info_screenshot'];
$preinformNote = $row['italy_pre_info_note'];

$preStep6 = $row['italy_pre_step6'];

$preappliedScreenshot = $row['italy_pre_applied_screenshot'];
$preprogramScreenshot = $row['italy_pre_program_screenshot'];
$predetailsScreenshot = $row['italy_pre_details_screenshot'];
$preappliedNote = $row['italy_pre_applied_note'];

$preproofScreenshot = $row['italy_pre_proof_screenshot'];
$preproofNote = $row['italy_pre_proof_note'];

$programNo1Status = $row['italy_pre_program1_status'];
$programNo1Screenshot = $row['italy_pre_program1_screenshot'];
$programNo1Note = $row['italy_pre_program1_note'];
$programNo1Date = $row['italy_pre_program1_date'];

$preinfoClientStatus = $row['italy_pre_info_client_status'];
$preappliedStatus = $row['italy_pre_applied_status'];

$sopsStatus = $row['italy_sops_status'];
$addActivitiesStatus = $row['italy_additional_activities_status'];

$directPre = $row['italy_direct_pre'];
$directApply = $row['italy_direct_apply'];
$dreamApply = $row['italy_dream_id'];


$client_query = "SELECT client_name, client_email, client_whatapp, client_applied, client_self_acceptance_file, client_self_acceptance_file2 from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
$client_query_ex = mysqli_query($con,$client_query);
$rowCl = mysqli_fetch_assoc($client_query_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);
$clientSelf = $rowCl['client_self_acceptance_file'];
$clientSelf2 = $rowCl['client_self_acceptance_file2'];

$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="alert bg-dark text-warning">
							<p>Name: <strong><?php echo ucwords($clientName);?></strong> </p>
						</div>
					</div>
					<div class="col-md-6">
						<div class="alert bg-dark text-warning">
							<p>University: <strong><?php echo ucwords($uniName);?></strong> </p>
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
												$programJSONName = $name;
												$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
											}
											echo ($row['close'] == '0' || $row['italy_change_program_status'] == '1') 
											? "<del>$output</del>$changedProgramName" 
											: ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
										} else {
											echo ($row['close'] == '0' || $row['italy_change_program_status'] == '1') 
											? "<del>" . ucwords($programName) . "</del>$changedProgramName" 
											: ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
										}
									}
									?>
								</span>
							</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="alert bg-dark text-warning">
							<p>Email: <strong><?php echo $clientEmail;?></strong></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="alert bg-dark text-warning">
							<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="alert bg-dark text-warning">
							<p>Degree: <strong><?php echo ucwords($degreeName);?></strong></p>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group col-md-12">
				<div class="float-right">
					<?php
					$statusClass = $addActivitiesStatus == '1' ? 'btn-warning' : ($addActivitiesStatus == '2' ? 'btn-success' : 'btn-outline-primary');
					?>
					<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Additional Activities Required by the University" onclick="additionalActivities(<?php echo $programAppliedID; ?>);"> <i class="mdi mdi-plus"></i> Additional Activities Required by the University</button>
					<button type="button" class="btn <?php echo $personalHeadNote ? 'btn-success' : 'btn-outline-info'; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Admission Head Personal Report" onclick="myHeadPersonalReport(<?php echo $programAppliedID;?>);"><i class="mdi mdi-plus"></i> Head Personal Note</button>
					<button type="button" class="btn <?php echo $personalNote ? 'btn-success' : 'btn-outline-purple'; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Check Processing Team Personal Report" onclick="myPersonalReport(<?php echo $programAppliedID;?>);"><i class="mdi mdi-plus"></i> Team Personal Note</button>

					<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
					<?php 
					$select_query = "SELECT italy_ad_sop_required from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_program_name='".$programJSONName."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					$sopRow = mysqli_fetch_assoc($select_query_ex);
					$sopRequiredORNot = $sopRow['italy_ad_sop_required'];	
					if($sopRequiredORNot=='1'){
					?>
					<?php if($sopsStatus==4){ ?>
						<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="SOP's of this University" onclick="addSOPsProgram(<?php echo $programAppliedID;?>);"><i class="mdi mdi-check-circle"></i> SOP's</button>
					<?php }else{ ?>
						<button type="button" class="btn btn-outline-pink btn-sm" data-toggle="tooltip" data-placement="top" title="SOP's of this University" onclick="addSOPsProgram(<?php echo $programAppliedID;?>);"><i class="mdi mdi-eye"></i> SOP's</button>
					<?php } ?>
					<?php }else{ ?>
					<span data-toggle="tooltip" data-placement="top" title="No SOP's Required for this University" class="badge bg-info pt-2 pb-2">No SOP's Required </span>
					<?php } ?>

				</div>
				<?php if($directPre=='1' && $directApply=='0' && $dreamApply=='0' && ($clientSelf!='' || $clientSelf2!='')){ ?>
					<div class="float-right">
						<button type="button" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Acceptance Letter" onclick="acceptanceLetter(<?php echo $programAppliedID; ?>);"> <i class="mdi mdi-eye"></i> Acceptance Letter</button>
					</div>
				<?php }else{ ?>
				<div class="float-right">
					<button type="button" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Acceptance Letter" onclick="acceptanceLetter(<?php echo $programAppliedID; ?>);"> <i class="mdi mdi-eye"></i> Acceptance Letter</button>
				</div>
				<?php } ?>
				<?php 
				$select_query="SELECT apostille_document from client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
				$queryEx = mysqli_query($con,$select_query);
				$rowAps = mysqli_fetch_assoc($queryEx);
				$apostilleDoc = $rowAps['apostille_document'];

				?>
				<button type="button" class="btn <?= $apostilleDoc ? 'btn-success' : 'btn-outline-dark'; ?> btn-sm float-right mt-1 mr-1" data-toggle="tooltip" data-placement="top" title="Apostille Documents" onclick="docApostille(<?php echo $clientID;?>);"> <i class="mdi mdi-upload"></i> Apostille Doc</button>
			</div>
			<div class="form-group col-md-12">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="" id="reqUniName" value="<?php echo $uniName;?>">
						<input type="hidden" name="" id="reqUniDegree" value="<?php echo $degreeName;?>">
						<button style="font-size: 1rem;" class="btn btn-dark mb-2 text-warning" onclick="requirementsModal();"><b>Click Here to View <?php echo $uniName;?> University's Info & Requirements</b></button>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 01 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step1Title" style="<?php if ($preStep1==1){?> color: green; <?php }elseif ($preStep1==2){?>color:red;<?php } ?>"><b>Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep1 == 1) ? 'checked' : '';?> <?php echo ($preStep2==1) ? 'disabled' : '';?> >
									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep1 == 2) ? 'checked' : '';?> <?php echo ($preStep2==1) ? 'disabled' : '';?> >
									<label for="noIDStep1"> No </label>
								</div>
							</h4>
							<p>
								Open the documents folder and log in to Gmail using the login details at <b>serial number 15</b> <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank"><button class="btn btn-primary btn-sm">Gmail Login</button></a>
							</p>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step2Title" style="<?php if ($preStep2==1){?> color: green; <?php }elseif ($preStep2==2) { ?> color: red;<?php } ?>"><b>Create a one-time account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $preStep2;?>" id="hiddenStep2">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep2 == 1) ? 'checked' : '';?> <?php echo ($preStep3==1) ? 'disabled' : '';?> <?php echo ($preStep1==0) ? 'disabled' : '';?>>

									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep2 == 2) ? 'checked' : '';?> <?php echo ($preStep3==1) ? 'disabled' : '';?> <?php echo ($preStep1==0) ? 'disabled' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
							</h4>
							<p>Create the account through the link below: (Direct Pre-Enrollment Portal) <a href="https://www.universitaly.it/" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>
							<h4 class="text-danger">Note:</h4>
							<ul>
								<li><i>Kindly carefully fill the online UNIVERSITALY REGISTRATION FORM and don’t make any mistake in student name, passport number, date of birth.</i></li>
							</ul>
							<form id="formLoginDetails" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="preUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $preUsername;?>" id="preUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="prePassword" class="form-control" required="required" autocomplete="off" value="<?php echo $prePassword;?>" id="prePassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="preLink" class="form-control" required="required" autocomplete="off" value="<?php echo $preLink;?>" id="preLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="preScreenShot[]" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php
										if($preScreenShot!=''){ 
											$fileMulti = explode(',', $preScreenShot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subpreDetails" onclick="saveDataForm('formLoginDetails', 'subpreDetails')" id="subpreDetails" <?php echo ($preStep3==1) ? 'disabled' : '';?> <?php echo ($preStep1==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 03 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step3Title" style="<?php if ($preStep3==1){?> color: green; <?php }elseif ($preStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $preStep3;?>" id="hiddenStep3">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep3 == 1) ? 'checked' : '';?> <?php echo ($preStep4==1) ? 'disabled' : '';?> <?php echo ($preStep2==0) ? 'disabled' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep3 == 2) ? 'checked' : '';?> <?php echo ($preStep4==1) ? 'disabled' : '';?> <?php echo ($preStep2==0) ? 'disabled' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							<p>The student will receive an email from the university. Activate the link in the email, change the password, and save the updated password in the tab.</p>

							<form id="formLoginUpd" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="preUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $preUpUsername;?>" id="preUpUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="preUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $preUpPassword;?>" id="preUpPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="preUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $preUpLink;?>" id="preUpLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="2">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="preUpScreenShot[]" id="uploadedFiles2" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php
										if($preUpScreenShot){ 
										$fileMulti = explode(',', $preUpScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subUppreDetails" onclick="saveDataForm('formLoginUpd', 'subUppreDetails')" id="subUppreDetails" <?php echo ($preStep4==1) ? 'disabled' : '';?> <?php echo ($preStep2==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 04 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step4Title" style="<?php if ($preStep4==1){?> color: green; <?php }elseif ($preStep4==2) { ?> color: red;<?php } ?>"><b>Fill out the Application Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep4" value="1" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep4 == 1) ? 'checked' : '';?> <?php echo ($preinformScreenshot!='') ? 'disabled' : '';?> <?php echo ($preStep3==0) ? 'disabled' : '';?>>
									<label for="yesIDStep4"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep4" value="2" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep4 == 2) ? 'checked' : '';?> <?php echo ($preinformScreenshot!='') ? 'disabled' : '';?> <?php echo ($preStep3==0) ? 'disabled' : '';?>>
									<label for="noIDStep4"> No </label>
								</div>
							</h4>
							
							<p>Fill out the online form by entering the client's personal details according to their passport and educational documents, and upload the documents to the portal.</p>
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4 alert bg-dark">
									<a href="https://www.universitaly.it/" class="text-warning" target="_blank"><b>https://www.universitaly.it/</b></a>
								</div>
							</div>
							<h4 class="text-danger">Note:</h4>
							<ul>
								<li><i>“Before Applying Kindly Carefully Re-Check the online UNIVERSITALY FORM and Don’t make any mistake in student name, passport number, date of birth and educational Doc+ details”.</i></li>
							</ul>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 05 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span style="<?php if ($preokScreenshot!=''){?> color: green; <?php }elseif ($preokScreenshot=='') { ?> color: red;<?php } ?>"> <b>Inform the client to recheck the application </b> </span>
							</h4>
							<h4>Application checking:</h4>
							<ul>
								<li>Please send the pre-enrollment portal link, username, and password to the client and give instructions for rechecking the pre-enrollment application.</li>
							</ul>
							<h4>Pre Enrollment Fee Payment:</h4>
							<ul>
								<li>
									Pre-Enrollment <b>does not charge an application fee</b>. Send the application PDF to the client and give instructions to recheck the pre-enrollment application. When the client rechecks and approves the file, submit the application.
								</li>
							</ul>
							<br>
							<ul class="nav nav-tabs">
								<?php 
								if ($preinformScreenshot=='') {
								?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Application Rechecked by Client and Submit by Team </span>
									</a>
								</li>
								<?php }elseif ($preinformScreenshot!=''){ ?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Application Rechecked by Client and Submit by Team
										<?php if ($preinfoClientStatus=='1' && $preappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Admission Head Inform To Client </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="uploadScreenshot">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Username / Email</th>
												<th>Updated Password</th>
												<th>Link</th>
												<th>Inform ScreenShot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php echo $preUpUsername;?></td>
												<td class="breakTD"><?php echo $preUpPassword;?></td>
												<td class="breakTD"><?php echo $preUpLink;?></td>
												<td class="breakTD"> <?php 
													$fileMulti = explode(',', $preinformScreenshot);
													foreach ($fileMulti as $fileName) {
													?>
													<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
													<?php } ?>
												</td>
												<td class="breakTD"><?php echo $preinformNote;?></td>
											</tr>
										</tbody>
									</table>
									<form id="formInformHead" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<label class="form-label">Note <span class="text-danger">*</span></label>
												<textarea name="preinformNote" class="form-control" required="required"><?php echo $preinformNote;?></textarea>
											</div>
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="3">
													<label class="form-label">Inform the Client ScreenShot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="preinformScreenshot[]" id="uploadedFiles3" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subpreinfoHead" onclick="saveDataForm('formInformHead', 'subpreinfoHead')" id="subpreinfoHead" <?php echo ($preinformScreenshot!='') ? 'disabled' : '';?> <?php echo ($preStep4==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Inform to Head </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 06 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
							<?php 
							if ($preinformScreenshot!='') { ?>
								<span id="step6Title" style=" <?php if ($preStep6==1){?> color: green; <?php }elseif ($preStep6==2) { ?> color: red;<?php } ?>"><b>Submit the Pre Enrollment application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep6 == 1) ? 'checked' : '';?> <?php echo ($preproofScreenshot!='') ? 'disabled' : '';?>>
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep6 == 2) ? 'checked' : '';?> <?php echo ($preproofScreenshot!='') ? 'disabled' : '';?>>
									<label for="noIDStep6"> No </label>
								</div>
							<?php
							}else{
							?>
								<span id="step6Title" style=" <?php if ($preStep6==1){?> color: green; <?php }elseif ($preStep6==2) { ?> color: red;<?php } ?>"><b>Submit the Pre Enrollment application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep6 == 1) ? 'checked' : '';?> disabled="">
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($preStep6 == 2) ? 'checked' : '';?> disabled="">
									<label for="noIDStep6"> No </label>
								</div>
							<?php } ?>

							</h4>
							<p>When the client rechecks and approves the file, again fill out the application form and submit it.</p>
							<h4 class="text-danger">Note:</h4>
							<ul>
								<li>Use the PDF that was sent to the client</li>
							</ul>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Applied Screenshot</th>
												<th>Program Screenshot</th>
												<th>Detail's Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $preappliedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $preprogramScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $predetailsScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $preappliedNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<form id="formApplied" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="5">
											<label class="form-label">Applied ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" >
											</div>
											<input type="file" name="preappliedScreenshot[]" id="uploadedFiles5" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="6">
											<label class="form-label">Program ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" >
											</div>
											<input type="file" name="preprogramScreenshot[]" id="uploadedFiles6" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="7">
											<label class="form-label">Detail's ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="predetailsScreenshot[]" id="uploadedFiles7" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="form-label">Note <span class="text-danger">*</span></label>
										<textarea name="preappliedNote" class="form-control" required="required"><?php echo $preappliedNote;?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subpreApplied" onclick="saveDataForm('formApplied', 'subpreApplied')" id="subpreApplied" <?php echo ($preproofScreenshot!='') ? 'disabled' : '';?> <?php echo ($preStep6==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Applied </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 07 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4>
								<span style="<?php if ($preproofScreenshot!=''){?> color: green; <?php }elseif ($preproofScreenshot=='') { ?> color: red;<?php } ?>"><b>Inform the client that the pre-enrollment application has been submitted</b>
								<?php if ($preinfoClientStatus=='6' && $preappliedStatus=='7') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed about submission Pre Enrollment </span>
								<?php }?>
								</span>
							</h4>
							<p>Inform the client that the pre-enrollment application has been submitted, and send the submission screenshot to the client.</p>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Proof Screenshot</th>
										<th>Proof Note</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="breakTD"><?php 
										$fileMulti = explode(',', $preproofScreenshot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } ?></td>
										<td class="breakTD"><?php echo $preproofNote;?></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 08 <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<h4><span style="<?php if ($programNo1Status=='Acceptance'){?> color: green; <?php }elseif ($programNo1Status=='Rejection') { ?> color: red;<?php } ?>"><b>Waiting for a response</b></span></h4>
							<p>Waiting for a response if the application is accepted, then clear after admission dues and go for pre-enrollment.</p>
							<ul class="nav nav-tabs">
								<?php if ($preproofScreenshot!=''){ ?>
								<li class="nav-item">
									<a href="#waitingScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Waiting</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#waitingScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Waiting</span>
									</a>
								</li>
								<?php } ?>
								
								<?php if ($programNo1Status=='Acceptance'){ ?>
								<li class="nav-item">
									<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Admission Decision 
										<?php if ($preinfoClientStatus=='8' && $preappliedStatus=='8') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
										<?php }elseif ($preinfoClientStatus=='9' && $preappliedStatus=='9') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Rejected </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }elseif ($programNo1Status=='Rejection'){ ?>
								<li class="nav-item">
									<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-danger">Admission Decision 
										<?php if ($preinfoClientStatus=='8' && $preappliedStatus=='8') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
										<?php }elseif ($preinfoClientStatus=='9' && $preappliedStatus=='9') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Rejected </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Admission Decision </span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="waitingScreenshot">
									<div class="row">
										<div class="form-group col-md-6">
											<?php if ($preproofScreenshot!=''){ ?>
											<label class="form-label">Waiting for pre decisions</label>
											<?php }else{ ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="admissionDecision">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-bordered">
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
														<td><?php echo $programNo1Status;?></td>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $programNo1Screenshot);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $programNo1Note;?></td>
														<td><?php if($programNo1Date=='0000-00-00'){}else{ echo $programNo1Date; }?></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-12">
											<form id="formPro1" enctype="multipart/form-data" class="parsley-examples">
											<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
												<div class="row">
													<div class="col-md-12">
														<label><b>Program 1</b></label>
													</div>
													<div class="form-group col-md-3">
														<div class="radio radio-success form-check-inline">
															<input type="radio" id="applicationAcceptance" value="Acceptance" name="programNo1Status" required="required">
															<label for="applicationAcceptance"> Acceptance </label>
														</div>
														<div class="radio radio-danger form-check-inline">
															<input type="radio" id="applicationReject" value="Rejection" name="programNo1Status" required="required">
															<label for="applicationReject"> Rejection </label>
														</div>
													</div>
													<div class="form-group col-md-5">
														<div class="agreement-container" data-agreement-id="8">
															<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
															</div>
															<input type="file" name="programNo1Screenshot[]" id="uploadedFiles8" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
													<div class="form-group col-md-4">
														<label class="form-label">Date <span class="text-danger">*</span></label>
														<input type="date" name="programNo1Date" class="form-control" autocomplete="off" required="required" value="<?php echo date('Y-m-d');?>">
													</div>
													<div class="form-group col-md-12">
														<label class="form-label">Program 1 Note <span class="text-danger">*</span></label>
														<textarea class="form-control" name="programNo1Note" required="required"></textarea>
													</div>
													<div class="col-md-12">
														<div class="float-right">
															<button class="btn btn-custom" type="button" name="submitProgram1" onclick="saveDataForm('formPro1', 'submitProgram1')" id="submitProgram1"><i class="mdi mdi-upload"></i> Update </button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</fieldset>
					</div>

					<div class="col-md-6">
						<h3>Pre Enrollment Video Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/PRE-ENROLLMENT PROCESS 1080p.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/PRE-ENROLLMENT PROCESS 1080p.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Requirment info Modal -->
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

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient1" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle1" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient1">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	// Save Apply & Assign Data using AJAX
	function saveDataForm(formID, proBtn) {
		let $form = $("#"+formID);
		let $btn = $("#"+proBtn);
		if ($form.parsley().validate()) {
			// CKEditor ka data update karne ka step
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append(proBtn, 1);
			$.ajax({
				url: "models/_directPreApplyControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					let res = typeof response === "string" ? JSON.parse(response) : response;
					Swal.fire({
						title: res.title,
						text: res.text,
						icon: res.status
					}).then(() => {
						location.reload();
					});
				},
				error: function (xhr, status, error) {
					Swal.fire({
						title: "Error!",
						text: "Something went wrong: " + error,
						icon: "error"
					});
					$btn.prop("disabled", false).text("Submit");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields before submitting.",
				icon: "warning"
			});
		}
	}
</script>
<script type="text/javascript">
	// Add note to Admission head
	function myPersonalReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkPersonalNote='+id,
			success: function(data){
				$(".showModalClient").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Add note to Admission head
	function myHeadPersonalReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkHeadPersonalNote='+id,
			success: function(data){
				$(".showModalClient").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Additional Activities Required by the University
	function additionalActivities(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'additionalNoteActivities='+id,
			success: function(data){
				$(".showModalClient").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>
<script type="text/javascript">
	function requirementsModal() {
		var reqUniName = $("#reqUniName").val();
		var reqUniDegree = $("#reqUniDegree").val();
		$.ajax({
			type: "POST",
			url: "models/requirementInfoState.php",
			data: {
				checkUniName : reqUniName,
				checkUniDegree : reqUniDegree,
			},
			success: function(data){
				$(".showModalTitle").html('Info & Requirement');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}
	// Add SOPS of Program
	function addSOPsProgram(idSop) {
		var idSop = idSop;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'programSOPs='+idSop,
			success: function(data){
				$(".showModalClient").html('Sops Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	};

	// view acceptanceLetter
	function acceptanceLetter(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkAcceptance='+id,
			success: function(data){
				$(".showModalTitle").html('Acceptance Letter');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};


	// Apostille Document upload
	function docApostille(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'apostilleUploadDoc='+id,
			success: function(data){
				$(".showModalTitle1").html('Upload Apostille Document');
				$(".showModalClient1").html(data);
				$("#showModalClient1").modal('show');
				$('#showModalClient1').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	};
</script>

<script type="text/javascript">
	function firstYesStep(idUni) {
		document.getElementById("step1Title").style.color = "green";
		subStep01(idUni, 1);
	}
	function firstNoStep(idUni) {
		document.getElementById("step1Title").style.color = "red";
		subStep01(idUni, 2);
	}

	function subStep01(idUni, type) {
		
		$.ajax({
			type: "POST",
			url: "models/stepsFormState.php",
			data: {
				step1PreType: type,
				uniPreID: idUni,
			},
			success: function (data) {
				Swal.fire(
					'Changing!',
					'Changes have been Done.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
		
	}
	// second step
	function secYesStep(idUni) {
		var preUsername = $("#preUsername").val();
		var prePassword = $("#prePassword").val();
		var preLink = $("#preLink").val();
		var yesIDStep2 = $("#yesIDStep2").val();
		var hiddenStep2 = $("#hiddenStep2").val();
		if (preUsername=='' && prePassword=='' && preLink=='') {
			$("#preUsername").css("border-color", "red");
			$("#prePassword").css("border-color", "red");
			$("#preLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername!='' && prePassword=='' && preLink=='') {
			$("#preUsername").css("border-color", "");
			$("#prePassword").css("border-color", "red");
			$("#preLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername=='' && prePassword!='' && preLink=='') {
			$("#preUsername").css("border-color", "red");
			$("#prePassword").css("border-color", "");
			$("#preLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername=='' && prePassword=='' && preLink!='') {
			$("#preUsername").css("border-color", "red");
			$("#prePassword").css("border-color", "red");
			$("#preLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername!='' && prePassword!='' && preLink=='') {
			$("#preUsername").css("border-color", "");
			$("#prePassword").css("border-color", "");
			$("#preLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername!='' && prePassword=='' && preLink!='') {
			$("#preUsername").css("border-color", "");
			$("#prePassword").css("border-color", "red");
			$("#preLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername=='' && prePassword!='' && preLink!='') {
			$("#preUsername").css("border-color", "red");
			$("#prePassword").css("border-color", "");
			$("#preLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername!='' && prePassword!='' && preLink!='' && hiddenStep2=='0') {
			$("#preUsername").css("border-color", "");
			$("#prePassword").css("border-color", "");
			$("#preLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (preUsername!='' && prePassword!='' && preLink!='' && hiddenStep2!='0') {
			$("#preUsername").css("border-color", "");
			$("#prePassword").css("border-color", "");
			$("#preLink").css("border-color", "");
			document.getElementById("step2Title").style.color = "green";
		}
		subStep02(idUni, 1, preUsername, prePassword, preLink, hiddenStep2);
	}
	function secNoStep(idUni) {
		document.getElementById("step2Title").style.color = "red";
		subStep02(idUni, 2);
	}

	function subStep02(idUni, type, accName, accPass, accLink, hiddenStep2) {
		
		var accName = accName;
		var accPass = accPass;
		var accLink = accLink;
		var hiddenStep2 = hiddenStep2;
		if (accName=='' || accPass=='' || accLink=='') {
			Swal.fire(
				'One Time Account!',
				'Fill UserName / Email, Password, Link.',
				'error'
			)
		}else if (accName!='' && accPass!='' && accLink!='' && hiddenStep2=='0') {
			Swal.fire(
				'Save One Time Account!',
				'First Save Username Password and Link',
				'error'
			)
		}else{
			$.ajax({
				type: "POST",
				url: "models/stepsFormState.php",
				data: {
					step2PreType: type,
					uniPreID: idUni,
				},
				success: function (data) {
					Swal.fire(
						'Changing!',
						'Changes have been Done.',
						'success'
					)
				}
			});
		}
	}
	// third step
	function thirdYesStep(idUni) {
		var preUpUsername = $("#preUpUsername").val();
		var preUpPassword = $("#preUpPassword").val();
		var preUpLink = $("#preUpLink").val();
		var yesIDStep3 = $("#yesIDStep3").val();
		var hiddenStep3 = $("#hiddenStep3").val();
		if (preUpUsername=='' && preUpPassword=='' && preUpLink=='') {
			$("#preUpUsername").css("border-color", "red");
			$("#preUpPassword").css("border-color", "red");
			$("#preUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername!='' && preUpPassword=='' && preUpLink=='') {
			$("#preUpUsername").css("border-color", "");
			$("#preUpPassword").css("border-color", "red");
			$("#preUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername=='' && preUpPassword!='' && preUpLink=='') {
			$("#preUpUsername").css("border-color", "red");
			$("#preUpPassword").css("border-color", "");
			$("#preUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername=='' && preUpPassword=='' && preUpLink!='') {
			$("#preUpUsername").css("border-color", "red");
			$("#preUpPassword").css("border-color", "red");
			$("#preUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername!='' && preUpPassword!='' && preUpLink=='') {
			$("#preUpUsername").css("border-color", "");
			$("#preUpPassword").css("border-color", "");
			$("#preUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername!='' && preUpPassword=='' && preUpLink!='') {
			$("#preUpUsername").css("border-color", "");
			$("#preUpPassword").css("border-color", "red");
			$("#preUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername=='' && preUpPassword!='' && preUpLink!='') {
			$("#preUpUsername").css("border-color", "red");
			$("#preUpPassword").css("border-color", "");
			$("#preUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername!='' && preUpPassword!='' && preUpLink!='' && hiddenStep3=='0') {
			$("#preUpUsername").css("border-color", "");
			$("#preUpPassword").css("border-color", "");
			$("#preUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (preUpUsername!='' && preUpPassword!='' && preUpLink!='' && hiddenStep3!='0') {
			$("#preUpUsername").css("border-color", "");
			$("#preUpPassword").css("border-color", "");
			$("#preUpLink").css("border-color", "");
			document.getElementById("step3Title").style.color = "green";
		}
		subStep03(idUni, 1, preUpUsername, preUpPassword, preUpLink, hiddenStep3);
	}
	function thirdNoStep(idUni) {
		document.getElementById("step3Title").style.color = "red";
		subStep03(idUni, 2);
	}

	function subStep03(idUni, type, accUpName, accUpPass, accUpLink, hiddenStep3) {
		var accUpName = accUpName;
		var accUpPass = accUpPass;
		var accUpLink = accUpLink;
		var hiddenStep3 = hiddenStep3;
		if (accUpName=='' || accUpPass=='' || accUpLink=='') {
			Swal.fire(
				'Updated password!',
				'Fill Updated UserName / Email, Password, Link.',
				'error'
			)
		}else if (accUpName!='' && accUpPass!='' && accUpLink!='' && hiddenStep3=='0') {
			Swal.fire(
				'Save Updated password!',
				'First Save Updated UserName / Email, Password, Link.',
				'error'
			)
			
		}else{
			$.ajax({
				type: "POST",
				url: "models/stepsFormState.php",
				data: {
					step3PreType: type,
					uniPreID: idUni,
				},
				success: function (data) {
					Swal.fire(
						'Changing!',
						'Changes have been Done.',
						'success'
					)
				}
			});
		}
	}
	// 4 step
	function fourYesStep(idUni) {
		document.getElementById("step4Title").style.color = "green";
		subStep04(idUni, 1);
	}
	function fourNoStep(idUni) {
		document.getElementById("step4Title").style.color = "red";
		subStep04(idUni, 2);
	}

	function subStep04(idUni, type) {
		$.ajax({
			type: "POST",
			url: "models/stepsFormState.php",
			data: {
				step4PreType: type,
				uniPreID: idUni,
			},
			success: function (data) {
				Swal.fire(
					'Changing!',
					'Changes have been Done.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	// 6 step
	function sixYesStep(idUni) {
		document.getElementById("step6Title").style.color = "green";
		subStep06(idUni, 1);
	}
	function sixNoStep(idUni) {
		document.getElementById("step6Title").style.color = "red";
		subStep06(idUni, 2);
	}

	function subStep06(idUni, type) {
		$.ajax({
			type: "POST",
			url: "models/stepsFormState.php",
			data: {
				step6PreType: type,
				uniPreID: idUni,
			},
			success: function (data) {
				Swal.fire(
					'Changing!',
					'Changes have been Done.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	}
</script>