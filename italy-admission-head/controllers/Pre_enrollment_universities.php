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

	$addUniName = "INSERT INTO `italy_university_dates` (`italy_university_name`, `italy_degree_name`, `italy_opening_date`, `italy_closing_date`, `italy_note`, `italy_date_status`, `close`, `status`, `entry_by`) VALUES ('".$uniName."', '".$degreeName."', '".$uniOpeningDate."', '".$uniClosingDate."', '".$uniAnyNote."', '".$radioStep."', '1', '1', '".$_SESSION['user_id']."')";
	$addUniName_ex = mysqli_query($con,$addUniName);
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