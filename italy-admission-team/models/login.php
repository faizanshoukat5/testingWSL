<?php 
	if($_SESSION['user_type'] != "italy admission team" || $_SESSION['uname'] == " "){
		header("Location: ../login");
	}
?>