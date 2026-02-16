<?php 
$programAppliedID = $_GET['program-applied-id'];
?>
<style type="text/css">
	p{margin-bottom: 0.3rem; font-size: 1rem;}
	h5{margin-bottom: 0.3rem;}

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
$degreeName = $row['italy_client_degree'];

$proTolcStep1 = $row['italy_tolc_step1'];
$proTolcStep2 = $row['italy_tolc_step2'];

$accountUsername = $row['italy_tolc_account_username'];
$accountPassword = $row['italy_tolc_account_password'];
$accountLink = $row['italy_tolc_account_link'];
$accountScreenShot = $row['italy_tolc_account_screenshot'];

$proTolcStep3 = $row['italy_tolc_step3'];
$accountUpUsername = $row['italy_tolc_accountup_username'];
$accountUpPassword = $row['italy_tolc_accountup_password'];
$accountUpLink = $row['italy_tolc_accountup_link'];
$accountUpScreenShot = $row['italy_tolc_accountup_screenshot'];

$clientTolcInform = $row['italy_tolc_client_info_screenshot'];
$clientTolcinfoNote = $row['italy_tolc_client_info_note'];

$testDateScreenShot = $row['italy_tolc_date_screenshot'];
$testDateNote = $row['italy_tolc_date_note'];
$feeProofScreenShot = $row['italy_tolc_fee_proof_screenshot'];
$feeProofNote = $row['italy_tolc_fee_proof_note'];
$practiceVideoScreenShot = $row['italy_tolc_practic_video_screenshot'];
$practiceNote = $row['italy_tolc_practic_note'];

$passTolcScreenShot = $row['italy_tolc_pass_screenshot'];
$passTolcNote = $row['italy_tolc_pass_note'];
$failTolcScreenShot = $row['italy_tolc_fail_screenshot'];
$failTolcNote = $row['italy_tolc_fail_note'];

$appliedTolcStatus = $row['italy_tolc_applied_status'];
$infoTolcStatus = $row['italy_tolc_info_status'];

