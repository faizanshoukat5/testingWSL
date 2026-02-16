<?php 
$clientID = $_GET['client-id'];
?>

<?php 
$clientData = "SELECT client_id, client_name, client_country, client_whatapp, client_applied, client_countryfrom, client_embassy FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND client_id='".$clientID."' ";
$clientData_ex = mysqli_query($con, $clientData);
$row = mysqli_fetch_assoc($clientData_ex);
$clientID = $row['client_id'];
$clientName = $row['client_name'];
$clientWhatapp = $row['client_whatapp'];
$clientEmbassy = $row['client_embassy'];
$clientCountry = $row['client_country'];
$clientCountryFrom = $row['client_countryfrom'];
$changingApplied = $row['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

?>


<div class="card">
	<div class="card-header ribbon-box mt-2">
		<div class="ribbon-two ribbon-two-blue"><span>Documents</span></div>
		<p> &nbsp; &nbsp;&nbsp; Documents of <b><?php echo ucwords($clientName);?></b> who applied for <b> <?php echo ucwords($clientCountry);?> </b>in <b><?php foreach ($appliedChanging as $appRow){ echo ucwords($appRow)." "; }?> </b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-5">
					<div class="alert bg-dark text-warning">
						<p>ID No: <strong><?php echo "ID-".$clientID;?></strong> </p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert bg-dark text-warning">
						<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
					</div>
				</div>
				<div class="col-md-3">
					<div class="alert bg-dark text-warning">
						<p>Embassy: <strong><?php echo ucwords($clientEmbassy); ?></strong></p>
					</div>
				</div>
				<?php 
				$clientData = "SELECT italy_change_program_name, italy_university_name, italy_program_name FROM italy_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND italy_clients_id='".$clientID."' AND italy_program_assign='".$_SESSION['user_id']."' ";
				$clientData_ex = mysqli_query($con, $clientData);
				foreach ($clientData_ex as $rowPro) {
					$uniName = $rowPro['italy_university_name'];
					$programName = $rowPro['italy_program_name'];
				?>
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>University: <strong><?php echo ucwords($uniName);?></strong> </p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>Program:
							<span class="font-weight-bold">
								<?php 
								$changedProgramName = $rowPro['italy_change_program_name'] ? "<br>" . ucwords($rowPro['italy_change_program_name']) : '';
								if (empty($programName)) {
									echo $changedProgramName;
								} else {
									$decoded = json_decode($programName, true);
									if (is_array($decoded)) {
										$output = '';
										foreach ($decoded as $key => $name) {
											$output .= ($key + 1) . ') ' . ucwords($name) . '<br>';
										}
										echo $output . $changedProgramName;
									} else {
										echo ucwords($programName) . $changedProgramName;
									}
								}
								?>
							</span>
						</p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<button type="button" class="btn btn-custom mb-1" onclick="downloadZip(<?php echo $clientID;?>);">Download All Documents</button>
		<?php include ("../components/ClientTrack/AdmissionDocumentsView.php"); ?>
	</div>
</div>
