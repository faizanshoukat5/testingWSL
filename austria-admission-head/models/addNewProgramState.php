<?php 
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Add note of programs
if (isset($_POST['proAddNew'])) {
	$proAddNew = $_POST['proAddNew'];
	$proIntake = $_POST['proIntake'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Program Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Select University <span class="text-danger">*</span></label>
					<select class="form-control" data-toggle="select2" name="uniName" autocomplete="off" required="required">
						<option selected value disabled class="text-center">--- Select University ---</option>
						<?php
						$uniDetails = "SELECT aus_uni_name FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' GROUP BY aus_uni_name ORDER BY aus_add_id ASC";
						$uniDetails_ex = mysqli_query($con, $uniDetails);
						foreach ($uniDetails_ex as $rowMB) {
						?>
						<option value="<?php echo $rowMB['aus_uni_name'];?>"><?php echo $rowMB['aus_uni_name'];?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Degree Name <span class="text-danger">*</span></label>
					<select class="form-control" name="uniDegree" required="required">
						<option selected value disabled class="text-center">--- Select Degree ---</option>
						<option value="bachelor">Bachelor</option>
						<option value="master">Master</option>
						<option value="phd">PHD</option>
					</select>
				</div>
				<div class="col-md-12">
					<div class="row">
						<div class="form-group col-md-3">
							<label class="form-label">Program Name <span class="text-danger">*</span></label>
							<input type="text" name="programName[]" class="form-control" required="required" autocomplete="off" placeholder="Enter Program Name">
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="form-group col-md-3">
									<label class="form-label">CGPA / Percentage <span class="text-danger">*</span></label>
									<input type="text" name="proCGPAPer[]" class="form-control" required="required" autocomplete="off" placeholder="Enter CGPA / Percentage">
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Language of Instruction <span class="text-danger">*</span></label>
									<select class="form-control" name="prolanguageInstruction[]" required="required">
										<option selected value disabled>--- Select Instruction ---</option>
										<option value="English">English</option>
										<option value="German">German </option>
										<option value="English and German">English and German </option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Program Application Fee <span class="text-danger">*</span></label>
									<input type="text" name="proAppFee[]" class="form-control" required="required"  autocomplete="off" placeholder="Enter Application Fee">
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Program Tuition Fee </label>
									<input type="text" name="proTuitionFee[]" class="form-control"autocomplete="off" placeholder="Enter Program Tuition Fee">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label class="form-label">Language Requirement</label>  <br>
							<div class="checkbox checkbox-success form-check-inline">
								<input type="hidden" id="hidden_engProAccept0" name="proEngProfAccept[]" value="0">
								<input type="checkbox" id="engProAccept0" name="" onclick="engFunProfAcc(0);">
								<label for="engProAccept0"> English Proficiency Letter Acceptable </label>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">IELTS / PTE / Duo lingo / Other</label>
							<input type="text" name="proIELTSPTE[]" class="form-control" autocomplete="off" placeholder="Enter IELTS / PTE / Duo lingo / Other" id="proIELTSPTE0">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">SOP</label>  <br>
							<div class="checkbox checkbox-success form-check-inline">
								<input type="hidden" id="hidden_sopRequired0" name="proSOPRequired[]" value="0">
								<input type="checkbox" id="sopRequired0" name="" onclick="requiredSOP(0);">
								<label for="sopRequired0"> SOP Required </label>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">SOP Note</label>
							<input type="text" name="proSOPNote[]" class="form-control" autocomplete="off" placeholder="Enter SOP Note" readonly="" id="showNoteSOP0">
						</div>
						
						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_degreeRequired0" name="proDegreeRequired[]" value="0">
								<input type="checkbox" id="degreeRequired0" name="" onclick="funDegreeRequired(0);">
								<label for="degreeRequired0"> Degree Required </label>
							</div>

							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_recommendation0" name="proRecommendation[]" value="0">
								<input type="checkbox" id="recommendation0" name="" onclick="funRecommendation(0);">
								<label for="recommendation0"> Recommendation </label>
							</div>
						</div>
						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_normalCV0" name="proNormalCV[]" value="0">
								<input type="checkbox" id="normalCV0" name="" onclick="funNormalCV(0);">
								<label for="normalCV0"> Normal CV </label>
							</div>

							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_europassCV0" name="proEuropassCV[]" value="0">
								<input type="checkbox" id="europassCV0" name="" onclick="funEuropassCV(0);">
								<label for="europassCV0"> Europass CV </label>
							</div>
						</div>

						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_gmatGreTest0" name="progmatGreTest[]" value="0">
								<input type="checkbox" id="gmatGreTest0" name="" onclick="fungmatGreTest(0);">
								<label for="gmatGreTest0"> GMAT/ GRE Test </label>
							</div>
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_entryTest0" name="proentryTest[]" value="0">
								<input type="checkbox" id="entryTest0" name="" onclick="funentryTest(0);">
								<label for="entryTest0"> Entry Test </label>
							</div>
						</div>

						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_textInterview0" name="protextInterview[]" value="0">
								<input type="checkbox" id="textInterview0" name="" onclick="funTestInterview(0);">
								<label for="textInterview0"> Any Interview Required </label>
							</div>
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_legDocument0" name="prolegDocument[]" value="0">
								<input type="checkbox" id="legDocument0" name="" onclick="funlegDocument(0);">
								<label for="legDocument0"> Apply with legalized documents </label>
							</div>
						</div>
						
						<div class="form-group col-md-2">
							<label class="form-label">Previous Relevant Degree </label>
							<input type="text" name="propreRelevantDegree[]" class="form-control" autocomplete="off" placeholder="Enter Previous Relevant Degree">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Application Process <span class="text-danger">*</span></label>
							<select class="form-control" name="applicationProcess[]" required="required">
								<option selected value disabled>--- Select Application Process ---</option>
								<option value="Online">Online</option>
								<option value="Courier">Courier </option>
								<option value="Online and Courier">Online and Courier </option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Intake <span class="text-danger">*</span></label>
							<select class="form-control" name="proIntake[]" required="required">
								<option selected value disabled>--- Select Intake ---</option>
								<option value="March">March</option>
								<option value="October">October </option>
								<option value="March / October">March / October </option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Overall Intake <span class="text-danger">*</span></label>
							<input type="text" name="proRound[]" class="form-control" required="required" autocomplete="off" placeholder="Enter Intake">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Current Intake <span class="text-danger">*</span></label>
							<input type="text" name="proCurrentRound[]" class="form-control" required="required" autocomplete="off" placeholder="Enter Intake">
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">Current Intake Opening Date </label>
							<input type="date" name="openingDate[]" class="form-control" autocomplete="off">
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">Current Intake Actual Deadline </label>
							<input type="date" name="actualDeadline[]" class="form-control" autocomplete="off">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Next Intake Opening Date <span class="text-danger">*</span></label>
							<input type="date" name="nextOpenDate[]" class="form-control" required="required" autocomplete="off">
						</div>

						<div class="form-group col-md-3">
							<label class="form-label">Degree Acceptable </label>
							<select name="degreeAcceptable[]" class="form-control">
								<option value="" class="text-center">--- Select Degree Acceptable --- </option>
								<option value="Bachelor 4 Years">Bachelor 4 Years</option>
								<option value="2 Years Bachelor + 2 Years Master">2 Years Bachelor + 2 Years Master</option>
								<option value="Both">Both</option>
							</select>
						</div>
						<div class="form-group col-md-7">
							<label class="form-label">Client's Previous Degree </label>
							<select name="clientPreviousDegree[0][]" data-toggle="select3" class="form-control" multiple="">
								<?php
								$uniDetails = "SELECT pre_degree_name FROM previous_client_degrees WHERE status='1' AND close='1' ORDER BY pre_degree_id DESC";
								$uniDetails_ex = mysqli_query($con, $uniDetails);
								foreach ($uniDetails_ex as $rowPre) {
								?>
								<option value="<?php echo $rowPre['pre_degree_name'];?>"><?php echo ucwords($rowPre['pre_degree_name']);?></option>
								<?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label class="form-label">This admission letter is valid for how many intakes? <span class="text-danger">*</span></label>
							<select class="form-control" name="admissionValid[]" required="required">
								<option selected value disabled class="text-center">--- Select admission letter Valid ---</option>
								<option value="1 intake">1 intake</option>
								<option value="2 intake">2 intake</option>
								<option value="3 intake">3 intake</option>
							</select>
						</div>
						<div class="form-group col-md-7">
							<label class="form-label">Note for Admission Head </label>
							<textarea name="proNoteHead[]" class="form-control"> </textarea>
						</div>
						<div class="form-group col-md-1">
							<label>Status</label><br>
							<button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-check"></i></button>
						</div>
					</div>
					<input type="hidden" name="" value="1" id="varInputID">
					<hr width="100%" style="border: 2px solid black;">
				</div>
					
				<div class="col-md-12" id="showNewPrograms"></div>
				<div class="form-group col-md-12">
					<button type="button" class="btn btn-primary col-md-12" onclick="addNewPrograms(1);"><i class="mdi mdi-plus-circle"></i> Add More Program Name</button>
				</div>
				
				<div class="form-group col-md-12">
					<label>Note</label>
					<textarea class="form-control" name="programNote" id="editor">

					</textarea>
				</div>
				<script>
					$('[data-toggle="select2"]').select2();
					$('[data-toggle="select3"]').select2();
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="subAddProgram"><i class="mdi mdi-upload"></i> Submit</button>
				</div>
			</div>
		</div>
	</form>
<?php 
}

// Delete university
if (isset($_POST['proAddDel'])) {
	$uniAddID = $_POST['proAddDel'];
	$close = 0;
	$del_query = "UPDATE austria_add_programs".$_SESSION['dbNo']." SET close='".$close."' WHERE aus_ap_id='".$uniAddID."'";
	$del_query_ex = mysqli_query($con,$del_query);

	$del_query = "UPDATE austria_add_programs_details".$_SESSION['dbNo']." SET close='".$close."' WHERE aus_add_pro_id='".$uniAddID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// Add note of programs
if (isset($_POST['proAddEdit'])) {
	$proAddEdit = $_POST['proAddEdit'];
	$proIntake = $_POST['proIntake'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $proAddEdit;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Program Details <span class="text-danger">*</span>
			</legend>
			<?php 
			$proDetails = "SELECT * from austria_add_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_ap_id='".$proAddEdit."' ";
			$proDetails_ex = mysqli_query($con,$proDetails);
			foreach ($proDetails_ex as $row) {
			?>
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Select University <span class="text-danger">*</span></label>
					<select class="form-control" data-toggle="select2" name="uniName" autocomplete="off" required="required">
						<option value="<?php echo $row['aus_ap_uni_name'];?>"><?php echo $row['aus_ap_uni_name'];?></option>
						<?php
						$uniDetails = "SELECT aus_uni_name FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' GROUP BY aus_uni_name ORDER BY aus_add_id ASC";
						$uniDetails_ex = mysqli_query($con, $uniDetails);
						foreach ($uniDetails_ex as $rowMB) {
						?>
						<option value="<?php echo $rowMB['aus_uni_name'];?>"><?php echo $rowMB['aus_uni_name'];?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Degree Name <span class="text-danger">*</span></label>
					<select class="form-control" name="uniDegree" required="required">
						<option value="<?php echo $row['aus_ap_degree'];?>"><?php echo $row['aus_ap_degree'];?></option>
						<option value="bachelor">Bachelor</option>
						<option value="master">Master</option>
						<option value="phd">PHD</option>
					</select>
				</div>
				<?php 
				$srVar=0;
				$proShowDet = "SELECT * from austria_add_programs_details".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_ad_status='1' AND aus_add_pro_id='".$proAddEdit."' ";
				$proShowDet_ex = mysqli_query($con,$proShowDet);
				foreach ($proShowDet_ex as $rowDet) {
				?>
				<div class="col-md-12">
					<div class="row" id="row<?php echo $srVar;?>">
						<div class="form-group col-md-3">
							<label class="form-label">Program Name <span class="text-danger">*</span></label>
							<input type="text" name="programName[]" class="form-control" required="required" autocomplete="off" value="<?php echo $rowDet['aus_ad_program_name'];?>">
						</div>
						<div class="col-md-9">
							<div class="row">
								<div class="form-group col-md-3">
									<label class="form-label">CGPA / Percentage <span class="text-danger">*</span></label>
									<input type="text" name="proCGPAPer[]" class="form-control" required="required" autocomplete="off" value="<?php echo $rowDet['aus_ad_cgpa'];?>">
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Language of Instruction <span class="text-danger">*</span></label>
									<select class="form-control" name="prolanguageInstruction[]" required="required">
										<option value="<?php echo $rowDet['aus_ad_instruction'];?>"><?php echo $rowDet['aus_ad_instruction'];?></option>
										<option value="English">English</option>
										<option value="German">German </option>
										<option value="English and German">English and German </option>
									</select>
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Program Application Fee <span class="text-danger">*</span></label>
									<input type="text" name="proAppFee[]" class="form-control" required="required"  autocomplete="off" value="<?php echo $rowDet['aus_ad_application_fee'];?>">
								</div>
								<div class="form-group col-md-3">
									<label class="form-label">Program Tuition Fee <span class="text-danger">*</span></label>
									<input type="text" name="proTuitionFee[]" class="form-control" autocomplete="off" value="<?php echo $rowDet['aus_ad_tuition_fee'];?>">
								</div>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label class="form-label">Language Requirement</label>  <br>
							<div class="checkbox checkbox-success form-check-inline">
								<input type="hidden" id="hidden_engProAccept<?php echo $srVar;?>" name="proEngProfAccept[]" value="<?php echo $rowDet['aus_ad_english_pro'];?>">
								<input type="checkbox" id="engProAccept<?php echo $srVar;?>" name="" onclick="engFunProfAcc(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_english_pro']=='1' ? 'checked' : ''?>>
								<label for="engProAccept"> English Proficiency Letter Acceptable </label>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">IELTS / PTE / Duo lingo / Other</label>
							<input type="text" name="proIELTSPTE[]" class="form-control" autocomplete="off" id="proIELTSPTE<?php echo $srVar;?>" <?= $rowDet['aus_ad_english_pro']=='1' ? 'readonly' : ''?> value="<?php echo $rowDet['aus_ad_ielts_pte'];?>">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">SOP</label>  <br>
							<div class="checkbox checkbox-success form-check-inline">
								<input type="hidden" id="hidden_sopRequired<?php echo $srVar;?>" name="proSOPRequired[]" value="<?php echo $rowDet['aus_ad_sop_required'];?>">
								<input type="checkbox" id="sopRequired<?php echo $srVar;?>" name="" onclick="requiredSOP(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_sop_required']=='1' ? 'checked' : ''?>>
								<label for="sopRequired"> SOP Required </label>
							</div>
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">SOP Note</label>
							<input type="text" name="proSOPNote[]" class="form-control" autocomplete="off" <?= $rowDet['aus_ad_sop_required']=='1' ? '' : 'readonly'?> id="showNoteSOP<?php echo $srVar;?>" value="<?php echo $rowDet['aus_ad_sop_note'];?>">
						</div>
						
						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_degreeRequired<?php echo $srVar;?>" name="proDegreeRequired[]" value="<?php echo $rowDet['aus_ad_degree_required'];?>">
								<input type="checkbox" id="degreeRequired<?php echo $srVar;?>" name="" onclick="funDegreeRequired(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_degree_required']=='1' ? 'checked' : ''?>>
								<label for="degreeRequired<?php echo $srVar;?>"> Degree Required </label>
							</div>

							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_recommendation<?php echo $srVar;?>" name="proRecommendation[]" value="<?php echo $rowDet['aus_ad_recommendation'];?>">
								<input type="checkbox" id="recommendation<?php echo $srVar;?>" name="" onclick="funRecommendation(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_recommendation']=='1' ? 'checked' : ''?>>
								<label for="recommendation<?php echo $srVar;?>"> Recommendation </label>
							</div>
						</div>
						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_normalCV<?php echo $srVar;?>" name="proNormalCV[]" value="<?php echo $rowDet['aus_ad_normal_cv'];?>">
								<input type="checkbox" id="normalCV<?php echo $srVar;?>" name="" onclick="funNormalCV(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_normal_cv']=='1' ? 'checked' : ''?>>
								<label for="normalCV<?php echo $srVar;?>"> Normal CV </label>
							</div>

							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_europassCV<?php echo $srVar;?>" name="proEuropassCV[]" value="<?php echo $rowDet['aus_ad_europass_cv'];?>">
								<input type="checkbox" id="europassCV<?php echo $srVar;?>" name="" onclick="funEuropassCV(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_europass_cv']=='1' ? 'checked' : ''?>>
								<label for="europassCV<?php echo $srVar;?>"> Europass CV </label>
							</div>
						</div>

						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_gmatGreTest<?php echo $srVar;?>" name="progmatGreTest[]" value="<?php echo $rowDet['aus_ad_gmat_gre_test'];?>">
								<input type="checkbox" id="gmatGreTest<?php echo $srVar;?>" name="" onclick="fungmatGreTest(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_gmat_gre_test']=='1' ? 'checked' : ''?>>
								<label for="gmatGreTest<?php echo $srVar;?>"> GMAT/ GRE Test </label>
							</div>
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_entryTest<?php echo $srVar;?>" name="proentryTest[]" value="<?php echo $rowDet['aus_ad_entry_test'];?>">
								<input type="checkbox" id="entryTest<?php echo $srVar;?>" name="" onclick="funentryTest(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_entry_test']=='1' ? 'checked' : ''?>>
								<label for="entryTest<?php echo $srVar;?>"> Entry Test </label>
							</div>
						</div>

						<div class="form-group col-md-2">
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_textInterview<?php echo $srVar;?>" name="protextInterview[]" value="<?php echo $rowDet['aus_ad_test_interview'];?>">
								<input type="checkbox" id="textInterview<?php echo $srVar;?>" name="" onclick="funTestInterview(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_test_interview']=='1' ? 'checked' : ''?>>
								<label for="textInterview<?php echo $srVar;?>"> Any Interview Required </label>
							</div>
							<div class="checkbox checkbox-success form-check-inline mt-2">
								<input type="hidden" id="hidden_legDocument<?php echo $srVar;?>" name="prolegDocument[]" value="<?php echo $rowDet['aus_ad_leg_document'];?>">
								<input type="checkbox" id="legDocument<?php echo $srVar;?>" name="" onclick="funlegDocument(<?php echo $srVar;?>);" <?= $rowDet['aus_ad_leg_document']=='1' ? 'checked' : ''?>>
								<label for="legDocument<?php echo $srVar;?>"> Apply with legalized documents </label>
							</div>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Previous Relevant Degree </label>
							<input type="text" name="propreRelevantDegree[]" class="form-control" autocomplete="off" value="<?php echo $rowDet['aus_ad_previous_relevant'];?>">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Application Process <span class="text-danger">*</span></label>
							<select class="form-control" name="applicationProcess[]" required="required">
								<option value="<?php echo $rowDet['aus_ad_application_process'];?>"><?php echo $rowDet['aus_ad_application_process'];?></option>
								<option value="Online">Online</option>
								<option value="Courier">Courier </option>
								<option value="Online and Courier">Online and Courier </option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Intake <span class="text-danger">*</span></label>
							<select class="form-control" name="proIntake[]" required="required">
								<option value="<?php echo $rowDet['aus_ad_intake'];?>"><?php echo $rowDet['aus_ad_intake'];?></option>
								<option value="March">March</option>
								<option value="October">October </option>
								<option value="March / October">March / October </option>
							</select>
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Overall Intake <span class="text-danger">*</span></label>
							<input type="text" name="proRound[]" class="form-control" required="required" autocomplete="off" value="<?php echo $rowDet['aus_ad_round'];?>">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Current Intake <span class="text-danger">*</span></label>
							<input type="text" name="proCurrentRound[]" class="form-control" required="required" autocomplete="off" value="<?php echo $rowDet['aus_ad_current_round'];?>">
						</div>
						<?php if($rowDet['aus_ad_current_round']=='1'){ 
							$openingDate = $rowDet['aus_ad_1st_opening_date'];
							$actualDate = $rowDet['aus_ad_1st_actual_date'];
						}elseif($rowDet['aus_ad_current_round']=='2'){
							$openingDate = $rowDet['aus_ad_2nd_opening_date'];
							$actualDate = $rowDet['aus_ad_2nd_actual_date'];
						} ?>
						<div class="form-group col-md-3">
							<label class="form-label">Current Intake Opening Date </label>
							<input type="date" name="openingDate[]" class="form-control" autocomplete="off" value="<?php echo $openingDate;?>">
						</div>
						<div class="col-md-3">
							<label class="form-label">Current Intake Actual Deadline </label>
							<input type="date" name="actualDeadline[]" class="form-control" autocomplete="off" value="<?php echo $actualDate;?>">
						</div>
						<div class="form-group col-md-2">
							<label class="form-label">Next Intake Opening Date <span class="text-danger">*</span></label>
							<input type="date" name="nextOpenDate[]" class="form-control" required="required" autocomplete="off" value="<?php echo $rowDet['aus_ad_next_open_date'];?>">
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">Degree Acceptable </label>
							<select name="degreeAcceptable[]" class="form-control">
								<option value="<?php echo $rowDet['aus_ad_degree_acceptable'];?>"><?php echo $rowDet['aus_ad_degree_acceptable'];?></option>
								<option value="Bachelor 4 Years">Bachelor 4 Years</option>
								<option value="2 Years Bachelor + 2 Years Master">2 Years Bachelor + 2 Years Master</option>
								<option value="Both">Both</option>
							</select>
						</div>
						<div class="form-group col-md-7">
							<label class="form-label">Client's Previous Degree </label>
							<select name="clientPreviousDegree[<?php echo $srVar;?>][]" data-toggle="select3" class="form-control" multiple="">
								 <?php
								 $decodedPrograms = json_decode($rowDet['aus_ad_client_pre_degree'], true) ?: [];
								 // fetch all available degrees
								 $uniDetails = "SELECT pre_degree_name FROM previous_client_degrees WHERE status='1' AND close='1' ORDER BY pre_degree_id DESC";
								 $uniDetails_ex = mysqli_query($con, $uniDetails);
								 foreach ($uniDetails_ex as $rowPre) {
								 	$preName = $rowPre['pre_degree_name'];
								 	$selected = in_array($preName, $decodedPrograms) ? 'selected' : '';
								 	?>
								 	<option value="<?php echo htmlspecialchars($preName);?>" <?php echo $selected; ?>><?php echo ucwords($preName); ?> </option>
								 <?php } ?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label class="form-label">This admission letter is valid for how many intakes? <span class="text-danger">*</span></label>
							<select class="form-control" name="admissionValid[]" required="required">
								<option value="<?php echo $rowDet['aus_ad_admission_valid'];?>"><?php echo $rowDet['aus_ad_admission_valid'];?></option>
								<option value="1 intake">1 intake</option>
								<option value="2 intake">2 intake</option>
								<option value="3 intake">3 intake</option>
							</select>
						</div>
						<div class="form-group col-md-7">
							<label class="form-label">Note for Admission Head </label>
							<textarea name="proNoteHead[]" class="form-control"><?php echo $rowDet['aus_ad_note_head'];?></textarea>
						</div>
						<div class="form-group col-md-1">
							<label>Status</label><br>
							<button type="button" class="btn btn-danger btn-sm" onclick="delRow(<?php echo $srVar;?>);"><i class="mdi mdi-trash-can"></i></button>
						</div>
						<hr width="100%" style="border: 2px solid black;">
					</div>
				</div>
				<?php $srVar++;} ?>
				<input type="hidden" name="" value="<?php echo $srVar;?>" id="varInputID">
				<div class="col-md-12" id="showNewPrograms"></div>
				<div class="form-group col-md-12">
					<button type="button" class="btn btn-primary col-md-12" onclick="addNewPrograms(2);"><i class="mdi mdi-plus-circle"></i> Add More Program Name</button>
				</div>
				
				<div class="form-group col-md-12">
					<label>Note</label>
					<textarea class="form-control" name="programNote" id="editor">
						<?php echo $row['aus_ap_note'];?>
					</textarea>
				</div>
				<script>
					$('[data-toggle="select2"]').select2();
					$('[data-toggle="select3"]').select2();
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
			<?php } ?>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updAddProgram"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>
		</div>
	</form>
<?php }

// Delete university
if (isset($_POST['idAddPro'])) {
	$idAddPro = $_POST['idAddPro'];
	$actProStatus = $_POST['actProStatus'];

	if($actProStatus=='0'){
		$del_query = "UPDATE austria_add_programs".$_SESSION['dbNo']." SET aus_active_status='1' WHERE aus_ap_id='".$idAddPro."'";
		$del_query_ex = mysqli_query($con,$del_query);
		echo '1';
	}elseif($actProStatus=='1'){
		$del_query = "UPDATE austria_add_programs".$_SESSION['dbNo']." SET aus_active_status='0' WHERE aus_ap_id='".$idAddPro."'";
		$del_query_ex = mysqli_query($con,$del_query);
		echo '0';
	}
}

if (isset($_POST['idAddDetPro'])) {
	$idAddDetPro = $_POST['idAddDetPro'];
	$actDetProStatus = $_POST['actDetProStatus'];

	if($actDetProStatus=='0'){
		$del_query = "UPDATE austria_add_programs_details".$_SESSION['dbNo']." SET aus_ad_status='1' WHERE aus_apd_id='".$idAddDetPro."'";
		$del_query_ex = mysqli_query($con,$del_query);
		echo '1';
	}elseif($actDetProStatus=='1'){
		$del_query = "UPDATE austria_add_programs_details".$_SESSION['dbNo']." SET aus_ad_status='0' WHERE aus_apd_id='".$idAddDetPro."'";
		$del_query_ex = mysqli_query($con,$del_query);
		echo '0';
	}
}


?>