<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkuniName'])) {
	include ("../components/UniFilter/UniFiltersPost.php");
	$whereCondition = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_university_name='".$uniName."' AND acp.aus_client_degree='".$clientDegree."'";

	include ("../components/UniFilter/UniFiltersData.php");
	include ("../components/AllQueries.php");
	?>
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
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);
				include ("../components/PIAQueries.php");

				if($row['aus_program_assign']!='0' && $row['aus_direct_applied_status']=='7'){
					$style = 'alert-success text-dark';
				}elseif($row['aus_program_assign']!='0' && $row['aus_direct_applied_status']!='7'){
					$style = 'alert-warning text-dark';
				}else{
					$style = '';
				}
				?>
				<tr id="<?php echo $row['client_id'];?>" class="<?php echo $style;?>">
					<td><?php echo $sr; ?></td>
					<td><?php include ("../components/IDDateTd.php"); ?></td>
					<td class="breakTD">
						<?php include ("../components/ClientInfoTd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td>
						<?php include ("../components/PIATd.php");?>
					</td>
					<?php
					$getUrl = base64_encode($row['client_name']."".$row['client_email']);
					?>
					<td class="breakTD">
						<button type="button" class="btn <?= $row['aus_document_collection_note']!='' ? 'btn-success' : 'btn-outline-dark'?> btn-sm" data-toggle="tooltip" data-placement="top" title="Note form Document Collection To Admission Head for University Process" onclick="addNoteAdmissionhead(<?php echo $row['aus_client_pro_id'];?>);"><i class="mdi mdi-alpha-d-circle"></i> </button>
						<?php if ($sumBalance=='0') { ?>
							<?php
							$query = "SELECT COUNT(aus_assign_status) AS totalAssign,SUM(CASE WHEN aus_assign_status= '1' THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' AND aus_university_name='".$uniName."' ";
							$result = mysqli_query($con, $query);
							$data = mysqli_fetch_array($result);
							$totalNo = $data['totalAssign'];
							$assignedNo = $data['assignedNo'];
							if($totalNo == $assignedNo){
							?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i>A.Pro.</button> </a>
							<?php 
							}elseif($assignedNo > 0 ){ ?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span> A.Pro.</button> </a>
							<?php
							}else{
							?>
							<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
								
							<?php
							}
						?>
						<?php }else{ ?> 
							<a href="assign-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> disabled class="btn btn-outline-dark btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Assign Program to Team"><i class="mdi mdi-alpha-p-box"></i> <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-info" id="blink">New</span> A.Pro.</button> </a>
						<?php }?>
						<?php
							$statusClass = match($row['aus_program_status']) {
								'1' => 'btn-warning',
								'2' => 'btn-success',
								default => 'btn-outline-primary',
							};
							?>
							<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Processing Team Report" onclick="addProgramNote(<?php echo $row['aus_client_pro_id'];?>);"> <i class="mdi mdi-alpha-p-circle"></i> </button>
						<?php 
						if($row['aus_program_assign']!=0){ ?> <br> <?php
							$query="SELECT fname, lname FROM wt_users WHERE close='1' AND status='1' AND wt_id='".$row['aus_program_assign']."' ";
							$result_ex = mysqli_query($con, $query);
							while ($wtRow = mysqli_fetch_assoc($result_ex)) { ?>
								<span class="badge bg-purple pt-1 pb-1 mt-1"><?php echo ucwords($wtRow['fname']." ".$wtRow['lname']);?></span>
							<?php
							}
						}
						?>
						<br>
						<?php
							$query="SELECT COUNT(aus_direct_applied_status) AS totalAssign, SUM(CASE WHEN aus_direct_applied_status='6' THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' AND aus_university_name='".$uniName."' ";
							$result = mysqli_query($con, $query);
							$data = mysqli_fetch_array($result);
							$totalNo = $data['totalAssign'];
							$assignedNo = $data['assignedNo'];
							if($totalNo == $assignedNo){ ?>
								<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>&application-status=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-success btn-sm mt-2" style="width: 84%;" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-check-circle"></i> Apply Status </button> </a>
							<?php
							}else{ ?>
								<a href="apply-programs?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>&university-name=<?php echo $uniName;?>&application-status=all"><button type="button" <?php echo $row['client_process_status']=='Direct Visa' ? 'disabled' : ''; ?> class="btn btn-outline-primary btn-sm mt-2 position-relative" style="width: 84%;" data-toggle="tooltip" data-placement="top" title="Apply Programs"><i class="mdi mdi-clipboard-text-outline"></i> Apply Status <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?php echo $assignedNo.' / '.$totalNo;?></span></button> </a>
							<?php
							}
						?>
						<br>
						<?php
						$query="SELECT aus_direct_applied_status, aus_program_assign_date FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_change_program_status='0' AND aus_clients_id='".$clientID."' AND aus_university_name='".$uniName."' AND aus_client_degree='bachelor' ";
						$result_ex = mysqli_query($con, $query);
						foreach ($result_ex as $italPro) {
							$assignDate = $italPro['aus_program_assign_date'];

							if ($assignDate!='0000-00-00') {
								$date2 = date('Y-m-d');
								$timestamp_assignDate = strtotime($assignDate);
								$timestamp_date2 = strtotime($date2);
								$seconds_diff = $timestamp_date2 - $timestamp_assignDate;
								$daysAssign_diff = floor($seconds_diff / (60 * 60 * 24));
								
								if ($daysAssign_diff >= 1 && ($italPro['aus_direct_applied_status']=='0' && $italPro['aus_direct_applied_status']=='0')) { ?>
									<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="After a day Team member not Apply" id="blink">Not Apply</span>
								<?php }
							}
						}
						?>
					</td>
					<td>
						<?php include ("../components/VisaStatusTd.php");?>
					</td>
					<td>
						<?php include ("../components/ViewActionTd.php");?>
					</td>
				</tr>
			<?php
			$sr--;
			}?>
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