<?php 
	include ("controllers/All_clients.php");
?>
<?php 
if(isset($_POST['updUniDate'])) {
	$uniName = mysqli_real_escape_string($con, $_POST['uniName']);
	$degreeName = mysqli_real_escape_string($con, $_POST['degreeName']);
	$radioStep = mysqli_real_escape_string($con, $_POST['radioStep']);
	$uniOpeningDate = mysqli_real_escape_string($con, $_POST['uniOpeningDate']);
	$uniClosingDate = mysqli_real_escape_string($con, $_POST['uniClosingDate']);
	$proapplyDates = mysqli_real_escape_string($con, $_POST['proapplyDates']);
	$uniAnyNote = mysqli_real_escape_string($con, $_POST['uniAnyNote']);

	if($proapplyDates=='1'){

		$current_date =  date('Y-m-d');
		$updUni = "UPDATE italy_add_programs".$_SESSION['dbNo']." SET italy_active_date='".$current_date."' WHERE italy_ap_uni_name='".$uniName."' AND italy_ap_degree='".$degreeName."'";
		$updUni_ex = mysqli_query($con,$updUni);

		$updProCall1 = "UPDATE italy_add_programs_details".$_SESSION['dbNo']." SET italy_ad_1st_opening_date='".$uniOpeningDate."', italy_ad_1st_actual_date='".$uniClosingDate."' WHERE italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_current_round='1' AND italy_ad_intake='2026' ";
		$updProCall1_ex = mysqli_query($con,$updProCall1);

		$updProCall2 = "UPDATE italy_add_programs_details".$_SESSION['dbNo']." SET italy_ad_2nd_opening_date='".$uniOpeningDate."', italy_ad_2nd_actual_date='".$uniClosingDate."' WHERE italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_current_round='2' AND italy_ad_intake='2026' ";
		$updProCall2_ex = mysqli_query($con,$updProCall2);

		$updProCall3 = "UPDATE italy_add_programs_details".$_SESSION['dbNo']." SET italy_ad_3rd_opening_date='".$uniOpeningDate."', italy_ad_3rd_actual_date='".$uniClosingDate."' WHERE italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_current_round='3' AND italy_ad_intake='2026' ";
		$updProCall3_ex = mysqli_query($con,$updProCall3);

		$updProCall4 = "UPDATE italy_add_programs_details".$_SESSION['dbNo']." SET italy_ad_4th_opening_date='".$uniOpeningDate."', italy_ad_4th_actual_date='".$uniClosingDate."' WHERE italy_ad_uni_name='".$uniName."' AND italy_ad_degree='".$degreeName."' AND italy_ad_current_round='4' AND italy_ad_intake='2026' ";
		$updProCall4_ex = mysqli_query($con,$updProCall4);

		$addUniName = "INSERT INTO `italy_university_dates` (`italy_university_name`, `italy_degree_name`, `italy_opening_date`, `italy_closing_date`, `italy_note`, `italy_date_status`, `close`, `status`, `entry_by`) VALUES ('".$uniName."', '".$degreeName."', '".$uniOpeningDate."', '".$uniClosingDate."', '".$uniAnyNote."', '".$radioStep."', '1', '1', '".$_SESSION['user_id']."')";
		$addUniName_ex = mysqli_query($con,$addUniName);

	}else{
		$addUniName = "INSERT INTO `italy_university_dates` (`italy_university_name`, `italy_degree_name`, `italy_opening_date`, `italy_closing_date`, `italy_note`, `italy_date_status`, `close`, `status`, `entry_by`) VALUES ('".$uniName."', '".$degreeName."', '".$uniOpeningDate."', '".$uniClosingDate."', '".$uniAnyNote."', '".$radioStep."', '1', '1', '".$_SESSION['user_id']."')";
		$addUniName_ex = mysqli_query($con,$addUniName);
	}

	if ($addUniName_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Added!',
				text: 'University Opening & Closing date are Added.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
					window.location.reload();
				});
			});
		</script>";
	}
}
// Add CGPA
if(isset($_POST['updUniCGPA'])) {
	$uniCGPAName = mysqli_real_escape_string($con, $_POST['uniCGPAName']);
	$degreeCGPAName = mysqli_real_escape_string($con, $_POST['degreeCGPAName']);
	$uniCGPA = mysqli_real_escape_string($con, $_POST['uniCGPA']);
	$uniCGPANote = mysqli_real_escape_string($con, $_POST['uniCGPANote']);

	$addUniName = "INSERT INTO `italy_university_cgpa` (`italy_cgpa_uni_name`, `italy_cgpa_uni_degree`, `italy_uni_cgpa`, `italy_cgpa_uni_note`, `close`, `status`, `entry_by`) VALUES ('".$uniCGPAName."', '".$degreeCGPAName."', '".$uniCGPA."', '".$uniCGPANote."', '1', '1', '".$_SESSION['user_id']."')";
	$addUniName_ex = mysqli_query($con,$addUniName);

	if ($addUniName_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Added!',
				text: 'University CGPA is Added.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
					window.location.reload();
				});
			});
		</script>";
	}
}
?>