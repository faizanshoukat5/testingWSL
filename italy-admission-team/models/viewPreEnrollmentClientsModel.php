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
	$preAcceptProcess = $_POST['checkpreAcceptProcess'];
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

	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_pre_assign_to='".$_SESSION['user_id']."' ";

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
			$whereCondition .= " AND icp.italy_pre_assign_to!='0' ";
		}
		if ($appliedPrograms=='Total Applied Programs') {
			$whereCondition .= " AND (icp.italy_pre_applied_screenshot!='') ";
		}
		if($appliedPrograms=='My Pending Programs Report'){
			$whereCondition .= " AND icp.italy_program_status='1' ";
		}
		if($appliedPrograms=='My Pending Report Resolves by Admission Head'){
			$whereCondition .= " AND icp.italy_program_status='2' ";
		}
		if ($appliedPrograms == 'One Time Account Create') {

			$whereCondition .= "AND (icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='')";
		}
	}
	// Self and WSL Acceptance Pre Enrollment Status
	if ($preAcceptProcess!="all") {
		if($preAcceptProcess=='New Pre Enrollment Application Received'){
			$whereCondition .= " AND icp.italy_pre_assign_to!='0' AND icp.italy_pre_applied_status='0' ";
		}
		if($preAcceptProcess=='Applications Rechecked by Clients and Submit by Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='5') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Admission Application Submitted by Processing Team'){
			$whereCondition .= " AND (icp.italy_pre_info_client_status='0' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Sent Admission Applied Proof to Client'){
			$whereCondition .= " AND (icp.italy_pre_proof_screenshot!='') AND icp.italy_pre_assign_to!='0' ";
		}
		if ($preAcceptProcess=='Waiting for Admission decision') {
			$whereCondition .= " AND (icp.italy_pre_info_client_status='1' AND icp.italy_pre_applied_status='6') AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Summary Letter Received Clients'){
			$whereCondition .= " AND (icp.italy_pre_program1_status='Acceptance') AND icp.italy_pre_summary_status='Received' AND icp.italy_pre_assign_to!='0' ";
		}
		if($preAcceptProcess=='Summary Letter Rejected Clients'){
			$whereCondition .= " AND (icp.italy_pre_program1_status='Rejection') AND icp.italy_pre_summary_status='Rejection' AND icp.italy_pre_assign_to!='0' ";
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
				<?php }elseif($appliedPrograms!='all'){ ?>
				<h5>All Clients >> <?php echo $appliedPrograms;?></h5>
				<?php }elseif($preAcceptProcess!='all'){ ?>
				<h5>All Clients >> <?php echo $preAcceptProcess;?></h5>
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
					<th style="width: 220px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 100px;">Admission Status</th>
					<th style="width: 100px;">Document</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// $sr = mysqli_num_rows($clientData_ex);
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
					<td>
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td class="breakTD">
					<?php
					$query = "SELECT COUNT(italy_pre_info_client_status) AS totalAssign, SUM(CASE WHEN italy_pre_info_client_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_pre_assign_to='".$_SESSION['user_id']."' AND italy_clients_id = '".$clientID."' ";
					$result = mysqli_query($con, $query);
					if ($result) {
						$data = mysqli_fetch_array($result);
						$totalNo = $data['totalAssign'];
						$assignedNo = $data['assignedNo'];
						if($totalNo == $assignedNo){
							echo '<a href="apply-programs?client-id='.$clientID.'&'.$getUrl.'&preEnroll=preClient "><button type="button" class="btn btn-success btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Check Applied This Client Program"><i class="mdi mdi-check-circle"></i> Applied <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$assignedNo.' / '.$totalNo.'</span></button> </a>';
						}
						else{
							echo '<a href="apply-programs?client-id='.$clientID.'&'.$getUrl.'&preEnroll=preClient "><button type="button" class="btn btn-outline-primary btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Apply This Client Program"><i class="mdi mdi-clipboard-text-outline"></i> Apply <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$assignedNo.' / '.$totalNo.'</span></button> </a>';
						}
					}
					?>
					
					<?php
					$query="SELECT italy_pre_applied_status FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_pre_assign_to='".$_SESSION['user_id']."' AND italy_clients_id='".$clientID."' ";
					$result_ex = mysqli_query($con, $query);
					foreach ($result_ex as $italPro) {
						if ($italPro['italy_pre_applied_status']=='0'){ ?>
							<br>
							<span data-toggle="tooltip" data-placement="top" title="New Programs Assign" class="badge bg-dark" id="blink">New</span>
						<?php }
					}
					?>
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