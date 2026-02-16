<?php 
	
if(isset($_POST['subPreDegree'])) {
	$preDegreeName = mysqli_real_escape_string($con, $_POST['preDegreeName']);

	$addPreDeg = "INSERT INTO `previous_client_degrees` (`pre_degree_name`, `status`, `close`, `entry_by`) VALUES ('".$preDegreeName."', '1', '1', '".$_SESSION['user_id']."')";
	$addPreDeg_ex = mysqli_query($con,$addPreDeg);
	if($addPreDeg_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function () {
			Swal.fire({
				title: 'Added!',
				text: 'Degree Added Successfully',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

// Update query
if(isset($_POST['updPreDegree'])) {
	$updateID = $_POST['updateID'];
	$preDegreeName = mysqli_real_escape_string($con, $_POST['preDegreeName']);

	$updPreDeg = "UPDATE previous_client_degrees SET pre_degree_name ='".$preDegreeName."' WHERE pre_degree_id = '".$updateID."' ";
	$updPreDeg_ex = mysqli_query($con,$updPreDeg);
	if($updPreDeg_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function () {
			Swal.fire({
				title: 'Updated!',
				text: 'Degree Updated Successfully',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

?>