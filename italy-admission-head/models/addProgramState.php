<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Delete University Programs state page
if (isset($_POST['delUniPrograms'])) {
	$updateID = $_POST['delUniPrograms'];
?>	
	<form id="formDelUni" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $updateID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Delete Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-8">
					<label>Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" required="required" autocomplete="off" placeholder="Enter Password" onkeyup="checkDelPassword()" id="delUniPassword">
				</div>
				<div class="form-group col-md-4">
					<div class="agreement-container" data-agreement-id="130">
						<label class="form-label">Choose Files <span class="text-danger">* (Select Multi Files)</span></label>
						<div class="d-flex justify-content-center">
							<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
							<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
						</div>
						<input type="file" name="delUniFile[]" id="uploadedFiles130" class="form-control" multiple style="display: none;">
						<div class="preview"></div>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label>Note</label>
					<textarea class="form-control" name="delUniNote" id="editorDelUni">
						
					</textarea>
				</div>
				<script type="text/javascript">
					var editor = CKEDITOR.replace('editorDelUni');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="button" name="delUniBtn" onclick="saveDataForm('formDelUni', 'delUniBtn')" id="delUniBtn" disabled><i class="mdi mdi-upload"></i> Delete</button>
				</div>
			</div>
		</div>
	</form>
<?php
}


