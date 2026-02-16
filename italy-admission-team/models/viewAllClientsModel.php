<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkconvertStatus'])) {
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientDegree = $_POST['checkclientDegree'];
	$intakeYear = $_POST['checkintakeYear'];
	$uniStatus = $_POST['checkuniStatus'];
	$appliedPrograms = $_POST['checkappliedPrograms'];
	$checkApplication = $_POST['checkapplicationStatus'];
	$preProcess = $_POST['checkpreProcess'];
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
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_program_assign='".$_SESSION['user_id']."' ";

	if ($clientStatus!="all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."' ";
	}
	if ($clientCountry!="all") {
		$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."' ";
	}
	if ($clientDegree!="all") {
		$whereCondition .= " AND (cl.client_applied='$degInfo' OR cl.client_applied='$degbachMBBS') ";
	}
	if ($intakeYear!="all") {
		$whereCondition .= " AND cl.client_intake_year='".$intakeYear."' ";
	}
	if ($uniStatus!="all") {
		$whereCondition .= " AND icp.italy_university_name='".$uniStatus."' ";
	}
	if ($appliedPrograms!="all") {
		if ($appliedPrograms=='All Assign Programs') {
			$whereCondition .= " AND icp.italy_assign_status='1' ";
		}
		elseif ($appliedPrograms=='Total Applied Programs') {
			$whereCondition .= " AND (icp.italy_applied_screenshot!='' || icp.italy_direct_applied_screenshot!='' || icp.italy_pre_applied_screenshot!='') ";
		}elseif($appliedPrograms=='New Assign But Not Applied Programs'){
			$whereCondition .= " AND icp.italy_program_status='0' AND icp.italy_pre_applied_status='0' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' AND icp.italy_cimea_applied_status='0' AND icp.italy_tolc_applied_status='0' ";
		}
		elseif($appliedPrograms=='My Pending Programs Report'){
			$whereCondition .= " AND icp.italy_program_status='1' ";
		}
		elseif($appliedPrograms=='My Pending Report Resolves by Admission Head'){
			$whereCondition .= " AND icp.italy_program_status='2' ";
		}
		elseif($appliedPrograms=='CEnT-S Pass Not Applied Programs'){
			$whereCondition .= "  AND icp.italy_program_status='0' AND icp.italy_applied_status='0' AND icp.italy_direct_applied_status='0' AND icp.italy_tolc_pass_screenshot!='' ";
		}

		if ($appliedPrograms == 'One Time Account Create') {

			$whereCondition .= "AND (
				(icp.italy_university_name IN ( 'CaFoscari University of Venice (FV)', 'University of Padua (PDU)', 'University of Pavia (PV)', 'University of Siena (US)', 'University of Trieste (TR)', 'University of Turin (TU)', 'University of Bergamo (BR)', 'University of Florence (UF)', 'University of Ferrara (FR)' ) AND icp.italy_account_username!='' AND icp.italy_info_screenshot1='' )
				OR
				(icp.italy_university_name IN ( 'Sapienza University of Rome (SPU)', 'Universita Politecnica Delle Marche (MR)', 'University of Bologna (UBN)', 'University of Messina (UM)', 'University of Palermo (PLM)', 'University of Genova (UG)', 'University of Pisa (UP)', 'University of Verona (VN)', 'University of Trento (TRN)', 'University of Tuscia (TS02)', 'University of Laquia (LAQ01)', 'University of Cassino (CS)', 'University of Parma (PRM)', 'Tor Vergata University of Rome (TVR)', 'Bozen-Bolzano (BZB)', 'University of Milan (UML)') AND icp.italy_direct_username!='' AND icp.italy_direct_info_screenshot='' )
				OR
				(icp.italy_university_name IN ( 'University of Campania (UC)', 'University of Napoli Fedrico II (UNP)', 'University of Perugia (UPG)', 'University of Foggia (FG)', 'University of Salerno (SL)' ) AND icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='' )
				OR
				(icp.italy_university_name='University of Milano Biccoca (MLB)' AND icp.italy_tolc_account_username!='' AND icp.italy_tolc_client_info_screenshot='' )
			)";
		}
	}
	if ($checkApplication!="all") {
		if ($checkApplication=='Inform the Head to Recheck the Application By Client') {
			$whereCondition .= " AND ((icp.italy_info_client_status='0' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='0' AND icp.italy_direct_applied_status='5') ) ";
		}elseif($checkApplication=='Applications Sent to the Head for Rechecking By Clients'){
			$whereCondition .= " AND ((icp.italy_info_client_status='1' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='1' AND icp.italy_direct_applied_status='5')) ";
		}elseif($checkApplication=='Client Requests to Head, Changes in the Application'){
			$whereCondition .= " AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='5') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='5') ) ";
		}elseif($checkApplication=='Changes Complete, And Sent to Admission Head'){
			$whereCondition .= " AND ((icp.italy_info_client_status='2' AND icp.italy_applied_status='6') || (icp.italy_direct_info_client_status='2' AND icp.italy_direct_applied_status='6') ) ";
		}
		elseif($checkApplication=='Client Informed, How to Pay the Application Fee By Admission Head'){
			$whereCondition .= " AND ((icp.italy_info_client_status='4' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='4' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5')) ) ";
		}elseif($checkApplication=='Application Approved And Fee Paid by Client, Now Submit the Application'){
			$whereCondition .= " AND ((icp.italy_info_client_status='5' AND (icp.italy_applied_status='5' || icp.italy_applied_status='6')) || (icp.italy_direct_info_client_status='5' AND (icp.italy_direct_applied_status='6' || icp.italy_direct_applied_status='5')) ) ";
		}elseif($checkApplication=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND ((icp.italy_info_client_status='5' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='5' AND icp.italy_direct_applied_status='7') ) ";
		}elseif($checkApplication=='Sent Admission Applied Proof to Client By Admission Head'){
			$whereCondition .= " AND (icp.italy_proof_screenshot1!='' || icp.italy_direct_proof_screenshot!='') ";
		}
		elseif($checkApplication=='Received Request to Fill Bergamo Enrollment Fee Form'){
			$whereCondition .= " AND (icp.italy_info_client_status='10' AND icp.italy_applied_status='10') ";
		}
		elseif($checkApplication=='Inform to Head to Pay Bergamo Enrollment Fee'){
			$whereCondition .= " AND (icp.italy_info_client_status='11' AND icp.italy_applied_status='11') ";
		}
		elseif ($checkApplication=='Waiting for Admission decision') {
			$whereCondition .= " AND ((icp.italy_info_client_status='6' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') ) ";
		}elseif($checkApplication=='Acceptance Letter Received Clients'){
			$whereCondition .= " AND ((icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance') ||( icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') ) ";
		}elseif($checkApplication=='University Admission Rejected Clients'){
			$whereCondition .= " AND ((icp.italy_dream_program1_status='Rejection' || icp.italy_dream_program2_status='Rejection') ||( icp.italy_direct_program1_status='Rejection' || icp.italy_direct_program2_status='Rejection')) ";
		}
		elseif ($checkApplication=='Additional Activities Required by University Clients Assign by Admission Head') {
			$whereCondition .= " AND icp.italy_additional_activities_status='1' ";
		}elseif ($checkApplication=='Additional Activities Required by University Task Complete by Processing Team') {
			$whereCondition .= " AND icp.italy_additional_activities_status='2'";
		}
	}
	
	if ($preProcess!="all") {
		if($preProcess=='Applications Rechecked by Clients and Submit by Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5') AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND (icp.italy_pre_proof_screenshot!='') AND icp.italy_pre_assign_to='0'";
		}
		if ($preProcess=='Waiting for Admission decision') {
			$whereCondition .= " AND (icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='Acceptance and Summary Letter Received Clients'){
			$whereCondition .= " AND (icp.italy_pre_program1_status='Acceptance' || icp.italy_pre_program2_status='Acceptance') AND icp.italy_pre_summary_status='Received' AND icp.italy_pre_assign_to='0'";
		}
		if($preProcess=='University Admission and Summary Rejected Clients'){
			$whereCondition .= " AND (icp.italy_pre_program1_status='Rejection' || icp.italy_pre_program2_status='Rejection') AND icp.italy_pre_summary_status='Rejection' AND icp.italy_pre_assign_to='0'";
		}
	}
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<?php if($clientStatus!='all'){ ?>
				<h5>All Clients >> <?php echo $clientStatus;?></h5>
				<?php }elseif($clientCountry!='all'){ ?>
				<h5>All Clients >> <?php echo $clientCountry;?></h5>
				<?php }elseif($clientDegree!='all'){ ?>
				<h5>All Clients >> <?php echo $clientDegree;?></h5>
				<?php }elseif($intakeYear!='all'){ ?>
				<h5>All Clients >> <?php echo $intakeYear;?></h5>
				<?php }elseif($appliedPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $appliedPrograms;?></h5>
				<?php }elseif($checkApplication!='all'){ ?>
				<h5>All Clients >> <?php echo $checkApplication;?></h5>
				<?php }elseif($preProcess!='all'){ ?>
				<h5>All Clients >> <?php echo $preProcess;?></h5>
				<?php }else{ ?>
				<h5>All Clients</h5>
				<?php } ?>
			</div>
		</div>
	</div>
	<!-- data table -->
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 200px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 120px;">Status</th>
					<th style="width: 100px;">Action</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sr = $totalRecords - $offset;
				foreach ($clientData_ex as $row) {
					$clientID = $row['client_id'];
					$changingApplied = $row['client_applied'];
					$appliedChanging = json_decode($changingApplied, true);
					$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				?>
				<tr id="<?php echo $row['client_id']; ?>">
					<td><?php echo $sr;?></td>
					<td>
						<?php include ("../components/IDDateTd.php");?>
					</td>
					<td>
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
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/AdmissionStatus.php");?>
					</td>
					<td>
						<a href="admission-documents?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Document </button></a>
					</td>
					<td>
						<?php include ("../components/ViewActionTd.php");?>
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