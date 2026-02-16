<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkcaseStatus'])) {
	$caseStatus = $_POST['checkcaseStatus'];
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientDegree = $_POST['checkclientDegree'];
	$intakeYear = $_POST['checkintakeYear'];

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
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	// Initialize the base WHERE condition
	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='".$caseStatus."' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' ";
	// Add filters based on the input parameters
	if ($clientStatus != "all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."'";
	}
	if ($clientCountry != "all") {
		if($clientCountry=='Pakistan' || $clientCountry=='UAE'){
			$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."'";
		}
		if($clientCountry=='Other Country'){
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE'";
		}
	}
	if ($clientDegree != "all") {
		$whereCondition .= " AND (cl.client_applied='$degInfo' OR cl.client_applied='$degbachMBBS')";
	}
	if ($intakeYear!="all" ) {
		$whereCondition .= "AND cl.client_intake_year='".$intakeYear."'";
	}
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="mt-1" style="overflow-x: auto; white-space: nowrap;">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 200px;">Client Info</th>
					<th style="width: 120px;">Degree</th>
					<th style="width: 100px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 200px;">Admission Status</th>
					<th style="width: 150px;">Visa Status</th>
					<th style="width: 200px;">Case Status</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$entryBy = $row['entry_by'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);
				$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				?>
				<?php include ("../components/PIAQueries.php");?>
				<tr id="<?php echo $row['client_id']; ?>">
					<td><?php echo $sr;?></td>
					<td>
						<?php include ("../components/IDDateTd.php");?>
					</td>
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
							echo "<b class='text-primary'>Italy Old Client 2024</b>";
						}elseif($row['client_convert_status']=='Austria Converted Client'){
							echo "<b class='text-purple'>Austria Converted Client</b>";
						}elseif($row['client_convert_status']=='Italy Converted Client'){
							echo "<b class='text-secondary'>Italy Converted Client</b>";
						}elseif($row['client_convert_status']=='Czech Republic Converted Client'){
							echo "<b class='text-pink'>Czech Republic Converted Client</b>";
						}elseif($row['client_convert_status']=='Canada Converted Client'){
							echo "<b class='text-danger'>Canada Converted Client</b>";
						}elseif($row['client_convert_status']=='USA Converted Client'){
							echo "<b class='text-dark'>USA Converted Client</b>";
						} ?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td>
						<?php include ("../components/PIATd.php");?>
					</td>
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
						<?php if ($sumBalance=='0') {
							$query = "SELECT COUNT(italy_assign_status) AS totalAssign,SUM(CASE WHEN italy_assign_status='1' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_clients_id='".$clientID."' ";
							$result = mysqli_query($con, $query);
							$data = mysqli_fetch_array($result);
							$totalNo = $data['totalAssign'];
							$assignedNo = $data['assignedNo'];
							if($totalNo == $assignedNo){
							?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=all"><button type="button" disabled="" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> A. Progr .</button> </a>
							<?php 
							}elseif($assignedNo > 0 ){ ?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=all"><button type="button" disabled="" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A. Progr .</button> </a>
							<?php
							}else{
							?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=all"><button type="button" disabled="" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Progr .</button> </a>
							<?php
							}
						?>
						<?php }else{ ?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&url=<?php echo $getUrl;?>&university-name=all"><button type="button" disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A. Progr .</button> </a>
						<?php } ?>

						<br>
						<?php 
						$btnClass = ($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='0' || $row['due_after_ad_status']=='2')) ? 'btn-warning' : (($row['due_after_ad_info_file']!='' && ($row['due_after_ad_status']=='1' || $row['due_after_ad_status']=='3')) ? 'btn-success' : 'btn-outline-danger');
						?>
						<button type="button" disabled="" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnClass; ?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Acceptance Dues" onclick="dueAfterAcceptance(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-d-box"></i> </button>
						<?php 
						$btnVisaClass = ($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']=='') ? 'btn-warning' : (($row['due_after_visa_info_file']!='' && $row['due_after_visa_paid_file']!='1') ? 'btn-success' : 'btn-outline-info');
						?>
						<button type="button" disabled="" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn <?= $btnVisaClass; ?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Add After Visa Dues" onclick="dueAfterVisa(<?= $row['client_id']; ?>);"> <i class="mdi mdi-alpha-v-box"></i> </button>
						<?php
						$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='6' || italy_direct_info_client_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' ";
						$result = mysqli_query($con, $query);
						$data = mysqli_fetch_array($result);
						$totalNo = $data['totalAssign'];
						$assignedNo = $data['assignedNo'];
						if($totalNo == $assignedNo){ ?>
							<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> A. Status </button> </a>
						<?php
						}
						else{ ?>
							<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=<?php echo $checkApplication;?>"><button type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> A. Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
						<?php
						}
						?>
						
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
								<br>
								<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
								<?php }
							}
						}
						?>
						<br>
						<?php 
						$btnSelf=$row['client_self_acceptance_file']!='' ? 'btn-success' : 'btn-outline-pink';
						?>
						<button type="button" disabled="" class="btn <?php echo $btnSelf;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Self Received Acceptance" onclick="selfAcceptance(<?= $row['client_id'];?>);"><i class="mdi mdi-clipboard-text"></i> Self R. Acceptance</button>
						<?php if($appRow=='mbbs'){ ?>
						<br>
						<a href="imat-registration?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" class="btn btn-outline-info btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="IMAT Registration"><i class="mdi mdi-clipboard-text"></i> IMAT Registration</button> </a>
						<?php } ?>
					</td>
					<?php 
					$Introquery="SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_client_id='".$clientID."' ";
					$Introquery_ex = mysqli_query($con, $Introquery);
					if ($Introquery_ex && mysqli_num_rows($Introquery_ex) > 0) {
						$clrow = mysqli_fetch_assoc($Introquery_ex);
						$introName = $clrow['visa_intro_checklist_steps_name'];
						if ($introName == 'Intro Message') {
							$btnIntro = 'btn-warning';
						} else {
							$btnIntro = 'btn-outline-purple';
						}
					}else {
						$btnIntro = 'btn-outline-purple';
					}
					?>
					<td>
						<a href="visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" disabled="" <?= $sumBalance == '0' ? '' : 'disabled'; ?><?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> style="width: 165px;" class="btn <?php echo $btnIntro;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> Visa Steps</button> </a>
						<br>
					<?php
						$result = mysqli_query($con, "SELECT COUNT(italy_checklist_name) AS NumberOfLists FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_client_check_id='".$clientID."' AND (italy_checklist_name='DOV' || italy_checklist_name='Visa' || italy_checklist_name='Cimea') AND entry_by='".$_SESSION['user_id']."' ");
						$data = mysqli_fetch_assoc($result);
						$num = $data['NumberOfLists'];
						// $isItaly = $num == 2 && $row['client_country'] == 'italy';
					?>
					<?php if ($sumBalance=='0') { ?>
						<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" disabled="" style="width: 165px;" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Send Checklist using Email"> <i class="mdi mdi-check-outline"></i> Email Checklist </button> </a>
					<?php }else{ ?> 
						<a href="client-checklist?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"><button type="button" style="width: 165px;" class="btn btn-<?php if ($num == 1) { echo 'warning'; } elseif ($num >= 2) { echo 'success'; } else { echo 'outline-primary';}?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Send Checklist using Email" onclick="addChecklist(<?php echo $row['client_id']; ?>);" disabled=""> <i class="mdi mdi-check-outline"></i> Email Checklist </button></a>
					<?php } ?>
					
					<br>
					<a href="after-visa-process?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>"> <button type="button" disabled="" <?= $sumBalance == '0' ? '' : 'disabled'; ?> <?php echo $row['client_process_status'] == 'Only Admission Process' ? 'disabled' : ''; ?> class="btn btn-outline-secondary btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="After Visa Process Steps"> <i class="mdi mdi-alpha-v-circle-outline"></i> After Visa Steps</button> </a>
					</td>
					<td class="ellipsis" data-toggle="tooltip" data-placement="left" title="<?php echo $row['client_case_note'];?>"> 
						<?php echo ucwords($row['client_case_name']);?> <br>
						<span class="text-danger"><?php echo $row['client_case_date'];?></span> <br>
						<?php echo $row['client_case_note'];?>
						<br>
						<?php 
						$fileMulti = explode(',', $row['client_case_screenshot']);
						foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
						<?php } ?>
					</td>
					<td>
						<button type="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="ViewClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-eye"></i></button> 
					</td>
				</tr>
				<?php
				$sr--;
				}
				?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({ html: true });
				if ($.fn.DataTable.isDataTable("#datatable")) {
					// Destroy the existing DataTable instance
					$('#datatable').DataTable().destroy();
				}
				$("#datatable").DataTable({
					paging: false,
					searching: false,
					info: false,
					lengthChange: false,
					order: [[0, 'desc']],
				});
			});
		</script>
	</div>
	<?php include ('../components/TablePagination.php'); ?>
<?php

}
?>