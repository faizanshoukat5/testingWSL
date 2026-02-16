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
$assignTo = $row['italy_program_assign'];
$uniName = $row['italy_university_name'];
$programName = $row['italy_program_name'];
$degreeName = $row['italy_client_degree'];
$proStep1 = $row['italy_pro_step1'];

$proStep2 = $row['italy_pro_step2'];
$accountUsername = $row['italy_account_username'];
$accountPassword = $row['italy_account_password'];
$accountLink = $row['italy_account_link'];
$accountScreenShot = $row['italy_account_screenshot'];

$proStep3 = $row['italy_pro_step3'];
$accountUpUsername = $row['italy_accountup_username'];
$accountUpPassword = $row['italy_accountup_password'];
$accountUpLink = $row['italy_accountup_link'];
$accountUpScreenShot = $row['italy_accountup_screenshot'];
$proStep4 = $row['italy_pro_step4'];

$taxCode = $row['italy_tax_code'];
$informScreenshot1 = $row['italy_info_screenshot1'];
$infoHeadNote = $row['italy_info_head_note'];
$clientInformScreenshot1 = $row['italy_client_info_screenshot1'];
$infoClientNote = $row['italy_client_info_note'];
$okScreenshot1 = $row['italy_ok_screenshot1'];
$okNote = $row['italy_ok_note'];

$infoPayFee = $row['italy_info_pay_fee'];
$feePayClient = $row['italy_fee_paid_client'];
$payFeeNote = $row['italy_fee_note'];
$dreamFinalStep = $row['italy_dream_final_step'];
$proStep6 = $row['italy_pro_step6'];

$appliedScreenshot = $row['italy_applied_screenshot'];
$programScreenshot = $row['italy_program_screenshot'];
$detailsScreenshot = $row['italy_details_screenshot'];
$appliedNote = $row['italy_applied_note'];

$proofScreenshot1 = $row['italy_proof_screenshot1'];
$proofNote = $row['italy_proof_note'];

$informEnrollFormNote = $row['italy_enrollment_inform_note'];
$informEnrollFormScreenShot = $row['italy_enrollment_inform_screenshot'];

$enrollmentUsername = $row['italy_enrollment_username'];
$enrollmentPassword = $row['italy_enrollment_password'];
$enrollmentLink = $row['italy_enrollment_link'];
$enrollmentScreenShot = $row['italy_enrollment_screenshot'];
$infoEnrollPayFee = $row['italy_enroll_info_pay_fee'];
$feeEnrollPayClient = $row['italy_enroll_fee_paid_client'];
$payEnrollFeeNote = $row['italy_enroll_fee_note'];
$payEnrollFeePaidNote = $row['italy_enroll_fee_paid_note'];

// $acceptedScreenshot = $row['italy_accepted_screenshot'];
// $rejectedScreenshot = $row['italy_rejected_screenshot'];
$programNo1Status = $row['italy_dream_program1_status'];
$programNo1Screenshot = $row['italy_dream_program1_screenshot'];
$programNo1Note = $row['italy_dream_program1_note'];
$programNo1Date = $row['italy_dream_program1_date'];

$programNo2Status = $row['italy_dream_program2_status'];
$programNo2Screenshot = $row['italy_dream_program2_screenshot'];
$programNo2Note = $row['italy_dream_program2_note'];
$programNo2Date = $row['italy_dream_program2_date'];

$infoClientStatus = $row['italy_info_client_status'];
$appliedStatus = $row['italy_applied_status'];

$sopsStatus = $row['italy_sops_status'];
$personalNote = $row['italy_program_personal_note'];
$personalHeadNote = $row['italy_head_personal_note'];
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


