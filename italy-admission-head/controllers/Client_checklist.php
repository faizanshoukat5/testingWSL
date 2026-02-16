<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// add check list of client
if (isset($_POST['subChecklist'])) {

	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$countryName = mysqli_real_escape_string($con, $_POST['countryName']);
	$clientEmbassy = mysqli_real_escape_string($con, $_POST['clientEmbassy']);
	$checklistName = mysqli_real_escape_string($con, $_POST['checklistName']);
	$current_date = date('Y-m-d');
	// One
	$checklistFiles='';
	if (!empty($_FILES['checklistFiles']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['checklistFiles']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['checklistFiles']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$checklistFiles = implode(',', $uploadedFiles);
		}
	}

	if (isset($_POST["getCheckval"])) {
		$checkboxValue = 1;
	} else {
		$checkboxValue = 0;
	}
	$ccEmail = $_POST['ccEmail'];
	$emailSubject = $_POST['emailSubject'];
	$listSendEmail = $_POST['listSendEmail'];

	if ($checkboxValue==1) {
		require '../assets/phpMailer/Exception.php';
		require '../assets/phpMailer/PHPMailer.php';
		require '../assets/phpMailer/SMTP.php';

		$sql="SELECT client_email, client_name FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND client_id='".$updateID."'";
		$data = mysqli_query($con, $sql);
		$clrow = mysqli_fetch_assoc($data);
		$clName = $clrow['client_name'];
		$clEmails = $clrow['client_email'];
		$getUrl = base64_encode($clrow['client_name']."".$clrow['client_email']);
		$mail = new PHPMailer(true);
		try {
			//Server settings
			$mail->SMTPDebug = SMTP::DEBUG_SERVER;
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'officewsl21@gmail.com';
			$mail->Password   = 'mrkbrqfhgvetvmad';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->SMTPDebug = 0;
			$mail->SMTPSecure = 'ssl';
			$mail->Port       = 465;
			//Recipients
			$mail->setFrom('officewsl21@gmail.com', 'WSL Consultants (Pvt) Ltd');
			$mail->addAddress($clEmails, $clName);     //Add a recipient
			$mail->addReplyTo('officewsl21@gmail.com', 'WSL Consultants (Pvt) Ltd');
			//Content
			$mail->isHTML(true);	                               //Set email format to HTML

			$mail->Subject = " ".$emailSubject." " ;

			$mail->Body = " ".$listSendEmail." ";
			if (($clientEmbassy=='Karachi Embassy') && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/01 CIMEA INTRO.opus',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/02 Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/03 CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/04 Comparability & Verification.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/05 Master Degree & Transcript.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/06 Bachelor Transcript & Degree.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/07 Inter.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/08 Matric.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/09 O & A Level.mp3',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/10 Final Note.ogg',
					'../italy-videos/checklist/Sindh Cimea Checklist & Voices/CIMEA CHECKLIST PAK.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}

			}elseif ($clientEmbassy=='Karachi Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/00 Intro.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/01 visa form.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/02 picture.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/03 CNIC.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/04 Motivation Letter.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/05 Travel Insurance.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/06 Flight Booking.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/07 Accommodation.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/08 Summary.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/09 CIMEA Certificate.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/10 Educational Documents Attestation & Italian translation.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/11 Payment Receipt.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/12 Bank Statement part 1.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/12 Bank Statement part 2.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/12 Bank Statement part 3.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/12 Bank Statement part 4.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/13 Repatriation.mp3',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/14 Custody Letter for Minor Students.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/15-16 passport and visa copies.ogg',
					'../italy-videos/checklist/Sindh Visa Checklist & Voices/Karachi Visa Checklist 2025-26 (eng).pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}

			}
			elseif ($clientEmbassy=='Dubai Embassy' && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/01 CIMEA INTRO.opus',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/02 Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/03 CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/04 Comparability & Verification.mp3',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/05 PAK & India Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/06 UAE & Saudia Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/07 O and A Level.ogg',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/08 Short Overview.ogg',
					'../italy-videos/checklist/Dubai Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Dubai Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/Dubai Study Visa Checklist 2025_2026.pdf',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/01 visa form.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/02 Photo.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/03 passport.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/04-05-06 valid RP card - visa copy - acceptance letter.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/07 CIMEA.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/08 Positive Test Score Card.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/09 Verification.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/10 Educational Documents Attestation.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/11 IELTS.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/12 Educational Docs & translation.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/13 Bank Statement part 1.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/13 Bank Statement part 2 (sponsor & NOC).ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/13 Bank Statement part 3 (credit statement).ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/14 Repatriation.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/15 Travel Insurance.mp3',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/16 accommodation part 1.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/16 accommodation part 2.ogg',
					'../italy-videos/checklist/Dubai Visa Checklist & Voices/18 Custody Letter for Minor Students.ogg'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Abu Dhabi Embassy' && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/01 CIMEA INTRO.opus',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/02 Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/03 CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/04 Comparability & Verification.mp3',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/05 PAK & India Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/06 UAE & Saudia Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/07 O and A Level.ogg',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/08 Short Overview.ogg',
					'../italy-videos/checklist/Abu Dhabi Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Abu Dhabi Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/Abu Dhabi Study Visa Checklist-2025-2026.pdf',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/01 Application form.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/02 Photo.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/03 passport.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/04 UAE Residence Visa.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/05 & 06 Visa copy and Admission letter.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/07 Receipt of Payment.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/08 Positive Test Score Card.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/09 Verification.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/10 Educational Documents Attestation.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/11 IELTS.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/12 Bank Statement part 1.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/12 Bank Statement part 2 (sponsor & NOC).ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/12 Bank Statement part 3 (credit statement).ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/13 Repatriation.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/14 Travel Insurance.mp3',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/15 accommodation part 1.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/15 accommodation part 2.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/16 Flight Booking.ogg',
					'../italy-videos/checklist/Abu Dhabi Visa Checklist & Voices/17 Custody Letter for Minor Students.ogg'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Islamabad Embassy' && $checklistName=='DOV') {
				$attachments = [
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/00 DOV Intro part 1.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/00 DOV Intro part 2.ogg',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/01 Sec 1 - DOV Application.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/02 Sec 1 - Admission Letter.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/03 & 04 Sec 1 - Master Degree & Transcript.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/05 & 06 Sec 1 - Bachelor Degree & Transcript.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/07 Sec 1 - Inter.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/08 Sec 1 - Matric.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/09 Sec 1 - Domicile.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/10 Sec 2 - Master translation & copy (1 to 4).mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/11 Sec 2 - Bachelor translation & copy (5 to 8).mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/12 Sec 2 - Inter & Matric translation & copy.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/13 Sec 2 - Domicile & Passport copy attestation.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/14 Sec 3 - Overview.mp3',
					'../italy-videos/checklist/Punjab Dov Checklist & Voices/CHECKLIST-FOR-DOV.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}
			elseif ($clientEmbassy=='Islamabad Embassy' && $checklistName=='Visa') {
				$attachmentPaths = [
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/00 visa checklist intro.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/01 visa form.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/02 picture.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/03 passport.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/04 acceptance letter.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/05 Summary.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/06 C Type visa.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/07 All educational doc.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/08 DOV Documents.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/09 tuition fee deposit slip.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/10 Bank Statement Part 1.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/10 Bank Statement part 2 (affidavit).mp3',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/10 Bank Statement Part 3 (FRC).ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/10 Bank Statement part 4 (source of income).ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/10 Bank Statement part 5 (short overview).ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/11 IELTS.mp3',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/12 FRC.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/13-14 HOTEL & TICKET booking part 1.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/13-14 HOTEL & TICKET booking part 2.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/15 Travel Insurance.mp3',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/16 visa fee.ogg',
					'../italy-videos/checklist/Punjab Visa Checklist & Voices/ISB Visa Checklist.pdf'
				];

				foreach ($attachmentPaths as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}
			elseif ($clientEmbassy=='Riyadh, Saudi Arabia Embassy' && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/01 CIMEA INTRO.opus',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/02 Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/03 CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/04 Comparability & Verification.mp3',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/05 PAK & India Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/06 UAE & Saudia Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/07 O and A Level.ogg',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/08 Short Overview.ogg',
					'../italy-videos/checklist/Saudia Cimea Checklist & Voices/CIMEA CHECKLIST FOR UAE.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Riyadh, Saudi Arabia Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/CHECKLIST - ITALY IN SAUDI ARABIA_0-16-17.pdf',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/01 visa form.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/02 picture part 1.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/03 picture part 2.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/04 Passport part 1.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/05 Passport part 2.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/06 ID Card (Iqama).ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/07 Educational Docs & DOV .ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/08 Ticket reservation.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/09 any Visa & Iqama.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/10 Part 1 (Exit Visa).ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/10 Part 2 (Exit Re-Entry Visa).mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/11 Accommodation.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/12 Part 1 (Travel Health Insurance).mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/12 Part 2 (Gosi Insurance).mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/13 Bank Statement part 1.mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/14 Bank Statement Sponsor part 2.mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/15 Economic means & Chamber certificate.mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/16 FRC or Birth Certificate.mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/17 UniversItaly & DOV point.ogg',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/18 Sponsorship form & Appointment.mp3',
					'../italy-videos/checklist/Saudia Visa Checklist & Voices/19 Final Note.ogg'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Doha, Qatar Embassy' && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/1) CIMEA INTRO.opus',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/2) Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/03 CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/04 Comparability & Verification.mp3',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/5) PAK & India Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/6) Qatar Educational docs Attestation.mp3',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/7) UAE & Saudia Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/8) O  A Level.ogg',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/9) Short Overview.ogg',
					'../italy-videos/checklist/Doha Cimea Checklist & Voices/CIMEA CHECKLIST FOR QATAR.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}
			elseif ($clientEmbassy=='Doha, Qatar Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Doha Visa Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/01 Visa Form.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/02 Photo.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/03 Passport.ogg',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/04 Qatar ID Card.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/05 Acceptance & Summary.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/06 & 07 Educational docs & DOV.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/08 Bank Statement part 1.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/08 Bank Statement part 2  (Sponsor & Proof).mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/08 Bank Statement part 3 (saving account).mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/09 Summary or enrollment.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/10 Ticket confirmation.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/11 Travel Insurance.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/12 Accommodation.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/13 Educational Certificates.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/14 Important Note.ogg',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/15 Declaration.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/16 Regulations.mp3',
					'../italy-videos/checklist/Doha Visa Checklist & Voices/Visa Checklist - study-long-stay.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			elseif ($clientEmbassy=='Muscat, Oman Embassy' && $checklistName=='Cimea') {
				$attachments = [
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/01) CIMEA INTRO.opus',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/02) Why Cimea + Portal Name.opus',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/03) CIMEA Cost & How to Apply.mp3',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/04) Comparability & Verification.mp3',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/05) PAK & India Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/06) Qatar Educational docs Attestation.mp3',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/07) UAE & Saudia Educational Docs Attestation.ogg',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/08) Oman Educational Docs Attestation.mp3',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/09) O  A Level.ogg',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/10) Short Overview.ogg',
					'../italy-videos/checklist/Oman Cimea Checklist & Voices/CIMEA CHECKLIST FOR OMAN.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}
			elseif ($clientEmbassy=='Muscat, Oman Embassy' && $checklistName=='Visa') {
				$attachments = [
					'../italy-videos/checklist/Oman Visa Checklist & Voices/00 Intro.ogg',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/01 Application Form.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/02 Passport.ogg',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/03 Omani RP card.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/04 Photo.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/05 Acceptance or Summary.ogg',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/06 DOV.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/07 English Language Proof.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/08 Accommodation part 1.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/08 Accommodation part 2.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/08 Accommodation part 3 (flight booking).mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/09 Bank Statement part 1.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/09 Bank Statement part 2 (source of income).mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/09 Bank Statement part 3 (affidavit).mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/09 Bank Statement part 4 (scholarship).mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/09 Bank Statement part 5 (short overview).mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/10 Travel & Health Insurance.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/11 Declaration.mp3',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/12 Visa Fee.ogg',
					'../italy-videos/checklist/Oman Visa Checklist & Voices/study_visa_university_enrolment.pdf'
				];

				foreach ($attachments as $attachment) {
					if (file_exists($attachment)) {
						$mail->addAttachment($attachment);
					}
				}
			}

			if ($ccEmail!='') {
				$mail->AddCC($ccEmail);
			}else{

			}
			// $mail->AddCC('muhmaliksafdar@gmail.com');
			// $mail->AddCC('wslconsultants04@gmail.com');
			// $mail->AddCC('officewsl03@gmail.com');
			$mail->send();
			$addcheckList = "INSERT INTO `italy_clients_checklist".$_SESSION['dbNo']."` (`italy_client_check_id`, `italy_checklist_name`, `italy_checklist_file`, `italy_checklist_date`, `italy_checklist_cc_email`, `italy_checklist_subject`, `italy_checklist_body`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$checklistName."', '".$checklistFiles."', '".$current_date."', '".$ccEmail."', '".$emailSubject."', '".$listSendEmail."', '1', '1', '".$_SESSION['user_id']."' )";
			$addcheckList_ex = mysqli_query($con,$addcheckList);
			if ($addcheckList_ex) {
				header('location: client-checklist?client-id='.$updateID.'&'.$getUrl.' ');
			}else{
				echo "<div class='alert alert-success'>
				<strong>There is an error in the query!
				</div>";
			}
			exit();
		} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}elseif($checkboxValue==0){
		$addcheckList = "INSERT INTO `italy_clients_checklist".$_SESSION['dbNo']."` (`italy_client_check_id`, `italy_checklist_name`, `italy_checklist_file`, `italy_checklist_date`, `italy_checklist_subject`, `italy_checklist_body`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$checklistName."', '".$checklistFiles."', '".$current_date."', '', '', '1', '1', '".$_SESSION['user_id']."' )";
		$addcheckList_ex = mysqli_query($con,$addcheckList);
		if ($addcheckList_ex) {
			header('location: client-checklist?client-id='.$updateID.'&'.$getUrl.' ');
		}else{
			echo "<div class='alert alert-success'>
			<strong>There is an error in the query!
			</div>";
		}
	}
}

?>