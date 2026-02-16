<?php 
$clientID = $_GET['client-id'];

$select_query="SELECT client_country, client_name, client_email, client_whatapp, client_embassy, client_applied, client_process_status, client_countryfrom, client_self_acceptance_file from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);

$countryName = $row['client_country'];
$clientFrom = $row['client_countryfrom'];
$clientName = $row['client_name'];
$clientEmail = $row['client_email'];
$clientWhatApp = $row['client_whatapp'];
$clientEmbassy = $row['client_embassy'];
$clientProcess = $row['client_process_status'];
$clientSelfAcceptance = $row['client_self_acceptance_file'];

$changingApplied = $row['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

$getUrl = base64_encode($row['client_name']."".$row['client_whatapp']);
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Email: <b><?php echo $clientEmail;?></b> </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
				</div>
			</div>
		</div>
		<input type="hidden" name="" value="<?php echo $clientEmbassy;?>" id="clientEmbassy">
		<input type="hidden" name="" value="<?php echo $countryName;?>" id="countryName">
		<input type="hidden" name="" value="<?php echo $appRow;?>" id="clientApplied">
		<div class="row">
			<!-- Send Intro Message to client via Whatsapp -->
			<div class="col-md-12">
				<form id="formDataIntro" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 01 <span class="text-danger">* </span> <span><b> Send an <mark>Intro Message</mark> to the client (Send via WhatsApp) </b></span>
						</legend>
						<?php
						$introScreenShot='';
						$introNote='';
						$selectQuery = "SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_steps_name='Intro Message' AND visa_intro_checklist_client_id='".$clientID."' ";
						$selectQuery_ex = mysqli_query($con, $selectQuery);
						if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectQuery_ex);
							$introVisaID = $dataRow['visa_intro_checklist_id'];
							$introScreenShot = $dataRow['visa_intro_checklist_screenshot'];
							$introNote = $dataRow['visa_intro_checklist_note'];
							$colorStyle = $introScreenShot!='' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-12">
								<h4 style="<?php echo $colorStyle;?>">
									<span><b> Send an <mark>Intro Message</mark> to the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div id="toast" class="toast">Intro message copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm float-right ml-1" onclick="copyIntroMessage(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>

									<button type="button" data-toggle="tooltip" data-placement="top" title="View Intro Message" class="btn btn-primary btn-sm float-right" onclick="veiwIntroMessage(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Message</button>
								</h4>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="1">
									<label class="form-label">Upload ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="introMessageFile[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
								<?php 
								if($introScreenShot!=''){
								$fileMulti = explode(',', $introScreenShot);
								foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
								<?php } } ?>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="introMessageNote"><?php echo $introNote;?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updIntroMessage" onclick="saveDataForm('formDataIntro', 'updIntroMessage')" id="updIntroMessage" <?= $introScreenShot!='' ? 'disabled' : '' ?> > <i class="mdi mdi-upload"></i> Update</button>
									<?php if($introScreenShot!=''){ ?>
									<button class="btn btn-danger" type="button" onclick="del(delC,<?php echo $introVisaID;?>);"><i class="mdi mdi-trash-can"></i> </button>
									<?php } ?>
									
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Send DOV/CIMEA Checklist Via WhatsApp -->
			<div class="col-md-12">
				<form id="formDataDOVCima" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 02 <span class="text-danger">* </span> <span><b> Send <mark><?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Checklist</mark> to the client (Send via WhatsApp) </b></span>
						</legend>
						<?php
						$dovCimeaScreenShot='';
						$dovCimeaNote='';
						$selectQuery = "SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_steps_name='DOV Cimea Checklist' AND visa_intro_checklist_client_id='".$clientID."' ";
						$selectQuery_ex = mysqli_query($con, $selectQuery);
						if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectQuery_ex);
							$visaDovCimeaID = $dataRow['visa_intro_checklist_id'];
							$dovCimeaScreenShot = $dataRow['visa_intro_checklist_screenshot'];
							$dovCimeaNote = $dataRow['visa_intro_checklist_note'];
							$dovCimeaStyle = $dovCimeaScreenShot!='' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
							<div class="form-group col-md-12">
								<h4 style="<?php echo $dovCimeaStyle;?>">
									<span><b> Send <mark><?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Checklist</mark> to the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<input type="hidden" name="" value="<?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?>" id="checklistName">
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="veiwDOVCimeaList(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View <?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Checklist</button>

									<button type="button" class="btn btn-success btn-sm float-right mr-2" onclick="veiwFormats(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Formats</button>
								</h4>
								<h5>
									<?php if($clientEmbassy=='Islamabad Embassy'){ ?>
									Punjab DOV Checklist Link: <a href="https://info.wslcms.com/punjab-dov-checklist" target="_blank">info.wslcms.com/punjab-dov-checklist</a>
									<?php }elseif($clientEmbassy=='Karachi Embassy'){?>
									Sindh Cimea Checklist Link: <a href="https://info.wslcms.com/sindh-cimea-checklist" target="_blank">info.wslcms.com/sindh-cimea-checklist</a>
									<?php }elseif($clientEmbassy=='Dubai Embassy'){?>
									Dubai Link: <a href="https://info.wslcms.com/dubai-cimea-checklist" target="_blank">info.wslcms.com/dubai-cimea-checklist</a>
									<?php }elseif($clientEmbassy=='Abu Dhabi Embassy'){?>
									Abu Dhabi Link: <a href="https://info.wslcms.com/abu-dhabi-cimea-checklist" target="_blank">info.wslcms.com/abu-dhabi-cimea-checklist</a>
									<?php }elseif($clientEmbassy=='Riyadh, Saudi Arabia Embassy'){?>
									Saudia Riyadh DOV Checklist Link: <a href="https://info.wslcms.com/saudia-riyadh-dov-checklist" target="_blank">info.wslcms.com/saudia-riyadh-dov-checklist</a>
									<?php }elseif($clientEmbassy=='Doha, Qatar Embassy'){?>
									Doha, Qatar Checklist Link: <a href="https://info.wslcms.com/doha-cimea-checklist" target="_blank">info.wslcms.com/doha-cimea-checklist</a>
									<?php } ?>
									<div id="linktoast" class="toast"><?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="<?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Link" class="btn btn-dark btn-sm ml-1" onclick="copyLinkDOVCimea(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="2">
									<label class="form-label">Upload ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="dovCimeaFile[]" required="required" id="uploadedFiles2" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
								<?php 
								if($dovCimeaScreenShot!=''){
								$fileMulti = explode(',', $dovCimeaScreenShot);
								foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
								<?php } } ?>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="dovCimeaNote"><?php echo $dovCimeaNote;?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updDovCimea" onclick="saveDataForm('formDataDOVCima', 'updDovCimea');" id="updDovCimea" <?= $dovCimeaScreenShot!='' ? 'disabled' : '' ?>><i class="mdi mdi-upload"></i> Update</button>
									<?php if($dovCimeaScreenShot!=''){ ?>
									<button class="btn btn-danger" type="button" onclick="del(delC,<?php echo $visaDovCimeaID;?>);"><i class="mdi mdi-trash-can"></i> </button>
									<?php } ?>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Send Visa Checklist Via WhatsApp -->
			<div class="col-md-12">
				<form id="formDataVisa" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 03 <span class="text-danger">* </span> <span><b> Send <mark>Visa Checklist</mark> to the client (Send via WhatsApp) </b></span>
						</legend>
						<?php
						$visaScreenShot='';
						$visaNote='';
						$selectQuery = "SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_steps_name='Visa Checklist' AND visa_intro_checklist_client_id='".$clientID."' ";
						$selectQuery_ex = mysqli_query($con, $selectQuery);
						if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectQuery_ex);
							$visaID = $dataRow['visa_intro_checklist_id'];
							$visaScreenShot = $dataRow['visa_intro_checklist_screenshot'];
							$visaNote = $dataRow['visa_intro_checklist_note'];
							$visaStyle = $visaScreenShot!='' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
							<div class="form-group col-md-12">
								<h4 style="<?php echo $visaStyle;?>">
									<span><b> Send <mark>Visa Checklist</mark> to the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<input type="hidden" name="" value="Visa" id="checklistVisaName">
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewVisaList(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Visa Checklist</button>

									<button type="button" class="btn btn-success btn-sm float-right mr-2" onclick="veiwFormats(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Formats</button>
								</h4>
								<h5>
									<?php if($clientEmbassy=='Islamabad Embassy'){ ?>
									Punjab Visa Checklist Link: <a href="https://info.wslcms.com/punjab-visa-checklist" target="_blank">info.wslcms.com/punjab-visa-checklist</a>
									<?php }elseif($clientEmbassy=='Karachi Embassy'){?>
									Sindh Visa Checklist Link: <a href="https://info.wslcms.com/sindh-visa-checklist" target="_blank">info.wslcms.com/sindh-visa-checklist</a>
									<?php }elseif($clientEmbassy=='Dubai Embassy'){?>
									Dubai Visa Checklist Link: <a href="https://info.wslcms.com/dubai-visa-checklist" target="_blank">info.wslcms.com/dubai-visa-checklist</a>
									<?php }elseif($clientEmbassy=='Abu Dhabi Embassy'){?>
									Abu Dhabi Visa Checklist Link: <a href="https://info.wslcms.com/abu-dubai-visa-checklist" target="_blank">info.wslcms.com/abu-dubai-visa-checklist</a>
									<?php }elseif($clientEmbassy=='Riyadh, Saudi Arabia Embassy'){?>
									Saudia Riyadh Visa Checklist Link: <a href="https://info.wslcms.com/saudia-riyadh-visa-checklist" target="_blank">info.wslcms.com/saudia-riyadh-visa-checklist</a>
									<?php }elseif($clientEmbassy=='Doha, Qatar Embassy'){?>
									Doha Visa Checklist Link: <a href="https://info.wslcms.com/doha-visa-checklist" target="_blank">info.wslcms.com/doha-visa-checklist</a>
									<?php } ?>
									<div id="linkVisatoast" class="toast">Visa Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Visa Link" class="btn btn-dark btn-sm ml-1" onclick="copyLinkVisa(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="3">
									<label class="form-label">Upload ScreenShot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="visaFile[]" required="required" id="uploadedFiles3" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
								<?php 
								if($visaScreenShot!=''){
								$fileMulti = explode(',', $visaScreenShot);
								foreach ($fileMulti as $fileName) {
									?>
									<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
								<?php } }?>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="visaNote"><?php echo $visaNote;?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" type="button" name="updVisa" onclick="saveDataForm('formDataVisa', 'updVisa')" id="updVisa" <?= $visaScreenShot!='' ? 'disabled' : '' ?>><i class="mdi mdi-upload"></i> Update</button>
									<?php if($visaScreenShot!=''){ ?>
									<button class="btn btn-danger" type="button" onclick="del(delC,<?php echo $visaID;?>);"><i class="mdi mdi-trash-can"></i> </button>
									<?php } ?>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Send Case History to Client -->
			<div class="col-md-12">
				<form id="formDataHistory" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 04 <span class="text-danger">* </span> <span><b> Share the <mark>Case History Form</mark> with the client (Send via WhatsApp) </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$caseStatus='';
						$selectCase = "SELECT * FROM italy_clients_visa_case_history".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_case_history_client_id='".$clientID."' ";
						$selectCase_ex = mysqli_query($con, $selectCase);
						if ($selectCase_ex && mysqli_num_rows($selectCase_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectCase_ex);
							$caseStatus = $dataRow['visa_case_history_status'];
							$caseStyle = $caseStatus=='Case History sent to Clients' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4 style="<?php echo $caseStyle;?>">
									<span><b> Share the <mark>Case History Form</mark> with the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewCaseHistory(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Case History</button>
									<!-- <button type="button" class="btn btn-success btn-sm float-right mr-2" onclick="veiwFormats(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Formats</button> -->
								</h4>
								<h5>Case History Link:
									<a href="https://info.wslcms.com/case-history?TXVoYW1tYW=<?php echo $clientID;?>&azVoYQ1tYS=<?php echo $getUrl;?>" target="_blank">info.wslcms.com/case-history?TXVoYW1tYW=<?php echo $clientID;?>&azVoYQ1tYS=<?php echo $getUrl;?></a>
									<input type="hidden" name="" value="https://info.wslcms.com/case-history?TXVoYW1tYW=<?php echo $clientID;?>&azVoYQ1tYS=<?php echo $getUrl;?>" id="caseHistoryLink">
									<div id="linkCaseHistorytoast" class="toast">Case History Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Case History Link" class="btn btn-dark btn-sm ml-1" onclick="copyCaseHistoryLink(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>

							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="25%">Status</th>
												<th width="30%">ScreenShot</th>
												<th width="30%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectCase_ex && mysqli_num_rows($selectCase_ex) > 0) {
											foreach ($selectCase_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['visa_case_history_status'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['visa_case_history_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['visa_case_history_note'];?></td>
												<td><button <?= $row['visa_case_history_status']=='Case History sent & Received by Clients' ? 'disabled' : '' ?> class="btn btn-danger btn-sm" type="button" onclick="del(delCase,<?php echo $row['visa_case_history_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php } 
										}else{?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>

							<div class="form-group col-md-12">
								<label>Select Case History Status <span class="text-danger">*</span></label>
								<select class="form-control" name="caseHistoryStatus" required="required">
									<option selected value disabled class="text-center">--- Select Case History Status ---</option>
									<option value="Case History sent to Clients">Case History sent to Clients</option>
									<!-- <option value="Case History sent & Received by Clients">Case History sent & Received by Clients</option> -->
									<option value="Case History Study has been Completed, and Client has been Guided">Case History Study has been Completed, and Client has been Guided</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="4">
									<label class="form-label">Upload Proof <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="caseHistoryFile[]" required="required" id="uploadedFiles4" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="caseHistoryNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updCaseHistory" type="button" onclick="saveDataForm('formDataHistory', 'updCaseHistory')" id="updCaseHistory"><i class="mdi mdi-upload"></i> Submit</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Educational Documents -->
			<?php if($clientFrom=='Pakistan'){ ?>
			<div class="col-md-12">
				<form id="formDataAttest" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: 05 <span class="text-danger">* </span> <span><b> Guide about Educational Documents Attestation [IBCC, HEC, MOFA] </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$attestStatus='';
						$selectAttest = "SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_attest_trans_step_name='Documents Attestation' AND visa_attest_trans_client_id='".$clientID."' ";
						$selectAttest_ex = mysqli_query($con, $selectAttest);
						foreach ($selectAttest_ex as $attRow) {
							$attestStatus = $attRow['visa_attest_trans_status'];
							$attestStyle = $attestStatus=='Educational Documents Attestation by Client' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4 style="<?php echo $attestStyle;?>">
									<span><b> Guide about Educational Documents Attestation [IBCC, HEC, MOFA] </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
									<div id="showToastDetailsInfo" class="toast">Educational Documents Attestation message copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm float-right ml-1" onclick="copyDetailsInfo(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewDetailsInfo(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> Detailed Information</button>
									<button type="button" class="btn btn-success btn-sm float-right mr-2" onclick="veiwFormats(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Formats</button>
								</h4> <br>
								<h5>Documents Attestation Link:
									<a href="https://info.wslcms.com/attestation?W45MjMwtYW=<?php echo $clientID;?>&Vo25YQ1tYS=<?php echo $getUrl;?>" target="_blank">info.wslcms.com/attestation?W45MjMwtYW=<?php echo $clientID;?>&Vo25YQ1tYS=<?php echo $getUrl;?></a>
									<input type="hidden" name="" value="https://info.wslcms.com/attestation?W45MjMwtYW=<?php echo $clientID;?>&Vo25YQ1tYS=<?php echo $getUrl;?>" id="attestationLink">
									<div id="linkAttestationToast" class="toast">Attestation Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Documents Attestation Link" class="btn btn-dark btn-sm ml-1" onclick="copyAttestationLink(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="25%">Status</th>
												<th width="30%">ScreenShot</th>
												<th width="30%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectAttest_ex && mysqli_num_rows($selectAttest_ex) > 0) {
											foreach ($selectAttest_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['visa_attest_trans_status'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['visa_attest_trans_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['visa_attest_trans_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc,<?php echo $row['visa_attest_trans_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php }
										}else{?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label>Select Documents Attestation Status <span class="text-danger">*</span></label>
								<select class="form-control" name="docAttestationStatus" required="required">
									<option selected value disabled class="text-center">--- Select Documents Attestation Status ---</option>
									<option value="Informed about Educational Documents Attestation">Informed about Educational Documents Attestation</option>
									<option value="Educational Documents Attestation by Client">Educational Documents Attestation by Client</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="5">
									<label class="form-label">Upload Screenshot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="docAttestationFile[]" required="required" id="uploadedFiles5" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="docAttestationNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updDocAttestation" type="button" onclick="saveDataForm('formDataAttest', 'updDocAttestation')" id="updDocAttestation"><i class="mdi mdi-upload"></i> Submit</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<?php } ?>
			<div class="col-md-12">
				<form id="formDataScholar" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: <?= ($clientFrom == 'Pakistan') ? '06' : '05'; ?> <span class="text-danger">* </span><span><b> How and When to apply for a Scholarship </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$scholarScreenShot='';
						$scholarNote='';
						$selectScholar = "SELECT * FROM italy_clients_visa_intro_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_intro_checklist_steps_name='Scholarship Details' AND visa_intro_checklist_client_id='".$clientID."' ";
						$selectScholar_ex = mysqli_query($con, $selectScholar);
						if ($selectScholar_ex && mysqli_num_rows($selectScholar_ex) > 0) {
							$dataRow = mysqli_fetch_assoc($selectScholar_ex);
							$scholarVisaID = $dataRow['visa_intro_checklist_id'];
							$scholarScreenShot = $dataRow['visa_intro_checklist_screenshot'];
							$scholarNote = $dataRow['visa_intro_checklist_note'];
							$scholarStyle = $scholarScreenShot!='' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4 style="<?php echo $scholarStyle;?>">
									<span><b> How and When to Apply for a Scholarship </b></span>
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewScholarshipDetails(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Scholarship Details</button>
								</h4>
								<h5>Scholarship Details Link:
									<a href="https://info.wslcms.com/scholarship-details" target="_blank">info.wslcms.com/scholarship-details</a>
									<div id="linkScholarshiptoast" class="toast">Scholarship Details Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Lawyer's Details Link" class="btn btn-dark btn-sm ml-1" onclick="copyScholarshipLink(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="30%">ScreenShot</th>
												<th width="30%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectScholar_ex && mysqli_num_rows($selectScholar_ex) > 0) {
											foreach ($selectScholar_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $scholarScreenShot);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $scholarNote;?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delC,<?php echo $scholarVisaID;?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php }
										}else{?>
											<tr>
												<td colspan="4">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="6">
									<label class="form-label">Upload Screenshot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="scholarshipFile[]" required="required" id="uploadedFiles6" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="scholarshipNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updscholarship" type="button" onclick="saveDataForm('formDataScholar', 'updscholarship')" id="updscholarship"><i class="mdi mdi-upload"></i> Submit</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- Documents Translate -->
			<div class="col-md-12">
				<form id="formDataTranslate" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: <?= ($clientFrom == 'Pakistan') ? '07' : '06'; ?> <span class="text-danger">* </span><span><b> Documents Translate into the Italian Language (The Lawyer's Details will be shared after Acceptance) </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$transStatus='';
						$selectTrans = "SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_attest_trans_step_name='Documents Translate' AND visa_attest_trans_client_id='".$clientID."' ";
						$selectTrans_ex = mysqli_query($con, $selectTrans);
						foreach ($selectTrans_ex as $trRow) {
							$transStatus = $trRow['visa_attest_trans_status'];
							$translateStyle = $transStatus=='Documents Translate into the Italian Language by Client' ? 'color: green;' : '';
						}
						
						$selectAcceptance = "SELECT italy_dream_program1_status, italy_dream_program2_status, italy_direct_program1_status, italy_direct_program2_status, italy_pre_program1_status, italy_pre_summary_status FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_change_program_status='0' AND italy_clients_id='".$clientID."' AND (italy_dream_program1_status='Acceptance' || italy_dream_program2_status='Acceptance' || italy_direct_program1_status='Acceptance' || italy_direct_program2_status='Acceptance' || italy_pre_program1_status='Acceptance' || italy_pre_summary_status='Received' ) ";
						$selectAcceptance_ex = mysqli_query($con, $selectAcceptance);
						if ($selectAcceptance_ex) {
							while ($proRow = mysqli_fetch_assoc($selectAcceptance_ex)) {
								$dreamPro1 = $proRow['italy_dream_program1_status'];
								$dreamPro2 = $proRow['italy_dream_program2_status'];
								$directPro1 = $proRow['italy_direct_program1_status'];
								$directPro2 = $proRow['italy_direct_program2_status'];
								$prePro1 = $proRow['italy_pre_program1_status'];
								$prePro2 = $proRow['italy_pre_summary_status'];
							}
						}
						$ackName='';
						$selectAck = "SELECT after_ad_name FROM client_payafter_admission".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND after_ad_name='acknowlegment' AND after_ad_client_id='".$clientID."' ";
						$selectAck_ex = mysqli_query($con, $selectAck);
						if ($selectAck_ex && mysqli_num_rows($selectAck_ex) > 0) {
							$ackRow = mysqli_fetch_assoc($selectAck_ex);
							$ackName = $ackRow['after_ad_name'];
						}
						$isAccepted = ($clientSelfAcceptance!='') || ($ackName=='acknowlegment' && ($dreamPro1=='Acceptance' || $dreamPro2=='Acceptance' || $directPro1=='Acceptance' || $directPro2=='Acceptance' || $prePro1=='Acceptance' || $prePro2=='Received') || $clientProcess=='Direct Visa');
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4 style="<?php echo $translateStyle;?>">
									<span><b> Documents Translate into the Italian Language (The Lawyer's Details will be shared after Acceptance) </b></span>
									<button type="button" <?php echo $isAccepted ? '' : 'disabled'; ?> class="btn btn-primary btn-sm float-right" onclick="viewLawyerDetails(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Lawyer's Contact Details</button>
									
									<button type="button" class="btn btn-success btn-sm float-right mr-2" onclick="veiwFormats(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Formats</button>
								</h4>
								<h5>Lawyer's Details Link:
									<a href="https://info.wslcms.com/translate-into-italian?Wo95MjMwtYW=<?php echo $clientID;?>&Vo95YQ1tYS=<?php echo $getUrl;?>" target="_blank">info.wslcms.com/translate-into-italian?Wo95MjMwtYW=<?php echo $clientID;?>&Vo95YQ1tYS=<?php echo $getUrl;?></a>
									<input type="hidden" name="" value="https://info.wslcms.com/translate-into-italian?Wo95MjMwtYW=<?php echo $clientID;?>&Vo95YQ1tYS=<?php echo $getUrl;?>" id="lawyerLink">
									<div id="linkLawyertoast" class="toast">Lawyer's Details Link copied to clipboard!</div>
									<button type="button" <?php echo $isAccepted ? '' : 'disabled'; ?> data-toggle="tooltip" data-placement="top" title="Lawyer's Details Link" class="btn btn-dark btn-sm ml-1" onclick="copyLawyerLink(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="25%">Status</th>
												<th width="30%">ScreenShot</th>
												<th width="30%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectTrans_ex && mysqli_num_rows($selectTrans_ex) > 0) {
											foreach ($selectTrans_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['visa_attest_trans_status'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['visa_attest_trans_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['visa_attest_trans_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc,<?php echo $row['visa_attest_trans_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php }
										}else{?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label>Select Documents Translate Status <span class="text-danger">*</span></label>
								<select class="form-control" name="docTranslateStatus" required="required">
									<option selected value disabled class="text-center">--- Select Documents Translate Status ---</option>
									<option value="Informed about Documents Translate into the Italian Language">Informed about Documents Translate into the Italian Language</option>
									<option value="Documents Translate into the Italian Language by Client">Documents Translate into the Italian Language by Client</option>
								</select>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="7">
									<label class="form-label">Upload Screenshot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="docTranslateFile[]" required="required" id="uploadedFiles7" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="docTranslateNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updDocTranslate" type="button" onclick="saveDataForm('formDataTranslate', 'updDocTranslate')" id="updDocTranslate" <?php echo $isAccepted ? '' : 'disabled'; ?>><i class="mdi mdi-upload"></i> Submit</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>

			<!-- Documents Translate -->
			<div class="col-md-12">
				<form id="formDataHotel" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: <?= ($clientFrom == 'Pakistan') ? '08' : '07'; ?> <span class="text-danger">* </span><span><b> Hotel & flight Booking - Affidavit Formats </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$hotelStatus='';
						$selectHotel = "SELECT * FROM italy_clients_visa_attest_trans".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_attest_trans_step_name='Hotel Booking & Ticket Reservation' AND visa_attest_trans_client_id='".$clientID."' ";
						$selectHotel_ex = mysqli_query($con, $selectHotel);
						foreach ($selectHotel_ex as $trRow) {
							$hotelStatus = $trRow['visa_attest_trans_status'];
							$translateStyle = $hotelStatus=='Hotel Booking & Ticket Reservation' ? 'color: green;' : '';
						}
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4 style="<?php echo $translateStyle;?>">
									<?php if($clientFrom=='Pakistan'){ ?>
									<span><b> Hotel Booking & Ticket Reservation - Travel Insurance Guidelines - Affidavit formats & guidance </b></span>
									<?php }if($clientFrom=='UAE'){ ?>
									<span><b> Hotel Booking – Ticket Reservation – Affidavit Attestation – Travel Insurance Guidelines </b></span>
									<?php } ?>
									<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewHotelDetails('<?php echo $clientFrom;?>')"><i class="mdi mdi-eye"></i> View Details</button>
									<div id="detailsHoteltoast" class="toast">Message copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm float-right mr-1" onclick="copyHotelDetails('<?php echo $clientFrom;?>')"><i class="mdi mdi-content-copy"></i></button>
								</h4>

								<h5>Details Link:
									<a href="https://info.wslcms.com/hotel-booking?Wo95MjMBoOkIng=<?php echo $clientFrom;?>&Vo95YQ1tYS=Wo95MjMBoOkIng" target="_blank">info.wslcms.com/hotel-booking?Wo95MjMBoOkIng=<?php echo $clientFrom;?>&Vo95YQ1tYS=Wo95MjMBoOkIng</a>
									<input type="hidden" name="" value="https://info.wslcms.com/hotel-booking?Wo95MjMBoOkIng=<?php echo $clientFrom;?>&Vo95YQ1tYS=Wo95MjMBoOkIng" id="hotelLink">
									<div id="linkHoteltoast" class="toast">Link copied to clipboard!</div>
									<button type="button" data-toggle="tooltip" data-placement="top" title=" Details Link" class="btn btn-dark btn-sm ml-1" onclick="copyHotelLink()"><i class="mdi mdi-content-copy"></i></button>
								</h5>
							</div>
							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="25%">Status</th>
												<th width="30%">ScreenShot</th>
												<th width="30%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectHotel_ex && mysqli_num_rows($selectCase_ex) > 0) {
											foreach ($selectHotel_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['visa_attest_trans_status'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['visa_attest_trans_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['visa_attest_trans_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc,<?php echo $row['visa_attest_trans_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php }
										}else{?>
											<tr>
												<td colspan="5">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="17">
									<label class="form-label">Upload Screenshot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="bookingHotelFile[]" required="required" id="uploadedFiles17" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-8">
								<label>Any Note</label>
								<textarea class="form-control" name="bookingHotelNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updbookinghotel" type="button" onclick="saveDataForm('formDataHotel', 'updbookinghotel')" id="updbookinghotel"><i class="mdi mdi-upload"></i> Submit</button>
								</div> 
							</div>
						</div>
					</fieldset>
				</form>
			</div>

			<!-- Book Visa Appointment  -->
			<div class="col-md-12">
				<form id="formDataBookVisa" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="upClientID" value="<?php echo $clientID;?>">
					<fieldset class="scheduler-border-team">
						<legend class="scheduler-border-team">
							Step: <?= ($clientFrom == 'Pakistan') ? '09' : '08'; ?> <span class="text-danger">* </span> <span><b> Book Visa Appointment </b></span>
						</legend>
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-8">
										<div class="alert bg-dark text-warning">
											<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
										</div>
									</div>
									<div class="col-md-4">
										<div class="alert bg-dark text-warning">
											<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="alert bg-dark text-warning">
									<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
								</div>
							</div>
						</div>
						<?php
						$visaBookScreenShot='';
						$selectVisaBook = "SELECT * FROM italy_clients_visa_book_appoint".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND visa_book_appoint_client_id='".$clientID."' ";
						$selectVisaBook_ex = mysqli_query($con, $selectVisaBook);
						// if ($selectVisaBook_ex && mysqli_num_rows($selectVisaBook_ex) > 0) {
						// 	$dataRow = mysqli_fetch_assoc($selectQuery_ex);
						// 	$visaBookScreenShot = $dataRow['visa_book_appoint_screenshot'];
						// 	$visaBookStyle = $visaBookScreenShot!='' ? 'color: green;' : '';
						// }
						?>
						<div class="row">
							<div class="form-group col-md-12">
								<h4>
									<span><b> Book Visa Appointment </b></span>
									<button type="button" class="btn btn-success btn-sm float-right" onclick="veiwVisaForm(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> Visa & Other Forms</button>
								</h4>
								<?php if($clientEmbassy=='Muscat, Oman Embassy'){ ?>
									<h5>VFS Global Link: <a href="https://visa.vfsglobal.com/omn/en/ita/" target="_blank">https://visa.vfsglobal.com/omn/en/ita/ </a></h5>
								<?php }else{ ?>
									<h5>BLS Portal Link: <a href="https://theitalyvisa.com/" target="_blank">https://theitalyvisa.com/ </a></h5>
								<?php } ?>
							</div>

							<div class="form-group col-md-12">
								<div class="table-responsive mt-1">
									<table class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
										<thead>
											<tr>
												<th width="5%">Sr</th>
												<th width="17%">Status</th>
												<th width="18%">Booking Date</th>
												<th width="20%">UserName</th>
												<th width="20%">Password</th>
												<th width="20%">ScreenShot</th>
												<th width="20%">Note</th>
												<th width="10%">Action</th>
											</tr>
										</thead>
										<tbody>
										<?php
										$sr=1;
										if ($selectVisaBook_ex && mysqli_num_rows($selectVisaBook_ex) > 0) {
											foreach ($selectVisaBook_ex as $row) {
										?>
											<tr>
												<td><?php echo $sr++;?></td>
												<td><?php echo $row['visa_book_appoint_status'];?></td>
												<td><?php echo date("d-m-Y", strtotime($row['visa_book_appoint_date']));?></td>
												<td><?php echo $row['visa_book_appoint_username'];?></td>
												<td><?php echo $row['visa_book_appoint_password'];?></td>
												<td>
												<?php 
												$fileMulti = explode(',', $row['visa_book_appoint_screenshot']);
												foreach ($fileMulti as $fileName) {
												?>
												<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
												<?php } ?>
												</td>
												<td><?php echo $row['visa_book_appoint_note'];?></td>
												<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delBook,<?php echo $row['visa_book_appoint_id'];?>);"><i class="mdi mdi-trash-can"></i> </button></td>
											</tr>
											<?php }
										}else{?>
											<tr>
												<td colspan="8">No data available in table</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label>Select Book Visa Appointment Status <span class="text-danger">*</span></label>
								<select class="form-control" name="visaBookStatus" required="required">
									<option selected value disabled class="text-center">--- Select Book Visa Appointment Status ---</option>
									<option value="Book Visa Appointment link sent to Client">Book Visa Appointment link sent to Client</option>
									<option value="Visa Appointment Booked By Client">Visa Appointment Booked By Client</option>
									<option value="Visa Appointment Booked By WSL Consultants">Visa Appointment Booked By WSL Consultants</option>
									<option value="Visa Submitted By Client">Visa Submitted By Client</option>
									<option value="Visa Accepted">Visa Accepted</option>
									<option value="Visa Rejected">Visa Rejected</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label>Booking Date <span class="text-danger">*</span> </label>
								<input type="date" name="visaBookDate" class="form-control" required="required" autocomplete="off" value="<?php echo date('Y-m-d');?>">
							</div>
							<div class="form-group col-md-4">
								<label>User Name </label>
								<input type="text" name="visaBookUsername" class="form-control" autocomplete="off" >
							</div>
							<div class="form-group col-md-4">
								<label>Password </label>
								<input type="text" name="visaBookPassword" class="form-control" autocomplete="off">
							</div>
							
							<div class="form-group col-md-4">
								<div class="agreement-container" data-agreement-id="8">
									<label class="form-label">Upload Screenshot <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="visaBookFile[]" required="required" id="uploadedFiles8" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="form-group col-md-12">
								<label>If Any Note </label>
								<textarea class="form-control" name="visaBookNote"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="float-right">
									<button class="btn btn-primary" name="updVisaBook" type="button" onclick="saveDataForm('formDataBookVisa', 'updVisaBook')" id="updVisaBook"><i class="mdi mdi-upload"></i> Submit</button>
								</div>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div> <!-- end row -->
	</div>
</div>
<!-- Visa Into Message Modal -->
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

<!-- DOV/CIMEA Checklist Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cimeaDOVModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myLargeModalLabel">View <?php if($clientEmbassy=='Islamabad Embassy'){echo "DOV";}else{echo "CIMEA";}?> Checklist</h4>
			</div>
			<div class="modal-body cimeaDOVModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Visa Checklist Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="VisaModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" id="myLargeModalLabel">View Visa Checklist</h4>
			</div>
			<div class="modal-body VisaModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
	// Save Visa Process Data using AJAX
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
				url: "models/_visaProcessControllersState.php",
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
</script>

<script type="text/javascript">
	// Intro Message 
	function veiwIntroMessage(id) {
		var id = id;
		var clientEmbassy = $("#clientEmbassy").val();
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkIntroMessage: id,
				checkclientEmbassy: clientEmbassy,
			},
			success: function(data){
				$(".showModalTitle").html('Intro Message');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// copy intro Message
	function copyIntroMessage(id) {
		var clientEmbassy = $("#clientEmbassy").val();
		var message = `I hope you are doing well. I will guide you through the visa application process. I will be available to clear any queries or concerns you may have regarding your visa.
*Step 1* - Educational & others Documents Attestation from IBCC, HEC, MOFA and Notary Public.
*Step 2* - Translate your Educational Documents into Italian Language (The lawyer's details will be shared after the acceptance letter).
`;

    // Correct condition (OR instead of AND)
    if (clientEmbassy === 'Islamabad Embassy' || clientEmbassy === 'Riyadh, Saudi Arabia Embassy') {
        message += `*Step 3* - Complete all documents of DOV and VISA Checklist (The voices and DOV + VISA checklist will be shared on your email).
`;
    } else {
        message += `*Step 3* - Complete all documents of CIMEA and VISA Checklist (The voices and CIMEA + VISA checklist will be shared on your email).
`;
    }

    message += `*Step 4* - Apply for the Visa`;
		
		navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("toast");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});

	};
	// DOV Cimea Checklist
	function veiwDOVCimeaList(id) {
		var id = id;
		var checklistName = $("#checklistName").val();
		var clientEmbassy = $("#clientEmbassy").val();
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkCimeaDOVList: id,
				checklistName: checklistName,
				checkclientEmbassy: clientEmbassy,
			},
			success: function(data){
				$(".cimeaDOVModalClient").html(data);
				$("#cimeaDOVModalClient").modal('show');
			}
		});
	};
	function copyLinkDOVCimea(id) {
		var checklistName = $("#checklistName").val();
		var clientEmbassy = $("#clientEmbassy").val();

		if(checklistName=='DOV' && clientEmbassy=='Islamabad Embassy'){
			var linkCopy=`info.wslcms.com/punjab-dov-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Karachi Embassy'){
			var linkCopy=`info.wslcms.com/sindh-cimea-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Dubai Embassy'){
			var linkCopy=`info.wslcms.com/dubai-cimea-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Abu Dhabi Embassy'){
			var linkCopy=`info.wslcms.com/abu-dhabi-cimea-checklist`;
		}else if(checklistName=='DOV' && clientEmbassy=='Riyadh, Saudi Arabia Embassy'){
			var linkCopy=`info.wslcms.com/saudia-riyadh-dov-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Doha, Qatar Embassy'){
			var linkCopy=`info.wslcms.com/doha-cimea-checklist`;
		}

		navigator.clipboard.writeText(linkCopy).then(function() {
			var linktoast = document.getElementById("linktoast");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
	// Visa Checklist
	function viewVisaList(id) {
		var id = id;
		var checklistVisaName = $("#checklistVisaName").val();
		var clientEmbassy = $("#clientEmbassy").val();
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkCimeaDOVList: id,
				checklistName: checklistVisaName,
				checkclientEmbassy: clientEmbassy,
			},
			success: function(data){
				$(".VisaModalClient").html(data);
				$("#VisaModalClient").modal('show');
			}
		});
	};

	function copyLinkVisa(id) {
		var checklistVisaName = $("#checklistVisaName").val();
		var clientEmbassy = $("#clientEmbassy").val();

		if(checklistVisaName=='Visa' && clientEmbassy=='Islamabad Embassy'){
			var linkCopy=`info.wslcms.com/punjab-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Karachi Embassy'){
			var linkCopy=`info.wslcms.com/sindh-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Dubai Embassy'){
			var linkCopy=`info.wslcms.com/dubai-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Abu Dhabi Embassy'){
			var linkCopy=`info.wslcms.com/abu-dubai-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Riyadh, Saudi Arabia Embassy'){
			var linkCopy=`info.wslcms.com/saudia-riyadh-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Doha, Qatar Embassy'){
			var linkCopy=`info.wslcms.com/doha-visa-checklist`;
		}
		navigator.clipboard.writeText(linkCopy).then(function() {
			var linktoast = document.getElementById("linkVisatoast");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};

	// Visa Checklist
	function viewCaseHistory(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkCaseHistory: id,
			},
			success: function(data){
				$(".showModalTitle").html('Case History');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// case history link copy
	function copyCaseHistoryLink(id) {
		var linkCopy = $("#caseHistoryLink").val();
		
		navigator.clipboard.writeText(linkCopy).then(function() {
			var linktoast = document.getElementById("linkCaseHistorytoast");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
	// Guide about Educational documents attestation
	function viewDetailsInfo(id) {
		var id = id;
		var clientApplied = $("#clientApplied").val();
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkClientID: id,
				clientApplied: clientApplied,
			},
			success: function(data){
				$(".showModalTitle").html("Guide About Educational Documents");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// documents Attestation link copy
	function copyAttestationLink(id) {
		var linkCopy = $("#attestationLink").val();
		
		navigator.clipboard.writeText(linkCopy).then(function() {
			var linktoast = document.getElementById("linkAttestationToast");
			linktoast.classList.add("show");
			// Hide the linktoast after 3 seconds
			setTimeout(function() {
				linktoast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
	// copy Educational documents attestation Message
	function copyDetailsInfo(id) {
		var clientApplied = $("#clientApplied").val();

		if (clientApplied=='bachelor' || clientApplied=='mbbs') {
			var message = `*Guide About Educational Documents Attestation (Master's)*
- Matric Degree (certificate)
- Inter Marksheet
- Inter Degree (Certificate)
*Attested from relevant Board, IBCC and MOFA*
(Relevant Board, same day Time 3-4 hours & cost depend on your board)
(IBCC time depends on your appointment & cost 1200 PKR per document)
Bachelor Transcript & Degree (if applicable)

*Attested by relevant univesity, HEC and MOFA*
(HEC time depends on your appointment & cost 1000 PKR per document (normal basis) and urgent basis 3000 PKR extra charges + 1000 PKR per document)

*Other Documents*

- FRC Attested from MOFA.
(same day Time 3-4 hours & cost vary)

- MRC Attested from MOFA (if student married).
(same day Time 3-4 hours & cost vary) Domicile must be notarized 2 color copies (same day Time 3-4 hours & cost 200 to 300).

- Passport (first two Pages, second must be signed) must be notarized 3 color copies.
(same day Time 3-4 hours & cost 200 to 300 per document).

- Domicile - must be notarized 3 color copies.
(same day Time 3-4 hours & cost 200 to 300 per document)`;
		}else if(clientApplied=='master'){
			var message = `Guide About Educational Documents Attestation (Master's).
- Matric Degree (Certificate).
- Inter Degree (Certificate)
*Attested from relevant Board, IBCC and MOFA.*
(Relevant Board, same day Time 3-4 hours & cost depend on your board)
(IBCC time depends on your appointment & cost 1200 PKR per document)

- Bachelor Transcript
- Bachelor Degree
- Master Transcript & Degree (if available)
*Attested by relevant univesity, HEC and MOFA.*
(HEC time depends on your appointment & cost 1000 PKR per document (normal basis) and urgent basis 3000 PKR extra charges + 1000 PKR per document)

*Other Documents*

- FRC Attested from MOFA.
(same day Time 3-4 hours & cost vary)

- MRC Attested from MOFA (if student married).
(same day Time 3-4 hours & cost vary) Domicile must be notarized 2 color copies (same day Time 3-4 hours & cost 200 to 300).

- Passport (first two Pages, second must be signed) must be notarized 3 color copies.
(same day Time 3-4 hours & cost 200 to 300 per document).

- Domicile - must be notarized 3 color copies.
(same day Time 3-4 hours & cost 200 to 300 per document)`;
		}
		 navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("showToastDetailsInfo");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});

	};

	// The Lawyer's Details
	function viewLawyerDetails(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkLawClientID: id,
			},
			success: function(data){
				$(".showModalTitle").html("The Lawyer's Details");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	// copy lawyer details link
	function copyLawyerLink(id) {
		var message = $("#lawyerLink").val();
		navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("linkLawyertoast");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};

	// The Scholarship Details
	function viewScholarshipDetails(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkSchClientID: id,
			},
			success: function(data){
				$(".showModalTitle").html("Scholarship Details");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	// The Hotel Booking Details
	function viewHotelDetails(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkHotelDetails: id,
			},
			success: function(data){
				$(".showModalTitle").html("Hotel Booking Details");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	// copy Hotel Booking details link
	function copyHotelLink() {
		var message = $("#hotelLink").val();
		navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("linkHoteltoast");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};

	// copy Educational documents attestation Message
	function copyHotelDetails(clientFrom) {
		if (clientFrom=='Pakistan') {
			var message = `*Hotel Booking – Ticket Reservation –  Travel Insurance Guidelines*
*1) Hotel & Flight Booking*  
For booking assistance, please contact:
*Traveling House*
📞 +92 334 3939999

*2) Travel Insurance*  
Recommended travel insurance companies:  
* PDF attached`;
		}
		else if (clientFrom=='UAE') {
			var message = `*Hotel Booking – Ticket Reservation – Affidavit Attestation – Travel Insurance Guidelines*
*1) Affidavit of Support Attestation Services*
For affidavit of Support attestation, please contact:
*NOOR ALHIBA Translation and Attestation Services*
📞 +971 54 525 4356

*2) Hotel & Flight Booking*
For booking assistance, please contact:  
*Royal Atlantic World DCS LLC*  
📞 +971 567951791

*3) Travel Insurance Booking*  
Recommended UAE-based travel insurance companies:  
* AIG Travel Insurance  
* Swisscare (Insured by Anker Insurance Company N.V.)  
* RAK Insurance (https://www.rakinsurance.com/en/contactus)`;
		}
		 navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("detailsHoteltoast");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});

	};

	// copy Scholarship details link
	function copyScholarshipLink(id) {
		var message = `https://info.wslcms.com/scholarship-details`;
		navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("linkScholarshiptoast");
			toast.classList.add("show");
			// Hide the toast after 3 seconds
			setTimeout(function() {
				toast.classList.remove("show");
			}, 3000);
		}).catch(function(err) {
			alert("Failed to copy text: " + err);
		});
	};
	// Delete steps function
	function delC(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaProcessState.php",
			data: 'visaProcessID='+id,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	// Delete steps for case History
	function delCase(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaProcessState.php",
			data: 'visaCaseID='+id,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	// Delete steps function for documents attestation and translate
	function delDoc(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaProcessState.php",
			data: 'visaDocID='+id,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};
	// Delete steps function for Visa Book Appointment
	function delBook(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/visaProcessState.php",
			data: 'visaBookID='+id,
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	// View Formats 
	function veiwFormats(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkFormats: id,
			},
			success: function(data){
				$(".showModalTitle").html("Formats");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// View Visa And Other Forms
	function veiwVisaForm(id) {
		var id = id;
		var clientEmbassy = $("#clientEmbassy").val();
		// alert(clientEmbassy);
		$.ajax({
			type: "POST",
			url: "models/visaProcessState.php",
			data: {
				checkVisaFormID: id,
				checkClientEmbassy: clientEmbassy,
			},
			success: function(data){
				// alert(data);
				$(".showModalTitle").html("Visa and Other Forms");
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>
<script type="text/javascript">
	function sponserSelfRelative() {
		var selfRelative=$("#selfRelative").val();
		if (selfRelative=='Any Blood Relative(Parents, Siblings)') {
			$("#showRelationSponsor").css('display', 'block');
			$("#showRelationSponsor input").prop('required', true);
			$("#showRelationSponsor input").css('border-bottom', '2px solid #e33244');
			$("#showRelationSponsor input").val('');
		} else {
			$("#showRelationSponsor input").val('');
			$("#showRelationSponsor").css('display', 'none');
			$("#showRelationSponsor input").prop('required', false);
		}
	}

	function sourceOfIncome() {
		var sourceIncome=$("#sourceIncome").val();
		if (sourceIncome=='Job') {
			$("#showJobArea1").css('display', 'block');
			$("#showJobArea1 input").prop('required', true);
			$("#showJobArea1 input").css('border-bottom', '2px solid #e33244');
			$("#showJobArea1 input").val('');

			$("#showJobArea2").css('display', 'block');
			$("#showJobArea2 input").prop('required', true);
			$("#showJobArea2 input").css('border-bottom', '2px solid #e33244');
			$("#showJobArea2 input").val('');

			$("#showJobArea3").css('display', 'block');
			$("#showJobArea3 input").prop('required', true);
			$("#showJobArea3 input").css('border-bottom', '2px solid #e33244');
			$("#showJobArea3 input").val('');

			$("#showBusinessArea1").css('display', 'none');
			$("#showBusinessArea1 input").prop('required', false);
			$("#showBusinessArea1 input").val('');
			$("#showBusinessArea2").css('display', 'none');
			$("#showBusinessArea2 input").prop('required', false);
			$("#showBusinessArea2 input").val('');
			$("#showBusinessArea3").css('display', 'none');
			$("#showBusinessArea3 input").prop('required', false);
			$("#showBusinessArea3 input").val('');

			$("#showSourceOfIncome").css('display', 'none');
			$("#showSourceOfIncome textarea").prop('required', false);
			$("#showSourceOfIncome textarea").val('');

			$("#showNonFiler").css('display', 'block');
			$("#showNonFiler select").prop('required', true);
			$("#showNonFiler select").css('border-bottom', '2px solid #e33244');
			$("#showNonFiler select").val('');

			$("#showCompanyNote").css('display', 'none');
			$("#showCompanyNote textarea").val('');

		}else if (sourceIncome=='Business') {
			$("#showBusinessArea1").css('display', 'block');
			$("#showBusinessArea1 input").prop('required', true);
			$("#showBusinessArea1 input").css('border-bottom', '2px solid #e33244');
			$("#showBusinessArea1 input").val('');

			$("#showBusinessArea2").css('display', 'block');
			$("#showBusinessArea2 input").prop('required', true);
			$("#showBusinessArea2 input").css('border-bottom', '2px solid #e33244');
			$("#showBusinessArea2 input").val('');

			$("#showBusinessArea3").css('display', 'block');
			$("#showBusinessArea3 select").prop('required', true);
			$("#showBusinessArea3 select").css('border-bottom', '2px solid #e33244');
			$("#showBusinessArea3 select").val('');

			$("#showJobArea1").css('display', 'none');
			$("#showJobArea1 input").prop('required', false);
			$("#showJobArea1 input").val('');
			$("#showJobArea2").css('display', 'none');
			$("#showJobArea2 input").prop('required', false);
			$("#showJobArea2 input").val('');
			$("#showJobArea3").css('display', 'none');
			$("#showJobArea3 input").prop('required', false);
			$("#showJobArea3 input").val('');

			$("#showSourceOfIncome").css('display', 'none');
			$("#showSourceOfIncome textarea").prop('required', false);
			$("#showSourceOfIncome textarea").val('');

			$("#showNonFiler").css('display', 'block');
			$("#showNonFiler select").prop('required', true);
			$("#showNonFiler select").css('border-bottom', '2px solid #e33244');
			$("#showNonFiler select").val('');

			$("#showCompanyNote").css('display', 'none');
			$("#showCompanyNote textarea").val('');
		}

		else if (sourceIncome=='Any Other Source of Income') {
			$("#showSourceOfIncome").css('display', 'block');
			$("#showSourceOfIncome textarea").prop('required', true);
			$("#showSourceOfIncome textarea").css('border-bottom', '2px solid #e33244');
			$("#showSourceOfIncome textarea").val('');

			$("#showBusinessArea1").css('display', 'none');
			$("#showBusinessArea1 input").prop('required', false);
			$("#showBusinessArea1 input").val('');
			$("#showBusinessArea2").css('display', 'none');
			$("#showBusinessArea2 input").prop('required', false);
			$("#showBusinessArea2 input").val('');
			$("#showBusinessArea3").css('display', 'none');
			$("#showBusinessArea3 input").prop('required', false);
			$("#showBusinessArea3 input").val('');

			$("#showJobArea1").css('display', 'none');
			$("#showJobArea1 input").prop('required', false);
			$("#showJobArea1 input").val('');
			$("#showJobArea2").css('display', 'none');
			$("#showJobArea2 input").prop('required', false);
			$("#showJobArea2 input").val('');
			$("#showJobArea3").css('display', 'none');
			$("#showJobArea3 input").prop('required', false);
			$("#showJobArea3 input").val('');

			$("#showNonFiler").css('display', 'none');
			$("#showNonFiler select").prop('required', false);
			$("#showNonFiler select").val('');
			$("#showTaxReturn").css('display', 'none');
			$("#showTaxReturn select").prop('required', false);
			$("#showTaxReturn select").val('');

			$("#showCompanyNote").css('display', 'none');
			$("#showCompanyNote textarea").val('');
		}
	}

	function applyStudyVisa() {
		var studyVisaApply=$("#studyVisaApply").val();
		if (studyVisaApply=='Any Other Source') {
			$("#showStudyVisa").css('display', 'block');
			$("#showStudyVisa textarea").prop('required', true);
			$("#showStudyVisa textarea").css('border-bottom', '2px solid #e33244');
			$("#showStudyVisa textarea").val('');
		} else {
			$("#showStudyVisa").css('display', 'none');
			$("#showStudyVisa textarea").prop('required', false);
			$("#showStudyVisa textarea").val('');
		}
	}

	function companyRegistredStatus() {
		var companyStatus=$("#companyStatus").val();
		if (companyStatus=='Yes') {
			$("#showCompanyNote").css('display', 'block');
			$("#showCompanyNote textarea").val('');
		} else {
			$("#showCompanyNote").css('display', 'none');
			$("#showCompanyNote textarea").val('');
		}
	}

	function filerNonFiler() {
		var nonFilerID=$("#nonFilerID").val();
		if (nonFilerID=='Filer') {
			$("#showTaxReturn").css('display', 'block');
			$("#showTaxReturn select").prop('required', true);
			$("#showTaxReturn select").css('border-bottom', '2px solid #e33244');
			$("#showTaxReturn select").val('');
		} else {
			$("#showTaxReturn").css('display', 'none');
			$("#showTaxReturn select").prop('required', false);
			$("#showTaxReturn select").val('');
		}
	}
</script>