$applyQuery="SELECT italy_uni_apply_link from italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_name='".$uniName."' AND italy_uni_degree='".$degreeName."' ";
$applyQuery_ex = mysqli_query($con,$applyQuery);
$applyRow = mysqli_fetch_assoc($applyQuery_ex);
$applyLink = $applyRow['italy_uni_apply_link'];
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
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<?php
					$wtName='';
					$wt_query = "SELECT CONCAT(fname, ' ', lname) AS wtName FROM wt_users WHERE status='1' AND close='1' AND wt_id='$assignTo'";
					$wt_query_ex = mysqli_query($con, $wt_query);
					if ($wtrow = mysqli_fetch_assoc($wt_query_ex)) {
						$wtName = $wtrow['wtName'];
					}
					?>
					<p>Assign To: <strong><?php echo ucwords($wtName);?></strong></p>
				</div>
			</div>
			<div class="form-group col-md-8">
				<div class="float-right">
					<button type="button" class="btn <?php echo $personalHeadNote ? 'btn-success' : 'btn-outline-info'; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Admission Head Personal Report" onclick="myHeadPersonalReport(<?php echo $programAppliedID;?>);"><i class="mdi mdi-plus"></i> Head Personal Note</button>
					<button type="button" class="btn <?php echo $personalNote ? 'btn-success' : 'btn-outline-purple'; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Check Processing Team Personal Report" onclick="myPersonalReport(<?php echo $programAppliedID;?>);"><i class="mdi mdi-plus"></i> Team Personal Note</button>

					<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
					<?php 
					foreach ($decoded as $key => $programJSONName1) {
						$select_query = "SELECT italy_ad_sop_required from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_program_name='".$programJSONName1."' ";
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
				<?php
				$statusClass = $addActivitiesStatus == '1' ? 'btn-warning' : ($addActivitiesStatus == '2' ? 'btn-success' : 'btn-outline-primary');
				?>
				<button type="button" class="btn <?php echo $statusClass; ?> btn-sm float-right mt-1" data-toggle="tooltip" data-placement="top" title="Additional Activities Required by the University" onclick="additionalActivities(<?php echo $programAppliedID; ?>);"> <i class="mdi mdi-plus"></i> Additional Activities Required by the University</button>
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
								<span id="step1Title" style="<?php if ($proStep1==1){?> color: green; <?php }elseif ($proStep1==2){?>color:red;<?php } ?>"><b>Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" disabled="" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep1 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" disabled="" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep1 == 2) ? 'checked' : '';?>>
									<label for="noIDStep1"> No </label>
								</div>
							</h4>
							<p>Open the documents folder and log in to Gmail using the login details at <b>Serial Number 15</b></p>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step2Title" style=" <?php if ($proStep2==1){?> color: green; <?php }elseif ($proStep2==2) { ?> color: red;<?php } ?>"><b> Create a one-time account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" disabled="" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep2 == 1) ? 'checked' : '';?>>
									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" disabled="" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep2 == 2) ? 'checked' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
							</h4>
							<p>Create the account through the link below: (Dream Apply Portal) <a href="<?php echo $applyLink;?>" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>
							<form id="formDreamLogin" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUsername;?>">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="accountPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountPassword;?>">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountLink;?>">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">ScreenShot</label>
										<input type="file" name="accountScreenShot" class="form-control" autocomplete="off" readonly="">
										<?php 
										$fileMulti = explode(',', $accountScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subAccDetails" onclick="saveDataForm('formDreamLogin', 'subAccDetails')" id="subAccDetails"><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<!-- <div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 03 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step3Title" style=" <?php if ($proStep3==1){?> color: green; <?php }elseif ($proStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" disabled="" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep3 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" disabled="" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep3 == 2) ? 'checked' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							<p>The student will receive an email from the university. Activate the link provided in the email, change the password, and save the updated password in the tab.</p>

							<form id="formDreamUpLogin" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpUsername;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="accountUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpPassword;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpLink;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated ScreenShot</label>
										<input type="file" name="accountUpScreenShot" class="form-control" autocomplete="off" readonly="">
										<?php 
										$fileMulti = explode(',', $accountUpScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } ?>
									</div>
								</div>
							</form>
						</fieldset>
					</div> -->
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 03 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step4Title" style=" <?php if ($proStep4==1){?> color: green; <?php }elseif ($proStep4==2) { ?> color: red;<?php } ?>"><b>Fill out the Application Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep4" value="1" disabled="" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep4 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep4"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep4" value="2" disabled="" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep4 == 2) ? 'checked' : '';?>>
									<label for="noIDStep4"> No </label>
								</div>
							</h4>
							<p>Fill out the online form by entering the client's personal details according to their passport and educational documents, and upload the documents to the portal. </p>
							<div class="row">
								<div class="col-md-4"> </div>
								<div class="col-md-4 alert bg-dark">
									<a href="<?php echo $applyLink;?>" class="text-warning" target="_blank"><b><?php echo $applyLink;?></b></a>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 04 <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<?php 
							if($uniName=='CaFoscari University of Venice (FV)' || ($uniName=='University of Florence (UF)' && $appRow=='master') ){
							?>
							<h4>Italian Tax Code of <?php echo $uniName;?></h4>
							<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-12">
										<label class="form-label">Italian Tax Code <span class="text-danger">*</span></label>
										<textarea name="taxCode" class="form-control" required="required" autocomplete="off" value="<?php echo $taxCode;?>" disabled=""><?php echo $taxCode;?></textarea>
									</div>
								</div>
							</form>
							<?php } ?>
							<?php 
							$uniArray = [
								"CaFoscari University of Venice (FV)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"University of Padua (PDU)" => [
									"degrees" => ["bachelor", "master"] 
								],
								"University of Pavia (PV)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Siena (US)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Turin (TU)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Florence (UF)" => [
									"degrees" => ["master"] 
								],
								"University of Ferrara (FR)" => [
									"degrees" => ["master"]
								],
								"University of Milano Bicocca (MLB)" => [
									"degrees" => ["master"]
								],
								"University of Milan (ML)" => [
									"degrees" => ["master"]
								],
								"University of Trieste (TR)" => [
									"degrees" => ["bachelor", "master"]
								],
								"University of Bari (UB)" => [
									"degrees" => ["bachelor", "master"]
								],
							];
							if (isset($uniArray[$uniName]) && in_array($appRow, $uniArray[$uniName]['degrees'])) { 
								$color = $feePayClient != '' ? 'green' : 'red';
							}else{
								$color = $okScreenshot1 != '' ? 'green' : 'red';
							} ?>
							<h4>
								<span style="color: <?= $color; ?>"> <b>Inform the client to recheck the application <?= isset($uniArray[$uniName]) ? "(pay the application fee)" : "" ?></b> </span>
							</h4>

							<h4>Application checking:</h4>
							<ul>
								<li>Please send the Dream Apply portal link, username, and password to the client and give instructions for rechecking the admission application.</li>
							</ul>
							<?php 
							$uniArray = [
								"CaFoscari University of Venice (FV)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 30,
								],
								"University of Siena (US)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 50,
								],
								"University of Turin (TU)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 60,
								],
								"University of Padua (PDU)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 60,
								],
								"University of Pavia (PV)" => [
									"degrees" => ["bachelor", "master", "mbbs"],
									"fee" => 35,
								],
								"University of Florence (UF)" => [
									"degrees" => ["master"],
									"fee" => 20,
								],
								"University of Milano Bicocca (MLB)" => [
									"degrees" => ["master"],
									"fee" => 30,
								],
								"University of Milan (ML)" => [
									"degrees" => ["master"],
									"fee" => 30,
								],
								"University of Ferrara (FR)" => [
									"degrees" => ["master"],
									"fee" => 20,
								],
								"University of Trieste (TR)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 10,
								],
								"University of Bari (UB)" => [
									"degrees" => ["bachelor", "master"],
									"fee" => 20,
								],
								"University of Parma (PRM)" => [
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
									<li>This university <b>does not charge an application fee</b>. Send the portal link, username, and password to the client and give instructions to recheck the admission application. When the client rechecks and approves the file, submit the application.</li>
								</ul>
							<?php } ?>

							<ul class="nav nav-tabs">
								<?php 
								if ($clientInformScreenshot1=='') {
								?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Inform the client to recheck <br> the Application
										<?php if ($infoClientStatus=='0' && $appliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Inform To Client </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }elseif ($clientInformScreenshot1!=''){ ?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Inform the client to recheck <br> the Application</span>
									</a>
								</li>
								<?php } ?>

								<?php
								$changingStatus=''; 
								$client_query = "SELECT changing_status from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND programs_id='".$programAppliedID."' AND entry_by='".$_SESSION['user_id']."' ORDER BY program_italy_id DESC LIMIT 1 ";
								$client_query_ex = mysqli_query($con,$client_query);
								if ($client_query_ex && mysqli_num_rows($client_query_ex) > 0){
									$row = mysqli_fetch_assoc($client_query_ex);
									$changingStatus = $row['changing_status'];
								}
								if ($changingStatus=='head' || $okScreenshot1!='') {
								?>
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Client's Request for Changes in <br> the Application 
										<?php if ($infoClientStatus=='2' && $appliedStatus=='6') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Completed </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?> 
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">Client's Request for Changes in <br> the Application 
										<?php if ($infoClientStatus=='2' && $appliedStatus=='6') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Completed </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php } ?>

								<?php 
								if ($okScreenshot1!='') { ?>
								<li class="nav-item">
									<a href="#teamOk" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Application Approved <br> by the Client </span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#teamOk" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">Application Approved <br>by the Client </span>
									</a>
								</li>
								<?php } ?>
								
								<?php 
								if (($uniName=="CaFoscari University of Venice (FV)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Padua (PDU)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Pavia (PV)" && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) || ($uniName=="University of Siena (US)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Turin (TU)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Florence (UF)" && ($appRow=="master")) || (($uniName=="University of Milano Bicocca (MLB)" || $uniName=="University of Milan (ML)") && ($appRow=="master")) || ($uniName=="University of Ferrara (FR)" && ($appRow=="master")) || ($uniName=="University of Trieste (TR)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Bari (UB)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Parma (PRM)" && ($appRow=="bachelor" || $appRow=="master"))){
								?>
								<?php if($feePayClient!=''){?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">The client has paid the <br>application fee.</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">The client has paid the <br>application fee.</span>
									</a>
								</li>
								<?php } ?>
								
								<?php }else{ ?> 

								<?php } ?>

								<li class="nav-item">
									<a href="#additionalTask" data-toggle="tab" aria-expanded="false" class="nav-link <?= $dreamFinalStep == 1 ? 'navSuccess' : '' ?>">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block <?= $dreamFinalStep == 1 ? 'text-success' : 'text-warning' ?>">Final Step</span>
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="uploadScreenshot">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-6">
													<div class="alert bg-dark text-warning">
														<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
													</div>
												</div>
												<div class="col-md-3">
													<div class="alert bg-dark text-warning">
														<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
													</div>
												</div>
												<div class="col-md-3">
													<div class="alert bg-dark text-warning">
														<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-12">
											<h4>Processing Team</h4>
										</div>
										<div class="col-md-12">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="20%">Username / Email</th>
														<th width="20%">Updated Password</th>
														<th width="20%">Link</th>
														<th width="20%">Inform ScreenShot</th>
														<th width="20%">Note</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="breakTD"><?php echo $accountUsername;?></td>
														<td class="breakTD"><?php echo $accountPassword;?></td>
														<td class="breakTD"><?php echo $accountLink;?></td>
														<td class="breakTD"> <?php 
															$fileMulti = explode(',', $informScreenshot1);
															$sr=1;
															foreach ($fileMulti as $fileName) {
															?>
															<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php $sr++;} ?>
														</td>
														<td class="breakTD"><?php echo $infoHeadNote;?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<?php 
										$uniNameArray = [
											"CaFoscari University of Venice (FV)" => [
												"uniShort" => "CaFoscari",
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=CaFoscari&guiDRafiA05S=CaFoscari" 
											],
											"Sapienza University of Rome (SPU)" => [
												"uniShort" => "Sapienza", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Sapienza&guiDRafiA05S=Sapienza"
											],
											"Universita Politecnica Delle Marche (MR)" => [
												"uniShort" => "Politecnica", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Politecnica&guiDRafiA05S=Politecnica"
											],
											"University of Bologna (UBN)" => [
												"uniShort" => "Bologna", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Bologna&guiDRafiA05S=Bologna"
											],
											"University of Campania (UC)" => [
												"uniShort" => "Campania", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Messina (UM)" => [
												"uniShort" => "Messina", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Messina&guiDRafiA05S=Messina"
											],
											"University of Napoli Fedrico II (UNP)" => [
												"uniShort" => "Napoli", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Padua (PDU)" => [
												"uniShort" => "Padua", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Padua&guiDRafiA05S=Padua"
											],
											"University of Palermo (PLM)" => [
												"uniShort" => "Palermo", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Pavia (PV)" => [
												"uniShort" => "Pavia", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Pavia&guiDRafiA05S=Pavia"
											],
											"University of Perugia (UPG)" => [
												"uniShort" => "Perugia", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Siena (US)" => [
												"uniShort" => "Siena", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Siena&guiDRafiA05S=Siena"
											],
											"University of Trieste (TR)" => [
												"uniShort" => "Trieste", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Trieste&guiDRafiA05S=Trieste"
											],
											"University of Turin (TU)" => [
												"uniShort" => "Turin", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Turin&guiDRafiA05S=Turin"
											],
											"University of Cassino (CS)" => [
												"uniShort" => "Cassino",
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Cassino&guiDRafiA05S=Cassino"
											],
											"University of Bergamo (BR)" => [
												"uniShort" => "Bergamo", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Bergamo&guiDRafiA05S=Bergamo"
											],
											"University of Ferrara (FR)" => [
												"uniShort" => "Ferrara",
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Ferrara&guiDRafiA05S=Ferrara"
											],
											"University of Florence (UF)" => [
												"uniShort" => "Florence", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Florence&guiDRafiA05S=Florence"
											],
											"University of Foggia (FG)" => [
												"uniShort" => "Foggia", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Genova (UG)" => [
												"uniShort" => "Genevo", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Pisa (UP)" => [
												"uniShort" => "Pisa", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Pisa&guiDRafiA05S=Pisa"
											],
											"University of Salerno (SL)" => [
												"uniShort" => "Salerno", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Verona (VN)" => [
												"uniShort" => "Verona", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Trento (TRN)" => [
												"uniShort" => "Trento", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Trento&guiDRafiA05S=Trento"
											],
											"University of Tuscia (TS02)" => [
												"uniShort" => "Tuscia", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Laquia (LAQ01)" => [
												"uniShort" => "Laquia", 
												"degrees" => ["bachelor", "master"],
												"Link" => "Copy Message"
											],
											"University of Parma (PRM)" => [
												"uniShort" => "Parma", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Parma&guiDRafiA05S=Parma"
											],
											"University of Milano Bicocca (MLB)" => [
												"uniShort" => "MilanoBiccoca", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=MilanoBiccoca&guiDRafiA05S=MilanoBiccoca"
											],
											"University of Milan (ML)" => [
												"uniShort" => "MilaML", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=MilaML&guiDRafiA05S=MilaML"
											],
											"Unicamillus University of Health Care Romee (UHCR)" => [
												"uniShort" => "Unicamillus", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Unicamillus&guiDRafiA05S=Unicamillus"
											],
											"University of Camerino (UC)" => [
												"uniShort" => "Camerino", 
												"degrees" => ["bachelor", "master"],
												"Link" => "https://info.wslcms.com/application-guideline?neHinA0vER06=Camerino&guiDRafiA05S=Camerino"
											],
										];
										if (isset($uniNameArray[$uniName]) && isset($appRow, $uniNameArray[$uniName]['degrees']) ) {
											$uniShort = $uniNameArray[$uniName]['uniShort'];
											$link = $uniNameArray[$uniName]['Link'];
											?>
											<div id="showToastLink" class="toast">Link copied to clipboard!</div>
											<div class="col-md-12">
												<input type="hidden" name="" value="<?php echo $uniShort;?>" id="guideUni">
												<h5><?php echo $uniShort;?> Link: <a href="<?php echo $link;?>" target="_blank"><?php echo $link;?></a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink()"><i class="mdi mdi-content-copy"></i></button> <button  class="btn btn-dark btn-sm text-warning" data-toggle="tooltip" data-placement="top" title="View Application Guidelines" onclick="viewGuides();"><i class="mdi mdi-eye"></i></button></h5>
												
											</div>
										<?php } ?>
									</div>
									<form id="formDreamInformed" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea name="infoClientNote" class="form-control"><?php echo $infoClientNote;?></textarea>
											</div>
											<div class="form-group col-md-5">
												<div class="agreement-container" data-agreement-id="1">
													<label class="form-label">Inform to Client WhatApp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="clientInformScreenshot1[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php
												if($clientInformScreenshot1!=''){ 
												$fileMulti = explode(',', $clientInformScreenshot1);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
										</div>
										<div class="col-md-12">
											<div class="float-right ml-2">
												<button class="btn btn-danger btn-sm" type="button" <?php echo $informScreenshot1=='' ? 'disabled' : '';?> <?php echo ($okScreenshot1!='' || $changingStatus=='head') ? 'disabled' : '';?> onclick="del(delInformToClient,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button>
											</div>
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="subinfoClient" onclick="saveDataForm('formDreamInformed', 'subinfoClient')" id="subinfoClient" <?php echo ($okScreenshot1!='') ? 'disabled' : '';?> <?php echo $informScreenshot1=='' ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Inform to Client </button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="changesRequired">
									<div class="row">
										<div class="col-md-12">
											<div class="row">
												<div class="col-md-6">
													<div class="alert bg-dark text-warning">
														<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
													</div>
												</div>
												<div class="col-md-3">
													<div class="alert bg-dark text-warning">
														<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
													</div>
												</div>
												<div class="col-md-3">
													<div class="alert bg-dark text-warning">
														<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
													</div>
												</div>
											</div>
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
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='dream' AND changing_status='team' AND programs_id='".$programAppliedID."' ";
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
										<div class="col-md-12">
											<h4 class="text-primary">Changing Required By Admission Head</h4>
											<table class="table table-bordered">
												<thead>
													<tr>
														<th width="20%">Changing ScreenShot</th>
														<th width="30%">Changing Audio</th>
														<th width="35%">Changing Note</th>
														<th width="15%">Create Date</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<input type="hidden" name="" value="<?php echo $programAppliedID;?>" id="programAppliedID">
													<?php 
													$client_query = "SELECT * from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='dream' AND changing_status='head' AND programs_id='".$programAppliedID."' ";
													$client_query_ex = mysqli_query($con,$client_query);
													foreach ($client_query_ex as $rowCl) {
														$changingScreenshot = $rowCl['changing_screenshot'];
														$changingAudio = $rowCl['changing_audio'];
													?>
													<tr>
														<td class="breakTD">
															<?php 
															$fileMulti = explode(',', $changingScreenshot);
															$sr=1;
															foreach ($fileMulti as $fileName) {
															?>
															<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php $sr++; } ?>
														</td>
														<td class="breakTD">
															<?php if($changingAudio!=''){ ?>
															<?php 
															$fileMulti = explode(',', $changingAudio);
															foreach ($fileMulti as $fileName) {
															?>
															<audio controls>
																<source src="../payagreements/<?php echo $fileName; ?>" type="audio/mpeg">
																Your browser does not support the audio element.
															</audio><br>
															<?php } ?>
														<?php }else{} ?>
														</td>
														<td class="breakTD"><?php echo $rowCl['changing_note'];?></td>
														<td class="breakTD"><?php echo $rowCl['create_date'];?></td>
														<td><button class="btn btn-danger btn-sm" type="button" <?php echo ($okScreenshot1!='') ? 'disabled' : '';?> onclick="del(delChangesHead,<?php echo $rowCl['program_italy_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
													</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
										<div class="col-md-12">
											<form id="formDreamChanges" enctype="multipart/form-data" class="parsley-examples">
												<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
												<div class="row">
													<div class="form-group col-md-12">
														<label class="form-label">Change Note</label>
														<textarea class="form-control" name="changingNote"></textarea>
													</div>
													<div class="form-group col-md-6">
														<div class="agreement-container" data-agreement-id="2">
															<label class="form-label">Change Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
															</div>
															<input type="file" name="changingScreenshot1[]" required="required" id="uploadedFiles2" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
													<div class="form-group col-md-6">
														<div class="agreement-container" data-agreement-id="3">
															<label class="form-label">Any Audio Message <span class="text-danger">* (Select Multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
															</div>
															<input type="file" name="changingAudio[]" id="uploadedFiles3" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="float-right">
															<button class="btn btn-custom" type="button" name="subChangeDetails" onclick="saveDataForm('formDreamChanges', 'subChangeDetails')" id="subChangeDetails" <?php echo ($okScreenshot1!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Send request for changes </button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane " id="teamOk">
									<form id="formDreamOk" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
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
															$fileMulti = explode(',', $okScreenshot1);
															$sr=1;
															foreach ($fileMulti as $fileName) {
															?>
															<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php $sr++;} ?></td>
															<td class="breakTD"><?php echo $okNote;?></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Approved Note</label>
												<textarea class="form-control" name="okNote"></textarea>
											</div>
											<div class="form-group col-md-5">
												<div class="agreement-container" data-agreement-id="4">
													<label class="form-label">Approved Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="okScreenshot1[]" required="required" id="uploadedFiles4" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right ml-2">
													<button class="btn btn-danger btn-sm" type="button" <?php echo $dreamFinalStep==1 ? 'disabled' : '';?> onclick="del(delApproved,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button>
												</div>
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subOk" onclick="saveDataForm('formDreamOk', 'subOk')" id="subOk" <?php echo ($okScreenshot1!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Application Approved </button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="feeGuides">
									<form id="formDreamFeeGuide" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="col-md-12">
												<div class="row">
													<div class="col-md-6">
														<div class="alert bg-dark text-warning">
															<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
														</div>
													</div>
													<div class="col-md-3">
														<div class="alert bg-dark text-warning">
															<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
														</div>
													</div>
													<div class="col-md-3">
														<div class="alert bg-dark text-warning">
															<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
											<?php 
											$uniArray = [
												"CaFoscari University of Venice (FV)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 30,
												],
												"University of Siena (US)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 50,
												],
												"University of Turin (TU)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 60,
												],
												"University of Padua (PDU)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 60,
												],
												"University of Pavia (PV)" => [
													"degrees" => ["bachelor", "master", "mbbs"],
													"fee" => 35,
												],
												"University of Florence (UF)" => [
													"degrees" => ["master"],
													"fee" => 20,
												],
												"University of Milano Bicocca (MLB)" => [
													"degrees" => ["master"],
													"fee" => 30,
												],
												"University of Milan (ML)" => [
													"degrees" => ["master"],
													"fee" => 30,
												],
												"University of Ferrara (FR)" => [
													"degrees" => ["master"],
													"fee" => 20,
												],
												"University of Trieste (TR)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 10,
												],
												"University of Bari (UB)" => [
													"degrees" => ["bachelor", "master"],
													"fee" => 20,
												],
												"University of Parma (PRM)" => [
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
													<li>This university <b>does not charge an application fee</b>. Send the portal link, username, and password to the client and give instructions to recheck the admission application. When the client rechecks and approves the file, submit the application.</li>
												</ul>
											<?php } ?>
											</div>
											<div class="col-md-12">
												<table class="table table-bordered">
													<thead>
														<tr>
															<th width="30%">Inform to Pay Fee Whatapp ScreenShot</th>
															<th width="30%">Fee Paid By Client ScreenShot</th>
															<th width="30%">Fee Note</th>
															<th width="10%">Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td class="breakTD"><?php 
															$fileMulti = explode(',', $infoPayFee);
															$sr=1;
															foreach ($fileMulti as $fileName) {
															?>
															<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php $sr++;} ?></td>
															<td class="breakTD"><?php 
															$fileMulti = explode(',', $feePayClient);
															$sr=1;
															foreach ($fileMulti as $fileName) {
															?>
															<?php echo $sr;?>:<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
															<?php $sr++;} ?></td>
															<td class="breakTD"><?php echo $payFeeNote;?></td>
															<td><button class="btn btn-danger btn-sm" type="button" <?php echo $dreamFinalStep=='1' ? 'disabled' : '';?> onclick="del(delFeePaid,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="form-group col-md-5">
												<div class="agreement-container" data-agreement-id="5">
													<label class="form-label">Inform to Pay Fee Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="infoPayFee[]" required="required" id="uploadedFiles5" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-5">
												<div class="agreement-container" data-agreement-id="6">
													<label class="form-label">Fee Paid receipt By Client ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="feePayClient[]" required="required" id="uploadedFiles6" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="payFeeNote"><?php echo $payFeeNote;?> </textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subGuidFee" onclick="saveDataForm('formDreamFeeGuide', 'subGuidFee')" id="subGuidFee" <?php echo $dreamFinalStep=='1' ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Fee Paid </button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="additionalTask">
									<form id="formDreamAdditional" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="col-md-6">
												<label>Inform the client to recheck the Application</label> <br>
												<div class="checkbox checkbox-success form-check-inline">
													<input type="checkbox" id="yesAddStep1" value="1" name="addStep1" checked="">
													<label for="yesAddStep1"> Yes </label>
												</div>
											</div>
											<div class="col-md-6">
												<label>Application Changes By Client</label> <br>
												<div class="checkbox checkbox-success form-check-inline">
													<input type="checkbox" id="yesAddStep2" value="1" name="addStep2">
													<label for="yesAddStep2"> Yes </label>
												</div>
											</div>
											<div class="col-md-6">
												<label>Application Approved By Client</label> <br>
												<div class="checkbox checkbox-success form-check-inline">
													<input type="checkbox" id="yesAddStep3" value="1" name="addStep3">
													<label for="yesAddStep3"> Yes </label>
												</div>
											</div>
											<?php 
											if (($uniName=="CaFoscari University of Venice (FV)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Padua (PDU)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Pavia (PV)" && ($appRow=="bachelor" || $appRow=="master" || $appRow=="mbbs")) || ($uniName=="University of Siena (US)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Turin (TU)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Florence (UF)" && ($appRow=="master")) || (($uniName=="University of Milano Bicocca (MLB)" || $uniName=="University of Milan (ML)") && ($appRow=="master")) || ($uniName=="University of Trieste (TR)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Bari (UB)" && ($appRow=="bachelor" || $appRow=="master")) || ($uniName=="University of Parma (PRM)" && ($appRow=="bachelor" || $appRow=="master"))){
											?>
											<div class="col-md-6">
												<label>Client has paid the application Fee</label> <br>
												<div class="checkbox checkbox-success form-check-inline">
													<input type="checkbox" id="yesAddStep4" value="1" name="addStep4">
													<label for="yesAddStep4"> Yes </label>
												</div>
											</div>
										<?php }else{} ?>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subAdditional" onclick="saveDataForm('formDreamAdditional', 'subAdditional')" id="subAdditional" disabled><i class="mdi mdi-upload"></i> Update </button>
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
								Step: 05 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step6Title" style="<?php if ($proStep6==1){?> color: green; <?php }elseif ($proStep6==2) { ?> color: red;<?php } ?>"><b>Submit the admission  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" disabled="" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep6 == 1) ? 'checked' : '';?>>
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" disabled="" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proStep6 == 2) ? 'checked' : '';?>>
									<label for="noIDStep6"> No </label>
								</div>
								<?php if (($infoClientStatus=='3' || $infoClientStatus=='5') && $appliedStatus=='7') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Application Applied </span>
								<?php }?>
							</h4>
							<p>After confirmation of Rechecking and updating the application fee option kindly submit the application.</p>
							
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<div class="alert bg-dark text-warning">
												<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="alert bg-dark text-warning">
												<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
											</div>
										</div>
										<div class="col-md-3">
											<div class="alert bg-dark text-warning">
												<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="25%">Applied Screenshot</th>
												<th width="25%">Program Screenshot</th>
												<th width="25%">Detail's Screenshot</th>
												<th width="25%">Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $appliedScreenshot);
												$sr=1;
												foreach ($fileMulti as $fileName) {
												?>
												<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php $sr++;} ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $programScreenshot);
												$sr=1;
												foreach ($fileMulti as $fileName) {
												?>
												<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php $sr++;} ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $detailsScreenshot);
												$sr=1;
												foreach ($fileMulti as $fileName) {
												?>
												<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php $sr++; } ?></td>
												<td class="breakTD"><?php echo $appliedNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</fieldset>
					</div>
					
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 06 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4><span style="<?php if ($proofScreenshot1!=''){?> color: green; <?php }elseif ($proofScreenshot1=='') { ?> color: red;<?php } ?>"><b>Inform the client about the submission application</b></span></h4>
							<p>Inform the client about the submission application with screenshot proof </p>

							<form id="formDreamProof" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<input type="hidden" name="updUniName" value="<?php echo $uniName;?>">
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">
												<div class="alert bg-dark text-warning">
													<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
												</div>
											</div>
											<div class="col-md-3">
												<div class="alert bg-dark text-warning">
													<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
												</div>
											</div>
											<div class="col-md-3">
												<div class="alert bg-dark text-warning">
													<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12">
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
													$fileMulti = explode(',', $proofScreenshot1);
													$sr=1;
													foreach ($fileMulti as $fileName) {
													?>
													<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
													<?php $sr++; } ?></td>
													<td class="breakTD"><?php echo $proofNote;?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group col-md-12">
										<label class="form-label">Proof Note</label>
										<textarea class="form-control" name="proofNote"><?php echo $proofNote;?></textarea>
									</div>
									<div class="form-group col-md-5">
										<div class="agreement-container" data-agreement-id="7">
											<label class="form-label">Inform to Client Proof Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="proofScreenshot1[]" required="required" id="uploadedFiles7" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>												
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right ml-2">
											<button class="btn btn-danger btn-sm" type="button" <?php echo ($programNo1Status!='' || $programNo2Status!='') ? 'disabled' : '';?> onclick="del(delProof,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button>
										</div>
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subProof" onclick="saveDataForm('formDreamProof', 'subProof')" id="subProof" <?php echo ($programNo1Status!='' || $programNo2Status!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<!-- Bergamo  -->
					<div class="col-md-12">
						<?php 
						if ($uniName=='University of Bergamo (BR)') {
						?>
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 07 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4>Sent Request to Processing Team fill Enrollment fee form:</h4>
							<form id="formDreamFeeForm" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">		
									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Processing Team to Fill Bergamo Enrollment Fee Form</th>
													<th>Any Note</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="breakTD"><?php 
													$fileMulti = explode(',', $informEnrollFormScreenShot);
													$sr=1;
													foreach ($fileMulti as $fileName) {
													?>
													<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
													<?php $sr++;} ?></td>
													<td class="breakTD"><?php echo $informEnrollFormNote;?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group col-md-12">
										<label class="form-label">Any Note</label>
										<textarea class="form-control" name="informEnrollFormNote"> </textarea>
									</div>
									<div class="form-group col-md-6">
										<div class="agreement-container" data-agreement-id="8">
											<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="informEnrollFormScreenShot[]" required="required" id="uploadedFiles8" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right ml-2">
											<button class="btn btn-danger btn-sm" type="button" onclick="del(delInformEnrollForm,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button>
										</div>
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subInformEnrollForm" onclick="saveDataForm('formDreamFeeForm', 'subInformEnrollForm')" id="subInformEnrollForm" <?php echo $informEnrollFormScreenShot!='' ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Inform to Processing Team </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 08 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<p><b> After applying, the client will receive an email regarding the enrollment fee</b>
								<a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox" target="_blank"><button class="btn btn-primary btn-sm">Gmail Login</button></a>
							</p>
							<p>After applying, the client will receive an email regarding the payment of the <b>30 euro enrollment fee</b>. The client will receive an enrollment link, which you need to open and complete the enrollment form. you should also save the username and password.</p>
							<div class="row">
								<div class="col-md-6">
									<div class="alert bg-dark text-warning">
										<p>Name: <strong><?php echo ucwords($clientName);?></strong></p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="alert bg-dark text-warning">
										<p>WhatApp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="alert bg-dark text-warning">
										<p>Degree: <strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
									</div>
								</div>
							</div>
							<h4>Processing Team</h4>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th width="25%">Username / Email</th>
										<th width="25%">Updated Password</th>
										<th width="25%">Link</th>
										<th width="25%">From ScreenShot</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="breakTD"><?php echo $enrollmentUsername;?></td>
										<td class="breakTD"><?php echo $enrollmentPassword;?></td>
										<td class="breakTD"><?php echo $enrollmentLink;?></td>
										<td class="breakTD"> <?php 
										$fileMulti = explode(',', $enrollmentScreenShot);
										$sr=1;
										foreach ($fileMulti as $fileName) {
											?>
											<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php $sr++;} ?>
										</td>
									</tr>
								</tbody>
							</table>
						</fieldset>
						<?php }if ($uniName=='University of Bergamo (BR)') { ?>
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: <?php echo ($uniName == 'University of Trieste (TR)') ? "07" : "09"; ?> <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4>Inform to client Pay the <?php echo ($uniName == 'University of Trieste (TR)') ? "Application" : "Enrollment"; ?> Fee : <?php if ($infoClientStatus=='11' && $appliedStatus=='11') {?> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Inform to Pay Enrollment Fee </span> <?php }?></h4>
							<p><?php echo ($uniName == 'University of Trieste (TR)') ? "" : "Please send the Enrollment link, username, and password to the client and give instructions about the enrollment fee and the card activation process."; ?> When the client pays the university <?php echo ($uniName == 'University of Trieste (TR)') ? "Application" : "Enrollment"; ?> fee, the university automatically updates the payment status. </p>
							<p class="text-danger">NOTE: We will take the fee payment receipt from the client and upload it to our portal. </p>
							<div class="row">
								<div class="col-md-6">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="60%">Inform to Pay Fee Whatapp ScreenShot</th>
												<th width="30%">Fee Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if($infoEnrollPayFee!=''){ ?>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $infoEnrollPayFee);
												$sr=1;
												foreach ($fileMulti as $fileName) {
												?>
												<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php $sr++; } ?></td>
												<td class="breakTD"><?php echo $payEnrollFeeNote;?></td>
												<td>
													<button <?php echo ($feeEnrollPayClient!='') ? 'disabled' : '';?> class="btn btn-danger btn-sm" type="button" onclick="del(delPayEnrollForm,<?php echo $programAppliedID;?>);"><i class="mdi mdi-trash-can"></i> </button>
												</td>
											</tr>
											<?php } ?>
										</tbody>
									</table>

									<form id="formDreamPayFee" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<div class="agreement-container" data-agreement-id="9">
													<label class="form-label">Inform to Pay Fee Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="infoEnrollPayFee[]" required="required" id="uploadedFiles9" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="payEnrollFeeNote"><?php echo $payEnrollFeeNote;?> </textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subEnrollInfoFee" onclick="saveDataForm('formDreamPayFee', 'subEnrollInfoFee')" id="subEnrollInfoFee" <?php echo ($infoEnrollPayFee!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Informed to Client </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-6" style="border-left: 3px solid black;">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="50%">Fee Paid By Client ScreenShot</th>
												<th width="50%">Fee Note</th>
											</tr>
										</thead>
										<tbody>
											<?php if($feeEnrollPayClient!=''){ ?>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $feeEnrollPayClient);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $payEnrollFeePaidNote;?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>

									<form id="formDreamFeePaid" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-12">
												<div class="agreement-container" data-agreement-id="10">
													<label class="form-label">Fee Paid receipt By Client ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="feeEnrollPayClient[]" required="required" id="uploadedFiles10" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="payEnrollFeePaidNote"><?php echo $payEnrollFeePaidNote;?> </textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subEnrollFeePaid" onclick="saveDataForm('formDreamFeePaid', 'subEnrollFeePaid')" id="subEnrollFeePaid" <?php echo ($feeEnrollPayClient!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Fee Paid </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</fieldset>
					</div>
					<?php } ?>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: <?php if ($uniName == 'University of Trieste (TR)') { echo "08"; } elseif ($uniName == 'University of Bergamo (BR)') { echo "10"; } else { echo "07"; }?> <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<h4><span style="<?php if ($programNo1Status=='Acceptance' || $programNo2Status=='Acceptance'){?> color: green; <?php }elseif ($programNo1Status=='Rejection' && $programNo2Status=='Rejection') { ?> color: red;<?php } ?>"><b> Waiting for a response</b></span></h4>
							<p>Waiting for a response if the application is accepted, then clear after admission dues and go for pre-enrollment </p>
							<ul class="nav nav-tabs">
								<?php if($uniName=='University of Bergamo (BR)'){ ?>
									<?php if ($proofScreenshot1!='' && $feeEnrollPayClient!=''){ ?>
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
								<?php }else{ ?>
									<?php if ($proofScreenshot1!='' && $feeEnrollPayClient==''){ ?>
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
											<?php if($uniName=='University of Bergamo (BR)'){ ?>
												<?php if ($proofScreenshot1!='' && $feeEnrollPayClient!=''){ ?>
												<label class="form-label">Waiting for admission decisions</label>
												<?php }else{ ?>
												<?php } ?>
											<?php }else{ ?>
												<?php if ($proofScreenshot1!='' && $feeEnrollPayClient==''){ ?>
												<label class="form-label">Waiting for admission decisions</label>
												<?php }else{ ?>
												<?php } ?>
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
														$sr=1; 
														$fileMulti = explode(',', $programNo1Screenshot);
														foreach ($fileMulti as $fileName) {
														?>
														<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php $sr++;} ?></td>
														<td class="breakTD"><?php echo $programNo1Note;?></td>
														<td><?php if($programNo1Date=='0000-00-00'){}else{ echo $programNo1Date; }?></td>
													</tr>
													<tr>
														<td>Program 2</td>
														<td><?php echo $programNo2Status;?></td>
														<td class="breakTD"><?php 
														$fileMulti = explode(',', $programNo2Screenshot);
														$sr=1;
														foreach ($fileMulti as $fileName) {
														?>
														<?php echo $sr;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
														<?php $sr++; } ?></td>
														<td class="breakTD"><?php echo $programNo2Note;?></td>
														<td><?php if($programNo2Date=='0000-00-00'){}else{ echo $programNo2Date; }?></td>
													</tr>
												</tbody>
											</table>
										</div>

										<div class="col-md-6">
											<form id="formDreamPro1" enctype="multipart/form-data" class="parsley-examples">
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
														<div class="agreement-container" data-agreement-id="11">
															<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%">
															</div>
															<input type="file" name="programNo1Screenshot[]" required="required" id="uploadedFiles11" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label">Date <span class="text-danger">*</span></label>
														<input type="date" name="programNo1Date" class="form-control" autocomplete="off" required="required" value="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-md-12">
														<label class="form-label">Program 1 Note </label>
														<textarea class="form-control" name="programNo1Note"></textarea>
													</div>
													<div class="form-group col-md-12">
														<div class="float-right">
															<button <?= $programNo1Screenshot!='' ? 'disabled' : '' ?> class="btn btn-custom" type="button" name="submitProgram1" onclick="saveDataForm('formDreamPro1', 'submitProgram1')" id="submitProgram1"><i class="mdi mdi-upload"></i> Update </button>
														</div>
													</div>
												</div>
											</form>
										</div>
										<div class="col-md-6" style="border-left: 2px solid black;">
											<form id="formDreamPro2" enctype="multipart/form-data" class="parsley-examples">
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
														<div class="agreement-container" data-agreement-id="12">
															<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
															<div class="d-flex justify-content-center">
																<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
																<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%">
															</div>
															<input type="file" name="programNo2Screenshot[]" required="required" id="uploadedFiles12" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>
													</div>
													<div class="form-group col-md-6">
														<label class="form-label">Date <span class="text-danger">*</span></label>
														<input type="date" name="programNo2Date" class="form-control" autocomplete="off" required="required" value="<?php echo date('Y-m-d');?>">
													</div>
													<div class="col-md-12">
														<label class="form-label">Program 2 Note </label>
														<textarea class="form-control" name="programNo2Note"></textarea>
													</div>
													<div class="form-group col-md-12">
														<div class="float-right">
															<button <?= $programNo2Screenshot!='' ? 'disabled' : '' ?> class="btn btn-custom" type="button" name="submitProgram2" onclick="saveDataForm('formDreamPro2', 'submitProgram2')" id="submitProgram2"><i class="mdi mdi-upload"></i> Update </button>
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
						<?php if ($uniName == "CaFoscari University of Venice (FV)" && ($appRow=="bachelor" || $appRow=="master") ) { ?>
						<h3>CaFoscari University of Venice Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/Foscari updated 1080p.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/Foscari updated 1080p.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
						<?php }elseif ( $uniName == "University of Siena (US)" && ($appRow=="bachelor" || $appRow=="master")) { ?>
						<h3>University of Siena Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/siena video Updated.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/siena video Updated.mp4" type="video/ogg">
							Your browser does not support HTML video.
						</video>
						<?php }elseif ( $uniName == "University of Padua (PDU)" && ($appRow=="bachelor" || $appRow=="master")){ ?>

						<h3>University of Padua Process</h3>
						<video width="500" height="400" controls>
							<source src="../italy-videos/admission-video/padua video 1080P.mp4" type="video/mp4">
							<source src="../italy-videos/admission-video/padua video 1080P.mp4" type="video/ogg">
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

<!-- Requirment info Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalAdditional" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalAddTitle" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalAdditional">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
	// Save Apply Data using AJAX
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
				url: "models/_dreamApplyControllersState.php",
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
	// documents Attestation link copy
	function copyLink() {
		var linkCopy = $("#guideUni").val();
		if (linkCopy=='CaFoscari') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=CaFoscari&guiDRafiA05S=CaFoscari`;
		}
		else if (linkCopy=='Sapienza') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Sapienza&guiDRafiA05S=Sapienza`;
		}
		else if (linkCopy=='Politecnica') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Politecnica&guiDRafiA05S=Politecnica`;
		}
		else if (linkCopy=='Bologna') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Bologna&guiDRafiA05S=Bologna`;
		}
		else if (linkCopy=='Campania') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Messina') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Messina&guiDRafiA05S=Messina`;
		}
		else if (linkCopy=='Napoli') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Padua') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Padua&guiDRafiA05S=Padua`;
		}
		else if (linkCopy=='Palermo') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Pavia') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Pavia&guiDRafiA05S=Pavia`;
		}
		else if (linkCopy=='Perugia') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Siena') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Siena&guiDRafiA05S=Siena`;
		}
		else if (linkCopy=='Trieste') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Trieste&guiDRafiA05S=Trieste`;
		}
		else if (linkCopy=='Turin') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Turin&guiDRafiA05S=Turin`;
		}
		else if (linkCopy=='Cassino') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Cassino&guiDRafiA05S=Cassino`;
		}
		else if (linkCopy=='Bergamo') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Ferrara') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Ferrara&guiDRafiA05S=Ferrara`;
		}
		else if (linkCopy=='Florence') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Florence&guiDRafiA05S=Florence`;
		}
		else if (linkCopy=='Foggia') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Genevo') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Pisa') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Pisa&guiDRafiA05S=Pisa`;
		}
		else if (linkCopy=='Salerno') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Verona') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Trento') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Trento&guiDRafiA05S=Trento`;
		}
		else if (linkCopy=='Tuscia') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Laquia') {
			var message = `Universities processing time approx. 6-8 weeks (working days)

