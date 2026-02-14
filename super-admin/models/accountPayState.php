<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
// delete PCB
if (isset($_POST['PCBclientID'])) {
	$clientID = $_POST['PCBclientID'];
	$PCBType = $_POST['PCBType'];
	if ($PCBType=='1') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET bank_pay_confirm='', bank_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($PCBType=='2') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET bank_pay_confirm2='', bank_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($PCBType=='3') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET bank_pay_confirm3='', bank_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}
}

// delete query of manager 
if (isset($_POST['MRclientID'])) {
	$clientID = $_POST['MRclientID'];
	$MRType = $_POST['MRType'];
	if ($MRType=='1') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET manager_pay_confirm='', manager_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($MRType=='2') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET manager_pay_confirm2='', manager_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($MRType=='3') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET manager_pay_confirm3='', manager_pay_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}
}

// delete query of ack 
if (isset($_POST['AckclientID'])) {
	$clientID = $_POST['AckclientID'];
	$AckType = $_POST['AckType'];
	if ($AckType=='1') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET ack_confirm_client='', ack_confirm_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($AckType=='2') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET ack_confirm_client2='', ack_confirm_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}elseif ($AckType=='3') {
		$del_query = "UPDATE clients".$_SESSION['dbNo']." SET ack_confirm_client3='', ack_confirm_status='0' WHERE client_id='".$clientID."'";
		$del_query_ex = mysqli_query($con,$del_query);
	}
}

// Due After Admission Acceptance and Verification
if (isset($_POST['dueAdmissionPCBID'])) {
	$dueAdmissionID = $_POST['dueAdmissionPCBID'];
	$del_query = "UPDATE client_payafter_admission".$_SESSION['dbNo']." SET close='0' WHERE payafter_admission_id='".$dueAdmissionID."'";
	$del_query_ex = mysqli_query($con,$del_query);
}


// Confirmation state which is page of Payment Confirmation or not ack confirmation or not

// Client Payment confirmation
if (isset($_POST['clientPayConfirm'])) {
	$clientID = $_POST['clientPayConfirm'];
	$select_query = "SELECT * from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$changingApplied = $row['client_applied'];
		$appliedChanging = json_decode($changingApplied, true);
		?>
		<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
			<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
			<div class="row">
				<div class="col-md-12 ">
					<div class="alert alert-info">
						<strong ><span class="text-danger" id="blink">Note:</span> If you want to send an Email to the Client, the Manager Receipt, Agreement 1, Agreement 2, and Agreement 3 files must be uploaded. </strong>
					</div>
				</div>
			</div>
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
						<label class="form-label">WhatsApp <span class="text-danger">*</span></label>
						<input type="number" name="whatappNo" class="form-control" value="<?php echo $row['client_whatapp'];?>" autocomplete="off" required="required" readonly="">
					</div>
					<div class="col-md-12" id="already-msg-up"></div>
					<div class="form-group col-md-4">
						<label class="form-label">Phone </label>
						<input type="number" name="phoneNo" class="form-control" value="<?php echo $row['client_phone'];?>" autocomplete="off" readonly="">
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Country <span class="text-danger">*</span></label>
						<select class="form-control" name="province" autocomplete="off" required="required" disabled="">
							<option value="<?php echo $row['client_countryfrom'];?>"><?php echo $row['client_countryfrom'];?></option>
							
						</select>
					</div>
					<div class="form-group col-md-4">
						<label class="form-label">Province <span class="text-danger">*</span></label>
						<select class="form-control" name="province" autocomplete="off" required="required" disabled="">
							<option value="<?php echo $row['client_province'];?>"><?php echo $row['client_province'];?></option>
							
						</select>
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
						<label class="form-label">Client Status <span class="text-danger">*</span> </label>
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
							$payClient = "SELECT * FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id='".$clientID."' "; 
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
									<a target="_blank" href="../payagreements/<?php echo $payrow['pay_screenshot'];?>"><?php echo $payrow['pay_screenshot'];?></a>
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
					Payment Email <span class="text-danger">*</span>
				</legend>
				<div class="row">
					<?php if ($row['client_pay_confirm_status']=='0') { ?>
					<div class="col-md-12">
						<div class="alert alert-info text-center">
							<b>Email Not Sent</b>
						</div>
					</div>
					<?php }else{ ?>
					<div class="col-md-12">
						<div class="table-responsive mt-3">
							<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
								<thead>
									<tr>
										<th width="10%">Sr No</th>
										<th width="90%">Email</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$sr=1;
								$emailClient = "SELECT * FROM payment_email_to_client WHERE close='1' AND status='1' AND email_client_id='".$clientID."' "; 
								$emailClient_ex = mysqli_query($con, $emailClient);
								foreach ($emailClient_ex as $emailRow) {
									?>
									<tr>
										<td><?php echo $sr;?></td>
										<td class="text-left"><?php echo $emailRow['client_email'];?></td>
									</tr>
									<?php $sr++;} ?>
								</tbody>
							</table>
						</div>
					</div>
					<?php } ?>
				</div>
			</fieldset>
		</form>
	<?php } ?>
