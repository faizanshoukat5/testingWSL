<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkconvertStatus'])) {

	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientDegree = $_POST['checkclientDegree'];
	$assignPrograms = $_POST['checkassignPrograms'];
	$appliedPrograms = $_POST['checkappliedPrograms'];
	$checkApplication = $_POST['checkapplicationStatus'];
	$checklistStatus = $_POST['checkchecklistStatus'];
	$sopStatus = $_POST['checksopStatus'];
	$visaProcess = $_POST['checkvisaProcess'];
	$current_date =  date('Y-m-d');
	$degbachMBBS='';
	if ($clientDegree=='master') {
		$degInfo = '["master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}elseif ($clientDegree=='mbbs') {
		$degInfo = '["mbbs"]';
		$degbachMBBS = '["bachelor","mbbs"]';
	}elseif ($clientDegree=='phd') {
		$degInfo = '["phd"]';
	}
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<?php if($clientStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $clientStatus;?></h5>
				<?php }elseif($clientCountry!='all'){ ?>
				<h5>All Clients >> <?php echo $clientCountry;?></h5>
				<?php }elseif($clientDegree!='all'){ ?>
				<h5>All Clients >> <?php echo $clientDegree;?></h5>
				<?php }elseif($assignPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $assignPrograms;?></h5>
				<?php }elseif($appliedPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $appliedPrograms;?></h5>
				<?php }elseif($checkApplication!='all'){ ?>
				<h5>All Clients >> <?php echo $checkApplication;?></h5>
				<?php }elseif($checklistStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $checklistStatus;?></h5>
				<?php }elseif($sopStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $sopStatus;?></h5>
				<?php }else{ ?>
				<h5>All Clients</h5>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th>Sr</th>
					<th>ID / Date</th>
					<th>Client Info</th>
					<th>Degree</th>
					<th data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th>Admission Status</th>
					<th>Visa Status</th>
					<th>Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			if ($clientStatus=="all" && $clientCountry=="all" && $clientDegree=="all" && $assignPrograms!="all" && $appliedPrograms=="all" && $checkApplication=="all" && $checklistStatus=="all" && $sopStatus=="all") {
				
				if($assignPrograms=='University Open, but Not Assign Clients'){
					
					function countUniversityPrograms($con, $universities, $degreeType) {
						$results = [];
						$processedClientIds = [];
						foreach ($universities as $university) {
							$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$university['name']}' AND italy_degree_name='{$degreeType}' ORDER BY italy_dates_id DESC LIMIT 1";
							$selectQuery_ex = mysqli_query($con, $selectQuery);
							if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
								$dateRow = mysqli_fetch_assoc($selectQuery_ex);
								$dateStatus = $dateRow['italy_date_status'];
								$openingDate = $dateRow['italy_opening_date'];
								$closingDate = $dateRow['italy_closing_date'];
								$currentDate = date('Y-m-d');

								if ($dateStatus=='1' && $currentDate >= $openingDate && $currentDate <= $closingDate) {
									$clientDataQuery = "SELECT * FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id JOIN italy_university_dates ON icp.italy_university_name = italy_university_dates.italy_university_name AND icp.italy_client_degree = italy_university_dates.italy_degree_name WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND icp.italy_assign_status='0' AND italy_university_dates.italy_date_status='1' AND italy_university_dates.italy_opening_date <= '$currentDate' AND italy_university_dates.italy_closing_date >= '$currentDate' GROUP BY cl.client_id ORDER BY client_id DESC";
									$clientData_ex = mysqli_query($con, $clientDataQuery);
									// if ($clientData_ex) {
									// 	while ($row = mysqli_fetch_assoc($clientData_ex)) {
									// 		$clientId = strval($row['client_id']);
									// 		$shortClientId = substr($clientId, -2);
									// 		if (!isset($processedClientIds[$shortClientId])) {
									// 			echo $row['short_client_id'] = $shortClientId;
									// 			$results[] = $row;
									// 			$processedClientIds[$shortClientId] = true;
									// 		}
									// 	}
									// }

									if ($clientData_ex) {
										while ($closeRow = mysqli_fetch_assoc($clientData_ex)) {
											$results[$closeRow['client_id']] = $closeRow;
										}
									}
								}
							}
						}
						return $results;

					}
					// University arrays for each degree type
					$masterUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Bergamo (BR)'],
						['name' => 'University of Ferrara (FR)'],
						['name' => 'University of Florence (UF)'],
						['name' => 'University of Foggia (FG)'],
						['name' => 'University of Genevo (UG)'],
						['name' => 'University of Pisa (UP)'],
						['name' => 'University of Salerno (SL)'],
						['name' => 'University of Verona (VN)']
					];
					$bachelorUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Cassino (CS)']
					];
					$mbbsUniversities = [
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Parma (PRM)']
					];

					// Count open and closed programs for each degree type
					$masterResults = countUniversityPrograms($con, $masterUniversities, 'master');
					$bachelorResults = countUniversityPrograms($con, $bachelorUniversities, 'bachelor');
					$mbbsResults = countUniversityPrograms($con, $mbbsUniversities, 'mbbs');

					$allResults = array_values(
						array_intersect_key(
							array_merge($masterResults, $bachelorResults, $mbbsResults),
							array_unique(array_column(array_merge($masterResults, $bachelorResults, $mbbsResults), 'client_id'))
						)
					);
					// foreach ($allResults as $row) {
					// 	echo $row['client_id'];
					// }
					?>

					<?php
					$sr = count($allResults);
					foreach ($allResults as $row) {
						$clientID = $row['client_id'];
						$changingApplied = $row['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						// SUM of adv payment from the client payments
						$payClient = "SELECT SUM(pay_receive_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
						$payClient_ex = mysqli_query($con, $payClient);
						$payrow = mysqli_fetch_assoc($payClient_ex);
						$sumReceived = $payrow['SUM(pay_receive_amount)'];

						// fetch last balance amount and date from the clients_payments".$_SESSION['dbNo']."
						$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
						$balClient_ex = mysqli_query($con, $balClient);
						$balrow = mysqli_fetch_assoc($balClient_ex); 
						$sumBalance = $balrow['pay_bal_amount'];
						$pay_due_date = $balrow['pay_due_date'];

						// query get first row of accept and visa rp
						$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
						$select_query_ex = mysqli_query($con, $select_query);
						$pay1Row = mysqli_fetch_assoc($select_query_ex);
						$payAfterAccept = $pay1Row['pay_after_accept'];
						$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];
						?>
						<tr id="<?php echo $row['client_id']; ?>">
							<?php 
							echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
							if ($row['client_process_status']=='OverAll Process') {
								echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
							}elseif ($row['client_process_status']=='Only Admission Process') {
								echo "<b class='text-info'>Only Admission <br> Process</b>";
							}else{
								echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
							}
							echo "</td>";
							?>
							<td class="breakTD">
								<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
								<br>
								<?php if ($row['client_convert_status']=='New Client') {
									echo "<b class='text-success'>New Client</b>";
								}elseif ($row['client_convert_status']=='Old Client') {
									echo "<b class='text-info'>Old Client</b>";
								}elseif($row['client_convert_status']=='Old Converted Client'){
									echo "<b class='text-warning'>Old Converted Client</b>";
								}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
									echo "<b class='text-info'>Italy Old Client 2024</b>";
								}elseif($row['client_convert_status']=='Austria Converted Client'){
									echo "<b class='text-warning'>Austria Converted Client</b>";
								} ?>
							</td>
							<td class="breakTD">
								<?php
								echo ucwords($row['client_country'])." <br>";
								foreach ($appliedChanging as $appRow){
									echo "<b>".ucwords($appRow)."</b> ";
								}?>
								<br>
								<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
								<br>
								<?php
								$embassyTooltips = [
									'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
									'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
									'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
									'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
								];
								?>
								<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
							</td>
							<td>
							<?php 
							$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
							$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

							$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

							echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
							?><br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
							?>
							<?php
							$dateString = $pay_due_date;
							if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
								$date = new DateTime($dateString);
								$dueDate = $date->format('d-m-Y');
								$currentDate = date('d-m-Y');
								?>
								<br>
								<div style="float:right;color:red;">
								<?php
									if ($dueDate == $currentDate) {
										echo " / <span id='blink'>" . $dueDate . "</span>";
									} else {
										echo " / " . $dueDate;
									}
								?>
								</div>
							<?php } ?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
							?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
							?>
							</td>
							<?php
							$getUrl = base64_encode($row['client_name']."".$row['client_email']);
							?>
							<td class="breakTD">
								<?php 
								$query = "SELECT note_documents, note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
								$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
								$buttonClass = $docRow['note_documents'] != '' ? 'btn-success' : 'btn-outline-danger';
								$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
								$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
								?>
								<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

								<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

								<?php if($checkApplication=='Inform the Client to Recheck the Application' || $checkApplication=='Applications Sent to the client for Rechecking' || $checkApplication=='Client Requests Changes in the Application' || $checkApplication=='Changes Complete By Processing Team' || $checkApplication=='Application Approved by the Client' || $checkApplication=='Client Informed, How to Pay the Application Fee' || $checkApplication=='Application Fee Paid by Client' || $checkApplication=='Admission Application Submitted by Processing Team' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $visaProcess=='After Admission Dues Clear Clients' || $visaProcess=='After Admission Dues Not Clear Clients'){ ?>

									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php } else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php } 
									?>
								<?php }else{ ?>

									<?php if ($sumBalance=='0') {
										$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A.Pro.</button> </a>
										<?php 
										}elseif($assignedNo > 0 ){ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A.Pro.</button> </a>
										<?php
										}else{
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
											
										<?php
										}
									?>
									<?php }else{ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
									<?php } ?>

									<br>
									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php
										}
										else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php
										}
									?>

								<?php } ?>
								<br>
								<?php
								$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result_ex = mysqli_query($con, $query);
								foreach ($result_ex as $italPro) {
									$assignDate = $italPro['italy_program_assign_date'];

									if ($assignDate!='0000-00-00') {
										$date2 = date('Y-m-d');
										$timestamp_assignDate = strtotime($assignDate);
										$timestamp_date2 = strtotime($date2);
										$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
										$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
										// echo $daysAssign_diff;
										if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
										<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
										<?php }
									}
								}
								?>
							</td>
							<td>
							<?php
								$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
								$data = mysqli_fetch_assoc($result);
								$num = $data['NumberOfLists'];
								// $isItaly = $num == 2 && $row['client_country'] == 'italy';
							?>
							<?php if ($sumBalance=='0') { ?>
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
							<?php }else{ ?> 
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
							<?php } ?>
								
							</td>
							<td>
								<?php include ("../components/ViewActionTd.php");?>
							</td>
						</tr>
					<?php
					$sr--;
					}?>
					<?php
				}
				elseif($assignPrograms=='List of Clients, Admission Date Announce But Not Open University Yet'){
					
					function countUniversityPrograms($con, $universities, $degreeType) {
						$results = [];
						$processedClientIds = [];
						foreach ($universities as $university) {
							$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$university['name']}' AND italy_degree_name='{$degreeType}' ORDER BY italy_dates_id DESC LIMIT 1";
							$selectQuery_ex = mysqli_query($con, $selectQuery);
							if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
								$dateRow = mysqli_fetch_assoc($selectQuery_ex);
								$dateStatus = $dateRow['italy_date_status'];
								$openingDate = $dateRow['italy_opening_date'];
								$closingDate = $dateRow['italy_closing_date'];
								$currentDate = date('Y-m-d');

								if ($dateStatus=='1' && ($currentDate < $openingDate && $currentDate < $closingDate)) {
									$clientDataQuery = "SELECT * FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id JOIN italy_university_dates ON icp.italy_university_name = italy_university_dates.italy_university_name AND icp.italy_client_degree = italy_university_dates.italy_degree_name WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND icp.italy_assign_status='0' AND italy_university_dates.italy_date_status='1' AND (italy_university_dates.italy_opening_date > '$currentDate' AND italy_university_dates.italy_closing_date > '$currentDate') GROUP BY cl.client_id ORDER BY client_id DESC";
									$clientData_ex = mysqli_query($con, $clientDataQuery);
									// if ($clientData_ex) {
									// 	while ($row = mysqli_fetch_assoc($clientData_ex)) {
									// 		$clientId = strval($row['client_id']);
									// 		$shortClientId = substr($clientId, -2);
									// 		if (!isset($processedClientIds[$shortClientId])) {
									// 			echo $row['short_client_id'] = $shortClientId;
									// 			$results[] = $row;
									// 			$processedClientIds[$shortClientId] = true;
									// 		}
									// 	}
									// }

									if ($clientData_ex) {
										while ($closeRow = mysqli_fetch_assoc($clientData_ex)) {
											$results[$closeRow['client_id']] = $closeRow;
										}
									}
								}
							}
						}
						return $results;

					}
					// University arrays for each degree type
					$masterUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Bergamo (BR)'],
						['name' => 'University of Ferrara (FR)'],
						['name' => 'University of Florence (UF)'],
						['name' => 'University of Foggia (FG)'],
						['name' => 'University of Genevo (UG)'],
						['name' => 'University of Pisa (UP)'],
						['name' => 'University of Salerno (SL)'],
						['name' => 'University of Verona (VN)']
					];
					$bachelorUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Cassino (CS)']
					];
					$mbbsUniversities = [
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Parma (PRM)']
					];

					// Count open and closed programs for each degree type
					$masterResults = countUniversityPrograms($con, $masterUniversities, 'master');
					$bachelorResults = countUniversityPrograms($con, $bachelorUniversities, 'bachelor');
					$mbbsResults = countUniversityPrograms($con, $mbbsUniversities, 'mbbs');

					$allResults = array_values(
						array_intersect_key(
							array_merge($masterResults, $bachelorResults, $mbbsResults),
							array_unique(array_column(array_merge($masterResults, $bachelorResults, $mbbsResults), 'client_id'))
						)
					);
					// foreach ($allResults as $row) {
					// 	echo $row['client_id'];
					// }
					?>

					<?php
					$sr = count($allResults);
					foreach ($allResults as $row) {
						$clientID = $row['client_id'];
						$changingApplied = $row['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						// SUM of adv payment from the client payments
						$payClient = "SELECT SUM(pay_receive_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
						$payClient_ex = mysqli_query($con, $payClient);
						$payrow = mysqli_fetch_assoc($payClient_ex);
						$sumReceived = $payrow['SUM(pay_receive_amount)'];

						// fetch last balance amount and date from the clients_payments".$_SESSION['dbNo']."
						$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
						$balClient_ex = mysqli_query($con, $balClient);
						$balrow = mysqli_fetch_assoc($balClient_ex); 
						$sumBalance = $balrow['pay_bal_amount'];
						$pay_due_date = $balrow['pay_due_date'];

						// query get first row of accept and visa rp
						$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
						$select_query_ex = mysqli_query($con, $select_query);
						$pay1Row = mysqli_fetch_assoc($select_query_ex);
						$payAfterAccept = $pay1Row['pay_after_accept'];
						$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];
						?>
						<tr id="<?php echo $row['client_id']; ?>">
							<?php 
							echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
							if ($row['client_process_status']=='OverAll Process') {
								echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
							}elseif ($row['client_process_status']=='Only Admission Process') {
								echo "<b class='text-info'>Only Admission <br> Process</b>";
							}else{
								echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
							}
							echo "</td>";
							?>
							<td class="breakTD">
								<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
								<br>
								<?php if ($row['client_convert_status']=='New Client') {
									echo "<b class='text-success'>New Client</b>";
								}elseif ($row['client_convert_status']=='Old Client') {
									echo "<b class='text-info'>Old Client</b>";
								}elseif($row['client_convert_status']=='Old Converted Client'){
									echo "<b class='text-warning'>Old Converted Client</b>";
								}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
									echo "<b class='text-info'>Italy Old Client 2024</b>";
								}elseif($row['client_convert_status']=='Austria Converted Client'){
									echo "<b class='text-warning'>Austria Converted Client</b>";
								} ?>
							</td>
							<td class="breakTD">
								<?php
								echo ucwords($row['client_country'])." <br>";
								foreach ($appliedChanging as $appRow){
									echo "<b>".ucwords($appRow)."</b> ";
								}?>
								<br>
								<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
								<br>
								<?php
								$embassyTooltips = [
									'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
									'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
									'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
									'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
								];
								?>
								<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
							</td>
							<td>
							<?php 
							$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
							$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

							$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

							echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
							?><br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
							?>
							<?php
							$dateString = $pay_due_date;
							if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
								$date = new DateTime($dateString);
								$dueDate = $date->format('d-m-Y');
								$currentDate = date('d-m-Y');
								?>
								<br>
								<div style="float:right;color:red;">
								<?php
									if ($dueDate == $currentDate) {
										echo " / <span id='blink'>" . $dueDate . "</span>";
									} else {
										echo " / " . $dueDate;
									}
								?>
								</div>
							<?php } ?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
							?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
							?>
							</td>
							<?php
							$getUrl = base64_encode($row['client_name']."".$row['client_email']);
							?>
							<td class="breakTD">
								<?php 
								$query = "SELECT note_documents, note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
								$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
								$buttonClass = $docRow['note_documents'] != '' ? 'btn-success' : 'btn-outline-danger';
								$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
								$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
								?>
								<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

								<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

								<?php if($checkApplication=='Inform the Client to Recheck the Application' || $checkApplication=='Applications Sent to the client for Rechecking' || $checkApplication=='Client Requests Changes in the Application' || $checkApplication=='Changes Complete By Processing Team' || $checkApplication=='Application Approved by the Client' || $checkApplication=='Client Informed, How to Pay the Application Fee' || $checkApplication=='Application Fee Paid by Client' || $checkApplication=='Admission Application Submitted by Processing Team' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $visaProcess=='After Admission Dues Clear Clients' || $visaProcess=='After Admission Dues Not Clear Clients'){ ?>

									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php } else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php } 
									?>
								<?php }else{ ?>

									<?php if ($sumBalance=='0') {
										$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A.Pro.</button> </a>
										<?php 
										}elseif($assignedNo > 0 ){ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A.Pro.</button> </a>
										<?php
										}else{
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
											
										<?php
										}
									?>
									<?php }else{ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
									<?php } ?>

									<br>
									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php
										}
										else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php
										}
									?>

								<?php } ?>
								<br>
								<?php
								$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result_ex = mysqli_query($con, $query);
								foreach ($result_ex as $italPro) {
									$assignDate = $italPro['italy_program_assign_date'];

									if ($assignDate!='0000-00-00') {
										$date2 = date('Y-m-d');
										$timestamp_assignDate = strtotime($assignDate);
										$timestamp_date2 = strtotime($date2);
										$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
										$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
										// echo $daysAssign_diff;
										if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
										<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
										<?php }
									}
								}
								?>
							</td>
							<td>
							<?php
								$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
								$data = mysqli_fetch_assoc($result);
								$num = $data['NumberOfLists'];
								// $isItaly = $num == 2 && $row['client_country'] == 'italy';
							?>
							<?php if ($sumBalance=='0') { ?>
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
							<?php }else{ ?> 
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
							<?php } ?>
								
							</td>
							<td>
								<?php include ("../components/ViewActionTd.php");?>
							</td>
						</tr>
					<?php
					$sr--;
					}?>
					<?php
				}
				elseif($assignPrograms=='List of Clients with University Closed Admission'){
					
					function countUniversityPrograms($con, $universities, $degreeType) {
						$resultsClose = [];
						foreach ($universities as $university) {
							$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$university['name']}' AND italy_degree_name='{$degreeType}' ORDER BY italy_dates_id DESC LIMIT 1";
							$selectQuery_ex = mysqli_query($con, $selectQuery);
							if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
								$dateRow = mysqli_fetch_assoc($selectQuery_ex);
								$dateStatus = $dateRow['italy_date_status'];
								$openingDate = $dateRow['italy_opening_date'];
								$closingDate = $dateRow['italy_closing_date'];
								$currentDate = date('Y-m-d');
								if ($dateStatus=='2') {
									$clientDataQuery = "SELECT * FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id JOIN italy_university_dates ON icp.italy_university_name = italy_university_dates.italy_university_name AND icp.italy_client_degree = italy_university_dates.italy_degree_name WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND italy_university_dates.italy_date_status='2' GROUP BY cl.client_id ORDER BY client_id DESC";
									$clientCloseData_ex = mysqli_query($con, $clientDataQuery);
									// echo mysqli_num_rows($clientCloseData_ex);
									if ($clientCloseData_ex) {
										while ($closeRow = mysqli_fetch_assoc($clientCloseData_ex)) {
											$resultsClose[$closeRow['client_id']] = $closeRow;
										}
									}
								}
								
							}
						}
						return array_values($resultsClose);
					}
					// University arrays for each degree type
					$masterUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Bergamo (BR)'],
						['name' => 'University of Ferrara (FR)'],
						['name' => 'University of Florence (UF)'],
						['name' => 'University of Foggia (FG)'],
						['name' => 'University of Genevo (UG)'],
						['name' => 'University of Pisa (UP)'],
						['name' => 'University of Salerno (SL)'],
						['name' => 'University of Verona (VN)']
					];
					$bachelorUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Cassino (CS)']
					];
					$mbbsUniversities = [
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Parma (PRM)']
					];
					// Count open and closed programs for each degree type
					$masterResults = countUniversityPrograms($con, $masterUniversities, 'master');
					$bachelorResults = countUniversityPrograms($con, $bachelorUniversities, 'bachelor');
					$mbbsResults = countUniversityPrograms($con, $mbbsUniversities, 'mbbs');

					$allCloseResults = array_values(
						array_intersect_key(
							array_merge($masterResults, $bachelorResults, $mbbsResults),
							array_unique(array_column(array_merge($masterResults, $bachelorResults, $mbbsResults), 'client_id'))
						)
					);
					// $allCloseResults = array_merge($masterResults, $bachelorResults, $mbbsResults);
					?>
					<?php
					$sr = count($allCloseResults);
					foreach ($allCloseResults as $row) {
						$clientID = $row['client_id'];
						$changingApplied = $row['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						// SUM of adv payment from the client payments
						$payClient = "SELECT SUM(pay_receive_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
						$payClient_ex = mysqli_query($con, $payClient);
						$payrow = mysqli_fetch_assoc($payClient_ex);
						$sumReceived = $payrow['SUM(pay_receive_amount)'];

						// fetch last balance amount and date from the clients_payments".$_SESSION['dbNo']."
						$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
						$balClient_ex = mysqli_query($con, $balClient);
						$balrow = mysqli_fetch_assoc($balClient_ex); 
						$sumBalance = $balrow['pay_bal_amount'];
						$pay_due_date = $balrow['pay_due_date'];

						// query get first row of accept and visa rp
						$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
						$select_query_ex = mysqli_query($con, $select_query);
						$pay1Row = mysqli_fetch_assoc($select_query_ex);
						$payAfterAccept = $pay1Row['pay_after_accept'];
						$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];
						?>
						<tr id="<?php echo $row['client_id']; ?>">
							<?php 
							echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
							if ($row['client_process_status']=='OverAll Process') {
								echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
							}elseif ($row['client_process_status']=='Only Admission Process') {
								echo "<b class='text-info'>Only Admission <br> Process</b>";
							}else{
								echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
							}
							echo "</td>";
							?>
							<td class="breakTD">
								<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
								<br>
								<?php if ($row['client_convert_status']=='New Client') {
									echo "<b class='text-success'>New Client</b>";
								}elseif ($row['client_convert_status']=='Old Client') {
									echo "<b class='text-info'>Old Client</b>";
								}elseif($row['client_convert_status']=='Old Converted Client'){
									echo "<b class='text-warning'>Old Converted Client</b>";
								}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
									echo "<b class='text-info'>Italy Old Client 2024</b>";
								}elseif($row['client_convert_status']=='Austria Converted Client'){
									echo "<b class='text-warning'>Austria Converted Client</b>";
								} ?>
							</td>
							<td class="breakTD">
								<?php
								echo ucwords($row['client_country'])." <br>";
								foreach ($appliedChanging as $appRow){
									echo "<b>".ucwords($appRow)."</b> ";
								}?>
								<br>
								<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
								<br>
								<?php
								$embassyTooltips = [
									'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
									'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
									'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
									'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
								];
								?>
								<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
							</td>
							<td>
							<?php 
							$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
							$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

							$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

							echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
							?><br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>";
							?>
							<?php
							$dateString = $pay_due_date;
							if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
								$date = new DateTime($dateString);
								$dueDate = $date->format('d-m-Y');
								$currentDate = date('d-m-Y');
								?>
								<br>
								<div style="float:right;color:red;">
								<?php
									if ($dueDate == $currentDate) {
										echo " / <span id='blink'>" . $dueDate . "</span>";
									} else {
										echo " / " . $dueDate;
									}
								?>
								</div>
							<?php } ?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
							?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
							?>
							</td>
							<?php
							$getUrl = base64_encode($row['client_name']."".$row['client_email']);
							?>
							<td class="breakTD">
								<?php 
								$query = "SELECT note_documents, note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
								$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
								$buttonClass = $docRow['note_documents'] != '' ? 'btn-success' : 'btn-outline-danger';
								$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
								$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
								?>
								<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

								<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

								<?php if($checkApplication=='Inform the Client to Recheck the Application' || $checkApplication=='Applications Sent to the client for Rechecking' || $checkApplication=='Client Requests Changes in the Application' || $checkApplication=='Changes Complete By Processing Team' || $checkApplication=='Application Approved by the Client' || $checkApplication=='Client Informed, How to Pay the Application Fee' || $checkApplication=='Application Fee Paid by Client' || $checkApplication=='Admission Application Submitted by Processing Team' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $visaProcess=='After Admission Dues Clear Clients' || $visaProcess=='After Admission Dues Not Clear Clients'){ ?>

									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php } else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php } 
									?>
								<?php }else{ ?>

									<?php if ($sumBalance=='0') {
										$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A.Pro.</button> </a>
										<?php 
										}elseif($assignedNo > 0 ){ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A.Pro.</button> </a>
										<?php
										}else{
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
											
										<?php
										}
									?>
									<?php }else{ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
									<?php } ?>

									<br>
									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php
										}
										else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php
										}
									?>

								<?php } ?>
								<br>
								<?php
								$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result_ex = mysqli_query($con, $query);
								foreach ($result_ex as $italPro) {
									$assignDate = $italPro['italy_program_assign_date'];

									if ($assignDate!='0000-00-00') {
										$date2 = date('Y-m-d');
										$timestamp_assignDate = strtotime($assignDate);
										$timestamp_date2 = strtotime($date2);
										$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
										$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
										// echo $daysAssign_diff;
										if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
										<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
										<?php }
									}
								}
								?>
							</td>
							<td>
							<?php
								$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
								$data = mysqli_fetch_assoc($result);
								$num = $data['NumberOfLists'];
								// $isItaly = $num == 2 && $row['client_country'] == 'italy';
							?>
							<?php if ($sumBalance=='0') { ?>
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
							<?php }else{ ?> 
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
							<?php } ?>
								
							</td>
							<td>
								<?php include ("../components/ViewActionTd.php");?>
							</td>
						</tr>
					<?php
					$sr--;
					}?>
					<?php
				}elseif($assignPrograms=='List of Clients with University Open Admission'){
					
					function countUniversityPrograms($con, $universities, $degreeType) {
						$resultsAdOpen = [];
						foreach ($universities as $university) {
							$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='{$university['name']}' AND italy_degree_name='{$degreeType}' ORDER BY italy_dates_id DESC LIMIT 1";
							$selectQuery_ex = mysqli_query($con, $selectQuery);
							if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
								$dateRow = mysqli_fetch_assoc($selectQuery_ex);
								$dateStatus = $dateRow['italy_date_status'];
								$openingDate = $dateRow['italy_opening_date'];
								$closingDate = $dateRow['italy_closing_date'];
								$currentDate = date('Y-m-d');
								if ($dateStatus=='1') {
									$clientDataQuery = "SELECT * FROM clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id JOIN italy_university_dates ON icp.italy_university_name = italy_university_dates.italy_university_name AND icp.italy_client_degree = italy_university_dates.italy_degree_name WHERE icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND italy_university_dates.italy_date_status='1' AND (italy_university_dates.italy_opening_date < '$currentDate' || italy_university_dates.italy_closing_date < '$currentDate') GROUP BY cl.client_id ORDER BY client_id DESC";
									$clientAdOpenData_ex = mysqli_query($con, $clientDataQuery);
									// echo mysqli_num_rows($clientAdOpenData_ex);
									if ($clientAdOpenData_ex) {
										while ($adOpenRow = mysqli_fetch_assoc($clientAdOpenData_ex)) {
											$resultsAdOpen[$adOpenRow['client_id']] = $adOpenRow;
										}
									}
								}
								
							}
						}
						return array_values($resultsAdOpen);
					}
					// University arrays for each degree type
					$masterUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Bergamo (BR)'],
						['name' => 'University of Ferrara (FR)'],
						['name' => 'University of Florence (UF)'],
						['name' => 'University of Foggia (FG)'],
						['name' => 'University of Genevo (UG)'],
						['name' => 'University of Pisa (UP)'],
						['name' => 'University of Salerno (SL)'],
						['name' => 'University of Verona (VN)']
					];
					$bachelorUniversities = [
						['name' => 'CaFoscari University of Venice (FV)'],
						['name' => 'Sapienza University of Rome (SPU)'],
						['name' => 'Universita Politecnica Delle Marche (MR)'],
						['name' => 'University of Bologna (UBN)'],
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Napoli Fedrico II (UNP)'],
						['name' => 'University of Padua (PDU)'],
						['name' => 'University of Palermo (PLM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Perugia (UPG)'],
						['name' => 'University of Siena (US)'],
						['name' => 'University of Trieste (TR)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Cassino (CS)']
					];
					$mbbsUniversities = [
						['name' => 'University of Campania (UC)'],
						['name' => 'University of Messina (UM)'],
						['name' => 'University of Pavia (PV)'],
						['name' => 'University of Turin (TU)'],
						['name' => 'University of Parma (PRM)']
					];

					// Count open and closed programs for each degree type
					$masterResults = countUniversityPrograms($con, $masterUniversities, 'master');
					$bachelorResults = countUniversityPrograms($con, $bachelorUniversities, 'bachelor');
					$mbbsResults = countUniversityPrograms($con, $mbbsUniversities, 'mbbs');

					$allAdOpenResults = array_values(
						array_intersect_key(
							array_merge($masterResults, $bachelorResults, $mbbsResults),
							array_unique(array_column(array_merge($masterResults, $bachelorResults, $mbbsResults), 'client_id'))
						)
					);

					// $allAdOpenResults = array_merge($masterResults, $bachelorResults, $mbbsResults);
					?>

					<?php
					$sr = count($allAdOpenResults);
					foreach ($allAdOpenResults as $row) {
						$clientID = $row['client_id'];
						$changingApplied = $row['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						// SUM of adv payment from the client payments
						$payClient = "SELECT SUM(pay_receive_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
						$payClient_ex = mysqli_query($con, $payClient);
						$payrow = mysqli_fetch_assoc($payClient_ex);
						$sumReceived = $payrow['SUM(pay_receive_amount)'];

						// fetch last balance amount and date from the clients_payments".$_SESSION['dbNo']."
						$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
						$balClient_ex = mysqli_query($con, $balClient);
						$balrow = mysqli_fetch_assoc($balClient_ex); 
						$sumBalance = $balrow['pay_bal_amount'];
						$pay_due_date = $balrow['pay_due_date'];

						// query get first row of accept and visa rp
						$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
						$select_query_ex = mysqli_query($con, $select_query);
						$pay1Row = mysqli_fetch_assoc($select_query_ex);
						$payAfterAccept = $pay1Row['pay_after_accept'];
						$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];
						?>
						<tr id="<?php echo $row['client_id']; ?>">
							<?php 
							echo "<td>".$sr."</td><td>ID-".$row['client_id']."<br><b>".date("d-m-Y", strtotime($row['create_date']))."</b><br>";
							if ($row['client_process_status']=='OverAll Process') {
								echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
							}elseif ($row['client_process_status']=='Only Admission Process') {
								echo "<b class='text-info'>Only Admission <br> Process</b>";
							}else{
								echo "<b class='text-danger'>Have Accepted <br> Letter (Only Visa)</b>";
							}
							echo "</td>";
							?>
							<td class="breakTD">
								<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
								<br>
								<?php if ($row['client_convert_status']=='New Client') {
									echo "<b class='text-success'>New Client</b>";
								}elseif ($row['client_convert_status']=='Old Client') {
									echo "<b class='text-info'>Old Client</b>";
								}elseif($row['client_convert_status']=='Old Converted Client'){
									echo "<b class='text-warning'>Old Converted Client</b>";
								}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
									echo "<b class='text-info'>Italy Old Client 2024</b>";
								}elseif($row['client_convert_status']=='Austria Converted Client'){
									echo "<b class='text-warning'>Austria Converted Client</b>";
								} ?>
							</td>
							<td class="breakTD">
								<?php
								echo ucwords($row['client_country'])." <br>";
								foreach ($appliedChanging as $appRow){
									echo "<b>".ucwords($appRow)."</b> ";
								}?>
								<br>
								<span data-toggle="tooltip" data-placement="top" title="Country"><?php echo ucwords($row['client_countryfrom']);?></span>
								<br>
								<?php
								$embassyTooltips = [
									'Islamabad Embassy' => 'Islamabad Embassy (Punjab, KPK, and northern areas)',
									'Karachi Embassy' => 'Karachi Embassy (Sindh and Balochistan)',
									'Dubai Embassy' => 'Dubai Embassy (Except for Sharjah and Abu Dhabi, students from all other states of the UAE will select the Dubai embassy.)',
									'Abu Dhabi Embassy' => 'Abu Dhabi Embassy (Abu Dhabi, Sharjah)'
								];
								?>
								<span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span>
							</td>
							<td>
							<?php 
							$currency = ($row['client_countryfrom']=='Saudi Arabia' || $row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' ) ? 'AED' : 'PKR';
							$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');

							$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');

							echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
							?><br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
							?>
							<?php
							$dateString = $pay_due_date;
							if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
								$date = new DateTime($dateString);
								$dueDate = $date->format('d-m-Y');
								$currentDate = date('d-m-Y');
								?>
								<br>
								<div style="float:right;color:red;">
								<?php
									if ($dueDate == $currentDate) {
										echo " / <span id='blink'>" . $dueDate . "</span>";
									} else {
										echo " / " . $dueDate;
									}
								?>
								</div>
							<?php } ?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
							?>
							<br> 
							<?php 
							echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
							?>
							</td>
							<?php
							$getUrl = base64_encode($row['client_name']."".$row['client_email']);
							?>
							<td class="breakTD">
								<?php 
								$query = "SELECT note_documents, note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
								$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
								$buttonClass = $docRow['note_documents'] != '' ? 'btn-success' : 'btn-outline-danger';
								$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
								$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
								?>
								<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

								<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>

								<?php if($checkApplication=='Inform the Client to Recheck the Application' || $checkApplication=='Applications Sent to the client for Rechecking' || $checkApplication=='Client Requests Changes in the Application' || $checkApplication=='Changes Complete By Processing Team' || $checkApplication=='Application Approved by the Client' || $checkApplication=='Client Informed, How to Pay the Application Fee' || $checkApplication=='Application Fee Paid by Client' || $checkApplication=='Admission Application Submitted by Processing Team' || $checkApplication=='Sent Admission Applied Proof to Client' || $checkApplication=='Waiting for Admission decision' || $checkApplication=='Acceptance Letter Received Clients' || $checkApplication=='University Admission Rejected Clients' || $visaProcess=='After Admission Dues Clear Clients' || $visaProcess=='After Admission Dues Not Clear Clients'){ ?>

									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php } else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php } 
									?>
								<?php }else{ ?>

									<?php if ($sumBalance=='0') {
										$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A.Pro.</button> </a>
										<?php 
										}elseif($assignedNo > 0 ){ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A.Pro.</button> </a>
										<?php
										}else{
										?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
											
										<?php
										}
									?>
									<?php }else{ ?>
										<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
									<?php } ?>

									<br>
									<?php
										$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
										$result = mysqli_query($con, $query);
										$data = mysqli_fetch_array($result);
										$totalNo = $data['totalAssign'];
										$assignedNo = $data['assignedNo'];
										if($totalNo == $assignedNo){ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
										<?php
										}
										else{ ?>
											<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
										<?php
										}
									?>

								<?php } ?>
								<br>
								<?php
								$query="SELECT italy_applied_status, italy_direct_applied_status, italy_pre_applied_status, italy_tolc_applied_status, italy_cimea_applied_status, italy_program_assign_date FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
								$result_ex = mysqli_query($con, $query);
								foreach ($result_ex as $italPro) {
									$assignDate = $italPro['italy_program_assign_date'];

									if ($assignDate!='0000-00-00') {
										$date2 = date('Y-m-d');
										$timestamp_assignDate = strtotime($assignDate);
										$timestamp_date2 = strtotime($date2);
										$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
										$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
										// echo $daysAssign_diff;
										if ($daysAssign_diff >= 1 && ($italPro['italy_applied_status']=='0' && $italPro['italy_direct_applied_status']=='0' &&  $italPro['italy_pre_applied_status']=='0' && $italPro['italy_tolc_applied_status']=='0' && $italPro['italy_cimea_applied_status']=='0') ) { ?>
										<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
										<?php }
									}
								}
								?>
							</td>
							<td>
							<?php
								$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
								$data = mysqli_fetch_assoc($result);
								$num = $data['NumberOfLists'];
								// $isItaly = $num == 2 && $row['client_country'] == 'italy';
							?>
							<?php if ($sumBalance=='0') { ?>
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List"> <i class="mdi mdi-check-outline"></i> C.L </button> </a>
							<?php }else{ ?> 
								<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num == 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Check List" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> C.L </button></a>
							<?php } ?>
								
							</td>
							<td>
								<?php include ("../components/ViewActionTd.php");?>
							</td>
						</tr>
					<?php
					$sr--;
					}?>
					<?php
				}
			}
			?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({ html: true });

				var tableId = "datatable";
				var storageKey = 'DataTables_' + tableId + '_' + window.location.pathname;
				var currentPath = window.location.pathname;
				// Function to clear the stored state
				function clearStoredState() {
					localStorage.removeItem(storageKey);
				}
				// Check if the current URL matches the stored URL
				var storedPath = localStorage.getItem('lastPath');
				if (storedPath !== currentPath) {
					clearStoredState();
					localStorage.setItem('lastPath', currentPath);
				}
				var table = $("#" + tableId).DataTable({
					stateSave: true,
					stateDuration: -1,
					pageResetOnReload: true,
					order: [[0, 'desc']],
					lengthMenu: [[25, 10, 50, 100, 200, 500,], [25, 10, 50, 100, 200, 500,]],
				});
				// Reset search bar and pagination if the path has changed
				if (storedPath !== currentPath) {
					table.page('first').draw('page'); 
					table.search('').draw();
				} else if (localStorage.getItem(storageKey)) {
					// Only restore state if on the same page
					var state = JSON.parse(localStorage.getItem(storageKey));
					var page = state.start / state.length;
					table.page(page).draw('page');
				}
			});
		</script>
	</div>
<?php
}
?>