<?php 
if (isset($_POST['listName'])) {
	$italylistName = $_POST['listName'];
	$clientEmbassy = $_POST['embassy'];
	if ($italylistName=='DOV' && $clientEmbassy=='Islamabad Embassy') {
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Punjab Dov Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php
				$sr++; }
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Punjab Dov Checklist & Voices/CHECKLIST-FOR-DOV.pdf" target="_blank">CHECKLIST-FOR-DOV </a>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Islamabad Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					foreach ($audioFiles as $file) {?>
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Punjab Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
				</div>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Punjab Visa Checklist & Voices/ISB Visa Checklist.pdf" target="blank">ISB Visa Checklist </a>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Karachi Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12" style="width:200px;">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Sindh Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Sindh Cimea Checklist & Voices/CIMEA CHECKLIST PAK.pdf" target="blank">CIMEA CHECKLIST PAK.pdf </a>
				</div>
				<!-- <div class="col-md-12">
					<a href="../italy-videos/checklist/Sindh Cimea Checklist & Voices/karachi italian lawyers.pdf" target="blank">karachi italian lawyers PDF </a>
				</div>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Sindh Cimea Checklist & Voices/Sindh Blochisatn CIMEA checklist.pdf" target="blank">Sindh Blochisatn CIMEA checklist PDF </a>
				</div> -->
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Karachi Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Sindh Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio tag.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="col-md-6">
					<a href="../italy-videos/checklist/Sindh Visa Checklist & Voices/Karachi Visa Checklist 2025-26 (eng).pdf" target="blank">Karachi Visa Checklist 2025-26 (eng).pdf </a>
				</div>
				<!-- <div class="col-md-6">
					<a href="../italy-videos/checklist/Sindh Visa Checklist & Voices/Karachi Visa Checklist 2025-26 (urdu).pdf" target="blank">Karachi Visa Checklist 2025-26 (urdu) </a>
				</div> -->
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Dubai Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12" style="width:200px;">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Dubai Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Dubai Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="blank"> CIMEA CHECKLIST FOR UAE.pdf</a>
				</div>
				<!-- <div class="col-md-12">
					<a href="../italy-videos/checklist/Dubai Cimea Checklist & Voices/CIMEA Statement of verification.pdf" target="blank">CIMEA Statement of verification PDF </a>
				</div> -->
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Dubai Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12" style="width:200px;">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Dubai Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php
				$sr++;}
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Dubai Visa Checklist & Voices/Dubai Study Visa Checklist 2025_2026.pdf" target="blank"> Dubai Study Visa Checklist 2025_2026</a>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Abu Dhabi Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12" style="width:200px;">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="blank"> CIMEA CHECKLIST FOR UAE</a>
				</div>
				<!-- <div class="col-md-12">
					<a href="../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/CIMEA Statement of verification.pdf" target="blank">CIMEA Statement of verification PDF </a>
				</div> -->
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Abu Dhabi Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
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
				<div class="col-md-12" style="width:200px;">
					<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
					<audio controls preload="auto">
						<source src="../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/<?php echo $file;?>" type="audio/ogg">
						Your browser does not support the audio element.
					</audio>
				</div>
				<?php 
				$sr++;}
				?>
				<div class="col-md-12">
					<a href="../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/Abu Dhabi Study Visa Checklist-2025-2026.pdf" target="blank"> Abu Dhabi Study Visa Checklist-2025-2026.pdf</a>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Riyadh, Saudi Arabia Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Saudia Cimea Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="col-md-12">
						<a href="../italy-videos/checklist/Saudia Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf" target="_blank">CIMEA CHECKLIST FOR UAE </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Riyadh, Saudi Arabia Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Saudia Visa Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="col-md-12">
						<a href="../italy-videos/checklist/Saudia Visa Checklist & Voices/CHECKLIST - ITALY IN SAUDI ARABIA_0-16-17.pdf" target="_blank">CHECKLIST - ITALY IN SAUDI ARABIA_0-16-17 </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Doha, Qatar Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Doha Cimea Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="form-group col-md-4">
						<label>PDF</label> <br>
						<a href="../italy-videos/checklist/Doha Cimea Checklist & Voices/CIMEA CHECKLIST FOR QATAR.pdf" style="font-size: 17px;" target="_blank"> CIMEA CHECKLIST FOR QATAR.pdf</a>
					</div>
					<!-- <div class="form-group col-md-4">
						<label>PDF</label> <br>
						<a href="../italy-videos/checklist/Doha Cimea Checklist & Voices/CIMEA Statement of verification.pdf" style="font-size: 17px;" target="_blank"> CIMEA Statement of verification.pdf</a>
					</div> -->
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Doha, Qatar Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Doha Visa Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="col-md-12">
						<a href="../italy-videos/checklist/Doha Visa Checklist & Voices/Visa Checklist - study-long-stay.pdf" target="_blank">Visa Checklist - study-long-stay </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Cimea' && $clientEmbassy=='Muscat, Oman Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Oman Cimea Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="form-group col-md-4">
						<label>PDF</label> <br>
						<a href="../italy-videos/checklist/Oman Cimea Checklist & Voices/CIMEA CHECKLIST FOR OMAN.pdf" style="font-size: 17px;" target="_blank"> CIMEA CHECKLIST FOR OMAN.pdf</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php }elseif ($italylistName=='Visa' && $clientEmbassy=='Muscat, Oman Embassy') { ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="row">
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
					<div class="col-md-12">
						<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
						<audio controls preload="auto">
							<source src="../italy-videos/checklist/Oman Visa Checklist & Voices/<?php echo $file;?> " type="audio/ogg">
							Your browser does not support the audio element.
						</audio>
					</div>
					<?php
					$sr++; }
					?>
					<div class="col-md-12">
						<a href="../italy-videos/checklist/Oman Visa Checklist & Voices/study_visa_university_enrolment.pdf" target="_blank">study_visa_university_enrolment.pdf </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>

<?php
}
?>