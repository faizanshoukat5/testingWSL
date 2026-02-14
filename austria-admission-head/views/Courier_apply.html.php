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
$select_query="SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_pro_id='".$programAppliedID."' ";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);
$clientID = $row['aus_clients_id'];
$assignTo = $row['aus_program_assign'];
$uniName = $row['aus_university_name'];
$programName = $row['aus_program_name'];
$clientDegree = $row['aus_client_degree'];

$courierStep4 = $row['aus_courier_step4'];
$courierStep5 = $row['aus_courier_step5'];
$courierappliedScreenshot = $row['aus_courier_applied_screenshot'];
$courierprogramScreenshot = $row['aus_courier_program_screenshot'];
$courierdetailsScreenshot = $row['aus_courier_details_screenshot'];
$courierappliedNote = $row['aus_courier_applied_note'];

$courierproofScreenshot = $row['aus_courier_proof_screenshot'];
$courierproofNote = $row['aus_courier_proof_note'];

$programNo1Status = $row['aus_courier_program1_status'];
$programNo1Screenshot = $row['aus_courier_program1_screenshot'];
$programNo1Note = $row['aus_courier_program1_note'];
$programNo1Date = $row['aus_courier_program1_date'];

$programNo2Status = $row['aus_courier_program2_status'];
$programNo2Screenshot = $row['aus_courier_program2_screenshot'];
$programNo2Note = $row['aus_courier_program2_note'];
$programNo2Date = $row['aus_courier_program2_date'];

$courierappliedStatus = $row['aus_courier_applied_status'];

$sopStatus = $row['aus_sops_status'];
$addActivitiesStatus = $row['aus_additional_activities_status'];
$personalHeadNote = $row['aus_head_personal_note'];

$client_query = "SELECT client_name, client_email, client_whatapp, client_applied from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
$client_query_ex = mysqli_query($con,$client_query);
$rowCl = mysqli_fetch_assoc($client_query_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);
$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);

