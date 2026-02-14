<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Delete university
if (isset($_POST['uniAddDel'])) {
	$uniAddDel = $_POST['uniAddDel'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $uniAddDel;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University Delete <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label>Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" required="required" autocomplete="off" placeholder="Enter Password" onkeyup="checkDelPassword(3)" id="delUniPassword3">
				</div>
				<div class="form-group col-md-12">
					<label>Delete Note</label>
					<textarea class="form-control" name="uniDelNote" id="editor2" required="required">

					</textarea>
				</div>
				<script>
					document.querySelector("form").addEventListener("submit", function (e) {
						var editorContent = CKEDITOR.instances.editor2.getData().trim();
						if (editorContent === "") {
							// alert("Delete Note is required.");
							e.preventDefault();
						}
					});
					var editor = CKEDITOR.replace('editor2');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" id="delBtn" disabled name="updDelUni"><i class="mdi mdi-upload"></i> Delete</button>
				</div>
			</div>
		</div>
	</form>
<?php
}

// Add note of programs
if (isset($_POST['uniAddNew'])) {
	$uniAddNew = $_POST['uniAddNew'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-5">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="uniName" class="form-control" required="required"  autocomplete="off" placeholder="Enter University Name">
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Degree Name <span class="text-danger">*</span></label>
					<select class="form-control" name="uniDegree" required="required">
						<option selected value disabled class="text-center">--- Select Degree ---</option>
						<option value="bachelor">Bachelor</option>
						<option value="master">Master</option>
						<option value="phd">PHD</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Status <span class="text-danger">*</span></label>
					<select class="form-control" name="uniStatus" required="required">
						<option selected value disabled class="text-center">--- Select Status ---</option>
						<option value="public">Public</option>
						<option value="private">Private</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label>Application Process <span class="text-danger">*</span></label> <br>
					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hidden_directApply" name="uniDirectApply" value="0">
						<input type="checkbox" id="directApply" name="">
						<label for="directApply"> Direct Apply</label>
					</div>

					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hidden_courierApply" name="uniCourierApply" value="0">
						<input type="checkbox" id="courierApply" name="">
						<label for="courierApply"> Courier Apply </label>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">How Many Programs Can You Select in This University? <span class="text-danger">*</span></label>
					<select class="form-control" name="programSelect" required="required">
						<option selected value disabled class="text-center">--- Select Programs ---</option>
						<option value="1 Program">1 Program</option>
						<option value="2 Program">2 Program</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Program’s Apply Method <span class="text-danger">*</span></label>
					<select class="form-control" name="programApply" required="required">
						<option selected value disabled class="text-center">--- Select Apply Method ---</option>
						<option value="Apply for both programs separately">Apply for both programs separately</option>
						<option value="Apply for both programs together">Apply for both programs together</option>
					</select>
				</div>
				
				<div class="form-group col-md-4">
					<label class="form-label">Register Account Link </label>
					<input type="text" name="uniRegisterlink" class="form-control" autocomplete="off" placeholder="Enter Register Account Link">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Apply Link </label>
					<input type="text" name="uniApplylink" class="form-control" autocomplete="off" placeholder="Enter Apply Link">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Deadline Link </label>
					<input type="text" name="uniDeadline" class="form-control" autocomplete="off" placeholder="Enter Deadline Link">
				</div>
				<div class="form-group col-md-12">
					<label>Requirments Note</label>
					<textarea class="form-control" name="uniReqNote" id="editor">

					</textarea>
				</div>
				<div class="form-group col-md-12">
					<label>Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" autocomplete="off" placeholder="Enter Password" onkeyup="checkDelPassword(1)" id="delUniPassword1">
				</div>
				<script>
					var editor = CKEDITOR.replace('editor');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" id="delBtn" name="subAddUni"><i class="mdi mdi-upload"></i> Submit</button>
				</div>
			</div>
		</div>
	</form>
<?php 
}

// Add note of programs
if (isset($_POST['uniAddEdit'])) {
	$uniAddEdit = $_POST['uniAddEdit'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $uniAddEdit;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University Details <span class="text-danger">*</span>
			</legend>
			<?php 
			$select_query = "SELECT * from austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND (close='0' || close='1') AND aus_add_id='".$uniAddEdit."' ";
			$select_query_ex = mysqli_query($con,$select_query);
			foreach ($select_query_ex as $row) {
			?>
			<div class="row">
				<div class="form-group col-md-5">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="uniName" class="form-control" required="required" autocomplete="off" value="<?php echo $row['aus_uni_name'];?>">
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Degree Name <span class="text-danger">*</span></label>
					<select class="form-control" name="uniDegree" required="required">
						<option value="bachelor" <?php echo $row['aus_uni_degree'] == 'bachelor' ? 'selected' : '';?>>Bachelor</option>
						<option value="master" <?php echo $row['aus_uni_degree'] == 'master' ? 'selected' : '';?>>Master</option>
						<option value="phd" <?php echo $row['aus_uni_degree'] == 'phd' ? 'selected' : '';?>>PHD</option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Status <span class="text-danger">*</span></label>
					<select class="form-control" name="uniStatus" required="required">
						<option value="public" <?php echo $row['aus_uni_status'] == 'public' ? 'selected' : '';?>>Public</option>
						<option value="private" <?php echo $row['aus_uni_status'] == 'private' ? 'selected' : '';?>>Private</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label>Application Process <span class="text-danger">*</span></label> <br>
					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hiddenUp_directApply" name="uniDirectApply" value="<?php echo $row['aus_uni_direct_apply'];?>">
						<input type="checkbox" id="directApply" name="" <?= $row['aus_uni_direct_apply']=='1' ? 'checked' : ''?>>
						<label for="directApply"> Direct Apply</label>
					</div>

					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hiddenUp_courierApply" name="uniCourierApply" value="<?php echo $row['aus_uni_courier_apply'];?>">
						<input type="checkbox" id="courierApply" name="" <?= $row['aus_uni_courier_apply']=='1' ? 'checked' : ''?>>
						<label for="courierApply"> Courier Apply </label>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">How Many Programs Can You Select in This University? <span class="text-danger">*</span></label>
					<select class="form-control" name="programSelect" required="required">
						<option value="<?php echo $row['aus_uni_program_select'];?>"><?php echo $row['aus_uni_program_select'];?></option>
						<option value="1 Program">1 Program</option>
						<option value="2 Program">2 Program</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Program’s Apply Method <span class="text-danger">*</span></label>
					<select class="form-control" name="programApply" required="required">
						<option value="<?php echo $row['aus_uni_program_apply'];?>"><?php echo $row['aus_uni_program_apply'];?></option>
						<option value="Apply for both programs separately">Apply for both programs separately</option>
						<option value="Apply for both programs together">Apply for both programs together</option>
					</select>
				</div>
				
				<div class="form-group col-md-4">
					<label class="form-label">Register Account Link </label>
					<input type="text" name="uniRegisterlink" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_register_link'];?>">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Apply Link </label>
					<input type="text" name="uniApplylink" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_apply_link'];?>">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Deadline Link </label>
					<input type="text" name="uniDeadline" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_deadline_link'];?>">
				</div>
				
				<div class="form-group col-md-12">
					<label>Requirments Note</label>
					<textarea class="form-control" name="uniReqNote" id="editor1">
						<?php echo $row['aus_uni_req_note'];?>
					</textarea>
				</div>
				<div class="form-group col-md-12">
					<label>Enter Password <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" autocomplete="off" placeholder="Enter Password" onkeyup="checkDelPassword(2)" id="delUniPassword2">
				</div>
				<script>
					var editor = CKEDITOR.replace('editor1');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		<?php } ?>
		</fieldset>
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" id="delBtn" name="updAddUni"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>
		</div>
	</form>
<?php
}

// Add note of programs
if (isset($_POST['uniAddView'])) {
	$uniAddView = $_POST['uniAddView'];
	?>
	<form action="" method="post" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $uniAddView;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University Details <span class="text-danger">*</span>
			</legend>
			<?php 
			$select_query = "SELECT * from austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND (close='1' || close='0') AND aus_add_id='".$uniAddView."' ";
			$select_query_ex = mysqli_query($con,$select_query);
			foreach ($select_query_ex as $row) {
			?>
			<div class="row">
				<div class="form-group col-md-5">
					<label class="form-label">University Name <span class="text-danger">*</span></label>
					<input type="text" name="uniName" class="form-control" required="required"  autocomplete="off" value="<?php echo $row['aus_uni_name'];?>" readonly="">
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Degree Name <span class="text-danger">*</span></label>
					<select class="form-control" name="uniDegree" required="required" disabled="">
						<option value="<?php echo $row['aus_uni_degree'];?>"><?php echo $row['aus_uni_degree'];?></option>
					</select>
				</div>
				<div class="form-group col-md-2">
					<label class="form-label">Status <span class="text-danger">*</span></label>
					<select class="form-control" name="uniStatus" required="required" disabled="">
						<option value="public" <?php echo $row['aus_uni_status'] == 'public' ? 'selected' : '';?>>Public</option>
						<option value="private" <?php echo $row['aus_uni_status'] == 'private' ? 'selected' : '';?>>Private</option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label>Application Process <span class="text-danger">*</span></label> <br>
					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hiddenUpd_directApply" name="uniDirectApply" value="<?php echo $row['aus_uni_direct_apply'];?>">
						<input type="checkbox" id="directApply" name="" <?= $row['aus_uni_direct_apply']=='1' ? 'checked' : ''?> disabled="">
						<label for="directApply"> Direct Apply</label>
					</div>

					<div class="checkbox checkbox-success form-check-inline">
						<input type="hidden" id="hiddenUpd_courierApply" name="uniCourierApply" value="<?php echo $row['aus_uni_courier_apply'];?>">
						<input type="checkbox" id="courierApply" name="" <?= $row['aus_uni_courier_apply']=='1' ? 'checked' : ''?> disabled="">
						<label for="courierApply"> Courier Apply </label>
					</div>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">How Many Programs Can You Select in This University? <span class="text-danger">*</span></label>
					<select class="form-control" name="programSelect" required="required" disabled="">
						<option value="<?php echo $row['aus_uni_program_select'];?>"><?php echo $row['aus_uni_program_select'];?></option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<label class="form-label">Program’s Apply Method <span class="text-danger">*</span></label>
					<select class="form-control" name="programApply" required="required" disabled="">
						<option value="<?php echo $row['aus_uni_program_apply'];?>"><?php echo $row['aus_uni_program_apply'];?></option>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Register Account Link </label>
					<input type="text" name="uniRegisterlink" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_register_link'];?>" readponly="">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Apply Link </label>
					<input type="text" name="uniApplylink" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_apply_link'];?>" readponly=""> 
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Deadline Link </label>
					<input type="text" name="uniDeadline" class="form-control" autocomplete="off" value="<?php echo $row['aus_uni_deadline_link'];?>" readponly="">
				</div>
				
				<div class="form-group col-md-12">
					<label>Requirments Note</label>
					<textarea class="form-control" name="uniReqNote" id="editor1" disabled="">
						<?php echo $row['aus_uni_req_note'];?>
					</textarea>
				</div>
				<script>
					var editor = CKEDITOR.replace('editor1');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				University Delete <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label>Delete Note</label>
					<textarea class="form-control" name="uniDelNote" id="editor2" disabled="">
						<?php echo $row['aus_uni_del_note'] ?>
					</textarea>
				</div>
				<script>
					var editor = CKEDITOR.replace('editor2');
					CKFinder.setupCKEditor(editor);
				</script>
			</div>
		</fieldset>
		<?php } ?>
	</form>
<?php
}

?>