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
					<textarea class="form-control" name="delUniNote" id="editorDelUni" required="required"></textarea>
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
					<button class="btn btn-custom" type="button" name="delUniBtn" onclick="saveDataForm('formDelUni', 'delUniBtn');" id="delUniBtn" disabled><i class="mdi mdi-upload"></i> Delete</button>
				</div>
			</div>
		</div>
	</form>
<?php
}


// programs change get status
if (isset($_POST['czechProgramChange'])) {
	$czechProgramChange = $_POST['czechProgramChange'];
	$clientID = $_POST['clientUpdateID'];
	$clientDegree = $_POST['clientDegree'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="appliedName" id="appliedNameID" value="<?php echo $clientDegree;?>">
		<input type="hidden" name="clientUpdateID" value="<?php echo $clientID;?>">
		<input type="hidden" name="updateProID" value="<?php echo $czechProgramChange;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Programs Details <span class="text-danger">*</span>
			</legend>
			<?php if($clientDegree=='bachelor' || $clientDegree=='master' || $clientDegree=='phd'){ ?>
				<div class="table-responsive">
					<h4><?php echo ucwords($clientDegree);?> Programs</h4>
					<table class="table table-striped table-bordered nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="30%">University</th>
								<th width="30%">Program</th>
								<th width="25%">Intake</th>
								<th width="15%">Status</th>
							</tr>
						</thead>
						<tbody id="showCzech">
							<tr>
								<td>
									<div class="form-group col-md-12">
										<select class="form-control" data-toggle="select2" name="uniName[]" autocomplete="off" required="required" onchange="setUniProgram(this.value,'<?php echo $clientDegree; ?>', 'showuniReltProg0', 'austria_add_programs_details', 'aus_ad_uni_name', 'aus_ad_degree', 'aus_ad_program_name')" id="uniOtherCzechName0">
											<option value="" selected disabled class="text-center">--- Select University ---</option>
											<?php
											$uniDetails = "SELECT aus_uni_name FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_degree='".$clientDegree."' ORDER BY aus_add_id ASC";
											$uniDetails_ex = mysqli_query($con, $uniDetails);
											foreach ($uniDetails_ex as $rowMB) {
											?>
											<option value="<?php echo $rowMB['aus_uni_name'];?>"><?php echo $rowMB['aus_uni_name'];?></option>
											<?php } ?>
										</select>
									</div>
								</td>
								<td>
									<div id="applyshowuniReltProg0"></div>
									<div class="col-md-12">
										<select class="form-control" data-toggle="select3" multiple name="programName[0][]" autocomplete="off" placeholder="Choose" required="required" id="showuniReltProg0">
											<option value="" disabled class="text-center">--- Select Program ---</option>
											<!-- Dynamic programs shown here -->
										</select>
									</div> 
								</td>
								<td>
									<div class="col-md-12">
										<input type="text" name="intakeName[]" class="form-control" autocomplete="off"
										placeholder="Enter intake">
									</div>
								</td>
								<td>
									<button class="btn btn-outline-danger" type="button"><i class="mdi mdi-check-bold"></i></button>
								</td>
							</tr>
						</tbody>
						<tbody>
							<select id="cze<?php echo $clientDegree; ?>Universities" style="display: none;">
								<?php
								$queryMaster = "SELECT aus_uni_name FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_degree='".$clientDegree."' ORDER BY aus_add_id ASC";
								$resultMaster = mysqli_query($con, $queryMaster);
								while ($row = mysqli_fetch_assoc($resultMaster)) {
									echo "<option value='".$row['aus_uni_name']."'>".$row['aus_uni_name']."</option>";
								}
								?>
							</select>
							<tr>
								<td colspan="4">
									<div class="form-group col-md-12">
										<button type="button" class="col-md-12 btn btn-outline-success" onclick="austriaProgram();"><i class="mdi mdi-plus"></i> Add Program</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php
				}
			?>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="czechSubProgram"><i class="mdi mdi-upload"></i> Submit</button>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('[data-toggle="select2"]').select2();
			$('[data-toggle="select3"]').select2();
			$(".parsley-examples").parsley();
		</script>
	</form>
<?php }

// programs change get status
if (isset($_POST['clientID'])) {
	$clientID = $_POST['clientID'];
	$clientDegree = $_POST['clientDegree'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="appliedName" id="appliedNameID" value="<?php echo $clientDegree;?>">
		<input type="hidden" name="clientUpdateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Programs Details <span class="text-danger">*</span>
			</legend>
				<div class="table-responsive">
					<h4><?php echo ucwords($clientDegree);?> Programs</h4>
					<table class="table table-striped table-bordered nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="30%">University</th>
								<th width="30%">Program</th>
								<th width="25%">Intake</th>
								<th width="15%">Status</th>
							</tr>
						</thead>
						<tbody id="showCzech">
							<tr>
								<td>
									<div class="form-group col-md-12">
										<select class="form-control" data-toggle="select2" name="uniName[]" autocomplete="off" required="required" onchange="checkOtherAustriaUni(0); setUniProgram(this.value,'<?php echo $clientDegree; ?>', 'showuniReltProg0', 'austria_add_programs_details', 'aus_ad_uni_name', 'aus_ad_degree', 'aus_ad_program_name')" id="uniOtherCzechName0">
											<option value="" selected disabled class="text-center">--- Select University ---</option>
											<?php
											$uniDetails = "SELECT aus_uni_name, aus_uni_direct_apply, aus_uni_courier_apply FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_degree='".$clientDegree."' ORDER BY aus_add_id ASC";
											$uniDetails_ex = mysqli_query($con, $uniDetails);
											foreach ($uniDetails_ex as $rowMB) {
											?>
											<option value="<?php echo $rowMB['aus_uni_name'];?>" data-direct-id="<?php echo $rowMB['aus_uni_direct_apply'];?>" data-courier-id="<?php echo $rowMB['aus_uni_courier_apply'];?>"><?php echo $rowMB['aus_uni_name'];?></option>
											<?php } ?>
										</select>
									</div>
									<input type="" name="uniDirectApply[]" id="uniDirectApply0">
	                                <input type="" name="uniCourier[]" id="uniCourier0">
								</td>
								<td>
									<div id="applyshowuniReltProg0"></div>
									<div class="col-md-12">
										<select class="form-control" data-toggle="select3" multiple name="programName[0][]" autocomplete="off" placeholder="Choose" required="required" id="showuniReltProg0">
											<option value="" disabled class="text-center">--- Select Program ---</option>
											<!-- Dynamic programs shown here -->
										</select>
									</div>
								</td>
								<td>
									<div class="col-md-12">
										<input type="text" name="intakeName[]" class="form-control" autocomplete="off"
										placeholder="Enter intake">
									</div>
								</td>
								<td>
									<button class="btn btn-outline-danger" type="button"><i class="mdi mdi-check-bold"></i></button>
								</td>
							</tr>
						</tbody>
						<tbody>
							<select id="cze<?php echo $clientDegree; ?>Universities" style="display: none;">
								<?php
								$queryMaster = "SELECT aus_uni_name, aus_uni_direct_apply, aus_uni_courier_apply FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_degree='".$clientDegree."' ORDER BY aus_add_id ASC";
								$resultMaster = mysqli_query($con, $queryMaster);
								while ($row = mysqli_fetch_assoc($resultMaster)) {
									echo "<option value='".$row['aus_uni_name']."'>".$row['aus_uni_name']."</option>";
								}
								?>
							</select>
							<tr>
								<td colspan="4">
									<div class="form-group col-md-12">
										<button type="button" class="col-md-12 btn btn-outline-success" onclick="austriaProgram();"><i class="mdi mdi-plus"></i> Add Program</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="czechSubNewProgram"><i class="mdi mdi-upload"></i> Submit</button>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('[data-toggle="select2"]').select2(); 
			$('[data-toggle="select3"]').select2(); 
			$(".parsley-examples").parsley();
		</script>
	</form>
<?php }

// Here Chaneg all the Programs according to the uni name
if (isset($_POST['checkUniName'])) {
	$getUniname = $_POST['checkUniName'];
	$getdegtype = $_POST['checktypeDeg'];
	$gettabName = $_POST['checkTable'];
	$getuniCol = $_POST['checkUniCol'];
	$getdegCol = $_POST['checkdegCol'];
	$getprogCol = $_POST['checkprogCol'];

	$progUniDetails = "SELECT * FROM $gettabName".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND $getuniCol='".$getUniname."' AND $getdegCol='".$getdegtype."'";
	$progUniDetails_ex = mysqli_query($con, $progUniDetails);

	// DEBUG log request + result count
	$__dbg_ajax = __DIR__ . '/../../tools/debug_ajax.json';
	@mkdir(dirname($__dbg_ajax), 0777, true);
	file_put_contents($__dbg_ajax, json_encode(['ts'=>time(), 'action'=>'checkUniName', 'uni'=>$getUniname, 'deg'=>$getdegtype, 'sql'=>$progUniDetails, 'rows'=> ($progUniDetails_ex ? mysqli_num_rows($progUniDetails_ex) : 0)], JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

	foreach ($progUniDetails_ex as $rowUP) {
		?>
		<option value="<?php echo $rowUP[$getprogCol];?>"><?php echo $rowUP[$getprogCol];?></option>
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

	$uniSelectPro = "SELECT $uniProgSelectCol, $uniProgramCol from $uniTable".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND $uniNameCol='".$uniSelectName."' AND $degreeNameCol='".$unidegtype."' ";
	$uniSelectPro_ex = mysqli_query($con,$uniSelectPro);

	// DEBUG log request + result
	$__dbg_ajax = __DIR__ . '/../../tools/debug_ajax.json';
	@mkdir(dirname($__dbg_ajax), 0777, true);
	file_put_contents($__dbg_ajax, json_encode(['ts'=>time(), 'action'=>'checkuniSelectName', 'uni'=>$uniSelectName, 'deg'=>$unidegtype, 'sql'=>$uniSelectPro, 'rows'=> ($uniSelectPro_ex ? mysqli_num_rows($uniSelectPro_ex) : 0)], JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);

	if ($uniSelectPro_ex && mysqli_num_rows($uniSelectPro_ex) > 0) {
		$proRow = mysqli_fetch_assoc($uniSelectPro_ex);
		echo $uniSelectPro = $proRow[$uniProgSelectCol]." // ".$proRow[$uniProgramCol];
	}
}

?>