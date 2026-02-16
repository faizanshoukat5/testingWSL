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
$select_query="SELECT * FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id='".$programAppliedID."' ";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);
$clientID = $row['italy_clients_id'];
$uniName = $row['italy_university_name'];
$programName = $row['italy_program_name'];
$degreeName = $row['italy_client_degree'];

$cimeaStep1 = $row['italy_cimea_step1'];
$cimeaStep2 = $row['italy_cimea_step2'];
$cimeaUsername = $row['italy_cimea_username'];
$cimeaPassword = $row['italy_cimea_password'];
$cimeaLink = $row['italy_cimea_link'];
$cimeaScreenShot = $row['italy_cimea_screenshot'];

$cimeaStep3 = $row['italy_cimea_step3'];
$cimeaUpUsername = $row['italy_cimeaup_username'];
$cimeaUpPassword = $row['italy_cimeaup_password'];
$cimeaUpLink = $row['italy_cimeaup_link'];
$cimeaUpScreenShot = $row['italy_cimeaup_screenshot'];
$cimeaStep4 = $row['italy_cimea_step4'];

$cimeainformScreenshot = $row['italy_cimea_info_screenshot'];
$cimeainformNote = $row['italy_cimea_info_note'];

$cimeaclientInformScreenshot = $row['italy_cimea_client_info_screenshot'];
$cimeaclientInformNote = $row['italy_cimea_client_info_note'];

$cimeaokScreenshot = $row['italy_cimea_ok_screenshot'];
$cimeaokNote = $row['italy_cimea_ok_note'];

$cimeainfoPayFee = $row['italy_cimea_info_pay_fee'];
$cimeafeePayClient = $row['italy_cimea_fee_paid_client'];
$cimeapayFeeNote = $row['italy_cimea_fee_note'];
$cimeaStep6 = $row['italy_cimea_step6'];

$cimeaappliedScreenshot = $row['italy_cimea_applied_screenshot'];
$cimeadetailsScreenshot = $row['italy_cimea_details_screenshot'];
$cimeaappliedNote = $row['italy_cimea_applied_note'];

$cimeaproofScreenshot = $row['italy_cimea_proof_screenshot'];
$cimeaproofNote = $row['italy_cimea_proof_note'];

$cimeaacceptedScreenshot = $row['italy_cimea_accepted_screenshot'];
$cimearejectedScreenshot = $row['italy_cimea_rejected_screenshot'];

$cimeainfoClientStatus = $row['italy_cimea_info_client_status'];
$cimeaappliedStatus = $row['italy_cimea_applied_status'];

$sopsStatus = $row['italy_sops_status'];


