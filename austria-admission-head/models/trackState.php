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
					<select class="form-control" name="clientcountry" autocomplete="off">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
						
					</select>
				</div>
				<div class="form-group col-md-6" id="usaShowUp" style="<?php if ($row['client_country']!='USA') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Admission Category </label>
					<select class="form-control" name="clientcountry" autocomplete="off">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
						
					</select>
				</div>
				<div class="form-group col-md-3" id="italyShowUp" style="<?php if ($row['client_country']!='italy') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Client Degree </label>
					<select class="form-control" name="clientcountry" autocomplete="off">
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
						
					</select>
				</div>
				<div class="form-group col-md-3" id="embassyShowUp" style="<?php if ($row['client_country']!='italy') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Embassy City </label>
					<select class="form-control" name="clientEmbassy" autocomplete="off">
						<option value="<?php echo $row['client_embassy'];?>"><?php echo $row['client_embassy'];?></option>
						
					</select>
				</div>
				<div class="form-group col-md-6" id="visitShowUp" style="<?php if ($row['client_country']!='visit') { ?> display: none; <?php } ?>">
					<label class="form-label">Select Visit </label>
					<select class="form-control" name="clientcountry" autocomplete="off">
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
				Payment Details <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive mt-3">
				<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Sr</th>
							<th>Payment Method</th>
							<th>Adv Amount</th>
							<th>Balance</th>
							<th>After Accept</th>
							<th>After VISA/RP</th>
							<th width="15%">Payment Slip</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$sr=1;
						$totalAdv=0;
						$payClient = "SELECT * FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status = '1' AND pay_client_id = '".$clientID."' "; 
						$payClient_ex = mysqli_query($con, $payClient);
						foreach ($payClient_ex as $payrow) {
							$payMethod = $payrow['pay_method'];
							$sumReceived = $payrow['pay_receive_amount'];
							$sumBalance = $payrow['pay_bal_amount'];
							$pay_due_date = $payrow['pay_due_date'];
							$pay_after_accept = $payrow['pay_after_accept'];
							$pay_aftervisa_rp = $payrow['pay_aftervisa_rp'];
						?>
						<tr id="<?php echo $payrow['cl_pay_id']; ?>">
							<?php 
							echo "<td>".$sr."</td><td>".$payMethod."</td><td>".$sumReceived."</td><td>".$sumBalance." <div style='float:right;color:red;'>";
							$dateString = $pay_due_date;
							if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
								$date = new DateTime($dateString);
								$dueDate = $date->format('d-m-Y');
								$currentDate = date('d-m-Y');
								if ($dueDate == $currentDate) {
									echo " / <span id='blink'>" . $dueDate . "</span>";
								} else {
									echo " / " . $dueDate;
								}
							}
							echo "</div></td><td>".$pay_after_accept."</td><td>".$pay_aftervisa_rp."</td>";
							?>
							
							<td>
								<a href="../payagreements/<?php echo $payrow['pay_screenshot'];?>" download="<?php echo $payrow['pay_screenshot'];?>"><?php echo $payrow['pay_screenshot'];?></a>
							</td>
						</tr>
						<?php
						$sr++;
						$totalAdv += $sumReceived;
						}
						?>
					</tbody>
					<input type="hidden" name="totalReceived" value="<?php echo $totalAdv;?>">
					<thead class="bg-primary text-white">
						<tr>
							<th></th>
							<th>Total</th>
							<th><?php echo $totalAdv;?></th>
							<th><?php echo $sumBalance;?></th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</fieldset>
		

		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Agreement
			</legend>
			<div class="row">

				<div class="form-group col-md-3" id="fileUploadSection1">
					<label for="imageUrl">Agreement 1</label>
					<div class="image-preview-container d-flex mb-2">
						<?php
						if (!empty($row['client_agg_one'])) {
							$savedFiles = explode(',', $row['client_agg_one']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="image-preview-wrapper" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 5px 10px 0 1px; overflow: hidden;">
									<?php
									if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
									}else {
										echo "<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
										<span class='file-icon-text'>📄</span>
										</div>";
									}
									?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if (!empty($row['client_agg_one'])) {
						$fileMulti = explode(',', $row['client_agg_one']);
						foreach ($fileMulti as $fileName) {
							$fileName = trim($fileName);
							?>
							<a href="../payagreements/<?php echo $fileName; ?>" target="_blank"><?php echo $fileName; ?></a><br>
							<?php
						}
					} else {
						echo "<p>No files found.</p>";
					}
					?>
				</div>
				<div class="form-group col-md-3" id="fileUploadSection2">
					<label for="imageUrl">Agreement 2</label>
					<div id="image-preview-container2" class="mb-2 image-preview-container d-flex">
						<?php
						if (!empty($row['client_agg_two'])) {
							$savedFiles = explode(',', $row['client_agg_two']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="image-preview-wrapper" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 5px 10px 0 1px; overflow: hidden;">
									<?php
									if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
									} else {
										echo "
										<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
										<span class='file-icon-text'>📄</span>
										</div>";
									}
									?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if (!empty($row['client_agg_two'])) {
						$fileMulti = explode(',', $row['client_agg_two']);
						foreach ($fileMulti as $fileName) {
							$fileName = trim($fileName);
							?>
							<a href="../payagreements/<?php echo $fileName; ?>" target="_blank"><?php echo $fileName; ?></a><br>
							<?php
						}
					} else {
						echo "<p>No files found.</p>";
					}
					?>
				</div>
				<!-- Agreement 3 -->
				<div class="form-group col-md-3" id="fileUploadSection3">
					<label for="imageUrl">Agreement 3</label>
					<div id="image-preview-container3" class="mb-2 image-preview-container d-flex">
						<?php
						if (!empty($row['client_agg_three'])) {
							$savedFiles = explode(',', $row['client_agg_three']); 
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="image-preview-wrapper" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 5px 10px 0 1px; overflow: hidden;">
									<?php
									if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
									} else {
										echo "
										<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
										<span class='file-icon-text'>📄</span>
										</div>";
									}
									?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if (!empty($row['client_agg_three'])) {
						$fileMulti = explode(',', $row['client_agg_three']);
						foreach ($fileMulti as $fileName) {
							$fileName = trim($fileName);
							?>
							<a href="../payagreements/<?php echo $fileName; ?>" target="_blank"><?php echo $fileName; ?></a><br>
							<?php
						}
					} else {
						echo "<p>No files found.</p>";
					}
					?>
				</div>
				<!-- Package -->
				<div class="form-group col-md-3" id="fileUploadSection4">
					<label for="imageUrl">Package</label>
					<div id="image-preview-container4" class="mb-2 image-preview-container d-flex">
						<?php
						if (!empty($row['packege_shot'])) {
							$savedFiles = explode(',', $row['packege_shot']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="image-preview-wrapper" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 5px 10px 0 1px; overflow: hidden;">
									<?php
									if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
									} else {
										echo "
										<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
										<span class='file-icon-text'>📄</span>
										</div>";
									}
									?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if (!empty($row['packege_shot'])) {
						$fileMulti = explode(',', $row['packege_shot']);
						foreach ($fileMulti as $fileName) {
							$fileName = trim($fileName);
							?>
							<a href="../payagreements/<?php echo $fileName; ?>" target="_blank"><?php echo $fileName; ?></a><br>
							<?php
						}
					} else {
						echo "<p>No files found.</p>";
					}
					?>
				</div>
				<!-- whatsp screenshot -->
				<div class="form-group col-md-3" id="fileUploadSection5">
					<label for="imageUrl">WhatsApp ScreenShot</label>
					<div id="image-preview-container5" class="mb-2 image-preview-container d-flex">
						<?php
						if (!empty($row['whatsapp_screenshot'])) {
							$savedFiles = explode(',', $row['whatsapp_screenshot']);
							foreach ($savedFiles as $savedFile) {
								$savedFile = trim($savedFile);
								$filePath = "../payagreements/" . $savedFile;
								$fileExtension = pathinfo($savedFile, PATHINFO_EXTENSION);
								?>
								<div class="image-preview-wrapper" data-file-name="<?php echo $savedFile; ?>"
									style="position:relative;width:60px;height:60px;display:inline-grid;margin: 5px 10px 0 1px; overflow: hidden;">
									<?php
									if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
									} else {
										echo "
										<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: table-caption; justify-content: center; align-items: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
										<span class='file-icon-text'>📄</span>
										</div>";
									}
									?>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
					if (!empty($row['whatsapp_screenshot'])) {
						$fileMulti = explode(',', $row['whatsapp_screenshot']);
						foreach ($fileMulti as $fileName) {
							$fileName = trim($fileName);
							?>
							<a href="../payagreements/<?php echo $fileName; ?>" target="_blank"><?php echo $fileName; ?></a><br>
							<?php
						}
					} else {
						echo "<p>No files found.</p>";
					}
					?>
				</div>
				<div class="form-group col-md-4 col-lg-4" id="fileUploadSection6">
					<label for="imageUrl">Upload Multiple Files</label> 
					<div id="image-preview-container6" class="preview d-flex">
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
							<div class="preview" data-file-name="<?php echo $savedFile; ?>"
								style="position:relative;width:60px;height:60px;display:inline-grid;margin: 0px 0px 0 1px; overflow: hidden;">
								<a href="<?php echo $filePath; ?>" target="_blank">
									<?php
									if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
										echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;'>";
									} else {
										echo "
										<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; '>
										📄
										</div>";
									}
									?>
								</a>
							</div>
							<?php
							}
						}
						?>
					</div>
					<?php if (!empty($documentsget)) { ?>
						<button type="button" onclick="downloadMulti(<?php echo $clientID;?>);" class="btn btn-primary mt-2">Download All Documents</button>
					<?php } ?>
				</div>
			</div>
			<script>$('[data-toggle="tooltip"]').tooltip();</script>
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
				Client Program <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Sr No</th>
							<th>University</th>
							<th>Program</th>
							<th>Intake</th>
							<th>Applied Status</th>
							<th>Assign To</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$sr=1; 
					$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND aus_clients_id='".$clientID."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					foreach ($select_query_ex as $rowPro) {
						$wtID = $rowPro['aus_program_assign'];
						?>
						<tr >
							<td><?php echo $sr;?></td>
							<td><?php echo ucwords($rowPro['aus_university_name']);?></td>
							<td>
							<?php
								$programName = $rowPro['aus_program_name'];
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
							<td><?php echo ucwords($rowPro['aus_intake']);?></td>
							<td></td>
							<?php if($rowPro['aus_assign_status'] == 1) { 
							$wt_query="SELECT fname, lname from wt_users WHERE status='1' AND close='1' AND wt_id='".$wtID."' ";
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
				Checklists <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Sr No</th>
							<th>Checklist Name</th>
							<th>File</th>
							<th>Audio</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sr=1;
						$select_query="SELECT * FROM austria_clients_checklist".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_client_check_id='".$clientID."'";
						$select_query_ex = mysqli_query($con,$select_query);
						foreach ($select_query_ex as $checkrow) {
							$changingFileAudio = $checkrow['aus_checklist_audio'];
							$audiochanging = json_decode($changingFileAudio, true);
						?>
						<tr id="<?php echo $checkrow['aus_checklist_id']?>">
							<td><?php echo $sr; ?></td>
							<td><?php echo ucwords($checkrow['aus_checklist_name']);?></td>
							<td><a href="../payagreements/<?php echo $checkrow['aus_checklist_file']; ?>" target="_blank"><?php echo $checkrow['aus_checklist_file']; ?></a></td>
							<td>
							<?php
							if ($audiochanging !== null) {
								foreach ($audiochanging as $audioRow) {
							?>
							<audio controls>
								<source src="../payagreements/<?php echo $audioRow;?>" type="audio/ogg">
								<source src="../payagreements/<?php echo $audioRow;?>" type="audio/mpeg">
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
		<!-- <fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Legalized Documents <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th>Legalized Document1</th>
							<th>Legalized Document2</th>
							<th>Legalized Document3</th>
							<th>Legalized Document4</th>
						</tr>
					</thead>
					<tbody>
						<tr id="<?php echo $clientID;?>">
							<td><a href="../payagreements/<?php echo $legDoc1;?>" target="blank"><?php echo $legDoc1;?></a></td>
							<td><a href="../payagreements/<?php echo $legDoc2;?>" target="blank"><?php echo $legDoc2;?></a></td>
							<td><a href="../payagreements/<?php echo $legDoc3;?>" target="blank"><?php echo $legDoc3;?></a></td>
							<td><a href="../payagreements/<?php echo $legDoc4;?>" target="blank"><?php echo $legDoc4;?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</fieldset> -->
		
	</form>
	<?php } ?>
<?php }

?>