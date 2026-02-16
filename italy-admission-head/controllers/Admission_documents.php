<?php 
// doc14
if(isset($_POST['subDoc14'])) {
	$updateID = $_POST['updateID'];
	$doc14 = $_POST['admission_Doc14'];
	$updatDoc14 = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc14='".$doc14."' WHERE admission_client_id='".$updateID."'";
	$updatDoc14_ex = mysqli_query($con, $updatDoc14);
	if ($updatDoc14_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Document upload Successfully.',
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
// doc15
if(isset($_POST['subDocText15'])) {
	$updateID = $_POST['updateID'];
	$doc15 = $_POST['admission_Doc15'];
	$updatDoc15 = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc15='".$doc15."' WHERE admission_client_id='".$updateID."'";
	$updatDoc15_ex = mysqli_query($con, $updatDoc15);
	if ($updatDoc15_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Document upload Successfully.',
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

// docText20
if(isset($_POST['subDocText20'])) {
	$updateID = $_POST['updateID'];
	$doc20 = $_POST['admission_Doc20'];
	$updatDoc20 = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc20='".$doc20."' WHERE admission_client_id='".$updateID."'";
	$updatDoc20_ex = mysqli_query($con, $updatDoc20);
	if ($updatDoc20_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Document upload Successfully.',
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
// doc34
if(isset($_POST['subDoc34'])) {
	$updateID = $_POST['updateID'];
	$admissionDoc34 = $_POST['admission_Doc34'];

	$updatDoc34 = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc34='".$admissionDoc34."' WHERE admission_client_id='".$updateID."' ";
	$updatDoc34_ex = mysqli_query($con, $updatDoc34);
	if ($updatDoc34_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Document upload Successfully.',
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

// doc35
if(isset($_POST['subDoc35'])) {
	$updateID = $_POST['updateID'];
	$admissionDoc35='';
	if (!empty($_FILES['admission_Doc35']['name'][0])) {
		$uploadedFiles = [];
		foreach ($_FILES['admission_Doc35']['name'] as $key => $fileName) {
			$tmpFilePath = $_FILES['admission_Doc35']['tmp_name'][$key];
			if ($tmpFilePath != "") {
				$cleanFileName = preg_replace('/[^\w.]+/', '', $fileName);
				$newFileName = date('d-m-Y').'_'.date('H-i-s'). $cleanFileName;
				if (move_uploaded_file($tmpFilePath, '../payagreements/' . $newFileName)) {
					$uploadedFiles[] = $newFileName;
				}
			}
		}
		if (!empty($uploadedFiles)) {
			$admissionDoc35 = implode(',', $uploadedFiles);
		}
	}

	$updatDoc35 = "UPDATE client_addmission_doc".$_SESSION['dbNo']." SET admission_doc35='".$admissionDoc35."' WHERE admission_client_id='".$updateID."' ";
	$updatDoc35_ex = mysqli_query($con, $updatDoc35);
	if ($updatDoc35_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Uploaded!',
				text: 'Document upload Successfully.',
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