// add and Changes program
if (isset($_POST['clientNewID'])) {
	$clientID = $_POST['clientNewID'];
	$italyProgramChange = $_POST['italyProgramChange'];
	$select_query="SELECT client_degree_type, client_inter_percentage, client_country, client_applied, client_id, client_name, client_email, client_country, client_whatapp, client_cgpa, client_percentage, client_cgpa2, client_percentage2, client_document_status, client_note from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
	$select_query_ex = mysqli_query($con,$select_query);
	$rowCountry = mysqli_fetch_assoc($select_query_ex);
	$country = $rowCountry['client_country'];
	$clientID = $rowCountry['client_id'];
	$clientName = $rowCountry['client_name'];
	$clientWhatApp = $rowCountry['client_whatapp'];
	$clientCGPA = $rowCountry['client_cgpa'];
	$clientPercentage = $rowCountry['client_percentage'];
	$clientInterPercentage = $rowCountry['client_inter_percentage'];
	$clientCGPA2 = $rowCountry['client_cgpa2'];
	$clientPercentage2 = $rowCountry['client_percentage2'];
	$clientEmail = $rowCountry['client_email'];
	$countryName = $rowCountry['client_country'];
	$clientCountry = $rowCountry['client_country'];
	$clientNote = $rowCountry['client_note'];
	$clDegtype = $rowCountry['client_degree_type'];

	$changingApplied = $rowCountry['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);
	$getUrl = base64_encode($rowCountry['client_name']."".$rowCountry['client_email']);
	?>

	<div class="row">
		<div class="col-md-5">
			<div class="alert bg-dark text-warning">
				<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
			</div>
		</div>
		<div class="col-md-4">
			<div class="alert bg-dark text-warning">
				<p>Email: <b><?php echo $clientEmail;?></b> </p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Country: <b><?php echo ucwords($countryName);?></b></p>
			</div>
		</div>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
			</div>
		</div>
		<?php if($clDegtype!=''){ ?>
		<div class="col-md-6">
			<div class="alert bg-dark text-warning">
				<p>Degree Category: <strong><?php if($clDegtype!=''){ echo $clDegtype; }else{echo 'Not Found Data'; }?></strong></p>
			</div>
		</div>
		<?php } ?>
		<?php if($clientInterPercentage!=''){ ?>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Intermediate Percentage: <strong><?php if($clientInterPercentage!=''){ echo $clientInterPercentage; }else{echo 'Not Found Data'; }?></strong></p>
				</div>
			</div>
		<?php } ?>
		<?php if($clientCGPA!=''){ ?>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Bachelor CGPA: <strong><?php if($clientCGPA!=''){ echo $clientCGPA; }else{echo 'Not Found Data'; }?></strong></p>
			</div>
		</div>
		<?php } ?>
		<?php if($clientPercentage!=''){ ?>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p><?php if($appRow=='master'){echo 'Bachelor';} ?> Percentage: <strong><?php if($clientPercentage!=''){ echo $clientPercentage; }else{echo 'Not Found Data'; }?></strong></p>
			</div>
		</div>
		<?php } ?>
		<?php if($clientCGPA2!=''){ ?>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Master CGPA: <strong><?php if($clientCGPA2!=''){ echo $clientCGPA2; }else{echo 'Not Found Data'; }?></strong></p>
			</div>
		</div>
		<?php } ?>
		<?php if($clientPercentage2!=''){ ?>
		<div class="col-md-3">
			<div class="alert bg-dark text-warning">
				<p>Master Percentage: <strong><?php if($clientPercentage2!=''){ echo $clientPercentage2; }else{echo 'Not Found Data'; }?></strong></p>
			</div>
		</div>
		<?php } ?>
	</div>
	
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Program Details <span class="text-danger">*</span>
		</legend>
		<div class="row">
				<?php
				foreach ($appliedChanging as $appRow){
				if ($appRow=='bachelor' || $appRow=='phd') { ?>
				<h4><?php echo ucwords($appRow);?> Programs</h4>
				<form id="proUpload" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="appliedName" value="<?php echo $appRow;?>" id="appliedNameID">
					<input type="hidden" name="updateID" value="<?php echo $clientID?>" id="clientIDGET">
					<input type="hidden" name="changesProgram" value="<?php echo $italyProgramChange?>">
					<input type="hidden" name="countryName" value="<?php echo $country?>">
					<input type="hidden" name="intakeYear" value="<?php echo $intake?>" id="intakeYear">
					<input type="hidden" value="<?php echo $clDegtype;?>" id="getclientdeg" name="getclientdegree">
					<div class="mt-1" style="overflow-x: auto; white-space: nowrap;">
						<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
							<thead>
								<tr>
									<th style="width: 200px;">University</th>
									<th style="width: 200px;">Program</th>
									<th style="width: 60px;">Prog CGPA</th>
									<th style="width: 100px;">Degree Acceptance</th>
									<th style="width: 100px;">Intake</th>
									<th style="width: 120px;">Note</th>
		
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-group col-md-12">
											<select class="form-control" id="uniOtherItalyName" data-toggle="select2" name="uniName" autocomplete="off" required="required" onchange="checkOtherItalyUni(); setUniProgram(this.value,'<?php echo $appRow; ?>', 'showuniReltProg', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_status')">
												<option value="" class="text-center">--- Select University ---</option>
												<?php if($intake=='2025'){
												$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2025' AND italy_uni_degree='".$appRow."' ORDER BY italy_add_id ASC";
												$uniDetails_ex = mysqli_query($con, $uniDetails);
												}else{ 
												$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2026' AND italy_uni_degree='".$appRow."' ORDER BY italy_add_id ASC";
												$uniDetails_ex = mysqli_query($con, $uniDetails);
												} ?>
												<?php
												foreach ($uniDetails_ex as $rowMB) {
												?>
												<option value="<?php echo $rowMB['italy_uni_name'];?>" data-itdirect-id="<?php echo $rowMB['italy_uni_direct_apply'];?>" data-dirpre-id="<?php echo $rowMB['italy_uni_pre_enrollment'];?>" data-dream-id="<?php echo $rowMB['italy_uni_dream_apply'];?>"><?php echo $rowMB['italy_uni_name'];?></option>
												<?php } ?>
											</select>
										</div>
										<input type="hidden" name="uniDirectApply" id="uniDirectApply">
	                            		<input type="hidden" name="unidirectPre" id="unidirectPre">
	                            		<input type="hidden" name="unidreamID" id="unidreamID">
									</td>
									<td>
										<div id="applyshowuniReltProg"></div>
										<div class="col-md-12">
											<select class="form-control" data-toggle="select3" multiple name="programName[]" autocomplete="off" placeholder="Choose" required="required" id="showuniReltProg" onchange="checkCGPAProgram(this, 'uniOtherItalyName', 'showItalyUniCGPA', '<?php echo $appRow;?>', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_cgpa', 'italy_ad_degree_acceptable', 'showItalyUniAccptDeg', 'already-cgpa', 'submitBtn', 'degnot_match');">
												<option value="" disabled class="text-center">--- Select Program ---</option>
												<!-- Dynamic programs shown here -->
											</select>
										</div>
									</td>
									<td>
										<div id="showItalyUniCGPA"></div>
									</td>
									<td>
										<div id="showItalyUniAccptDeg"></div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="text" name="intakeName" class="form-control" autocomplete="off" placeholder="Enter intake">
										</div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="file" name="programApproveFile[]" class="form-control" autocomplete="off" multiple="" id="programApproveID" onchange="uploadApproveFile();">
										</div>
										<div class="col-md-12">
											<textarea name="programApproveNote" class="form-control" autocomplete="off"> </textarea>
										</div>
									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td colspan="6">
										<div class="col-md-12" id="already-cgpa"> </div>
										<div class="col-md-12" id="degnot_match"> </div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="form-group col-md-12">
											<button type="button" name="subProgram" class="btn btn-success col-md-12" onclick="savePrograms('submitBtn', 'proUpload');" id="submitBtn"><i class="mdi mdi-upload"></i> Save Program</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
				<?php
				}
				if ($appRow=='master') {
				?>
				<h4><?php echo ucwords($appRow);?> Programs</h4>
				<form id="proMastUpload" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="appliedName" value="<?php echo $appRow;?>" id="appliedNameIDMast">
					<input type="hidden" name="updateID" value="<?php echo $clientID?>" id="clientIDGET">
					<input type="hidden" name="changesProgram" value="<?php echo $italyProgramChange?>">
					<input type="hidden" name="countryName" value="<?php echo $country?>">
					<input type="hidden" name="intakeYear" value="<?php echo $intake?>" id="intakeYear">
					<input type="hidden" value="<?php echo $clDegtype;?>" id="getclientdeg" name="getclientdegree">
					<div class="mt-1" style="overflow-x: auto; white-space: nowrap;">
						<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
							<thead>
								<tr>
									<th style="width: 200px;">University</th>
									<th style="width: 200px;">Program</th>
									<th style="width: 60px;">Prog CGPA</th>
									<th style="width: 100px;">Degree Acceptance</th>
									<th style="width: 100px;">Intake</th>
									<th style="width: 120px;">Note</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-group col-md-12">
											<select class="form-control" id="uniOtherItalyNameMast" data-toggle="select2" name="uniNameMast" autocomplete="off" required="required" onchange="checkOtherItalyMasterUni(); setUniProgram(this.value,'<?php echo $appRow; ?>', 'showuniReltProgMast', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_status')">
												<option value="" class="text-center">--- Select University ---</option>
												<?php if($intake=='2025'){
												$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2025' AND italy_uni_degree='master' ORDER BY italy_add_id ASC";
												$uniDetails_ex = mysqli_query($con, $uniDetails);
												}else{ 
												$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2026' AND italy_uni_degree='master' ORDER BY italy_add_id ASC";
												$uniDetails_ex = mysqli_query($con, $uniDetails);
												} ?>
												<?php
												foreach ($uniDetails_ex as $rowMB) {
												?>
												<option value="<?php echo $rowMB['italy_uni_name'];?>" data-itdirect-id="<?php echo $rowMB['italy_uni_direct_apply'];?>" data-dirpre-id="<?php echo $rowMB['italy_uni_pre_enrollment'];?>" data-dream-id="<?php echo $rowMB['italy_uni_dream_apply'];?>"><?php echo $rowMB['italy_uni_name'];?></option>
												<?php } ?>
											</select>
										</div>
										<input type="hidden" name="uniDirectApplyMast" id="uniDirectApplyMast">
	                            		<input type="hidden" name="unidirectPreMast" id="unidirectPreMast">
	                            		<input type="hidden" name="unidreamIDMast" id="unidreamIDMast">
									</td>
									<td>
										<div id="applyshowuniReltProgMast"></div>
										<div class="col-md-12">
											<select class="form-control" data-toggle="select4" multiple name="programNameMast[]" autocomplete="off" placeholder="Choose" required="required" id="showuniReltProgMast" onchange="checkCGPAProgram(this, 'uniOtherItalyNameMast', 'showItalyUniCGPAMast', '<?php echo $appRow;?>', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_cgpa', 'italy_ad_degree_acceptable', 'showItalyUniAccptDegMast', 'already-cgpaMast', 'submitMastBtn', 'degnot_matchMast');">
												<option value="" disabled class="text-center">--- Select Program ---</option>
												<!-- Dynamic programs shown here -->
											</select>
										</div>
									</td>
									<td>
										<div id="showItalyUniCGPAMast"></div>
									</td>
									<td>
										<div id="showItalyUniAccptDegMast"></div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="text" name="intakeNameMast" class="form-control" autocomplete="off" placeholder="Enter intake">
										</div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="file" name="MastprogramApproveFile[]" class="form-control" autocomplete="off" multiple="" id="programApproveIDMast" onchange="uploadMastApproveFile();">
										</div>
										<div class="col-md-12">
											<textarea name="programApproveNoteMast" class="form-control" autocomplete="off"> </textarea>
										</div>
									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td colspan="6">
										<div class="col-md-12" id="already-cgpaMast"> </div>
										<div class="col-md-12" id="degnot_matchMast"> </div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="form-group col-md-12">
											<button type="button" name="subProgram" class="btn btn-success col-md-12" onclick="saveMastPrograms('submitMastBtn', 'proMastUpload');" id="submitMastBtn"><i class="mdi mdi-upload"></i> Save Program</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
				<?php
				}if ($appRow=='mbbs') {
				?>
				<h4>MBBS Programs</h4>
				<form id="proMBBSUpload" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="appliedName" value="<?php echo $appRow;?>" id="appliedNameMBBS">
					<input type="hidden" name="updateID" value="<?php echo $clientID?>" id="clientIDGET">
					<input type="hidden" name="changesProgram" value="<?php echo $italyProgramChange?>">
					<input type="hidden" name="countryName" value="<?php echo $country?>">
					<input type="hidden" name="intakeYear" value="<?php echo $intake?>" id="intakeYear">
					<input type="hidden" value="<?php echo $clDegtype;?>" id="getclientdeg" name="getclientdegree">
					<div class="mt-1" style="overflow-x: auto; white-space: nowrap;">
						<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
							<thead>
								<tr>
									<th style="width: 160px;">University</th>
									<th style="width: 160px;">Program</th>
									<th style="width: 60px;">Prog CGPA</th>
									<th style="width: 100px;">Degree Acceptance</th>
									<th style="width: 100px;">Intake</th>
									<th style="width: 120px;">Note</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<div class="form-group col-md-12">
											<select class="form-control" data-toggle="select2" name="uniNameMBBS" autocomplete="off" required="required" onchange="checkOtherMBBSUni(); setUniProgram(this.value,'<?php echo $appRow; ?>', 'showuniReltProgmbbs', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_status')" id="uniOtherMBBSName">
												<option value="" class="text-center">--- Select University ---</option>
												<?php
												if($intake=='2025'){
													$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2025' AND italy_uni_degree='mbbs' ORDER BY italy_add_id ASC";
												}else{
													$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2026' AND italy_uni_degree='mbbs' ORDER BY italy_add_id ASC";
												}
												$uniDetails_ex = mysqli_query($con, $uniDetails);
												foreach ($uniDetails_ex as $row) {
												?>
												<option value="<?php echo $row['italy_uni_name'];?>" data-itdirect-id="<?php echo $row['italy_uni_direct_apply'];?>" data-dirpre-id="<?php echo $row['italy_uni_pre_enrollment'];?>" data-dream-id="<?php echo $row['italy_uni_dream_apply'];?>"><?php echo $row['italy_uni_name'];?></option>
												<?php } ?>
												
											</select>
										</div>
										<input type="hidden" name="uniDirApplyMbbs" id="uniDirApplyMbbs">
										<input type="hidden" name="unidirPreMbbs" id="unidirPreMbbs">
										<input type="hidden" name="unidreamIDMbbs" id="unidreamIDMbbs">
									</td>
									
									<td>
										<div id="applyshowuniReltProgmbbs"></div>
										<div class="col-md-12">
											<select class="form-control" data-toggle="select5" multiple name="programNameMBBS[]" autocomplete="off" required="required" id="showuniReltProgmbbs" onchange="checkCGPAProgram(this, 'uniOtherMBBSName', 'showItalyMBBSUniCGPA', '<?php echo $appRow;?>', 'italy_add_programs_details<?php echo $_SESSION['dbNo']; ?>', 'italy_ad_uni_name', 'italy_ad_degree', 'italy_ad_program_name', 'italy_ad_cgpa', 'italy_ad_degree_acceptable', 'showItalyMBBSUniAccptDeg', 'already-cgpambbs','submitMBBSBtn', 'degnot_match');">
												<option value="" disabled class="text-center">--- Select Program ---</option>
												<!-- Dynamic programs shown here -->
											</select>
										</div>
									</td>
									<td>
										<div id="showItalyMBBSUniCGPA"></div>
									</td>
									<td>
										<div id="showItalyMBBSUniAccptDeg"></div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="text" name="intakeNameMBBS" class="form-control" autocomplete="off" placeholder="Enter intake">
										</div>
									</td>
									<td>
										<div class="col-md-12">
											<input type="file" name="programMBBSApproveFile[]" class="form-control" autocomplete="off" multiple="" id="programMBBSApproveID" onchange="uploadMBBSApproveFile();">
										</div>
										<div class="col-md-12">
											<textarea name="programMBBSApproveNote" class="form-control" autocomplete="off"> </textarea>
										</div>
									</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td colspan="6">
										<div class="col-md-12" id="already-cgpambbs"> </div>
										<div class="col-md-12" id="degnot_match"> </div>
									</td>
								</tr>
								<tr>
									<td colspan="6">
										<div class="form-group col-md-12">
											<button type="button" name="subProgram" class="btn btn-success col-md-12" onclick="saveMBBSPrograms('submitMBBSBtn', 'proMBBSUpload');" id="submitMBBSBtn"><i class="mdi mdi-upload"></i> Save Program</button>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</form>
				<?php
				}
			}
			?>
		</div>
	</fieldset>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".parsley-examples").parsley();
			$('[data-toggle="select2"]').select2();
			$('[data-toggle="select3"]').select2();
			$('[data-toggle="select4"]').select2();
			$('[data-toggle="select5"]').select2();
		});
	</script>