$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
$client_query_ex = mysqli_query($con,$client_query);
$rowCl = mysqli_fetch_assoc($client_query_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);
$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);
?>
<?php
$testType = 'CEnT-S';
$testFee = 55;
$specialUnis = ['University of Padua (PDU)', 'CaFoscari University of Venice (FV)', 'University of Milano Bicocca (MLB)'];
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
											echo ($row['close'] == '0' || $row['italy_change_program_status'] == '1') ? "<del>$output</del>$changedProgramName" : ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
										} else {
											echo ($row['close'] == '0' || $row['italy_change_program_status'] == '1') ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
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
				</div>
			</div>
			<div class="col-md-12">
				<input type="hidden" name="" id="reqUniName" value="<?php echo $uniName;?>">
				<input type="hidden" name="" id="reqUniDegree" value="<?php echo $degreeName;?>">
				<button style="font-size: 1rem;" class="btn btn-dark mb-2 text-warning" onclick="requirementsModal();"><b>Click Here to View <?php echo $uniName;?> University's Info & Requirements</b></button>
			</div>
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 01 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h5>
								<span id="step1Title" style="<?php if ($proTolcStep1==1){?> color: green; <?php }elseif ($proTolcStep1==2){?>color:red;<?php } ?>"><b>Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep1 == 1) ? 'checked' : '';?> <?php echo ($proTolcStep2==1) ? 'disabled' : '';?> >
									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep1 == 2) ? 'checked' : '';?> <?php echo ($proTolcStep2==1) ? 'disabled' : '';?> >
									<label for="noIDStep1"> No </label>
								</div>
							</h5>
							<p>
								Open the documents folder and log in to Gmail using the login details at serial number 15. <a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&ifkv=ARpgrqfUjBTxI_xW0rdXEaj-_TZIpCROZqYPCSf-h8DH594fFkdSonIcOT1nwBMNqlaXMG0LnA-jWw&passive=1209600&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S-854746770%3A1727943663862879&ddm=1" target="_blank"><button class="btn btn-primary btn-sm">Gmail Login</button></a>
							</p>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h5>
								<span id="step2Title" style=" <?php if ($proTolcStep2==1){?> color: green; <?php }elseif ($proTolcStep2==2) { ?> color: red;<?php } ?>"><b>Create a CISIA  account  ( TOLC Test Registration )</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $proTolcStep2;?>" id="hiddenStep2">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep2 == 1) ? 'checked' : '';?> <?php echo ($proTolcStep2==1) ? 'disabled' : '';?> <?php echo ($proTolcStep1==0) ? 'disabled' : '';?>>
									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep2 == 2) ? 'checked' : '';?> <?php echo ($proTolcStep2==1) ? 'disabled' : '';?> <?php echo ($proTolcStep1==0) ? 'disabled' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
								<?php if(!in_array($uniName, $specialUnis)){ ?>
								<a href="../italy-videos/tolc test video/01 Tolc Registration/TOLC Registration Video Step 1.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> TOLC Test Video Registration</a>
								<?php } ?>
							</h5>
							<p> Create an account through the link below and register <?= $testType ?> test in the CISIA Portal. A video on how to register for a <?= $testType ?> test is attached for your help. <a href="https://www.cisiaonline.it/area-tematica-tolc-cisia/home-tolc-generale/" class="btn btn-primary" target="_blank"><b>Create CISIA Account Here</b></a></p>

							<form id="formLoginDetails" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<input type="hidden" name="updateClientID" value="<?php echo $clientID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUsername;?>" id="accountUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="accountPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountPassword;?>" id="accountPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountLink;?>" id="accountLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="accountScreenShot[]" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($accountScreenShot!=''){
										$fileMulti = explode(',', $accountScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subTolcAccDetails" onclick="saveDataForm('formLoginDetails', 'subTolcAccDetails')" id="subTolcAccDetails" <?php echo ($proTolcStep2==1) ? 'disabled' : '';?> <?php echo ($proTolcStep1==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
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
								<span id="step3Title" style="<?php if ($proTolcStep3==1){?> color: green; <?php }elseif ($proTolcStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php echo $proTolcStep3;?>" id="hiddenStep3">
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep3 == 1) ? 'checked' : '';?> <?php echo ($proTolcStep3==1) ? 'disabled' : '';?> <?php echo ($proTolcStep2==0) ? 'disabled' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($proTolcStep3 == 2) ? 'checked' : '';?> <?php echo ($proTolcStep3==1) ? 'disabled' : '';?> <?php echo ($proTolcStep2==0) ? 'disabled' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							<p>The student will receive an email from the CISIA. Activate the link provided in the email, change the password, and save the updated password in the tab.</p>
							<form id="formLoginUpd" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<input type="hidden" name="updateClientID" value="<?php echo $clientID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpUsername;?>" id="accountUpUsername">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="accountUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpPassword;?>" id="accountUpPassword">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUpLink;?>" id="accountUpLink">
									</div>
									<div class="form-group col-md-3">
										<div class="agreement-container" data-agreement-id="2">
											<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
											</div>
											<input type="file" name="accountUpScreenShot[]" id="uploadedFiles2" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($accountUpScreenShot!=''){
											$fileMulti = explode(',', $accountUpScreenShot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
										<?php } } ?>
									</div>
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subUpTolcDetails" onclick="saveDataForm('formLoginUpd', 'subUpTolcDetails')" id="subUpTolcDetails" <?php echo ($proTolcStep3==1) ? 'disabled' : '';?> <?php echo ($proTolcStep2==0) ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Save </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 04 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5>
								<span style="<?php if ($clientTolcInform!=''){?> color: green; <?php }elseif ($clientTolcInform=='') { ?> color: red;<?php } ?>"><b> Client will Book a date for <?= $testType ?> Test</b> </span>
								<?php if ($infoTolcStatus=='1' && $appliedTolcStatus=='3') { ?>
									<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Informed To Client </span>
								<?php } ?>
							</h5>
							<p>Msg / Call the client and guide him about how to book a  <?= $testType ?> Exam test date. Please share the login details, link, and video with the client and guide him properly.</p>
							<?php if(!in_array($uniName, $specialUnis)){ ?>
							<a href="../italy-videos/tolc test video/02 Tolc Booking/TOLC Booking  Step 1.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Client to Book Date Step 1</a>
							<a href="../italy-videos/tolc test video/02 Tolc Booking/TOLC Booking  Step 2.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Client to Book Date Step 2</a>
							<a href="../italy-videos/tolc test video/02 Tolc Booking/pic.PNG" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-image"></i> Tolc Booking Image</a>
							<?php } ?>
							<div class="row">
								<div class="col-md-12">
									<?php if ($clientTolcInform!='') { ?>
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
												$fileMulti = explode(',', $clientTolcInform);
												foreach ($fileMulti as $fileName) { ?>
													<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $clientTolcinfoNote;?></td>
											</tr>
										</tbody>
									</table>
									<?php } ?>
								</div>
							</div>
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 05 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5><span style="<?php if ($practiceVideoScreenShot!=''){?> color: green; <?php }elseif ($testDateScreenShot!='' || $feeProofScreenShot!='') { ?> color: red;<?php } ?>"><b> The client will Book the <?= $testType ?> test Date & pay the <?= $testFee ?> Euro <?= $testType ?> Test fee after that, we will share practice Test Videos</b></span>
							
							</h5>
							<h5>Book the date and pay the <?= $testType ?> test fee</h5>
							<ul>
								<li>
									The client will inform us once he has booked the date and pay the <?= $testFee ?> euro <?= $testType ?> Test fee. The date he booked needs to be updated on our portal.
								</li>
							</ul>
							<h5>Share practice test video</h5>
							<ul>
								<li>
									The client must take a practice test the day before the test begins. Once the client books the test date, please share the video explaining how to attempt the practice test with the client.
								</li>
							</ul>
							<ul class="nav nav-tabs">
								<?php if ($testDateScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcDate" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Date
										<?php if ($infoTolcStatus=='2' && $appliedTolcStatus=='3') { ?>
											<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Client sent us a test date </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcDate" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning"><?= $testType ?> Test Date</span>
									</a>
								</li>
								<?php } ?>
								<?php if ($feeProofScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcFee" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Fee Paid 
										<?php if ($infoTolcStatus=='3' && $appliedTolcStatus=='3') { ?>
											<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Client paid the fee </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcFee" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning"><?= $testType ?> Test Fee Paid </span>
									</a>
								</li>
								<?php } ?>

								<?php if ($practiceVideoScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcPractice" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Practice 
										<?php if ($infoTolcStatus=='4' && $appliedTolcStatus=='3') { ?>
											<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Practice test video Sent </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcPractice" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Sent <?= $testType ?> Test Practice Video </span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="tolcDate">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Client sent us a test date Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $testDateScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $testDateNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tolcFee">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Client paid the fee proof Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $feeProofScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $feeProofNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tolcPractice">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>We sent the practice test video Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $practiceVideoScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $practiceNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="mt-2">
								<a href="../italy-videos/tolc test video/03 Practice Area Registration/practice area registration.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Practice Area Registration</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/1 Practice Area Login.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Practice Area Login</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/2 Seb app Download.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Practice Area Seb App Download</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/3 Seb app open.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Practice Area Seb App Open</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/4 Practice Test.mp4" class="btn btn-primary mb-2" target="_blank"><i class="mdi mdi-video"></i> Video For Practice Area Practice Test</a>
							</div>
						</fieldset>
					</div>
					
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 06 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5><span style="<?php if ($passTolcScreenShot!=''){?> color: green; <?php }elseif ($failTolcScreenShot!='') { ?> color: red;<?php } ?>"><b> If the Client passes the test</b></span>
							</h5>
							<p>We will start the admission process if the client passes the TOLC test. The client will provide us a TOLC test result.</p>

							<ul class="nav nav-tabs">
								<?php if ($passTolcScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcPass" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Pass
										<?php if ($infoTolcStatus=='5' && $appliedTolcStatus=='3') { ?>
											<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" id="blink"> Client Pass <?= $testType ?> Test </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcPass" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning"><?= $testType ?> Test Pass</span>
									</a>
								</li>
								<?php } ?>
								<?php if ($failTolcScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcFails" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Fails 
										<?php if ($infoTolcStatus=='6' && $appliedTolcStatus=='3') { ?>
											<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Client fails the <?= $testType ?> test </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcFails" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning"><?= $testType ?> Test Fails </span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="tolcPass">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Client Pass <?= $testType ?> Test Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $passTolcScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $passTolcNote;?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tolcFails">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Client fails <?= $testType ?> test Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $failTolcScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $failTolcNote;?></td>
											</tr>
										</tbody>
									</table>
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
				url: "models/_registerCEnT-SControllersState.php",
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
				step1TolcType: type,
				uniTolcID: idUni,
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
		var accountUsername = $("#accountUsername").val();
		var accountPassword = $("#accountPassword").val();
		var accountLink = $("#accountLink").val();
		var yesIDStep2 = $("#yesIDStep2").val();
		var hiddenStep2 = $("#hiddenStep2").val();
		if (accountUsername=='' && accountPassword=='' && accountLink=='') {
			$("#accountUsername").css("border-color", "red");
			$("#accountPassword").css("border-color", "red");
			$("#accountLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername!='' && accountPassword=='' && accountLink=='') {
			$("#accountUsername").css("border-color", "");
			$("#accountPassword").css("border-color", "red");
			$("#accountLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername=='' && accountPassword!='' && accountLink=='') {
			$("#accountUsername").css("border-color", "red");
			$("#accountPassword").css("border-color", "");
			$("#accountLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername=='' && accountPassword=='' && accountLink!='') {
			$("#accountUsername").css("border-color", "red");
			$("#accountPassword").css("border-color", "red");
			$("#accountLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername!='' && accountPassword!='' && accountLink=='') {
			$("#accountUsername").css("border-color", "");
			$("#accountPassword").css("border-color", "");
			$("#accountLink").css("border-color", "red");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername!='' && accountPassword=='' && accountLink!='') {
			$("#accountUsername").css("border-color", "");
			$("#accountPassword").css("border-color", "red");
			$("#accountLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername=='' && accountPassword!='' && accountLink!='') {
			$("#accountUsername").css("border-color", "red");
			$("#accountPassword").css("border-color", "");
			$("#accountLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername!='' && accountPassword!='' && accountLink!='' && hiddenStep2=='0') {
			$("#accountUsername").css("border-color", "");
			$("#accountPassword").css("border-color", "");
			$("#accountLink").css("border-color", "");
			$("#yesIDStep2").prop("checked", false);
		}else if (accountUsername!='' && accountPassword!='' && accountLink!='' && hiddenStep2!='0') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "");
			document.getElementById("step2Title").style.color = "green";
		}
		subStep02(idUni, 1, accountUsername, accountPassword, accountLink, hiddenStep2);
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
					step2TolcType: type,
					uniTolcID: idUni,
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
		var accountUpUsername = $("#accountUpUsername").val();
		var accountUpPassword = $("#accountUpPassword").val();
		var accountUpLink = $("#accountUpLink").val();
		var yesIDStep3 = $("#yesIDStep3").val();
		var hiddenStep3 = $("#hiddenStep3").val();
		if (accountUpUsername=='' && accountUpPassword=='' && accountUpLink=='') {
			$("#accountUpUsername").css("border-color", "red");
			$("#accountUpPassword").css("border-color", "red");
			$("#accountUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername!='' && accountUpPassword=='' && accountUpLink=='') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "red");
			$("#accountUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername=='' && accountUpPassword!='' && accountUpLink=='') {
			$("#accountUpUsername").css("border-color", "red");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername=='' && accountUpPassword=='' && accountUpLink!='') {
			$("#accountUpUsername").css("border-color", "red");
			$("#accountUpPassword").css("border-color", "red");
			$("#accountUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername!='' && accountUpPassword!='' && accountUpLink=='') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "red");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername!='' && accountUpPassword=='' && accountUpLink!='') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "red");
			$("#accountUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername=='' && accountUpPassword!='' && accountUpLink!='') {
			$("#accountUpUsername").css("border-color", "red");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}else if (accountUpUsername!='' && accountUpPassword!='' && accountUpLink!='' && hiddenStep3=='0') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "");
			$("#yesIDStep3").prop("checked", false);
		}
		else if (accountUpUsername!='' && accountUpPassword!='' && accountUpLink!='' && hiddenStep3!='0') {
			$("#accountUpUsername").css("border-color", "");
			$("#accountUpPassword").css("border-color", "");
			$("#accountUpLink").css("border-color", "");
			document.getElementById("step3Title").style.color = "green";
		}
		subStep03(idUni, 1, accountUpUsername, accountUpPassword, accountUpLink, hiddenStep3);
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
					step3TolcType: type,
					uniTolcID: idUni,
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
</script>