$uniAdd = "SELECT aus_uni_apply_link FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_degree='".$clientDegree."' AND aus_uni_name='".$uniName."'";
$uniAdd_ex = mysqli_query($con, $uniAdd);
$rowApply = mysqli_fetch_assoc($uniAdd_ex);
$uniApplyLink = $rowApply['aus_uni_apply_link'];
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<!-- 1st col-md-12 -->
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
									$changedProgramName = $row['aus_change_program_name'] ? "<br>" . ucwords($row['aus_change_program_name']) : '';
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
											$programJSONName = $programName;
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
				</div>
			</div>
			<!-- 2nd col-md-12 -->
			<div class="form-group col-md-12">
				<div class="float-right">
					<?php
					$statusClass = $addActivitiesStatus == '1' ? 'btn-warning' : ($addActivitiesStatus == '2' ? 'btn-success' : 'btn-outline-primary');
					?>
					<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Additional Activities Required by the University" onclick="additionalActivities(<?php echo $programAppliedID; ?>);"> <i class="mdi mdi-plus"></i> Additional Activities Required by the University</button>
					<button type="button" class="btn <?php echo $personalHeadNote ? 'btn-success' : 'btn-outline-info'; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Admission Head Personal Report" onclick="myHeadPersonalReport(<?php echo $programAppliedID;?>);"><i class="mdi mdi-plus"></i> Head Personal Note</button>
					<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
					<?php 
					$sopRequiredORNot=0;
					if (is_array($decoded)) {
						foreach ($decoded as $key => $programJSONName1) {
							$select_query = "SELECT aus_ad_sop_required from austria_add_programs_details".$_SESSION['dbNo']." WHERE aus_ad_uni_name='".$uniName."' AND aus_ad_degree='".$clientDegree."' AND aus_ad_program_name='".$programJSONName1."' ";
							$select_query_ex = mysqli_query($con,$select_query);
							$sopRow = mysqli_fetch_assoc($select_query_ex);
							$sopRequiredORNot = $sopRow['aus_ad_sop_required'] ?? '';
							if ($sopRequiredORNot == '1') {
								break;
							}
						}
					}
					if($sopRequiredORNot=='1'){
						$btnClass = ($sopStatus == 4) ? 'btn-success' : 'btn-outline-pink';
						$icon = ($sopStatus == 4) ? 'mdi-check-circle' : 'mdi-eye';
					?>
						<button type="button" class="btn <?= $btnClass ?> btn-sm" data-toggle="tooltip" data-placement="top" title="SOP's of this University" onclick="addSOPsProgram(<?php echo $programAppliedID;?>);"><i class="mdi <?= $icon ?>"></i> SOP's</button>
					<?php
					}else{ ?>
						<span data-toggle="tooltip" data-placement="top" title="No SOP's Required for this University" class="badge bg-info py-2">No SOP's Required</span>
					<?php }
					?>
				</div>
			</div>
			<!-- 3rd col-md-12 -->
			<div class="col-md-12">
				<input type="hidden" name="" id="reqUniName" value="<?php echo $uniName;?>">
				<input type="hidden" name="" id="reqUniDegree" value="<?php echo $clientDegree;?>">
				<button style="font-size: 1rem;" class="btn btn-dark mb-2 text-warning" onclick="requirementsModal();"><b>Click Here to View <?php echo $uniName;?> University's Info & Requirements</b></button>
			</div>
			<!-- step no 01 col-md-12 -->
			<div class="col-md-12">
				<fieldset class="scheduler-border-team">
					<legend class="scheduler-border-team">
						Step: 01 <span class="text-purple">* (Processing Team Task)</span>
					</legend>
					<h4>
						<span id="step4Title" style=" <?php if ($courierStep4==1){?> color: green; <?php }elseif ($courierStep4==2) { ?> color: red;<?php } ?>"><b> Fill out the Application Form</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
						<div class="radio radio-success form-check-inline">
							<input type="radio" id="yesIDStep4" value="1" name="radioStep4" onclick="fourYesStep(<?php echo $programAppliedID;?>);" <?php echo ($courierStep4 == 1) ? 'checked' : '';?> >
							<label for="yesIDStep4"> Yes </label>
						</div>
						<div class="radio radio-danger form-check-inline">
							<input type="radio" id="noIDStep4" value="2" name="radioStep4" onclick="fourNoStep(<?php echo $programAppliedID;?>);" <?php echo ($courierStep4 == 2) ? 'checked' : '';?> >
							<label for="noIDStep4"> No </label>
						</div>
					</h4>
					
					<p>Fill out the online form by entering the client's personal details according to their passport and educational documents, and upload the documents to the portal.</p>
					<div class="row">
						<div class="col-md-2"> </div>
						<div class="col-md-8 alert bg-dark">
							<a href="<?php echo $rowApply['aus_uni_apply_link'];?>" class="text-warning" target="_blank"><b><?php echo $rowApply['aus_uni_apply_link'];?></b></a>
						</div>
					</div>
				</fieldset>
			</div>
			<!-- step no 02 col-md-12 -->
			<div class="col-md-12">
				<fieldset class="scheduler-border-team">
					<legend class="scheduler-border-team">
						Step: 02 <span class="text-purple">* (Processing Team Task)</span>
					</legend>
					<h4>
						<span id="step6Title" style=" <?php echo ($courierStep5==1) ? 'color: green' : 'color: red'; ?>"><b> Submit the admission application</b></span> &nbsp;&nbsp;&nbsp;&nbsp;
						<div class="radio radio-success form-check-inline">
							<input type="radio" id="yesIDStep6" value="1" name="radioStep6" onclick="sixYesStep(<?php echo $programAppliedID;?>);" <?php echo ($courierStep5==1) ? 'checked' : '';?> <?php echo ($courierappliedScreenshot=='') ? '' : 'disabled';?> > 
							<label for="yesIDStep6"> Yes </label>
						</div>
						<div class="radio radio-danger form-check-inline">
							<input type="radio" id="noIDStep6" value="2" name="radioStep6" onclick="sixNoStep(<?php echo $programAppliedID;?>);" <?php echo ($courierStep5 == 2) ? 'checked' : '';?> <?php echo ($courierappliedScreenshot=='') ? '' : 'disabled';?>>
							<label for="noIDStep6"> No </label>
						</div>
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
										<td class="breakTD">
											<?php 
											$fileMulti = explode(',', $courierappliedScreenshot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?>
										</td>
										<td class="breakTD">
											<?php 
											$fileMulti = explode(',', $courierprogramScreenshot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?>
										</td>
										<td class="breakTD">
											<?php 
											$fileMulti = explode(',', $courierdetailsScreenshot);
											foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
											<?php } ?>
										</td>
										<td class="breakTD"><?php echo $courierappliedNote;?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<form id="formDataID3" enctype="multipart/form-data" class="parsley-examples">
						<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
						<div class="row">
							<div class="col-md-4 form-group">
								<div class="agreement-container" data-agreement-id="3">
									<label class="form-label">Applied ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="courierappliedScreenshot[]" id="uploadedFiles3" required="required" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="col-md-4 form-group">
								<div class="agreement-container" data-agreement-id="4">
									<label class="form-label">Program ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="courierprogramScreenshot[]" id="uploadedFiles4" required="required" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="col-md-4 form-group">
								<div class="agreement-container" data-agreement-id="5">
									<label class="form-label">Detail's ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="courierdetailsScreenshot[]" id="uploadedFiles5" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Note <span class="text-danger">*</span></label>
								<textarea name="courierappliedNote" class="form-control" required="required"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-custom" <?php echo ($courierappliedScreenshot=='') ? '' : 'disabled';?> type="button" name="subcourierApplied" onclick="updApplicationForm('formDataID3','subcourierApplied')" id="subcourierApplied"><i class="mdi mdi-upload"></i> Applied </button>
								</div>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
			<!-- step no 03 col-md-12 -->
			<div class="col-md-12">
				<fieldset class="scheduler-border-team">
					<legend class="scheduler-border-team">
						<span>Step: 03 </span>
						<span class="text-purple">* (Admission Head Task)</span>
					</legend>
					<h4>
						<span style="<?php echo $courierproofScreenshot != '' ? 'color: green' : 'color: red'; ?>"><b> Inform the client about the submission application</b>
						<?php if ($courierappliedStatus=='2') {?>
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
								$fileMulti = explode(',', $courierproofScreenshot);
								$count = 1;
								foreach ($fileMulti as $fileName) {
								?>
								<span><?php echo $count++.'.'; ?></span>
								<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php } ?></td>
								<td class="breakTD"><?php echo $courierproofNote;?></td>
							</tr>
						</tbody>
					</table>
					<form id="formDataID4" enctype="multipart/form-data" class="parsley-examples">
						<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
						<div class="row">
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="6">
									<label class="form-label">Application Fee ScreenShot <span class="text-danger">(Select multi Files)</span>
									</label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="courierproofScreenshot[]" id="uploadedFiles6" required="required" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label class="form-label">Note</label>
								<textarea class="form-control" rows="1" name="courierproofNote"></textarea>
							</div>
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-custom" type="button" name="subcourierProof" <?php echo ($courierproofScreenshot=='' && $courierappliedStatus=='5') ? '' : 'disabled'; ?> onclick="updApplicationForm('formDataID4','subcourierProof')" id="subcourierProof"><i class="mdi mdi-upload"></i> Update </button>
								</div>
							</div>
						</div>
					</form>
				</fieldset>
			</div>
			<!-- step no 04 col-md-12 -->
			<div class="col-md-12">
				<fieldset class="scheduler-border-team">
					<legend class="scheduler-border-team">
						Step: 04 <span class="text-purple">* (Processing Team Task)</span>
					</legend>
					<h4><span style="<?php echo $courierappliedStatus=='9' ? 'color: green' : 'color: red'; ?>"><b>Waiting for a response</b></span></h4>
					<p>Waiting for a response if the application is accepted, go for the RP Process.</p>
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="#waitingScreenshot" data-toggle="tab" aria-expanded="true" class="nav-link active <?php echo $courierappliedStatus=='9' ? 'navSuccess' : ''; ?>">
								<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
								<span class="d-none d-sm-block <?php echo $courierappliedStatus=='9' ? 'text-success' : 'text-warning'; ?>">Waiting</span>
							</a>
						</li>
						
						<?php if ($programNo1Status=='Acceptance' && $programNo2Status=='Acceptance'){ ?>
						<li class="nav-item">
							<a href="#admissionDecision" data-toggle="tab" aria-expanded="true" class="nav-link navSuccess">
								<span class="d-block d-sm-none"><i class="mdi mdi-home-variant"></i></span>
								<span class="d-none d-sm-block text-success">Admission Decision 
								<?php if ($courierappliedStatus=='10') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
								<?php }elseif ($courierappliedStatus=='11') {?>
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
								<?php if ($courierappliedStatus=='10') {?>
								<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="blink"> Acceptance </span>
								<?php }elseif ($courierappliedStatus=='11') {?>
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
									<label class="form-label">Waiting for Admission decisions</label>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="admissionDecision">
							<div class="row">
								<div class="col-md-12">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th width="12%">Name</th>
												<th width="15%">Status</th>
												<th width="30%">ScreenShot</th>
												<th width="31%">Note</th>
												<th width="12%">Date</th>
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
									<form id="formDataID8" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="col-md-12">
												<label><b>Program 1</b></label>
											</div>
											<div class="col-md-12">
												<div class="radio radio-success form-check-inline">
													<input type="radio" id="applicationAcceptance1" value="Acceptance" name="programNo1Status" required="required">
													<label for="applicationAcceptance1"> Acceptance </label>
												</div>
												<div class="radio radio-danger form-check-inline">
													<input type="radio" id="applicationReject1" value="Rejection" name="programNo1Status" required="required">
													<label for="applicationReject1"> Rejection </label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="agreement-container" data-agreement-id="10">
													<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
													</div>
													<input type="file" name="programNo1Screenshot[]" id="uploadedFiles10" class="form-control" multiple style="display: none;">
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
													<button <?php echo $programNo1Screenshot == '' ? '' : 'disabled'; ?> class="btn btn-custom" type="button" name="submitProgram1" onclick="updApplicationForm('formDataID8','submitProgram1')" id="submitProgram1"><i class="mdi mdi-upload"></i> Update </button>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class="col-md-6" style="border-left: 2px solid black;">
									<form id="formDataID9" enctype="multipart/form-data" class="parsley-examples">
										<input type="hidden" name="updateProgramID" value="<?php echo $programAppliedID;?>">
										<div class="row">
											<div class="col-md-12">
												<label><b>Program 2</b></label>
											</div>
											<div class="col-md-12">
												<div class="radio radio-success form-check-inline">
													<input type="radio" id="applicationAcceptance2" value="Acceptance" name="programNo2Status" required="required">
													<label for="applicationAcceptance2"> Acceptance </label>
												</div>
												<div class="radio radio-danger form-check-inline">
													<input type="radio" id="applicationReject2" value="Rejection" name="programNo2Status" required="required">
													<label for="applicationReject2"> Rejection </label>
												</div>
											</div>
											<div class="form-group col-md-6">
												<div class="agreement-container" data-agreement-id="11">
													<label class="form-label">ScreenShot <span class="text-danger">(Select multi Files)</span></label>
													<div class="d-flex justify-content-center">
														<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
														<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off" style="width: 70%;">
													</div>
													<input type="file" name="programNo2Screenshot[]" id="uploadedFiles11" class="form-control" multiple style="display: none;">
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
													<button <?php echo $programNo2Screenshot == '' ? '' : 'disabled'; ?> class="btn btn-custom" type="button" name="submitProgram2" onclick="updApplicationForm('formDataID9','submitProgram2')" id="submitProgram2"><i class="mdi mdi-upload"></i> Update </button>
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
	// Application accepted or Rejection
	function updApplicationForm(formID, proBtn) {
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
				url: "models/_courierApplyControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					Swal.fire({
						title: "Uploaded!",
						text: 'Record Uploaded successfully',
						icon: "success"
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
		var reqUni = $("#reqUni").val();
		$.ajax({
			type: "POST",
			url: "models/requirementInfoState.php",
			data:'reqUniName='+reqUni,
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
	// Add note to Admission head
	function myHeadPersonalReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkHeadPersonalNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
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
				$(".showModalTitle").html('Note');
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
			url: "models/_courierApplyControllersState.php",
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
				url: "models/_courierApplyControllersState.php",
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
				url: "models/_courierApplyControllersState.php",
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
			url: "models/_courierApplyControllersState.php",
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
			url: "models/_courierApplyControllersState.php",
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