<?php }
// That Show the Uni related programs dynamically onchange uni
if (isset($_POST['checkUniName'])) {
	$getUniname = $_POST['checkUniName'];
	$getdegtype = $_POST['checktypeDeg'];
	$gettabName = $_POST['checkTable'];
	$getuniCol = $_POST['checkUniCol'];
	$getdegCol = $_POST['checkdegCol'];
	$getprogCol = $_POST['checkprogCol'];
	$getprogStatus = $_POST['checkprogStatus'];

	$progUniDetails = "SELECT * FROM $gettabName WHERE status='1' AND close='1' AND $getuniCol='".$getUniname."' AND $getdegCol='".$getdegtype."'";
	$progUniDetails_ex = mysqli_query($con, $progUniDetails);
	foreach ($progUniDetails_ex as $rowUP) {
		?>
		<option value="<?php echo $rowUP[$getprogCol];?>"><?php echo $rowUP[$getprogCol];?> <?php if ($rowUP[$getprogStatus] == '0') { echo '❌'; } ?></option>
	<?php } 
}
        // Programm Apply Method
if (isset($_POST['checkuniSelectName'])) {
	$uniSelectName = $_POST['checkuniSelectName'];
	$unidegtype = $_POST['checkunidegtype'];
	$uniTable = $_POST['checkuniTable'];
	$uniNameCol = $_POST['checkuniNameCol'];
	$degreeNameCol = $_POST['checkdegreeNameCol'];
	$uniProgSelectCol = $_POST['checkuniProgSelectCol'];
	$uniProgramCol = $_POST['checkuniProgramCol'];

	$uniSelectPro = "SELECT $uniProgSelectCol, $uniProgramCol from $uniTable WHERE close='1' AND status='1' AND $uniNameCol='".$uniSelectName."' AND $degreeNameCol='".$unidegtype."' ";
	$uniSelectPro_ex = mysqli_query($con,$uniSelectPro);
	if ($uniSelectPro_ex && mysqli_num_rows($uniSelectPro_ex) > 0) {
		$proRow = mysqli_fetch_assoc($uniSelectPro_ex);
		echo $uniSelectPro = $proRow[$uniProgSelectCol]." // ".$proRow[$uniProgramCol];
	}
}

