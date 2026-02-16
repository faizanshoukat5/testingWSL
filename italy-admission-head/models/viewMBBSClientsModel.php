<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkuniName'])) {
	// include post file uniFilter folder
	include ("../components/UniFilter/UniFiltersPost.php");

	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_deadline_hold_status!='1' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year!='27-28' AND (cl.client_applied='$degInfo' OR cl.client_applied='$degbachMBBS' OR cl.client_applied='$degbachmaster') AND icp.italy_university_name='".$uniName."'";

	
	if ($assignPrograms!="all") {
		if ($assignPrograms=='All Assign Programs') {
			$whereCondition .= " AND icp.italy_assign_status='1' AND icp.italy_pre_assign_to!='0' ";
		}
		if ($assignPrograms=='All Not Assign Programs') {
			$whereCondition .= "AND (cl.client_self_acceptance_file='') AND cl.client_process_status!='Direct Visa' AND icp.italy_assign_status='0' AND icp.italy_pre_assign_to='0' ";
		}
		elseif ($assignPrograms=='Assign But Not Applied') {
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$proofScreen = "icp.italy_proof_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$proofScreen = "icp.italy_direct_proof_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$proofScreen = "icp.italy_pre_proof_screenshot='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $proofScreen ";
		}
		elseif ($assignPrograms=='Assign But Not Approved') {
			// Assign But Not Applied
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$proofScreen = "icp.italy_ok_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$proofScreen = "icp.italy_direct_ok_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$proofScreen = "icp.italy_pre_ok_screenshot='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $proofScreen ";
		}

		elseif ($assignPrograms=='Assign and Applied') {
			// Assign and Applied
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$proofAppliedScreen = "icp.italy_proof_screenshot1!='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$proofAppliedScreen = "icp.italy_direct_proof_screenshot!='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$proofAppliedScreen = "icp.italy_pre_proof_screenshot!='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $proofAppliedScreen ";
		}
		elseif ($assignPrograms=='Assign but Not Paid Fee') {
			// Assign but Not Paid Fee
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$notFeeScreen = "icp.italy_fee_paid_client='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$notFeeScreen = "icp.italy_direct_fee_paid_client='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$notFeeScreen = "icp.italy_pre_fee_paid_client='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $notFeeScreen ";
		}
		elseif ($assignPrograms=='Fee Paid but Not Applied') {
			// Assign but Not Paid Fee
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$paidFeeScreen = "icp.italy_fee_paid_client!='' AND icp.italy_proof_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$paidFeeScreen = "icp.italy_direct_fee_paid_client!='' AND icp.italy_direct_proof_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$paidFeeScreen = "icp.italy_pre_fee_paid_client!='' AND icp.italy_pre_proof_screenshot='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $paidFeeScreen ";
		}
		elseif ($assignPrograms=='Fee Paid but Not Approved') {
			// Assign but Not Paid Fee
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' ){
				$paidFeeScreen = "icp.italy_fee_paid_client!='' AND icp.italy_ok_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)'){
				$paidFeeScreen = "icp.italy_direct_fee_paid_client!='' AND icp.italy_direct_ok_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Siena (US)' || $uniName=='University of Turin (TU)'){
				$paidFeeScreen = "icp.italy_pre_fee_paid_client!='' AND icp.italy_pre_ok_screenshot='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $paidFeeScreen ";
		}
		elseif ($assignPrograms=='One Time Account Create') {
			// One Time Account Create
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Turin (TU)' || $uniName=='University of Bergamo (BR)' || $uniName=='University of Florence (UF)' || $uniName=='University of Ferrara (FR)'){
				$assign = "icp.italy_account_username!='' AND icp.italy_info_screenshot1='' AND italy_pro_step2='1' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Genova (UG)' || $uniName=='University of Pisa (UP)' || $uniName=='University of Verona (VN)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Tuscia (TS)' || $uniName=='University of Laquia (LAQ01)' ){
				$assign = "icp.italy_direct_username!='' AND icp.italy_direct_info_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Foggia (FG)' || $uniName=='University of Salerno (SL)'){
				$assign = "icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='' ";
			}
			$whereCondition .= " AND icp.italy_assign_status='1' AND $assign ";
		}
	}

	if ($sopStatus!="all") {
		if ($sopStatus=='Sops Assign Clients') {
			$whereCondition .= " AND (icp.italy_sops_assign_to!='0' || icp.italy_sops_status='4') ";

		}
		if ($sopStatus=='SOPs Not Assign Clients') {
			$whereCondition .= " AND cl.client_process_status!='Direct Visa' AND icp.italy_sops_assign_to='0' AND icp.italy_sops_status !='4' AND icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND icp.italy_change_program_status='0' AND EXISTS (SELECT 1 FROM italy_add_programs_details{$_SESSION['dbNo']} AS iapd WHERE iapd.status='1' AND iapd.close='1' AND iapd.italy_ad_sop_required='1' AND iapd.italy_ad_uni_name=icp.italy_university_name AND iapd.italy_ad_degree=icp.italy_client_degree AND JSON_CONTAINS(icp.italy_program_name, JSON_QUOTE(iapd.italy_ad_program_name))) ";
		}
		if ($sopStatus=='SOPs Received Clients') {
			$whereCondition .= " AND icp.italy_sops_status='4' ";
		}
	}
	// remaining common filter code in file Data
	include ("../components/UniFilter/UniFiltersData.php");
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
					<th style="width: 220px;">Admission Status</th>
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
				$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				?>
				<?php include ("../components/PIAQueries.php");?>
				<?php
				if($row['italy_program_assign']!='0' && (($row['italy_info_client_status']=='6' && $row['italy_applied_status']=='7') || ($row['italy_direct_info_client_status']=='6' && $row['italy_direct_applied_status']=='7') || ($row['italy_pre_info_client_status']=='6' && $row['italy_pre_applied_status']=='7') )){
					$style = 'alert-success text-dark';
				}elseif($row['italy_program_assign']!='0' && (($row['italy_info_client_status']!='6' && $row['italy_applied_status']!='7') || ($row['italy_direct_info_client_status']!='6' && $row['italy_direct_applied_status']!='7') || ($row['italy_pre_info_client_status']!='6' && $row['italy_pre_applied_status']!='7') ) ){
					$style = 'alert-warning text-dark';
				}else{
					$style = '';
				}
				?>

				<tr id="<?php echo $row['client_id'];?>">
					<td class="<?php echo $style;?>"><?php echo $sr;?></td>
					<td class="<?php echo $style;?>">
						<?php include ("../components/IDDateTd.php");?>
					</td>
					<td class="breakTD <?php echo $style;?>">
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
					<td class="breakTD <?php echo $style;?>">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td class="<?php echo $style;?>">
						<?php include ("../components/PIATd.php");?>
					</td>
					<td class="breakTD <?php echo $style;?>">
						<?php include ("../components/UniFilter/AdmissionStatusTd.php"); ?>
					</td>
					<td class="<?php echo $style;?>">
						<?php include ("../components/VisaStepsTd.php");?>
					</td>
					<td class="<?php echo $style;?>">
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