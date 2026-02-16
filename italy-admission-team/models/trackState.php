<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

////////////////////////////////// Track Client //////////////////////
// view client track
if (isset($_POST['viewClients'])) {
	$clientID = $_POST['viewClients'];
	$select_query = "SELECT * from clients".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$clientCountry = $row['client_country'];
		$changingApplied = $row['client_applied'];
		$appliedChanging = json_decode($changingApplied, true);
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Client Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Subject <span class="text-danger">*</span></label>
					<input type="text" name="subject" class="form-control" required="required" value="<?php echo $row['subject'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Client Name <span class="text-danger">*</span></label>
					<input type="text" name="client_name" class="form-control" required="required" value="<?php echo $row['client_name'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">Email Address <span class="text-danger">*</span></label>
					<input type="email" name="client_email" class="form-control" required="required" value="<?php echo $row['client_email'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-4">
					<label class="form-label">WhatsApp </label>
					<input type="number" name="whatappNo" class="form-control" value="<?php echo $row['client_whatapp'];?>" autocomplete="off" required="required" readonly=""> 
				</div>
				<div class="col-md-12" id="already-msg-up"></div>
				<div class="form-group col-md-3">
					<label class="form-label">Phone </label>
					<input type="number" name="phoneNo" class="form-control" value="<?php echo $row['client_phone'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Country </label>
					<select class="form-control" name="province" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_countryfrom'];?>"><?php echo $row['client_countryfrom'];?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Province </label>
					<select class="form-control" name="province" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_province'];?>"><?php echo $row['client_province'];?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Date <span class="text-danger">*</span></label>
					<input type="date" name="createDate" class="form-control" value="<?php echo $row['create_date'];?>" required="required" readonly="readonly">
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">IELTS/PTE </label>
					<select class="form-control" name="ieltsPte" autocomplete="off" disabled="">
						<option value="<?php echo $row['client_ielts_pte'];?>"><?php echo $row['client_ielts_pte'];?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Score </label>
					<input type="float" name="score" class="form-control" value="<?php echo $row['client_score'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Process Status </label>
					<select class="form-control" name="processStatus" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_process_status'];?>"><?php echo $row['client_process_status'];?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Client Status </label>
					<select class="form-control" name="processStatus" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_convert_status'];?>"><?php echo $row['client_convert_status'];?></option>
					</select>
				</div>
			</div>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Country Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-md-6">
					<label class="form-label">Country <span class="text-danger">*</span></label>
					<select class="form-control" name="country" required="required" autocomplete="off" disabled="">
						<option value="<?php echo $row['client_country'];?>"><?php echo $row['client_country'];?></option>
					</select>
				</div>
				<div class="form-group col-md-6" id="austriaShowUp" style="<?php if ($row['client_country']!='austria') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Client Degree </label>
					<select class="form-control" name="clientcountry" autocomplete="off" disabled="">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
					</select>
				</div>
				<div class="form-group col-md-6" id="canadaShowUp" style="<?php if ($row['client_country']!='canada') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Admission Category </label>
					<select class="form-control" name="clientcountry" autocomplete="off" disabled="">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
					</select>
				</div>
				<div class="form-group col-md-6" id="usaShowUp" style="<?php if ($row['client_country']!='USA') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Admission Category </label>
					<select class="form-control" name="clientcountry" autocomplete="off" disabled="">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
						
					</select>
				</div>
				<div class="form-group col-md-3" id="italyShowUp" style="<?php if ($row['client_country']!='italy') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Client Degree </label>
					<select class="form-control" name="clientcountry" autocomplete="off" disabled="">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow." "; }?></option>
						
					</select>
				</div>
				<div class="form-group col-md-3" id="embassyShowUp" style="<?php if ($row['client_country']!='italy') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Embassy City </label>
					<select class="form-control" name="clientEmbassy" autocomplete="off" disabled="">
						<option value="<?php echo $row['client_embassy'];?>"><?php echo $row['client_embassy'];?></option>
						
					</select>
				</div>
				<div class="form-group col-md-6" id="visitShowUp" style="<?php if ($row['client_country']!='visit') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Visit </label>
					<select class="form-control" name="clientcountry" autocomplete="off" disabled="">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
					</select>
				</div>
			</div>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Note
			</legend>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">Note </label>
					<textarea class="form-control" name="noteDetails" value="<?php echo $row['client_note'];?>" readonly=""><?php echo $row['client_note'];?></textarea>
				</div>
			</div>
		</fieldset>
		
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Agreement 
			</legend>
			<div class="row">
				<div class="form-group col-md-3">
					<label class="form-label">Agreement 1</label>
					<div class="preview d-flex mb-2">
						<?php
						if (!empty($row['client_agg_one'])) {
							$savedFiles = explode(',', $row['client_agg_one']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="preview" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
									<a href="<?php echo $filePath; ?>" target="_blank">
										<?php
										if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
											echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
										} else {
											echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666;'>📄</div>";
										}
										?>
									</a>
								</div>
								<?php
							}
						}else {
							echo "<p>No files found.</p>";
						}
						?>
					</div>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Agreement 2</label>
					<div class="mb-2 preview d-flex">
						<?php
						if (!empty($row['client_agg_two'])) {
							$savedFiles = explode(',', $row['client_agg_two']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="preview" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid; margin: 0px 0px 0 1px; overflow: hidden;">
									<a href="<?php echo $filePath; ?>" target="_blank">
										<?php
										if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
											echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
										} else {
											echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>📄</div>"; }
											?>
										</a>
									</div>
									<?php
								}
							}else {
								echo "<p>No files found.</p>";
							}
							?>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">Agreement 3</label>
						<div class="mb-2 preview d-flex">
							<?php
							if (!empty($row['client_agg_three'])) {
								$savedFiles = explode(',', $row['client_agg_three']);
								foreach ($savedFiles as $savedFile) {
									$savedFile = trim($savedFile);
									$filePath = "../payagreements/" . $savedFile;
									$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
									?>
									<div class="preview" data-file-name="<?php echo $savedFile; ?>"
										style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
										<a href="<?php echo $filePath; ?>" target="_blank">
											<?php
											if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
												echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
											} else {
												echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>📄</div>";
											}
											?>
										</a>
									</div>
									<?php
								}
							}else {
								echo "<p>No files found.</p>";
							}
							?>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">Packege Screenshot</label>
						<div class="mb-2 preview d-flex">
							<?php
							if (!empty($row['packege_shot'])) {
								$savedFiles = explode(',', $row['packege_shot']);
								foreach ($savedFiles as $savedFile) {
									$savedFile = trim($savedFile);
									$filePath = "../payagreements/" . $savedFile;
									$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
									?>
									<div class="preview" data-file-name="<?php echo $savedFile; ?>" style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
										<a href="<?php echo $filePath; ?>" target="_blank">
											<?php
											if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
												echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
											} else {
												echo "
												<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>📄</div>";
											}
											?>
										</a>
									</div>
									<?php
								}
							}else{
								echo "<p>No files found.</p>";
							}
							?>
						</div>
					</div>
					<div class="form-group col-md-3">
						<label class="form-label">WhatsApp ScreenShot <span class="text-danger">*</span></label>
						<div class="mb-2 preview d-flex">
							<?php
							if (!empty($row['whatsapp_screenshot'])) {
								$savedFiles = explode(',', $row['whatsapp_screenshot']);
								foreach ($savedFiles as $savedFile) {
									$savedFile = trim($savedFile);
									$filePath = "../payagreements/" . $savedFile;
									$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
									?>
									<div class="preview" data-file-name="<?php echo $savedFile; ?>"
										style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
										<a href="<?php echo $filePath; ?>" target="_blank">
											<?php
                                    // Check if the file is an image (for image preview)
											if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
												echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
											} else {
                                        // For all other files, show a generic file icon
												echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>📄</div>";
											}
											?>
										</a>
									</div>
									<?php
								}
							}else{
								echo "<p>No files found.</p>";
							}
							?>
						</div>
					</div>

					<div class="form-group col-md-3">
						<label class="form-label">Other Documents</label>
						<div class="preview d-flex mb-2">
							<?php
							$sql = "SELECT * FROM clients_documents".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND clients_id='".$clientID."'";
							$result = mysqli_query($con, $sql);
							$documentsget = (mysqli_num_rows($result) > 0) ? trim(mysqli_fetch_assoc($result)['documents_name']) : '';
							if (!empty($documentsget)) {
								$documentsArray = explode(',', $documentsget);
								foreach ($documentsArray as $savedFile) {
									$savedFile = trim($savedFile);
									$filePath = "../payagreements/" . $savedFile;
									$fileExtension = strtolower(pathinfo($savedFile, PATHINFO_EXTENSION));
									?>
									<div class="preview" data-file-name="<?php echo $savedFile; ?>" style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
										<a href="<?php echo $filePath; ?>" target="_blank">
											<?php
											if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
												echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
											} else {
												echo "
												<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>📄</div>";
											}
											?>
										</a>
									</div>
									<?php
								}
							}else{
								echo "<p>No files found.</p>";
							}
							?>
						</div>
					</div>
				</div>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Admission Documents <span class="text-danger">*</span>
			</legend>
			<button type="button" class="btn btn-custom mb-1" onclick="downloadZip(<?php echo $clientID;?>);">Download All Documents</button>
			<?php include ("../../components/ClientTrack/AdmissionDocumentsView.php"); ?>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Client Program
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Sr No</th>
							<th>University</th>
							<th>Program</th>
							<th>Intake</th>
							<th>Status</th>
							<th>Applied Status</th>
							<th>Assign To</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sr=1; 
					$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND italy_clients_id='".$clientID."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					foreach ($select_query_ex as $rowPro) {
						$wtID = $rowPro['italy_program_assign'];
						?>
						<tr>
							<td><?php echo $sr;?></td>
							<td><?php echo ucwords($rowPro['italy_university_name']);?></td>
							<td class="text-left">
								<?php
								$programName = $rowPro['italy_program_name'];
								$decoded = json_decode($programName, true);
								if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $name) {
										$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
									}
									echo $output;
								} else {
									echo ucwords($programName);
								}
								?>
							</td>
							<td><?php echo ucwords($rowPro['italy_intake']);?></td>
							<td>
							<?php if ($rowPro['italy_info_client_status'] == '12') {
								echo "Applied";
							}elseif ($rowPro['italy_info_client_status'] != '12'){
								echo "N/A";
							}
							?>
							</td>
							<td>
							<?php if ($rowPro['italy_info_client_status']=='0' && $rowPro['italy_applied_status']=='0' ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="This Program Applying Pending" class="badge bg-danger py-1">Apply Pending</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='0' && $rowPro['italy_applied_status']=='1'){ ?>
								<span data-toggle="tooltip" data-placement="top" title="This Program Applying File Checking" class="badge bg-info py-1">File Checking</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='1' && $rowPro['italy_applied_status']=='1'){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Client Wants to change in Appling File" class="badge bg-dark py-1">File Changing</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='1' && $rowPro['italy_applied_status']=='2' ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="File's Are Updated" class="badge bg-warning py-1">File Updated</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='2' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="File's Are Checked by Client" class="badge bg-secondary py-1">File Checked</span>
							<?php }

							elseif ($rowPro['italy_info_client_status']=='3' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Inform client to book date of tolc test" class="badge bg-info py-1">Book tolc date</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='4' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Client booked tolc test date" class="badge bg-dark py-1">Booked tolc date</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='5' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Practice Tolc test" class="badge bg-warning py-1">Practice Tolc test</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='6' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Tolc test will be attempted by client" class="badge bg-dark py-1">Tolc Test attempted</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='7' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Tolc test not attempted by client" class="badge bg-dark py-1">Tolc Test not attempted</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='8' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Negative response of Tolc test" class="badge bg-dark py-1">Negative Response</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='9' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Positive Response (Result) of Tolc Test" class="badge bg-dark py-1">Positive Response</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='10' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Pay Application Fee" class="badge bg-info py-1">Pay Fee</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='11' && ($rowPro['italy_applied_status']=='2' || $rowPro['italy_applied_status']=='1' ) ){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Applicaton Fee Paid by client" class="badge bg-success py-1">Fee Paid</span>
							<?php } 
							elseif (($rowPro['italy_info_client_status']=='11' || $rowPro['italy_info_client_status']=='10') && $rowPro['italy_applied_status']=='3'){ ?>
								<span data-toggle="tooltip" data-placement="top" title="Info To Client" class="badge bg-info py-1">Info to Client</span>
							<?php }
							elseif ($rowPro['italy_info_client_status']=='12' && $rowPro['italy_applied_status']=='3'){ ?>
								<span data-toggle="tooltip" data-placement="top" title="This Program Applied" class="badge bg-success py-1">Applied</span>
							<?php } ?>
							</td>
							<?php if($rowPro['italy_assign_status'] == 1) { 
							$wt_query = "SELECT * from wt_users WHERE status='1' AND close='1' AND wt_id='".$wtID."' ";
							$wt_query_ex = mysqli_query($con,$wt_query);
							foreach ($wt_query_ex as $wtrow) {
								$wtName = $wtrow['fname']." ".$wtrow['lname'];
							}
							?>
							<td><?php echo ucwords($wtName);?></td>
							<?php }else{ ?>
							<td></td>
							<?php } ?>
						</tr>
						<?php $sr++; } ?>
					</tbody>
				</table>
			</div>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Check Lists <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="5%">Sr No</th>
							<th width="15%">Checklist Name</th>
							<th width="40%">File</th>
							<th width="40%">Audio</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr=1;
						$select_query="SELECT * FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_check_id='".$clientID."'";
						$select_query_ex = mysqli_query($con,$select_query);
						foreach ($select_query_ex as $checkrow) {
							$changingFileAudio = $checkrow['italy_checklist_audio'];
							$audiochanging = json_decode($changingFileAudio, true);
						?>
						<tr id="<?php echo $checkrow['italy_checklist_id']?>">
							<td><?php echo $sr; ?></td>
							<td><?php echo ucwords($checkrow['italy_checklist_name']);?></td>
							<td><a href="../payagreements/<?php echo $checkrow['italy_checklist_file']; ?>" target="_blank"><?php echo $checkrow['italy_checklist_file']; ?></a></td>
							<td>
							<?php
							if ($audiochanging !== null) {
								foreach ($audiochanging as $audioRow) {
							?>
							<audio controls>
								<source src="../payagreements/<?php echo $audioRow; ?>" type="audio/ogg">
								<source src="../payagreements/<?php echo $audioRow; ?>" type="audio/mpeg">
								Your browser does not support the audio element.
							</audio> <br>
							<?php
								}
							}else {
								echo "";
							}
							?>
							</td>
						</tr>
						<?php $sr++; } ?>
					</tbody>
				</table>
			</div>
		</fieldset>
		
		
	</form>

<?php } ?>
<?php }

?>