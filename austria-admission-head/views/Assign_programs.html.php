<?php 
$clientID = $_GET['client-id'];
$uniName = $_GET['university-name'];
?>
<div class="card">
	<div class="card-body">
		<input type="hidden" name="" id="clientUpdateID" value="<?php echo $clientID;?>">
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
			<h5><?php if($uniName=='all'){echo "All Clients";}else{echo $uniName;}?> >> Assign Programs</h5>
		</div>
		<?php 
		include ("components/ClientQueryData.php");
		include ("components/SaleNote.php");

		$getUrl = base64_encode($clientName."".$clientEmail."".$changingApplied);
		?>
		<input type="hidden" name="" id="clientUpdateID" value="<?php echo $clientID;?>">
		<input type="hidden" name="" value="<?php echo $appRow;?>" id="clientDegree">
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="top" title="Add New University" onclick="addNewUni(<?php echo $clientID;?>);"> <i class="mdi mdi-alpha-a-circle"></i> Add New University</button>
			</div>
		</div>

		<!-- Datatable -->
		<div class="table-responsive mt-1">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 20px;">Sr</th>
						<th style="width: 220px;">University</th>
						<th style="width: 200px;">Program</th>
						<th style="width: 100px;">Intake</th>
						<th style="width: 50px;" data-toggle="tooltip" data-placement="top" title="Program CGPA">CGPA</th>
						<th style="width: 50px;" data-toggle="tooltip" data-placement="top" title="Client CGPA">CGPA</th>
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
					if ($uniName=='all') {
					 	$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND (close='1' || close='0') AND aus_clients_id='".$clientID."' ORDER BY aus_assign_status ASC";
						$select_query_ex = mysqli_query($con,$select_query);
					}else{
						$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status='1' AND (close='1' || close='0') AND aus_clients_id='".$clientID."' AND aus_university_name='".$uniName."' ORDER BY aus_assign_status ASC ";
						$select_query_ex = mysqli_query($con,$select_query);
					}
					foreach ($select_query_ex as $rowPro) {
						$wtID = $rowPro['aus_program_assign'];
						$uniName = $rowPro['aus_university_name'];
						$degreeName = $rowPro['aus_client_degree'];
						$degreeID = $appRow;
						$backgroundStyle = $rowPro['aus_assign_status'] == 1 ? 'background: #D7FFF1; color: #000;' : '';
					?>
					<tr id="<?php echo $rowPro['aus_client_pro_id'];?>">
						<td style="<?php echo $backgroundStyle; ?>">
							<?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "<del>$sr</del>" : $sr; ?>
						</td>
						<td style="<?php echo $backgroundStyle; ?>" class="breakTD">
							<?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "<del>" . ucwords($rowPro['aus_university_name']) . "</del>" : ucwords($rowPro['aus_university_name']); ?>
						</td>
						<td style="<?php echo $backgroundStyle; ?>" class="breakTD text-left">
							<?php 
							$programName = $rowPro['aus_program_name'];
							$changedProgramName = $rowPro['aus_change_program_name'] ? "<br>" . ucwords($rowPro['aus_change_program_name']) : '';
							if (empty($programName)) {
								echo $changedProgramName;
							} else {
								$decoded = json_decode($programName, true);
								if (is_array($decoded)) {
									$output = '';
									foreach ($decoded as $key => $name) {
										$programJSONName = $name;
										$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
									}
									echo ($rowPro['close'] == '0' || $rowPro['aus_change_program_status'] == '1') 
									? "<del>$output</del>$changedProgramName" 
									: ($changedProgramName ? "<del>$output</del>$changedProgramName" : $output);
								} else {
									$programJSONName = $programName;
									echo ($rowPro['close'] == '0' || $rowPro['aus_change_program_status'] == '1') 
									? "<del>" . ucwords($programName) . "</del>$changedProgramName" 
									: ($changedProgramName ? "<del>" . ucwords($programName) . "</del>$changedProgramName" : ucwords($programName));
								}
							}
							?>
						</td>
						<td style="<?php echo $backgroundStyle; ?>">
							<?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "<del>".ucwords($rowPro['aus_intake'])."</del>" : ucwords($rowPro['aus_intake']);?>
						</td>

						<td class="bg-warning text-white">
							<strong>
							<?php
							$allProgramCGPAs = [];
							if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
								foreach ($decoded as $programName){
									$cgpaQuery = "SELECT aus_ad_cgpa from austria_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_ad_uni_name='".$uniName."' AND aus_ad_degree='".$degreeName."' AND aus_ad_program_name='".$programName."' ";
									$cgpaQuery_ex = mysqli_query($con,$cgpaQuery);
									if ($cgpaQuery_ex && mysqli_num_rows($cgpaQuery_ex) > 0) {
										foreach ($cgpaQuery_ex as $proRow) {
											$programCGPA = $proRow['aus_ad_cgpa'];
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
									if($clientInterPercentage!='' && ($appRow=='bachelor' || $appRow=='mbbs')){
										if($clientInterPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientInterPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage!='' && $clientPercentage2=='' && $clientInterPercentage=='' && ($appRow!='bachelor' || $appRow!='mbbs')){
										if($clientPercentage < $uniWiseCGPA){
											$cgpaClass = 'bg-danger';
											break;
										}
										if($clientPercentage >= $uniWiseCGPA){
											$cgpaClass = 'bg-success';
										}
									}
									if($clientPercentage!='' && $clientPercentage2!=''){
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
						<?php 
						if($rowPro['aus_assign_status'] == 1) { 
							$wt_query = "SELECT fname, lname from wt_users WHERE status='1' AND close='1' AND wt_id='".$wtID."' ";
							$wt_query_ex = mysqli_query($con,$wt_query);
							foreach ($wt_query_ex as $wtrow) {
								$wtName = $wtrow['fname']." ".$wtrow['lname'];
							}
						?>
						<td class="breakTD" style="<?php echo $backgroundStyle;?>">
							<?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "<del>".ucwords($wtName)."</del>" : ucwords($wtName); ?>
							<br>
							<?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "<del>".date("d-m-Y", strtotime($rowPro['aus_program_assign_date']))."</del>" : date("d-m-Y", strtotime($rowPro['aus_program_assign_date']));?></td>
						<?php }else{ ?>
						<td></td>
						<?php } ?>
						<td style="<?php echo $backgroundStyle;?>">
							<?php if($rowPro['aus_assign_status'] == 1) { ?>
								<button style="width: 130px" type="button" <?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Assign this Program To Team" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-check-circle"></i> Assigned</button>
								<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }elseif($rowPro['aus_change_program_status'] == 1) { ?>
								<button type="button" disabled="" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign this Program To Team" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-reply-all"></i> Not Assign</button>

								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-trash-can"></i></button>

							<?php }else{
							$currentDate = date('Y-m-d');
							$dateStatus='';
							$selectQuery = "SELECT * from austria_university_dates WHERE status='1' AND close='1' AND aus_university_name ='".$uniName."' AND aus_degree_name='".$degreeID."' ORDER BY aus_dates_id DESC LIMIT 1 ";
							$selectQuery_ex = mysqli_query($con,$selectQuery);
							foreach ($selectQuery_ex as $dateRow) {
								$dateStatus = $dateRow['aus_date_status'];
								$openingDate = $dateRow['aus_opening_date'];
								$closingDate = $dateRow['aus_closing_date'];
							}
							$clientData = "SELECT admission_doc12, admission_doc36 FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
							$clientData_ex = mysqli_query($con, $clientData);
							$rowDoc = mysqli_fetch_assoc($clientData_ex);
							$doc12Name = $rowDoc['admission_doc12'];
							$doc36Name = $rowDoc['admission_doc36'];

							if($dateStatus=='1' && $currentDate>=$openingDate && $currentDate <= $closingDate){ ?>
								<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are open Assign the Program" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }elseif($dateStatus=='2'){ ?>
								<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are closed please Check the deadline link" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC<?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }elseif($dateStatus=='1' && $currentDate<$openingDate && $currentDate < $closingDate){ ?>
								<button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are open Assign the Program" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }else{ ?>
								<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Admission are closed please Check the deadline link" onclick="assignProgram(<?php echo $rowPro['aus_client_pro_id'];?>);" disabled=""><i class="mdi mdi-reply-all"></i> Not Assign</button>
								<button type="button" disabled="" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Assign Program" onclick="del(delC, <?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
							<?php }
							} ?>
						<br>
						<?php 
						$uniQuery = "SELECT aus_uni_direct_apply, aus_uni_courier_apply from austria_add_universities".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND aus_uni_name='".$rowPro['aus_university_name']."' AND aus_uni_degree='".$rowPro['aus_client_degree']."' ";
						$uniQuery_ex = mysqli_query($con,$uniQuery);
						$uniApplyRow = mysqli_fetch_assoc($uniQuery_ex);
						?>
						<?php $btnCourierClass = $rowPro['aus_courier_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; ?>
						<?php $btnDirectClass = $rowPro['aus_direct_proof_screenshot']!='' ? 'btn-success' : 'btn-outline-primary'; 
						if ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='0') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
						<?php }
						elseif ($uniApplyRow['aus_uni_direct_apply']=='0' && $uniApplyRow['aus_uni_courier_apply']=='1' ) { ?>
							<a href="courier-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnCourierClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Courier Apply"><i class="mdi mdi-information"></i> Courier A.</button></a>
						<?php }
						elseif ($uniApplyRow['aus_uni_direct_apply']=='1' && $uniApplyRow['aus_uni_courier_apply']=='1') { ?>
							<a href="direct-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnDirectClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Direct Apply"><i class="mdi mdi-information"></i> Direct A.</button></a>
							<br>
							<a href="courier-apply?program-applied-id=<?php echo $rowPro['aus_client_pro_id'];?>&<?php echo $getUrl;?>"><button style="width: 130px;" type="button" class="btn <?php echo $btnCourierClass;?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Courier Apply"><i class="mdi mdi-information"></i> Courier A.</button></a>
						<?php } ?>
						<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-outline-danger btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Change the Program" onclick="changeProgram(<?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-stack-exchange"></i></button>
						</td>

						<td style="<?php echo $backgroundStyle;?>">
						<?php 
							$select_query = "SELECT aus_ad_sop_required from austria_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_ad_uni_name='".$uniName."' AND aus_ad_degree='".$degreeName."' AND aus_ad_program_name='".$programJSONName."' ";
							$select_query_ex = mysqli_query($con,$select_query);
							$sopRow = mysqli_fetch_assoc($select_query_ex);
							$sopRequiredORNot = $sopRow['aus_ad_sop_required'] ?? '';
							if($sopRequiredORNot=='1'){
							?>
							<button type="button" <?php echo ($rowPro['close']=='0' || $rowPro['aus_change_program_status']=='1') ? "disabled" : '';?> class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Assign this SOP's To Team / View SOP's of this Program/University" onclick="assignSOP(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-reply-all"></i> SOP's</button>
							<br>
							<span data-toggle="tooltip" data-placement="top" title="SOP's Required for this University" class="badge bg-danger pt-1 pb-1 mt-1">SOP's Required </span>
							<?php }else{ ?>
							<span data-toggle="tooltip" data-placement="top" title="No SOP's Required for this University" class="badge bg-primary pt-1 pb-1">No SOP's Required </span>
							<?php } ?>
						</td>
						<td class="ellipsis" style="<?php echo $backgroundStyle;?>">
						<?php 
						$uniDetails = "SELECT aus_uni_deadline_link FROM austria_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND aus_uni_name='".$uniName."' ";
						$uniDetails_ex = mysqli_query($con, $uniDetails);
						$addRow = mysqli_fetch_assoc($uniDetails_ex);
						if($addRow){
						?>
						<a class="btn btn-purple btn-sm mb-1" href="<?php echo $addRow['aus_uni_deadline_link'];?>" target="_blank">Deadline Link</a><br>
						
						<?php
						}
						$currentDate = date('Y-m-d');
						$dateStatus='';
						$selectQuery = "SELECT * from austria_university_dates WHERE status='1' AND close='1' AND aus_university_name ='".$uniName."' AND aus_degree_name='".$degreeID."' ORDER BY aus_dates_id DESC LIMIT 1 ";
						$selectQuery_ex = mysqli_query($con,$selectQuery);
						foreach ($selectQuery_ex as $dateRow) {
							$dateStatus = $dateRow['aus_date_status'];
							$openingDate = $dateRow['aus_opening_date'];
							$closingDate = $dateRow['aus_closing_date'];
						}
						if($dateStatus=='1' && $currentDate>=$openingDate && $currentDate <= $closingDate){ ?>
							<button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						elseif($dateStatus=='1' && $currentDate<$openingDate && $currentDate<$closingDate){ ?>
							<button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						elseif($dateStatus=='2'){ ?>
							<button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php }
						else{ ?>
							<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Add University Opening And Closing Date" onclick="uniOpenCloseDate(<?php echo $rowPro['aus_client_pro_id'];?>);"><i class="mdi mdi-alpha-c-circle-outline"></i></button>
						<?php } ?>
						<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Program" onclick="deleteUniversity(<?php echo $rowPro['aus_client_pro_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
						<br>
						<?php
						if($rowPro['aus_close_file']!=''){
							$fileMulti = explode(',', $rowPro['aus_close_file']);
							foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
							<?php } ?>
							<br>
						<?php
						} 
						$noteDel = $rowPro['aus_close_note'];
						$cleanText = strip_tags($noteDel);
						?>
						<span data-toggle="tooltip" data-placement="top" title="<?php echo $cleanText;?>"><?php echo $rowPro['aus_close_note'];?></span>
						</td>
					</tr>
					<?php $sr++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	// Application accepted or Rejection
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
				url: "models/_applyProgramsControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					Swal.fire({
						title: "Uploaded",
						text: 'Record Uploaded successfully',
						icon: "success"
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

	// Czech Add program function
	function austriaProgram() {
		var c = $("#showCzech tr").length;
		var appliedName = $("#appliedNameID").val();
		var options = `<option selected value disabled class='text-center'>--- Select University ---</option>`;
		options += $(`#cze${appliedName}Universities`).html();

		var row = `<tr id="row${c}">
            <td>
                <div class="form-group col-md-12">
                    <select class="form-control" data-toggle="select2" name="uniName[]" autocomplete="off" required="required" onchange="setUniProgram(this.value, '${appliedName}', 'showuniReltProg${c}', 'austria_add_programs_details', 'aus_ad_uni_name', 'aus_ad_degree', 'aus_ad_program_name')" id="uniOtherCzechName${c}">
                        ${options}
                    </select>
                </div>
            </td>
            <td>
			<div id="applyshowuniReltProg${c}"></div>
                <div class="col-md-12">
                    <select class="form-control" data-toggle="select3" multiple name="programName[${c}][]" autocomplete="off" required="required" id="showuniReltProg${c}">
                        <option value="" disabled class="text-center">--- Select Program ---</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="col-md-12">
                    <input type="text" name="intakeName[]" class="form-control" autocomplete="off" placeholder="Enter intake">
                </div>
            </td>
            <td>
                <button class="btn btn-outline-danger del-btn" type="button" onclick="delRow(${c});">
                    <i class="mdi mdi-trash-can"></i>
                </button>
            </td>
		</tr>`;
		$("#showCzech").append(row);
		$('[data-toggle="select2"]').select2();
		$('[data-toggle="select3"]').select2();
		c++;
	}
	function delRow(id) {
		$("#row" + id).remove();
		$("#showCzech tr").each((i, row) => {
			const $r = $(row);
			$r.attr("id", `row${i}`);
			$r.find("[id], [name], .del-btn").each((_, el) => {
				const $el = $(el);
				if ($el.attr("id")) {
					$el.attr("id", $el.attr("id").replace(/\d+$/, i));
				}
				if ($el.attr("name")) {
					$el.attr("name", $el.attr("name").replace(/\[\d+\]/, `[${i}]`));
				}
				if ($el.is(".del-btn")) {
					$el.attr("onclick", `delRow(${i})`);
				}
			});
		});
	}
</script>

<script type="text/javascript">
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
				);setTimeout(function () {
					window.location.reload();
				}, 2000);
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
	}

	function addNewUni(id){
		var id = id;
		var degree = $("#clientDegree").val();
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{
				clientID:id,
				clientDegree:degree
			},
			success: function(data){
				$(".showModalTitle").html('Add University Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}
		// change Program
	function changeProgram(idPro) {
		var idPro = idPro;
		var clientUpdateID = $("#clientUpdateID").val();
		var clientDegree = $("#clientDegree").val();
		$.ajax({
			type:"POST",
			url:"models/addProgramState.php",
			data: {
				czechProgramChange:idPro,
				clientUpdateID:clientUpdateID,
				clientDegree:clientDegree
			},
			success:function(data) {
				$(".showModalTitle").html('Change Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	}

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
	}	
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
	function setUniProgram(nameUni, degtype, dispId, fatchTab, uniColName, degColName, progColName){
		$.ajax({
			type: "POST",
			url: "models/addProgramState.php",
			data:{checkUniName: nameUni,
				checktypeDeg: degtype,
				checkTable: fatchTab,
				checkUniCol: uniColName,
				checkdegCol: degColName,
				checkprogCol: progColName
			},
			success: function(data){
				$("#"+dispId).html(data);
				showSelectProgram(nameUni, degtype, dispId, fatchTab);
			}
		});
	}
	function showSelectProgram(nameUni, degtype, dispId, fatchTab){
		var uniTable = '';
		var uniNameCol = '';
		var degreeNameCol = '';
		var uniProgramCol = '';
		if(fatchTab=='austria_add_programs_details'){
			uniTable='austria_add_universities';
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
				// Handle select2 max selection here
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
		});
	};

</script>