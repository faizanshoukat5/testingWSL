<div class="row">
	<div class="form-group col-md-6 col-lg-3">
		<label>Client Status</label>
		<select class="form-control" name="client-convert-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-convert-status">
			<option value="all" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="New Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'New Client' ? 'selected' : '' ?>>New Client</option>
			<option value="Old Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Client' ? 'selected' : '' ?>>Old Client</option>
			<option value="Old Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Converted Client' ? 'selected' : '' ?>>Old Converted Client</option>
			<option value="Italy Old Client 2024" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Old Client 2024' ? 'selected' : '' ?>>Italy Old Client 2024</option>
			<option value="Austria Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Austria Converted Client' ? 'selected' : '' ?>>Austria Converted Client</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Country From</label>
		<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
			<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
			<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
			<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Intake</label>
		<select class="form-control" name="intake-year" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="intake-year">
			<option value="all" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="25-26" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '25-26' ? 'selected' : '' ?>>2025-2026</option>
			<option value="26-27" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '26-27' ? 'selected' : '' ?>>2026-2027</option>
			<option value="Both" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'Both' ? 'selected' : '' ?>>2025-2026/2026-2027(Both)</option>
			<option value="27-28" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '27-28' ? 'selected' : '' ?>>2027-2028</option>
		</select>
	</div>
	
	<div class="form-group col-md-6 col-lg-3">
		<label>Assign</label>
		<select class="form-control" name="assign-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-programs">
			<option value="all" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'all' ? 'selected' : '' ?>>All</option>
			<?php if($clientDegree=='bachelor'){ ?>
				<?php if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='Sapienza University of Rome (SPU)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Camerino (UC)' || $uniName=='University of Camerino (CM)' || $uniName=='Tor Vergata University of Rome (TVR)' || $uniName=='University of Milan (UML)' || $uniName=='University of Turin (TU)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Bari (UB)' || $uniName=='University of Tor Vergata (TVR)' || $uniName=="University of Genova (UG)"){ ?>
					<option value="Assign but Not Paid Fee" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign but Not Paid Fee' ? 'selected' : '' ?>>Assign but Not Paid Fee</option>
					<option value="Fee Paid but Not Approved" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Approved' ? 'selected' : '' ?>>Fee Paid but Not Approved</option>
					<option value="Fee Paid but Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Applied' ? 'selected' : '' ?>>Fee Paid but Not Applied</option>
				<?php } ?>
			<?php }elseif($clientDegree=='master'){ ?>
				<?php if($uniName=='CaFoscari University of Venice (FV)' || $uniName=='Sapienza University of Rome (SPU)' || $uniName=='University of Bologna (UBN)' || $uniName=='University of Padua (PDU)' || $uniName=='University of Pavia (PV)' || $uniName=='University of Siena (US)' || $uniName=='University of Florence (UF)' || $uniName=='University of Ferrara (FR)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Trento (TRN)' || $uniName=='University of Milano Bicocca (MLB)' || $uniName=='University of Pisa (UP)' || $uniName=='University of Messina (UM)' || $uniName=='University of Cassino (CS)' || $uniName=='University of Camerino (UC)' || $uniName=='University of Camerino (CM)' || $uniName=='Tor Vergata University of Rome (TVR)' || $uniName=='University of Milan (UML)' || $uniName=='University of Turin (TU)' || $uniName=='University of Trieste (TR)' || $uniName=='University of Bari (UB)' || $uniName=='University of Tor Vergata (TVR)' || $uniName=='University of Laquila (LAQ)' || $uniName=="University of Genova (UG)" || $uniName=="University of Parma (PRM)" ){ ?>
					<option value="Assign but Not Paid Fee" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign but Not Paid Fee' ? 'selected' : '' ?>>Assign but Not Paid Fee</option>
					<option value="Fee Paid but Not Approved" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Approved' ? 'selected' : '' ?>>Fee Paid but Not Approved</option>
					<option value="Fee Paid but Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Applied' ? 'selected' : '' ?>>Fee Paid but Not Applied</option>
				<?php } ?>
			<?php }elseif($clientDegree=='mbbs'){ ?>
				<?php if($uniName=='University of Pavia (PV)' || $uniName=='Universita Politecnica Delle Marche (MR)' || $uniName=='University of Marche (MR)' || $uniName=='University of Messina (UM)'){ ?>
					<option value="Assign but Not Paid Fee" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign but Not Paid Fee' ? 'selected' : '' ?>>Assign but Not Paid Fee</option>
					<option value="Fee Paid but Not Approved" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Approved' ? 'selected' : '' ?>>Fee Paid but Not Approved</option>
					<option value="Fee Paid but Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Applied' ? 'selected' : '' ?>>Fee Paid but Not Applied</option>
				<?php } ?>
			<?php } ?>
			<option value="All Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Assign Programs' ? 'selected' : '' ?>>All Assign Programs</option>
			<option value="All Not Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Programs' ? 'selected' : '' ?>>All Not Assign Programs</option>
			<option value="Assign But Not Approved" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign But Not Approved' ? 'selected' : '' ?>>Assign But Not Approved</option>
			<option value="Assign But Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign But Not Applied' ? 'selected' : '' ?>>Assign But Not Applied</option>
			<option value="Assign and Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign and Applied' ? 'selected' : '' ?>>Assign and Applied</option>

			<option value="One Time Account Create" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
		</select>
	</div>
	
	<div class="form-group col-md-6 col-lg-3">
		<label>After Admission Due</label>
		<select class="form-control" name="admission-due" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="admission-due">
			<option value="all" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="After Admission Dues Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'After Admission Dues Clear Clients' ? 'selected' : '' ?>>After Admission Dues Clear Clients</option>
			<option value="After Admission Dues Not Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'After Admission Dues Not Clear Clients' ? 'selected' : '' ?>>After Admission Dues Not Clear Clients</option>

			<option value="Advance Remaining Payment Not Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'Advance Remaining Payment Not Clear Clients' ? 'selected' : '' ?>>Advance Remaining Payment Not Clear Clients</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Deadline Status</label>
		<select class="form-control" name="deadline-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="deadline-status">
			<option value="all" <?= isset($_GET['deadline-status']) && $_GET['deadline-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Deadline Hold" <?= isset($_GET['deadline-status']) && $_GET['deadline-status'] == 'Deadline Hold' ? 'selected' : '' ?>>Deadline Hold</option>
			<option value="Deadline Release" <?= isset($_GET['deadline-status']) && $_GET['deadline-status'] == 'Deadline Release' ? 'selected' : '' ?>>Deadline Release</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>SOP's Status</label>
		<select class="form-control" name="sop-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="sop-status">
			<option value="all" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Sops Assign Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'Sops Assign Clients' ? 'selected' : '' ?>>Sop's Assign Clients</option>
			<option value="SOPs Not Assign Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'SOPs Not Assign Clients' ? 'selected' : '' ?>>SOP's Not Assign Clients</option>
			<option value="SOPs Received Clients" <?= isset($_GET['sop-status']) && $_GET['sop-status'] == 'SOPs Received Clients' ? 'selected' : '' ?>>SOP's Received Clients</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Call Status</label>
		<select class="form-control" name="call-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="call-status">
			<option value="all" <?= isset($_GET['call-status']) && $_GET['call-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<?php
			$selectQuery = "SELECT * FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name='".$uniName."' AND italy_degree_name='".$clientDegree."' ORDER BY italy_dates_id DESC";
			$selectQuery_ex = mysqli_query($con, $selectQuery);
			foreach ($selectQuery_ex as $row) {
				$openingDate = $row['italy_opening_date'];
				$closingDate = $row['italy_closing_date'];
				$dateRange = $openingDate . " - " . $closingDate;

				$selected = (isset($_GET['call-status']) && $_GET['call-status'] == $dateRange) ? 'selected' : '';
				?>
				<option value="<?= $dateRange ?>" <?= $selected ?>><?= $dateRange ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>IELTS / PTE</label>
		<select class="form-control" name="ielts-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="ielts-status">
			<option value="all" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="IELTS Yes" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'IELTS Yes' ? 'selected' : '' ?>>IELTS Yes</option>
			<option value="IELTS No" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'IELTS No' ? 'selected' : '' ?>>IELTS No</option>
			<option value="PTE" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'PTE' ? 'selected' : '' ?>>PTE</option>
			<option value="IELTS Not Selected" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'IELTS Not Selected' ? 'selected' : '' ?>>IELTS Not Selected</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Assign Date</label>
		<input type="date" name="assign-date" required="required" class="form-control" value="<?= isset($_GET['assign-date']) ? $_GET['assign-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="assign-date">
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Europass CV</label>
		<select class="form-control" name="cv-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="cv-status">
			<option value="all" <?= isset($_GET['cv-status']) && $_GET['cv-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Europass CV Uploaded Clients" <?= isset($_GET['cv-status']) && $_GET['cv-status'] == 'Europass CV Uploaded Clients' ? 'selected' : '' ?>>Europass CV Uploaded Clients</option>
			<option value="Europass CV Not Uploaded Clients" <?= isset($_GET['cv-status']) && $_GET['cv-status'] == 'Europass CV Not Uploaded Clients' ? 'selected' : '' ?>>Europass CV Not Uploaded Clients</option>
		</select>
	</div>

	<div class="form-group col-md-6 col-lg-3">
		<label>Check Admission Application</label>
		<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
			<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Advance Remaining Payment Not Clear Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Advance Remaining Payment Not Clear Clients' ? 'selected' : '' ?>>Advance Remaining Payment Not Clear Clients</option>
			<option value="Self Received Acceptance" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Self Received Acceptance' ? 'selected' : '' ?>>Self Received Acceptance</option>
			<optgroup label="Application Checking">
				<option value="Inform the Client to Recheck the Application" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform the Client to Recheck the Application' ? 'selected' : '' ?>>Inform the Client to Recheck the Application</option>
				<option value="Applications Sent to the client for Rechecking" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Applications Sent to the client for Rechecking' ? 'selected' : '' ?>>Applications Sent to the client for Rechecking</option>
				<option value="Client Requests Changes in the Application" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Client Requests Changes in the Application' ? 'selected' : '' ?>>Client Requests Changes in the Application</option>
				<option value="Changes Complete By Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Changes Complete By Processing Team' ? 'selected' : '' ?>>Changes Complete By Processing Team</option>

				<option value="Client Informed, How to Pay the Application Fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Client Informed, How to Pay the Application Fee' ? 'selected' : '' ?>>Client Informed, How to Pay the Application Fee</option>
				<option value="Application Approved And Application Fee Paid by Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Application Approved And Application Fee Paid by Client' ? 'selected' : '' ?>>Application Approved And Application Fee Paid by Client</option>
				<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
				<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
			</optgroup>
			<optgroup label="Bergamo Enrollment">
				<option value="Inform to Processing Team to Fill Bergamo Enrollment Fee Form" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform to Processing Team to Fill Bergamo Enrollment Fee Form' ? 'selected' : '' ?>>Inform to Processing Team to Fill Bergamo Enrollment Fee Form</option>
				<option value="Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee' ? 'selected' : '' ?>>Bergamo enrollment fee form was filled out by the processing team, but the client has not been informed yet to pay the application fee</option>
				<option value="Bergamo University clients who have not yet paid the enrollment fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Bergamo University clients who have not yet paid the enrollment fee' ? 'selected' : '' ?>>Bergamo University clients who have not yet paid the enrollment fee</option>
			</optgroup>
			<optgroup label="Additional Activities">
				<option value="Additional Activities Required by University Clients Assign to Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Clients Assign to Processing Team' ? 'selected' : '' ?>>Additional Activities Required by University Clients Assign to Processing Team</option>
				<option value="Additional Activities Required by University Task Complete by Processing Team" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Task Complete by Processing Team' ? 'selected' : '' ?>>Additional Activities Required by University Task Complete by Processing Team</option>
			</optgroup>

			<optgroup label="Deadline">
				<option value="Deadline Hold" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Deadline Hold' ? 'selected' : '' ?>>Deadline Hold</option>
				<option value="Deadline Release" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Deadline Release' ? 'selected' : '' ?>>Deadline Release</option>
			</optgroup>

			<optgroup label="Admission Status">
				<option value="Waiting for Admission decision" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
				<option value="Acceptance Letter Received Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
				<option value="University Admission Rejected Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
			</optgroup>

		</select>
	</div>

	<div class="form-group col-md-6 col-lg-3">
		<label>Visa Process</label>
		<select class="form-control" data-toggle='select2' name="visa-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="visa-process">
			<option value="all" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'all' ? 'selected' : '' ?>>All</option>
			<optgroup label="Admission Due">
				<option value="After Admission Dues Clear Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Admission Dues Clear Clients' ? 'selected' : '' ?>>After Admission Dues Clear Clients</option>
				<option value="After Admission Dues Not Clear Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Admission Dues Not Clear Clients' ? 'selected' : '' ?>>After Admission Dues Not Clear Clients</option>
				<option value="After Admission Dues Remaining Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Admission Dues Remaining Clients' ? 'selected' : '' ?>>After Admission Dues Remaining Clients</option>
				<option value="After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team' ? 'selected' : '' ?>>After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team</option>
				<option value="Pre-enrollment Assign to Processing Team Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Pre-enrollment Assign to Processing Team Clients' ? 'selected' : '' ?>>Pre-enrollment Assign to Processing Team Clients</option>
			</optgroup>
			<optgroup label="Visa Steps">
				<option value="Intro Message Not sent to Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Intro Message Not sent to Clients' ? 'selected' : '' ?>>Intro Message Not sent to Clients</option>
				<option value="Intro Message sent to Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Intro Message sent to Clients' ? 'selected' : '' ?>>Intro Message sent to Clients</option>
			</optgroup>
			<optgroup label="Checklist">
				<option value="WhatsApp Checklist Sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'WhatsApp Checklist Sent Clients' ? 'selected' : '' ?>>WhatsApp Checklist Sent Clients</option>
				<option value="WhatsApp Checklist Not Sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'WhatsApp Checklist Not Sent Clients' ? 'selected' : '' ?>>WhatsApp Checklist Not Sent Clients</option>
			</optgroup>
			<optgroup label="Case History">
				<option value="Case History not sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Case History not sent Clients' ? 'selected' : '' ?>>Case History not sent Clients</option>
				<option value="Case History sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Case History sent Clients' ? 'selected' : '' ?>>Case History sent Clients</option>
				<option value="Case History sent & Not Received by Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Case History sent & Not Received by Clients' ? 'selected' : '' ?>>Case History sent & Not Received by Clients</option>
				<option value="Case History sent & Received by Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Case History sent & Received by Clients' ? 'selected' : '' ?>>Case History sent & Received by Clients</option>
				<option value="Case History Study has been Completed, and Client has been Guided" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Case History Study has been Completed, and Client has been Guided' ? 'selected' : '' ?>>Case History Study has been Completed, and Client has been Guided</option>
			</optgroup>
			<optgroup label="Attestation & Translate">
				<option value="Educational Documents Attestation not sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Educational Documents Attestation not sent Clients' ? 'selected' : '' ?>>Educational Documents Attestation not sent Clients</option>
				<option value="Educational Documents Attestation sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Educational Documents Attestation sent Clients' ? 'selected' : '' ?>>Educational Documents Attestation sent Clients</option>
				<option value="Educational Documents Attestation by Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Educational Documents Attestation by Clients' ? 'selected' : '' ?>>Educational Documents Attestation by Clients</option>

				<option value="Documents Translate into the Italian Language not sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Documents Translate into the Italian Language not sent Clients' ? 'selected' : '' ?>>Documents Translate into the Italian Language not sent Clients</option>
				<option value="Documents Translate into the Italian Language sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Documents Translate into the Italian Language sent Clients' ? 'selected' : '' ?>>Documents Translate into the Italian Language sent Clients</option>
				<option value="Documents Translate into the Italian Language by Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Documents Translate into the Italian Language by Clients' ? 'selected' : '' ?>>Documents Translate into the Italian Language by Clients</option>

				<option value="After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details' ? 'selected' : '' ?>>After Admission Dues are Acknowledged by Client, Now send the Italian Lawyers details</option>
			</optgroup>
			<optgroup label="Scholarship">
				<option value="Scholarship Details not sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Scholarship Details not sent Clients' ? 'selected' : '' ?>>Scholarship Details not sent Clients</option>
				<option value="Scholarship Details sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Scholarship Details sent Clients' ? 'selected' : '' ?>>Scholarship Details sent Clients</option>

			</optgroup>
			<optgroup label="Book Visa Appointment">
				<option value="Book Visa Appointment link not sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Book Visa Appointment link not sent Clients' ? 'selected' : '' ?>>Book Visa Appointment link not sent Clients</option>
				<option value="Book Visa Appointment link sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Book Visa Appointment link sent Clients' ? 'selected' : '' ?>>Book Visa Appointment link sent Clients</option>
				<option value="Book Visa Appointment link sent to Client" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Book Visa Appointment link sent to Client' ? 'selected' : '' ?>>Book Visa Appointment link sent to Client</option>
				<option value="Visa Appointment Booked By Client" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Visa Appointment Booked By Client' ? 'selected' : '' ?>>Visa Appointment Booked By Client</option>
				<option value="Visa Submitted By Client" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Visa Submitted By Client' ? 'selected' : '' ?>>Visa Submitted By Client</option>
				<option value="Visa Accepted" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Visa Accepted' ? 'selected' : '' ?>>Visa Accepted</option>
				<option value="Visa Rejected" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Visa Rejected' ? 'selected' : '' ?>>Visa Rejected</option>
			</optgroup>
			<optgroup label="Visa Due">
				<option value="After Visa Due not Clear Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Visa Due not Clear Clients' ? 'selected' : '' ?>>After Visa Due not Clear Clients</option>
				<option value="After Visa Due Clear Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'After Visa Due Clear Clients' ? 'selected' : '' ?>>After Visa Due Clear Clients</option>
			</optgroup>
		</select>
	</div>

	<div class="form-group col-md-6 col-lg-3">
		<label>Pre Enrollment Process</label>
		<select class="form-control" data-toggle='select2' name="pre-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="pre-process">
			<option value="all" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'all' ? 'selected' : '' ?>>All</option>
			<optgroup label="Application Checking">
				<option value="Inform the Client to Recheck the Application" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Inform the Client to Recheck the Application' ? 'selected' : '' ?>>Inform the Client to Recheck the Application</option>
				<option value="Applications Sent to the client for Rechecking" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Applications Sent to the client for Rechecking' ? 'selected' : '' ?>>Applications Sent to the client for Rechecking</option>
				<option value="Client Requests Changes in the Application" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Client Requests Changes in the Application' ? 'selected' : '' ?>>Client Requests Changes in the Application</option>
				<option value="Changes Complete By Processing Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Changes Complete By Processing Team' ? 'selected' : '' ?>>Changes Complete By Processing Team</option>

				<option value="Application Approved And Application Fee Paid by Client" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Application Approved And Application Fee Paid by Client' ? 'selected' : '' ?>>Application Approved And Application Fee Paid by Client</option>
				<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
				<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
			</optgroup>
			<optgroup label="Admission Status">
				<option value="Waiting for Admission decision" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
				<option value="Acceptance Letter Received Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
				<option value="University Admission Rejected Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
			</optgroup>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>CEnT-S Test Process</label>
		<select class="form-control" data-toggle='select2' name="CEnT-S-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="CEnT-S-process">
			<option value="all" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'all' ? 'selected' : '' ?>>All</option>
			<optgroup label="CEnT-S Checking">
				<option value="Inform the Client to Recheck the CEnT-S Application" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'Inform the Client to Recheck the CEnT-S Application' ? 'selected' : '' ?>>Inform the Client to Recheck the CEnT-S Application</option>
				<option value="CEnT-S Applications Sent to the client for Rechecking" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Applications Sent to the client for Rechecking' ? 'selected' : '' ?>>CEnT-S Applications Sent to the client for Rechecking</option>
				<option value="CEnT-S Test Date Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Date Clients' ? 'selected' : '' ?>>CEnT-S Test Date Clients</option>
				<option value="CEnT-S Test Fee Paid Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Fee Paid Clients' ? 'selected' : '' ?>>CEnT-S Test Fee Paid Clients</option>
				<option value="Sent Practice CEnT-S Test Video" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'Sent Practice CEnT-S Test Video' ? 'selected' : '' ?>>Sent Practice CEnT-S Test Video</option>
			</optgroup>
			<optgroup label="CEnT-S Status">
				<option value="CEnT-S Test Pass Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Pass Clients' ? 'selected' : '' ?>>CEnT-S Test Pass Clients</option>
				<option value="CEnT-S Test Fail Clients" <?= isset($_GET['CEnT-S-process']) && $_GET['CEnT-S-process'] == 'CEnT-S Test Fail Clients' ? 'selected' : '' ?>>CEnT-S Test Fail Clients</option>
			</optgroup>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Admission WhatsApp Agent Assign</label>
		<select class="form-control" data-toggle='select2' name="assign-agent" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-agent">
			<option value="all" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Asima" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Asima' ? 'selected' : '' ?>>Asima</option>
			<option value="Kanwal" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Kanwal' ? 'selected' : '' ?>>Kanwal</option>
			<option value="Laiba" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Laiba' ? 'selected' : '' ?>>Laiba</option>
			<option value="Sholmiyat" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Sholmiyat' ? 'selected' : '' ?>>Sholmiyat</option>
			<option value="Hira" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Hira' ? 'selected' : '' ?>>Hira</option>
			<option value="Kashaf" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Kashaf' ? 'selected' : '' ?>>Kashaf</option>
			<option value="Jawairia" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Jawairia' ? 'selected' : '' ?>>Jawairia</option>
			<option value="Amna Shafqat" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Amna Shafqat' ? 'selected' : '' ?>>Amna Shafqat</option>
			<option value="Zainab" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Zainab' ? 'selected' : '' ?>>Zainab</option>
			<option value="Bisma" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'Bisma' ? 'selected' : '' ?>>Bisma</option>
		</select>
	</div>
</div>