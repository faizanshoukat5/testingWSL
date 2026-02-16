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
	$checkApplication = $_POST['checkcheckApplication'];
	$enrollStatus = $_POST['checkenrollStatus'];
	$uniName = $_POST['checkuniName'];

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

	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND (icp.italy_direct_pre='1' || icp.italy_direct_pre='2') AND icp.italy_university_name='".$uniName."' ";

	if ($clientStatus!="all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."' ";
	}
	if ($clientCountry != "all") {
		if($clientCountry=='Pakistan' || $clientCountry=='UAE' || $clientCountry=='Qatar'){
			$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."'";
		}
		if($clientCountry=='Saudi Arabia'){
			$whereCondition .= " AND (cl.client_countryfrom='Saudi Arabia' || cl.client_countryfrom='saudi Arabia' || cl.client_countryfrom='saudi arabia') ";
		}
		if($clientCountry=='Other Country'){
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE' AND cl.client_countryfrom!='Saudi Arabia' AND cl.client_countryfrom!='saudi arabia' AND cl.client_countryfrom!='saudi Arabia' AND cl.client_countryfrom!='Qatar' AND cl.client_countryfrom NOT LIKE '%".$clientCountry."%' ";
		}
		if($clientCountry=='Oman' ){
			$whereCondition .= " AND cl.client_countryfrom LIKE '%".$clientCountry."%' ";
		}
	}
	if ($clientDegree!="all") {
		$whereCondition .= "AND (cl.client_applied='$degInfo' OR cl.client_applied='$degbachMBBS') ";
	}
	if ($intakeYear!="all" ) {
		$whereCondition .= " AND cl.client_intake_year='".$intakeYear."' ";
	}
	if ($checkApplication!="all" ) {
		if($checkApplication=='Assign But Not Applied'){
			$whereCondition .= " AND cl.client_id IN (SELECT DISTINCT icp.italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE (icp.italy_dream_id='1' OR icp.italy_direct_apply='1') AND (icp.italy_proof_screenshot1='' OR icp.italy_direct_proof_screenshot='') AND icp.italy_assign_status='1')";
		}
		if ($checkApplication=='Waiting for Admission decision') {
			$whereCondition .= " AND cl.client_id IN (SELECT DISTINCT icp.italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE (icp.italy_dream_id='1' OR icp.italy_direct_apply='1') AND ((icp.italy_info_client_status='6' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') ) AND icp.italy_assign_status='1')";
		}
		if($checkApplication=='Acceptance Letter Received Clients'){
			$whereCondition .= " AND cl.client_id IN (SELECT DISTINCT icp.italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE (icp.italy_dream_id='1' OR icp.italy_direct_apply='1') AND ((icp.italy_dream_program1_status='Acceptance' || icp.italy_dream_program2_status='Acceptance') || ( icp.italy_direct_program1_status='Acceptance' || icp.italy_direct_program2_status='Acceptance') ) AND icp.italy_assign_status='1' ) ";
		}
		if($checkApplication=='University Admission Rejected Clients'){
			$whereCondition .= " AND cl.client_id IN (SELECT DISTINCT icp.italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE (icp.italy_dream_id='1' OR icp.italy_direct_apply='1') AND ((icp.italy_dream_program1_status='Rejection' || icp.italy_dream_program2_status='Rejection') ||( icp.italy_direct_program1_status='Rejection' || icp.italy_direct_program2_status='Rejection') ) AND icp.italy_assign_status='1' )";
		}
	}
	if ($enrollStatus!="all") {
		if($enrollStatus=='Proof Upload but Not Assign'){
			$whereCondition .= " AND cl.client_id IN (SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' GROUP BY italy_clients_id HAVING SUM(italy_send_to_pre_proof!='') > 0 AND SUM(italy_pre_program_name='') > 0 AND SUM(italy_pre_program_name!='') = 0 ) ";
		}
		if($enrollStatus=='All Not Assign'){
			$whereCondition .= "AND cl.client_id IN (SELECT italy_clients_id FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' GROUP BY italy_clients_id HAVING SUM(italy_pre_program_name='') > 0 AND SUM(italy_pre_program_name!='')= 0)";

		}
		if($enrollStatus=='Assign But Not Applied'){
			$whereCondition .= "AND icp.italy_pre_program_name!='' AND icp.italy_pre_proof_screenshot='' ";
		}
		if($enrollStatus=='Assign and Applied'){
			$whereCondition .= "AND icp.italy_pre_program_name!='' AND icp.italy_pre_proof_screenshot!='' ";
		}
		if($enrollStatus=='One Time Account Create'){
			$whereCondition .= "AND icp.italy_pre_program_name!='' AND icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot=''";
		}
	}
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 220px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 120px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 180px;">Admission Status</th>
					<th style="width: 150px;">Visa Status</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
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
							echo "<b class='text-info'>Italy Old Client 2024</b>";
						}elseif($row['client_convert_status']=='Austria Converted Client'){
							echo "<b class='text-warning'>Austria Converted Client</b>";
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
						$query="SELECT italy_pre_username, italy_pre_proof_screenshot FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_pre_program_name!='' AND italy_clients_id='".$clientID."' ";
						$result = mysqli_query($con, $query);
						$rowPre = mysqli_fetch_array($result);
						$preUserName = '';
						$preProof = '';
						$bgClass = 'bg-secondary';
						if ($rowPre) {
							$preUserName = $rowPre['italy_pre_username'];
							$preProof = $rowPre['italy_pre_proof_screenshot'];

							if ($preUserName!='' && $preProof=='') {
								$bgClass = 'bg-warning';
							}elseif ($preUserName!='' && $preProof!='') {
								$bgClass = 'bg-success';
							}
						}
						?>
						<span class="badge <?php echo $bgClass;?> p-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Status">Pre Enrollment Status</span>
						<br>
						<?php
							$query="SELECT COUNT(italy_info_client_status) AS totalAssign, SUM(CASE WHEN italy_info_client_status='12' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_clients_id='".$clientID."' ";
							$result = mysqli_query($con, $query);
							$data = mysqli_fetch_array($result);
							$totalNo = $data['totalAssign'];
							$assignedNo = $data['assignedNo'];
							if($totalNo == $assignedNo){ ?>
								<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=all"><button <?= $sumBalance=='0' ? '' : 'disabled';?> type="button" class="btn btn-success btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
							<?php
							}
							else{ ?>
								<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=all&application-status=all"><button <?= $sumBalance=='0' ? '' : 'disabled';?> type="button" class="btn btn-outline-primary btn-sm mt-2 position-relative" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
							<?php
							}
						?>
					</td>
					<td>
						<?php include ("../components/VisaStepsTd.php");?>
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