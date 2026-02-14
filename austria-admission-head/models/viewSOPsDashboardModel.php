<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkwtID'])) {
	$userId = $_POST['checkwtID'];
	$country = 'austria';

	$select = "SELECT * FROM clients".$_SESSION['dbNo']." AS cl JOIN austria_clients_programs".$_SESSION['dbNo']." AS acp ON cl.client_id = acp.aus_clients_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='$country' AND acp.aus_sops_assign_to='$userId' GROUP BY cl.client_id ORDER BY client_id DESC";
	$select_ex = mysqli_query($con, $select);
	$countTotalCzech = mysqli_num_rows($select_ex);
	$countBachelorCzech='0';
	$countMasterCzech='0';
	// Get counts for bachelor and master clients within the same query
	while ($row = mysqli_fetch_assoc($select_ex)) {
		$changingApplied = $row['client_applied'];
		$appliedChanging = json_decode($changingApplied, true);
		foreach ($appliedChanging as $appRow) {
			if ($appRow == 'bachelor') {
				$countBachelorCzech++;
			} elseif ($appRow == 'master') {
				$countMasterCzech++;
			}
		}
	}

	$select = "SELECT * FROM clients".$_SESSION['dbNo']." AS cl JOIN austria_clients_programs".$_SESSION['dbNo']." AS acp ON cl.client_id=acp.aus_clients_id  WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='$country' AND acp.aus_sops_assign_to='$userId' ORDER BY client_id DESC";
	$select_ex = mysqli_query($con, $select);
	$countTotalSOPAssign = mysqli_num_rows($select_ex);

	$select = "SELECT * FROM clients".$_SESSION['dbNo']." AS cl JOIN austria_clients_programs".$_SESSION['dbNo']." AS acp ON cl.client_id=acp.aus_clients_id  WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='$country' AND acp.aus_sops_assign_to='$userId' AND (acp.aus_sops_status='1' || acp.aus_sops_status='2' || acp.aus_sops_status='3' || acp.aus_sops_status='4') ORDER BY client_id DESC";
	$select_ex = mysqli_query($con, $select);
	$countTotalSOPWritten = mysqli_num_rows($select_ex);

	$select = "SELECT * FROM clients".$_SESSION['dbNo']." AS cl JOIN austria_clients_programs".$_SESSION['dbNo']." AS acp ON cl.client_id=acp.aus_clients_id  WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='$country' AND acp.aus_sops_assign_to='$userId' AND acp.aus_sops_status='0' ORDER BY client_id DESC";
	$select_ex = mysqli_query($con, $select);
	$countTotalSOPNotWritten = mysqli_num_rows($select_ex);
	?>
