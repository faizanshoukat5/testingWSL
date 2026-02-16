<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// delete steps from visa Process
if (isset($_POST['visaProcessID'])) {
	$visaID = $_POST['visaProcessID'];
	$delQuery = "UPDATE italy_clients_visa_intro_checklist".$_SESSION['dbNo']." SET close='0' WHERE visa_intro_checklist_id='".$visaID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// delete steps from visa Process
if (isset($_POST['visaCaseID'])) {
	$visaID = $_POST['visaCaseID'];
	$delQuery = "UPDATE italy_clients_visa_case_history".$_SESSION['dbNo']." SET close='0' WHERE visa_case_history_id='".$visaID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// delete document attestation and translate
if (isset($_POST['visaDocID'])) {
	$visaDocID = $_POST['visaDocID'];
	$delQuery = "UPDATE italy_clients_visa_attest_trans".$_SESSION['dbNo']." SET close='0' WHERE visa_attest_trans_id='".$visaDocID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// delete visa book appointment
if (isset($_POST['visaBookID'])) {
	$visaBookID = $_POST['visaBookID'];
	$delQuery = "UPDATE italy_clients_visa_book_appoint".$_SESSION['dbNo']." SET close='0' WHERE visa_book_appoint_id='".$visaBookID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// View hotel details
if (isset($_POST['checkHotelDetails'])) {
	$clientFrom = $_POST['checkHotelDetails'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Hotel Booking Details <span class="text-danger">*</span>
		</legend>
		<?php
		if($clientFrom=='Pakistan'){
		?>
		<h4>Hotel Booking – Ticket Reservation –  Travel Insurance Guidelines</h4>
		<div class="row">
			<div class="col-md-12">
				<h5><b><mark>1) Hotel & Flight Booking </mark></b> </h5>
				<p>For booking assistance, please contact: </p>
				<p>Traveling House: 📞 +92 334 3939999</p>
			</div>
			<?php
			$audioFiles = [
				"Hotel Booking – Ticket Reservation.mpeg"
			];
			$sr=1;
			foreach ($audioFiles as $file) { ?>
			<div class="form-group col-md-4">
				<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
				<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
					<source src="https://crm.wslcms.com/italy-videos/visa-process/pakistan-hotel-booking/<?php echo $file;?>" type="audio/ogg">
					Your browser does not support the audio element.
				</audio>
			</div>
			<?php 
			$sr++;}
			?>
			<div class="col-md-12 mt-2">
				<h5><b><mark>2) Travel Insurance</mark> </b> </h5>
				<p>Recommended travel insurance companies: </p>
				<ul>
					<li>PDF attached</li>
				</ul>
			</div>
			<div class="col-md-12">
				<label>List_of_Insurance_Company (PAK) <span class="text-danger">Click to Download</span></label> <br>
				<a href="https://crm.wslcms.com/italy-videos/visa-process/pakistan-hotel-booking/List_of_Insurance_Company (PAK).pdf" target="_blank">List_of_Insurance_Company (PAK).pdf </a>
			</div>
		</div>
		<?php
		}elseif($clientFrom=='UAE'){
		?>
		<h4>Hotel Booking – Ticket Reservation – Affidavit Attestation – Travel Insurance Guidelines</h4>
		<div class="row">
			<div class="col-md-12">
				<h5><b>1) Affidavit of Support Attestation Services</b></h5>
				<p>For affidavit of Support attestation, please contact: </p>
				<p><b>NOOR ALHIBA Translation and Attestation Services</b>: 📞 +971 54 525 4356  </p>
			</div>

			<?php
			$audioFiles = [
				"Affidavit Attestation.mp3"
			];
			$sr=1;
			foreach ($audioFiles as $file) { ?>
			<div class="form-group col-md-4">
				<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
				<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
					<source src="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/<?php echo $file;?>" type="audio/ogg">
					Your browser does not support the audio element.
				</audio>
			</div>
			<?php 
			$sr++;}
			?>
			<div class="col-md-4">
				<label>tax exemption for dubai <span class="text-danger">Click to Download</span></label> <br>
				<a href="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/tax exemption for dubai.docx" target="_blank">tax exemption for dubai.docx </a>
			</div>
			<div class="col-md-4">
				<label>Affidavit bank statement sponsor <span class="text-danger">Click to Download</span></label> <br>
				<a href="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/Affidavit bank statement sponsor.docx" target="_blank">Affidavit bank statement sponsor.docx </a>
			</div>
			<div class="col-md-4">
				<label>Affidavit bank statement (personal) <span class="text-danger">Click to Download</span></label> <br>
				<a href="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/Affidavit bank statement (personal).docx" target="_blank">Affidavit bank statement (personal).docx </a>
			</div>
			
			<div class="col-md-12 mt-2">
				<h5><b><mark>2) Hotel & Flight Booking</mark></b> </h5>
				<p>For booking assistance, please contact: </p>
				<p><b>Royal Atlantic World DCS LLC  </b> 📞 +971 567951791 </p>
			</div>

			<?php
			$audioFiles = [
				"Hotel & Flight booking agent.mp3"
			];
			$sr=1;
			foreach ($audioFiles as $file) { ?>
			<div class="form-group col-md-4">
				<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
				<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
					<source src="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/<?php echo $file;?>" type="audio/ogg">
					Your browser does not support the audio element.
				</audio>
			</div>
			<?php 
			$sr++;}
			?>

			<div class="col-md-12 mt-2">
				<h5><b><mark>3) Travel Insurance Booking</mark> </b>  </h5>
				<p>Recommended UAE-based travel insurance companies: </p>
				<ul>
					<li>AIG Travel Insurance</li>
					<li>Swisscare (Insured by Anker Insurance Company N.V.)</li>
					<li>RAK Insurance (<a href="https://www.rakinsurance.com/en/contactus">https://www.rakinsurance.com/en/contactus</a>)</li>
				</ul>
			</div>

			<?php
			$audioFiles = [
				"UAE travel insurance voice.mpeg"
			];
			$sr=1;
			foreach ($audioFiles as $file) { ?>
			<div class="form-group col-md-12">
				<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
				<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
					<source src="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/<?php echo $file;?>" type="audio/ogg">
					Your browser does not support the audio element.
				</audio>
			</div>
			<?php 
			$sr++;}
			?>

			<div class="col-md-6">
				<div class="card-box">
					<div class="embed-responsive embed-responsive-16by9">
						<video class="embed-responsive-item" width="100%" controls>
							<source src="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/AIG uae travel insurance.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card-box">
					<div class="embed-responsive embed-responsive-16by9">
						<video class="embed-responsive-item" width="100%" controls>
							<source src="https://crm.wslcms.com/italy-videos/visa-process/uae-hotel-booking/swiss travel insurance.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</fieldset>
<?php
}

// View Intro Message to send client
if (isset($_POST['checkIntroMessage'])) {
	$clientID = $_POST['checkIntroMessage'];
	$clientEmbassy = $_POST['checkclientEmbassy'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Intro Message <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<h5>I hope you are doing well. I will guide you through the visa application process. I will be available to clear any queries or concerns you may have regarding your visa.</h5>
					<h5><mark>Step 1</mark> - Educational & others Documents Attestation from IBCC, HEC, MOFA and Notary Public.</h5>
					<h5><mark>Step 2</mark> - Translate your Educational Documents into Italian Language (The lawyer's details will be shared after the acceptance letter).</h5>
					<?php if($clientEmbassy == 'Islamabad Embassy' || $clientEmbassy == 'Riyadh, Saudi Arabia Embassy'){ ?>
					<h5><mark>Step 3</mark> - Complete all documents of DOV and VISA Checklist (The voices and DOV + VISA checklist will be shared on your email).</h5>
					<?php }else{ ?>
					<h5><mark>Step 3</mark> - Complete all documents of CIMEA and VISA Checklist (The voices and CIMEA + VISA checklist will be shared on your email).</h5>
					<?php } ?>
					<h5><mark>Step 4</mark> - Apply for the Visa</h5>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

// View Intro Message to send client
if (isset($_POST['checkCimeaDOVList'])) {
	$clientID = $_POST['checkCimeaDOVList'];
	$checklistName = $_POST['checklistName'];
	$clientEmbassy = $_POST['checkclientEmbassy'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				<?php echo $checklistName;?> Checklist <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<?php if($clientEmbassy=='Islamabad Embassy' && $checklistName=='DOV'){ ?>
				<div class="col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Punjab Dov Checklist & Voices/CHECKLIST-FOR-DOV.pdf" target="blank">CHECKLIST-FOR-DOV </a>
				</div>
				<?php
				$audioFiles = [
					"00 DOV Intro part 1.mp3",
					"00 DOV Intro part 2.ogg",
					"01 Sec 1 - DOV Application.mp3",
					"02 Sec 1 - Admission Letter.mp3",
					"03 & 04 Sec 1 - Master Degree & Transcript.mp3",
					"05 & 06 Sec 1 - Bachelor Degree & Transcript.mp3",
					"07 Sec 1 - Inter.mp3",
					"08 Sec 1 - Matric.mp3",
					"09 Sec 1 - Domicile.mp3",
					"10 Sec 2 - Master translation & copy (1 to 4).mp3",
					"11 Sec 2 - Bachelor translation & copy (5 to 8).mp3",
					"12 Sec 2 - Inter & Matric translation & copy.mp3",
					"13 Sec 2 - Domicile & Passport copy attestation.mp3",
					"14 Sec 3 - Overview.mp3"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Punjab Dov Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				
				<div class="form-group col-md-4">
					<label><b>Apostille the documents</b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/apostille the documents.ogg" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<div class="form-group col-md-4">
					<ul>
						<li>If a student is applying for a Bachelor's program, he/she must apostille his/her Matric's degree, Inter's Degree, and Inter's mark sheet.</li>
						<li>If a student is applying for a Masters program, he/she must apostille his/her Matric's degree, Inter's degree, Bachelor's degree, and Bachelor's transcript.</li>
					</ul>
					<p><b class="text-danger">Note: </b> <b>To apostille the documents, remember that IBCC, HEC, and MOFA must already attest all your documents. And apostille your FRC as well.</b></p>
				</div>
				<?php }elseif($clientEmbassy=='Islamabad Embassy' && $checklistName=='Visa'){ ?>
				<div class="col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Punjab Visa Checklist & Voices/ISB Visa Checklist.pdf" target="blank">ISB Visa Checklist </a>
				</div>
				<?php
				$audioFiles = [
					"00 visa checklist intro.ogg",
					"01 visa form.ogg",
					"02 picture.ogg",
					"03 passport.ogg",
					"04 acceptance letter.ogg",
					"05 Summary.ogg",
					"06 C Type visa.ogg",
					"07 All educational doc.ogg",
					"08 DOV Documents.ogg",
					"09 tuition fee deposit slip.ogg",
					"10 Bank Statement Part 1.ogg",
					"10 Bank Statement part 2 (affidavit).mp3",
					"10 Bank Statement Part 3 (FRC).ogg",
					"10 Bank Statement part 4 (source of income).ogg",
					"10 Bank Statement part 5 (short overview).ogg",
					"11 IELTS.mp3",
					"12 FRC.ogg",
					"13-14 HOTEL & TICKET booking part 1.ogg",
					"13-14 HOTEL & TICKET booking part 2.ogg",
					"15 Travel Insurance.mp3",
					"16 visa fee.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Punjab Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				
				<div class="form-group col-md-4">
					<label><b>Apostille the documents</b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/apostille the documents.ogg" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<div class="form-group col-md-4">
					<ul>
						<li>If a student is applying for a Bachelor's program, he/she must apostille his/her Matric's degree, Inter's Degree, and Inter's mark sheet.</li>
						<li>If a student is applying for a Masters program, he/she must apostille his/her Matric's degree, Inter's degree, Bachelor's degree, and Bachelor's transcript.</li>
					</ul>
					<p><b class="text-danger">Note: </b> <b>To apostille the documents, remember that IBCC, HEC, and MOFA must already attest all your documents. And apostille your FRC as well.</b></p>
				</div>
				<?php }elseif($clientEmbassy=='Karachi Embassy' && $checklistName=='Cimea'){ ?>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Sindh Cimea Checklist & Voices/CIMEA CHECKLIST PAK.pdf" target="blank">CIMEA CHECKLIST PAK.pdf </a>
				</div>
				<!-- <div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Sindh Cimea Checklist & Voices/karachi italian lawyers.pdf" target="blank">karachi italian lawyers PDF </a>
				</div>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Sindh Cimea Checklist & Voices/Sindh Blochisatn CIMEA checklist.pdf" target="blank">Sindh Blochisatn CIMEA checklist PDF </a>
				</div> -->
				<?php
				$audioFiles = [
					"01 CIMEA INTRO.opus",
					"02 Why Cimea + Portal Name.opus",
					"03 CIMEA Cost & How to Apply.mp3",
					"04 Comparability & Verification.mp3",
					"05 Master Degree & Transcript.mp3",
					"06 Bachelor Transcript & Degree.mp3",
					"07 Inter.mp3",
					"08 Matric.mp3",
					"09 O & A Level.mp3",
					"10 Final Note.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Sindh Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<!-- <div class="form-group col-md-4">
					<label><b>Apostille the documents</b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/apostille the documents.ogg" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div> -->
				<div class="form-group col-md-4">
					<ul>
						<li>If a student is applying for a Bachelor's program, he/she must apostille his/her Matric's degree, Inter's Degree, and Inter's mark sheet.</li>
						<li>If a student is applying for a Masters program, he/she must apostille his/her Matric's degree, Inter's degree, Bachelor's degree, and Bachelor's transcript.</li>
					</ul>
					<p><b class="text-danger">Note: </b> <b>To apostille the documents, remember that IBCC, HEC, and MOFA must already attest all your documents. And apostille your FRC as well.</b></p>
				</div>
				<?php }elseif($clientEmbassy=='Karachi Embassy' && $checklistName=='Visa'){ ?>
				<div class="col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Sindh Visa Checklist & Voices/Karachi Visa Checklist 2025-26 (eng).pdf" target="_blank" style="font-size: 17px;">Karachi Visa Checklist 2025-26 (eng) </a>
				</div>
				<!-- <div class="col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Sindh Visa Checklist & Voices/Karachi Visa Checklist 2025-26 (urdu).pdf" target="_blank" style="font-size: 17px;">Karachi Visa Checklist 2025-26 (urdu) </a>
				</div> -->
				<?php
				$audioFiles = [
					"00 Intro.mp3",
					"01 visa form.ogg",
					"02 picture.ogg",
					"03 CNIC.mp3",
					"04 Motivation Letter.ogg",
					"05 Travel Insurance.mp3",
					"06 Flight Booking.ogg",
					"07 Accommodation.ogg",
					"08 Summary.ogg",
					"09 CIMEA Certificate.ogg",
					"10 Educational Documents Attestation & Italian translation.mp3",
					"11 Payment Receipt.ogg",
					"12 Bank Statement part 1.mp3",
					"12 Bank Statement part 2.mp3",
					"12 Bank Statement part 3.mp3",
					"12 Bank Statement part 4.mp3",
					"13 Repatriation.mp3",
					"14 Custody Letter for Minor Students.ogg",
					"15-16 passport and visa copies.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Sindh Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<!-- <div class="form-group col-md-4">
					<label><b>Apostille the documents</b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/apostille the documents.ogg" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<div class="form-group col-md-4">
					<ul>
						<li>If a student is applying for a Bachelor's program, he/she must apostille his/her Matric's degree, Inter's Degree, and Inter's mark sheet.</li>
						<li>If a student is applying for a Masters program, he/she must apostille his/her Matric's degree, Inter's degree, Bachelor's degree, and Bachelor's transcript.</li>
					</ul>
					<p><b class="text-danger">Note: </b> <b>To apostille the documents, remember that IBCC, HEC, and MOFA must already attest all your documents. And apostille your FRC as well.</b></p>
				</div> -->
				<?php }elseif($clientEmbassy=='Dubai Embassy' && $checklistName=='Cimea'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 CIMEA INTRO.opus",
					"02 Why Cimea + Portal Name.opus",
					"03 CIMEA Cost & How to Apply.mp3",
					"04 Comparability & Verification.mp3",
					"05 PAK & India Educational Docs Attestation.ogg",
					"06 UAE & Saudia Educational Docs Attestation.ogg",
					"07 O and A Level.ogg",
					"08 Short Overview.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Dubai Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Dubai Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="blank"> CIMEA CHECKLIST FOR UAE</a>
				</div>
				<!-- <div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Dubai Cimea Checklist & Voices/CIMEA Statement of verification.pdf" target="blank">CIMEA Statement of verification PDF </a>
				</div> -->
				<?php }elseif($clientEmbassy=='Dubai Embassy' && $checklistName=='Visa'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 visa form.ogg",
					"02 Photo.mp3",
					"03 passport.ogg",
					"04-05-06 valid RP card - visa copy - acceptance letter.ogg",
					"07 CIMEA.ogg",
					"08 Positive Test Score Card.mp3",
					"09 Verification.mp3",
					"10 Educational Documents Attestation.mp3",
					"11 IELTS.mp3",
					"12 Educational Docs & translation.mp3",
					"13 Bank Statement part 1.ogg",
					"13 Bank Statement part 2 (sponsor & NOC).ogg",
					"13 Bank Statement part 3 (credit statement).ogg",
					"14 Repatriation.mp3",
					"15 Travel Insurance.mp3",
					"16 accommodation part 1.ogg",
					"16 accommodation part 2.ogg",
					"17 Flight Booking.ogg",
					"18 Custody Letter for Minor Students.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Dubai Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Dubai Visa Checklist & Voices/Dubai Study Visa Checklist 2025_2026.pdf" target="blank"> Dubai Study Visa Checklist 2025_2026</a>
				</div>
				<?php }elseif($clientEmbassy=='Abu Dhabi Embassy' && $checklistName=='Cimea'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 CIMEA INTRO.opus",
					"02 Why Cimea + Portal Name.opus",
					"03 CIMEA Cost & How to Apply.mp3",
					"04 Comparability & Verification.mp3",
					"05 PAK & India Educational Docs Attestation.ogg",
					"06 UAE & Saudia Educational Docs Attestation.ogg",
					"07 O and A Level.ogg",
					"08 Short Overview.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="blank"> CIMEA CHECKLIST FOR UAE</a>
				</div>
				<!-- <div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/CIMEA Statement of verification.pdf" target="blank">CIMEA Statement of verification PDF </a>
				</div> -->
				<?php }elseif($clientEmbassy=='Abu Dhabi Embassy' && $checklistName=='Visa'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 Application form.mp3",
					"02 Photo.mp3",
					"03 passport.ogg",
					"04 UAE Residence Visa.mp3",
					"05 & 06 Visa copy and Admission letter.ogg",
					"07 Receipt of Payment.mp3",
					"08 Positive Test Score Card.mp3",
					"09 Verification.mp3",
					"10 Educational Documents Attestation.mp3",
					"11 IELTS.mp3",
					"12 Bank Statement part 1.ogg",
					"12 Bank Statement part 2 (sponsor & NOC).ogg",
					"12 Bank Statement part 3 (credit statement).ogg",
					"13 Repatriation.mp3",
					"14 Travel Insurance.mp3",
					"15 accommodation part 1.ogg",
					"15 accommodation part 2.ogg",
					"16 Flight Booking.ogg",
					"17 Custody Letter for Minor Students.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/Abu Dhabi Study Visa Checklist-2025-2026.pdf" style="font-size: 17px;" target="_blank"> Abu Dhabi Study Visa Checklist-2025-2026</a>
				</div>
				<?php }elseif($clientEmbassy=='Riyadh, Saudi Arabia Embassy' && $checklistName=='Cimea'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 CIMEA INTRO.opus",
					"02 Why Cimea + Portal Name.opus",
					"03 CIMEA Cost & How to Apply.mp3",
					"04 Comparability & Verification.mp3",
					"05 PAK & India Educational Docs Attestation.ogg",
					"06 UAE & Saudia Educational Docs Attestation.ogg",
					"07 O and A Level.ogg",
					"08 Short Overview.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Saudia Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<a href="https://crm.wslcms.com/italy-videos/checklist/Saudia Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="blank"> CIMEA CHECKLIST FOR UAE.pdf</a>
				</div>
				<?php }elseif($clientEmbassy=='Riyadh, Saudi Arabia Embassy' && $checklistName=='Visa'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 visa form.ogg",
					"02 picture part 1.ogg",
					"03 picture part 2.ogg",
					"04 Passport part 1.ogg",
					"05 Passport part 2.ogg",
					"06 ID Card (Iqama).ogg",
					"07 Educational Docs & DOV .ogg",
					"08 Ticket reservation.ogg",
					"09 any Visa & Iqama.ogg",
					"10 Part 1 (Exit Visa).ogg",
					"10 Part 2 (Exit Re-Entry Visa).mp3",
					"11 Accommodation.ogg",
					"12 Part 1 (Travel Health Insurance).mp3",
					"12 Part 2 (Gosi Insurance).mp3",
					"13 Bank Statement part 1.mp3",
					"14 Bank Statement Sponsor part 2.mp3",
					"15 Economic means & Chamber certificate.mp3",
					"16 FRC or Birth Certificate.mp3",
					"17 UniversItaly & DOV point.ogg",
					"18 Sponsorship form & Appointment.mp3",
					"19 Final Note.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Saudia Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Saudia Visa Checklist & Voices/CHECKLIST - ITALY IN SAUDI ARABIA_0-16-17.pdf" style="font-size: 17px;" target="_blank"> CHECKLIST - ITALY IN SAUDI ARABIA_0-16-17</a>
				</div>
				<?php }elseif($clientEmbassy=='Doha, Qatar Embassy' && $checklistName=='Cimea'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"1) CIMEA INTRO.opus",
					"2) Why Cimea + Portal Name.opus",
					"03 CIMEA Cost & How to Apply.mp3",
					"04 Comparability & Verification.mp3",
					"5) PAK & India Educational Docs Attestation.ogg",
					"6) Qatar Educational docs Attestation.mp3",
					"7) UAE & Saudia Educational Docs Attestation.ogg",
					"8) O  A Level.ogg",
					"9) Short Overview.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Doha Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Doha Cimea Checklist & Voices/CIMEA CHECKLIST FOR QATAR.pdf" style="font-size: 17px;" target="_blank"> CIMEA CHECKLIST FOR QATAR.pdf</a>
				</div>
				<!-- <div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Doha Cimea Checklist & Voices/CIMEA Statement of verification.pdf" style="font-size: 17px;" target="_blank"> CIMEA Statement of verification.pdf</a>
				</div> -->
				<?php }elseif($clientEmbassy=='Doha, Qatar Embassy' && $checklistName=='Visa'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 Visa Form.mp3",
					"02 Photo.mp3",
					"03 Passport.ogg",
					"04 Qatar ID Card.mp3",
					"05 Acceptance & Summary.mp3",
					"06 & 07 Educational docs & DOV.mp3",
					"08 Bank Statement part 1.mp3",
					"08 Bank Statement part 2  (Sponsor & Proof).mp3",
					"08 Bank Statement part 3 (saving account).mp3",
					"09 Summary or enrollment.mp3",
					"10 Ticket confirmation.mp3",
					"11 Travel Insurance.mp3",
					"12 Accommodation.mp3",
					"13 Educational Certificates.mp3",
					"14 Important Note.ogg",
					"15 Declaration.mp3",
					"16 Regulations.mp3"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Doha Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Doha Visa Checklist & Voices/Visa Checklist - study-long-stay.pdf" style="font-size: 17px;" target="_blank"> Visa Checklist - study-long-stay.pdf</a>
				</div>
				<?php }elseif($clientEmbassy=='Muscat, Oman Embassy' && $checklistName=='Cimea'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01) CIMEA INTRO.opus",
					"02) Why Cimea + Portal Name.opus",
					"03) CIMEA Cost & How to Apply.mp3",
					"04) Comparability & Verification.mp3",
					"05) PAK & India Educational Docs Attestation.ogg",
					"06) Qatar Educational docs Attestation.mp3",
					"07) UAE & Saudia Educational Docs Attestation.ogg",
					"08) Oman Educational Docs Attestation.mp3",
					"09) O  A Level.ogg",
					"10) Short Overview.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Oman Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Oman Cimea Checklist & Voices/CIMEA CHECKLIST FOR OMAN.pdf" style="font-size: 17px;" target="_blank"> CIMEA CHECKLIST FOR OMAN.pdf</a>
				</div>
				<?php }elseif($clientEmbassy=='Muscat, Oman Embassy' && $checklistName=='Visa'){ ?>
				<?php
				$audioFiles = [
					"00 Intro.ogg",
					"01 Application Form.mp3",
					"02 Passport.ogg",
					"03 Omani RP card.mp3",
					"04 Photo.mp3",
					"05 Acceptance or Summary.ogg",
					"06 DOV.mp3",
					"07 English Language Proof.mp3",
					"08 Accommodation part 1.mp3",
					"08 Accommodation part 2.mp3",
					"08 Accommodation part 3 (flight booking).mp3",
					"09 Bank Statement part 1.mp3",
					"09 Bank Statement part 2 (source of income).mp3",
					"09 Bank Statement part 3 (affidavit).mp3",
					"09 Bank Statement part 4 (scholarship).mp3",
					"09 Bank Statement part 5 (short overview).mp3",
					"10 Travel & Health Insurance.mp3",
					"11 Declaration.mp3",
					"12 Visa Fee.ogg"
				];
				$sr=1;
				foreach ($audioFiles as $file) { ?>
				<div class="form-group col-md-4">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="https://crm.wslcms.com/italy-videos/checklist/Oman Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="form-group col-md-4">
					<label>PDF</label> <br>
					<a href="https://crm.wslcms.com/italy-videos/checklist/Oman Visa Checklist & Voices/study_visa_university_enrolment.pdf" style="font-size: 17px;" target="_blank"> study_visa_university_enrolment.pdf</a>
				</div>
				<?php } ?>
			</div>
		</fieldset>
	</form>
<?php
}

// View Intro Message to send client
if (isset($_POST['checkCaseHistory'])) {
	$clientID = $_POST['checkCaseHistory'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Case History <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"case history.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
								<source src="https://crm.wslcms.com/italy-videos/visa-process/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
			</div>
			<h4>Student Details</h4>
			<?php 
			$selectCase = "SELECT * FROM italy_case_history_fill_by_clients WHERE close='1' AND status='1' AND case_history_fill_client_id='".$clientID."' ";
			$selectCase_ex = mysqli_query($con, $selectCase);
			foreach ($selectCase_ex as $row) {
			?>
			<div class="row">
				<div class="form-group col-md-4">
					<label>Name <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" required="required" value="<?php echo $row['case_client_name'];?>">
				</div>
				<div class="form-group col-md-4">
					<label>Date of Birth <span class="text-danger">*</span></label>
					<input type="Date" name="" class="form-control" required="required" value="<?php echo $row['case_client_dob'];?>">
				</div>
				<div class="form-group col-md-4">
					<label>Contact Number <span class="text-danger">*</span></label>
					<input type="number" name="" class="form-control" required="required" value="<?php echo $row['case_client_contact'];?>">
				</div>
				<div class="form-group col-md-4">
					<label>Email Address <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" required="required" value="<?php echo $row['case_client_email'];?>">
				</div>

				<div class="form-group col-md-4">
					<label>How much Gap in your Studies? <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" required="required" value="<?php echo $row['case_client_study_gap'];?>">
				</div>

				<div class="form-group col-md-4">
					<label>Who is Sponsor’s you <span class="text-danger">*</span></label>
					<select name="" class="form-control" required="required" onchange="sponserSelfRelative();" id="selfRelative">
						<option value="<?php echo $row['case_client_who_sponsor'];?>"><?php echo $row['case_client_who_sponsor'];?></option>
						<option value="Self">Self</option>
						<option value="Any Blood Relative(Parents, Siblings)">Any Blood Relative(Parents, Siblings)</option>
					</select>
				</div>
				<div class="form-group col-md-4" style="<?php if ($row['case_client_who_sponsor']=='Self') { ?> display: none; <?php } ?>" id="showRelationSponsor">
					<label>Relation with your Sponsor’s <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_sponsor_relation'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>

				<div class="form-group col-md-4">
					<label>Your Source of Income? <span class="text-danger">*</span></label>
					<select name="" class="form-control" required="required" onchange="sourceOfIncome();" id="sourceIncome">
						<option value="<?php echo $row['case_client_source_of_income'];?>"><?php echo $row['case_client_source_of_income'];?></option>
						<option value="Job">Job</option>
						<option value="Business">Business</option>
						<option value="Any Other Source of Income">Any Other Source of Income</option>
					</select>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Any Other Source of Income') { ?> display: none; <?php } ?>" id="showSourceOfIncome">
					<label>Explain Other Source of Income <span class="text-danger">*</span></label>
					<textarea class="form-control" name=""><?php echo $row['case_client_other_source_of_income'];?></textarea>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Job') { ?> display: none; <?php } ?>" id="showJobArea1">
					<label>Job Details <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_job_details'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>
				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Job') { ?> display: none; <?php } ?>" id="showJobArea2">
					<label>Monthly Salary <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_job_monthly_salary'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>
				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Job') { ?> display: none; <?php } ?>" id="showJobArea3">
					<label>Designation <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_job_designation'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>
				
				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Business') { ?> display: none; <?php } ?>" id="showBusinessArea1">
					<label>Business Details <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_business_details'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>
				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Business') { ?> display: none; <?php } ?>" id="showBusinessArea2">
					<label>Annual Income <span class="text-danger">*</span></label>
					<input type="text" name="" class="form-control" value="<?php echo $row['case_client_business_annual_income'];?>" style="border-bottom: 2px solid #e33244 !important;">
				</div>
				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']!='Business') { ?> display: none; <?php } ?>" id="showBusinessArea3">
					<label>Company Registred Status <span class="text-danger">*</span></label>
					<select name="" class="form-control" onchange="companyRegistredStatus();" id="companyStatus">
						<option value="<?php echo $row['case_client_company_status'];?>"><?php echo $row['case_client_company_status'];?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_company_status']!='Yes') { ?> display: none; <?php } ?>" id="showCompanyNote">
					<label>The company is registered from which authority? (For example  FBR ,SECP ) </label>
					<textarea class="form-control" name=""><?php echo $row['case_client_company_authority'];?></textarea>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_source_of_income']=='Any Other Source of Income') { ?> display: none; <?php } ?>" id="showNonFiler">
					<label>Filer / Non-Filer <span class="text-danger">*</span></label>
					<select name="" class="form-control" onchange="filerNonFiler();" id="nonFilerID">
						<option value="<?php echo $row['case_client_filer_non_filer'];?>"><?php echo $row['case_client_filer_non_filer'];?></option>
						<option value="Filer">Filer</option>
						<option value="Non-Filer">Non-Filer</option>
					</select>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_filer_non_filer']!='Filer') { ?> display: none; <?php } ?>" id="showTaxReturn">
					<label>Do you have last Two Years Tax Returns <span class="text-danger">*</span></label>
					<select name="" class="form-control">
						<option value="<?php echo $row['case_client_tax_return'];?>"><?php echo $row['case_client_tax_return'];?></option>
						<option value="Yes">Yes</option>
						<option value="No">No</option>
					</select>
				</div>

				<div class="form-group col-md-4">
					<label>Where did you get this amount to apply for the study visa? <span class="text-danger">*</span></label>
					<select name="" class="form-control" required="required" onchange="applyStudyVisa();" id="studyVisaApply">
						<option value="<?php echo $row['case_client_get_ammount'];?>"><?php echo $row['case_client_get_ammount'];?></option>
						<optgroup label="Self">
							<option value="Self Rental Property Income">Self Rental Property Income</option>
							<option value="Self Agriculture/Farming Income">Self Agriculture/Farming Income</option>
							<option value="Self Investments (Stocks, Shares, etc.)">Self Investments (Stocks, Shares, etc.)</option>
							<option value="Self Sale Property / Sale Vehicle">Self Sale Property / Sale Vehicle</option>
							<option value="Self Sale Inherited Property">Self Sale Inherited Property</option>
						</optgroup>
						<optgroup label="Sponsor">
							<option value="Sponsor Rental Property Income">Sponsor Rental Property Income</option>
							<option value="Sponsor Agriculture/Farming Income">Sponsor Agriculture/Farming Income</option>
							<option value="Sponsor Investments (Stocks, Shares, etc.)">Sponsor Investments (Stocks, Shares, etc.)</option>
							<option value="Sponsor Sale Property / Sale Vehicle">Sponsor Sale Property / Sale Vehicle</option>
							<option value="Sponsor Sale Inherited Property">Sponsor Sale Inherited Property</option>
						</optgroup>
						<option value="I have received this amount as a gift">I have received this amount as a gift</option>
						<option value="Any Other Source">Any Other Source</option>
					</select>
				</div>

				<div class="form-group col-md-4" style="<?php if ($row['case_client_get_ammount']!='Any Other Source') { ?> display: none; <?php } ?>" id="showStudyVisa">
					<label>If Any Source of Income <span class="text-danger">*</span></label>
					<textarea class="form-control" name=""><?php echo $row['case_client_amount_other_source'];?></textarea>
				</div>

				<div class="form-group col-md-4">
					<label>Bank Account Type <span class="text-danger">*</span></label>
					<select name="" class="form-control" required="required">
						<option value="<?php echo $row['case_client_account_type'];?>"><?php echo $row['case_client_account_type'];?></option>
						<option value="Savings">Savings</option>
						<option value="Current">Current</option>
						<option value="Joint">Joint</option>
					</select>
				</div>

				<div class="form-group col-md-12">
					<label>Any Other Information</label>
					<textarea class="form-control" name=""><?php echo $row['case_client_other_information'];?></textarea>
				</div>
			</div>
			<?php } ?>
		</fieldset>
	</form>
<?php }


// Guide about Educational documents attestation
if (isset($_POST['checkClientID'])) {
	$clientID = $_POST['checkClientID'];
	$clientApplied = $_POST['clientApplied'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Guide About Educational Documents Attestation <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<?php if($clientApplied=='bachelor' || $clientApplied=='mbbs'){ ?>
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"documents attestation bachelor part 01.ogg",
							"documents attestation bachelor part 02.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
								<source src="https://crm.wslcms.com/italy-videos/documents-attestation/bachelor/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="col-md-12">
					<h3>Guide About Educational Documents Attestation (<?php echo ucwords($clientApplied);?>)</h3>
					<ul>
						<li>Matric Degree (Certificate)</li>
						<li>Inter Marksheet</li>
						<li>Inter Degree (Certificate)</li>
					</ul>
					<h5>Attested from relevant Board, IBCC and MOFA</h5>
					<p>(Relevant Board, same day <mark>Time 3-4 hours</mark> & cost depend on your board)</p>
					<p>(IBCC time depends on your appointment & <mark>Cost 1200 PKR per document</mark>)</p>
					<ul>
						<li>Bachelor Transcript & Degree (If applicable)</li>
					</ul>
					<h5>Attested by relevant univesity, HEC and MOFA</h5>
					<p>(HEC time depends on your appointment & <mark>cost 1000 PKR per document</mark> (normal basis) and urgent basis <mark>3000 PKR extra charges + 1000 PKR per document</mark>)</p>
				</div>
				<?php }elseif($clientApplied=='master'){ ?>
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"documents attestation master part 01.ogg",
							"documents attestation master part 02.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
								<source src="https://crm.wslcms.com/italy-videos/documents-attestation/master/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="col-md-12">
					<h3>Guide About Educational Documents Attestation (Master's)</h3>
					<ul>
						<li>Matric Degree (Certificate)</li>
						<li>Inter Degree (Certificate)</li>
					</ul>
					<h5>Attested from relevant Board, IBCC and MOFA</h5>
					<p>(Relevant Board, same day <mark>Time 3-4 hours</mark> & cost depend on your board)</p>
					<p>(IBCC time depends on your appointment & <mark>Cost 1200 PKR per document</mark>)</p>
					<ul>
						<li>Bachelor Transcript</li>
						<li>Bachelor Degree</li>
						<li>Master Transcript & Degree (If Available)</li>
					</ul>
					<h5>Attested by relevant univesity, HEC and MOFA</h5>
					<p>(HEC time depends on your appointment & <mark>cost 1000 PKR per document</mark> (normal basis) and urgent basis <mark>3000 PKR extra charges + 1000 PKR per document</mark>)</p>
				</div>
				<?php } ?>
				<div class="col-md-12">
					<h3>Other Documents</h3>
					<h5>FRC Attested from MOFA</h5>
					<p><i>(same day Time 3-4 hours & cost vary)</i></p>
					<h5>MRC Attested from MOFA (if student married)</h5>
					<p><i>(same day <mark>Time 3-4 hours</mark> & cost vary) Domicile must be notarized 2 color copies (same day <mark>Time 3-4 hours</mark> & cost <mark>200 to 300</mark>)</i></p>
					<h5>Passport (first two Pages, second must be signed) must be notarized 3 color copies</h5>
					<p><i>(same day <mark>Time 3-4 hours</mark> & cost <mark>200 to 300</mark> per document)</i></p>
					<h5>Domicile - must be notarized 3 color copies</h5>
					<p><i>(same day <mark>Time 3-4 hours</mark> & cost <mark>200 to 300</mark> per document)</i></p>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

// Guide about Educational documents attestation
if (isset($_POST['checkLawClientID'])) {
	$clientID = $_POST['checkLawClientID'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Documents Translate into the Italian Language <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"Italian lawyers.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
								<source src="https://crm.wslcms.com/italy-videos/visa-process/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="form-group col-md-12">
					<label><a href="../italy-videos/(ISL) TRANSLATION-COMPANYS-LIST-MODIIFIED.pdf" target="_blank">(ISL) TRANSLATION-COMPANYS-LIST-MODIIFIED.pdf</a></label> <br>
					<iframe src="../italy-videos/(ISL) TRANSLATION-COMPANYS-LIST-MODIIFIED.pdf" width="100%" height="700px"></iframe>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

// Guide about Educational documents attestation
if (isset($_POST['checkSchClientID'])) {
	$clientID = $_POST['checkSchClientID'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Scholarship Details <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"scholarship-voices-part01.ogg",
							"scholarship-voices-part02.ogg",
							"scholarship-voices-part03.ogg",
							"scholarship-voices-part04.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
								<source src="https://crm.wslcms.com/italy-videos/scholarship/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="form-group col-md-3">
					<label>Announcement</label> <br>
					<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image01.jpeg" width="250" height="300">
				</div>
				<div class="form-group col-md-3">
					<label>Income Certificate</label> <br>
					<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image02.jpeg" width="250" height="300">
				</div>
				<div class="form-group col-md-3">
					<label>Property Certificate</label> <br>
					<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image03.jpeg" width="250" height="300">
				</div>
				<div class="form-group col-md-3">
					<label>FRC</label> <br>
					<img src="https://crm.wslcms.com/italy-videos/scholarship/FRC.png" width="250" height="300">
				</div>
				<div class="form-group col-md-12">
					<iframe src="https://crm.wslcms.com/italy-videos/scholarship/property certificate format.pdf" width="100%" height="800px"></iframe>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

// View Formats
if (isset($_POST['checkFormats'])) {
	$clientID = $_POST['checkFormats'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Formats <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="form-group col-lg-6">
					<label>1. MOFA Affidavit of financial support (Personal).doc</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/affidavit of financial support (Personal).doc">affidavit of financial support (Personal).doc</a>
				</div>
				<div class="form-group col-lg-6">
					<label>2. MOFA Affidavit of financial support (sponsor).doc</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/affidavit of financial support (sponsor).doc">affidavit of financial support (sponsor).doc</a>
				</div>
				<div class="form-group col-lg-6">
					<label>3. Affidavit bank statement (personal).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Affidavit bank statement (personal).docx">Affidavit bank statement (personal).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>4. Affidavit bank statement (provident funds).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Affidavit bank statement (provident funds).docx">Affidavit bank statement (provident funds).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>5. Affidavit bank statement sponsor.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Affidavit bank statement sponsor.docx">Affidavit bank statement sponsor.docx</a>
				</div>
				
				<div class="form-group col-lg-6">
					<label>6. AFFIDAVIT OF FINANCIAL SUPPORT (cash).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/AFFIDAVIT OF FINANCIAL SUPPORT (cash).docx">AFFIDAVIT OF FINANCIAL SUPPORT (cash).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>7. Authority For Documents Attestation.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Authority For Documents Attestation.docx">Authority For Documents Attestation.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>8. Business Letter head format.pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Business Letter head format.pdf">Business Letter head format.pdf</a>
				</div>
				<div class="form-group col-lg-6">
					<label>9. declaration- for business continuation (1).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/declaration- for business continuation (1).docx">declaration- for business continuation (1).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>10. declaration- for business continuation.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/declaration- for business continuation.docx">declaration- for business continuation.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>11. Declaration -for saudi arabia (1).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Declaration -for saudi arabia (1).docx">Declaration -for saudi arabia (1).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>12. Declaration -for saudi arabia.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Declaration -for saudi arabia.docx">Declaration -for saudi arabia.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>13. Declaration -for UK.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Declaration -for UK.docx">Declaration -for UK.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>14. Declaration of Family Income.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Declaration of Family Income.docx">Declaration of Family Income.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>15. Gift Deed (1).docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Gift Deed (1).docx">Gift Deed (1).docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>16. Letterhead Income Application.pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Letterhead Income Application.pdf">Letterhead Income Application.pdf</a>
				</div>
				<div class="form-group col-lg-6">
					<label>17. Partnership DEED.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Partnership DEED.docx">Partnership DEED.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>18. Rental agreement (1).pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Rental agreement (1).pdf">Rental agreement (1).pdf</a>
				</div>
				<div class="form-group col-lg-6">
					<label>19. Rental agreement.pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Rental agreement.pdf">Rental agreement.pdf</a>
				</div>
				<div class="form-group col-lg-6">
					<label>20. sales deed. word file for italy.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/sales deed. word file for italy.docx">sales deed. word file for italy.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>21. tax exemption for dubai.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/tax exemption for dubai.docx">tax exemption for dubai.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>22. To Whom It May Concern.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/To Whom It May Concern.docx">To Whom It May Concern.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>23. WhatsApp Image 2025-01-10 at 10.19.07 PM.jpeg</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/WhatsApp Image 2025-01-10 at 10.19.07 PM.jpeg">WhatsApp Image 2025-01-10 at 10.19.07 PM.jpeg</a>
				</div>

				<div class="form-group col-lg-6">
					<label>24. Affidavit of support- AGRICULTURAL LAND.docx</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/Affidavit of support- AGRICULTURAL LAND.docx">Affidavit of support- AGRICULTURAL LAND.docx</a>
				</div>
				<div class="form-group col-lg-6">
					<label>25. 114(1) (Return of Income filed voluntarily for complete year)_2024.pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/114(1) (Return of Income filed voluntarily for complete year)_2024.pdf">114(1) (Return of Income filed voluntarily for complete year)_2024.pdf</a>
				</div>
				<div class="form-group col-lg-6">
					<label>26. 114(1) (Return of Income filed voluntarily for complete year)_2023 (1).pdf</label>
					<a class="form-control" target="_blank" href="../italy-videos/affidavits-formats/114(1) (Return of Income filed voluntarily for complete year)_2023 (1).pdf">114(1) (Return of Income filed voluntarily for complete year)_2023 (1).pdf</a>
				</div>

				<!-- <hr width="100%">
				<div class="form-group col-lg-6">
					<label>M.L Constultant</label>
					<a class="form-control" target="_blank" href="../italy-videos/appointment-agent-image01.jpeg">M.L Constultant</a>
				</div>
				<div class="form-group col-lg-6">
					<label>Visa Mentors</label>
					<a class="form-control" target="_blank" href="../italy-videos/appointment-agent-image02.jpeg">Visa Mentors</a>
				</div> -->
			</div>
		</fieldset>
	</form>
<?php
}

// View Formats
if (isset($_POST['checkVisaFormID'])) {
	$clientID = $_POST['checkVisaFormID'];
	$clientEmbassy = $_POST['checkClientEmbassy'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Visa and Other Forms <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-lg-6">
					<h4>Form</h4>
					<div class="row">
						<?php 
						if($clientEmbassy=='Islamabad Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/DOV-Application.pdf" target="_blank">DOV-Application.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/DOV-Application.pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/Visa_Application_Long_Stay.pdf" target="_blank">Visa_Application_Long_Stay.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/Visa_Application_Long_Stay.pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/4._pre-enrollement_form_a.pdf" target="_blank">4._pre-enrollement_form_a.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/4._pre-enrollement_form_a.pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}if($clientEmbassy=='Karachi Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/karachi-embassy/4._pre-enrollement_form_a.pdf" target="_blank">4._pre-enrollement_form_a.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/karachi-embassy/4._pre-enrollement_form_a.pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/karachi-embassy/5._visa_form_d.pdf" target="_blank">5._visa_form_d.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/karachi-embassy/5._visa_form_d.pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}if($clientEmbassy=='Abu Dhabi Embassy'){
						?>
						
						<?php
						}if($clientEmbassy=='Dubai Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/dubai-embassy/Modulo_domanda_visto_nazionale-BILINGUE.pdf" target="_blank">Modulo_domanda_visto_nazionale-BILINGUE.pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/dubai-embassy/Modulo_domanda_visto_nazionale-BILINGUE.pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}
						?>
					</div>
				</div>
				<div class="col-lg-6" style="border-left: 5px solid black;">
					<h4>How to Fill Form</h4>
					<div class="row">
						<?php 
						if($clientEmbassy=='Islamabad Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/DOV-Application (1).pdf" target="_blank">DOV-Application (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/DOV-Application (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/Visa_Application_Long_Stay (1).pdf" target="_blank">Visa_Application_Long_Stay (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/Visa_Application_Long_Stay (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/islamabad-embassy/4._pre-enrollement_form_a (1).pdf" target="_blank">4._pre-enrollement_form_a (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/islamabad-embassy/4._pre-enrollement_form_a (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}if($clientEmbassy=='Karachi Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/karachi-embassy/4._pre-enrollement_form_a (1).pdf" target="_blank">4._pre-enrollement_form_a (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/karachi-embassy/4._pre-enrollement_form_a (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/karachi-embassy/5._visa_form_d (1).pdf" target="_blank">5._visa_form_d (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/karachi-embassy/5._visa_form_d (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}if($clientEmbassy=='Abu Dhabi Embassy'){
						?>
						
						<?php
						}if($clientEmbassy=='Dubai Embassy'){
						?>
						<div class="col-lg-12">
							<label><a href="../italy-videos/visa-embassy/dubai-embassy/Modulo_domanda_visto_nazionale-BILINGUE (1).pdf" target="_blank">Modulo_domanda_visto_nazionale-BILINGUE (1).pdf</a></label> <br>
							<iframe src="../italy-videos/visa-embassy/dubai-embassy/Modulo_domanda_visto_nazionale-BILINGUE (1).pdf" width="100%" height="400px"></iframe>
						</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</fieldset>
	</form>
<?php }

?>