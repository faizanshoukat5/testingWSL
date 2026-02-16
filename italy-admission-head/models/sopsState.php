<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['SopsDelete'])) {
	$updateID = $_POST['SopsDelete'];

	$updatePro = "UPDATE italy_clients_programs".$_SESSION['dbNo']." SET italy_sops_assign_to='0', italy_sops_assign_date='0000-00-00', italy_sops_program_name='', italy_sops_page_no='', italy_sops_total_words='', italy_sops_note=''  WHERE italy_client_pro_id ='".$updateID."'";
	$updatePro_ex = mysqli_query($con, $updatePro);
}

//////////////////////////////////// Assign SOP's To team //////////////////////////////////////////
if (isset($_POST['sopsAssign'])) {
	$sopsAssign = $_POST['sopsAssign'];
	?>
	<div class="row">
		<div class="col-md-12">
			<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateID" value="<?php echo $sopsAssign;?>">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						Assign SOP's <span class="text-danger">*</span>
					</legend>
					<div class="row">
						<div class="form-group col-md-3">
							<label class="form-label">Select Team <span class="text-danger">*</span></label>
							<select class="form-control" data-toggle="select2" name="assignSOP" autocomplete="off" required="required">
								<option selected value disabled class="text-center">--- Select Team ---</option>
								<?php 
								$select_query = "SELECT * from wt_users WHERE status='1' AND close='1' AND type='italy university sop' ";
								$select_query_ex = mysqli_query($con,$select_query);
								foreach ($select_query_ex as $row) {
								?>
								<option value="<?php echo $row['wt_id'];?>"> <?php echo ucwords($row['fname']." ".$row['lname']);?> </option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">Program Name </label>
							<input type="text" name="programNameSOP" class="form-control" autocomplete="off">
						</div>
						<div class="form-group col-md-3">
							<label class="form-label">Page Number <span class="text-danger">*</span></label>
							<input type="float" name="pageNoSOP" class="form-control" required="required" autocomplete="off" oninput="validateNumberInput(this)">
						</div>

						<div class="form-group col-md-3">
							<label class="form-label">Total Words </label>
							<input type="float" name="totalWordsSOP" class="form-control" autocomplete="off" oninput="validateNumberInput(this)">
						</div>
						<div class="form-group col-md-12">
							<label class="form-label">Any Note </label>
							<textarea name="noteSOP" class="form-control" autocomplete="off"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<button class="btn btn-custom" type="submit" name="updAssignSOP"><i class="mdi mdi-upload"></i> Assign SOP's</button>
							</div>
						</div>
					</div>
				</fieldset>
				<script type="text/javascript">$('[data-toggle="select2"]').select2();$(".parsley-examples").parsley();</script>
			</form>
		</div>

		<div class="col-md-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">
					View Assign SOP's <span class="text-danger">*</span>
				</legend>
				<div class="table-responsive">
					<table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="15%">Assign Name</th>
								<th width="20%">Program Name</th>
								<th width="20%">Page</th>
								<th width="20%">Words</th>
								<th width="20%">Note</th>
								<th width="5%">Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$select_query = "SELECT italy_sops_assign_to, italy_sops_program_name, italy_sops_page_no, italy_sops_total_words, italy_sops_note from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id ='".$sopsAssign."' ";
						$select_query_ex = mysqli_query($con,$select_query);
						foreach ($select_query_ex as $row) {
							$sopsToAssign = $row['italy_sops_assign_to'];
							$sopsProgramName = $row['italy_sops_program_name'];
							$sopsPageNo = $row['italy_sops_page_no'];
							$sopsWords = $row['italy_sops_total_words'];
							$sopsNote = $row['italy_sops_note'];
						}
						if ($sopsToAssign!='0') { ?>
						<?php 
						$select_query="SELECT fname, lname from wt_users WHERE status='1' AND close='1' AND wt_id='".$sopsToAssign."' ";
						$select_query_ex = mysqli_query($con,$select_query);
						foreach ($select_query_ex as $Wtrow) {
							$sopName = $Wtrow['fname']." ". $Wtrow['lname'];
						}
						?>
						<tr>
							<td class="breakTD"><?php echo ucwords($sopName);?></td>
							<td class="breakTD"><?php echo ucwords($sopsProgramName) ?></td>
							<td class="breakTD"><?php echo $sopsPageNo;?></td>
							<td class="breakTD"><?php echo $sopsWords;?></td>
							<td class="breakTD"><?php echo $sopsNote;?></td>
							<td><button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign SOP" onclick="del(delSOPs, <?php echo $sopsAssign;?>);"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
						<?php
						}else{
						?>
						<tr>
							<td colspan="6">No data available in table</td>
						</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>

	</div>
	<hr width="100%">
	<div class="row">
		
		<div class="col-md-12">
			<form id="formSOPStatus" enctype="multipart/form-data" class="parsley-examples">
				<input type="hidden" name="updateID" value="<?php echo $sopsAssign;?>">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						SOP's Program <span class="text-danger">*</span>
					</legend>
					<div class="row">
						<div class="form-group col-md-12">
							<label class="form-label">SOP's File Status <span class="text-danger">*</span></label>
							<select class="form-control" name="sopsFileStatus" required="required">
								<option selected value disabled class="text-center">--- Select SOP's File Status ---</option>
								<option value="Changing Required In SOP">Changing Required In SOP</option>
								<option value="SOP Approved">SOP Approved</option>
							</select>
						</div>
						<div class="form-group col-md-8">
							<label class="form-label">Any Note</label>
							<textarea name="sopAnyNote" class="form-control" autocomplete="off"></textarea>
						</div>
						<div class="form-group col-md-4">
							<div class="agreement-container" data-agreement-id="30">
								<label class="form-label">Choose Files <span class="text-danger">* (Select Multi Files)</span></label>
								<div class="d-flex justify-content-center">
									<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
									<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
								</div>
								<input type="file" name="sopFile[]" id="uploadedFiles30" class="form-control" multiple style="display: none;">
								<div class="preview"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<button class="btn btn-custom" type="button" name="updSOPS" onclick="saveDataForm('formSOPStatus', 'updSOPS')" id="updSOPS"><i class="mdi mdi-upload"></i> Update</button>
							</div>
						</div>	
					</div>
				</fieldset>
				<script type="text/javascript">$(".parsley-examples").parsley();</script>
			</form>
		</div>
		<div class="col-md-12">
			<fieldset class="scheduler-border">
				<legend class="scheduler-border">
					View SOP's Files <span class="text-danger">*</span>
				</legend>
				<div class="table-responsive">
					<table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="15%">Sop's Status</th>
								<th width="15%">Date</th>
								<th width="50%">Note</th>
								<th width="20%">File</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$select_query = "SELECT * from italy_program_sops".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_sops_program_id ='".$sopsAssign."' ";
						$select_query_ex = mysqli_query($con,$select_query);
						if (mysqli_num_rows($select_query_ex) > 0) {
							foreach ($select_query_ex as $row) {
							$sopFile = $row['italy_sops_file'];
						?>
							<tr>
								<td class="breakTD"><?php echo ucwords($row['italy_sops_file_status']);?></td>
								<td class="breakTD"><?php echo date("d-m-Y", strtotime($row['italy_sops_date'])) ?></td>
								<td class="breakTD"><?php echo $row['italy_sops_anynote'] ?></td>
								<td class="breakTD">
								<?php 
								$fileMulti = explode(',', $sopFile);
								foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
								<?php } ?>
								</td>
							</tr>
							<?php }
						} else {
							?>
							<tr>
								<td colspan="4">No data available in table</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</fieldset>
		</div>
	</div>

<?php }


// Add university CLosing Opening Date

if (isset($_POST['openingClosingDate'])) {
	$openingClosingDate = $_POST['openingClosingDate'];
	$degreeID = $_POST['degreeID'];
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="table-responsive">
				<table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="15%">Status</th>
							<th width="15%">Opening Date</th>
							<th width="15%">Closing Date</th>
							<th width="55%">Note</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$select_query = "SELECT italy_university_name from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_pro_id ='".$openingClosingDate."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					foreach ($select_query_ex as $row) {
						$uniName = $row['italy_university_name'];
						$selectQuery = "SELECT * from italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='".$uniName."' AND italy_degree_name='".$degreeID."' ";
						$selectQuery_ex = mysqli_query($con,$selectQuery);
						foreach ($selectQuery_ex as $dateRow) {
					?>
						<tr>
							<td class="breakTD">
								<?php if($dateRow['italy_date_status']=='1'){?>
									Yes
								<?php }elseif($dateRow['italy_date_status']=='2'){ ?>
									No
								<?php }else{ ?>
								<?php } ?>
							</td>
							<td class="breakTD">
								<?php 
								if ($dateRow['italy_opening_date']=='0000-00-00') {
									
								}else{
									echo date("d-m-Y", strtotime($dateRow['italy_opening_date']));
								}
								?>
							</td>
							<td class="breakTD">
								<?php 
								if ($dateRow['italy_closing_date']=='0000-00-00') {
									
								}else{
									echo date("d-m-Y", strtotime($dateRow['italy_closing_date']));
								}
								?>
							</td>
							<td class="breakTD"><?php echo $dateRow['italy_note'] ?></td>
						</tr>
					<?php } } ?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
<?php 
}

?>