<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkuniName'])) {

	$uniName = $_POST['checkuniName'];
	$clientDegree = $_POST['checkclientDegree'];
	$activeUni = $_POST['checkactiveUni'];
	$englishProficiency = $_POST['checkenglishProficiency'];
	$checkSop = $_POST['checkcheckSop'];
	$overallRound = $_POST['checkoverallRound'];
	$cgpaPer = $_POST['checkcgpaPer'];
	$applicationFee = $_POST['checkapplicationFee'];
	$intake = $_POST['checkintake'];
	$appProcess = $_POST['checkappProcess'];
	$openingDateFrom = $_POST['checkopeningDateFrom'];
	$openingDateTo = $_POST['checkopeningDateTo'];
	$actualDateFrom = $_POST['checkactualDateFrom'];
	$actualDateTo = $_POST['checkactualDateTo'];
	$saleDateFrom = $_POST['checksaleDateFrom'];
	$saleDateTo = $_POST['checksaleDateTo'];
	$preClientDegree = $_POST['checkpreClientDegree'];
	$proIntake = $_POST['checkproIntake'];
	$proCall = $_POST['checkproCall'];
	$clientDetails = $_POST['checkclientDetails'];


	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition = "aap.close='1' AND aap.status='1' ";

	if($proCall=='1'){
		$whereCondition .= "AND aapd.aus_ad_intake='March'  ";
	}
	if($proCall=='2'){
		$whereCondition .= "AND aapd.aus_ad_intake='October' ";
	}
	if($proCall=='3'){
		$whereCondition .= "AND aapd.aus_ad_intake='March / October' ";
	}
	if($proCall=='5'){
		$whereCondition .= "AND (aapd.aus_ad_current_round < aapd.aus_ad_round) AND ( (aapd.aus_ad_1st_actual_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) OR (aapd.aus_ad_2nd_actual_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) ) ";
	}

	if ($uniName!="all") {
		$whereCondition .= " AND aap.aus_ap_uni_name='".$uniName."' ";
	}
	if ($clientDegree!="all") {
		$whereCondition .= " AND aap.aus_ap_degree='".$clientDegree."' ";
	}

	if ($activeUni!="all") {
		if($activeUni=='Active'){
			$whereCondition .= " AND aap.aus_active_status='1' ";
		}
		if($activeUni=='InActive'){
			$whereCondition .= " AND aap.aus_active_status='0' ";
		}
	}
	if($englishProficiency=="English Proficiency"){
		$whereCondition .= "AND aapd.aus_ad_english_pro='1' ";
	}
	if($englishProficiency=="Without English Proficiency"){
		$whereCondition .= "AND aapd.aus_ad_english_pro='0' ";
	}
	if($checkSop=="SOP Required"){
		$whereCondition .= "AND aapd.aus_ad_sop_required='1' ";
	}
	if($checkSop=="Without SOP"){
		$whereCondition .= "AND aapd.aus_ad_sop_required='0' ";
	}
	if($overallRound!="all"){
		$whereCondition .= "AND aapd.aus_ad_round='".$overallRound."' ";
	}
	if($cgpaPer!="all"){
		$whereCondition .= "AND aapd.aus_ad_cgpa<='".$cgpaPer."' ";
	}
	if($applicationFee=="With Application Fee Universities"){
		$whereCondition .= "AND (aapd.aus_ad_application_fee!='0' AND aapd.aus_ad_application_fee!='N/A') ";
	}
	if($applicationFee=="Without Application Fee Universities"){
		$whereCondition .= "AND (aapd.aus_ad_application_fee='0' || aapd.aus_ad_application_fee='N/A') ";
	}

	if ($intake!="all") {
		$whereCondition .= " AND aapd.aus_ad_intake='".$intake."' ";
	}
	if ($appProcess!="all") {
		$whereCondition .= " AND aapd.aus_ad_application_process='".$appProcess."' ";
	}
	if($openingDateFrom!="" && $openingDateTo!=""){
		$whereCondition .= "AND (aapd.aus_ad_1st_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo' OR aapd.aus_ad_2nd_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo') ";
	}
	if($actualDateFrom!="" && $actualDateTo!=""){
		$whereCondition .= "AND (aapd.aus_ad_1st_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo' OR aapd.aus_ad_2nd_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo') ";
	}
	if($saleDateFrom != "" && $saleDateTo != ""){
		$whereCondition .= "AND (aapd.aus_ad_1st_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY) OR aapd.aus_ad_2nd_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY)) ";
	}
	if ($preClientDegree != "all") {
		$whereCondition .= " AND JSON_CONTAINS(aapd.aus_ad_client_pre_degree, '\"$preClientDegree\"') ";
	}
	if($clientDetails=='' || $clientDetails!=''){
		$whereCondition .= " AND (aap.aus_ap_uni_name LIKE '%".$clientDetails."%' OR aap.aus_ap_degree LIKE '%".$clientDetails."%' ) ";
	}
	$countQuery = "SELECT COUNT(DISTINCT aap.aus_ap_id) as total from austria_add_programs{$_SESSION['dbNo']} aap JOIN austria_add_programs_details{$_SESSION['dbNo']} aapd ON aap.aus_ap_id=aapd.aus_add_pro_id WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$clientData = "SELECT * from austria_add_programs{$_SESSION['dbNo']} aap JOIN austria_add_programs_details{$_SESSION['dbNo']} aapd ON aap.aus_ap_id=aapd.aus_add_pro_id WHERE $whereCondition GROUP BY aap.aus_ap_id ORDER BY CASE WHEN aap.aus_active_status = 1 THEN 0 ELSE 1 END, aap.aus_ap_id DESC LIMIT $limit OFFSET $offset";
	$clientData_ex = mysqli_query($con,$clientData);
	?>

	<a href="print-programs.html.php?checkuniName=<?php echo urlencode($uniName); ?>&checkclientDegree=<?php echo urlencode($clientDegree); ?>&checkactiveUni=<?php echo urlencode($activeUni); ?>&checkenglishProficiency=<?php echo urlencode($englishProficiency); ?>&checkcheckSop=<?php echo urlencode($checkSop); ?>&checkoverallRound=<?php echo urlencode($overallRound); ?>&checkcgpaPer=<?php echo urlencode($cgpaPer); ?>&checkapplicationFee=<?php echo urlencode($applicationFee); ?>&checkintake=<?php echo urlencode($intake); ?>&checkappProcess=<?php echo urlencode($appProcess); ?>&checkopeningDateFrom=<?php echo urlencode($openingDateFrom); ?>&checkopeningDateTo=<?php echo urlencode($openingDateTo); ?>&checkactualDateFrom=<?php echo urlencode($actualDateFrom); ?>&checkactualDateTo=<?php echo urlencode($actualDateTo); ?>&checksaleDateFrom=<?php echo urlencode($saleDateFrom); ?>&checksaleDateTo=<?php echo urlencode($saleDateTo); ?>&checkpreClientDegree=<?php echo urlencode($preClientDegree); ?>&checkproIntake=<?php echo urlencode($proIntake); ?>&checkproCall=<?php echo urlencode($proCall); ?>&checkclientDetails=<?php echo urlencode($clientDetails); ?>" type="button" class="btn btn-danger btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Print"><i class="mdi mdi-printer"></i> Print Programs</a>

	<style type="text/css">
		table td{
			padding: .25rem !important;
			padding-right: 0rem !important;
		}
	</style>
	<div class="table-wraper">
		<div class="mt-1 table-container" id="table-container" style="overflow-x: auto;">
			<table id="datatablePro" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 50px;">Sr</th>
						<th style="width: 150px;">Action</th>
						<th style="width: 1000px;">Name</th>
						<th style="width: 2000px;">Degree</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sr = $totalRecords - $offset;
				while ($row = mysqli_fetch_assoc($clientData_ex)) {
				?>
					<tr id="<?php echo $row['aus_ap_id'];?>" class="<?php echo ($row['aus_active_status'] == '1') ? 'bg-dark text-white' : 'bg-danger text-white';?>" onclick="proViewTable(<?php echo $row['aus_ap_id'];?>);">
						<td><?php echo $sr;?></td>
						<td>
							<input type="hidden" name="" value="<?php echo $row['aus_active_status'];?>" id="actPro<?php echo $row['aus_ap_id'];?>">
							<button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo ($row['aus_active_status'] == '1') ? 'InActive' : 'Active';?> " class="btn btn-warning btn-sm" onclick="activePro(activeProC,<?php echo $row['aus_ap_id'];?>)"><i class="mdi mdi-alert-octagon"></i></button>
							<button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary btn-sm" onclick="editAddPro(<?php echo $row['aus_ap_id'];?>)"><i class="mdi mdi-square-edit-outline"></i></button>
							<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="del(delC,<?php echo $row['aus_ap_id'];?>);"><i class="mdi mdi-trash-can"></i></button>
						</td>
						<td class="breakTD" style="font-size: 20px;"><b><?php echo $row['aus_ap_uni_name'];?> (<?php echo ucwords($row['aus_ap_degree']);?>)</b></td>
						<td style="font-size: 20px;"><b><?php echo ucwords($row['aus_ap_degree']);?></b></td>
					</tr>
				
					<tr>
						<td colspan="4">
							<div class="col-md-12" id="showProTable<?php echo $row['aus_ap_id'];?>" style="display: none;">
								<table class="table table-bordered nowrap text-center" style="width: 100%;">
									<thead>
										<th style="width: 5px;">Sr</th>
										<th>Program Name</th>
										<th data-toggle="tooltip" data-placement="top" title="Current Intake Opening Date">C.R.O.D</th>
										<th data-toggle="tooltip" data-placement="top" title="Current Intake Actual Deadline">C.R.A.D</th>
										<th data-toggle="tooltip" data-placement="top" title="Current Intake Deadline for Sale">C.R.D.S</th>
										<th>CGPA / %</th>
										<th data-toggle="tooltip" data-placement="top" title="English Proficiency">E. P</th>
										<th style="width: 15px;" data-toggle="tooltip" data-placement="top" title="Program Application Fee">P.A.F</th>
										<th>Intake</th>
										<th>Overall Intake</th>
										<th>SOP Required</th>
										<th>Application Process</th>
										<th>Degree</th>
										<th>Recommendation</th>
										<th>CV Required</th>
										<th>InterView</th>
										<th>Leg Document</th>
										<th>GMAT/GRE</th>
										<th>Entry Test</th>
										<th>Instruction</th>
										<th>Tuition Fee</th>
										<th>Admission Valid</th>
										<th>Degree Acceptable</th>
										<th>Client's Previous Degree</th>
										<th>Action</th>
									</thead>
									<tbody>
									<?php
									$whereDetCondition = "close='1' AND status='1' AND aus_add_pro_id='".$row['aus_ap_id']."'  ";
									if($englishProficiency=="English Proficiency"){
										$whereDetCondition .= "AND aus_ad_english_pro='1' ";
									}
									if($englishProficiency=="Without English Proficiency"){
										$whereDetCondition .= "AND aus_ad_english_pro='0' ";
									}
									if($checkSop=="SOP Required"){
										$whereDetCondition .= "AND aus_ad_sop_required='1' ";
									}
									if($checkSop=="Without SOP"){
										$whereDetCondition .= "AND aus_ad_sop_required='0' ";
									}
									if($overallRound!="all"){
										$whereDetCondition .= "AND aus_ad_round='".$overallRound."' ";
									}
									if($cgpaPer!="all"){
										$whereDetCondition .= "AND aus_ad_cgpa<='".$cgpaPer."' ";
									}
									if($applicationFee=="With Application Fee Universities"){
										$whereCondition .= "AND (aus_ad_application_fee!='0' AND aus_ad_application_fee!='N/A') ";
									}
									if($applicationFee=="Without Application Fee Universities"){
										$whereCondition .= "AND (aus_ad_application_fee='0' || aus_ad_application_fee='N/A') ";
									}
									
									if($proCall=='1' || $proCall=='2'){
										$whereDetCondition .= "AND aus_ad_current_round='".$proCall."' ";
									}
									if($intake!="all"){
										$whereDetCondition .= "AND aus_ad_intake='".$intake."' ";
									}
									if ($appProcess!="all") {
										$whereDetCondition .= " AND aus_ad_application_process='".$appProcess."' ";
									}
									if($openingDateFrom!="" && $openingDateTo!=""){
										$whereDetCondition .= "AND (aus_ad_1st_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo' OR aus_ad_2nd_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo') ";
									}
									if($actualDateFrom!="" && $actualDateTo!=""){
										$whereDetCondition .= "AND (aus_ad_1st_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo' OR aus_ad_2nd_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo') ";
									}
									if($saleDateFrom != "" && $saleDateTo != ""){
										$whereDetCondition .= "AND (aus_ad_1st_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY) OR aus_ad_2nd_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY)) ";
									}
									if ($preClientDegree != "all") {
										$whereDetCondition .= " AND JSON_CONTAINS(aus_ad_client_pre_degree, '\"$preClientDegree\"') ";
									}
									$proDetails = "SELECT * from austria_add_programs_details".$_SESSION['dbNo']." WHERE $whereDetCondition ORDER BY aus_ad_cgpa ASC";
									$proDetails_ex = mysqli_query($con,$proDetails);

									$ser=1;
									while ($rowDet = mysqli_fetch_assoc($proDetails_ex)) {
									?>
									<tr id="<?php echo $rowDet['aus_add_pro_id'];?>" class="<?php echo ($rowDet['aus_ad_status'] == '1') ? '' : 'bg-danger text-white';?>">
										<td><?php echo $ser;?></td>
										<td class="breakTD"><?php echo ucwords($rowDet['aus_ad_program_name']);?></td>
										<td class="breakTD">
											<?php
											$round = $rowDet['aus_ad_current_round'];
											if ($round == '1') {
												$date = $rowDet['aus_ad_1st_opening_date'];
											} elseif ($round == '2') {
												$date = $rowDet['aus_ad_2nd_opening_date'];
											}
											// 0000-00-00 check
											if ($date == "0000-00-00" || empty($date)) {
												echo "Not Announce Yet";
											} else {
												echo date("d-m-Y", strtotime($date));
											}
											?>
										</td>
										<td class="breakTD">
											<?php
											$round = $rowDet['aus_ad_current_round'];
											if ($round == '1') {
												$date = $rowDet['aus_ad_1st_actual_date'];
											} elseif ($round == '2') {
												$date = $rowDet['aus_ad_2nd_actual_date'];
											}
											// Check 0000-00-00
											if ($date == "0000-00-00" || empty($date)) {
												echo "Not Announce Yet";
											} else {
												echo date("d-m-Y", strtotime($date));
											}
											?>
										</td>
										<td class="breakTD">
											<?php
											$round = $rowDet['aus_ad_current_round'];
											if ($round == '1') {
												$date = $rowDet['aus_ad_1st_actual_date'];
											} elseif ($round == '2') {
												$date = $rowDet['aus_ad_2nd_actual_date'];
											}
											// Check 0000-00-00 or empty
											if ($date == "0000-00-00" || empty($date)) {
												echo "Not Announce Yet";
											} else {
												echo date("d-m-Y", strtotime($date . " -12 days"));
											}
											?>
										</td>
										
										<td><?php echo $rowDet['aus_ad_cgpa'];?></td>
										<td class="breakTD">
											<span data-toggle="tooltip" data-placement="top" title="English Proficiency  Letter Acceptable"><?= $rowDet['aus_ad_english_pro']=='1' ? 'Yes' : 'No'; ?> </span> 
											<br> 
											<span data-toggle="tooltip" data-placement="top" title="IELTS / PTE / Duo lingo / Other"> <?php echo $rowDet['aus_ad_ielts_pte'];?> </span>
										</td>
										
										<td class="breakTD"><?php echo $rowDet['aus_ad_application_fee'];?></td>
										<td class="breakTD"><?php echo $rowDet['aus_ad_intake'];?></td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="Overall Intake"><?php echo $rowDet['aus_ad_round'];?> </span> 
											<br> 
											<span data-toggle="tooltip" data-placement="top" title="Current Intake"><?php echo $rowDet['aus_ad_current_round'];?> </span> 
											</td>
										
										<td class="breakTD">
											<span data-toggle="tooltip" data-placement="top" title="SOP"><?= $rowDet['aus_ad_sop_required']=='1' ? 'Yes' : 'No'; ?> </span> 
											<br> 
											<span data-toggle="tooltip" data-placement="top" title="SOP Note"> <?php echo $rowDet['aus_ad_sop_note'];?> </span>
										</td> 
										<td><?php echo $rowDet['aus_ad_application_process'];?></td>
										<td><?= $rowDet['aus_ad_degree_required']=='1' ? 'Yes' : 'No'; ?> </td>
										<td><?= $rowDet['aus_ad_recommendation']=='1' ? 'Yes' : 'No'; ?> </td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="Normal CV"> <?= $rowDet['aus_ad_normal_cv']=='1' ? 'Normal CV' : 'No'; ?></span> 
											<br> 
											<span data-toggle="tooltip" data-placement="top" title="Europass CV"><?= $rowDet['aus_ad_europass_cv']=='1' ? 'Europass CV' : 'No'; ?> </span>
										</td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="Any InterView Required"><?= $rowDet['aus_ad_test_interview']=='1' ? 'Yes' : 'No'; ?> </span>
										</td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="legalized documents"><?= $rowDet['aus_ad_leg_document']=='1' ? 'Yes' : 'No'; ?> </span>
										</td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="GMAT / GRE Test"><?= $rowDet['aus_ad_gmat_gre_test']=='1' ? 'Yes' : 'No'; ?> </span>
										</td>
										<td>
											<span data-toggle="tooltip" data-placement="top" title="Entry Test"><?= $rowDet['aus_ad_entry_test']=='1' ? 'Yes' : 'No'; ?> </span>
										</td>
										<td><?php echo $rowDet['aus_ad_instruction'];?></td>
										<td><?php echo $rowDet['aus_ad_tuition_fee'];?></td>	
										<td><?php echo $rowDet['aus_ad_admission_valid'];?></td>
										<td><?php echo $rowDet['aus_ad_degree_acceptable'];?></td>
										<td class="breakTD">
										<?php 
										$degrees = json_decode($rowDet['aus_ad_client_pre_degree'], true);
										if (is_array($degrees)) {
											$i = 1;
											foreach ($degrees as $degree) {
												echo $i++ . ". " . ucwords($degree) . "<br>";
											}
										}
										?>
										</td>
										<td>
											<input type="hidden" name="" value="<?php echo $rowDet['aus_ad_status'];?>" id="actDetPro<?php echo $rowDet['aus_apd_id'];?>">
											<button type="button" data-toggle="tooltip" data-placement="top" title="<?php echo ($rowDet['aus_ad_status']=='1') ? 'InActive' : 'Active';?> " class="btn btn-warning btn-sm" onclick="activePro(activeProDetC,<?php echo $rowDet['aus_apd_id'];?>)"><i class="mdi mdi-alert-octagon"></i></button>
											<?php 
											$current_date = date('Y-m-d');
											if($rowDet['aus_ad_current_round']=='1'){ 
												if($rowDet['aus_ad_1st_actual_date'] < $current_date){
												?>
												<button type="button" data-toggle="tooltip" data-placement="top" title="InActive" class="btn btn-danger btn-sm"><i class="mdi mdi-file"></i></button>
												<?php }else{ ?>
												<button type="button" data-toggle="tooltip" data-placement="top" title="Active" class="btn btn-success btn-sm"><i class="mdi mdi-file"></i></button>
												<?php }
											}elseif($rowDet['aus_ad_current_round']=='2'){ 
												if($rowDet['aus_ad_2nd_actual_date'] < $current_date){
												?>
												<button type="button" data-toggle="tooltip" data-placement="top" title="InActive" class="btn btn-danger btn-sm"><i class="mdi mdi-file"></i></button>
												<?php }else{ ?>
												<button type="button" data-toggle="tooltip" data-placement="top" title="Active" class="btn btn-success btn-sm"><i class="mdi mdi-file"></i></button>
												<?php }
											}
											?>
										</td>
									</tr>
									<?php $ser++;} ?>
								</tbody>
								</table>
							</div>
						</td>
					</tr>
				<?php
				$sr--;
				} ?>
				</tbody>
			</table>
			<script type="text/javascript">
				$(document).ready(function() {
					$('[data-toggle="tooltip"]').tooltip({ html: true });
					if ($.fn.DataTable.isDataTable("#datatablePro")) {
						// Destroy the existing DataTable instance
						$('#datatablePro').DataTable().destroy();
					}
					$("#datatablePro").DataTable({
						paging: false,
						searching: false,
						info: false,
						lengthChange: false,
						order: [[0, 'desc']],
					});
				});
			</script>
		</div>
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
					echo '<li style="cursor: pointer;" class="paginate_button page-item previous" onclick="viewClientsFilterPro('.($page - 1).');"><span class="page-link">Previous</span></li>';
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
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilterPro('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis before the middle range
				if ($startRange > 4) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Pages around the current page
				for ($i = $startRange; $i <= $endRange; $i++) {
					if ($i > $totalPages || $i < 4) continue;
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilterPro('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis after the middle range
				if ($endRange < $totalPages - 3) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Show last three pages
				for ($i = max($totalPages - 2, 4); $i <= $totalPages; $i++) {
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilterPro('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Next button
				if ($page < $totalPages) {
					echo '<li style="cursor: pointer;" class="paginate_button page-item next" onclick="viewClientsFilterPro('.($page + 1).');"><span class="page-link">Next</span></li>';
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