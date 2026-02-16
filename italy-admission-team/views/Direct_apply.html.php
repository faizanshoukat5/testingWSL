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
$clientDegree = $row['italy_client_degree'];

$directStep1 = $row['italy_direct_step1'];

$directStep2 = $row['italy_direct_step2'];
$directUsername = $row['italy_direct_username'];
$directPassword = $row['italy_direct_password'];
$directLink = $row['italy_direct_link'];
$directScreenShot = $row['italy_direct_screenshot'];

$directStep3 = $row['italy_direct_step3'];
$directUpUsername = $row['italy_directup_username'];
$directUpPassword = $row['italy_directup_password'];
$directUpLink = $row['italy_directup_link'];
$directUpScreenShot = $row['italy_directup_screenshot'];
$directTaxCode = $row['italy_direct_tax_code'];
$directStep4 = $row['italy_direct_step4'];

$directinformScreenshot = $row['italy_direct_info_screenshot'];
$directinformNote = $row['italy_direct_info_note'];

$directclientInformScreenshot = $row['italy_direct_client_info_screenshot'];
$directclientInformNote = $row['italy_direct_client_info_note'];

$directokScreenshot = $row['italy_direct_ok_screenshot'];
$directokNote = $row['italy_direct_ok_note'];

$directinfoPayFee = $row['italy_direct_info_pay_fee'];
$directfeePayClient = $row['italy_direct_fee_paid_client'];
$directpayFeeNote = $row['italy_direct_fee_note'];
$directStep6 = $row['italy_direct_step6'];

$directappliedScreenshot = $row['italy_direct_applied_screenshot'];
$directprogramScreenshot = $row['italy_direct_program_screenshot'];
$directdetailsScreenshot = $row['italy_direct_details_screenshot'];
$directappliedNote = $row['italy_direct_applied_note'];

$directproofScreenshot = $row['italy_direct_proof_screenshot'];
$directproofNote = $row['italy_direct_proof_note'];

$programNo1Status = $row['italy_direct_program1_status'];
$programNo1Screenshot = $row['italy_direct_program1_screenshot'];
$programNo1Note = $row['italy_direct_program1_note'];
$programNo1Date = $row['italy_direct_program1_date'];

$programNo2Status = $row['italy_direct_program2_status'];
$programNo2Screenshot = $row['italy_direct_program2_screenshot'];
$programNo2Note = $row['italy_direct_program2_note'];
$programNo2Date = $row['italy_direct_program2_date'];

$directinfoClientStatus = $row['italy_direct_info_client_status'];
$directappliedStatus = $row['italy_direct_applied_status'];

$sopsStatus = $row['italy_sops_status'];
$addActivitiesStatus = $row['italy_additional_activities_status'];

$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
$client_query_ex = mysqli_query($con,$client_query);
$rowCl = mysqli_fetch_assoc($client_query_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);