<?php }

// Bank payment confirm

if (isset($_POST['bankPayConfirm'])) {
	$clientID = $_POST['bankPayConfirm'];
	$select_query = "SELECT bank_pay_status, bank_pay_confirm, bank_pay_confirm2, bank_pay_confirm3 from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$bank_pay_status = $row['bank_pay_status'];
		$bankPayConfirm = $row['bank_pay_confirm'];
		$bankPayConfirm2 = $row['bank_pay_confirm2'];
		$bankPayConfirm3 = $row['bank_pay_confirm3'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Bank Payment <span class="text-danger">*</span>
			</legend>
			<?php 
			if ($bankPayConfirm!='' && $bankPayConfirm2=='' && $bankPayConfirm3=='') {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm'];?>" target="blank"><?php echo $row['bank_pay_confirm']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($bankPayConfirm!='' && $bankPayConfirm2!='' && $bankPayConfirm3==''){
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm']; ?>" target="blank"><?php echo $row['bank_pay_confirm']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm2']; ?>" target="blank"><?php echo $row['bank_pay_confirm2']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($bankPayConfirm!='' && $bankPayConfirm2!='' && $bankPayConfirm3!=''){
			?>
			<div class="row">
				<div class="col-md-12 ">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm']; ?>" target="blank"><?php echo $row['bank_pay_confirm']; ?></a>
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm2']; ?>" target="blank"><?php echo $row['bank_pay_confirm2']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-primary">
						<b>Third:</b> <a href="../payagreements/<?php echo $row['bank_pay_confirm3']; ?>" target="blank"><?php echo $row['bank_pay_confirm3']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}else{
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info text-center">
						<b>Not Upload Bank Payment Confirm Receipt</b>
					</div>
				</div>
			</div>
			<?php } ?>
		</fieldset>
	</form>
	<?php } ?>
<?php }

// Manager Receipt confirm condition
if (isset($_POST['managerConfirm'])) {
	$clientID = $_POST['managerConfirm'];
	$select_query = "SELECT manager_pay_status, manager_pay_confirm, manager_pay_confirm2, manager_pay_confirm3 from clients".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$manager_pay_status = $row['manager_pay_status'];
		$managerPayConfirm = $row['manager_pay_confirm'];
		$managerPayConfirm2 = $row['manager_pay_confirm2'];
		$managerPayConfirm3 = $row['manager_pay_confirm3'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Manager Receipt <span class="text-danger">*</span>
			</legend>
			<?php 
			if ($managerPayConfirm!='' && $managerPayConfirm2=='' && $managerPayConfirm3=='') {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm'];?>" target="blank"><?php echo $row['manager_pay_confirm']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($managerPayConfirm!='' && $managerPayConfirm2!='' && $managerPayConfirm3==''){
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm']; ?>" target="blank"><?php echo $row['manager_pay_confirm']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm2']; ?>" target="blank"><?php echo $row['manager_pay_confirm2']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($managerPayConfirm!='' && $managerPayConfirm2!='' && $managerPayConfirm3!=''){
			?>
			<div class="row">
				<div class="col-md-12 ">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm']; ?>" target="blank"><?php echo $row['manager_pay_confirm']; ?></a>
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm2']; ?>" target="blank"><?php echo $row['manager_pay_confirm2']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-primary">
						<b>Third:</b> <a href="../payagreements/<?php echo $row['manager_pay_confirm3']; ?>" target="blank"><?php echo $row['manager_pay_confirm3']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}else{
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info text-center">
						<b>Not Upload Manager Receipt</b>
					</div>
				</div>
			</div>
			<?php } ?>
		</fieldset>
	</form>
<?php }

}

