<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// inform to pay after visa Due
if (isset($_POST['infoVisaDel'])) {
	$infoVisaDel = $_POST['infoVisaDel'];
	$delQuery = "UPDATE clients".$_SESSION['dbNo']." SET due_after_visa_info_file='', due_after_visa_info_note='', due_after_visa_info_date='0000-00-00' WHERE client_id='".$infoVisaDel."'";
	$delQuery_ex = mysqli_query($con, $delQuery);
}

// paid after visa Due
if (isset($_POST['paidVisaDel'])) {
	$paidVisaDel = $_POST['paidVisaDel'];
	$delQuery = "UPDATE clients".$_SESSION['dbNo']." SET due_after_visa_paid_file='', due_after_visa_paid_note='', due_after_visa_paid_date='0000-00-00' WHERE client_id='".$paidVisaDel."'";
	$delQuery_ex = mysqli_query($con, $delQuery);
}

// delete steps from After Visa
if (isset($_POST['afterVisaID'])) {
	$visaID = $_POST['afterVisaID'];
	$delQuery = "UPDATE italy_clients_visa_after_process".$_SESSION['dbNo']." SET close='0' WHERE after_visa_id='".$visaID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// After Visa Steps
if (isset($_POST['checkClientID'])) {
	$clientID = $_POST['checkClientID'];
	?>
	<style type="text/css">
		ul li{font-size: 16px; text-align: justify;}
	</style>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				After Visa Steps <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<h3><mark>STUDENTS NEED TO FOLLOW A FEW STEPS</mark></h3>
					<ol>
						<li><b>University Enrollment</b></li>
						<li><b>Confirm Flight Booking:</b>Book your flight ticket (usually one-way is fine for students)</li>
						<li><b>Arrival in Italy:</b> (At the airport, you may be asked again for your admission letter and visa)</li>
						<li><b>Apply for Permesso di Soggiorno (Residence Permit)</b></li>
						<li><b>Codice Fiscale (Italian Tax code)</b></li>
						<li><b>Accommodation & Health Insurance</b></li>
						<li><b>Bank Account & Other Formalities</b></li>
					</ol>
					<h4><u>University Enrollment</u></h4>
					<ul>
						<li>Once your visa is approved, you should inform the university (by email or through the university portal) that you are coming.</li>
						<li>Universities usually give an enrollment deadline that you must not miss</li>
						<li>To secure your enrollment, you’ll need to pay the tuition fee or initial installment fee</li>
						<li>Sometimes part of the fee is already paid as a deposit before arrival</li>
						<li>Book your flight and check the university’s official arrival dates</li>
						<li>Once you arrive, there’s usually an orientation or enrollment week</li>
						<li>You’ll need to show original documents (passport, visa, admission letter, fee receipt, etc.)</li>
						<li>The university will register you, give you a student ID card, and help with course registration</li>
					</ul>
						
					<h4><u>Residence Permit</u></h4>
					<p><b><i>The Permesso di Soggiorno is your official residence permit that allows you to legally stay in Italy for the duration of your studies.</i></b></p>
					<ul>
						<li>Within 8 working days of arrival, apply for residence permit</li>
						<li>Get the application kit from any Post Office (Sportello Amico counter)</li>
						<li><b>Fill forms:</b> Complete the required sections (University international office often helps students fill it)</li>
						<li><b>Documents:</b> Passport, visa copies, enrollment letter, health insurance, accommodation, Italian Tax code, Pic, and pay required fees</li>
						<li>You’ll get a <b>receipt</b> → this is temporary proof of your legal stay until your permit card is issued</li>
					</ul>

					<h4><u>Codice Fiscale</u></h4>
					<p><b><i>It’s your personal tax identification number in Italy, Similar to a National ID</i></b></p>
					<ul>
						<li><b>Codice Fiscale:</b> You may also need a <b>Codice Fiscale (Italian Tax Code),</b> which you can get from the <b>Agenzia delle Entrate (Italian Revenue Agency)</b> office in the city where you will study</li>
						<li><b>Documents:</b> You’ll need your passport, visa, Residence Permit application receipt (if available) & Acceptance letter (sometimes required)</li>
						<li><b>Process:</b> The process is quick (often same day)</li>
						<li><b>Cost:</b> No extra charges (it’s free)</li>
						<li><b>Receive the Code:</b> You’ll receive a printed slip with your code on it (<i>16-character alphanumeric code</i>)</li>
						<li><b>Validity:</b> The Codice Fiscale is valid for life (it never changes)</li>
					</ul>

					<h4><u>Accommodation</u></h4>
					<p><b><i>Accommodation means your living arrangement while studying</i></b></p>
					<ul>
						<li><b>Check University Options:</b> Many Italian universities provide student dormitories/hostels</li>
						<li><b>Private Housing:</b> If dorm is not available, look for shared flats (appartamento condiviso) or student rooms</li>
						<li><b>Average Rent:</b> €300–500/month depending on city</li>
						<li><b>Required Documents:</b> Passport, Codice Fiscale (mandatory for official contracts) & University enrollment (sometimes requested)</li>
						<li><b>Sign the Contract:</b> Always sign a written rental contract (Contratto di locazione)</li>
					</ul>

					<h4><u>Accommodation Links</u></h4>
					<ul>
						<li><a href="https://housinganywhere.com/">https://housinganywhere.com/</a></li>
						<li><a href="https://www.uniplaces.com/">https://www.uniplaces.com/</a></li>
						<li><a href="https://www.spotahome.com/">https://www.spotahome.com/</a></li>
						<li><a href="https://erasmusu.com/">https://erasmusu.com/</a></li>
						<li><a href="https://www.idealista.it/en/">https://www.idealista.it/en/</a></li>
						<li><a href="https://www.italianway.house/">https://www.italianway.house/</a></li>
						<li><a href="https://relifenation.com/">https://relifenation.com/</a></li>
						<li><a href="https://rentola.it/en/">https://rentola.it/en/</a></li>
						<li><a href="https://findallrentals.com/">https://findallrentals.com/</a></li>
						<li><a href="https://www.immobiliare.it/en/">https://www.immobiliare.it/en/</a></li>
						<li><a href="https://en.uhomes.com/country/it">https://en.uhomes.com/country/it</a></li>
						<li><a href="https://www.casita.com/student-accommodation/italy/">https://www.casita.com/student-accommodation/italy/</a></li>
					</ul>

					<h4><u>Health Insurance</u></h4>
					<p><b><i>Health Insurance is mandatory for all International Students</i></b></p>
					<ul>
						<li><b>Italian Public Health Insurance (SSN – Servizio Sanitario Nazionale):</b> Register with SSN (Italian National Health Service) at Local ASL Office</li>
						<li><b>Documents:</b> Passport, Visa, Codice Fiscale, Residence Permit Receipt, Rental Contract, University Enrollment Letter</li>
						<li><b>Cost:</b> €150–200/year → get full healthcare access</li>
					</ul>

					<h4><u>Bank Account & Other Formalities</u></h4>
					<h5>SIM Card In Italy:</h5>
					<ul>
						<li><b>Buy an Italian SIM</b> (many banks, government portals, and universities send SMS codes)</li>
						<li><b>Popular Providers:</b> TIM, Vodafone, WindTre, Iliad, PosteMobile</li>
						<li><b>Documents:</b> Passport, Codice Fiscale, Italian Address (sometimes requested)</li>
					</ul>
					<h5>Bank Account:</h5>
					<ul>
						<li><b>Open a student bank account:</b> Needed for paying rent, receiving scholarships, etc.</li>
						<li><b>Documents:</b> Passport, Codice Fiscale, residence permit (or receipt), enrollment letter</li>
					</ul>
					<h5>Others:</h5>
					<ul>
						<li><b>Public Transport Card:</b> Students can apply for monthly/annual transport passes (bus, metro, train) Discounted student rates available in most cities</li>
						<li><b>Language:</b> Learn basic Italian for daily life (very helpful)</li>
					</ul>

					<h4 class="text-center"><u>Thank You!</u></h4>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

?>