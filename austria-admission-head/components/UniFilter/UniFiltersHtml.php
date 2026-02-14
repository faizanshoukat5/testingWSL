<div class="row">
	<div class="form-group col-md-6 col-lg-3">
		<label>Client Status</label>
		<select class="form-control" name="client-convert-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-convert-status">
			<option value="all" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="New Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'New Client' ? 'selected' : '' ?>>New Client</option>
			<option value="Old Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Client' ? 'selected' : '' ?>>Old Client</option>
			<option value="Old Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Converted Client' ? 'selected' : '' ?>>Old Converted Client</option>
			<option value="Italy Old Client 2024" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Old Client 2024' ? 'selected' : '' ?>>Italy Old Client 2024</option>
			<option value="Italy Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Converted Client' ? 'selected' : '' ?>>Italy Converted Client</option>
			<option value="Austria Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Austria Converted Client' ? 'selected' : '' ?>>Austria Converted Client</option>
			<option value="France Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'France Converted Client' ? 'selected' : '' ?>>France Converted Client</option>
			<option value="Czech Republic Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Czech Republic Converted Client' ? 'selected' : '' ?>>Czech Republic Converted Client</option>
			<option value="Canada Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Canada Converted Client' ? 'selected' : '' ?>>Canada Converted Client</option>
			<option value="USA Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'USA Converted Client' ? 'selected' : '' ?>>USA Converted Client</option>
			<option value="Process Transferred to Another Applicant" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Process Transferred to Another Applicant' ? 'selected' : '' ?>>Process Transferred to Another Applicant</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Country From</label>
		<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
			<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
			<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
			<option value="Saudi Arabia" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
			<option value="Qatar" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Qatar' ? 'selected' : '' ?>>Qatar</option>
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
		</select>
	</div>
	
	<div class="form-group col-md-6 col-lg-3">
		<label>Assign</label>
		<select class="form-control" name="assign-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-programs">
			<option value="all" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Assign but Not Paid Fee" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign but Not Paid Fee' ? 'selected' : '' ?>>Assign but Not Paid Fee</option>
			<option value="Fee Paid but Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Fee Paid but Not Applied' ? 'selected' : '' ?>>Fee Paid but Not Applied</option>
			<option value="All Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Assign Programs' ? 'selected' : '' ?>>All Assign Programs</option>
			<option value="All Not Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Programs' ? 'selected' : '' ?>>All Not Assign Programs</option>
			<option value="Assign But Not Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign But Not Applied' ? 'selected' : '' ?>>Assign But Not Applied</option>
			<option value="Assign and Applied" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'Assign and Applied' ? 'selected' : '' ?>>Assign and Applied</option>

			<option value="One Time Account Create" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'One Time Account Create' ? 'selected' : '' ?>>One Time Account Create</option>
		</select>
	</div>
	
	<div class="form-group col-md-6 col-lg-2">
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
			$selectQuery = "SELECT aus_opening_date, aus_closing_date FROM austria_university_dates WHERE status='1' AND close='1' AND aus_university_name='".$uniName."' AND aus_degree_name='".$clientDegree."' ORDER BY aus_dates_id DESC";
			$selectQuery_ex = mysqli_query($con, $selectQuery);
			foreach ($selectQuery_ex as $row) {
				$openingDate = $row['aus_opening_date'];
				$closingDate = $row['aus_closing_date'];
				$dateRange = $openingDate . " - " . $closingDate;

				$selected = (isset($_GET['call-status']) && $_GET['call-status'] == $dateRange) ? 'selected' : '';
				?>
				<option value="<?= $dateRange ?>" <?= $selected ?>><?= $dateRange ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-4">
		<label>After Verification Due</label>
		<select class="form-control" name="admission-due" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="admission-due">
			<option value="all" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="After Verification Dues Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'After Verification Dues Clear Clients' ? 'selected' : '' ?>>After Verification Dues Clear Clients</option>
			<option value="After Verification Dues Remaining Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'After Verification Dues Remaining Clients' ? 'selected' : '' ?>>After Verification Dues Remaining Clients</option>
			<option value="After Verification Dues Not Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'After Verification Dues Not Clear Clients' ? 'selected' : '' ?>>After Verification Dues Not Clear Clients</option>
			<option value="Advance Remaining Payment Not Clear Clients" <?= isset($_GET['admission-due']) && $_GET['admission-due'] == 'Advance Remaining Payment Not Clear Clients' ? 'selected' : '' ?>>Advance Remaining Payment Not Clear Clients</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-2">
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

	<div class="form-group col-md-6 col-lg-4">
		<label>Check Application</label>
		<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
			<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Admission Application Form Fill" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Form Fill' ? 'selected' : '' ?>>Admission Application Form Fill</option>
			<option value="Admission Application Submitted" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Admission Application Submitted' ? 'selected' : '' ?>>Admission Application Submitted</option>
			<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
			<option value="Inform to Client to Pay Application Fee" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Inform to Client to Pay Application Fee' ? 'selected' : '' ?>>Inform to Client to Pay Application Fee</option>
			<option value="Application Fee Paid By Client" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Application Fee Paid By Client' ? 'selected' : '' ?>>Application Fee Paid By Client</option>
			
			<option value="Waiting for Admission decision" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
			<option value="Acceptance Letter Received Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Acceptance Letter Received Clients' ? 'selected' : '' ?>>Acceptance Letter Received Clients</option>
			<option value="University Admission Rejected Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'University Admission Rejected Clients' ? 'selected' : '' ?>>University Admission Rejected Clients</option>
			
			<option value="Additional Activities Required by University Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Clients' ? 'selected' : '' ?>>Additional Activities Required by University Clients</option>
			<option value="Additional Activities Required by University Task Completed" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Additional Activities Required by University Task Completed' ? 'selected' : '' ?>>Additional Activities Required by University Task Completed</option>
			
			<option value="Self Received Acceptance" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Self Received Acceptance' ? 'selected' : '' ?>>Self Received Acceptance</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Assign To</label>
		<select class="form-control" name="assign-to" required="required" autocomplete="off" data-toggle="select2" onchange="viewClientsFilter(1)" id="assign-to">
			<option value="all" <?= isset($_GET['assign-to']) && $_GET['assign-to'] == 'all' ? 'selected' : '' ?>>All</option>
			<?php
			$wtUser = "SELECT wt_id, fname, lname FROM wt_users WHERE close='1' AND status='1' AND type='austria admission team' ";
			$wtUser_ex = mysqli_query($con, $wtUser);
			foreach ($wtUser_ex as $row) {
				$selected = isset($_GET['assign-to']) && $_GET['assign-to'] == $row['wt_id'] ? 'selected' : '';
				?>
				<option value="<?= $row['wt_id']; ?>" <?= $selected ?>><?= ucwords($row['fname']." ".$row['lname']); ?></option>
			<?php } ?>
		</select>
	</div>

</div>