// dymically country match CGPA with client and Programs
if (isset($_POST['checkuniName'])) {
	$uniName = $_POST['checkuniName'];
	$proName = $_POST['checkproName'];
	$degreeName = $_POST['checkdegreeName'];
	$clientID = $_POST['checkclientID'];
	$dbTable = $_POST['checkdbTable'];
	$uniColName = $_POST['checkuniColName'];
	$degColName = $_POST['checkdegColName'];
	$progColName = $_POST['checkprogColName'];
	$cgpaColName = $_POST['checkcgpaColName'];

	$cgpaQuery = "SELECT client_inter_percentage,client_cgpa, client_percentage, client_cgpa2, client_percentage2 from clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND client_id='".$clientID."' ";
	$cgpaQuery_ex = mysqli_query($con,$cgpaQuery);
	$row = mysqli_fetch_assoc($cgpaQuery_ex);
	$clientInterPercentage = floatval($row['client_inter_percentage']);
	$clientCGPA = floatval($row['client_cgpa']);
	$clientPercentage = floatval($row['client_percentage']);
	$clientCGPA2 = floatval($row['client_cgpa2']);
	$clientPercentage2 = floatval($row['client_percentage2']);


	$uniCGPA = "SELECT $cgpaColName from $dbTable WHERE close='1' AND status='1' AND $uniColName='".$uniName."' AND $degColName='".$degreeName."' AND $progColName='".$proName."' ";
	$uniCGPA_ex = mysqli_query($con,$uniCGPA);
	$unirow = mysqli_fetch_assoc($uniCGPA_ex);
	$uniCGPA_raw = $unirow[$cgpaColName];
	// Remove everything except numbers, dot, and minus sign
	$uniCGPA_clean = preg_replace('/[^0-9%.\-]/', '', $uniCGPA_raw);
	// Convert to float for numeric comparison
	$uniCGPA = floatval($uniCGPA_clean);
	if (strpos($uniCGPA_clean, '%') !== false) {
		if($clientInterPercentage!='0' && ($degreeName=='bachelor' || $degreeName=='mbbs')){
			if($clientInterPercentage >= $uniCGPA){
				echo "yes";
			}if($clientInterPercentage < $uniCGPA){
				echo "error";
			}
		}if($clientPercentage!='0' && $clientPercentage2=='0'){
			if($clientPercentage >= $uniCGPA){
				echo "yes";
			}if($clientPercentage < $uniCGPA){
				echo "error";
			}
		}if($clientPercentage=='0' && $clientPercentage2!='0'){
			if($clientPercentage2 >= $uniCGPA){
				echo "yes";
			}if($clientPercentage2 < $uniCGPA){
				echo "error";
			}
		}if(($clientPercentage!='0' && $clientPercentage2!='0') && ($degreeName!='bachelor' && $degreeName!='mbbs')){
			if($clientPercentage >= $uniCGPA && $clientPercentage2 >= $uniCGPA){
				echo "yes";
			}if($clientPercentage < $uniCGPA && $clientPercentage2 < $uniCGPA){
				echo "error";
			}
		}
	}else{
		if($clientCGPA!='0' && $clientCGPA2=='0'){
			if($clientCGPA >= $uniCGPA){
				echo "yes";
			}if($clientCGPA < $uniCGPA){
				echo "error";
			}
		}if($clientCGPA=='0' && $clientCGPA2!='0'){
			if($clientCGPA2 >= $uniCGPA){
				echo "yes";
			}if($clientCGPA2 < $uniCGPA){
				echo "error";
			}
		}if($clientCGPA!='0' && $clientCGPA2!='0'){
			if($clientCGPA >= $uniCGPA && $clientCGPA2 >= $uniCGPA){
				echo "yes";
			}if($clientCGPA < $uniCGPA && $clientCGPA2 < $uniCGPA){
				echo "error";
			}
		}
	}
}

