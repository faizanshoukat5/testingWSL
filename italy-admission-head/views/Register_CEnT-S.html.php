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
<div class="card">
	<div class="card-body">
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

		$clientTolcinfoScreenShot = $row['italy_tolc_client_info_screenshot'];
		$clientTolcInfoNote = $row['italy_tolc_client_info_note'];

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

		$tolcPracticeDate = $row['italy_tolc_practice_date'];
		$tolcPracticeNote = $row['italy_tolc_practice_note'];

		$tolcBookedDate = $row['italy_tolc_booked_date'];
		$tolcBookedNote = $row['italy_tolc_booked_note'];
		
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
		$testFee = ($testType == 'TOLC') ? 30 : 55;
		$specialUnis = ['University of Padua (PDU)', 'CaFoscari University of Venice (FV)', 'University of Milano Bicocca (MLB)'];
		?>
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
			<div class="col-md-12">
				<div class="float-right">
					<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
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
								<span id="step1Title" style=" <?php if ($proTolcStep1==1){?> color: green; <?php }elseif ($proTolcStep1==2){?>color:red;<?php } ?>"><b>Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" name="radioStep1" <?php if ($proTolcStep1==1){?> checked <?php }?> disabled="" >
									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" name="radioStep1" <?php if ($proTolcStep1==2){?> checked <?php }?> disabled="" >
									<label for="noIDStep1"> No </label>
								</div>
							</h5>
							<p>
								Open the documents folder and log in to Gmail using the login details at serial number 15. </a>
							</p>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h5>
								<span id="step2Title" style=" <?php if ($proTolcStep2==1){?> color: green; <?php }elseif ($proTolcStep2==2) { ?> color: red;<?php } ?>"><b> Create a CISIA  account  ( <?= $testType ?> Test Registration )</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" name="radioStep2" <?php if ($proTolcStep2==1){?> checked <?php }?> disabled="">
									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" name="radioStep2" <?php if ($proTolcStep2==2){?> checked <?php }?> disabled="">
									<label for="noIDStep2"> No </label>
								</div>
								<?php if(!in_array($uniName, $specialUnis)){ ?>
								<a href="../italy-videos/tolc test video/01 Tolc Registration/TOLC Registration Video Step 1.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> TOLC Test Video Registration</a>
								<?php } ?>
							</h5>
							<p> Create an account through the link below and register <?= $testType ?> test in the CISIA Portal. A video on how to register for a <?= $testType ?> test is attached for your help. <a href="https://www.cisiaonline.it/area-tematica-tolc-cisia/home-tolc-generale/" class="btn btn-primary" target="blank"><b>Create CISIA Account Here</b></a></p>

							<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUsername;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="accountPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountPassword;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountLink;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
										<input type="file" name="accountScreenShot[]" class="form-control" autocomplete="off" disabled="" multiple="">
										<?php 
										$fileMulti = explode(',', $accountScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
										<?php } ?>
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
							<h5>
								<span id="step2Title" style=" <?php if ($proTolcStep3==1){?> color: green; <?php }elseif ($proTolcStep3==2) { ?> color: red;<?php } ?>"><b>Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" name="radioStep3" <?php if ($proTolcStep3==1){?> checked <?php }?> disabled="">
									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" name="radioStep3" <?php if ($proTolcStep3==2){?> checked <?php }?> disabled="">
									<label for="noIDStep3"> No </label>
								</div>
							</h5>
							<p> The student will receive an email from the CISIA. Activate the link provided in the email, change the password, and save the updated password in the tab.</p>

							<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="accountUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $accountUsername;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="accountPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $accountPassword;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="accountLink" class="form-control" required="required" autocomplete="off" value="<?php echo $accountLink;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
										<input type="file" name="accountScreenShot[]" class="form-control" autocomplete="off" disabled="" multiple="">
										<?php 
										$fileMulti = explode(',', $accountScreenShot);
										foreach ($fileMulti as $fileName) {
										?>
										<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
										<?php } ?>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					<!-- step 4 -->
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 04 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5>
								<span style="<?php if ($clientTolcinfoScreenShot!=''){?> color: green; <?php }elseif ($clientTolcinfoScreenShot=='') { ?> color: red;<?php } ?>"><b> Client will Book a date for <?= $testType ?> Test</b> </span>
								<?php if ($infoTolcStatus=='0' && $appliedTolcStatus=='3') { ?>
									<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Inform To Client </span>
								<?php } ?>
							</h5>
							<p>Msg / Call the client and guide him about how to book a <?= $testType ?> Exam test date. Please share the login details, link, and video with the client and guide him properly.</p>
							<div class="row">
								<div class="col-md-6">
									<div class="alert bg-dark text-warning">
										<p>Name: <strong><?php echo ucwords($clientName);?></strong> </p>
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
										$fileMulti = explode(',', $clientTolcinfoScreenShot);
										foreach ($fileMulti as $fileName) { ?>
											<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
										<?php } ?></td>
										<td class="breakTD"> <?php echo $clientTolcInfoNote;?></td>
									</tr>
								</tbody>
							</table>
							<form id="formInfoData" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">Inform to Client WhatApp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="clientTolcinfoScreenShot[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-8">
										<label class="form-label">Note</label>
										<textarea name="clientTolcInfoNote" class="form-control"><?php echo $clientTolcInfoNote;?></textarea>
									</div>
								</div>
								<?php if(!in_array($uniName, $specialUnis)){ ?>
									<a href="../italy-videos/tolc test video/02 Tolc Booking/TOLC Booking  Step 1.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Client to Book Date Step 1</a>
									<a href="../italy-videos/tolc test video/02 Tolc Booking/TOLC Booking  Step 2.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Client to Book Date Step 2</a>
									<a href="../italy-videos/tolc test video/02 Tolc Booking/pic.PNG" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-image"></i> Tolc Booking Image</a>
								<?php }else{ ?>
									<h5>CEnT-S Test Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=cents0Test&Vo25YQ1tYS=cents0Test" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=cents0Test&Vo25YQ1tYS=cents0Test</a> </h5>
								<?php } ?>
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" type="button" name="subTolcinfoClient" onclick="saveDataForm('formInfoData', 'subTolcinfoClient')" id="subTolcinfoClient" <?php echo ($clientTolcinfoScreenShot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Inform to Client </button>
									</div>
								</div>
							</form>
						</fieldset>
					</div>
					
					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 05 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5><span style="<?php if ($practiceVideoScreenShot!=''){?> color: green; <?php }elseif ($testDateScreenShot!='' || $feeProofScreenShot!='') { ?> color: red;<?php } ?>"><b> The client will Book the <?= $testType ?> test Date & pay the <?= $testFee ?> Euro <?= $testType ?> Test fee after that, we will share practice Test Videos</b></span></h5>
							<h5>Book the date and pay the <?= $testType ?> test fee</h5>
							<ul>
								<li>
									The client will inform us once he has booked the date and pay the <?= $testFee ?> euro <?= $testType ?> Test fee. The date he booked needs to be updated on our portal.
								</li>
							</ul>
							<!-- <h5>Share practice test video</h5>
							<ul>
								<li>
									The client must take a practice test the day before the test begins. Once the client books the test date, please share the video explaining how to attempt the practice test with the client.
								</li>
							</ul> -->

							<div class="row">
								<div class="col-md-6">
									<div class="alert bg-dark text-warning">
										<p>Name: <strong><?php echo ucwords($clientName);?></strong> </p>
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
							<ul class="nav nav-tabs">
								<?php if ($testDateScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcDate" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Date</span>
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
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Fee Paid </span>
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

								<!-- <?php if ($practiceVideoScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcPractice" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Sent <?= $testType ?> Test Practice Video </span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#tolcPractice" data-toggle="tab" aria-expanded="true" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Sent <?= $testType ?> Test Practice Video </span>
									</a>
								</li>
								<?php } ?> -->
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="tolcDate">
									<div class="row">
										<div class="form-group col-md-6">
											<label class="form-label">Client Practice <?= $testType ?> Test Date <span class="text-danger">*</span></label>
											<input type="date" name="" class="form-control" required="required" value="<?php echo $tolcPracticeDate;?>" onclick="fillPracticeDate()" id="practicDate">
										</div>
										<div class="form-group col-md-6">
											<label class="form-label">Client <?= $testType ?> Test Date <span class="text-danger">*</span></label>
											<input type="date" name="" class="form-control" required="required" value="<?php echo $tolcBookedDate;?>" onclick="fillTolcDate()" id="tolcBookedDate">
										</div>
									</div>

									<form id="formTestDate" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="2">
													<label class="form-label">Client sent us a test date ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="testDateScreenShot[]" required="required" id="uploadedFiles2" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($testDateScreenShot!=''){
												$fileMulti = explode(',', $testDateScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="testDateNote" class="form-control"><?php echo $testDateNote;?></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subTolcdate" onclick="saveDataForm('formTestDate', 'subTolcdate')" id="subTolcdate" <?php echo ($testDateScreenShot!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="tolcFee">
									<form id="formFeePaid" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="3">
													<label class="form-label">Client paid the fee proof ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="feeProofScreenShot[]" required="required" id="uploadedFiles3" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($feeProofScreenShot!=''){
												$fileMulti = explode(',', $feeProofScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="feeProofNote" class="form-control"><?php echo $feeProofNote;?></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subTolcFee" onclick="saveDataForm('formFeePaid', 'subTolcFee')" id="subTolcFee" <?php echo ($feeProofScreenShot!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="tolcPractice">
									<form id="formTestVideo" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="4">
													<label class="form-label">We sent the practice test video ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="practiceVideoScreenShot[]" required="required" id="uploadedFiles4" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($practiceVideoScreenShot!=''){
												$fileMulti = explode(',', $practiceVideoScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="practiceNote" class="form-control"><?php echo $practiceNote?></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subTolcPractice" onclick="saveDataForm('formTestVideo', 'subTolcPractice')" id="subTolcPractice" <?php echo ($practiceVideoScreenShot!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>

							<!-- <div class="mt-2">
								<a href="../italy-videos/tolc test video/03 Practice Area Registration/practice area registration.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Practice Area Registration</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/1 Practice Area Login.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Practice Area Login</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/2 Seb app Download.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Practice Area Seb App Download</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/3 Seb app open.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Practice Area Seb App Open</a>
								<a href="../italy-videos/tolc test video/04 Practice Area Login/4 Practice Test.mp4" class="btn btn-primary mb-2" target="blank"><i class="mdi mdi-video"></i> Video For Practice Area Practice Test</a>
							</div> -->
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-head">
							<legend class="scheduler-border-head">
								Step: 06 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h5><span style=""><b>If the Client passes the test</b></span></h5>
							<p>We will start the admission process if the client passes the <?= $testType ?> test. The client will provide us a <?= $testType ?> test result.</p>
							<div class="row">
								<div class="col-md-6">
									<div class="alert bg-dark text-warning">
										<p>Name: <strong><?php echo ucwords($clientName);?></strong> </p>
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
							<ul class="nav nav-tabs">
								<?php if ($passTolcScreenShot!='') { ?>
								<li class="nav-item">
									<a href="#tolcPass" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Pass</span>
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
										<span class="d-none d-sm-block text-success"><?= $testType ?> Test Fails </span>
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
									<form id="formTestPass" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="5">
													<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="passTolcScreenShot[]" required="required" id="uploadedFiles5" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($passTolcScreenShot!=''){
												$fileMulti = explode(',', $passTolcScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="passTolcNote" class="form-control"><?php echo $passTolcNote;?></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subTolcPass" onclick="saveDataForm('formTestPass', 'subTolcPass')" id="subTolcPass" <?php echo ($passTolcScreenShot!='' || $failTolcScreenShot!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="tolcFails">
									<form id="formTestFail" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="6">
													<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="failTolcScreenShot[]" required="required" id="uploadedFiles6" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php 
												if($failTolcScreenShot!=''){
												$fileMulti = explode(',', $failTolcScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="failTolcNote" class="form-control"><?php echo $failTolcNote;?></textarea>
											</div>
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subTolcFail" onclick="saveDataForm('formTestFail', 'subTolcFail')" id="subTolcFail" <?php echo ($passTolcScreenShot!='' || $failTolcScreenShot!='') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
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

<!-- Tolc Date Practice Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="TolcModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myLargeModalLabel">Client Tolc Test Practic Date</h4>
			</div>
			<div class="modal-body TolcModalClient">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						Tolc Test Practic Date <span class="text-danger">*</span>
					</legend>
					<form id="formTOLCDate" enctype="multipart/form-data" class="parsley-examples">
						<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
						<div class="row">
							<div class="form-group col-md-6">
								<label class="form-label">Practice Date <span class="text-danger">*</span></label>
								<input type="date" name="tolcPracticeDate" class="form-control" autocomplete="off" required="required" id="tolcPracticeDate" value="<?php echo $tolcPracticeDate;?>">
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Note</label>
								<textarea name="tolcPracticeNote" class="form-control"><?php echo $tolcPracticeNote;?></textarea>
							</div>
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-custom" type="button" name="subTolcPracticeDate" onclick="saveDataForm('formTOLCDate', 'subTolcPracticeDate')" id="subTolcPracticeDate" <?php echo ($tolcPracticeDate!='0000-00-00') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
								</div>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Tolc Date Practice Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="TolcBookedModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myLargeModalLabel">Client Tolc Test Date</h4>
			</div>
			<div class="modal-body TolcBookedModalClient">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						Tolc Test Date <span class="text-danger">*</span>
					</legend>
					<form id="formTolcBook" enctype="multipart/form-data" class="parsley-examples">
						<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
						<div class="row">
							<div class="form-group col-md-6">
								<label class="form-label"> Date <span class="text-danger">*</span></label>
								<input type="date" name="tolcBookedDate" class="form-control" autocomplete="off" required="required" id="tolcTestBookedDate" value="<?php echo $tolcBookedDate;?>">
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Note</label>
								<textarea name="tolcBookedNote" class="form-control"><?php echo $tolcBookedNote;?></textarea>
							</div>
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-custom" type="button" name="subTolcBookedDate" onclick="saveDataForm('formTolcBook', 'subTolcBookedDate')" id="subTolcBookedDate" <?php echo ($tolcBookedDate!='0000-00-00') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Save </button>
								</div>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
				url: "models/_registerCEnt-SControllersState.php",
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
	function fillPracticeDate() {
		var practicDate = $("#practicDate").val();
		$("#TolcModalClient").modal('show');
		$("#tolcPracticeDate").val(practicDate);
	}
	function fillTolcDate() {
		var tolcBookedDate = $("#tolcBookedDate").val();
		$("#TolcBookedModalClient").modal('show');
		$("#tolcTestBookedDate").val(tolcBookedDate);
	}
</script>