$uniAdd = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='".$clientDegree."' AND italy_uni_name='".$uniName."'";
$uniAdd_ex = mysqli_query($con, $uniAdd);
$rowApply = mysqli_fetch_assoc($uniAdd_ex);
$applyLink = $rowApply['italy_uni_apply_link'];
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-6">
						<div class="alert bg-dark text-warning">
							<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
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
									$decoded = json_decode($programName, true);
									$changedProgramName = $row['italy_change_program_name'] ? "<br>" . ucwords($row['italy_change_program_name']) : '';
									if (empty($programName)) {
										echo $changedProgramName;
									} else {
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
							<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
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
			<?php
			if($uniName=='University of Tuscia (TS)' && $programJSONName=='Forestry and Environmental Sciences'){
				$applyLink = "https://www.medfor.eu/webform/application-form-international-master-programme-medfor-mediterranean-forestry-and-natural";
			}
			if($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && $programJSONName=='Biology of Extreme Environments'){
				$applyLink = "https://docs.google.com/forms/d/e/1FAIpQLSf7kR6FATJxMrruz0zi188IWcOHwiOAaoaEGyJvt-pZlkHSGw/viewform?pli=1";
			}
			if($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && $programJSONName=='Precision Livestock Farming'){
				$applyLink = "https://forms.office.com/Pages/ResponsePage.aspx?id=auLPL2K7shttps://www.segrepass1.unina.it/Welcome.do&idchked=true";
			}
			?>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<input type="hidden" name="" id="reqUniName" value="<?php echo $uniName;?>">
						<input type="hidden" name="" id="reqUniDegree" value="<?php echo $clientDegree;?>">
						<button style="font-size: 1rem;" class="btn btn-dark mb-2 text-warning" onclick="requirementsModal();"><b>Click Here to View <?php echo $uniName;?> University's Info & Requirements</b></button>
					</div>
					
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 01 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step1Title" style="<?php if ($directStep1==1){?> color: green; <?php }elseif ($directStep1==2){?>color:red;<?php } ?>"><b>Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep1 == 1) ? 'checked' : '';?> <?php echo ($directStep2==1) ? 'disabled' : '';?> >
									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep1 == 2) ? 'checked' : '';?> <?php echo ($directStep2==1) ? 'disabled' : '';?> >
									<label for="noIDStep1"> No </label>
								</div>
							</h4>
							<p>
								Open the documents folder and log in to Gmail using the login details at <b>serial number 15</b> <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank"><button class="btn btn-primary btn-sm">Gmail Login</button></a>
							</p>
						</fieldset>
					</div>
					<?php if(($uniName=='University of Foggia (FG)') || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' && $programJSONName!='Precision Livestock Farming') )){ ?>

					<?php }else{ ?>

					<?php if($appRow=='master' && (($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') ))){ ?>

					<?php }else{ ?>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step2Title" style="<?php if ($directStep2==1){?> color: green; <?php }elseif ($directStep2==2) { ?> color: red;<?php } ?>"><b> Create a one-time account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $directStep2;?>" id="hiddenStep2">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep2 == 1) ? 'checked' : '';?> <?php echo ($directStep3==1) ? 'disabled' : '';?> <?php echo ($directStep1==0) ? 'disabled' : '';?>>
									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep2 == 2) ? 'checked' : '';?> <?php echo ($directStep3==1) ? 'disabled' : '';?> <?php echo ($directStep1==0) ? 'disabled' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
							</h4>
							<?php if($uniName=='University of Genova (UG)'){ ?>
							<p>Create the account through the link below: (university Direct Apply Portal) <a href="https://unige.it/en/internazionale/procedura-prevalutazione-lauree-magistrali-inglese-solo-studenti-non-eu-residenti-all" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>
							<?php }else{ ?>
							<p>Create the account through the link below: (university Direct Apply Portal) <a href="<?php echo $applyLink;?>" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>
							<?php } ?>

							<form id="formLoginDetails" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<input type="hidden" name="updateClientID" value="<?php echo $clientID;?>">
								<input type="hidden" name="updUniName" value="<?php echo $uniName;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="directUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $directUsername;?>" id="directUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="directPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $directPassword;?>" id="directPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="directLink" class="form-control" required="required" autocomplete="off" value="<?php echo $directLink;?>" id="directLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="directScreenShot[]" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($directScreenShot!=''){
											$fileMulti = explode(',', $directScreenShot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subdirectDetails" onclick="saveDataForm('formLoginDetails', 'subdirectDetails')" id="subdirectDetails" <?php echo ($directStep3==1) ? 'disabled' : '';?> <?php echo ($directStep1==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
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
							<?php 
							if($uniName=='University of Genova (UG)'){
							?>
							<h4>Italian Tax Code of University of Genova (UG)</h4>
							<form id="formTaxCode" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-12">
										<label class="form-label">Italian Tax Code <span class="text-danger">*</span></label>
										<textarea name="directTaxCode" class="form-control" required="required" autocomplete="off" value="<?php echo $directTaxCode;?>"><?php echo $directTaxCode;?></textarea>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="upTaxCode" onclick="saveDataForm('formTaxCode', 'upTaxCode')" id="upTaxCode" <?php echo ($directStep4==1) ? 'disabled' : '';?> <?php echo ($directStep2==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
							<?php } ?>
							<h4>
								<span id="step3Title" style="<?php if ($directStep3==1){?> color: green; <?php }elseif ($directStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $directStep3;?>" id="hiddenStep3">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep3 == 1) ? 'checked' : '';?> <?php echo ($directStep4==1) ? 'disabled' : '';?> <?php echo ($directStep2==0) ? 'disabled' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep3 == 2) ? 'checked' : '';?> <?php echo ($directStep4==1) ? 'disabled' : '';?> <?php echo ($directStep2==0) ? 'disabled' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							<p>The student will receive an email from the university. Activate the link in the email, change the password, and save the updated password in the tab.</p>

							<form id="formLoginUpd" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<input type="hidden" name="updateClientID" value="<?php echo $clientID;?>">
								<input type="hidden" name="updUniName" value="<?php echo $uniName;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="directUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $directUpUsername;?>" id="directUpUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="directUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $directUpPassword;?>" id="directUpPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="directUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $directUpLink;?>" id="directUpLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="2">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="directUpScreenShot[]" id="uploadedFiles2" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($directUpScreenShot!=''){
										$fileMulti = explode(',', $directUpScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subUpdirectDetails" onclick="saveDataForm('formLoginUpd', 'subUpdirectDetails')" id="subUpdirectDetails" <?php echo ($directStep4==1) ? 'disabled' : '';?> <?php echo ($directStep2==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<?php } ?>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: <?= ($appRow=='master' && ( ($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') )) ) ? '02' : '04';?> <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step4Title" style=" <?php if ($directStep4==1){?> color: green; <?php }elseif ($directStep4==2) { ?> color: red;<?php } ?>"><b> Fill out the Application Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep4" value="1" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep4 == 1) ? 'checked' : '';?> <?php echo ($directinformScreenshot!='') ? 'disabled' : '';?> >
									<label for="yesIDStep4"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep4" value="2" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep4 == 2) ? 'checked' : '';?> <?php echo ($directinformScreenshot!='') ? 'disabled' : '';?> >
									<label for="noIDStep4"> No </label>
								</div>
							</h4>
							
							<p>Fill out the online form by entering the client's personal details according to their passport and educational documents, and upload the documents to the portal.</p>
							<div class="row">
								<div class="col-md-2"> </div>
								<div class="col-md-8 alert bg-dark">
									<a href="<?php echo $applyLink;?>" class="text-warning" target="_blank"><b><?php echo $applyLink;?></b></a>
								</div>
							</div>
						</fieldset>
					</div>
				<?php } ?>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: <?= ($appRow=='master' && ($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') )) ? '03' : (($uniName=='University of Foggia (FG)' || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' || $programJSONName!='Precision Livestock Farming') )) ? '02' : '05'); ?> <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<?php 
							$uniArray = [
								"Sapienza University of Rome (SPU)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"University of Bologna (UBN)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"Universita Politecnica Delle Marche (MR)" => [
									"degrees" => ["bachelor", "master", "mbbs"] 
								],
								"University of Marche (MR)" => [
									"degrees" => ["bachelor", "master", "mbbs"] 
								],
								"University of Marche (MR)" => [
									"degrees" => ["bachelor", "master", "mbbs"] 
								],
								"University of Pisa (UP)" => [
									"degrees" => ["master"] 
								],
								"University of Trento (TRN)" => [
									"degrees" => ["master"] 
								],
								"University of Messina (UM)" => [
									"degrees" => ["bachelor", "master", "mbbs"] 
								],
								"University of Cassino (CS)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"Unicamillus University of Health Care Romee (UHCR)" => [
									"degrees" => ["bachelor"] 
								],
								"University of Camerino (UC)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"University of Camerino (CM)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"Tor Vergata University of Rome (TVR)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Tor Vergata (TVR)" => [
									"degrees" => ["bachelor", "master"]
								],
								"Bozen-Bolzano (BZB)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Milan (UML)" => [
									"degrees" => ["bachelor", "master"]
								],
							];
							if (isset($uniArray[$uniName]) && in_array($appRow, $uniArray[$uniName]['degrees'])) { 
								$color = $directfeePayClient != '' ? 'green' : 'red';
							}else{
								$color = $directokScreenshot != '' ? 'green' : 'red';
							} ?>
							<?php if($uniName=='University of Foggia (FG)'){ ?>
								<h4>
									<span style="color: <?= $color; ?>"> <b>Share the documents with the university for Evaluation </b> </span>
								</h4>
								<p>We need to share the documents with the university professor for evaluation. The professor will review them and inform me of the results. If the evaluation is successful, I will proceed with the pre-enrollment process.</p>
								<p>Email ID: <span class="text-purple"><b>rita.polito@unifg.it</b></span></p>
								<h4><span class="text-danger">Note:</span></h4>
								<ul>
									<li><i>Please carefully complete Attach all the documents <b>(Education Doc + Passport + English Proficiency Letter + Recommendation Letters + CV)</b></i></li>
								</ul>
							<?php }if($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' || $programJSONName!='Precision Livestock Farming')){ ?>
								
							<?php }else{ ?>
								<h4>
									<span style="color: <?= $color; ?>"> <b>Inform the client to recheck the application <?= isset($uniArray[$uniName]) ? "(pay the application fee)" : "" ?></b> </span>
								</h4>

								<h4>Application checking:</h4>
								<ul>
									<li>Please send the Direct Apply portal link, username, and password to the client and give instructions for rechecking the admission application.</li>
								</ul>

								<?php 
								$uniArray = [
									"Sapienza University of Rome (SPU)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 20, 
									],
									"Universita Politecnica Delle Marche (MR)" => [
										"degrees" => ["bachelor", "master", "mbbs"],
										"fee" => 10,  
									],
									"University of Marche (MR)" => [
										"degrees" => ["bachelor", "master", "mbbs"],
										"fee" => 10,  
									],
									"University of Marche (MR)" => [
										"degrees" => ["bachelor", "master", "mbbs"],
										"fee" => 10,  
									],
									"University of Bologna (UBN)" => [
										"degrees" => ["bachelor"],
										"fee" => 20,  
									],
									"University of Pisa (UP)" => [
										"degrees" => ["master"],
										"fee" => 10,
									],
									"University of Trento (TRN)" => [
										"degrees" => ["master"],
										"fee" => 30,
									],
									"University of Messina (UM)" => [
										"degrees" => ["bachelor", "master", "mbbs"],
										"fee" => 15,  
									],
									"University of Cassino (CS)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 15,  
									],
									"University of Camerino (UC)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 20, 
									],
									"University of Camerino (CM)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 20, 
									],
									"Unicamillus University of Health Care Romee (UHCR)" => [
										"degrees" => ["bachelor"],
										"fee" => 50, 
									],
									"Tor Vergata University of Rome (TVR)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 30, 
									],
									"University of Tor Vergata (TVR)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 30, 
									],
									"Bozen-Bolzano (BZB)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 50, 
									],
									"University of Milan (UML)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 30, 
									],
									"University of Genova (UG)" => [
										"degrees" => ["bachelor", "master"],
										"fee" => 30, 
									],
								];
								if (isset($uniArray[$uniName]) && in_array($appRow, $uniArray[$uniName]["degrees"])) {
									$fee = $uniArray[$uniName]["fee"];
									?>
									<h4>Application Fee Payment:</h4>
									<ul>
										<li>
											After rechecking the admission application.it's time to pay the application fee. The university charges a <b><?php echo $fee;?>-euro application fee</b>. Please message or call the client to explain the application fee and the card activation process. When the client pays the application fee to the university, the university automatically updates the payment status. We will take the fee payment receipt from the client and upload it to our portal.
										</li>
									</ul>
								<?php } else { ?>
									<h4>Application Fee Payment:</h4>
									<ul>
										<li>This university <b>does not charge an application fee</b>. Send the application PDF to the client and give instructions to recheck the admission application. When the client rechecks and approves the file, submit the application.</li>
									</ul>
								<?php } ?>

							<?php } ?>
							
							

							<ul class="nav nav-tabs">
								<?php 
								if ($directinformScreenshot=='') {
								?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Inform the client to recheck <br> the Application </span>
									</a>
								</li>
								<?php }elseif ($directinformScreenshot!=''){ ?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Inform the client to recheck <br> the Application
										<?php if ($directinfoClientStatus=='1' && $directappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Admission Head Inform To Client </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php
								$changingStatus='';
								$client_query = "SELECT changing_status from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='direct' AND changing_status='team' AND programs_id='".$programAppliedID."' AND entry_by='".$_SESSION['user_id']."' ORDER BY program_italy_id DESC LIMIT 1 ";
								$client_query_ex = mysqli_query($con,$client_query);
								if ($client_query_ex && mysqli_num_rows($client_query_ex) > 0){
									$row = mysqli_fetch_assoc($client_query_ex);
									$changingStatus = $row['changing_status'];
								}
								
								if ($changingStatus=='team' || $directokScreenshot!='') {
								?>
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Client's Request for Changes in <br> the Application  
										<?php if ($directinfoClientStatus=='2' && $directappliedStatus=='5') { ?>
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
										<?php if ($directinfoClientStatus=='2' && $directappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Required </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>
								<?php 
								if ($directokScreenshot!='') { ?>
								<li class="nav-item">
									<a href="#teamOk" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Application Approved by <br> the Client
										<?php if ($directinfoClientStatus=='3' && ($directappliedStatus=='6' || $directappliedStatus=='5')) { ?>
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

								<?php 
								if (
									($uniName=="Sapienza University of Rome (SPU)" && ($appRow=="bachelor" || $appRow=="master")) 
									|| ($uniName=="University of Bologna (UBN)" && $appRow=="master" && (strpos($programName, "Economics And Management") !== false || strpos($programName, "Financial Markets And Institutions") !== false)) 
									|| ($uniName=="University of Bologna (UBN)" && $appRow=="bachelor") 
									|| (($uniName=="Universita Politecnica Delle Marche (MR)" || $uniName=="University of Marche (MR)") && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) 
									|| ($uniName=="University of Pisa (UP)" && ($appRow=="master")) 
									|| (($uniName=="University of Trento (TRN)" || $uniName=="University of Laquila (LAQ)") && ($appRow=="master")) 
									|| (($uniName=="University of Messina (UM)" || $uniName=='University of Cassino (CS)') && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) 
									|| ($uniName=="Unicamillus University of Health Care Romee (UHCR)" && ($appRow=="bachelor"))
									|| (($uniName=="University of Camerino (UC)" || $uniName=="University of Camerino (CM)" || $uniName=="Tor Vergata University of Rome (TVR)" || $uniName=="University of Tor Vergata (TVR)" || $uniName=="Bozen-Bolzano (BZB)" || $uniName=="University of Milan (UML)" || $uniName=="University of Genova (UG)") && ($appRow=="bachelor" || $appRow=="master"))
									){
								?>
								<?php if ($directfeePayClient!='') { ?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">The client has paid the application<br> fee. 
										<?php if ($directinfoClientStatus=='5' && ($directappliedStatus=='6' || $directappliedStatus=='5')) { ?>
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
										<?php if ($directinfoClientStatus=='4' && ($directappliedStatus=='6' || $directappliedStatus=='5')) { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed to Pay Fee </span>
										<?php }?> 
										</span>
									</a>
								</li>
								<?php } ?>

								<?php }else{ ?> 

								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="uploadScreenshot">
									<?php if ($directclientInformScreenshot!='') { ?>
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
												$fileMulti = explode(',', $directclientInformScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $directclientInformNote;?></td>
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
												<th>Inform ScreenShot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php echo $directUpUsername;?></td>
												<td class="breakTD"><?php echo $directUpPassword;?></td>
												<td class="breakTD"><?php echo $directUpLink;?></td>
												<td class="breakTD"> <?php 
													$fileMulti = explode(',', $directinformScreenshot);
													foreach ($fileMulti as $fileName) {
													?>
													<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
													<?php } ?>
												</td>
												<td class="breakTD"><?php echo $directinformNote;?></td>
											</tr>
										</tbody>
									</table>
									<form id="formInfomHead" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<label class="form-label">Note <span class="text-danger">*</span></label>
												<textarea name="directinformNote" class="form-control" required="required"><?php echo $directinformNote;?></textarea>
											</div>
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="3">
													<label class="form-label">Inform to Client ScreenShot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="directinformScreenshot[]" id="uploadedFiles3" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subdirectinfoHead" onclick="saveDataForm('formInfomHead', 'subdirectinfoHead')" id="subdirectinfoHead" <?php echo ($directokScreenshot!='' || $changingStatus=='team') ? 'disabled' : '';?> <?php if($uniName=='University of Foggia (FG)' || $uniName=='University of Napoli Fedrico II (UNP)'){echo ($directStep1==0) ? 'disabled' : '';}else{echo ($directStep4==0) ? 'disabled' : '';}?> ><i class="mdi mdi-upload"></i> Inform to Head </button>
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
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='direct' AND changing_status='head' AND programs_id='".$programAppliedID."' ";
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
											<h4 class="text-pink">Changing Proceeded By Processing Team</h4>
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
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='direct' AND changing_status='team' AND programs_id='".$programAppliedID."' ";
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
														<label class="form-label">Change Note <span class="text-danger">*</span></label>
														<textarea class="form-control" name="changingNote" required="required"></textarea>
													</div>
													<div class="form-group col-md-4">
														<div class="agreement-container" data-agreement-id="4">
															<label class="form-label">Changes Done by Team <span class="text-danger">* (Select Multi Files)</span></label>
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
															<button class="btn btn-custom" type="button" name="subdirectChangeDetails" onclick="saveDataForm('formChangesComplete', 'subdirectChangeDetails')" id="subdirectChangeDetails" <?php echo ($directokScreenshot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Change Complete </button>
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
														$fileMulti = explode(',', $directokScreenshot);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $directokNote;?></td>
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
														$fileMulti = explode(',', $directinfoPayFee);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $directfeePayClient);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $directpayFeeNote;?></td>
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
								Step: <?= ($appRow=='master' && ($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') )) ? '04' : (($uniName=='University of Foggia (FG)' || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' || $programJSONName!='Precision Livestock Farming') )) ? '03' : '06'); ?> <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
							<?php 
							if (
								($uniName=="Sapienza University of Rome (SPU)" && ($appRow=="bachelor" || $appRow=="master")) || 
								(($uniName=="Universita Politecnica Delle Marche (MR)" || $uniName=="University of Marche (MR)") && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) || 
								($uniName=="University of Pisa (UP)" && ($appRow=="bachelor" || $appRow=="master")) ||
								($uniName=="University of Bologna (UBN)" && ($appRow=="bachelor" || $appRow=="master")) || 
								($uniName=="University of Trento (TRN)" && ($appRow=="master")) || 
								($uniName=="University of Laquia (LAQ01)" && ($appRow=="master")) ||
								($uniName=="University of Laquila (LAQ)" && ($appRow=="master")) ||
								($uniName=="University of Messina (UM)" && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) ||
								($uniName=="University of Cassino (CS)" && ($appRow=="bachelor" || $appRow=="master")) ||
								((($uniName=="University of Camerino (UC)" || $uniName=="University of Camerino (CM)")) && ($appRow=="bachelor" || $appRow=="master"))||
								(($uniName=="Tor Vergata University of Rome (TVR)" || $uniName=="University of Tor Vergata (TVR)") && ($appRow=="bachelor" || $appRow=="master")) ||
								($uniName=="Bozen-Bolzano (BZB)" && ($appRow=="bachelor" || $appRow=="master")) ||
								(($uniName=="University of Milan (UML)" || $uniName=="University of Genova (UG)" || $uniName=="University of Tuscia (TS)") && ($appRow=="bachelor" || $appRow=="master")) ||
								($uniName=="Unicamillus University of Health Care Romee (UHCR)" && ($appRow=="bachelor"))
							){

								if (($directappliedStatus=='5' || $directappliedStatus=='6') && $directinfoClientStatus=='5') { ?>
									<span id="step6Title" style=" <?php if ($directStep6==1){?> color: green; <?php }elseif ($directStep6==2) { ?> color: red;<?php } ?>"><b> Submit the admission  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div class="radio radio-success form-check-inline">
										<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 1) ? 'checked' : '';?><?php echo ($directproofScreenshot!='') ? 'disabled' : '';?>>
										<label for="yesIDStep6"> Yes </label>
									</div>
									<div class="radio radio-danger form-check-inline">
										<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 2) ? 'checked' : '';?> <?php echo ($directproofScreenshot!='') ? 'disabled' : '';?>>
										<label for="noIDStep6"> No </label>
									</div>
								<?php
								}else{
								?>
									<span id="step6Title" style=" <?php if ($directStep6==1){?> color: green; <?php }elseif ($directStep6==2) { ?> color: red;<?php } ?>"><b> Submit the admission  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div class="radio radio-success form-check-inline">
										<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 1) ? 'checked' : '';?> disabled="">
										<label for="yesIDStep6"> Yes </label>
									</div>
									<div class="radio radio-danger form-check-inline">
										<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 2) ? 'checked' : '';?> disabled="">
										<label for="noIDStep6"> No </label>
									</div>
								<?php 
								}
							}else{
								if (($directappliedStatus=='5' || $directappliedStatus=='6') && $directinfoClientStatus=='3') { ?>
									<span id="step6Title" style=" <?php if ($directStep6==1){?> color: green; <?php }elseif ($directStep6==2) { ?> color: red;<?php } ?>"><b> Submit the admission  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div class="radio radio-success form-check-inline">
										<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 1) ? 'checked' : '';?><?php echo ($directproofScreenshot!='') ? 'disabled' : '';?>>
										<label for="yesIDStep6"> Yes </label>
									</div>
									<div class="radio radio-danger form-check-inline">
										<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 2) ? 'checked' : '';?> <?php echo ($directproofScreenshot!='') ? 'disabled' : '';?>>
										<label for="noIDStep6"> No </label>
									</div>
								<?php
								}else{
								?>
									<span id="step6Title" style=" <?php if ($directStep6==1){?> color: green; <?php }elseif ($directStep6==2) { ?> color: red;<?php } ?>"><b> Submit the admission  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div class="radio radio-success form-check-inline">
										<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 1) ? 'checked' : '';?> disabled="">
										<label for="yesIDStep6"> Yes </label>
									</div>
									<div class="radio radio-danger form-check-inline">
										<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($directStep6 == 2) ? 'checked' : '';?> disabled="">
										<label for="noIDStep6"> No </label>
									</div>
								<?php 
								}
							} 
							?>
							</h4>
							
							<p>When the client rechecks and approves the file, submit the application</p>
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
												$fileMulti = explode(',', $directappliedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $directprogramScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $directdetailsScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $directappliedNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<form id="formApplied" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="col-md-4">
										<div class="agreement-container" data-agreement-id="5">
											<label class="form-label">Applied ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="directappliedScreenshot[]" id="uploadedFiles5" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="agreement-container" data-agreement-id="6">
											<label class="form-label">Program ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="directprogramScreenshot[]" id="uploadedFiles6" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="agreement-container" data-agreement-id="7">
											<label class="form-label">Detail's ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="directdetailsScreenshot[]" id="uploadedFiles7" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-12">
										<label class="form-label">Note <span class="text-danger">*</span></label>
										<textarea name="directappliedNote" class="form-control" required="required"><?php echo $directappliedNote;?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subdirectApplied" onclick="saveDataForm('formApplied', 'subdirectApplied')" id="subdirectApplied" <?php echo ($directproofScreenshot!='') ? 'disabled' : '';?> <?php echo ($directStep6==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Applied </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: <?= ($appRow=='master' && ($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') )) ? '05' : (($uniName=='University of Foggia (FG)' || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' || $programJSONName!='Precision Livestock Farming') )) ? '04' : '07'); ?> <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4>
								<span style="<?php if ($directproofScreenshot!=''){?> color: green; <?php }elseif ($directproofScreenshot=='') { ?> color: red;<?php } ?>"><b> Inform the client about the submission application</b>
								<?php if ($directinfoClientStatus=='6' && $directappliedStatus=='7') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed about submission Application </span>
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
										$fileMulti = explode(',', $directproofScreenshot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } ?></td>
										<td class="breakTD"><?php echo $directproofNote;?></td>
									</tr>
								</tbody>
							</table>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: <?= ($appRow=='master' && ($uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)') || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName=='Biology of Extreme Environments' || $programJSONName=='Precision Livestock Farming') )) ? '06' : (($uniName=='University of Foggia (FG)' || ($uniName=='University of Napoli Fedrico II (UNP)' && $appRow=='master' && ($programJSONName!='Biology of Extreme Environments' || $programJSONName!='Precision Livestock Farming') )) ? '05' : '08'); ?> <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4><span style="<?php if ($directacceptedScreenshot!=''){?> color: green; <?php }elseif ($directrejectedScreenshot!='') { ?> color: red;<?php } ?>"><b>Waiting for a response</b></span></h4>
							<p>waiting for a response client will receive the direct certificate within 1 to 2 months.</p>
							<ul class="nav nav-tabs">
								<?php if ($directproofScreenshot!=''){ ?>
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
								
								<?php if ($programNo1Status=='Acceptance' && $programNo2Status=='Acceptance'){ ?>
								<li class="nav-item">
									<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Admission Decision 
										<?php if ($infoClientStatus=='8' && $appliedStatus=='8') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
										<?php }elseif ($infoClientStatus=='9' && $appliedStatus=='9') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Rejected </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }elseif ($programNo1Status=='Rejection' && $programNo2Status=='Rejection'){ ?>
								<li class="nav-item">
									<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-danger">Admission Decision 
										<?php if ($infoClientStatus=='8' && $appliedStatus=='8') {?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
										<?php }elseif ($infoClientStatus=='9' && $appliedStatus=='9') {?>
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
											<?php if ($directproofScreenshot!=''){ ?>
											<label class="form-label">Waiting for Admission decisions</label>
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
													<tr>
														<td>Program 2</td>
														<td><?php echo $programNo2Status;?></td>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $programNo2Screenshot);
														foreach ($fileMulti as $fileName) {
														?>
														<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
														<?php } ?></td>
														<td class="breakTD"><?php echo $programNo2Note;?></td>
														<td><?php if($programNo2Date=='0000-00-00'){}else{ echo $programNo2Date; }?></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-6">
											<form id="formPro1" enctype="multipart/form-data" class="parsley-examples">
											<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
												<div class="row">
													<div class="col-md-12">
														<label><b>Program 1</b></label>
													</div>
													<div class="col-md-12">
														<div class="radio radio-success form-check-inline">
															<input type="radio" id="applicationAcceptance" value="Acceptance" name="programNo1Status" required="required">
															<label for="applicationAcceptance"> Acceptance </label>
														</div>
														<div class="radio radio-danger form-check-inline">
															<input type="radio" id="applicationReject" value="Rejection" name="programNo1Status" required="required">
															<label for="applicationReject"> Rejection </label>
														</div>
													</div>
													<div class="form-group col-md-6">
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
													<div class="form-group col-md-6">
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
										<div class="col-md-6" style="border-left: 2px solid black;">
											<form id="formPro2" enctype="multipart/form-data" class="parsley-examples">
											<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
												<div class="row">
													<div class="col-md-12">
														<label><b>Program 2</b></label>
													</div>
													<div class="col-md-12">
														<div class="radio radio-success form-check-inline">
															<input type="radio" id="applicationAcceptance" value="Acceptance" name="programNo2Status" required="required">
															<label for="applicationAcceptance"> Acceptance </label>
														</div>
														<div class="radio radio-danger form-check-inline">
															<input type="radio" id="applicationReject" value="Rejection" name="programNo2Status" required="required">
															<label for="applicationReject"> Rejection </label>
														</div>
													</div>
													<div class="form-group col-md-6">
														<div class="agreement-container" data-agreement-id="9">
															<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
															</div>
															<input type="file" name="programNo2Screenshot[]" id="uploadedFiles9" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label">Date <span class="text-danger">*</span></label>
														<input type="date" name="programNo2Date" class="form-control" autocomplete="off" required="required" value="<?php echo date('Y-m-d');?>">
													</div>
													<div class="form-group col-md-12">
														<label class="form-label">Program 2 Note <span class="text-danger">*</span></label>
														<textarea class="form-control" name="programNo2Note" required="required"></textarea>
													</div>
													<div class="col-md-12">
														<div class="float-right">
															<button class="btn btn-custom" type="button" name="submitProgram2" onclick="saveDataForm('formPro2', 'submitProgram2')" id="submitProgram2"><i class="mdi mdi-upload"></i> Update </button>
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
					<div class="col-lg-6 col-md-12">
						<?php if ($uniName=="Sapienza University of Rome (SPU)" && ($appRow=="bachelor" || $appRow=="master") ) { ?>
						<h3>Sapienza University of Rome Video Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/Sapienza video.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/Sapienza video.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
						<?php }elseif ($uniName=="University of Messina (UM)" && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) { ?>
						<h3>University of Messina Video Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/messina.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/messina.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
						<?php }elseif ($uniName=="University of Genova (UG)"  && ($appRow=="master")){ ?>

						<h3>University of Genova Video Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/Genova video.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/Genova video.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
						<?php } ?>
						
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
				url: "models/_directApplyControllersState.php",
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
				$(".showModalTitle").html('SOPs Program');
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
			url: "models/stepsFormState.php",
			data: {
				step1DirectType: type,
				uniDirectID: idUni,
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
		var directUsername = $("#directUsername").val();
		var directPassword = $("#directPassword").val();
		var directLink = $("#directLink").val();
		var yesIDStep2 = $("#yesIDStep2").val();
		var hiddenStep2 = $("#hiddenStep2").val();
		if (directUsername=='' && directPassword=='' && directLink=='') {
			$("#directUsername").css("border-color", "red");
			$("#directPassword").css("border-color", "red");
			$("#directLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername!='' && directPassword=='' && directLink=='') {
			$("#directUsername").css("border-color", "");
			$("#directPassword").css("border-color", "red");
			$("#directLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername=='' && directPassword!='' && directLink=='') {
			$("#directUsername").css("border-color", "red");
			$("#directPassword").css("border-color", "");
			$("#directLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername=='' && directPassword=='' && directLink!='') {
			$("#directUsername").css("border-color", "red");
			$("#directPassword").css("border-color", "red");
			$("#directLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername!='' && directPassword!='' && directLink=='') {
			$("#directUsername").css("border-color", "");
			$("#directPassword").css("border-color", "");
			$("#directLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername!='' && directPassword=='' && directLink!='') {
			$("#directUsername").css("border-color", "");
			$("#directPassword").css("border-color", "red");
			$("#directLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername=='' && directPassword!='' && directLink!='') {
			$("#directUsername").css("border-color", "red");
			$("#directPassword").css("border-color", "");
			$("#directLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername!='' && directPassword!='' && directLink!='' && hiddenStep2=='0') {
			$("#directUsername").css("border-color", "");
			$("#directPassword").css("border-color", "");
			$("#directLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (directUsername!='' && directPassword!='' && directLink!='' && hiddenStep2!='0') {
			$("#directUsername").css("border-color", "");
			$("#directPassword").css("border-color", "");
			$("#directLink").css("border-color", "");
			document.getElementById("step2Title").style.color = "green";
		}
		subStep02(idUni, 1, directUsername, directPassword, directLink, hiddenStep2);
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
					step2DirectType: type,
					uniDirectID: idUni,
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
		var directUpUsername = $("#directUpUsername").val();
		var directUpPassword = $("#directUpPassword").val();
		var directUpLink = $("#directUpLink").val();
		var yesIDStep3 = $("#yesIDStep3").val();
		var hiddenStep3 = $("#hiddenStep3").val();
		if (directUpUsername=='' && directUpPassword=='' && directUpLink=='') {
			$("#directUpUsername").css("border-color", "red");
			$("#directUpPassword").css("border-color", "red");
			$("#directUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername!='' && directUpPassword=='' && directUpLink=='') {
			$("#directUpUsername").css("border-color", "");
			$("#directUpPassword").css("border-color", "red");
			$("#directUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername=='' && directUpPassword!='' && directUpLink=='') {
			$("#directUpUsername").css("border-color", "red");
			$("#directUpPassword").css("border-color", "");
			$("#directUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername=='' && directUpPassword=='' && directUpLink!='') {
			$("#directUpUsername").css("border-color", "red");
			$("#directUpPassword").css("border-color", "red");
			$("#directUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername!='' && directUpPassword!='' && directUpLink=='') {
			$("#directUpUsername").css("border-color", "");
			$("#directUpPassword").css("border-color", "");
			$("#directUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername!='' && directUpPassword=='' && directUpLink!='') {
			$("#directUpUsername").css("border-color", "");
			$("#directUpPassword").css("border-color", "red");
			$("#directUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername=='' && directUpPassword!='' && directUpLink!='') {
			$("#directUpUsername").css("border-color", "red");
			$("#directUpPassword").css("border-color", "");
			$("#directUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername!='' && directUpPassword!='' && directUpLink!='' && hiddenStep3=='0') {
			$("#directUpUsername").css("border-color", "");
			$("#directUpPassword").css("border-color", "");
			$("#directUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (directUpUsername!='' && directUpPassword!='' && directUpLink!='' && hiddenStep3!='0') {
			$("#directUpUsername").css("border-color", "");
			$("#directUpPassword").css("border-color", "");
			$("#directUpLink").css("border-color", "");
			document.getElementById("step3Title").style.color = "green";
		}
		subStep03(idUni, 1, directUpUsername, directUpPassword, directUpLink, hiddenStep3);
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
					step3DirectType: type,
					uniDirectID: idUni,
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
				step4DirectType: type,
				uniDirectID: idUni,
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
				step6DirectType: type,
				uniDirectID: idUni,
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