<div class="row mt-2">
	<div class="col-xl-4 col-sm-6" >
		<div class="card-box widget-box-two widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple-outline avatar-title font-30 text-white"></i>
				</div>
				<div class="wigdet-two-content media-body">
					<a href="#">
						<p class="m-0 font-weight-medium text-truncate text-white" title="Statistics">Total Czech Republic Clients</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countTotalCzech); ?></span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-box-two widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-multiple avatar-title font-30 text-white"></i>
				</div>
				<div class="wigdet-two-content media-body">
					<a href="#">
						<p class="m-0 font-weight-medium text-truncate text-white" title="Statistics">Bachelor in Czech Republic</p>
						<h3 class="font-weight-medium my-2 text-white"> <span data-plugin="counterup"><?php echo number_format($countBachelorCzech) ?></span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-4 col-sm-6">
		<div class="card-box widget-box-two widget-two-custom" style="background: linear-gradient(180deg, #000428, #004e92);">
			<div class="media">
				<div class="avatar-lg rounded-circle bg-white-1 widget-two-icon align-self-center">
					<i class="mdi mdi-account-star-outline avatar-title font-30 text-white"></i>
				</div>
				<div class="wigdet-two-content media-body">
					<a href="#">
						<p class="m-0 font-weight-medium text-truncate text-white" title="Statistics">Master in Czech Republic</p>
						<h3 class="font-weight-medium my-2 text-white"><span data-plugin="counterup"><?php echo number_format($countMasterCzech) ?></span></h3>
						<p class="m-0 text-white">Total</p>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-6">
		<div class="card radius-10 bg-tiffany" style="background-image: radial-gradient(circle at 52% 33%, rgba(17, 17, 17,0.08) 0%, rgba(17, 17, 17,0.08) 33.333%,rgba(74, 74, 74,0.08) 33.333%, rgba(74, 74, 74,0.08) 66.666%,rgba(130, 130, 130,0.08) 66.666%, rgba(130, 130, 130,0.08) 99.999%),radial-gradient(circle at 70% 65%, rgba(129, 129, 129,0.08) 0%, rgba(129, 129, 129,0.08) 33.333%,rgba(95, 95, 95,0.08) 33.333%, rgba(95, 95, 95,0.08) 66.666%,rgba(60, 60, 60,0.08) 66.666%, rgba(60, 60, 60,0.08) 99.999%),radial-gradient(circle at 97% 89%, rgba(21, 21, 21,0.08) 0%, rgba(21, 21, 21,0.08) 33.333%,rgba(89, 89, 89,0.08) 33.333%, rgba(89, 89, 89,0.08) 66.666%,rgba(156, 156, 156,0.08) 66.666%, rgba(156, 156, 156,0.08) 99.999%),linear-gradient(0deg, rgb(17, 9, 206),rgb(65, 75, 237));">
			<div class="card-body text-center">
				<a href="#">
					<div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
					<i class="mdi mdi-file-document-outline"></i>
					</div>
					<h3 class="text-white counter-value"><?php echo $countTotalSOPAssign;?></h3>
					<p class="mb-0 text-white">Total Assign SOP's</p>
				</a>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-6">
		<div class="card radius-10 bg-dark" style="background-image: radial-gradient(circle at 16% 83%, rgba(148, 148, 148,0.06) 0%, rgba(148, 148, 148,0.06) 50%,rgba(63, 63, 63,0.06) 50%, rgba(63, 63, 63,0.06) 100%),radial-gradient(circle at 68% 87%, rgba(66, 66, 66,0.06) 0%, rgba(66, 66, 66,0.06) 50%,rgba(105, 105, 105,0.06) 50%, rgba(105, 105, 105,0.06) 100%),radial-gradient(circle at 38% 50%, rgba(123, 123, 123,0.06) 0%, rgba(123, 123, 123,0.06) 50%,rgba(172, 172, 172,0.06) 50%, rgba(172, 172, 172,0.06) 100%),linear-gradient(90deg, hsl(18,0%,1%),hsl(18,0%,1%));">
			<div class="card-body text-center">
				<a href="#">
					<div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
						<i class="mdi mdi-file-outline"></i>
					</div>
					<h3 class="text-white counter-value"><?php echo $countTotalSOPWritten; ?></h3>
					<p class="mb-0 text-white">Total SOP's Written</p>
				</a>
			</div>
		</div>	
	</div>
	<div class="col-lg-4 col-md-6">
		<div class="card radius-10 bg-purple" style="background-image: radial-gradient(circle at 19% 90%, rgba(190, 190, 190,0.04) 0%, rgba(190, 190, 190,0.04) 17%,transparent 17%, transparent 100%),radial-gradient(circle at 73% 2%, rgba(78, 78, 78,0.04) 0%, rgba(78, 78, 78,0.04) 94%,transparent 94%, transparent 100%),radial-gradient(circle at 45% 2%, rgba(18, 18, 18,0.04) 0%, rgba(18, 18, 18,0.04) 55%,transparent 55%, transparent 100%),radial-gradient(circle at 76% 60%, rgba(110, 110, 110,0.04) 0%, rgba(110, 110, 110,0.04) 34%,transparent 34%, transparent 100%),radial-gradient(circle at 68% 56%, rgba(246, 246, 246,0.04) 0%, rgba(246, 246, 246,0.04) 16%,transparent 16%, transparent 100%),radial-gradient(circle at 71% 42%, rgba(156, 156, 156,0.04) 0%, rgba(156, 156, 156,0.04) 47%,transparent 47%, transparent 100%),radial-gradient(circle at 46% 82%, rgba(247, 247, 247,0.04) 0%, rgba(247, 247, 247,0.04) 39%,transparent 39%, transparent 100%),radial-gradient(circle at 50% 47%, rgba(209, 209, 209,0.04) 0%, rgba(209, 209, 209,0.04) 45%,transparent 45%, transparent 100%),linear-gradient(90deg, rgb(84, 36, 210),rgb(44, 27, 154));">
			<div class="card-body text-center">
				<a href="#">
					<div class="widget-icon mx-auto mb-3 bg-white-1 text-white">
						<i class="mdi mdi-file"></i>
					</div>
					<h3 class="text-white counter-value"><?php echo $countTotalSOPNotWritten; ?></h3>
					<p class="mb-0 text-white">Total SOP's Not Written</p>
				</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
</div>
<?php
}
?>