$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
$client_query_ex = mysqli_query($con,$client_query);
$rowCl = mysqli_fetch_assoc($client_query_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

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
							<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="float-right">
					<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
					<?php 
					foreach ($decoded as $key => $programJSONName1) {
						$select_query = "SELECT italy_ad_sop_required from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$clientDegree."' AND italy_ad_program_name='".$programJSONName1."' ";
						$select_query_ex = mysqli_query($con,$select_query);
						$sopRow = mysqli_fetch_assoc($select_query_ex);
						$sopRequiredORNot = $sopRow['italy_ad_sop_required'];
						if ($sopRequiredORNot == '1') {
							break;
						}
					}
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
			</div>
			<div class="col-md-12">
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
								<span id="step1Title" style="<?php if ($cimeaStep1==1){?> color: green; <?php }elseif ($cimeaStep1==2){?>color:red;<?php } ?>"><b> Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep1 == 1) ? 'checked' : '';?> <?php echo ($cimeaStep2==1) ? 'disabled' : '';?> >
									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep1 == 2) ? 'checked' : '';?> <?php echo ($cimeaStep2==1) ? 'disabled' : '';?> >
									<label for="noIDStep1"> No </label>
								</div>
							</h4>
							<p>
								Open the documents folder and log in to Gmail using the login details at serial number 15. <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank"><button class="btn btn-primary btn-sm">Gmail Login</button></a>
							</p>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step2Title" style="<?php if ($cimeaStep2==1){?> color: green; <?php }elseif ($cimeaStep2==2) { ?> color: red;<?php } ?>"><b> Create a one-time account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $cimeaStep2;?>" id="hiddenStep2">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep2 == 1) ? 'checked' : '';?> <?php echo ($cimeaStep3==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0) ? 'disabled' : '';?>>

									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep2 == 2) ? 'checked' : '';?> <?php echo ($cimeaStep3==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0) ? 'disabled' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
							</h4>
							<p>Create the account through the link below: (Direct Pre-Enrollment Portal) <a href="https://mywallet.cimea-diplome.it/#/auth/register" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>

							<form id="formLoginDetails" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUsername;?>" id="cimeaUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="cimeaPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaPassword;?>" id="cimeaPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="cimeaLink" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaLink;?>" id="cimeaLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="cimeaScreenShot[]" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($cimeaScreenShot!=''){
										$fileMulti = explode(',', $cimeaScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subCimeaDetails" onclick="saveDataForm('formLoginDetails', 'subCimeaDetails')" id="subCimeaDetails" <?php echo ($cimeaStep3==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
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
								<span id="step3Title" style="<?php if ($cimeaStep3==1){?> color: green; <?php }elseif ($cimeaStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $cimeaStep3;?>" id="hiddenStep3">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep3 == 1) ? 'checked' : '';?> <?php echo ($cimeaStep4==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0) ? 'disabled' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep3 == 2) ? 'checked' : '';?> <?php echo ($cimeaStep4==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0) ? 'disabled' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							
							<p>The student will receive an email from the CIMEA Portal. Activate the link provided in the email, change the password, and save the updated password in the tab.</p>

							<form id="formLoginUpd" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpUsername;?>" id="cimeaUpUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpPassword;?>" id="cimeaUpPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpLink;?>" id="cimeaUpLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="cimeaUpScreenShot[]" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php
										if($cimeaUpScreenShot!=''){ 
										$fileMulti = explode(',', $cimeaUpScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subUpCimeaDetails" onclick="saveDataForm('formLoginUpd', 'subUpCimeaDetails')" id="subUpCimeaDetails" <?php echo ($cimeaStep4==1) ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0) ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
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
								<span id="step4Title" style="<?php if ($cimeaStep4==1){?> color: green; <?php }elseif ($cimeaStep4==2) { ?> color: red;<?php } ?>"><b>Fill out the Application Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep4" value="1" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep4 == 1) ? 'checked' : '';?> <?php echo ($cimeainformScreenshot!='') ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0 || $cimeaStep3==0) ? 'disabled' : '';?>>
									<label for="yesIDStep4"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep4" value="2" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep4 == 2) ? 'checked' : '';?> <?php echo ($cimeainformScreenshot!='') ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0 || $cimeaStep3==0) ? 'disabled' : '';?>>
									<label for="noIDStep4"> No </label>
								</div>
							</h4>
							
							<p>Fill out the online form (put the personal details according to passport & education details according to documents) and upload the attested documents on the CIMEA portal.</p>
							<div class="row">
								<div class="col-md-4"></div>
								<div class="col-md-4 alert bg-dark">
									<a href="https://mywallet.cimea-diplome.it/#/auth/login" class="text-warning" target="_blank"><b>https://mywallet.cimea-diplome.it/#/auth/login</b></a>
								</div>
							</div>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 05 <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<h4>
								<span style="<?php if ($cimeafeePayClient!=''){?> color: green; <?php }elseif ($cimeafeePayClient=='') { ?> color: red;<?php } ?>"> <b><i class="fontSteps">Step: 05</i> Inform the client to recheck the application (Pay the Cimea fee) </b> </span>
							</h4>
							<h4>Application checking:</h4>
							<ul>
								<li>Please send the CIMEA portal link, username, and password to the client and give instructions for rechecking the CIMEA application.</li>
							</ul>
							<h4>Cimea Fee Payment:</h4>
							<ul>
								<li>
									After rechecking the CIMEA application it's time to pay the CIMEA fee. The <b>normal CIMEA</b> fee is <b>300 euros</b> and <b>400 euros</b> for <b>urgent CIMEA</b>. Please message or call the client to explain the CIMEA fee and the card activation process. When the client pays the CIMEA fee, the CIMEA portal automatically updates the payment status. We will take the fee payment receipt from the client and upload it to our portal.
								</li>
							</ul>
							<br>
							<ul class="nav nav-tabs">
								<?php 
								if ($cimeainformScreenshot=='') {
								?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Inform the client to recheck <br> the Application </span>
									</a>
								</li>
								<?php }elseif ($cimeainformScreenshot!=''){ ?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Inform the client to recheck <br> the Application
										<?php if ($cimeainfoClientStatus=='1' && $cimeaappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Admission Head Inform To Client </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php
								$changingStatus='';
								$client_query = "SELECT changing_status from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='cimea' AND changing_status='team' AND programs_id='".$programAppliedID."' AND entry_by='".$_SESSION['user_id']."' ORDER BY program_italy_id DESC LIMIT 1 ";
								$client_query_ex = mysqli_query($con,$client_query);
								if ($client_query_ex && mysqli_num_rows($client_query_ex) > 0){
									$row = mysqli_fetch_assoc($client_query_ex);
									$changingStatus = $row['changing_status'];
								}
								
								if ($changingStatus=='team' || $cimeaokScreenshot!='') {
								?>
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Client's Request for Changes in <br> the Application  
										<?php if ($cimeainfoClientStatus=='2' && $cimeaappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Required </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">Client's Request for Changes in <br> the Application  
										<?php if ($cimeainfoClientStatus=='2' && $cimeaappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Required </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php 
								if ($cimeaokScreenshot!='') { ?>
								<li class="nav-item">
									<a href="#teamOk" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Application Approved by <br> the Client
										<?php if ($cimeainfoClientStatus=='3' && ($cimeaappliedStatus=='6' || $cimeaappliedStatus=='5')) { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Application Approved </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#teamOk" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">Application Approved by <br> the Client </span>
									</a>
								</li>
								<?php } ?>

								<?php if ($cimeafeePayClient!='') { ?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">The client has paid the application<br> fee. 
										<?php if ($cimeainfoClientStatus=='5' && ($cimeaappliedStatus=='6' || $cimeaappliedStatus=='5')) { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Fee Paid </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">The client has paid the application<br> fee.
										<?php if ($cimeainfoClientStatus=='4' && ($cimeaappliedStatus=='6' || $cimeaappliedStatus=='5')) { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed to Pay Fee </span>
										<?php }?> 
										</span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="uploadScreenshot">
									<?php if ($cimeaclientInformScreenshot!='') { ?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Inform to Client by Admission Head WhatApp ScreenShot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $cimeaclientInformScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $cimeaclientInformNote;?></td>
											</tr>
										</tbody>
									</table>
									<?php } ?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Username / Email</th>
												<th>Updated Password</th>
												<th>Link</th>
												<th>Inform ScreenShot 1</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php echo $cimeaUpUsername;?></td>
												<td class="breakTD"><?php echo $cimeaUpPassword;?></td>
												<td class="breakTD"><?php echo $cimeaUpLink;?></td>
												<td class="breakTD"> <?php 
													$fileMulti = explode(',', $cimeainformScreenshot);
													foreach ($fileMulti as $fileName) {
													?>
													<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
													<?php } ?>
												</td>
												<td class="breakTD"><?php echo $cimeainformNote;?></td>
											</tr>
										</tbody>
									</table>
									<form id="formInformHead" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea name="cimeainformNote" class="form-control"><?php echo $cimeainformNote;?></textarea>
											</div>
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="3">
													<label class="form-label">Inform the Client ScreenShot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="cimeainformScreenshot[]" id="uploadedFiles3" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subCimeainfoHead" onclick="saveDataForm('formInformHead', 'subCimeainfoHead')" id="subCimeainfoHead" <?php echo ($cimeaokScreenshot!='' || $changingStatus=='team') ? 'disabled' : '';?> <?php echo ($cimeaStep1==0 || $cimeaStep2==0 || $cimeaStep3==0 || $cimeaStep4==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Inform to Head </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="changesRequired">
									<div class="row">
										<div class="col-md-12">
											<h4 class="text-purple">Changing Required By Admission Head</h4>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="20%">Changing ScreenShot</th>
														<th width="30%">Changing Audio</th>
														<th width="40%">Changing Note</th>
														<th width="10%">Create Date</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='cimea' AND changing_status='head' AND programs_id='".$programAppliedID."' ";
													$client_query_ex = mysqli_query($con,$client_query);
													foreach ($client_query_ex as $rowCl) {
														$changingScreenshot = $rowCl['changing_screenshot'];
														$changingAudio = $rowCl['changing_audio'];
													?>
													<tr>
														<td class="breakTD">
															<?php 
															$fileMulti = explode(',', $changingScreenshot);
															foreach ($fileMulti as $fileName) {
															?>
															<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php } ?>
														</td>
														<td class="breakTD">
															<?php 
															$fileMulti = explode(',', $changingAudio);
															foreach ($fileMulti as $fileName) {
															?>
															<audio controls>
																<source src="../payagreements/<?php echo $fileName; ?>" type="audio/mpeg">
																Your browser does not support the audio element.
															</audio><br>
															<?php } ?>
														</td>
														<td class="breakTD"><?php echo $rowCl['changing_note'];?></td>
														<td class="breakTD"><?php echo $rowCl['create_date'];?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="col-md-12">
											<h4 class="text-purple">Changing Proceeded By Processing Team</h4>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="30%">Changing ScreenShot</th>
														<th width="60%">Changing Note</th>
														<th width="10%">Create Date</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='cimea' AND changing_status='team' AND programs_id='".$programAppliedID."' ";
													$client_query_ex = mysqli_query($con,$client_query);
													foreach ($client_query_ex as $rowCl) {
														$changingScreenshot = $rowCl['changing_screenshot'];
													?>
													<tr>
														<td class="breakTD">
															<?php 
															$fileMulti = explode(',', $changingScreenshot);
															foreach ($fileMulti as $fileName) {
															?>
															<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php } ?>
														</td>
														<td class="breakTD"><?php echo $rowCl['changing_note'];?></td>
														<td class="breakTD"><?php echo $rowCl['create_date'];?></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<hr width="100%">
										<div class="col-md-12">
											<form id="formChangesComplete" enctype="multipart/form-data" class="parsley-examples">
												<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="form-label">Change Note</label>
														<textarea class="form-control" name="changingNote"></textarea>
													</div>
													<div class="form-group col-md-4">
														<div class="agreement-container" data-agreement-id="4">
															<label class="form-label">Changes Done by Team <span class="text-danger">(Select multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
															</div>
															<input type="file" name="changingScreenshot[]" id="uploadedFiles4" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="float-right">
															<button class="btn btn-custom" type="button" name="subCimeaChangeDetails" onclick="saveDataForm('formChangesComplete', 'subCimeaChangeDetails')" id="subCimeaChangeDetails" <?php echo ($cimeaokScreenshot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Change Complete </button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane " id="teamOk">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Approved Screenshot</th>
														<th>Approved Note</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $cimeaokScreenshot);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $cimeaokNote;?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="feeGuides">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Inform to Pay Fee Whatapp ScreenShot</th>
														<th>Fee Paid By Client ScreenShot</th>
														<th>Fee Note</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $cimeainfoPayFee);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $cimeafeePayClient);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $cimeapayFeeNote;?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
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
							if ($cimeafeePayClient!='') { ?>
								<span id="step6Title" style=" <?php if ($cimeaStep6==1){?> color: green; <?php }elseif ($cimeaStep6==2) { ?> color: red;<?php } ?>"><b>Submit the CIMEA application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 1) ? 'checked' : '';?> <?php echo ($cimeaproofScreenshot!='') ? 'disabled' : '';?>>
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 2) ? 'checked' : '';?> <?php echo ($cimeaproofScreenshot!='') ? 'disabled' : '';?>>
									<label for="noIDStep6"> No </label>
								</div>
							<?php
							}else{
							?>
								<span id="step6Title" style=" <?php if ($cimeaStep6==1){?> color: green; <?php }elseif ($cimeaStep6==2) { ?> color: red;<?php } ?>"><b>Submit the CIMEA application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 1) ? 'checked' : '';?> disabled="">
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 2) ? 'checked' : '';?> disabled="">
									<label for="noIDStep6"> No </label>
								</div>
							<?php } ?>

							</h4>
							<p>When the client rechecks and approves the file, submit the application</p>
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="25%">Applied Screenshot</th>
												<th width="25%">Detail's Screenshot</th>
												<th width="25%">Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $cimeaappliedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $cimeadetailsScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $cimeaappliedNote;?></td>
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
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="cimeaappliedScreenshot[]" id="uploadedFiles5" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="6">
											<label class="form-label">Detail's ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="cimeadetailsScreenshot[]" id="uploadedFiles6" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-4">
										<label class="form-label">Note</label>
										<textarea name="cimeaappliedNote" class="form-control"><?php echo $cimeaappliedNote;?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subCimeaApplied" onclick="saveDataForm('formApplied', 'subCimeaApplied')" id="subCimeaApplied" <?php echo ($cimeaproofScreenshot!='') ? 'disabled' : '';?> <?php echo ($cimeafeePayClient=='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Applied </button>
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
								<span style="<?php if ($cimeaproofScreenshot!=''){?> color: green; <?php }elseif ($cimeaproofScreenshot=='') { ?> color: red;<?php } ?>"><b>Inform the client about the submission application</b>
								<?php if ($cimeainfoClientStatus=='6' && $cimeaappliedStatus=='7') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed about submission CIMEA </span>
								<?php }?>
								</span>
							</h4>
							<p>Inform the client about the submission application with screenshot proof </p>
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
										$fileMulti = explode(',', $cimeaproofScreenshot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } ?></td>
										<td class="breakTD"><?php echo $cimeaproofNote;?></td>
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
							<h4><span style="<?php if ($cimeaacceptedScreenshot!=''){?> color: green; <?php }elseif ($cimearejectedScreenshot!='') { ?> color: red;<?php } ?>"><b>Waiting for a response</b></span></h4>
							<p>waiting for a response client will receive the CIMEA certificate within 1 to 2 months.</p>
							<ul class="nav nav-tabs">
								<?php if ($cimeaproofScreenshot!=''){ ?>
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
								
								<?php if ($cimeaacceptedScreenshot!='') { ?>
								<li class="nav-item">
									<a href="#cimeaacceptedScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Cimea Report Received <?php if ($cimeainfoClientStatus=='8' && $cimeaappliedStatus=='8') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Cimea Report Received </span>
										<?php }?></span>
										
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#cimeaacceptedScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Cimea Report Received </span>
									</a>
								</li>
								<?php } ?>

								<?php if ($cimearejectedScreenshot!='') { ?>
								<li class="nav-item">
									<a href="#cimearejectedScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Cimea Not Approved 
										<?php if ($cimeainfoClientStatus=='9' && $cimeaappliedStatus=='9') {?>
										<span style="top:-20px" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Cimea Not Approved </span>
										<?php }?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#cimearejectedScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Cimea Not Approved </span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="waitingScreenshot">
									<div class="row">
										<div class="form-group col-md-6">
											<?php if ($cimeaproofScreenshot!=''){ ?>
											<label class="form-label">Waiting for Cimea decisions</label>
											<?php }else{ ?>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="cimeaacceptedScreenshot">
									<form id="formAcceptance" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="7">
													<label class="form-label">Upload Acceptance Screenshot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="cimeaacceptedScreenshot[]" id="uploadedFiles7" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($cimeaacceptedScreenshot!=''){
												$fileMulti = explode(',', $cimeaacceptedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } }?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subAccepted" onclick="saveDataForm('formAcceptance', 'subAccepted')" id="subAccepted" <?php echo ($cimeaacceptedScreenshot!='' || $cimearejectedScreenshot=='team') ? 'disabled' : '';?> <?php echo ($cimeaproofScreenshot=='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="cimearejectedScreenshot">
									<form id="formRejected" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="8">
													<label class="form-label">Upload Rejection Screenshot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="cimearejectedScreenshot[]" id="uploadedFiles8" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($cimearejectedScreenshot!=''){
												$fileMulti = explode(',', $cimearejectedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } }?>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subRejected" onclick="saveDataForm('formRejected', 'subRejected')" id="subRejected" <?php echo ($cimeaacceptedScreenshot!='' || $cimearejectedScreenshot=='team') ? 'disabled' : '';?> <?php echo ($cimeaproofScreenshot=='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</fieldset>
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
				$('#showModalClient').on('shown.bs.modal', function () {
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
			url: "models/stepsCimeaTolcState.php",
			data: {
				step1CimeaType: type,
				uniCimeaID: idUni,
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
		var cimeaUsername = $("#cimeaUsername").val();
		var cimeaPassword = $("#cimeaPassword").val();
		var cimeaLink = $("#cimeaLink").val();
		var yesIDStep2 = $("#yesIDStep2").val();
		var hiddenStep2 = $("#hiddenStep2").val();
		if (cimeaUsername=='' && cimeaPassword=='' && cimeaLink=='') {
			$("#cimeaUsername").css("border-color", "red");
			$("#cimeaPassword").css("border-color", "red");
			$("#cimeaLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername!='' && cimeaPassword=='' && cimeaLink=='') {
			$("#cimeaUsername").css("border-color", "");
			$("#cimeaPassword").css("border-color", "red");
			$("#cimeaLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername=='' && cimeaPassword!='' && cimeaLink=='') {
			$("#cimeaUsername").css("border-color", "red");
			$("#cimeaPassword").css("border-color", "");
			$("#cimeaLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername=='' && cimeaPassword=='' && cimeaLink!='') {
			$("#cimeaUsername").css("border-color", "red");
			$("#cimeaPassword").css("border-color", "red");
			$("#cimeaLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername!='' && cimeaPassword!='' && cimeaLink=='') {
			$("#cimeaUsername").css("border-color", "");
			$("#cimeaPassword").css("border-color", "");
			$("#cimeaLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername!='' && cimeaPassword=='' && cimeaLink!='') {
			$("#cimeaUsername").css("border-color", "");
			$("#cimeaPassword").css("border-color", "red");
			$("#cimeaLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername=='' && cimeaPassword!='' && cimeaLink!='') {
			$("#cimeaUsername").css("border-color", "red");
			$("#cimeaPassword").css("border-color", "");
			$("#cimeaLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername!='' && cimeaPassword!='' && cimeaLink!='' && hiddenStep2=='0') {
			$("#cimeaUsername").css("border-color", "");
			$("#cimeaPassword").css("border-color", "");
			$("#cimeaLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (cimeaUsername!='' && cimeaPassword!='' && cimeaLink!='' && hiddenStep2!='0') {
			$("#cimeaUsername").css("border-color", "");
			$("#cimeaPassword").css("border-color", "");
			$("#cimeaLink").css("border-color", "");
			document.getElementById("step2Title").style.color = "green";
		}
		subStep02(idUni, 1, cimeaUsername, cimeaPassword, cimeaLink, hiddenStep2);
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
				url: "models/stepsCimeaTolcState.php",
				data: {
					step2CimeaType: type,
					uniCimeaID: idUni,
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
		var cimeaUpUsername = $("#cimeaUpUsername").val();
		var cimeaUpPassword = $("#cimeaUpPassword").val();
		var cimeaUpLink = $("#cimeaUpLink").val();
		var yesIDStep3 = $("#yesIDStep3").val();
		var hiddenStep3 = $("#hiddenStep3").val();
		if (cimeaUpUsername=='' && cimeaUpPassword=='' && cimeaUpLink=='') {
			$("#cimeaUpUsername").css("border-color", "red");
			$("#cimeaUpPassword").css("border-color", "red");
			$("#cimeaUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername!='' && cimeaUpPassword=='' && cimeaUpLink=='') {
			$("#cimeaUpUsername").css("border-color", "");
			$("#cimeaUpPassword").css("border-color", "red");
			$("#cimeaUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername=='' && cimeaUpPassword!='' && cimeaUpLink=='') {
			$("#cimeaUpUsername").css("border-color", "red");
			$("#cimeaUpPassword").css("border-color", "");
			$("#cimeaUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername=='' && cimeaUpPassword=='' && cimeaUpLink!='') {
			$("#cimeaUpUsername").css("border-color", "red");
			$("#cimeaUpPassword").css("border-color", "red");
			$("#cimeaUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername!='' && cimeaUpPassword!='' && cimeaUpLink=='') {
			$("#cimeaUpUsername").css("border-color", "");
			$("#cimeaUpPassword").css("border-color", "");
			$("#cimeaUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername!='' && cimeaUpPassword=='' && cimeaUpLink!='') {
			$("#cimeaUpUsername").css("border-color", "");
			$("#cimeaUpPassword").css("border-color", "red");
			$("#cimeaUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername=='' && cimeaUpPassword!='' && cimeaUpLink!='') {
			$("#cimeaUpUsername").css("border-color", "red");
			$("#cimeaUpPassword").css("border-color", "");
			$("#cimeaUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername!='' && cimeaUpPassword!='' && cimeaUpLink!='' && hiddenStep3=='0') {
			$("#cimeaUpUsername").css("border-color", "");
			$("#cimeaUpPassword").css("border-color", "");
			$("#cimeaUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (cimeaUpUsername!='' && cimeaUpPassword!='' && cimeaUpLink!='' && hiddenStep3!='0') {
			$("#cimeaUpUsername").css("border-color", "");
			$("#cimeaUpPassword").css("border-color", "");
			$("#cimeaUpLink").css("border-color", "");
			document.getElementById("step3Title").style.color = "green";
		}
		subStep03(idUni, 1, cimeaUpUsername, cimeaUpPassword, cimeaUpLink, hiddenStep3);
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
				url: "models/stepsCimeaTolcState.php",
				data: {
					step3CimeaType: type,
					uniCimeaID: idUni,
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
			url: "models/stepsCimeaTolcState.php",
			data: {
				step4CimeaType: type,
				uniCimeaID: idUni,
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
			url: "models/stepsCimeaTolcState.php",
			data: {
				step6CimeaType: type,
				uniCimeaID: idUni,
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
</script>