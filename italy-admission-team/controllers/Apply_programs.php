<?php
// Update program Note
if(isset($_POST['updateProgramNote'])) {
	$updateProgramID = mysqli_real_escape_string($con, $_POST['updateProgramID']);
	$updateNote = mysqli_real_escape_string($con, $_POST['updateNote']);
	$run = "UPDATE italy_program_report_note".$_SESSION['dbNo']." SET italy_pro_report_note='".$updateNote."' WHERE italy_pro_report_id='".$updateProgramID."' ";
	$run_ex = mysqli_query($con, $run);
	if ($run_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Noted!',
				text: 'Your Note is Saved.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
}

?>