// Acknowledgment confirm condition
if (isset($_POST['ackConfirm'])) {
	$clientID = $_POST['ackConfirm'];
	$select_query = "SELECT ack_confirm_status, ack_confirm_client, ack_confirm_client2, ack_confirm_client3 from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$ack_confirm_status = $row['ack_confirm_status'];
		$ackConfirmClient = $row['ack_confirm_client'];
		$ackConfirmClient2 = $row['ack_confirm_client2'];
		$ackConfirmClient3 = $row['ack_confirm_client3'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Acknowledgement Receipt <span class="text-danger">*</span>
			</legend>
			<?php 
			if ($ackConfirmClient!='' && $ackConfirmClient2=='' && $ackConfirmClient3=='') {
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client'];?>" target="blank"><?php echo $row['ack_confirm_client']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($ackConfirmClient!='' && $ackConfirmClient2!='' && $ackConfirmClient3==''){
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client']; ?>" target="blank"><?php echo $row['ack_confirm_client']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client2']; ?>" target="blank"><?php echo $row['ack_confirm_client2']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}elseif($ackConfirmClient!='' && $ackConfirmClient2!='' && $ackConfirmClient3!=''){
			?>
			<div class="row">
				<div class="col-md-12 ">
					<div class="alert alert-success">
						<b>First:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client']; ?>" target="blank"><?php echo $row['ack_confirm_client']; ?></a>
					</div>
				</div>
				<div class="col-md-12 ">
					<div class="alert alert-info">
						<b>Second:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client2']; ?>" target="blank"><?php echo $row['ack_confirm_client2']; ?></a>
					</div>
				</div>
				<div class="col-md-12">
					<div class="alert alert-primary">
						<b>Third:</b> <a href="../payagreements/<?php echo $row['ack_confirm_client3']; ?>" target="blank"><?php echo $row['ack_confirm_client3']; ?></a>
					</div>
				</div>
			</div>
			<?php
			}else{
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="alert alert-info text-center">
						<b>Not Upload Acknowledgement Receipt</b>
					</div>
				</div>
			</div>
			<?php } ?>
		</fieldset>
	</form>
<?php }

}

// Note add to document collection getState

// delete the note
if (isset($_POST['delNoteDocument'])) {
	$noteID = $_POST['delNoteDocument'];

	$del_query = "UPDATE document_clients_note".$_SESSION['dbNo']." SET close='0' WHERE doc_note_id='".$noteID."'";
	$del_query_ex = mysqli_query($con, $del_query);
}

if (isset($_POST['addNoteDocument'])) {
	$clientID = $_POST['addNoteDocument'];
	?>
	<div class="table-responsive">
		<table id="datatable" class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th width="10%">Sr</th>
					<th width="90%">Note</th>
					<!-- <th width="10%">Option</th> -->
				</tr>
			</thead>
			<tbody>
			<?php
			$sr=1; 
			$noteData = "SELECT * from document_clients_note".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND doc_client_id='".$clientID."' ";
			$noteData_ex = mysqli_query($con,$noteData);
			foreach ($noteData_ex as $row) {
			?>
			<tr id="<?php echo $row['doc_note_id'];?>">
				<td><?php echo $sr;?></td>
				<td><?php echo $row['doc_note_name'];?></td>
				<!-- <td>
					<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="del(delNote,<?php echo $row['doc_note_id'];?>);"><i class="mdi mdi-trash-can"></i></button>
				</td> -->
			</tr>
			<?php $sr++;} ?>
			</tbody>
		</table>
	</div>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Note Details <span class="text-danger">*</span>
			</legend>
			<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
			
			<div class="row">
				<div class="form-group col-lg-12 col-md-12">
					<label class="form-label">Note </label>
					<textarea class="form-control" name="docNote" autocomplete="off"> </textarea>
				</div>
			</div>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-primary" name="updateNote"><i class="mdi mdi-upload"></i> Update</button>
				</div> 
			</div>
		</div>
	</form>
<?php }

?>