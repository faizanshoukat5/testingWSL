<?php 
$clientID = $_GET['client-id'];
$clientURL = $_GET['url'];
$uniNames = $_GET['university-name'];
?>
<div class="card">
	<div class="card-body">
		<!-- View Modal -->
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

		<!-- View Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalChanClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalChanTitle" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalChanClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		<div class="alert alert-primary">
			<h5><?php if($uniNames=='all'){echo "All Clients";}else{echo $uniNames;}?> >> Assign Programs</h5>
		</div>
		<!-- Client data from component -->
		<?php include ("components/ClientQueryData.php");
		// Sale Note from component 
		include ("components/SaleNote.php");
		$getUrl = base64_encode($clientName."".$clientEmail);
		$appliedChangingJson = json_encode($appliedChanging);
		$appRow = htmlspecialchars($appliedChangingJson, ENT_QUOTES, 'UTF-8');
		?>
		<?php if($clientURL===$getUrl){ ?>
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Add New University" onclick="addNewUni('<?php echo $clientID;?>', 'New');"> <i class="mdi mdi-alpha-a-circle"></i> Add New University</button>
			</div>
		</div>
		<!-- Datatable -->
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
						<th style="width: 120px;">Assign To</th>
						<th style="width: 150px;">Action</th>
						<th style="width: 100px;">SOP's Status</th>
						<th style="width: 150px;">Deadline link</th>
					</tr>
				</thead>
				<thead>
					<tr>
						<th colspan="10">
							<div class="float-right">
								<a href="admission-documents?client-id=<?php echo $clientID;?>&<?php echo $getUrl;?>" target="_blank"><button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Documents of Client"><i class="mdi mdi-eye"></i> Documents </button></a>
							</div>
						</th>
						<input type="hidden" name="" value="<?php echo $appRow;?>" id="degreeID">
					</tr>
				</thead>
				<tbody>
					<?php
					$sr=1;
					if ($uniNames=='all') {
					 	$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND (close='1' || close='0') AND italy_clients_id='".$clientID."' ORDER BY italy_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}else{
						$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND (close='1' || close='0') AND italy_clients_id='".$clientID."' AND italy_university_name='".$uniNames."' ORDER BY italy_assign_status ASC ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					foreach ($select_query_ex as $rowPro) {
						$wtID = $rowPro['italy_program_assign'];
						$uniName = $rowPro['italy_university_name'];
						$backgroundStyle = $rowPro['italy_assign_status']==1 ? 'background: #D7FFF1; color:#000;' : '';
						$degreeName = $rowPro['italy_client_degree'];
						// $uniWiseCGPA=0;
						// $cgpaQuery = "SELECT italy_uni_cgpa from italy_university_cgpa WHERE status='1' AND close='1' AND italy_cgpa_uni_name='".$uniName."' AND italy_cgpa_uni_degree='".$degreeName."' ORDER BY italy_cgpa_uni_id DESC LIMIT 1 ";
						// $cgpaQuery_ex = mysqli_query($con,$cgpaQuery);
						// if ($cgpaQuery_ex && mysqli_num_rows($cgpaQuery_ex) > 0) {
						// 	$result = mysqli_fetch_assoc($cgpaQuery_ex);
						// 	$uniWiseCGPA = $result['italy_uni_cgpa'];
						// }
					?>
					<tr id="<?php echo $rowPro['italy_client_pro_id'];?>">
						<td style="<?php echo $backgroundStyle; ?>">
							<?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "<del>$sr</del>" : $sr; ?>
						</td>
						<td style="<?php echo $backgroundStyle; ?>" class="breakTD">
							<?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "<del>" . ucwords($rowPro['italy_university_name']) . "</del>" : ucwords($rowPro['italy_university_name']); ?>
						</td>
						<td style="<?php echo $backgroundStyle; ?>" class="breakTD text-left">
							<?php 
							$programName = $rowPro['italy_program_name'];
							$programJSONName = $rowPro['italy_program_name'];
							$changedProgramName = $rowPro['italy_change_program_name'] ? "<br>" . ucwords($rowPro['italy_change_program_name']) : '';
							$decoded = json_decode($programName, true);
							if (empty($programName)) {
								echo $changedProgramName;
							} else {
								if (is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $progJSOName) {
										$programJSONName = $progJSOName;
										$output .= ($key + 1) . ') ' . ucwords($progJSOName) . '<br>';
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
						<td style="<?php echo $backgroundStyle; ?>" class="breakTD">
							<?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "<del>".ucwords($rowPro['italy_intake'])."</del>" : ucwords($rowPro['italy_intake']);?>
						</td>
						<td class="bg-warning text-white">
							<strong>
							<?php
							$allProgramCGPAs = [];
							if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
								foreach ($decoded as $programName){
									$cgpaQuery = "SELECT italy_ad_cgpa from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_program_name='".$programName."' ";
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
									if($clientInterPercentage!='' && ($degreeName=='bachelor' || $degreeName=='mbbs')){
										if($clientInterPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientInterPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage!='' && $clientPercentage2=='' && $clientInterPercentage=='' && ($degreeName!='bachelor' || $degreeName!='mbbs')){
										if($clientPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage=='' && $clientPercentage2!='' && ($degreeName=='phd')){
										if($clientPercentage2 < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage2 >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if(($clientPercentage!='' && $clientPercentage2!='') && ($degreeName!='bachelor' && $degreeName!='mbbs') ){
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
								<?php if($degreeName=='bachelor' || $degreeName=='mbbs'){
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
						<?php if($rowPro['italy_assign_status'] == 1) { 
							$wt_query = "SELECT fname, lname from wt_users WHERE status='1' AND close='1' AND wt_id='".$wtID."' ";
							$wt_query_ex = mysqli_query($con,$wt_query);
							foreach ($wt_query_ex as $wtrow) {
								$wtName = $wtrow['fname']." ".$wtrow['lname'];
							}
						?>
						<td class="breakTD" style="<?php echo $backgroundStyle;?>">
							<?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "<del>".ucwords($wtName)."</del>" : ucwords($wtName); ?>
							<br>
							<?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "<del>".date("d-m-Y", strtotime($rowPro['italy_program_assign_date']))."</del>" : date("d-m-Y", strtotime($rowPro['italy_program_assign_date']));?></td>
						<?php }else{ ?>
						<td></td>
						<?php } ?>
						<td style="<?php echo $backgroundStyle;?>">
						<?php if($rowPro['italy_assign_status'] == 1) { ?>
							<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign this Program To Team" onclick="assignProgram(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-check-circle"></i> Assigned</button>
	
							<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>

						<?php }else{?>
							<?php
							$currentDate = date('Y-m-d');
							$dateStatus='';
							$selectQuery = "SELECT * from italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='".$uniName."' AND italy_degree_name='".$degreeName."' ORDER BY italy_dates_id DESC LIMIT 1 ";
							$selectQuery_ex = mysqli_query($con,$selectQuery);
							foreach ($selectQuery_ex as $dateRow) {
								$dateStatus = $dateRow['italy_date_status'];
								$openingDate = $dateRow['italy_opening_date'];
								$closingDate = $dateRow['italy_closing_date'];
							}
							if($dateStatus=='1' && $currentDate>=$openingDate && $currentDate <= $closingDate){ ?>
								<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are open Assign the Program" onclick="assignProgram(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }elseif($dateStatus=='2'){ ?>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are closed please Check the deadline link" onclick="assignProgram(<?php echo $rowPro['italy_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC<?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }elseif($dateStatus=='1' && $currentDate<$openingDate && $currentDate < $closingDate){ ?>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are open Assign the Program" onclick="assignProgram(<?php echo $rowPro['italy_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }else{ ?>
								<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are closed please Check the deadline link" onclick="assignProgram(<?php echo $rowPro['italy_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php } ?>
						<?php }?>
						<br>
						<?php 
						$clientData = "SELECT admission_doc8, admission_doc12, admission_doc36 FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
						$clientData_ex = mysqli_query($con, $clientData);
						$rowDoc = mysqli_fetch_assoc($clientData_ex);
						$doc12Name = $rowDoc['admission_doc12'] ?? '';
						$doc36Name = $rowDoc['admission_doc36'] ?? '';
						$doc8Name = $rowDoc['admission_doc8'] ?? '';
						$disButton='';
						if($uniName=='Sapienza University of Rome (SPU)' && ($degreeName=='bachelor' || $degreeName=='master') && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Trento (TRN)' && ($degreeName=='bachelor' || $degreeName=='master') && $doc36Name==''){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Messina (UM)' && ($degreeName=='bachelor' || $degreeName=='master') && ($doc12Name=='' || $doc36Name=='')){
							$disButton = 'disabled';
						}
						elseif($uniName=='University of Cassino (CS)' && ($degreeName=='bachelor') && $doc12Name==''){
							$disButton = 'disabled';
						}
						// elseif($uniName=='University of Pavia (PV)' && ($degreeName=='bachelor') && $doc12Name==''){
						// 	$disButton = 'disabled';
						// }
						elseif(($uniName=='University of Bologna (UBN)' && $degreeName=='master' && (strpos($programName, 'Physics') === false ) ) && $doc12Name==''){
							$disButton = 'disabled';
						}
						elseif(($uniName=='University of Florence (UF)' || $uniName=='University of Palermo (PLM)') && $degreeName=='master' && $doc8Name==''){
							$disButton = 'disabled';
						}
						elseif(($uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)') && $degreeName=='bachelor' && $doc12Name==''){
							$disButton = 'disabled';
						}
						?>
						<?php $btnDreamClass = $rowPro['italy_proof_screenshot1']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnDirectClass = $rowPro['italy_direct_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnPreClass = $rowPro['italy_pre_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $testType = 'CEnT-S'; ?>
						<?php 
						if ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php if($uniName=='University of Pavia (PV)' && $degreeName=='mbbs'){ ?>
							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a> 	
							<br>
							2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php }else{ ?>
							1. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a> 
							<?php } ?>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='0' && $rowPro['italy_cimea_status']=='0') { ?>
							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a> 
							<br>
							2. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-2" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }

						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<?php 
							if (stripos($programJSONName, 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
								2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($programJSONName, 'Social Sciences for Global Challenges') !== false || stripos($programJSONName, 'Philosophy International And Economics Studies') !== false || stripos($programJSONName, 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>

						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($programJSONName, 'Global Humanities') !== false) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php }else{?>
							1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<br>
							<?php $disabled = ($rowPro['italy_tolc_pass_screenshot'] == '') ? 'disabled' : ''; ?>
							2. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" <?php echo $disButton;?> <?php echo $disabled;?> data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='1') { ?>

							1. <a href="cimea-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-warning btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Cimea Apply"><i class="mdi mdi-alpha-c-circle"></i> Cimea</button></a>
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
						
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='1' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<br>
							<?php if($rowPro['italy_direct_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='1' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>

							<?php 
							if (stripos($programJSONName, 'Social Sciences for Global Challenges') !== false || stripos($programJSONName, 'Philosophy International And Economics Studies') !== false || stripos($programJSONName, 'Philosophy International and Economic Studies') !== false ) { ?>
								<span data-toggle="tooltip" data-placement="top" title="TOLC Not Required" class="badge bg-primary pt-1 pb-1">TOLC Not Required</span>
								<br>
								<a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>

							<?php }else{ ?>
								1. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
								<br>
								<?php $btnDreamDisable = $rowPro['italy_tolc_pass_screenshot']=='' ? 'disabled' : 'btn-outline-primary'; ?>
								2. <a href="dream-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button <?php echo $btnDreamDisable;?> style="width: 120px;" type="button" class="btn <?php echo $btnDreamClass;?> btn-sm mt-1" <?php echo $disButton;?> data-toggle="tooltip" data-placement="top" title="Dream Apply"><i class="mdi mdi-information"></i> Dream A.</button></a>
							<?php } ?>
							<br>
							<a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn <?php echo $btnPreClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>

						<?php }
						
						elseif ($rowPro['italy_direct_pre']=='1' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='2' && $rowPro['italy_cimea_status']=='0') { ?>

							1. <a href="direct-pre-enrollment-apply?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Pre Enrollment Apply"><i class="mdi mdi-information"></i> Pre E.</button></a>
							<br>
							<?php if($rowPro['italy_pre_proof_screenshot']!=''){ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. Tolc</button></a>
							<?php }else{ ?>
								2. <a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>" disabled=""><button style="width: 120px;" type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" disabled=""><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
							<?php } ?>
							
						<?php }
						
						elseif ($rowPro['italy_direct_pre']=='0' && $rowPro['italy_dream_id']=='0' && $rowPro['italy_direct_apply']=='0' && $rowPro['italy_tolc_status']=='1' && $rowPro['italy_cimea_status']=='0') { ?>
							<a href="register-CEnT-S?program-applied-id=<?php echo $rowPro['italy_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 120px;" type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Register <?= $testType ?> Test" ><i class="mdi mdi-registered-trademark"></i> R. <?= $testType ?></button></a>
						<?php }
						?>
						<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Change the Program" onclick="changeProgram(<?php echo $clientID;?>, <?php echo $rowPro['italy_client_pro_id']; ?>);"><i class="mdi mdi-stack-exchange"></i></button>
						</td>

						<td style="<?php echo $backgroundStyle;?>">
							<?php 
							foreach ($decoded as $key => $programJSONName1) {
								$select_query = "SELECT italy_ad_sop_required from italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_program_name='".$programJSONName1."' AND italy_ad_sop_required='1'";
								$select_query_ex = mysqli_query($con,$select_query);
								$sopRow = mysqli_fetch_assoc($select_query_ex);
								if ($sopRow && isset($sopRow['italy_ad_sop_required'])) {
									$sopRequiredORNot = $sopRow['italy_ad_sop_required'];
									if ($sopRequiredORNot == '1') {
										break;
									}
								}else{
									$sopRequiredORNot = 0;
								}
							}
							if($sopRequiredORNot=='1'){
							?>
							<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['italy_change_program_status']=='1') ? "disabled" : '';?> class="btn <?php echo $rowPro['italy_sops_assign_to']!='0' ? "btn-success" : 'btn-outline-primary';?> btn-sm" data-toggle="tooltip" data-placement="top" title="Assign this SOP's To Team / View SOP's of this Program/University" onclick="assignSOP(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-reply-all"></i> SOP's</button>
							<br>
							<span data-toggle="tooltip" data-placement="top" title="SOP's Required for this University" class="badge bg-danger pt-1 pb-1 mt-1">SOP's Required </span>
							<?php }else{ ?>
							<span data-toggle="tooltip" data-placement="top" title="No SOP's Required for this University" class="badge bg-primary pt-1 pb-1">No SOP's Required </span>
							<?php } ?>
						</td>
						<td class="ellipsis" style="<?php echo $backgroundStyle;?>">
						<?php 
						$uniDetails = "SELECT italy_uni_deadline_link FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_name='".$uniName."' ";
						$uniDetails_ex = mysqli_query($con, $uniDetails);
						$addRow = mysqli_fetch_assoc($uniDetails_ex);
						if($addRow){
						?>
						<a class="btn btn-purple btn-sm" href="<?php echo $addRow['italy_uni_deadline_link'];?>" target="_blank">Deadline Link</a>
						<?php } ?>

						<br>
						<?php 
						$currentDate = date('Y-m-d');
						$dateStatus='';
						$selectQuery = "SELECT * from italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='".$uniName."' AND italy_degree_name='".$degreeName."' ORDER BY italy_dates_id DESC LIMIT 1 ";
						$selectQuery_ex = mysqli_query($con,$selectQuery);
						foreach ($selectQuery_ex as $dateRow) {
							$dateStatus = $dateRow['italy_date_status'];
							$openingDate = $dateRow['italy_opening_date'];
							$closingDate = $dateRow['italy_closing_date'];
						}
						if($dateStatus=='1' && $currentDate>=$openingDate && $currentDate <= $closingDate){ ?>
							<button type="button" class="btn btn-success btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						elseif($dateStatus=='1' && $currentDate<$openingDate && $currentDate<$closingDate){ ?>
							<button type="button" class="btn btn-warning btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						elseif($dateStatus=='2'){ ?>
							<button type="button" class="btn btn-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						else{ ?>
							<button type="button" class="btn btn-outline-dark btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php } ?>
							
						<button type="button" class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Delete University" onclick="deleteUniversity(<?php echo $rowPro['italy_client_pro_id'];?>);"><i class="mdi mdi-trash-can"></i></button>
						<br>
						<?php
						if($rowPro['italy_close_file']!=''){
							$fileMulti = explode(',', $rowPro['italy_close_file']);
							foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
							<?php } ?>
							<br>
						<?php
						} 
						$noteDel = $rowPro['italy_close_note'];
						$cleanText = strip_tags($noteDel);
						?>
						<span data-toggle="tooltip" data-placement="top" title="<?php echo $cleanText;?>"><?php echo $rowPro['italy_close_note'];?></span>
						</td>
					</tr>
					<?php $sr++; } ?>
				</tbody>
			</table>
		</div>
		<?php }else{ ?>
		<div class="alert alert-danger">
			<h5>Client Not Found</h5>
		</div>
		<?php } ?>
	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
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
				url: "models/_applyAssignControllersState.php",
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
	// Assign Program to team
	function assignProgram(idPro) {
		var idPro = idPro;
		// alert(idPro);
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'programAssign='+idPro,
			success: function(data){
				$(".showModalTitle").html('Assign Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// University Opening closeing Date
	function uniOpenCloseDate(idPro) {
		var idPro = idPro;
		var degreeID = $("#degreeID").val();
		$.ajax({
			type: "POST",
			url: "models/sopsState.php",
			data: {
				degreeID:degreeID,
				openingClosingDate:idPro,
			},
			success: function(data){
				$(".showModalTitle").html('Opening Closing Date');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//del client
	function delSOPs(idSops) {
		var idSops = idSops;
		$.ajax({
			type:"POST",
			url:"models/sopsState.php",
			data: 'SopsDelete='+idSops,
			success:function(data) {
				var rowh = "#"+idSops;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then((result) => {
					window.location.reload();
				});
			}
		});
	};
	// Assign SOPs to team
	function assignSOP(idPro) {
		var idPro = idPro;
		// alert(idPro);
		$.ajax({
			type: "POST",
			url: "models/sopsState.php",
			data:'sopsAssign='+idPro,
			success: function(data){
				$(".showModalTitle").html('SOPs Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
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
	function validateNumberInput(input) {
		// Remove non-numeric characters, excluding 'e'
		input.value = input.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
	}
	function delC(idPro) {
		var idPro = idPro;
		$.ajax({
			type:"POST",
			url:"getState.php",
			data: 'delAssignPrograms='+idPro,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then((result) => {
					window.location.reload();
				});
			}
		});
	};
</script>

<script type="text/javascript">
	function addNewUni(id, idPro){
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{
				clientNewID:id,
				italyProgramChange:idPro,
			},
			success: function(data){
				$(".showModalChanTitle").html('Add University Program');
				$(".showModalChanClient").html(data);
				$("#showModalChanClient").modal('show');
			}
		});
	};
	// change Program
	function changeProgram(id, idPro) {
		$.ajax({
			type:"POST",
			url:"models/addProgramState.php",
			data: {
				clientNewID:id,
				italyProgramChange:idPro,
			},
			success:function(data) {
				$(".showModalChanTitle").html('Change Program');
				$(".showModalChanClient").html(data);
				$("#showModalChanClient").modal('show');
			}
		});
	};
	// Delete University
	function deleteUniversity(id){
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{
				delUniPrograms:id,
			},
			success: function(data){
				$(".showModalChanTitle").html('Delete University Program');
				$(".showModalChanClient").html(data);
				$("#showModalChanClient").modal('show');
				$('#showModalChanClient').off('shown.bs.modal').on('shown.bs.modal', function () {
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
	function checkDelPassword(){
		var passID = $("#delUniPassword").val();
		if(passID=='EnterDelUni$#!'){
			$("#delUniBtn").prop('disabled', false);
		}
		else{
			$("#delUniBtn").prop('disabled', true);
		}
	}

	// Dynamically Uni related program shown
	function setUniProgram(nameUni, degtype, dispId, fatchTab, uniColName, degColName, progColName, progColStatus){
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{checkUniName: nameUni,
				checktypeDeg: degtype,
				checkTable: fatchTab,
				checkUniCol: uniColName,
				checkdegCol: degColName,
				checkprogCol: progColName,
				checkprogStatus: progColStatus
			},
			success: function(data){
				$("#"+dispId).html(data);
				showSelectProgram(nameUni, degtype, dispId, fatchTab);
			}
		});
	}

	function showSelectProgram(nameUni, degtype, dispId, fatchTab){
		var dbNo = "<?php echo $_SESSION['dbNo']; ?>";
		var uniTable = '';
		var uniNameCol = '';
		var degreeNameCol = '';
		var uniProgramCol = '';
		if(fatchTab=='italy_add_programs_details'+dbNo){
			uniTable='italy_add_universities'+dbNo;
			uniNameCol='italy_uni_name';
			degreeNameCol='italy_uni_degree';
			uniProgSelectCol='italy_uni_program_select';
			uniProgramCol='italy_uni_program_apply';
		}
		else if(fatchTab=='czech_add_programs_details'+dbNo){
			uniTable='czech_add_universities'+dbNo;
			uniNameCol='czech_uni_name';
			degreeNameCol='czech_uni_degree';
			uniProgSelectCol='czech_uni_program_select';
			uniProgramCol='czech_uni_program_apply';
		}
		
		else if(fatchTab=='austria_add_programs_details'+dbNo){
			uniTable='austria_add_universities'+dbNo;
			uniNameCol='aus_uni_name';
			degreeNameCol='aus_uni_degree';
			uniProgSelectCol='aus_uni_program_select';
			uniProgramCol='aus_uni_program_apply';
		}
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{
				checkuniSelectName: nameUni,
				checkdegreeNameCol: degreeNameCol,
				checkunidegtype: degtype,
				checkuniTable: uniTable,
				checkuniNameCol: uniNameCol,
				checkuniProgSelectCol: uniProgSelectCol,
				checkuniProgramCol: uniProgramCol
			},
			success: function(data){
				$("#apply" + dispId).html('<span class="badge bg-danger" id="blink">'+data+'</span>');
				toggleSelectMultiple(data, dispId);
			}
		});
	};

	function toggleSelectMultiple(data, dispId) {
		let maxSelection = 1;
		let message = "You can select only 1 program";
		if (data === '2 Program // Apply for both programs together') {
			maxSelection = 2;
			message = "You can select up to 2 programs";
		}
		$('[data-toggle="select3"]').select2('destroy').select2({
			maximumSelectionLength: maxSelection,
			language: {
				maximumSelected: function (args) {
					return message;
				}
			}
		});
	}

	function checkCGPAProgram(programName, uniID, showCGPAID, degreeName, dbTable, uniColName, degColName, progColName, cgpaColName, degAcceptCol, showDegAcceptID, alrdycgpid, admorebtn, nomatchdegID) {
		var uniName = $("#" + uniID).val();
		var clientID = $("#clientIDGET").val();
		var cldegtype = $("#getclientdeg").val();
		var selectedPrograms = $(programName).val();
		$("#" + showCGPAID).empty();
		$("#" + showDegAcceptID).empty();
		$("#" + admorebtn).prop("disabled", false);
		$('#' + alrdycgpid).empty();

		let cgpaError = false;
		let degreeError = false;

		let totalPrograms = selectedPrograms.length;
		let completedCGPAChecks = 0;

		function updateButtonState() {
			if (cgpaError || degreeError) {
				$("#" + admorebtn).prop("disabled", true);
			} else {
				$("#" + admorebtn).prop("disabled", false);
			}
		}

		selectedPrograms.forEach(function (proName, index) {

			let inputID = showCGPAID + "_input_" + index;
			let inputID2 = showDegAcceptID + "_input_" + index;
			// ----------- 1) CHECK CGPA -------------
			$.ajax({
				type: "POST",
				url: "models/addProgramState.php",
				data: {
					checkuniName: uniName,
					checkproName: proName,
					checkdegreeName: degreeName,
					checkclientID: clientID,
					checkdbTable: dbTable,
					checkuniColName: uniColName,
					checkdegColName: degColName,
					checkprogColName: progColName,
					checkcgpaColName: cgpaColName,
				},
				success: function (rep) {
					if (rep.trim() !== "yes") {
						cgpaError = true;
					}
					completedCGPAChecks++;
					if (completedCGPAChecks === totalPrograms) {
						if (cgpaError) {
							$("#" + alrdycgpid).html(
								"<div class='alert alert-danger' id='blink' style='text-align:center;'>Client's <strong>CGPA</strong> does not meet <strong>University Requirements</strong>!</div>"
								);
						} else {
							$("#" + alrdycgpid).empty();
						}
						updateButtonState();
					}
				}
			});
			// ----------- 2) GET CGPA VALUE -----------
			$.ajax({
				type: "POST",
				url: "models/addProgramState.php",
				data: {
					checkCGPAuniName: uniName,
					checkCGPAproName: proName,
					checkCGPAdegreeName: degreeName,
					checkdbTable: dbTable,
					checkuniColName: uniColName,
					checkdegColName: degColName,
					checkprogColName: progColName,
					checkcgpaColName: cgpaColName
				},
				success: function (data) {
					$("#" + showCGPAID).append(
						`<input type="text" readonly class="form-control" id="${inputID}" value="${data}"> `
						);
				}
			});
			// ----------- 3) GET DEG ACCEPT VALUE ----------
			$.ajax({
				type: "POST",
				url: "models/addProgramState.php",
				data: {
					checkDeguniName: uniName,
					checkDegproName: proName,
					checkDegdegreeName: degreeName,
					checkdbTable: dbTable,
					checkuniColName: uniColName,
					checkdegColName: degColName,
					checkprogColName: progColName,
					checkDegColName: degAcceptCol
				},
				success: function (data) {
					$("#" + showDegAcceptID).append(
						`<input type="text" readonly class="form-control" id="${inputID2}" value="${data}"> `
						);
				}
			});
			// ----------- 4) CHECK DEGREE MATCH -----------
			$.ajax({
				type: "POST",
				url: "models/addProgramState.php",
				data: {
					check1uniName: uniName,
					check1proName: proName,
					check1degreeName: degreeName,
					check1dbTable: dbTable,
					check1uniColName: uniColName,
					check1degColName: degColName,
					check1progColName: progColName,
					check1DegAcptColName: degAcceptCol,
					check1cldegtype: cldegtype
				},
				success: function (data) {
					if (data.trim() === "success") {
						$('#' + nomatchdegID).empty();
					}
					if (data.trim() === "error") {
						degreeError = true; 
						$('#' + nomatchdegID).html(
							"<div class='alert alert-danger' id='blink' style='text-align:center;'>Client's <strong>Degree</strong> does not meet <strong>University Requirement</strong>!</div>"
							);
					}
					updateButtonState();
				}
			});

		});
	}

	// Direct dream pre enrollment
	function checkOtherItalyMasterUni() {
		var selectedOption = $("#uniOtherItalyNameMast option:selected");
		var itlydirectid = selectedOption.data("itdirect-id");
		var itlydirpreid = selectedOption.data("dirpre-id");
		var itlydreamid = selectedOption.data("dream-id");
		$("#uniDirectApplyMast").val(itlydirectid);
		$("#unidirectPreMast").val(itlydirpreid);
		$("#unidreamIDMast").val(itlydreamid);
	}
	// Direct dream pre enrollment
	function checkOtherItalyUni() {
		var selectedOption = $("#uniOtherItalyName option:selected");
		var itlydirectid = selectedOption.data("itdirect-id");
		var itlydirpreid = selectedOption.data("dirpre-id");
		var itlydreamid = selectedOption.data("dream-id");
		$("#uniDirectApply").val(itlydirectid);
		$("#unidirectPre").val(itlydirpreid);
		$("#unidreamID").val(itlydreamid);
	}
	// Direct dream pre enrollment
	function checkOtherMBBSUni() {
		var selectedOption = $("#uniOtherMBBSName option:selected");
		var itlydirectid = selectedOption.data("itdirect-id");
		var itlydirpreid = selectedOption.data("dirpre-id");
		var itlydreamid = selectedOption.data("dream-id");
		$("#uniDirApplyMbbs").val(itlydirectid);
		$("#unidirPreMbbs").val(itlydirpreid);
		$("#unidreamIDMbbs").val(itlydreamid);
	}
	function uploadApproveFile() {
		var programApproveID = $("#programApproveID").val();
		if (programApproveID!='') {
			if (programApproveID!='') {
				$('#submitBtn').prop('disabled', false);
				$('#already-cgpa').empty();
			}else{
				$('#submitBtn').prop('disabled', true);
				$('#already-cgpa').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
			}
		}
	}
	function uploadMastApproveFile() {
		var programApproveIDMast = $("#programApproveIDMast").val();
		if (programApproveIDMast!='') {
			if (programApproveIDMast!='') {
				$('#submitMastBtn').attr('disabled', false);
				$('#already-cgpaMast').empty();
				$('#degnot_matchMast').empty();
			}else{
				$('#submitMastBtn').attr('disabled', true);
				$('#already-cgpaMast').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
			}
		}
	}
	function uploadMBBSApproveFile() {
		var programMBBSApproveID = $("#programMBBSApproveID").val();
		if (programMBBSApproveID!='') {
			if (programMBBSApproveID!='') {
				$('#submitMBBSBtn').attr('disabled', false);
				$('#already-cgpambbs').empty();
			}else{
				$('#submitMBBSBtn').attr('disabled', true);
				$('#already-cgpambbs').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
			}
		}
	}
	// Program add Through AJAX
	function savePrograms(btnID, formID) {
		let $form = $("#"+formID);
		let $btn = $("#"+btnID);
		if ($form.parsley().validate()) {
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append("subProgram", 1);
			$.ajax({
				url: "models/_applyAssignControllersState.php",
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
					$btn.prop("disabled", false).text("Save Program");
				},
				error: function (xhr, status, error) {
					Swal.fire("Error", "Something went wrong: " + error, "error");
					$btn.prop("disabled", false).text("Save Program");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields",
				icon: "warning"
			});
		}
	}
	function saveMastPrograms(btnID, formID) {
		savePrograms(btnID, formID)
	}
	function saveMBBSPrograms(btnID, formID) {
		savePrograms(btnID, formID)
	}
</script>