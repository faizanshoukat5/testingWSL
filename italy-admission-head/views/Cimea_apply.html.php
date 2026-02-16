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

$sops_status = $row['italy_sops_status'];


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
						<input type="hidden" name="" id="reqUniDegree" value="<?php echo $clientDegree;?>">
						<button style="font-size: 1rem;" class="btn btn-dark mb-2 text-warning" onclick="requirementsModal();"><b>Click Here to View <?php echo $uniName;?> University's Info & Requirements</b></button>
					</div>
						
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 01 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step1Title" style=" <?php if ($cimeaStep1==1){?> color: green; <?php }elseif ($cimeaStep1==2){?>color:red;<?php } ?>"><b> Log in to the client's Gmail account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep1" value="1" disabled="" name="radioStep1" onclick="firstYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep1 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep1"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep1" value="2" disabled="" name="radioStep1" onclick="firstNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep1 == 2) ? 'checked' : '';?>>
									<label for="noIDStep1"> No </label>
								</div>
							</h4>
							<p>Open the documents folder and log in to Gmail using the login details at serial number 15. </p>	
						</fieldset>
					</div>
					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 02 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step2Title" style=" <?php if ($cimeaStep2==1){?> color: green; <?php }elseif ($cimeaStep2==2) { ?> color: red;<?php } ?>"><b> Create a one-time account</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep2" value="1" disabled="" name="radioStep2" onclick="secYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep2 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep2"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep2" value="2" disabled="" name="radioStep2" onclick="secNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep2 == 2) ? 'checked' : '';?>>
									<label for="noIDStep2"> No </label>
								</div>
							</h4>
							<p>Create the account through the link below: (Direct Pre-Enrollment Portal) <a href="https://mywallet.cimea-diplome.it/#/auth/register" class="btn btn-primary" target="_blank"><b>Create Account Here</b></a></p>
							<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUsername;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Password <span class="text-danger">*</span></label>
										<input type="text" name="cimeaPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaPassword;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="cimeaLink" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaLink;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">ScreenShot</label>
										<input type="file" name="cimeaScreenShot" class="form-control" autocomplete="off" readonly="">
										<?php 
										$fileMulti = explode(',', $cimeaScreenShot);
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
							<h4>
								<span id="step3Title" style=" <?php if ($cimeaStep3==1){?> color: green; <?php }elseif ($cimeaStep3==2) { ?> color: red;<?php } ?>"><b> Save the Updated password</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep3" value="1" disabled="" name="radioStep3" onclick="thirdYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep3 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep3"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep3" value="2" disabled="" name="radioStep3" onclick="thirdNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep3 == 2) ? 'checked' : '';?>>
									<label for="noIDStep3"> No </label>
								</div>
							</h4>
							<p>The student will receive an email from the CIMEA Portal. Activate the link provided in the email, change the password, and save the updated password in the tab.</p>

							<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="form-group col-md-3">
										<label class="form-label">Username / Email <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpUsername" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpUsername;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated Password <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpPassword" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpPassword;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Link <span class="text-danger">*</span></label>
										<input type="text" name="cimeaUpLink" class="form-control" required="required" autocomplete="off" value="<?php echo $cimeaUpLink;?>" readonly="">
									</div>
									<div class="form-group col-md-3">
										<label class="form-label">Updated ScreenShot</label>
										<input type="file" name="cimeaUpScreenShot" class="form-control" autocomplete="off" readonly="">
										<?php 
										$fileMulti = explode(',', $cimeaUpScreenShot);
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
								Step: 04 <span class="text-purple">* (Processing Team Task)</span>
							</legend>
							<h4>
								<span id="step4Title" style=" <?php if ($cimeaStep4==1){?> color: green; <?php }elseif ($cimeaStep4==2) { ?> color: red;<?php } ?>"><b> Fill out the CIMEA Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep4" value="1" disabled="" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep4 == 1) ? 'checked' : '';?>>

									<label for="yesIDStep4"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep4" value="2" disabled="" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep4 == 2) ? 'checked' : '';?>>
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
								<span style="<?php if ($cimeafeePayClient!=''){?> color: green; <?php }elseif ($cimeafeePayClient=='') { ?> color: red;<?php } ?>"> <b> Inform the client to recheck the application (Pay the Cimea fee) </b> </span>
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
							<ul class="nav nav-tabs">
								<?php 
								if ($cimeaclientInformScreenshot=='') {
								?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-warning">Inform the client to recheck <br> the Application
										<?php if ($cimeainfoClientStatus=='0' && $cimeaappliedStatus=='5') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Inform To Client </span>
										<?php } ?>
										</span>
									</a>
								</li>
								<?php }elseif ($cimeaclientInformScreenshot!=''){ ?>
								<li class="nav-item">
									<a href="#uploadScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess active">
										<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
										<span class="d-none d-sm-block text-success">Inform the client to recheck <br> the Application</span>
									</a>
								</li>
								<?php } ?>

								<?php
								$changingStatus=''; 
								$client_query = "SELECT changing_status from italy_clients_programs_checking".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND type_apply='cimea' AND changing_status='head' AND programs_id='".$programAppliedID."' AND entry_by='".$_SESSION['user_id']."' ORDER BY program_italy_id DESC LIMIT 1 ";
								$client_query_ex = mysqli_query($con,$client_query);
								if ($client_query_ex && mysqli_num_rows($client_query_ex) > 0){
									$row = mysqli_fetch_assoc($client_query_ex);
									$changingStatus = $row['changing_status'];
								}
								if ($changingStatus=='head' || $cimeaokScreenshot!='') {
								?>
								<li class="nav-item">
									<a href="#changesRequired" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">Client's Request for Changes in <br> the Application 
										<?php if ($cimeainfoClientStatus=='2' && $cimeaappliedStatus=='6') { ?>
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
										<?php if ($cimeainfoClientStatus=='2' && $cimeaappliedStatus=='6') { ?>
										<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Changes Completed </span>
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
										<span class="d-none d-sm-block text-success">Application Approved by <br>the Client </span>
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
								
								<?php if($cimeafeePayClient!=''){?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link navSuccess">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-success">The client has paid the application <br>fee.</span>
									</a>
								</li>
								<?php }else{ ?>
								<li class="nav-item">
									<a href="#feeGuides" data-toggle="tab" aria-expanded="false" class="nav-link">
										<span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
										<span class="d-none d-sm-block text-warning">The client has paid the application <br>fee.</span>
									</a>
								</li>
								<?php } ?>
							</ul>
							<div class="tab-content">
								<div class="tab-pane show active" id="uploadScreenshot">
									<div class="row">
										<div class="col-md-12">
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
										</div>
										<div class="col-md-12">
											<h4>Processing Team</h4>
										</div>
										<div class="col-md-12">
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
														<td class="breakTD"><?php echo $cimeaUpUsername;?></td>
														<td class="breakTD"><?php echo $cimeaUpPassword;?></td>
														<td class="breakTD"><?php echo $cimeaUpLink;?></td>
														<td class="breakTD"> <?php 
															$fileMulti = explode(',', $cimeainformScreenshot);
															foreach ($fileMulti as $fileName) {
															?>
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
															<?php } ?>
														</td>
														<td class="breakTD"><?php echo $cimeainformNote;?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<hr width="100%">
									<form id="formCimeaInfo" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-4">
												<div class="agreement-container" data-agreement-id="1">
													<label class="form-label">Inform to Client WhatApp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="cimeaclientInformScreenshot[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
												<?php
												if($cimeaclientInformScreenshot!=''){ 
												$fileMulti = explode(',', $cimeaclientInformScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } } ?>
											</div>
											<div class="form-group col-md-8">
												<label class="form-label">Note</label>
												<textarea name="cimeaclientInformNote" class="form-control"><?php echo $cimeaclientInformNote;?></textarea>
											</div>
											
										</div>
										<div class="col-md-12">
											<div class="float-right">
												<button class="btn btn-custom" type="button" name="subCimeainfoClient" onclick="saveDataForm('formCimeaInfo', 'subCimeainfoClient')" id="subCimeainfoClient" <?php echo ($cimeaokScreenshot!='' || $changingStatus=='head') ? 'disabled' : '';?> ><i class="mdi mdi-upload"></i> Inform to Client </button>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane " id="changesRequired">
									<div class="row">
										<div class="col-md-12">
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
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
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
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
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
											<form id="formCimeaChanges" enctype="multipart/form-data" class="parsley-examples">
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
															<input type="file" name="changingScreenshot[]" required="required" id="uploadedFiles2" class="form-control" multiple style="display: none;">
															<div class="preview"></div>
														</div>

														<!-- <label class="form-label">Change Whatapp Screenshot <span class="text-danger">* (Select Multi Files)</span></label>
														<input type="file" name="changingScreenshot[]" class="form-control" autocomplete="off" required="required" multiple=""> -->
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
															<button class="btn btn-custom" type="button" name="subChangeCimeaDetails" onclick="saveDataForm('formCimeaChanges', 'subChangeCimeaDetails')" id="subChangeCimeaDetails" <?php echo ($cimeaokScreenshot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Send request for changes </button>
														</div>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="tab-pane " id="teamOk">
									<form id="formCimeaOk" enctype="multipart/form-data" class="parsley-examples">
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
															$fileMulti = explode(',', $cimeaokScreenshot);
															foreach ($fileMulti as $fileName) {
															?>
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
															<?php } ?></td>
															<td class="breakTD"><?php echo $cimeaokNote;?></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Approved Note</label>
												<textarea class="form-control" name="cimeaokNote"></textarea>
											</div>
											<div class="form-group col-md-6">
												<div class="agreement-container" data-agreement-id="4">
													<label class="form-label">Approved Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
													</div>
													<input type="file" name="cimeaokScreenshot[]" required="required" id="uploadedFiles4" class="form-control" multiple style="display: none;">
													<div class="preview"></div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subCimeaOk" onclick="saveDataForm('formCimeaOk', 'subCimeaOk')" id="subCimeaOk" <?php echo ($cimeaokScreenshot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Application Approved </button>
												</div>
											</div>
										</div>
									</form>
								</div>

								<div class="tab-pane" id="feeGuides">
									<form id="formCimeaFeeGuides" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="col-md-12">
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
															<p>Degree:<strong><?php foreach ($appliedChanging as $appRow){echo ucwords($appRow);};?></strong></p>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-12">
												<h4>Cimea Fee Payment:</h4>
												<ul>
													<li>
														After rechecking the CIMEA application it's time to pay the CIMEA fee. The <b>normal CIMEA</b> fee is <b>300 euros</b> and <b>400 euros</b> for <b>urgent CIMEA</b>. Please message or call the client to explain the CIMEA fee and the card activation process. When the client pays the CIMEA fee, the CIMEA portal automatically updates the payment status. We will take the fee payment receipt from the client and upload it to our portal.
													</li>
												</ul>
											</div>
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
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
															<?php } ?></td>
															<td class="breakTD"><?php 
															$fileMulti = explode(',', $cimeafeePayClient);
															foreach ($fileMulti as $fileName) {
															?>
															<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
															<?php } ?></td>
															<td class="breakTD"><?php echo $cimeapayFeeNote;?></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="form-group col-md-6">
												<label class="form-label">Inform to Pay Fee Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
												<input type="file" name="cimeainfoPayFee[]" class="form-control" autocomplete="off" multiple="">
											</div>
											<div class="form-group col-md-6">
												<label class="form-label">Fee Paid receipt By Client ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
												<input type="file" name="cimeafeePayClient[]" class="form-control" autocomplete="off" multiple="">
											</div>
											<div class="form-group col-md-12">
												<label class="form-label">Note</label>
												<textarea class="form-control" name="cimeapayFeeNote"><?php echo $cimeapayFeeNote;?> </textarea>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="float-right">
													<button class="btn btn-custom" type="button" name="subCimeaGuidFee" onclick="saveDataForm('formCimeaFeeGuides', 'subCimeaGuidFee')" id="subCimeaGuidFee" <?php echo ($cimeafeePayClient!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Fee Paid </button>
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
								<span id="step6Title" style="<?php if ($cimeaStep6==1){?> color: green; <?php }elseif ($cimeaStep6==2) { ?> color: red;<?php } ?>"><b> Submit the CIMEA  application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<div class="radio radio-success form-check-inline">
									<input type="radio" id="yesIDStep6" value="1" disabled="" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 1) ? 'checked' : '';?>>
									<label for="yesIDStep6"> Yes </label>
								</div>
								<div class="radio radio-danger form-check-inline">
									<input type="radio" id="noIDStep6" value="2" disabled="" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($cimeaStep6 == 2) ? 'checked' : '';?>>
									<label for="noIDStep6"> No </label>
								</div>
								<?php if (($cimeainfoClientStatus=='3' || $cimeainfoClientStatus=='5') && $cimeaappliedStatus=='7') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Application Applied </span>
								<?php }?>
							</h4>
							<p>When the client rechecks and approves the file, submit the application.</p>
							
							<div class="row">
								<div class="col-md-12">
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
								</div>
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Applied Screenshot</th>
												<th>Detail's Screenshot</th>
												<th>Note</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $cimeaappliedScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php 
												$fileMulti = explode(',', $cimeadetailsScreenshot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?></td>
												<td class="breakTD"><?php echo $cimeaappliedNote;?></td>
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
								Step: 07 <span class="text-purple">* (Admission Head Task)</span>
							</legend>
							<h4><span style="<?php if ($cimeaproofScreenshot!=''){?> color: green; <?php }elseif ($cimeaproofScreenshot=='') { ?> color: red;<?php } ?>"><b> Inform the client about the submission CIMEA application</b></span></h4>
							<p>Inform the client about the submission application with screenshot proof </p>

							<form id="formCimeaProof" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
								<div class="row">
									<div class="col-md-12">
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
													$fileMulti = explode(',', $cimeaproofScreenshot);
													foreach ($fileMulti as $fileName) {
													?>
													<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
													<?php } ?></td>
													<td class="breakTD"><?php echo $cimeaproofNote;?></td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="7">
											<label class="form-label">Inform to Client Proof Whatapp ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="cimeaproofScreenshot[]" required="required" id="uploadedFiles7" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
									</div>
									<div class="form-group col-md-8">
										<label class="form-label">Proof Note</label>
										<textarea class="form-control" name="cimeaproofNote"><?php echo $cimeaproofNote;?></textarea>
									</div>											
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subCimeaProof" onclick="saveDataForm('formCimeaProof', 'subCimeaProof')" id="subCimeaProof" <?php echo ($cimeaacceptedScreenshot!='' || $cimearejectedScreenshot!='') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
										</div>
									</div>
								</div>
							</form>
						</fieldset>
					</div>

					<div class="col-md-12">
						<fieldset class="scheduler-border-team">
							<legend class="scheduler-border-team">
								Step: 08 <span class="text-purple">* (Processing Team & Admission Head Task)</span>
							</legend>
							<h4><span style="<?php if ($cimeaacceptedScreenshot!=''){?> color: green; <?php }elseif ($cimearejectedScreenshot!='') { ?> color: red;<?php } ?>"><b> Waiting for a response</b></span></h4>
							<p>waiting for a response client will receive the CIMEA certificate within 1 to 2 months</p>
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
									<form id="formCimeaAccepted" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-6">
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
													<button class="btn btn-custom" type="button" name="subCimeaAccepted" onclick="saveDataForm('formCimeaAccepted', 'subCimeaAccepted')" id="subCimeaAccepted" <?php echo ($cimeaacceptedScreenshot!='' || $cimearejectedScreenshot=='team') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="tab-pane" id="cimearejectedScreenshot">
									<form id="formCimeaRejected" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="form-group col-md-6">
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
													<button class="btn btn-custom" type="button" name="subCimeaRejected" onclick="saveDataForm('formCimeaRejected', 'subCimeaRejected')" id="subCimeaRejected" <?php echo ($cimeaacceptedScreenshot!='' || $cimearejectedScreenshot=='team') ? 'disabled' : '';?>><i class="mdi mdi-upload"></i> Submit </button>
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
				url: "models/_cimeaApplyControllersState.php",
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
</script>