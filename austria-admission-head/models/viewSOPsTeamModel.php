<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkconvertStatus'])) {
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$clientDegree = $_POST['checkclientDegree'];
	$startDate = $_POST['checkstartDate'];
	$endDate = $_POST['checkendDate'];
	$wtID = $_POST['checkwtID'];

	if ($clientDegree=='master') {
		$degInfo = '["master"]';
	}elseif ($clientDegree=='bachelor') {
		$degInfo = '["bachelor"]';
	}elseif ($clientDegree=='phd') {
		$degInfo = '["phd"]';
	}
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria' AND acp.aus_sops_assign_to='".$wtID."'";

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
			$whereCondition .= " AND cl.client_countryfrom!='Pakistan' AND cl.client_countryfrom!='UAE' AND cl.client_countryfrom!='Saudi Arabia' AND cl.client_countryfrom!='saudi arabia' AND cl.client_countryfrom!='saudi Arabia' AND cl.client_countryfrom!='Qatar'";
		}
	}
	if ($clientDegree!="all") {
		$whereCondition .= " AND (cl.client_applied='$degInfo') ";
	}
	if ($startDate!="" && $endDate!="" ) {
		$whereCondition .= " AND acp.aus_program_assign_date BETWEEN '".$startDate."' AND '".$endDate."'  ";
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
					<th style="width: 180px;">SOP's</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex) ) {
				$clientID = $row['client_id'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);

				// SUM of adv payment from the client payments
				$payClient = "SELECT SUM(pay_receive_amount), SUM(pay_online_amount) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id = '$clientID'";
				$payClient_ex = mysqli_query($con, $payClient);
				$payrow = mysqli_fetch_assoc($payClient_ex);
				$sumReceived = $payrow['SUM(pay_receive_amount)'] + $payrow['SUM(pay_online_amount)'];

				// fetch last balance amount and date from the clients_payments
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
						<!-- <span data-toggle="tooltip" data-placement="top" title="<?php echo $embassyTooltips[$row['client_embassy']];?>"> <i><?php echo ucwords($row['client_embassy']); ?></i> </span> -->
					</td>
					<td>
					<?php 
					$currency = ($row['client_countryfrom'] == 'Pakistan') ? 'PKR' : 'AED';
					$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy' || $row['client_country']=='czech republic') ? 'Payable After Admission Confirmation' : '');

					$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy' || $row['client_country']=='czech republic') ? 'Payable on Visa Approval' : '');

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
					<td>
					<?php
					$query = "SELECT COUNT(aus_sops_status) AS totalAssign, SUM(CASE WHEN (aus_sops_status='1' || aus_sops_status='2' || aus_sops_status='3' || aus_sops_status='4') THEN 1 ELSE 0 END) AS assignedNo FROM austria_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND aus_clients_id='".$clientID."' AND aus_sops_assign_to='".$wtID."' ";
					$result = mysqli_query($con, $query);
					if ($result) {
						$data = mysqli_fetch_array($result);
						$totalNo = $data['totalAssign'];
						$assignedNo = $data['assignedNo'];
						if($totalNo == $assignedNo){
							echo '<a href="#"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Check SOPs of Program"><i class="mdi mdi-check-cricle"></i> SOPs </button> </a>';
						}
						else{
							echo '<a href="#"><button type="button" class="btn btn-outline-info btn-sm position-relative" data-toggle="tooltip" data-placement="top" title="Check SOPs of Program"><i class="mdi mdi-fax"></i> SOPs <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">'.$assignedNo.' / '.$totalNo.'</span></button> </a>';
						}
					}
					?>
					</td>
					<td>
						<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Track this Client" onclick="ViewClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-eye"></i></button> 
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
	<div class="row mt-2">
		<div class="col-md-5">
			<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
				<?php
				$start = $offset + 1;
				$end = min($offset + $limit, $totalRecords);
				echo "Showing $start to $end of $totalRecords entries";
				?>
			</div>
		</div>
		<div class="col-md-7">
			<ul class="pagination float-right">
				<?php
				// Previous button
				if ($page > 1) {
					echo '<li style="cursor: pointer;" class="paginate_button page-item previous" onclick="viewClientsFilter('.($page - 1).');"><span class="page-link">Previous</span></li>';
				} else {
					echo '<li class="paginate_button page-item previous disabled"><span class="page-link">Previous</span></li>';
				}
				// Maximum number of pages around the current page
				$range = 1;
				// Always display the first and last few pages
				$startRange = max(4, $page - $range); 
				$endRange = min($totalPages - 3, $page + $range);
				// Show first three pages
				$i=1;
				for ($i = 1; $i <= 3; $i++) {
					if ($i > $totalPages) break;
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis before the middle range
				if ($startRange > 4) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Pages around the current page
				for ($i = $startRange; $i <= $endRange; $i++) {
					if ($i > $totalPages || $i < 4) continue;
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis after the middle range
				if ($endRange < $totalPages - 3) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Show last three pages
				for ($i = max($totalPages - 2, 4); $i <= $totalPages; $i++) {
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Next button
				if ($page < $totalPages) {
					echo '<li style="cursor: pointer;" class="paginate_button page-item next" onclick="viewClientsFilter('.($page + 1).');"><span class="page-link">Next</span></li>';
				} else {
					echo '<li class="paginate_button page-item next disabled"><span class="page-link">Next</span></li>';
				}
				?>
			</ul>
		</div>
	</div>

<?php
}
?>