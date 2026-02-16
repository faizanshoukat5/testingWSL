<?php 
$intakeMap = [
	'25-26' => '2025-2026',
	'26-27' => '2026-2027',
	'27-28' => '2027-2028',
	'Both'  => '2025-2026/2026-2027 Both'
];
?>
<?php echo "ID-".$row['client_id'];?> 
<b data-toggle="tooltip" data-placement="top" title="Intake Year <?php echo $intakeMap[$row['client_intake_year']] ?? '';?>">(<?php echo $row['client_intake_year'];?>)</b>
<br>
<b><?php echo date("d-m-Y", strtotime($row['create_date']));?></b>
<br>
<?php if ($row['client_process_status']=='OverAll Process') {
	echo "<b class='text-purple'>OverAll Process <br> (Admission + Visa)</b>";
}elseif ($row['client_process_status']=='Only Admission Process') {
	echo "<b class='text-info'>Only Admission <br> Process</b>";
}elseif ($row['client_process_status']=='OverAll Process (Invitation + Visa)') {
	echo "<b class='text-primary'>OverAll Process <br> (Invitation + Visa)</b>";
}elseif ($row['client_process_status']=='Have Invitation Letter (Only Visa)') {
	echo "<b class='text-danger'>Have Invitation <br> Letter (Only Visa)</b>";
}elseif ($row['client_process_status']=='Documents Already Legalized') {
	echo "<b class='text-warning'>Documents Already <br> Legalized (after <br> legalization process)</b>";
}elseif ($row['client_process_status']=='Only For Appointment') {
	echo "<b class='text-pink'>Only For <br> Appointment</b>";
}elseif ($row['client_process_status']=='IELTS Enrollment') {
	echo "<b class='text-pink'>IELTS Enrollment</b>";
}elseif ($row['client_process_status']=='The client already has an appointment for legalized documents') {
	echo "<b class='text-info'>The client already <br> has an appointment <br> for legalized <br> documents</b>";
}else{
	echo "<b class='text-danger'>Have Acceptance <br> Letter (Only Visa)</b>";
}
?>