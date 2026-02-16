<?php 
$clientID = $_GET['client-id'];

$select_query="SELECT client_country, client_name, client_email, client_whatapp, client_embassy, client_applied, client_process_status, country_checklist_intro_file, country_checklist_intro_note, country_checklist_info_file, country_checklist_info_note from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);

$countryName = $row['client_country'];
$clientName = $row['client_name'];
$clientEmail = $row['client_email'];
$clientWhatApp = $row['client_whatapp'];
$clientEmbassy = $row['client_embassy'];
$clientProcessStatus = $row['client_process_status'];
$italyInfoIntroScreenShot = $row['country_checklist_intro_file'];
$italyInfoIntroNote = $row['country_checklist_intro_note'];

$italyInfoChecklistScreenShot = $row['country_checklist_info_file'];
$italyInfoChecklistNote = $row['country_checklist_info_note'];

$changingApplied = $row['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

?>
<!-- Visa Into Message Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showTitleModel" id="myLargeModalLabel"></h4>
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
<style type="text/css">
	.tooltip-inner {
		text-align: left;
	}
</style>
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
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Country: <b><?php echo ucwords($countryName);?></b></p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="alert bg-dark text-warning">
					<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
				</div>
			</div>
		</div>
		<!-- Intro message -->
		<input type="hidden" name="" value="<?php echo $clientEmbassy;?>" id="clientIDEmbassy">
		<div class="row">
			<div class="col-md-12">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						Intro Message <span class="text-danger">*</span>
					</legend>
					<div class="row">
						<div class="form-group col-md-12">
							<div id="toast1" class="toast">Intro message copied to clipboard!</div>
							<h4><span style="font-size: 20px;"><b><mark>Step No 01:</mark></b></span><span><b> Send Intro Message </b></span> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyIntroMessage('1')"><i class="mdi mdi-content-copy"></i></button> </h4>
						</div>
						<div class="col-md-12">
							<ul>
								<li>Assalam-o-Alaikum!</li>
								<li>This is the <b>Italy Head</b> from WSL Consultants' Head Office. I hope you are in good health. I would like to inform you that I’ve received your file. </li>
								<li>Once your <b>university opens</b>, your admission application will be completed and you will be informed accordingly. From now on, I’ll monitor the entire process and assist you.If you have any additional queries, please feel free to let me know 🙂</li>
								<li>Please note, another team member may contact you only for email login or verification codes.</li>
								<li><b>Do not reply to any other number.</b></li>
								<li>For all queries, contact only this number.</li>

								<li>I will guide you from admission till visa process from here.</li>
								<li><b>Please save this number and communicate here</b></li>
							</ul>
						</div>
						<div class="col-md-12">
							<ul>
								<li>السلام علیکم،</li>
								<li>یہ اٹلی ہیڈ ہیں ڈبلیو ایس ایل کنسلٹنٹس ہیڈ آفس سے۔
امید ہے کہ آپ خیریت سے ہوں گے۔ میں آپ کو یہ اطلاع دینا چاہتی ہوں کہ مجھے آپ کی فائل موصول ہو گئی ہے۔</li>
								<li>جیسے ہی آپ کی یونیورسٹی اوپن ہوگی، آپ کی ایڈمیشن اپلیکیشن مکمل کر کے آپ کو مطلع کر دیا جائے گا۔ اب سے میں پورے پراسیس کو مانیٹر کروں گی اور آخر تک آپ کی مدد کرتی رہوں گی۔
اگر آپ کے پاس مزید کوئی سوالات ہوں تو بلا جھجک مجھ سے رابطہ کریں 🙂</li>

								<li>براہِ کرم نوٹ کریں کہ آپ سے کسی دوسرے ٹیم ممبر کی طرف سے صرف ای میل لاگ اِن یا ویریفکیشن کوڈ کے لیے رابطہ کیا جا سکتا ہے۔</li>
								<li><b>کسی اور نمبر پر جواب نہ دیں۔</b></li>
								<li>تمام سوالات کے لیے صرف اسی نمبر پر رابطہ کریں۔</li>
								<li>میں داخلے سے لے کر ویزا کے عمل تک آپ کی مکمل رہنمائی یہی سے کروں گا/کروں گی۔</li>
								<li><b>براہِ کرم یہ نمبر محفوظ کر لیں اور اسی پر رابطے میں رہیں۔</b></li>
							</ul>
						</div>

						<div class="form-group col-md-12">
							<div id="toast2" class="toast">Process message copied to clipboard!</div>
							<h4><span style="font-size: 20px;"><b><mark>Step No 02:</mark></b></span><span><b> Steps for the Italy Process</b></span> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyIntroMessage('2')"><i class="mdi mdi-content-copy"></i></button> </h4>
						</div>
						<div class="col-md-12">
							<p><b>STEPS FOR THE ITALY PROCESS</b></p>
							<p><b>Step 1 - </b>Apply for the Admission Application</p>

							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [IBCC, HEC, MOFA, Apostille] ( The voices and DOV checklist will be shared on your email )</p>
							<?php }elseif($clientEmbassy=="Karachi Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [IBCC, HEC, MOFA, Apostille] ( The voices and CIMEA checklist will be shared on your email )</p>
							<?php }elseif($clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [according to your country education department]</p>
							<?php }elseif($clientEmbassy=="Riyadh, Saudi Arabia Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [according to your country education department] ( The voices and Cimea checklist will be shared on your email )</p>
							<?php }elseif($clientEmbassy=="Doha, Qatar Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [according to your country education department] ( The voices and CIMEA checklist will be shared on your email )</p>
							<?php }elseif($clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<p><b>Step 2 - </b>Documents Attestation [according to your country education department] (The voices and CIMEA checklist will be shared on your email )</p>
							<?php } ?>

							<p><b>Step 3 - </b>After Acceptance Apply for Pre Enrollment </p>
							<p><b>Step 4 - </b>Documents Translate into Italian Language  (The lawyers details will be shared after acceptance)</p>

							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<p><b>Step 5 - </b>Complete all documents of DOV and VISA Checklist ( The voices and DOV + VISA checklist will be shared on your email )</p>
							<?php }elseif($clientEmbassy=="Karachi Embassy" || $clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy" || $clientEmbassy=="Doha, Qatar Embassy" || $clientEmbassy=="Riyadh, Saudi Arabia Embassy" || $clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<p><b>Step 5 - </b>Apply for CIMEA and complete all documents of VISA Checklist ( The voices and CIMEA + VISA checklist will be shared on your email )</p>
							<?php } ?>
							<p><b>Step 6 - </b>Apply for the Visa</p>
						</div>
						<div class="form-group col-md-12">
							<h4><span style="font-size: 20px;"><b><mark>Step No 03:</mark></b></span><span><b> Voice Note</b></span>  </h4>
						</div>

						<div class="col-md-12">
							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Islamabad Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php }elseif($clientEmbassy=="Karachi Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Karachi Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php }elseif($clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Dubai Dhabi Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php }elseif($clientEmbassy=="Riyadh, Saudi Arabia Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Saudia Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php }elseif($clientEmbassy=="Doha, Qatar Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Doha Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php }elseif($clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<audio controls preload="auto" id="audio-1" data-index="1">
								<source src="https://crm.wslcms.com/italy-videos/checklist/Oman Italy Step Process.mpeg" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
							<?php } ?>
						</div>

						<div class="col-md-12">
							<form id="formEmailIntro" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
								<div class="row">
									<div class="form-group col-md-5">
										<div class="agreement-container" data-agreement-id="1">
											<label class="form-label">ScreenShot <span class="text-danger">* (Select Multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="italyInfoIntroScreenShot[]" required="required" id="uploadedFiles1" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($italyInfoIntroScreenShot!=''){
											$fileMulti = explode(',', $italyInfoIntroScreenShot);
											$sr=1;
											foreach ($fileMulti as $fileName) {
												?>
												<?php echo $sr++;?>: <a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
												<?php }
											}
										?>
									</div>
									<div class="form-group col-md-7">
										<label class="form-label">Intro Msg Note </label>
										<textarea class="form-control" name="italyInfoIntroNote"><?php echo $italyInfoIntroNote;?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-custom" type="button" name="subitalyInfoIntro" onclick="saveDataForm('formEmailIntro', 'subitalyInfoIntro')" id="subitalyInfoIntro"><i class="mdi mdi-upload"></i> Update </button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<?php if($clientProcessStatus!='Only Admission Process'){ ?>
		<!-- whatsapp checklist link -->
		<div class="row">
			<div class="col-md-12">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						WhatsApp Checklist  <span class="text-danger">*</span>
					</legend>
					<div class="row">
						<div class="form-group col-md-12">
							<div id="toast3" class="toast">Checklist message copied to clipboard!</div>
							<h4><span style="font-size: 20px;"><b><mark>Step No 04:</mark></b></span><span><b> Steps for the Italy Process</b></span> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyIntroMessage('3')"><i class="mdi mdi-content-copy"></i></button> </h4>
						</div>
						<div class="col-md-12">
							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<p><b>DOV Checklist</b></p>
							<p>I have shared the DOV checklist with you. You need to start the attestation process for your documents right away. These documents will be submitted to the embassy at the time of the visa process.</p>
							<?php }elseif($clientEmbassy=="Karachi Embassy" || $clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy" || $clientEmbassy=="Doha, Qatar Embassy" || $clientEmbassy=="Riyadh, Saudi Arabia Embassy" || $clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<p><b>CIMEA Checklist</b></p>
							<p>I have shared the CIMEA checklist with you. You need to start the attestation process for your documents right away. These documents will be submitted online to the CIMEA portal at the time of apply.</p>
							<?php } ?>
							<p><b>Visa Checklist</b></p>
							<p>I have shared the visa checklist with you. This process doesn’t need to be started now; it will be done during the visa process.</p>
							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<p>Your Embassy is Islamabad, a 03-months maintained bank statement is required. Please start maintaining your statement 3 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php }elseif($clientEmbassy=="Karachi Embassy"){ ?>
							<p>Your Embassy is Karachi, a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php }elseif($clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy"){ ?>
							<p>Your Embassy is Dubai / Abu-Dhabi, a 03-months maintained bank statement is required. Your Embassy is Islamabad, a 03-months maintained bank statement is required. Please start maintaining your statement 03 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php }elseif($clientEmbassy=="Riyadh, Saudi Arabia Embassy"){ ?>
							<p>Your Embassy is Riyadh Saudi Arabia, a 06-months maintained bank statement is required. Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php }elseif($clientEmbassy=="Doha, Qatar Embassy"){ ?>
							<p>Your Embassy is Doha (Qatar), a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php }elseif($clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<p>Your Embassy is Mascat (Oman), a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.</p>
							<?php } ?>
						</div>

						<div class="col-md-12">
							<h4>
								<span style="font-size: 20px;"><b><mark>Step No 05:</mark></b></span><span><b> Send <mark><?php if($clientEmbassy=='Islamabad Embassy'){echo "DOV";}else{echo "Cimea";} ?> Checklist</mark> to the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="<?php if($clientEmbassy=='Islamabad Embassy'){echo "DOV";}else{echo "Cimea";} ?>" id="checklistName">
								<button type="button" class="btn btn-primary btn-sm float-right" onclick="veiwDOVCimeaList(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View <?php if($clientEmbassy=='Islamabad Embassy'){echo "DOV";}else{echo "Cimea";} ?> Checklist</button>
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
								<?php }elseif($clientEmbassy=='Muscat, Oman Embassy'){?>
								Muscat, Oman Checklist Link: <a href="https://info.wslcms.com/oman-cimea-checklist" target="_blank">info.wslcms.com/oman-cimea-checklist</a>
								<?php } ?>
								<div id="linktoast" class="toast"><?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Link copied to clipboard!</div>
								<button type="button" data-toggle="tooltip" data-placement="top" title="<?php if($clientEmbassy=='Islamabad Embassy' || $clientEmbassy=='Riyadh, Saudi Arabia Embassy'){echo "DOV";}else{echo "Cimea";} ?> Link" class="btn btn-dark btn-sm ml-1" onclick="copyLinkDOVCimea(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
							</h5>

							<h4 style="<?php echo $visaStyle;?>">
								<span style="font-size: 20px;"><b><mark>Step No 06:</mark></b></span> <span><b> Send <mark>Visa Checklist</mark> to the client (Send via WhatsApp) </b></span> &nbsp;&nbsp;&nbsp;&nbsp;
								<input type="hidden" name="" value="Visa" id="checklistVisaName">
								<button type="button" class="btn btn-primary btn-sm float-right" onclick="viewVisaList(<?php echo $clientID;?>)"><i class="mdi mdi-eye"></i> View Visa Checklist</button>
							</h4>
							<h5>
								<?php if($clientEmbassy=='Islamabad Embassy'){ ?>
								Punjab Visa Checklist Link: <a href="https://info.wslcms.com/punjab-visa-checklist" target="_blank">info.wslcms.com/punjab-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Karachi Embassy'){?>
								Sindh Visa Checklist Link: <a href="https://info.wslcms.com/sindh-visa-checklist" target="_blank">info.wslcms.com/sindh-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Dubai Embassy'){?>
								Dubai Visa Checklist Link: <a href="https://info.wslcms.com/dubai-visa-checklist" target="_blank">info.wslcms.com/dubai-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Abu Dhabi Embassy'){?>
								Abu Dhabi Visa Checklist Link: <a href="https://info.wslcms.com/abu-dhabi-visa-checklist" target="_blank">info.wslcms.com/abu-dhabi-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Riyadh, Saudi Arabia Embassy'){?>
								Saudia Riyadh Visa Checklist Link: <a href="https://info.wslcms.com/saudia-riyadh-visa-checklist" target="_blank">info.wslcms.com/saudia-riyadh-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Doha, Qatar Embassy'){?>
								Doha Visa Checklist Link: <a href="https://info.wslcms.com/doha-visa-checklist" target="_blank">info.wslcms.com/doha-visa-checklist</a>
								<?php }elseif($clientEmbassy=='Muscat, Oman Embassy'){?>
								Muscat, Oman Visa Checklist Link: <a href="https://info.wslcms.com/oman-visa-checklist" target="_blank">info.wslcms.com/oman-visa-checklist</a>
								<?php } ?>
								<div id="linkVisatoast" class="toast">Visa Link copied to clipboard!</div>
								<button type="button" data-toggle="tooltip" data-placement="top" title="Visa Link" class="btn btn-dark btn-sm ml-1" onclick="copyLinkVisa(<?php echo $clientID;?>)"><i class="mdi mdi-content-copy"></i></button>
							</h5>
						</div>
						<div class="form-group col-md-12">
							<div id="toast4" class="toast">Check your Email message copied to clipboard!</div>
							<h4><span style="font-size: 20px;"><b><mark>Step No 07:</mark></b></span><span><b> Check Your Email Message</b></span> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyIntroMessage('4')"><i class="mdi mdi-content-copy"></i></button> </h4>
						</div>
						<div class="col-md-12">
							<?php if($clientEmbassy=="Islamabad Embassy"){ ?>
							<p>Kindly also check your email, I have shared the DOV and VISA checklist with you along with voice notes.</p>
							<?php }elseif($clientEmbassy=="Karachi Embassy" || $clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy" || $clientEmbassy=="Doha, Qatar Embassy" || $clientEmbassy=="Riyadh, Saudi Arabia Embassy" || $clientEmbassy=="Muscat, Oman Embassy"){ ?>
							<p>Kindly also check your email, I have shared the Cimea and VISA checklist with you along with voice notes.</p>
							<?php } ?>
							<p>If you've any query kindly contact me.</p>
							<p>Thanks! 🙂</p>
						</div>
						<div class="col-md-12">
							<form id="formEmailWhatsapp" enctype="multipart/form-data" class="parsley-examples">
								<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
								<div class="row">
									<div class="form-group col-md-4">
										<div class="agreement-container" data-agreement-id="3">
											<label class="form-label">Upload ScreenShot <span class="text-danger">(Select multi Files)</span></label>
											<div class="d-flex justify-content-center">
												<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
												<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
											</div>
											<input type="file" name="italyInfoChecklistScreenShot[]" required="required" id="uploadedFiles3" class="form-control" multiple style="display: none;">
											<div class="preview"></div>
										</div>
										<?php 
										if($italyInfoChecklistScreenShot!=''){
										$fileMulti = explode(',', $italyInfoChecklistScreenShot);
										foreach ($fileMulti as $fileName) {
											?>
											<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
										<?php } }?>
									</div>
									<div class="form-group col-md-8">
										<label>Any Note</label>
										<textarea class="form-control" name="italyInfoChecklistNote"><?php echo $italyInfoChecklistNote;?></textarea>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="float-right">
											<button class="btn btn-primary" type="button" name="subitalyInfoChecklist" onclick="saveDataForm('formEmailWhatsapp', 'subitalyInfoChecklist')" id="subitalyInfoChecklist"><i class="mdi mdi-upload"></i> Update</button>
										</div> 
									</div>
								</div>
							</form>
						</div>
					</div>
				</fieldset>
			</div>
		</div>
		<!-- Client checklist -->
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
						<thead>
							<tr>
								<th width="5%">Sr.</th>
								<th width="10%">Date</th>
								<th width="15%">Checklist Name</th>
								<th width="30%">Files</th>
								<th width="40%">Email</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$sr=1;
						$select_query="SELECT * FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_client_check_id='".$clientID."' AND entry_by='".$_SESSION['user_id']."' ";
						$select_query_ex = mysqli_query($con,$select_query);
						if ($select_query_ex && mysqli_num_rows($select_query_ex) > 0) {
							foreach ($select_query_ex as $checkrow) {
							?>
							<tr id="<?php echo $checkrow['italy_checklist_id']?>">
								<td><?php echo $sr++; ?></td>
								<td><?php echo date("d-m-Y", strtotime($checkrow['italy_checklist_date'])); ?></td>
								<td><?php echo ucwords($checkrow['italy_checklist_name']);?></td>
								<td><a href="../payagreements/<?php echo $checkrow['italy_checklist_file']; ?>" target="_blank"><?php echo $checkrow['italy_checklist_file']; ?></a></td>
								<td class="ellipsis text-left" data-toggle="tooltip" data-placement="bottom" data-html="true" title="<?php echo htmlentities($checkrow['italy_checklist_body']); ?>">
									<?php echo $checkrow['italy_checklist_subject'];?> 
								</td>
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
			<div class="col-md-7">
				<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
					<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
					<input type="hidden" name="countryName" value="<?php echo $country;?>" id="countryName">
					<input type="hidden" name="clientEmbassy" value="<?php echo $clientEmbassy;?>" id="clientEmbassy">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">
							Checklist Details <span class="text-danger">*</span>
						</legend>
						<div class="row">
							<div class="form-group col-md-12">
								<label class="form-label">Select Checklist <span class="text-danger">*</span></label>
								<select class="form-control" name="checklistName" required="required" autocomplete="off" onchange="italyChecklistName();" id="italylistName">
									<option selected value disabled class="text-center">--- Select Checklist ---</option>
									<?php if ($clientEmbassy=="Islamabad Embassy") { ?>
									<option value="DOV">DOV</option>
									<option value="Visa">Visa</option>
									<?php }elseif($clientEmbassy=="Karachi Embassy" || $clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy" || $clientEmbassy=="Doha, Qatar Embassy" || $clientEmbassy=="Riyadh, Saudi Arabia Embassy" || $clientEmbassy=="Muscat, Oman Embassy"){ ?>
									<option value="Cimea">Cimea</option>
									<option value="Visa">Visa</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-12" id="already-msg"></div>
							<div class="form-group col-md-7">
								<div class="agreement-container" data-agreement-id="2">
									<label class="form-label">Checklist File <span class="text-danger">(Select multi Files)</span></label>
									<div class="d-flex justify-content-center">
										<input type="file" class="fileInput cust-file-input text-white" name="" multiple data-toggle="tooltip" data-placement="top" title="Select or Drag Files Here">
										<input type="text" class="form-control pasteInput" placeholder="Paste Image..."  autocomplete="off">
									</div>
									<input type="file" name="checklistFiles[]" id="uploadedFiles2" class="form-control" multiple style="display: none;">
									<div class="preview"></div>
								</div>
							</div>
							<div class="col-md-5"></div>
							<div class="form-group col-md-6">
								<label class="form-label">Checklist Send By Email</label>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="getCheckval" checked="" >
									<label class="form-check-label">Email</label>
								</div>
							</div>
							<div class="form-group col-md-6">
								<label class="form-label">Checklist Send By Whatsapp</label>
								<a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank"><?php echo $clientWhatApp; ?></a>
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Add CC Email <span class="text-danger">(Optional)</span></label>
								<input type="email" name="ccEmail" class="form-control" autocomplete="off">
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Subject <span class="text-danger">*</span></label>
								<input type="text" name="emailSubject" class="form-control" autocomplete="off" id="emailSubject">
							</div>
							<div class="form-group col-md-12">
								<label class="form-label">Email Body</label>
								<textarea class="form-control" name="listSendEmail" id="editor">
									<?php if ($clientEmbassy=="Islamabad Embassy") { ?>
									<p>🌟 Dear Students, 🌟</p>
									<p>We have shared the DOV and Visa Checklist with detailed voice notes for your guidance. 🎧 Please make sure to listen carefully and prepare your documents on time. ✅</p>
									<p>If any point seems unclear, feel free to reach out to us! We're here to guide you every step of the way. 📝✨</p>
									<?php }elseif($clientEmbassy=="Karachi Embassy" || $clientEmbassy=="Dubai Embassy" || $clientEmbassy=="Abu Dhabi Embassy" || $clientEmbassy=="Doha, Qatar Embassy" || $clientEmbassy=="Riyadh, Saudi Arabia Embassy" || $clientEmbassy=="Muscat, Oman Embassy"){ ?>
									<p>🌟 Dear Students, 🌟</p>
									<p>We have shared the CIMEA and Visa Checklist with detailed voice notes for your guidance. 🎧 Please make sure to listen carefully and prepare your documents on time. ✅</p>
									<p>If any point seems unclear, feel free to reach out to us! We're here to guide you every step of the way. 📝✨</p>
									<?php } ?>
									<p><b>Best Regards,</b></p>
									<p><b><?php echo ucwords($_SESSION['uname']);?></b></p>
									<p><b><?php echo ucwords($_SESSION['user_designation']);?></b></p>
									<p><b>Mobile:</b> <?php echo ucwords($_SESSION['phone']);?></p>
									<p>WSL Consultants (PVT) Ltd.</p>
									<p>Office No 12-13, 5th Floor Rukhshanda Heights Orange Line Sabzazar Station No 20, Opposite Ravi Block Allama Iqbal Town, Multan Road, Lahore</p>
								</textarea>
							</div>
							<script>
								var editor = CKEDITOR.replace('editor');
								CKFinder.setupCKEditor(editor);
							</script>
						</div>
					</fieldset>
					<div class="row">
						<div class="col-md-12">
							<div class="float-right">
								<button class="btn btn-custom" type="submit" name="subChecklist" id="submit"><i class="mdi mdi-upload"></i> Send Checklist</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-5">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">
						Checklist Preview <span class="text-danger">*</span>
					</legend>
					<div class="col-md-12" id="checklistContainer">

					</div>
				</fieldset>
			</div>
		</div>
		<?php } ?>
	</div>
</div>

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
				url: "models/_emailChecklistControllersState.php",
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
	function italyChecklistName() {
		var italylistName = $("#italylistName").val();
		var clientEmbassy = $("#clientEmbassy").val();

		if (italylistName && clientEmbassy) {
			$.ajax({
				url: 'checklistPreview.php',
				type: 'POST',
				data: {
					listName: italylistName,
					embassy: clientEmbassy
				},
				success: function(response) {
					$("#checklistContainer").html(response);
					$("#emailSubject").val(response.includes('DOV') ? italylistName + " DOV CHECKLIST WITH VOICES" : response.includes('Visa') ? italylistName + " VISA CHECKLIST WITH VOICES" : italylistName + " CIMEA CHECKLIST WITH VOICES");
				},
				error: function() {
					$("#checklistContainer").html('<p class="text-danger">Checklist not found.</p>');
				}
			});
		} else {
			$("#checklistContainer").html('');
			$("#emailSubject").val('');
		}
	}
</script>
<script type="text/javascript">
	// copy intro Message
	function copyIntroMessage(id) {
		var clientIDEmbassy = $("#clientIDEmbassy").val();
		if(id==1){
			var message = `Assalam-o-Alaikum!
This is the *Italy Head* from WSL Consultants' Head Office. I hope you are in good health. I would like to inform you that I’ve received your file.
Once your *university opens*, your admission application will be completed and you will be informed accordingly. From now on, I’ll monitor the entire process and assist you.If you have any additional queries, please feel free to let me know 🙂

Please note, another team member may contact you only for email login or verification codes.

*Do not reply to any other number.*
For all queries, contact only this number.

I will guide you from admission till visa process from here.
*Please save this number and communicate here*

السلام علیکم،
یہ اٹلی ہیڈ ہیں ڈبلیو ایس ایل کنسلٹنٹس ہیڈ آفس سے۔
امید ہے کہ آپ خیریت سے ہوں گے۔ میں آپ کو یہ اطلاع دینا چاہتی ہوں کہ مجھے آپ کی فائل موصول ہو گئی ہے۔
جیسے ہی آپ کی یونیورسٹی اوپن ہوگی، آپ کی ایڈمیشن اپلیکیشن مکمل کر کے آپ کو مطلع کر دیا جائے گا۔ اب سے میں پورے پراسیس کو مانیٹر کروں گی اور آخر تک آپ کی مدد کرتی رہوں گی۔
اگر آپ کے پاس مزید کوئی سوالات ہوں تو بلا جھجک مجھ سے رابطہ کریں 🙂

براہِ کرم نوٹ کریں کہ آپ سے کسی دوسرے ٹیم ممبر کی طرف سے صرف ای میل لاگ اِن یا ویریفکیشن کوڈ کے لیے رابطہ کیا جا سکتا ہے۔

*کسی اور نمبر پر جواب نہ دیں۔*

تمام سوالات کے لیے صرف اسی نمبر پر رابطہ کریں۔
میں داخلے سے لے کر ویزا کے عمل تک آپ کی مکمل رہنمائی یہی سے کروں گا/کروں گی۔

*براہِ کرم یہ نمبر محفوظ کر لیں اور اسی پر رابطے میں رہیں۔*`;
		}
		else if(id==2){
			var message = `*STEPS FOR THE ITALY PROCESS*

*Step 1 -* Apply for the Admission Application`;

if (clientIDEmbassy === "Islamabad Embassy") {
  message += `

*Step 2 -* Documents Attestation [IBCC, HEC, MOFA, Apostille] (The voices and DOV checklist will be shared on your email)`;
} else if (clientIDEmbassy === "Karachi Embassy") {
  message += `

*Step 2 -* Documents Attestation [IBCC, HEC, MOFA, Apostille] (The voices and CIMEA checklist will be shared on your email)`;
} else if (clientIDEmbassy === "Dubai Embassy" || clientIDEmbassy === "Abu Dhabi Embassy") {
  message += `

*Step 2 -* Documents Attestation [according to your country education department]`;
} else if (clientIDEmbassy === "Riyadh, Saudi Arabia Embassy" || clientIDEmbassy === "Muscat, Oman Embassy") {
  message += `

*Step 2 -* Documents Attestation [according to your country education department] (The voices and Cimea checklist will be shared on your email)`;
}
message += `

*Step 3 -* After Acceptance Apply for Pre Enrollment

*Step 4 -* Documents Translate into Italian Language (The lawyers details will be shared after acceptance)`;
if (clientIDEmbassy === "Islamabad Embassy") {
  message += `

*Step 5 -* Complete all documents of DOV and VISA Checklist ( The voices and DOV + VISA checklist will be shared on your email )`;
} else if (clientIDEmbassy === "Karachi Embassy" || clientIDEmbassy === "Dubai Embassy" || clientIDEmbassy === "Abu Dhabi Embassy" || clientIDEmbassy === "Doha, Qatar Embassy" || clientIDEmbassy === "Riyadh, Saudi Arabia Embassy" || clientIDEmbassy === "Muscat, Oman Embassy") {
  message += `

*Step 5 -* Apply for CIMEA and complete all documents of VISA Checklist ( The voices and CIMEA + VISA checklist will be shared on your email )`;
}
message += `

*Step 6 -* Apply for the Visa`;

		}

		else if(id==3){
if (clientIDEmbassy === "Islamabad Embassy") {
  message = `*DOV Checklist*

I have shared the DOV checklist with you. You need to start the attestation process for your documents right away. These documents will be submitted to the embassy at the time of the visa process.`;
} else if (clientIDEmbassy === "Karachi Embassy" || clientIDEmbassy === "Dubai Embassy" || clientIDEmbassy === "Abu Dhabi Embassy" || clientIDEmbassy === "Doha, Qatar Embassy" || clientIDEmbassy === "Riyadh, Saudi Arabia Embassy" || clientIDEmbassy === "Muscat, Oman Embassy") {
  message = `*CIMEA Checklist*

I have shared the CIMEA checklist with you. You need to start the attestation process for your documents right away. These documents will be submitted online to the CIMEA portal at the time of apply.`;
}
message += `

*Visa Checklist*

I have shared the visa checklist with you. This process doesn’t need to be started now; it will be done during the visa process.`;
if (clientIDEmbassy === "Islamabad Embassy") {
  message += `

Your Embassy is Islamabad, a 03-months maintained bank statement is required. Please start maintaining your statement 3 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
} else if (clientIDEmbassy === "Karachi Embassy") {
  message += `

Your Embassy is Karachi, a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
} else if (clientIDEmbassy === "Dubai Embassy" || clientIDEmbassy === "Abu Dhabi Embassy") {
  message += `

Your Embassy is Dubai / Abu-Dhabi, a 03-months maintained bank statement is required. Your Embassy is Islamabad, a 03-months maintained bank statement is required. Please start maintaining your statement 03 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
} else if (clientIDEmbassy === "Riyadh, Saudi Arabia Embassy") {
  message += `

Your Embassy is Riyadh Saudi Arabia, a 06-months maintained bank statement is required. Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
}else if (clientIDEmbassy === "Doha, Qatar Embassy") {
  message += `

Your Embassy is Doha (Qatar), a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
}else if (clientIDEmbassy === "Muscat, Oman Embassy") {
  message += `

Your Embassy is Muscat (Oman), a 06-months maintained bank statement is required.  Please start maintaining your statement 06 months before the visa process. Ensure transactions are done in a way that can be easily verified; it’s better to discuss this with us in advance.`;
}
		}

		else if(id==4){
if (clientIDEmbassy === "Islamabad Embassy") {
  var message = `Kindly also check your email, I have shared the DOV and VISA checklist with you along with voice notes.`;
} else if (clientIDEmbassy === "Karachi Embassy" || clientIDEmbassy === "Dubai Embassy" || clientIDEmbassy === "Abu Dhabi Embassy" || clientIDEmbassy === "Doha, Qatar Embassy" || clientIDEmbassy === "Riyadh, Saudi Arabia Embassy" || clientIDEmbassy === "Muscat, Oman Embassy") {
  var message = `Kindly also check your email, I have shared the Cimea and VISA checklist with you along with voice notes.`;
}
message += `

If you've any query kindly contact me.
Thanks! 🙂`;

		}
		navigator.clipboard.writeText(message).then(function() {
			var toast = document.getElementById("toast"+id+"");
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
		}else if(checklistName=='Cimea' && clientEmbassy=='Riyadh, Saudi Arabia Embassy'){
			var linkCopy=`info.wslcms.com/saudia-riyadh-dov-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Doha, Qatar Embassy'){
			var linkCopy=`info.wslcms.com/doha-cimea-checklist`;
		}else if(checklistName=='Cimea' && clientEmbassy=='Muscat, Oman Embassy'){
			var linkCopy=`info.wslcms.com/oman-cimea-checklist`;
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
			var linkCopy=`info.wslcms.com/abu-dhabi-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Riyadh, Saudi Arabia Embassy'){
			var linkCopy=`info.wslcms.com/saudia-riyadh-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Doha, Qatar Embassy'){
			var linkCopy=`info.wslcms.com/doha-visa-checklist`;
		}else if(checklistVisaName=='Visa' && clientEmbassy=='Muscat, Oman Embassy'){
			var linkCopy=`info.wslcms.com/oman-visa-checklist`;
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
</script>