<?php 
$clientID = $_GET['client-id'];
$preEnroll = $_GET['preEnroll'] ?? '';
?>
<div class="card">
	<div class="card-body">

		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModal2Client" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModal2Title" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModal2Client">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<!-- Client data from component -->
		<?php include ("components/ClientQueryData.php"); ?>
		<!-- Sale Note from component -->
		<?php include ("components/SaleNote.php"); ?>
		<div class="table-responsive mt-1">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 20px;">Sr</th>
						<th style="width: 150px;">University</th>
						<th style="width: 200px;">Program</th>
						<th style="width: 80px;">Intake</th>
						<th style="width: 50px;" data-toggle="tooltip" data-placement="top" title="Program CGPA">CGPA</th>
						<th style="width: 70px;" data-toggle="tooltip" data-placement="top" title="Client CGPA">CGPA</th>
						<th style="width: 120px;">Current Status</th>
						<th style="width: 80px;">Apply Date</th>
						<th style="width: 120px;">Action</th>
						<th style="width: 130px;">SOP's Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sr=1; 
					$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND (italy_program_assign='".$_SESSION['user_id']."' || italy_pre_assign_to='".$_SESSION['user_id']."') AND italy_clients_id='".$clientID."' ";
					$select_query_ex = mysqli_query($con,$select_query);
					foreach ($select_query_ex as $rowPro) {
						$sopsStatus = $rowPro['italy_sops_status'];
						$uniName = $rowPro['italy_university_name'];
						$clientDegree = $rowPro['italy_client_degree'];
					?>
					<tr id="<?php echo $rowPro['italy_client_pro_id'];?>">
						<td><?php echo $sr;?></td>
						<td class="breakTD">
							<?php echo ucwords($rowPro['italy_university_name']);?>
						</td>
						<td class="breakTD text-left">
							<?php 
							$programName = $rowPro['italy_program_name'];
							$decoded = json_decode($programName, true);
							$changedProgramName = $rowPro['italy_change_program_name'] ? "<br>" . ucwords($rowPro['italy_change_program_name']) : '';
							if (empty($programName)) {
								echo $changedProgramName;
							} else {
								if (is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $name) {
										$programJSONName = $name;
										$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
									}
									echo ($rowPro['close'] == '0' || $rowPro['italy_change_program_status'] == '1') 
									? "<del>$output</del>$changedProgramName" 
									: ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
								} else {
									echo ($rowPro['close'] == '0' || $rowPro['italy_change_program_status'] == '1') 
									? "<del>" . ucwords($programName) . "</del>$changedProgramName" 
									: ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
								}
							}
							?>
						</td>
						<td><?php echo ucwords($rowPro['italy_intake']);?></td>

						<td class="bg-warning text-white">
							<strong>
							<?php
							$allProgramCGPAs = [];
							if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
								foreach ($decoded as $programName){
									$cgpaQuery = "SELECT italy_ad_cgpa from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$clientDegree."' AND italy_ad_program_name='".$programName."' ";
									$cgpaQuery_ex = mysqli_query($con,$cgpaQuery);
									if ($cgpaQuery_ex && mysqli_num_rows($cgpaQuery_ex) > 0) {
										foreach ($cgpaQuery_ex as $proRow) {
											$programCGPA = $proRow['italy_ad_cgpa'];
											echo $programCGPA;
											echo '</br>';
											$allProgramCGPAs[] = $programCGPA;
										}
									}
								}
							}
							?>
							</strong>
						</td>
						<?php 
						if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
							foreach ($allProgramCGPAs as $uniWiseCGPA) {
								if (strpos($uniWiseCGPA, '%') !== false) {
									if($clientInterPercentage!='' && ($clientDegree=='bachelor' || $clientDegree=='mbbs')){
										if($clientInterPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientInterPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage!='' && $clientPercentage2=='' && $clientInterPercentage=='' && ($clientDegree!='bachelor' || $clientDegree!='mbbs')){
										if($clientPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage=='' && $clientPercentage2!='' && ($clientDegree=='phd')){
										if($clientPercentage2 < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage2 >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if(($clientPercentage!='' && $clientPercentage2!='') && ($clientDegree!='bachelor' && $clientDegree!='mbbs') ){
										if($clientPercentage < $uniWiseCGPA && $clientPercentage2 < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage >= $uniWiseCGPA && $clientPercentage2 >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
								}else{ 
									if($clientCGPA!='' && $clientCGPA2==''){
										if($clientCGPA < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}if($clientCGPA >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										} 
									}if($clientCGPA=='' && $clientCGPA2!=''){
										if($clientCGPA2 < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}if($clientCGPA2 >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										} 
									}if($clientCGPA!='' && $clientCGPA2!=''){
										if($clientCGPA < $uniWiseCGPA && $clientCGPA2 < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}if($clientCGPA >= $uniWiseCGPA && $clientCGPA2 >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										} 
									}
								}
							}
						}else{
							$cgpaClass = 'bg-danger';
						}
						?>
						<td class="<?php echo $cgpaClass;?> text-white">
							<strong>
								<?php if($clientDegree=='bachelor' || $clientDegree=='mbbs'){
									if ($clientInterPercentage!='') {echo $clientInterPercentage;}
								}else{
									if ($clientCGPA!='') { echo $clientCGPA.' '; }
									if ($clientPercentage!='') { echo $clientPercentage.' '; }
									echo '<br>';
									if ($clientCGPA2!='') { echo $clientCGPA2.' '; }
									if ($clientPercentage2!='') { echo $clientPercentage2.' '; }
								} ?>
							</strong>
						</td>

						<td class="breakTD">
						<?php 
						include('phphelpers/directPreApplySteps.php');
						include('phphelpers/dreamApplySteps.php');
						include('phphelpers/directApplySteps.php');
						include('phphelpers/cimeaApplySteps.php');
						include('phphelpers/tolcApplySteps.php');
						?>
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<?php }else{ ?>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
							<?php } ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- dream apply -->
							<?php echo $admissionDreamStatus;?>
							<br><br>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>
							<!-- cimea apply -->
							<?php echo $admissionCimeaStatus;?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
							<br><br>
							<!-- Direct apply -->
							<?php echo $admissionPreStatus; ?>
						<?php }
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct pre enrollment apply -->
							<?php echo $admissionPreStatus;?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Direct apply -->
							<?php echo $admissionDirectStatus; ?>
							<br><br>
							<!-- tolc test indicator -->
							<?php echo $admissionTolcStatus;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<!-- Tolc apply -->
							<?php echo $admissionTolcStatus;?>
						<?php } ?>

						</td>
						<td>
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionPreDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDreamDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDirectDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							<?php echo $admissionPreDate;?>	
							<br><br>
							<?php echo $admissionDreamDate;?>
							<?php }else{ ?>
							<?php echo $admissionDreamDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
							<?php } ?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDirectDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDreamDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionDreamDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }

						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>
							<?php echo $admissionCimeaDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
							<br><br>
							<?php echo $admissionPreDate;?>
						<?php }
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionDirectDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
						<?php }
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionPreDate;?>
							<br><br>
							<?php echo $admissionTolcDate;?>
						<?php } 
						
						if ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php echo $admissionTolcDate;?>
						<?php } ?>
						</td>
						<?php
						$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);

					$clientData = "SELECT admission_doc8, admission_doc12, admission_doc36 FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
						$clientData_ex = mysqli_query($con, $clientData);
						$rowDoc = mysqli_fetch_assoc($clientData_ex);
						$doc12Name = $rowDoc['admission_doc12'] ?? '';
						$doc36Name = $rowDoc['admission_doc36'] ?? '';
						$doc8Name = $rowDoc['admission_doc8'] ?? '';
						$disButton='';
						if($uniName=='Sapienza University of Rome (SPU)' && ($clientDegree=='bachelor' || $clientDegree=='master') && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Trento (TRN)' && ($clientDegree=='bachelor' || $clientDegree=='master') && $doc36Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Messina (UM)' && ($clientDegree=='bachelor' || $clientDegree=='master') && ($doc12Name=='' || $doc36Name=='')){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Cassino (CS)' && ($clientDegree=='bachelor') && $doc12Name==''){
							$disButton = 'disabled';
						}
						// elseif($uniName=='University of Pavia (PV)' && ($clientDegree=='bachelor') && $doc12Name==''){
						// 	$disButton = 'disabled';
						// }
						elseif(($uniName=='University of Bologna (UBN)' && $clientDegree=='master' && (strpos($programName, 'Physics') === false ) ) && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Florence (UF)' && $clientDegree=='master' && $doc8Name==''){
							$disButton = 'disabled';
						}
						elseif(($uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)') && $clientDegree=='bachelor' && $doc12Name==''){
							$disButton = 'disabled';
						}

						?>
						<td>
						<?php $btnDreamClass = $rowPro['italy_proof_screenshot1']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnDirectClass = $rowPro['italy_direct_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnPreClass = $rowPro['italy_pre_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $testType = 'CEnT-S'; ?>

						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php if($uniName=='University of Pavia (PV)' && $clientDegree=='mbbs'){ ?>
							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?= $preEnroll=='allClient' ? 'disabled' : '' ?> style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a> 	
							<br>
							2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php }else{ ?>
							1. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?= $preEnroll=='allClient' ? 'disabled' : '' ?> style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a> 
							<?php } ?>
						
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a> 
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?= $preEnroll=='allClient' ? 'disabled' : '' ?> style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>

							1. <a href="cimea-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Cimea Apply"><i class="mdi mdi-alpha-c-circle"></i> Cimea</button></a>
							<br>
							<?php if($rowPro['italy_cimea_accepted_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							<br>
							<?php if($rowPro['italy_cimea_accepted_screenshot']!='' && $rowPro['italy_tolc_pass_screenshot']!=''){ ?>
								3. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E. </button></a>
							<?php }else{ ?>
								3. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply" disabled=""><i class="mdi mdi-information"></i> Pre E. </button></a>
							<?php } ?>
							
						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php 
							if (stripos($rowPro['italy_program_name'], 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
							1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<br>
							<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
							2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Social Sciences For Global Challenges') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International And Economics Studies') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
							1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<br>
							<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
							2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?= $preEnroll=='allClient' ? 'disabled' : '' ?> style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($rowPro['italy_program_name'], 'Social Sciences For Global Challenges') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International And Economics Studies') !== false || stripos($rowPro['italy_program_name'], 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?= $preEnroll=='allClient' ? 'disabled' : '' ?> style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>

						<?php }

						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" <?php echo $disButton;?> type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<br>
							<?php if($rowPro['italy_direct_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
							<br>
							<?php if($rowPro['italy_pre_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>" disabled=""><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
						<?php }
						?>
						</td>
						<td>
						<?php
						$statusClass = match($rowPro['italy_program_status']) {
							'1' => 'btn-warning',
							'2' => 'btn-success',
							default => 'btn-outline-primary',
						};
						?>
						<button type="button" class="btn <?php echo $statusClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Check Admission Head Note" onclick="addProgramNote(<?php echo $rowPro['italy_client_pro_id']; ?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>

							
						<?php
						foreach ($decoded as $key => $programJSONName1) { 
							$select_query = "SELECT italy_ad_sop_required from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$clientDegree."' AND italy_ad_program_name='".$programJSONName1."' ";
							$select_query_ex = mysqli_query($con,$select_query);
							$sopRow = mysqli_fetch_assoc($select_query_ex);
							$sopRequiredORNot = $sopRow['italy_ad_sop_required'];
							if ($sopRequiredORNot == '1') {
								break;
							}
						}
						if($sopRequiredORNot=='1'){
						?>
						<?php if($sopsStatus==4){ ?>
							<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="SOP's of this University" onclick="addSOPsProgram(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-check-circle"></i> SOP's</button>
						<?php }else{ ?>
							<button type="button" class="btn btn-outline-pink btn-sm" data-toggle="tooltip" data-placement="top" title="SOP's of this University" onclick="addSOPsProgram(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-eye"></i> SOP's</button>
						<?php } ?>
						<?php }else{ ?>
						<span data-toggle="tooltip" data-placement="top" title="No SOP's Required for this University" class="badge bg-info pt-2 pb-2">No SOP's Required </span>
						<?php } ?>
						</td>
					</tr>
					<?php $sr++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	document.addEventListener("contextmenu", function (e) {
		if (e.target.tagName === "BUTTON" && e.target.disabled) {
			e.preventDefault();
		}
	});
	document.addEventListener('auxclick', function(e) {
		if (e.button === 1) {
			e.preventDefault();
			e.stopPropagation();
		}
	});

	// Save Apply & Assign Data using AJAX
	function saveDataForm(formID, proBtn) {
		let $form = $("#"+formID);
		let $btn = $("#"+proBtn);
		if ($form.parsley().validate()) {
			// CKEditor ka data update karne ka step
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append(proBtn, 1);
			$.ajax({
				url: "models/_applyProgramControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					let res = typeof response === "string" ? JSON.parse(response) : response;
					Swal.fire({
						title: res.title,
						text: res.text,
						icon: res.status
					}).then(() => {
						location.reload();
					});
				},
				error: function (xhr, status, error) {
					Swal.fire({
						title: "Error!",
						text: "Something went wrong: " + error,
						icon: "error"
					});
					$btn.prop("disabled", false).text("Submit");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields before submitting.",
				icon: "warning"
			});
		}
	}

	// Add SOPS of Program
	function addSOPsProgram(idSop) {
		var idSop = idSop;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'programSOPs='+idSop,
			success: function(data){
				$(".showModalTitle").html('SOPs Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');

				$('#showModalClient').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});

			}
		});
	};

	// Add note to Admission head
	function addProgramNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkProgramNote='+id,
			success: function(data){
				$(".showModal2Title").html('Add Note');
				$(".showModal2Client").html(data);
				$("#showModal2Client").modal('show');

				$('#showModal2Client').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});

			}
		});
	};

	function updProReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'updProgramNote='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}

</script>