If the number of applications is high, the response can be delayed

please stay active on your email and when you'll receive any response from the university then inform us`;
		}
		else if (linkCopy=='Parma') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Parma&guiDRafiA05S=Parma`;
		}
		else if (linkCopy=='MilanoBiccoca') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=MilanoBiccoca&guiDRafiA05S=MilanoBiccoca`;
		}
		else if (linkCopy=='Unicamillus') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Unicamillus&guiDRafiA05S=Unicamillus`;
		}
		else if (linkCopy=='Camerino') {
			var message = `https://info.wslcms.com/application-guideline?neHinA0vER06=Camerino&guiDRafiA05S=Camerino`;
		}
		
		navigator.clipboard.writeText(message).then(function() {
			var linktoast = document.getElementById("showToastLink");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
	function viewGuides() {
		var guideUni = $("#guideUni").val();
		$.ajax({
			type: "POST",
			url: "models/applicationGuideline.php",
			data:'guideUniName='+guideUni,
			success: function(data){
				$(".showModalTitle").html('Application Guidelines');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$("#showModalClient").on('shown.bs.modal', function () {
					let audioElements = $(this).find("audio");
					audioElements.each(function () {
						this.playbackRate = 1.5;
					});
				});
			}
		});
	}
</script>
<script type="text/javascript">

	document.addEventListener("DOMContentLoaded", function () {
		const checkboxes = document.querySelectorAll('input[type="checkbox"]');
		const updateButton = document.getElementById("subAdditional");
		// Function to check if all checkboxes are selected
		function checkAllSelected() {
			updateButton.disabled = ![...checkboxes].every(checkbox => checkbox.checked);
		}
		// Attach change event to each checkbox
		checkboxes.forEach(checkbox => {
			checkbox.addEventListener("change", checkAllSelected);
		});
		// Initial check
		checkAllSelected();
	});

	// Add note to Admission head
	function myPersonalReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkPersonalNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
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
				$(".showModalTitle").html('Personal Note');
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
	// Additional Activities Required by the University
	function additionalActivities(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'additionalNoteActivities='+id,
			success: function(data){
				$(".showModalAddTitle").html('Additional Activities');
				$(".showModalAdditional").html(data);
				$("#showModalAdditional").modal('show');
				$('#showModalAdditional').off('shown.bs.modal').on('shown.bs.modal', function () {
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
	function delInformToClient(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: 'informToClientDel='+id,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delChangesHead(id) {
		var id = id;
		var programAppliedID = $("#programAppliedID").val();
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				changesHeadDel:id,
				programAppliedID:programAppliedID,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delApproved(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				approvedHeadDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delFeePaid(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				feePaidHeadDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delProof(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				proofHeadDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delInformEnrollForm(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				informEnrollHeadDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	function delPayEnrollForm(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/deleteStepState.php",
			data: {
				payEnrollFormHeadDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
</script>