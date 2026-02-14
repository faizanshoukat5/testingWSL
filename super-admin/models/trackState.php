<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

////////////////////////////////// Track Client //////////////////////
// view client track
if (isset($_POST['viewClients'])) {
	$clientID = $_POST['viewClients'];
	$select_query = "SELECT * from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
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
				Client Details <span class="text-danger">*</span> <span class="text-success">(Complete)</span> 
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
					<input type="number" name="whatappNo" class="form-control" value="<?php echo $row['client_whatapp'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Phone </label>
					<input type="number" name="phoneNo" class="form-control" value="<?php echo $row['client_phone'];?>" autocomplete="off" readonly="">
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Country <span class="text-danger">*</span></label>
					<select class="form-control" name="countryFrom" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_countryfrom'] ?>"><?php echo $row['client_countryfrom'];?></option>
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
					<label class="form-label">Process Status <span class="text-danger">*</span> </label>
					<select class="form-control" name="processStatus" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_process_status'] ?>"><?php if ($row['client_process_status']=='OverAll Process') {
								echo "<b class='text-purple'>OverAll Process (Admission + Visa)</b>";
							}else{
								echo "<b class='text-danger'>Have Acceptance Letter (Only Visa)</b>";
							} ?></option>
					</select>
				</div>
				<div class="form-group col-md-3">
					<label class="form-label">Client Status <span class="text-danger">*</span></label>
					<select class="form-control" name="convertStatus" autocomplete="off" required="required" disabled="">
						<option value="<?php echo $row['client_convert_status'];?>"><?php echo $row['client_convert_status'] ?></option>
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
						<option value="<?php foreach ($appliedChanging as $appRow){ echo $appRow; }?>"><?php foreach ($appliedChanging as $appRow){ echo $appRow; }?></option>
						
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
				Payment Details <span class="text-danger">*</span>
			</legend>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="	border-collapse: collapse; border-spacing: 0; width: 100%;">
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
								<a href="../payagreements/<?php echo $payrow['pay_screenshot'];?>" target="blank"><?php echo $payrow['pay_screenshot'];?></a>
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
											echo "<img src='{$filePath}' alt='Preview' style='width:100%;height:100%;border-radius:10px;box-shadow:0 4px 4px rgba(0,0,0,0.2);'>";
										} else {
											echo "
											<div class='file-icon' style='width: 100%; height: 100%; background-color: #ddd; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 40px; color: #666; box-shadow: 0 4px 4px rgba(0, 0, 0, 0.2);'>
											📄
											</div>";
										}
										?>
									</a>
									<span class="delete-icon"
									style="position: absolute; top: 5px; right: 5px; cursor: pointer; color: white; font-size: 10px; background: red; border-radius: 50%; height: 13px; width: 13px; display: flex; align-items: center; justify-content: center;">x</span>
								</div>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
			<script>
				$('[data-toggle="tooltip"]').tooltip();
			</script>
		</fieldset>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Admission Documents <span class="text-danger">*</span>
				<?php if ($row['client_document_status']=='1') { ?>
				<span class="text-success">(Complete)</span> 
				<?php }else{ ?>
				<span class="text-danger">(InComplete)</span> 
				<?php } ?>
			</legend>
			<button type="button" class="btn btn-custom mb-1" onclick="downloadZip(<?php echo $clientID;?>);">Download All Documents</button>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="10">Sr No</th>
							<th width="30%">Document Name</th>
							<th width="60%">File Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$clientData = "SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
						$clientData_ex = mysqli_query($con, $clientData);
						foreach ($clientData_ex as $docrow) {
							$admissionDoc1 = $docrow['admission_doc1'];
							$admissionDoc2 = $docrow['admission_doc2'];
							$admissionDoc3 = $docrow['admission_doc3'];
							$admissionDoc4 = $docrow['admission_doc4'];
							$admissionDoc5 = $docrow['admission_doc5'];
							$admissionDoc6 = $docrow['admission_doc6'];
							$admissionDoc7 = $docrow['admission_doc7'];
							$admissionDoc8 = $docrow['admission_doc8'];
							$admissionDoc9 = $docrow['admission_doc9'];
							$admissionDoc10 = $docrow['admission_doc10'];
							$admissionDoc11 = $docrow['admission_doc11'];
							$admissionDoc12 = $docrow['admission_doc12'];
							$admissionDoc13 = $docrow['admission_doc13'];
							$admissionDoc14 = $docrow['admission_doc14'];
							$admissionDoc15 = $docrow['admission_doc15'];
							$admissionDoc16 = $docrow['admission_doc16'];
							$admissionDoc17 = $docrow['admission_doc17'];
							$admissionDoc18 = $docrow['admission_doc18'];
							$admissionDoc19 = $docrow['admission_doc19'];
							$admissionDoc20 = $docrow['admission_doc20'];
							$admissionDoc21 = $docrow['admission_doc21'];
							$admissionDoc22 = $docrow['admission_doc22'];
							$admissionDoc23 = $docrow['admission_doc23'];
							$admissionDoc24 = $docrow['admission_doc24'];
							$admissionDoc25 = $docrow['admission_doc25'];
							$admissionDoc26 = $docrow['admission_doc26'];
							$admissionDoc27 = $docrow['admission_doc27'];
							$admissionDoc28 = $docrow['admission_doc28'];
							$admissionDoc29 = $docrow['admission_doc29'];
							$admissionDoc30 = $docrow['admission_doc30'];
							$admissionDoc31 = $docrow['admission_doc31'];
							$admissionDoc32 = $docrow['admission_doc32'];
							$admissionDoc33 = $docrow['admission_doc33'];

							$noteDetails = $docrow['note_details'];
							$noteAdmission = $docrow['note_admission'];

							$legDoc1 = $docrow['legalizeddoc1'];
							$legDoc2 = $docrow['legalizeddoc2'];
							$legDoc3 = $docrow['legalizeddoc3'];
							$legDoc4 = $docrow['legalizeddoc4'];
						}
						?>
						<!-- doc1 -->
						<tr>
							<td>1</td>
							<td>Matric result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc1)){?>
								<a href="../payagreements/<?php echo $admissionDoc1; ?>" target="_blank"><?php echo $admissionDoc1; ?></a>
							<?php }else{ ?>
								No Document Found
							<?php } ?>
							</td>
						</tr>
						<!-- doc2 -->
						<tr>
							<td>2</td>
							<td>Matric Certificate in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc2)){?>
								<a href="../payagreements/<?php echo $admissionDoc2;?>" target="_blank"><?php echo $admissionDoc2; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc3 -->
						<tr>
							<td>3</td>
							<td>Intermediate part 1 result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc3)){?>
								<a href="../payagreements/<?php echo $admissionDoc3;?>" target="_blank"><?php echo $admissionDoc3; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc4 -->
						<tr>
							<td>4</td>
							<td>Intermediate part 2 result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc4)){?>
								<a href="../payagreements/<?php echo $admissionDoc4;?>" target="_blank"><?php echo $admissionDoc4; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc5 -->
						<tr>
							<td>5</td>
							<td>Intermediate part Part 3 result card in PDF format , if applicable</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc5)){?>
								<a href="../payagreements/<?php echo $admissionDoc5;?>" target="_blank"><?php echo $admissionDoc5; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc6 -->
						<tr>
							<td>5</td>
							<td>Intermediate Certificate in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc6)){?>
								<a href="../payagreements/<?php echo $admissionDoc6;?>" target="_blank"><?php echo $admissionDoc6; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc7 -->
						<tr>
							<td>6</td>
							<td>Bachelor's all transcripts in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc7)){?>
								<a href="../payagreements/<?php echo $admissionDoc7;?>" target="_blank"><?php echo $admissionDoc7; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc8 -->
						<tr>
							<td>7</td>
							<td>Bachelor's all degree in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc8)){?>
								<a href="../payagreements/<?php echo $admissionDoc8;?>" target="_blank"><?php echo $admissionDoc8; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='canada' || $clientCountry=='USA') {
							
						}else{
						?>
						<!-- doc9 -->
						<tr>
							<td>9</td>
							<td>Master's all Transcript in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc9)){?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc10 -->
						<tr>
							<td>10</td>
							<td>Master's all degree in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc10)){?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="_blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc11 -->
						<tr>
							<td>11</td>
							<td>English proficiency Letter from your last educational college/university PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc11)){?>
								<a href="../payagreements/<?php echo $admissionDoc11;?>" target="_blank"><?php echo $admissionDoc11; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc12 -->
						<tr>
							<td>12</td>
							<td>IELTS / PTE in PDF format (if applicable)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc12)){?>
								<a href="../payagreements/<?php echo $admissionDoc12;?>" target="_blank"><?php echo $admissionDoc12; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc13 -->
						<tr>
							<td>13</td>
							<td>Recommendation letters From your last educational college/university PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc13)){?>
								<a href="../payagreements/<?php echo $admissionDoc13;?>" target="_blank"><?php echo $admissionDoc13; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='canada' || $clientCountry=='USA') {
							
						}else{
						?>
						<!-- doc14 -->
						<tr>
							<td>14</td>
							<td>Student current Home Address</td>
							<td>
							<?php if (!empty($admissionDoc14)){?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc14;?>" target="_blank"><?php echo $admissionDoc14; ?></a> -->
								<?php echo $admissionDoc14;?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc15 -->
						<tr>
							<td>15</td>
							<td>New Email ID and Password & Email id which you are using (without password)</td>
							<td>
							<?php if (!empty($admissionDoc15)){?>
								<<!-- a href="../payagreements/<?php echo $admissionDoc15;?>" target="_blank"><?php echo $admissionDoc15; ?></a> -->
								<?php echo $admissionDoc15; ?>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc16 -->
						<tr>
							<td>16</td>
							<td>CV with new email id (PDF Format)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc16)){?>
								<a href="../payagreements/<?php echo $admissionDoc16;?>" target="_blank"><?php echo $admissionDoc16; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc17 -->
						<tr>
							<td>17</td>
							<td>One passport size Photo with white background JPG</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc17)){?>
								<a href="../payagreements/<?php echo $admissionDoc17;?>" target="_blank"><?php echo $admissionDoc17; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc18 -->
						<tr>
							<td>18</td>
							<td>Passport 1 st two pages Scan copy ( PDF Format )</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc18)){?>
								<a href="../payagreements/<?php echo $admissionDoc18;?>" target="_blank"><?php echo $admissionDoc18; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc19 -->
						<tr>
							<td>19</td>
							<td>ID Card front & Back scan copy (PDF Format)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc19)){?>
								<a href="../payagreements/<?php echo $admissionDoc19;?>" target="_blank"><?php echo $admissionDoc19; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='austria' || $clientCountry =='canada' || $clientCountry == 'USA') {
						?>
						<!-- doc20 -->
						<tr>
							<td>20</td>
							<td>Parents Detail (birth year, occupation and qualification)</td>
							<td>
							<?php if (!empty($admissionDoc20)){?>
								<a href="../payagreements/<?php echo $admissionDoc20;?>" target="_blank"><?php echo $admissionDoc20; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php
						}else{
						?>
						<!-- doc20 -->
						<tr>
							<td>20</td>
							<td>Skype Profile</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc20)){?>
								<a href="../payagreements/<?php echo $admissionDoc20;?>" target="_blank"><?php echo $admissionDoc20; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						}
						if ($clientCountry=='austria') {
						?>
						<!-- doc21 -->
						<tr>
							<td>21</td>
							<td>Course details instead of cost</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc21)){?>
								<a href="../payagreements/<?php echo $admissionDoc21;?>" target="_blank"><?php echo $admissionDoc21; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc22 -->
						<tr>
							<td>22</td>
							<td>Eligibility letter from university with registrar sign & stamp PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc22)){?>
								<a href="../payagreements/<?php echo $admissionDoc22;?>" target="_blank"><?php echo $admissionDoc22; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						}if ($clientCountry=='canada' || $clientCountry=='USA') {
						?>
						<!-- doc9 -->
						<tr>
							<td>9</td>
							<td>Parents Detail (ID card no. , House no. , contact no.)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc9)){?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc10 -->
						<tr>
							<td>10</td>
							<td>Last three months Bank Statement with account maintenance letter in PDF.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc10)){?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="_blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc14 -->
						<tr>
							<td>14</td>
							<td>Relative Contact detail in case of Emergency.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc14)){?>
								<a href="../payagreements/<?php echo $admissionDoc14;?>" target="_blank"><?php echo $admissionDoc14; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc15 -->
						<tr>
							<td>15</td>
							<td>In case of Sponsor bank statement contact number, house address, email id, relation with sponsor.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc15)){?>
								<a href="../payagreements/<?php echo $admissionDoc15;?>" target="_blank"><?php echo $admissionDoc15; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc 23 -->
						<tr>
							<td>23</td>
							<td>Details Word File</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc23)){?>
									<a href="../payagreements/<?php echo $admissionDoc23;?>" target="_blank"><?php echo $admissionDoc23; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc24 -->
						<tr>
							<td>24</td>
							<td>Thesis</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc24)){?>
								<a href="../payagreements/<?php echo $admissionDoc24;?>" target="_blank"><?php echo $admissionDoc24; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc25 -->
						<tr>
							<td>25</td>
							<td>Equivalence Certificate</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc25)){?>
									<a href="../payagreements/<?php echo $admissionDoc25;?>" target="_blank"><?php echo $admissionDoc25; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc26 -->
						<tr>
							<td>26</td>
							<td>Experience letter</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc26)){?>
									<a href="../payagreements/<?php echo $admissionDoc26;?>" target="_blank"><?php echo $admissionDoc26; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc27 -->
						<tr>
							<td>27</td>
							<td>Applicants history</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc27)){?>
									<a href="../payagreements/<?php echo $admissionDoc27;?>" target="_blank"><?php echo $admissionDoc27; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc28 -->
						<tr>
							<td>28</td>
							<td>Other Documents</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc28)){?>
									<a href="../payagreements/<?php echo $admissionDoc28;?>" target="_blank"><?php echo $admissionDoc28; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc29 -->
						<?php 
						if ($clientCountry!='austria') {
						?>
						<tr>
							<td>29</td>
							<td>Domicile</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc29)){?>
									<a href="../payagreements/<?php echo $admissionDoc29;?>" target="_blank"><?php echo $admissionDoc29; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc30 -->
						<tr>
							<td>30</td>
							<td>Hope Certificate</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc30)){?>
									<a href="../payagreements/<?php echo $admissionDoc30;?>" target="_blank"><?php echo $admissionDoc30; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc31 -->
						<tr>
							<td>31</td>
							<td>Certificates</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc31)){?>
									<a href="../payagreements/<?php echo $admissionDoc31;?>" target="_blank"><?php echo $admissionDoc31; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc32 -->
						<?php 
						if ($clientCountry=='italy') {
						?>
						<tr>
							<td>32</td>
							<td>Portfolio </td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc32)){?>
									<a href="../payagreements/<?php echo $admissionDoc32;?>" target="_blank"><?php echo $admissionDoc32; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>

						<?php 
						if ($row['client_countryfrom']=='UAE') {
						?>
						<tr>
							<td>33</td>
							<td>Emirates ID </td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc33)){?>
									<a href="../payagreements/<?php echo $admissionDoc33;?>" target="_blank"><?php echo $admissionDoc33; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>

						<tr>
							<td>Note Details</td>
							<td colspan="2">
								<?php if (!empty($noteDetails)){?>
									<?php echo $noteDetails; ?>
								<?php }else{ ?>
									<p>No Note Found</p>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>Admission Note Details</td>
							<td colspan="2">
								<?php if (!empty($noteAdmission)){?>
									<?php echo $noteAdmission; ?>
								<?php }else{ ?>
									<p>No Note Found</p>
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</fieldset>
		<?php 
		if ($clientCountry=='austria') {
		?>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Client Program <span class="text-danger">*</span>
				<?php if ($row['client_pro_confirm_status']=='1') { ?>
				<span class="text-success">(Complete)</span> 
				<?php }else{ ?>
				<span class="text-danger">(InComplete)</span> 
				<?php } ?>
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
					$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND aus_clients_id='".$clientID."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					foreach ($select_query_ex as $rowPro) {
						$wtID = $rowPro['aus_program_assign'];
						?>
						<tr >
							<td><?php echo $sr;?></td>
							<td><?php echo ucwords($rowPro['aus_university_name']);?></td>
							<td><?php echo ucwords($rowPro['aus_program_name']);?></td>
							<td><?php echo ucwords($rowPro['aus_intake']);?></td>
							<td> </td>
							<td> </td>
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
				Check Lists <span class="text-danger">*</span>
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
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Appointment <span class="text-danger">*</span>
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
		</fieldset>

		<?php
		}elseif($clientCountry=='italy'){
		?>
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Client Program <span class="text-danger">*</span>
				<?php if ($row['client_pro_confirm_status']=='1') { ?>
				<span class="text-success">(Complete)</span> 
				<?php }else{ ?>
				<span class="text-danger">(InComplete)</span> 
				<?php } ?>
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
						<tr >
							<td><?php echo $sr;?></td>
							<td><?php echo ucwords($rowPro['italy_university_name']);?></td>
							<td><?php echo ucwords($rowPro['italy_program_name']);?></td>
							<td><?php echo ucwords($rowPro['italy_intake']);?></td>
							<td>
							
							</td>
							<td>
							
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
		<?php
		}
		?>

	
	</form>
	<?php } ?>
<?php }

?>