if (isset($_POST['checkCGPAuniName'])) {
	$CGPAuniName = $_POST['checkCGPAuniName'];
	$CGPAproName = $_POST['checkCGPAproName'];
	$CGPAdegreeName = $_POST['checkCGPAdegreeName'];

	$dbTable = $_POST['checkdbTable'];
	$uniColName = $_POST['checkuniColName'];
	$degColName = $_POST['checkdegColName'];
	$progColName = $_POST['checkprogColName'];
	$cgpaColName = $_POST['checkcgpaColName'];

	$uniCGPA = "SELECT $cgpaColName from $dbTable WHERE close='1' AND status='1' AND $uniColName='".$CGPAuniName."' AND $degColName='".$CGPAdegreeName."' AND $progColName='".$CGPAproName."' ";
	$uniCGPA_ex = mysqli_query($con,$uniCGPA);
	if ($uniCGPA_ex && mysqli_num_rows($uniCGPA_ex) > 0) {
		$unirow = mysqli_fetch_assoc($uniCGPA_ex);
		echo $uniCGPA = $unirow[$cgpaColName];
	}
}
// dymically country match degree acceptable with client degree type
if (isset($_POST['check1uniName'])) {
	$uni1Name = $_POST['check1uniName'];
	$pro1Name = $_POST['check1proName'];
	$degree1Name = $_POST['check1degreeName'];
	$db1Table = $_POST['check1dbTable'];
	$uni1ColName = $_POST['check1uniColName'];
	$deg1ColName = $_POST['check1degColName'];
	$prog1ColName = $_POST['check1progColName'];
	$deg1AcptcolName = $_POST['check1DegAcptColName'];
	$cl1degtypeName = $_POST['check1cldegtype'];
	$fdegacpquery = "SELECT $deg1AcptcolName FROM $db1Table WHERE close='1' AND status='1' AND $uni1ColName='".$uni1Name."' AND $deg1ColName='".$degree1Name."' AND $prog1ColName='".$pro1Name."'";
	$runfdegquery = mysqli_query($con,$fdegacpquery);
	$getDegacpt = mysqli_fetch_assoc($runfdegquery);
	$clselecDegtype = $getDegacpt[$deg1AcptcolName];
	// $comasepopt = array_filter(array_map('trim', explode(',', $cl1degtypeName)));
	if ($degree1Name == 'master' && $clselecDegtype != '') {
		if ($clselecDegtype!='Both') {
			$uni1CGPA = "SELECT $deg1AcptcolName from $db1Table WHERE close='1' AND status='1' AND $uni1ColName='".$uni1Name."' AND $deg1ColName='".$degree1Name."' AND $deg1AcptcolName = '".$cl1degtypeName."' AND $prog1ColName='".$pro1Name."' ";
			$uni1CGPA_ex = mysqli_query($con,$uni1CGPA);
			$countval = mysqli_num_rows($uni1CGPA_ex);
			if ($countval > 0 && $cl1degtypeName != '') {
				echo "success";
			}else{
				echo "error";
			}
		}elseif($clselecDegtype == 'Both' && $cl1degtypeName!=''){
			echo "success";
		}else{
			echo "error";
		}
	}
}

if (isset($_POST['checkDeguniName'])) {
	$DeguniName = $_POST['checkDeguniName'];
	$DegproName = $_POST['checkDegproName'];
	$DegdegreeName = $_POST['checkDegdegreeName'];

	$dbTable = $_POST['checkdbTable'];
	$uniColName = $_POST['checkuniColName'];
	$degColName = $_POST['checkdegColName'];
	$progColName = $_POST['checkprogColName'];
	$DegColName = $_POST['checkDegColName'];

	$uniDeg = "SELECT $DegColName from $dbTable WHERE close='1' AND status='1' AND $uniColName='".$DeguniName."' AND $degColName='".$DegdegreeName."' AND $progColName='".$DegproName."' ";
	$uniDeg_ex = mysqli_query($con,$uniDeg);
	if ($uniDeg_ex && mysqli_num_rows($uniDeg_ex) > 0) {
		$unirow = mysqli_fetch_assoc($uniDeg_ex);
		echo $uniDeg = $unirow[$DegColName];
	}
}

?>