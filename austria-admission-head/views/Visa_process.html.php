<?php 
$clientID = $_GET['client-id'];

$select_query="SELECT client_country, client_name, client_email, client_whatapp, client_embassy, client_applied, client_process_status from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
$select_query_ex = mysqli_query($con,$select_query);
$row = mysqli_fetch_assoc($select_query_ex);
$countryName = $row['client_country'];
$clientName = $row['client_name'];
$clientEmail = $row['client_email'];
$clientWhatApp = $row['client_whatapp'];
$clientEmbassy = $row['client_embassy'];
$clientProcess = $row['client_process_status'];

$changingApplied = $row['client_applied'];
$appliedChanging = json_decode($changingApplied, true);
$getUrl = base64_encode($row['client_name']."".$row['client_whatapp']);
?>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Name: <b><?php echo ucwords($clientName);?></b> <span class="float-right"><b><?php echo "ID-".$clientID;?></b></span></p>
				</div>
			</div>
			<div class="col-md-6">
				<div class="alert bg-dark text-warning">
					<p>Email: <b><?php echo $clientEmail;?></b> </p>
				</div>
			</div>
			<div class="col-md-4">
				<div class="alert bg-dark text-warning">
					<p>WhatApp: <b><a href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatApp;?>" target="_blank" class="text-warning"><?php echo $clientWhatApp; ?></a> </b></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Country: <b><?php echo ucwords($countryName);?></b></p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="alert bg-dark text-warning">
					<p>Degree: <b><?php foreach ($appliedChanging as $appRow) { echo "<b>" . ucwords($appRow) . "</b> "; } ?></b></p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="alert bg-dark text-warning">
					<p>Embassy: <b><?php echo ucwords($clientEmbassy);?></b></p>
				</div>
			</div>
		</div>
		<input type="hidden" name="" value="<?php echo $clientEmbassy;?>" id="clientEmbassy">
		<input type="hidden" name="" value="<?php echo $countryName;?>" id="countryName">
		<input type="hidden" name="" value="<?php echo $appRow;?>" id="clientApplied">


	</div>
</div>
<!-- Visa Into Message Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showTitleModel" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
