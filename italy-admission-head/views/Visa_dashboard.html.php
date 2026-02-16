<style type="text/css">
	.rounded-3{
		border-radius: 0 0.8rem;
	}
	.avatar-md{
		height: 3rem;
		width: 3rem;
	}
	.card-box {
		padding: 0.7rem 1.5rem;
		margin-bottom: 15px; 
	}
	.card-body {
		padding-top: 5px;
	}
</style>

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<h4>Pre Enrollment Task</h4>
				<div class="row">
				<?php
				$dashboardCards = [
					[
						"title" => "Self Received Acceptance",
						"url" => "all-clients?check-application=Self+Received+Acceptance",
						"color" => "text-warning",
						"countID" => "countTotalSelfReceived"
					],
					[
						"title" => "Acceptance Letter Received Clients",
						"url" => "all-clients?check-application=Acceptance+Letter+Received+Clients",
						"color" => "text-info",
						"countID" => "countTotalAcceptance"
					],
					[
						"title" => "After Admission Dues Not Clear Clients",
						"url" => "all-clients?visa-process=After+Admission+Dues+Not+Clear+Clients",
						"color" => "text-info",
						"countID" => "countTotalDueNotClear"
					],
					[
						"title" => "After Admission Dues Remaining Clients",
						"url" => "all-clients?visa-process=After+Admission+Dues+Remaining+Clients",
						"color" => "text-info",
						"countID" => "countTotalDueRemaining"
					],
					[
						"title" => "After Admission Dues Clear Clients",
						"url" => "all-clients?visa-process=After+Admission+Dues+Clear+Clients",
						"color" => "text-info",
						"countID" => "countTotalDueClear"
					],
					[
						"title" => "After Admission Dues are Acknowledged by Client, Now send the Italian Lawyer's details",
						"url" => "all-clients?visa-process=After+Admission+Dues+are+Acknowledged+by+Client%2C+Now+send+the+Italian+Lawyers+details",
						"color" => "text-info",
						"countID" => "totalRemainingLawyerCount"
					],
					[
						"title" => "After Admission Dues are Acknowledged by Client, Now Assign Pre-enrollment to Processing Team",
						"url" => "all-clients?visa-process=After+Admission+Dues+are+Acknowledged+by+Client%2C+Now+Assign+Pre-enrollment+to+Processing+Team",
						"color" => "text-info",
						"countID" => "countTotalDueAcknowledgementClear"
					],
					[
						"title" => "Pre-enrollment Assign to Processing Team Clients",
						"url" => "all-clients?visa-process=Pre-enrollment+Assign+to+Processing+Team+Clients",
						"color" => "text-info",
						"countID" => "countTotalAssignPreEnrollment"
					],
					[
						"title" => "Hotel, Ticket, Travel Insurance Guidelines Not Sent Clients",
						"url" => "all-clients?visa-process=Hotel%2C+Ticket%2C+Travel+Insurance+Guidelines+Not+Sent+Clients",
						"color" => "text-warning",
						"countID" => "countHotelBookingNotSent"
					],
					[
						"title" => "Hotel, Ticket, Travel Insurance Guidelines Sent Clients",
						"url" => "all-clients?visa-process=Hotel%2C+Ticket%2C+Travel+Insurance+Guidelines+Sent+Clients",
						"color" => "text-warning",
						"countID" => "countHotelBookingSent"
					],
					[
						"title" => "Book Visa Appointment link not sent Clients",
						"url" => "all-clients?visa-process=Book+Visa+Appointment+link+not+sent+Clients",
						"color" => "text-warning",
						"countID" => "visaBookNotSentCount"
					],
					[
						"title" => "Book Visa Appointment link sent Clients",
						"url" => "all-clients?visa-process=Book+Visa+Appointment+link+sent+Clients",
						"color" => "text-warning",
						"countID" => "visaBookSentCount"
					],
					[
						"title" => "Visa Appointment Booked By Client",
						"url" => "all-clients?visa-process=Visa+Appointment+Booked+By+Client",
						"color" => "text-warning",
						"countID" => "visaBookedCount"
					],
					[
						"title" => "Visa Submitted By Client",
						"url" => "all-clients?visa-process=Visa+Submitted+By+Client",
						"color" => "text-warning",
						"countID" => "visaSubmittedCount"
					],
					[
						"title" => "Visa Accepted",
						"url" => "all-clients?visa-process=Visa+Accepted",
						"color" => "text-warning",
						"countID" => "visaAcceptedCount"
					],
					[
						"title" => "Visa Rejected",
						"url" => "all-clients?visa-process=Visa+Rejected",
						"color" => "text-warning",
						"countID" => "visaRejectedCount"
					],
					[
						"title" => "After Visa Due not Clear Clients",
						"url" => "all-clients?visa-process=After+Visa+Due+not+Clear+Clients",
						"color" => "text-warning",
						"countID" => "countVisaDueNotClear"
					],
					[
						"title" => "After Visa Due Clear Clients",
						"url" => "all-clients?visa-process=After+Visa+Due+Clear+Clients",
						"color" => "text-warning",
						"countID" => "countVisaDueClear"
					]
				];
				foreach ($dashboardCards as $card) { ?>
					<div class="col-lg-12 col-md-12">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $card['title']; ?>">
									<a href="<?= $card['url']; ?>">
										<p class="m-0 font-weight-medium text-truncate <?= $card['color'];?>"> <?= $card['title'];?> </p>
										<h3 class="font-weight-bold my-2 <?= $card['color']; ?>"> <span data-plugin="counterLoading" id="<?= $card['countID']; ?>">0</span> </h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $card['color']; ?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
			<!-- left side -->
			<div class="col-md-6" style="border-left: 2px solid black;">
				<h4>Visa Task</h4>
				<div class="row">
				<?php 
				$checklistCards = [
					[
						"title" => "Email Checklist Not Sent Clients",
						"url" => "all-clients?checklist-status=Email+%26+WhatsApp+Checklist+Not+Sent+Clients",
						"color" => "text-warning",
						"countID" => "checklistNotSent"
					],
					[
						"title" => "Email Checklist Sent Clients",
						"url" => "all-clients?checklist-status=Email+%26+WhatsApp+Checklist+Sent+Clients",
						"color" => "text-warning",
						"countID" => "checklistSent"
					],
					// Intro Message
					[
						"title" => "Intro Message Not Sent Clients",
						"url" => "all-clients?visa-process=Intro+Message+Not+sent+to+Clients",
						"color" => "text-warning",
						"countID" => "introMessageNotSentCount"
					],
					[
						"title" => "Intro Message Sent Clients",
						"url" => "all-clients?visa-process=Intro+Message+sent+to+Clients",
						"color" => "text-warning",
						"countID" => "introMessageSentCount"
					],
					// WhatsApp Checklist
					[
						"title" => "Whatsapp Checklist Not sent to Clients",
						"url" => "all-clients?visa-process=WhatsApp+Checklist+Not+Sent+Clients",
						"color" => "text-warning",
						"countID" => "WhatsAppchecklistNotSent"
					],
					[
						"title" => "Whatsapp Checklist sent to Clients",
						"url" => "all-clients?visa-process=WhatsApp+Checklist+Sent+Clients",
						"color" => "text-warning",
						"countID" => "WhatsAppchecklistSent"
					],
					// Case History
					[
						"title" => "Case History not sent Clients",
						"url" => "all-clients?visa-process=Case+History+not+sent+Clients",
						"color" => "text-warning",
						"countID" => "caseHistoryNotSentCount"
					],
					[
						"title" => "Case History sent Clients",
						"url" => "all-clients?visa-process=Case+History+sent+Clients",
						"color" => "text-warning",
						"countID" => "caseHistorySentCount"
					],
					[
						"title" => "Case History sent & Not Received by Clients",
						"url" => "all-clients?visa-process=Case+History+sent+%26+Not+Received+by+Clients",
						"color" => "text-warning",
						"countID" => "caseHistoryNotReceivedCount"
					],
					[
						"title" => "Case History sent & Received by Clients",
						"url" => "all-clients?visa-process=Case+History+sent+%26+Received+by+Clients",
						"color" => "text-warning",
						"countID" => "totalCaseHistoryReceived"
					],
					[
						"title" => "Case History Study has been Completed, and Client has been Guided",
						"url" => "all-clients?visa-process=Case+History+Study+has+been+Completed%2C+and+Client+has+been+Guided",
						"color" => "text-warning",
						"countID" => "caseHistoryGuidedCount"
					],
					// Attestation
					[
						"title" => "Educational Documents Attestation not sent Clients",
						"url" => "all-clients?visa-process=Educational+Documents+Attestation+not+sent+Clients",
						"color" => "text-warning",
						"countID" => "attestationNotSentCount"
					],
					[
						"title" => "Educational Documents Attestation sent Clients",
						"url" => "all-clients?visa-process=Educational+Documents+Attestation+sent+Clients",
						"color" => "text-warning",
						"countID" => "attestationSentCount"
					],
					[
						"title" => "Educational Documents Attestation by Clients",
						"url" => "all-clients?visa-process=Educational+Documents+Attestation+by+Clients",
						"color" => "text-warning",
						"countID" => "attestationByClientCount"
					],
					// Scholarship
					[
						"title" => "Scholarship Details not sent Clients",
						"url" => "all-clients?visa-process=Scholarship+Details+not+sent+Clients",
						"color" => "text-warning",
						"countID" => "scholarshipNotSentCount"
					],
					[
						"title" => "Scholarship Details sent Clients",
						"url" => "all-clients?visa-process=Scholarship+Details+sent+Clients",
						"color" => "text-warning",
						"countID" => "scholarshipSentCount"
					],
					// Translation
					[
						"title" => "Documents Translate into the Italian Language not sent Clients",
						"url" => "all-clients?visa-process=Documents+Translate+into+the+Italian+Language+not+sent+Clients",
						"color" => "text-warning",
						"countID" => "translateNotSentCount"
					],
					[
						"title" => "Documents Translate into the Italian Language sent Clients",
						"url" => "all-clients?visa-process=Documents+Translate+into+the+Italian+Language+sent+Clients",
						"color" => "text-warning",
						"countID" => "translateSentCount"
					],
					[
						"title" => "Documents Translate into the Italian Language by Clients",
						"url" => "all-clients?visa-process=Documents+Translate+into+the+Italian+Language+by+Clients",
						"color" => "text-warning",
						"countID" => "translateByClientCount"
					]
				];

				foreach ($checklistCards as $card) { ?>
					<div class="col-lg-12 col-md-12">
						<div class="card-box widget-two-custom" style="background: linear-gradient(to top, #232526, #414345);">
							<div class="media">
								<div class="wigdet-two-content media-body text-truncate" data-toggle="tooltip" data-placement="top" title="<?= $card['title']; ?>">
									<a href="<?= $card['url']; ?>">
										<p class="m-0 font-weight-medium text-truncate <?= $card['color']; ?>"><?= $card['title']; ?> </p>
										<h3 class="font-weight-bold my-2 <?= $card['color']; ?>"> <span data-plugin="counterLoading" id="<?= $card['countID']; ?>">0</span> </h3>
									</a>
								</div>
								<div class="avatar-md rounded-3 bg-white-1 widget-two-icon align-self-center">
									<i class="mdi mdi-account-multiple-outline avatar-title font-30 <?= $card['color']; ?>"></i>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-plugin='counterLoading']").each(function() {
			$(this).html('<i class="mdi mdi-loading mdi-spin"></i>');
		});
		$.ajax({
			url: 'models/_visaDashboardControllersState.php',
			type: 'GET',
			dataType: 'json',
			success: function(data) {
				$.each(data, function(key, value){
					if ($("#" + key).length) {
						let formattedValue = Number(value).toLocaleString();
						$("#" + key).text(formattedValue);
					}
				});
				// console.log(data);
				// $('#countTotalProgramResolved').text(data.countTotalProgramResolved);
			},
			error: function(xhr, status, error) {
				console.error('AJAX Error:', error);
			}
		});
	});
</script>