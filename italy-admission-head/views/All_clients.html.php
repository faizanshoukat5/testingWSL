<?php 
if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<!-- filter -->
<div class="card">
	<div class="card-body">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
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
					<option value="Saudi Arabia" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
					<option value="Qatar" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Qatar' ? 'selected' : '' ?>>Qatar</option>
					<option value="Oman" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Oman' ? 'selected' : '' ?>>Oman</option>
					<option value="Other Country" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Other Country' ? 'selected' : '' ?>>Other Country</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Degree</label>
				<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree"> 
					<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
					<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
					<option value="mbbs" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
					<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Process Status</label>
				<select class="form-control" name="process-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="process-status">
					<option value="all" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Only Admission Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Only Admission Process' ? 'selected' : '' ?>>Only Admission Process</option>
					<option value="Overall Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Overall Process' ? 'selected' : '' ?>>Overall Process (Admission + Visa)</option>
					<option value="Only For Appointment" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Only For Appointment' ? 'selected' : '' ?>>Only For Appointment</option>
					<option value="Direct Visa" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Direct Visa' ? 'selected' : '' ?>>Have Accepted Letter (Only Visa)</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Embassy Status</label>
				<select class="form-control" name="embassy-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="embassy-status">
					<option value="all" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Islamabad Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Islamabad Embassy' ? 'selected' : '' ?>>Islamabad Embassy</option>
					<option value="Karachi Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Karachi Embassy' ? 'selected' : '' ?>>Karachi Embassy</option>
					<option value="Dubai Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Dubai Embassy' ? 'selected' : '' ?>>Dubai Embassy</option>
					<option value="Abu Dhabi Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Abu Dhabi Embassy' ? 'selected' : '' ?>>Abu Dhabi Embassy</option>
					<option value="Riyadh, Saudi Arabia Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Riyadh, Saudi Arabia Embassy' ? 'selected' : '' ?>>Riyadh, Saudi Arabia Embassy</option>
					<option value="Doha, Qatar Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Doha, Qatar Embassy' ? 'selected' : '' ?>>Doha, Qatar Embassy</option>
					<option value="Muscat, Oman Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Muscat, Oman Embassy' ? 'selected' : '' ?>>Muscat, Oman Embassy</option>
					<option value="Other Embassy" <?= isset($_GET['embassy-status']) && $_GET['embassy-status'] == 'Other Embassy' ? 'selected' : '' ?>>Other Embassy</option>
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
				<label>Checklist Status</label>
				<select class="form-control" name="checklist-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="checklist-status">
					<option value="all" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Email & WhatsApp Checklist Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Email & WhatsApp Checklist Sent Clients' ? 'selected' : '' ?>>Email & WhatsApp Checklist Sent Clients</option>
					<option value="Email & WhatsApp Checklist Not Sent Clients" <?= isset($_GET['checklist-status']) && $_GET['checklist-status'] == 'Email & WhatsApp Checklist Not Sent Clients' ? 'selected' : '' ?>>Email & WhatsApp Checklist Not Sent Clients</option>
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
			<div class="form-group col-md-6 col-lg-2">
				<label>IELTS / PTE</label>
				<select class="form-control" name="ielts-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="ielts-status">
					<option value="all" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="IELTS Yes" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'IELTS Yes' ? 'selected' : '' ?>>IELTS Yes</option>
					<option value="IELTS No" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'IELTS No' ? 'selected' : '' ?>>IELTS No</option>
					<option value="PTE" <?= isset($_GET['ielts-status']) && $_GET['ielts-status'] == 'PTE' ? 'selected' : '' ?>>PTE</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Assign</label>
				<select class="form-control" data-toggle='select2' name="assign-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-programs">
					<option value="all" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="All Not Assign Clients" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Clients' ? 'selected' : '' ?>>All Not Assign Clients</option>
					<option value="All Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Assign Programs' ? 'selected' : '' ?>>All Assign Programs</option>
					<option value="All Not Assign Programs" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'All Not Assign Programs' ? 'selected' : '' ?>>All Not Assign Programs</option>
					<option value="University Open, but Not Assign Clients" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'University Open, but Not Assign Clients' ? 'selected' : '' ?>>University Open, but Not Assign Clients</option>
					<option value="List of Clients with University Closed Admission" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'List of Clients with University Closed Admission' ? 'selected' : '' ?>>List of Clients with University Closed Admission</option>
					<option value="List of Clients with University Open Admission" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'List of Clients with University Open Admission' ? 'selected' : '' ?>>List of Clients with University Open Admission</option>
					<option value="List of Clients, Admission Date Announce But Not Open University Yet" <?= isset($_GET['assign-programs']) && $_GET['assign-programs'] == 'List of Clients, Admission Date Announce But Not Open University Yet' ? 'selected' : '' ?>>List of Clients, Admission Date Announce But Not Open University Yet</option>

				</select>
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Applied</label>
				<select class="form-control" name="applied-programs" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="applied-programs">
					<option value="all" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="All Applied Programs" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'All Applied Programs' ? 'selected' : '' ?>>All Applied Programs</option>
					<option value="New Assign But Not Applied Clients" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'New Assign But Not Applied Clients' ? 'selected' : '' ?>>New Assign But Not Applied Clients</option>
					<option value="My Pending Programs Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'My Pending Programs Report' ? 'selected' : '' ?>>My Pending Programs Report</option>
					<option value="I Have Resolved the Pending Report" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'I Have Resolved the Pending Report' ? 'selected' : '' ?>>I Have Resolved the Pending Report</option>

					<option value="All University Admission Rejected Clients" <?= isset($_GET['applied-programs']) && $_GET['applied-programs'] == 'All University Admission Rejected Clients' ? 'selected' : '' ?>>All University Admission Rejected Clients</option>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-4">
				<label>Check Admission Application</label>
				<select class="form-control" data-toggle='select2' name="check-application" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="check-application">
					<option value="all" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Advance Remaining Payment Not Clear Clients" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Advance Remaining Payment Not Clear Clients' ? 'selected' : '' ?>>Advance Remaining Payment Not Clear Clients</option>
					<option value="Self Received Acceptance" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'Self Received Acceptance' ? 'selected' : '' ?>>Self Received Acceptance</option>
					<option value="CEnT-S Pass But Not Applied" <?= isset($_GET['check-application']) && $_GET['check-application'] == 'CEnT-S Pass But Not Applied' ? 'selected' : '' ?>>CEnT-S Pass But Not Applied</option>
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

			<div class="form-group col-md-6 col-lg-2">
				<label>Acceptance Letter Date</label>
				<input type="date" name="accept-date" class="form-control" required="required" value="<?= isset($_GET['accept-date']) ? $_GET['accept-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="accept-date">
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
					<optgroup label="Hotel Booking">
						<option value="Hotel, Ticket, Travel Insurance Guidelines Not Sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Hotel, Ticket, Travel Insurance Guidelines Not Sent Clients' ? 'selected' : '' ?>>Hotel, Ticket, Travel Insurance Guidelines Not Sent Clients</option>
						<option value="Hotel, Ticket, Travel Insurance Guidelines Sent Clients" <?= isset($_GET['visa-process']) && $_GET['visa-process'] == 'Hotel, Ticket, Travel Insurance Guidelines Sent Clients' ? 'selected' : '' ?>>Hotel, Ticket, Travel Insurance Guidelines Sent Clients</option>
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
						<option value="Applications Rechecked by Clients and Submit by Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Applications Rechecked by Clients and Submit by Team' ? 'selected' : '' ?>>Applications Rechecked by Clients and Submit by Team</option>
						<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
						<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
					</optgroup>
					<optgroup label="Admission Status">
						<option value="Waiting for Admission decision" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
						<option value="Acceptance and Summary Letter Received Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'Acceptance and Summary Letter Received Clients' ? 'selected' : '' ?>>Acceptance and Summary Letter Received Clients</option>
						<option value="University Admission and Summary Rejected Clients" <?= isset($_GET['pre-process']) && $_GET['pre-process'] == 'University Admission and Summary Rejected Clients' ? 'selected' : '' ?>>University Admission and Summary Rejected Clients</option>
					</optgroup>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-4">
				<label>Self & WSL Acceptance Pre Enrollment Process</label>
				<select class="form-control" data-toggle='select2' name="pre-accept-process" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="pre-accept-process">
					<option value="all" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="New Pre Enrollment Assign to Processing Team Clients" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'New Pre Enrollment Assign to Processing Team Clients' ? 'selected' : '' ?>>New Pre Enrollment Assign to Processing Team Clients</option>
					<optgroup label="Application Checking">
						<option value="Applications Rechecked by Clients and Submit by Team" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Applications Rechecked by Clients and Submit by Team' ? 'selected' : '' ?>>Applications Rechecked by Clients and Submit by Team</option>
						<option value="Admission Application Submitted by Processing Team" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Admission Application Submitted by Processing Team' ? 'selected' : '' ?>>Admission Application Submitted by Processing Team</option>
						<option value="Sent Admission Applied Proof to Client" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Sent Admission Applied Proof to Client' ? 'selected' : '' ?>>Sent Admission Applied Proof to Client</option>
					</optgroup>
					<optgroup label="Admission Status">
						<option value="Waiting for Admission decision" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Waiting for Admission decision' ? 'selected' : '' ?>>Waiting for Admission decision</option>
						<option value="Summary Letter Received Clients" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Summary Letter Received Clients' ? 'selected' : '' ?>>Summary Letter Received Clients</option>
						<option value="Summary Letter Rejected Clients" <?= isset($_GET['pre-accept-process']) && $_GET['pre-accept-process'] == 'Summary Letter Rejected Clients' ? 'selected' : '' ?>>Summary Letter Rejected Clients</option>
					</optgroup>
				</select>
			</div>
			<div class="form-group col-md-6 col-lg-2">
				<label>Summary Date</label>
				<input type="date" name="summary-date" class="form-control" required="required" value="<?= isset($_GET['summary-date']) ? $_GET['summary-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="summary-date">
			</div>
			
			<div class="form-group col-md-6 col-lg-4">
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
				<label>University Wise</label>
				<select class="form-control" data-toggle='select2' name="university-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="university-status">
					<option value="all" <?= isset($_GET['university-status']) && $_GET['university-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<?php
					$uniDetails = "SELECT italy_uni_name FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' GROUP BY italy_uni_name";
					$uniDetails_ex = mysqli_query($con, $uniDetails);
					while ($addRow = mysqli_fetch_assoc($uniDetails_ex)) {
						$selected = isset($_GET['university-status']) && $_GET['university-status'] == $addRow['italy_uni_name'] ? 'selected' : '';
					?>
					<option value="<?php echo $addRow['italy_uni_name'];?>" <?= $selected;?>> <?php echo $addRow['italy_uni_name'];?>
					</option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group col-md-6 col-lg-3">
				<label>Other</label>
				<select class="form-control" name="other-status" data-toggle='select2' required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="other-status">
					<option value="all" <?= isset($_GET['other-status']) && $_GET['other-status'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="Campania Client with 2 Programs" <?= isset($_GET['other-status']) && $_GET['other-status'] == 'Campania Client with 2 Programs' ? 'selected' : '' ?>>Campania Client with 2 Programs</option>
					<option value="Pre Enrollment Clients with more than 1 University" <?= isset($_GET['other-status']) && $_GET['other-status'] == 'Pre Enrollment Clients with more than 1 University' ? 'selected' : '' ?>>Pre Enrollment Clients with more than 1 University</option>
					<option value="Pre Enrollment Proof Not Upload" <?= isset($_GET['other-status']) && $_GET['other-status'] == 'Pre Enrollment Proof Not Upload' ? 'selected' : '' ?>>Pre Enrollment Proof Not Upload</option>
					<option value="Acceptance Letter Received but Not Assign Pre Enrollment" <?= isset($_GET['other-status']) && $_GET['other-status'] == 'Acceptance Letter Received but Not Assign Pre Enrollment' ? 'selected' : '' ?>>Acceptance Letter Received but Not Assign Pre Enrollment</option>
				</select>
			</div>

			<div class="form-group col-md-6 col-lg-6">
				<label>Admission WhatsApp Agent Assign</label>
				<select class="form-control" data-toggle='select2' name="assign-agent" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="assign-agent">
					<option value="all" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'all' ? 'selected' : '' ?>>All</option>
					<option value="WhatsApp Agent Not Assign" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'WhatsApp Agent Not Assign' ? 'selected' : '' ?>>WhatsApp Agent Not Assign</option>
					<option value="WhatsApp Agent Assign" <?= isset($_GET['assign-agent']) && $_GET['assign-agent'] == 'WhatsApp Agent Assign' ? 'selected' : '' ?>>WhatsApp Agent Assign</option>
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
			<div class="form-group col-md-6 col-lg-3">
				<label>Forwarded Date from</label>
				<input type="date" name="start-date" required="required" class="form-control" value="<?= isset($_GET['start-date']) ? $_GET['start-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="start-date">
			</div>
			<div class="form-group col-md-6 col-lg-3">
				<label>Forwarded Date To</label>
				<input type="date" name="end-date" required="required" class="form-control" value="<?= isset($_GET['end-date']) ? $_GET['end-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="end-date">
			</div>
		</div>

		<!-- Track client Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="viewModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Track Client</h4>
					</div>
					<div class="modal-body viewModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Add Note to Document Collection -->
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
		<!-- Add Note to Document Collection -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient1" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle1" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient1">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>
	</div>
</div>

<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});

	function debounce(func, delay) {
		let timer;
		return function(...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}
	const debouncedViewClientsFilter = debounce(viewClientsFilter, 500);

	function viewClientsFilter(page) {
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientDegree = $("#client-degree").val();
		var processStatus = $("#process-status").val(); 
		var checklistStatus = $("#checklist-status").val();
		var sopStatus = $("#sop-status").val();
		var assignPrograms = $("#assign-programs").val();
		var appliedPrograms = $("#applied-programs").val(); 
		var ieltsStatus = $("#ielts-status").val();
		var embassyStatus = $("#embassy-status").val();
		var intakeYear = $("#intake-year").val();
		var applicationStatus = $("#check-application").val();
		var acceptDate = $("#accept-date").val();
		var summaryDate = $("#summary-date").val();
		var visaProcess = $("#visa-process").val();
		var preProcess = $("#pre-process").val();
		var preAcceptProcess = $("#pre-accept-process").val();
		var CEnTSProcess = $("#CEnT-S-process").val();
		var universityStatus = $("#university-status").val();
		var otherStatus = $("#other-status").val();
		var assignAgent = $("#assign-agent").val();
		var startDate = $("#start-date").val(); 
		var endDate = $("#end-date").val();
		
		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (convertStatus!=='all') {
			params.set('client-convert-status', convertStatus);
		}else{
			params.delete('client-convert-status');
		}
		if (clientCountry!=='all') {
			params.set('client-country', clientCountry);
		}else{
			params.delete('client-country');
		}
		if (clientDegree!=='all') {
			params.set('client-degree', clientDegree);
		}else{
			params.delete('client-degree');
		}
		if (processStatus!=='all') {
			params.set('process-status', processStatus);
		}else{
			params.delete('process-status');
		}
		if (checklistStatus!=='all') {
			params.set('checklist-status', checklistStatus);
		}else{
			params.delete('checklist-status');
		}
		if (sopStatus!=='all') {
			params.set('sop-status', sopStatus);
		}else{
			params.delete('sop-status');
		}
		if (assignPrograms!=='all') {
			params.set('assign-programs', assignPrograms);
		}else{
			params.delete('assign-programs');
		}
		if (appliedPrograms!=='all') {
			params.set('applied-programs', appliedPrograms);
		}else{
			params.delete('applied-programs');
		}
		if (ieltsStatus!=='all') {
			params.set('ielts-status', ieltsStatus);
		}else{
			params.delete('ielts-status');
		}
		if (embassyStatus!=='all') {
			params.set('embassy-status', embassyStatus);
		}else{
			params.delete('embassy-status');
		}
		if (intakeYear!=='all') {
			params.set('intake-year', intakeYear);
		}else{
			params.delete('intake-year');
		}
		if (applicationStatus!=='all') {
			params.set('check-application', applicationStatus);
		}else{
			params.delete('check-application');
		}
		if (acceptDate!=='') {
			params.set('accept-date', acceptDate);
		}else{
			params.delete('accept-date');
		}
		if (summaryDate!=='') {
			params.set('summary-date', summaryDate);
		}else{
			params.delete('summary-date');
		}
		if (visaProcess!=='all') {
			params.set('visa-process', visaProcess);
		}else{
			params.delete('visa-process');
		}
		if (preProcess!=='all') {
			params.set('pre-process', preProcess);
		}else{
			params.delete('pre-process');
		}
		if (preAcceptProcess!=='all') {
			params.set('pre-accept-process', preAcceptProcess);
		}else{
			params.delete('pre-accept-process');
		}
		if (CEnTSProcess!=='all') {
			params.set('CEnT-S-process', CEnTSProcess);
		}else{
			params.delete('CEnT-S-process');
		}
		if (universityStatus!=='all') {
			params.set('university-status', universityStatus);
		}else{
			params.delete('university-status');
		}
		if (otherStatus!=='all') {
			params.set('other-status', otherStatus);
		}else{
			params.delete('other-status');
		}
		if (assignAgent!=='all') {
			params.set('assign-agent', assignAgent);
		}else{
			params.delete('assign-agent');
		}
		if (startDate || endDate) {
			params.set('start-date', startDate);
			params.set('end-date', endDate);
		}else {
			params.delete('start-date');
			params.delete('end-date');
		}
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		} else {
			params.set('page-number', pageNo);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}
		else {
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModel").hide();
		// Perform the AJAX request
		if (assignPrograms=='University Open, but Not Assign Clients' || assignPrograms=='List of Clients with University Closed Admission' || assignPrograms=='List of Clients with University Open Admission' || assignPrograms=='List of Clients, Admission Date Announce But Not Open University Yet') {
			$.ajax({
				type: "POST",
				url: "models/viewAllClientsAssignModel.php",
				data: {
					checkconvertStatus: convertStatus,
					checkclientCountry: clientCountry,
					checkclientDegree: clientDegree,
					checkassignPrograms: assignPrograms,
					checkappliedPrograms: appliedPrograms,
					checkprocessStatus: processStatus,
					checkapplicationStatus: applicationStatus,
					checkchecklistStatus: checklistStatus,
					checksopStatus: sopStatus,
					checkvisaProcess: visaProcess,
					checkembassyStatus: embassyStatus,
					checkselectPage: selectPage,
					pageNumber: pageNo,
					checkclientDetails: clientIDGet,
				},
				success: function(data) {
					// alert(data);
					$("#loader").hide();
					$("#showClientsModel").html(data);
					$("#showClientsModel").show();
				}
			});
		}else{
			$.ajax({
				type: "POST",
				url: "models/viewAllClientsModel.php",
				data: {
					checkconvertStatus: convertStatus,
					checkclientCountry: clientCountry,
					checkclientDegree: clientDegree,
					checkprocessStatus: processStatus,
					checkchecklistStatus: checklistStatus,
					checksopStatus: sopStatus,
					checkassignPrograms: assignPrograms,
					checkappliedPrograms: appliedPrograms,
					checkieltsStatus: ieltsStatus,
					checkembassyStatus: embassyStatus,
					checkintakeYear: intakeYear,
					checkapplicationStatus: applicationStatus,
					checkacceptDate: acceptDate,
					checksummaryDate: summaryDate,
					checkvisaProcess: visaProcess,
					checkpreProcess: preProcess,
					checkpreAcceptProcess: preAcceptProcess,
					checkCEnTSProcess: CEnTSProcess,
					checkuniversityStatus: universityStatus,
					checkotherStatus: otherStatus,
					checkassignAgent: assignAgent,
					checkstartDate: startDate,
					checkendDate: endDate,
					pageNumber: pageNo,
					checkclientDetails: clientIDGet,
					checkselectPage: selectPage,
				},
				success: function(data) {
					// alert(data);
					$("#loader").hide();
					$("#showClientsModel").html(data);
					$("#showClientsModel").show();
				}
			});
		}
	}
</script>

<?php 
include ("js-helpers/allClients.php");
?>