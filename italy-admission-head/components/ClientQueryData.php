<?php 
$clientQuery = "SELECT client_name, client_email, client_whatapp, client_applied, client_inter_percentage, client_cgpa, client_percentage, client_cgpa2, client_percentage2, client_note, country_agent_assign_to from clients".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND client_id='".$clientID."' ";
$clientQuery_ex = mysqli_query($con,$clientQuery);
$rowCl = mysqli_fetch_assoc($clientQuery_ex);
$clientName = $rowCl['client_name'];
$clientEmail = $rowCl['client_email'];
$clientWhatapp = $rowCl['client_whatapp'];
$changingApplied = $rowCl['client_applied'];
$appliedChanging = json_decode($changingApplied, true);

$clientInterPercentage = $rowCl['client_inter_percentage'];
$clientCGPA = $rowCl['client_cgpa'];
$clientPercentage = $rowCl['client_percentage'];
$clientCGPA2 = $rowCl['client_cgpa2'];
$clientPercentage2 = $rowCl['client_percentage2'];
$clientNote = $rowCl['client_note'];
$whatsappAgent = $rowCl['country_agent_assign_to'];

?>
<div class="row">
	<div class="col-md-6">
		<div class="alert bg-dark text-warning">
			<p>Name: <strong><?php echo ucwords($clientName);?></strong> <span class="float-right">ID-<strong><?php echo $clientID;?></strong></span></p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert bg-dark text-warning">
			<p>WhatsApp: <strong><?php echo $clientWhatapp;?></strong></p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert bg-dark text-warning">
			<p>Email: <strong><?php echo $clientEmail;?></strong></p>
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert bg-dark text-warning">
			<p>Degree: <strong><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></strong></p>
		</div>
	</div>
	<div class="col-md-12">
		<div class="alert bg-dark text-warning">
			<p>WhatsApp Agent: <strong><?php echo $whatsappAgent;?></strong></p>
		</div>
	</div>
</div>