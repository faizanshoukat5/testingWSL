<?php 
$clientID = $_GET['client-id'];
$uniName = $_GET['university-name'];
$application = $_GET['application-status'];
?>
<div class="card">
	<div class="card-body">
		<div class="alert alert-primary">
			<h5><?php if($uniName=='all'){echo "All Clients";}else{echo $uniName;}?> >> <b>Apply Programs</b></h5>
		</div>
		<!-- Client data from component -->
		<?php include ("components/ClientQueryData.php"); ?>
		<!-- Sale Note from component -->
		<?php include ("components/SaleNote.php"); ?>
		<div class="table-responsive mt-1">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 20px;">Sr</th>
						<th style="width: 150px;">University</th>
						<th style="width: 200px;">Program</th>
						<th style="width: 80px;">Intake</th>
						<th style="width: 150px;">Current Status</th>
						<th style="width: 80px;">Apply Date</th>
						<th style="width: 120px;">Action</th>
						<th style="width: 150px;">Pre Enrollment</th>
						<th style="width: 180px;">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sr=1;
					if ($uniName=='all' && $application=='Inform the Client to Recheck the Application') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='0' AND italy_pre_applied_status='5') || (italy_info_client_status='0' AND italy_applied_status='5') || (italy_direct_info_client_status='0' AND italy_direct_applied_status='5') || (italy_cimea_info_client_status='0' AND italy_cimea_applied_status='5') || (italy_tolc_info_status='0' AND italy_tolc_applied_status='3') ) ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Applications Sent to the client for Rechecking') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='1' AND italy_pre_applied_status='5') || (italy_info_client_status='1' AND italy_applied_status='5') || (italy_direct_info_client_status='1' AND italy_direct_applied_status='5') || (italy_cimea_info_client_status='1' AND italy_cimea_applied_status='5') || (italy_tolc_info_status='1' AND italy_tolc_applied_status='3') ) ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Client Requests Changes in the Application') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='2' AND italy_pre_applied_status='5') || (italy_info_client_status='2' AND italy_applied_status='5') || (italy_direct_info_client_status='2' AND italy_direct_applied_status='5') || (italy_cimea_info_client_status='2' AND italy_cimea_applied_status='5') )";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Changes Complete By Processing Team') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='2' AND italy_pre_applied_status='6') || (italy_info_client_status='2' AND italy_applied_status='6') || (italy_direct_info_client_status='2' AND italy_direct_applied_status='6') || (italy_cimea_info_client_status='2' AND italy_cimea_applied_status='6') ) ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Client Informed, How to Pay the Application Fee') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='4' AND (italy_pre_applied_status='5' || italy_pre_applied_status='6')) || (italy_info_client_status='4' AND (italy_applied_status='5' || italy_applied_status='6')) || (italy_direct_info_client_status='4' AND (italy_direct_applied_status='6' || italy_direct_applied_status='5')) || (italy_cimea_info_client_status='4' AND (italy_cimea_applied_status='6' || italy_cimea_applied_status='5')) ) ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Application Approved And Application Fee Paid by Client') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='5' AND (italy_pre_applied_status='5' || italy_pre_applied_status='6')) || (italy_info_client_status='5' AND (italy_applied_status='5' || italy_applied_status='6')) || (italy_direct_info_client_status='5' AND (italy_direct_applied_status='6' || italy_direct_applied_status='5')) || (italy_cimea_info_client_status='5' AND (italy_cimea_applied_status='6' || italy_cimea_applied_status='5')) ) ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Admission Application Submitted by Processing Team') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_pre_info_client_status='5' AND italy_pre_applied_status='7') || (italy_info_client_status='5' AND italy_applied_status='7') || (italy_direct_info_client_status='5' AND italy_direct_applied_status='7') || (italy_cimea_info_client_status='5' AND italy_cimea_applied_status='7') )";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Sent Admission Applied Proof to Client') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_proof_screenshot1!='' || italy_direct_proof_screenshot!='' || italy_pre_proof_screenshot!='' || italy_tolc_fee_proof_screenshot!='') ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Inform to Processing Team to Fill Bergamo Enrollment Fee Form') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_info_client_status='10' AND italy_applied_status='10') ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_info_client_status='11' AND italy_applied_status='11') ";
						$select_query_ex = mysqli_query($con,$select_query);
					}

					elseif ($uniName=='all' && $application=='Bergamo University clients who have not yet paid the enrollment fee') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_info_client_status='12' AND italy_applied_status='12') ";
						$select_query_ex = mysqli_query($con,$select_query);
					}

					elseif ($uniName=='all' && $application=='Additional Activities Required by University Clients Assign to Processing Team') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_additional_activities_status='1' ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Additional Activities Required by University Task Complete by Processing Team') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_additional_activities_status='2' ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Waiting for Admission decision') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND ((italy_info_client_status='6' AND italy_applied_status='7') || (italy_direct_info_client_status='6' AND italy_direct_applied_status='7') ) ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Acceptance Letter Received Clients') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_dream_program1_status='Acceptance' || italy_dream_program2_status='Acceptance' || italy_direct_program1_status='Acceptance' || italy_direct_program2_status='Acceptance') ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='University Admission Rejected Clients') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_dream_program1_status='Rejection' || italy_dream_program2_status='Rejection' || italy_direct_program1_status='Rejection' || italy_direct_program2_status='Rejection') ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Deadline Hold') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_deadline_hold_status='1' AND italy_clients_id='".$clientID."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='Deadline Release') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_deadline_hold_status='2' AND italy_clients_id='".$clientID."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif ($uniName=='all' && $application=='all') {
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					elseif($uniName!='all' && $application=='all'){
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND italy_university_name='".$uniName."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					else{
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					
					foreach ($select_query_ex as $rowPro) {
						$appliedDate = $rowPro['italy_applied_date'];
						$assignDate = $rowPro['italy_program_assign_date'];
						$clientDegree = $rowPro['italy_client_degree'];
						$uniName = $rowPro['italy_university_name'];
						$TDstyle = $rowPro['italy_assign_status']==1 ? 'background: #D7FFF1; color: #000;' : '';
					?>
					<tr id="<?php echo $rowPro['italy_client_pro_id'];?>">
						<td style="<?php echo $TDstyle;?>"><?php echo $sr;?></td>
						<td style="<?php echo $TDstyle;?>" class="breakTD">
							<?php echo ucwords($rowPro['italy_university_name']); ?>
						</td>
						<td style="<?php echo $TDstyle; ?>" class="breakTD text-left">
							<?php 
							$programName = $rowPro['italy_program_name'];
							$changedProgramName = $rowPro['italy_change_program_name'] ? "<br>" . ucwords($rowPro['italy_change_program_name']) : '';
							if (empty($programName)) {
								echo $changedProgramName;
							} else {
								$decoded = json_decode($programName, true);
								if (is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $name) {
										$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
									}
									echo ($rowPro['close'] == '0' || $rowPro['italy_change_program_status'] == '1') 
									? "<del>$output</del>$changedProgramName" 
									: ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
								} else {
									echo ($rowPro['close'] == '0' || $rowPro['italy_change_program_status'] == '1') 
									? "<del>" . ucwords($programName) . "</del>$changedProgramName" 
									: ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
								}
							}
							?>
						</td>
						<td style="<?php echo $TDstyle;?>"><?php echo ucwords($rowPro['italy_intake']);?></td>
						
						<td style="<?php echo $TDstyle;?>" class="breakTD">
						<?php 
						include('phphelpers/directPreApplySteps.php');
						include('phphelpers/dreamApplySteps.php');
						include('phphelpers/directApplySteps.php');
						include('phphelpers/cimeaApplySteps.php');
						include('phphelpers/tolcApplySteps.php');
						?>
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<?php }else{ ?>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
							<?php } ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>
							<!-- cimea apply -->
							<?php echo $admissionCimeaStatus;?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionPreStatus; ?>
						<?php }
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionDirectStatus;?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionPreStatus; ?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Tolc apply -->
							<?php echo $admissionTolcStatus;?>
						<?php } ?>
						</td>
						<td style="<?php echo $TDstyle;?>"> 
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionPreDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDreamDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDirectDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							<?php echo $admissionPreDate;?>
							<br><br>
							<?php echo $admissionDreamDate;?>
							<?php }else{ ?>
							<?php echo $admissionDreamDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
							<?php } ?>
							
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDirectDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDreamDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDreamDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>
							<?php echo $admissionCimeaDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionPreDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
						<?php } 
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
						<?php } ?>
						</td>
						<?php
						$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);

						$clientData = "SELECT admission_doc8, admission_doc12, admission_doc36 FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
						$clientData_ex = mysqli_query($con, $clientData);
						$rowDoc = mysqli_fetch_assoc($clientData_ex);
						$doc12Name = $rowDoc['admission_doc12'] ?? '';
						$doc36Name = $rowDoc['admission_doc36'] ?? '';
						$doc8Name = $rowDoc['admission_doc8'] ?? '';
						$disButton='';
						if($uniName=='Sapienza University of Rome (SPU)' && ($clientDegree=='bachelor' || $clientDegree=='master') && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Trento (TRN)' && ($clientDegree=='bachelor' || $clientDegree=='master') && $doc36Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Messina (UM)' && ($clientDegree=='bachelor' || $clientDegree=='master') && ($doc12Name=='' || $doc36Name=='')){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Cassino (CS)' && ($clientDegree=='bachelor') && $doc12Name==''){
							$disButton = 'disabled';
						}
							// elseif($uniName=='University of Pavia (PV)' && ($clientDegree=='bachelor') && $doc12Name==''){
							// 	$disButton = 'disabled';
							// }
						elseif(($uniName=='University of Bologna (UBN)' && $clientDegree=='master' && (strpos($programName, 'Physics') === false ) ) && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Florence (UF)' && $clientDegree=='master' && $doc8Name==''){
							$disButton = 'disabled';
						}
						elseif(($uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)') && $clientDegree=='bachelor' && $doc12Name==''){
							$disButton = 'disabled';
						}

						?>
						<td style="<?php echo $TDstyle;?>">
						<?php $btnDreamClass = $rowPro['italy_proof_screenshot1']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnDirectClass = $rowPro['italy_direct_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnPreClass = $rowPro['italy_pre_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $testType = 'CEnT-S'; ?>
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
							<br>
							2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php }else{ ?>
							1. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
							<?php } ?>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a> 
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>

							1. <a href="cimea-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Cimea Apply"><i class="mdi mdi-alpha-c-circle"></i> Cimea</button></a>
							<br>
							<?php if($rowPro['italy_cimea_accepted_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							<br>
							<?php if($rowPro['italy_cimea_accepted_screenshot']!='' && $rowPro['italy_tolc_pass_screenshot']!=''){ ?>
								3. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E. </button></a>
							<?php }else{ ?>
								3. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply" disabled=""><i class="mdi mdi-information"></i> Pre E. </button></a>
							<?php } ?>
							
						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php 
							if (stripos($rowPro['italy_program_name'], 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
								2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Social Sciences For Global Challenges') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International And Economics Studies') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
							1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<br>
							<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
							2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Social Sciences For Global Challenges') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International And Economics Studies') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register Tolc Test" ><i class="mdi mdi-registered-trademark"></i> R. Tolc</button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }

						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<br>
							<?php if($rowPro['italy_direct_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
							<br>
							<?php if($rowPro['italy_pre_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>" disabled=""><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
						<?php }
						?>
						<br>
						<?php
						if ($assignDate!='0000-00-00') {
							$date2 = date('Y-m-d');
							$timestamp_assignDate = strtotime($assignDate);
							$timestamp_date2 = strtotime($date2);
							$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
							$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
							// echo $daysAssign_diff;
							if ($daysAssign_diff >= 1 && $rowPro['italy_applied_status']=='0' && $rowPro['italy_direct_applied_status']=='0' && $rowPro['italy_pre_applied_status']=='0' && $rowPro['italy_tolc_applied_status']=='0' && $rowPro['italy_cimea_applied_status']=='0' ) { ?>
							<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
							<?php }
						}
						?>
						</td>
						<td style="<?php echo $TDstyle;?>">
							<?php $btnPre = (($rowPro['italy_pre_assign_to']!= '0') || ($rowPro['italy_assign_status']=='1' && $rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0')) ? 'btn-success' : (!empty($rowPro['italy_send_to_pre_proof']) ? 'btn-outline-warning' : 'btn-outline-danger'); ?>
							<button type="button" class="btn <?php echo $btnPre;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Enroll For Pre Enrollment" onclick="sendPreEnrollment(<?php echo $rowPro['italy_client_pro_id'];?>);"> <i class="mdi mdi-alpha-p-circle"></i> Pre Enrollment</button>
							<?php 
							if ($rowPro['italy_pre_assign_to']!='0') {
								$wt_query = mysqli_query($con, "SELECT fname, lname FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$rowPro['italy_pre_assign_to']."' ");
								if ($wtrow = mysqli_fetch_assoc($wt_query)) {
									$wtPreName = $wtrow['fname']." ".$wtrow['lname'];
								}
								?>
								<br>
								<span class="badge bg-purple pt-2 pb-2 mt-1" data-toggle="tooltip" data-placement="top" title="This University is Assign to"><?php echo ucwords($wtPreName);?></span> 
							<?php } ?>

							<?php 
							if ($rowPro['italy_assign_status']=='1' && $rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0') {
								$wt_query = mysqli_query($con, "SELECT fname, lname FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$rowPro['italy_program_assign']."' ");
								if ($wtrow = mysqli_fetch_assoc($wt_query)) {
									$wtDirectPreName = $wtrow['fname']." ".$wtrow['lname'];
								}
							?>
							<br>
							<span class="badge bg-purple pt-2 pb-2 mt-1" data-toggle="tooltip" data-placement="top" title="This University is Assign to"><?php echo ucwords($wtDirectPreName);?></span> 
							<?php } ?>
						</td>
						<?php 
						if($rowPro['italy_deadline_hold_status']==1){
							$btnVal = 'btn-danger';
						}elseif($rowPro['italy_deadline_hold_status']==2){
							$btnVal = 'btn-success';
						}elseif($rowPro['italy_deadline_hold_status']==0){
							$btnVal = 'btn-outline-secondary';
						}
						?>
						<td style="<?php echo $TDstyle;?>">
							<button type="button" class="btn <?php echo $btnVal;?> btn-sm" data-toggle="tooltip" data-placement="top" title="If the Client wants Hold Application" onclick="holdApplication(<?php echo $rowPro['italy_client_pro_id'];?>);"> <i class="mdi mdi-alpha-d-circle"></i> </button>
							
							<?php 
							if ($rowPro['italy_assign_status'] == 1) {
								$wt_query = mysqli_query($con, "SELECT fname, lname FROM wt_users WHERE status='1' AND close='1' AND wt_id='".$rowPro['italy_program_assign']."' ");
								if ($wtrow = mysqli_fetch_assoc($wt_query)) {
									$wtName = $wtrow['fname']." ".$wtrow['lname'];
								}
							?>
							<?php
							$statusClass = match($rowPro['italy_program_status']) {
								'1' => 'btn-warning',
								'2' => 'btn-success',
								default => 'btn-outline-primary',
							};
							?>
							<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Processing Team Report" onclick="addProgramNote(<?php echo $rowPro['italy_client_pro_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>
							<br>
							<span class="badge bg-purple pt-2 pb-2 mt-1" data-toggle="tooltip" data-placement="top" title="This University is Assign to"><?php echo ucwords($wtName);?></span> 
							<br> University Assigned
							<?php } ?>
						</td>
						
					</tr>
					<?php $sr++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- View Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient1" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle1" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient1">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	document.addEventListener("contextmenu", function (e) {
		if (e.target.tagName === "BUTTON" && e.target.disabled) {
			e.preventDefault();
		}
	});
	document.addEventListener('auxclick', function(e) {
		if (e.button === 1) {
			e.preventDefault();
			e.stopPropagation();
		}
	});

	// Save Apply & Assign Data using AJAX
	function saveDataForm(formID, proBtn) {
		let $form = $("#"+formID);
		let $btn = $("#"+proBtn);
		if ($form.parsley().validate()) {
			// CKEditor ka data update karne ka step
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append(proBtn, 1);
			$.ajax({
				url: "models/_applyAssignControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					let res = typeof response === "string" ? JSON.parse(response) : response;
					Swal.fire({
						title: res.title,
						text: res.text,
						icon: res.status
					}).then(() => {
						location.reload();
					});
				},
				error: function (xhr, status, error) {
					Swal.fire({
						title: "Error!",
						text: "Something went wrong: " + error,
						icon: "error"
					});
					$btn.prop("disabled", false).text("Submit");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields before submitting.",
				icon: "warning"
			});
		}
	}

	// Add note to Admission head
	function addProgramNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkProgramNote='+id,
			success: function(data){
				$(".showModalTitle1").html('Add Note');
				$(".showModalClient1").html(data);
				$("#showModalClient1").modal('show');
				$('#showModalClient1').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	};
	function updProReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'updProgramNote='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}

	function holdApplication(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'updHoldApplication='+id,
			success: function(data){
				$(".showModalTitle1").html('Deadline Hold Application Details');
				$(".showModalClient1").html(data);
				$("#showModalClient1").modal('show');
				$('#showModalClient1').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	}

	function delRefundApplication(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/applicationNoteState.php",
			data: {
				refundAppDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	function sendPreEnrollment(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'preEnrollmentSend='+id,
			success: function(data){
				$(".showModalTitle1").html('Sent to Pre Enrollment');
				$(".showModalClient1").html(data);
				$("#showModalClient1").modal('show');
				$('#showModalClient1').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	}
	function delSendPre(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/applicationNoteState.php",
			data: {
				sendPreDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	function delPreAssign(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/applicationNoteState.php",
			data: {
				assignPreDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	function delPreDirectAssign(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/applicationNoteState.php",
			data: {
				assignDirectPreDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
</script>