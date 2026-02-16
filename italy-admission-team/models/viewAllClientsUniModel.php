<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkuniName'])) {
	$uniName = $_POST['checkuniName'];
	$clientDegree = $_POST['checkclientDegree'];
	$clientStatus = $_POST['checkconvertStatus'];
	$clientCountry = $_POST['checkclientCountry'];
	$admissionStatus = $_POST['checkadmissionStatus'];
	$appliedStatus = $_POST['checkappliedStatus'];

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	if ($clientDegree=='master') {
		$clientApplied = '["master"]';
	}elseif ($clientDegree=='bachelor') {
		$clientApplied = '["bachelor"]';
	}elseif ($clientDegree=='mbbs') {
		$clientApplied = '["mbbs"]';
	}elseif ($clientDegree=='phd') {
		$clientApplied = '["phd"]';
	}

	$whereCondition = "icp.close='1' AND icp.status='1' AND icp.italy_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND icp.italy_assign_status='1' AND icp.italy_program_assign='".$_SESSION['user_id']."' AND cl.client_applied='".$clientApplied."' AND icp.italy_university_name='".$uniName."' ";

	if ($clientStatus!="all") {
		$whereCondition .= " AND cl.client_convert_status='".$clientStatus."' ";
	}
	if ($clientCountry!="all") {
		$whereCondition .= " AND cl.client_countryfrom='".$clientCountry."' ";
	}


	if($clientDegree=='bachelor'){
		if ($appliedStatus=='One Time Account Create') {
			// One Time Account Create
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Turin (TU)' || $uniName=='University of Bergamo (BR)' || $uniName=='University of Florence (UF)' || $uniName=='University of Ferrara (FR)'){
				$assign = "icp.italy_account_username!='' AND icp.italy_info_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Genova (UG)' || $uniName=='University of Pisa (UP)' || $uniName=='University of Verona (VN)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Laquia (LAQ01)' ){
				$assign = "icp.italy_direct_username!='' AND icp.italy_direct_info_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Foggia (FG)' || $uniName=='University of Salerno (SL)'){
				$assign = "icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='' ";
			}
			$whereCondition .= " AND $assign ";
		}
		
	}
	if($clientDegree=='master'){
		if ($appliedStatus=='One Time Account Create') {
			// One Time Account Create
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Turin (TU)' || $uniName=='University of Bergamo (BR)' || $uniName=='University of Florence (UF)' || $uniName=='University of Ferrara (FR)'){
				$assign = "icp.italy_account_username!='' AND icp.italy_info_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Genova (UG)' || $uniName=='University of Pisa (UP)' || $uniName=='University of Verona (VN)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Laquia (LAQ01)' ){
				$assign = "icp.italy_direct_username!='' AND icp.italy_direct_info_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Foggia (FG)' || $uniName=='University of Salerno (SL)'){
				$assign = "icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='' ";
			}
			$whereCondition .= " AND $assign ";
		}
	}
	if($clientDegree=='mbbs'){
		if ($appliedStatus=='One Time Account Create') {
			// One Time Account Create
			if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Turin (TU)' || $uniName=='University of Bergamo (BR)' || $uniName=='University of Florence (UF)' || $uniName=='University of Ferrara (FR)'){
				$assign = "icp.italy_account_username!='' AND icp.italy_info_screenshot1='' ";
			}elseif($uniName=='Sapienza University of Rome (SPU)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Palermo (PLM)' || $uniName=='University of Genova (UG)' || $uniName=='University of Pisa (UP)' || $uniName=='University of Verona (VN)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Tuscia (TS02)' || $uniName=='University of Laquia (LAQ01)' ){
				$assign = "icp.italy_direct_username!='' AND icp.italy_direct_info_screenshot='' ";
			}elseif($uniName=='University of Campania (UC)' || $uniName=='University of Napoli Fedrico II (UNP)' || $uniName=='University of Perugia (UPG)' || $uniName=='University of Foggia (FG)' || $uniName=='University of Salerno (SL)'){
				$assign = "icp.italy_pre_username!='' AND icp.italy_pre_info_screenshot='' ";
			}
			$whereCondition .= " AND $assign ";
		}
	}

		
	if ($admissionStatus!="all") {
		if ($admissionStatus=='waiting') {
			$whereCondition .= " AND ((icp.italy_pre_info_client_status='6' AND icp.italy_pre_applied_status='7') || (icp.italy_info_client_status='6' AND icp.italy_applied_status='7') || (icp.italy_direct_info_client_status='6' AND icp.italy_direct_applied_status='7') || (icp.italy_cimea_info_client_status='6' AND icp.italy_cimea_applied_status='7') ) ";
		}
		elseif($admissionStatus=='Acceptance'){
			$whereCondition .= " AND ((icp.italy_pre_info_client_status='8' AND icp.italy_pre_applied_status='8') || (icp.italy_info_client_status='8' AND icp.italy_applied_status='8') || (icp.italy_direct_info_client_status='8' AND icp.italy_direct_applied_status='8') || (icp.italy_cimea_info_client_status='8' AND icp.italy_cimea_applied_status='8') ) ";
		}
		elseif($admissionStatus=='Rejection'){
			$whereCondition .= "AND ((icp.italy_pre_info_client_status='8' AND icp.italy_pre_applied_status='9') || (icp.italy_info_client_status='9' AND icp.italy_applied_status='9') || (icp.italy_direct_info_client_status='9' AND icp.italy_direct_applied_status='9') || (icp.italy_cimea_info_client_status='9' AND icp.italy_cimea_applied_status='9') ) ";
		}
	}
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th>Sr</th>
					<th>ID / Date</th>
					<th>Client Info</th>
					<th>Degree</th>
					<th>Admission Status</th>
					<th>Document</th>
					<th>Track</th>
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
				<?php
				if($row['italy_program_assign']!='0' && (($row['italy_info_client_status']=='6' && $row['italy_applied_status']=='7') || ($row['italy_direct_info_client_status']=='6' && $row['italy_direct_applied_status']=='7') || ($row['italy_pre_info_client_status']=='6' && $row['italy_pre_applied_status']=='7') )){
					$style = 'alert-success text-dark';
				}elseif($row['italy_program_assign']!='0' && (($row['italy_info_client_status']!='6' && $row['italy_applied_status']!='7') || ($row['italy_direct_info_client_status']!='6' && $row['italy_direct_applied_status']!='7') || ($row['italy_pre_info_client_status']!='6' && $row['italy_pre_applied_status']!='7') ) ){
					$style = 'alert-warning text-dark';
				}else{
					$style = '';
				}
				?>
				<tr id="<?php echo $row['client_id']; ?>">
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
					<td class="breakTD <?php echo $style;?>">
						<?php include ("../components/AdmissionStatus.php");?>
					</td>
					<td class="<?php echo $style;?>">
						<a href="admission-documents?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Doc </button></a>
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