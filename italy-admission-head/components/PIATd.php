<?php 
	$currency = ($row['client_countryfrom']=='Saudi Arabia') ? 'SAR' : (($row['client_countryfrom']=='Qatar' || $row['client_countryfrom']=='UAE' || $row['client_countryfrom']=='Nepal') ? 'AED' : 'PKR');
	$addVerifi = ($row['client_country'] == 'austria') ? 'Payable on getting Verification Appointment' : (($row['client_country'] == 'italy') ? 'Payable After Admission Confirmation' : '');
	$rpVisa = ($row['client_country'] == 'austria') ? 'Payable on RP Approval' : (($row['client_country'] == 'italy') ? 'Payable on Visa Approval' : '');
	echo "<span class='text-success' data-toggle='tooltip' data-placement='top' title='Payment In Advance'>".number_format($sumReceived)." </span> / <b>$currency</b>"; 
	?><br> 
	<?php 
	echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='Remaining Balance'>".number_format($sumBalance) ." </span> / <b>$currency</b>"; 
	?>
	<?php 
	$dateString = $pay_due_date;
	if ($sumReceived > 0 && $dateString != null && $dateString != '0000-00-00') {
		$date = new DateTime($dateString);
		$dueDate = $date->format('d-m-Y');
		$currentDate = date('d-m-Y');
		?>
		<br>
		<span style="color:red;">
		<?php 
		if ($dueDate == $currentDate) {
			echo "<span id='blink'>" . $dueDate . "</span>";
		} else {
			echo " " . $dueDate;
		}
		?>
		</span>
	<?php } ?>
	<br> 
	<?php 
	echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$addVerifi'>".number_format($payAfterAccept) ." </span> / <b>$currency</b>"; 
	?>
	<br> 
	<?php 
	echo "<span class='text-danger' data-toggle='tooltip' data-placement='top' title='$rpVisa'>".number_format($payAfterVisaRp) ." </span> / <b>$currency</b>"; 
?>