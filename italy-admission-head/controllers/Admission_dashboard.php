<?php 
$user_email = $_SESSION['user_email'];
$user_designation = $_SESSION['user_designation'];
$user_id = $_SESSION['user_id'];
$current_date = date('Y-m-d');
$current_time = date('H:i:s');
$current_month = date('m-Y');

$fetch = "SELECT * FROM wt_users WHERE email = '".$user_email."'";
$execuit = mysqli_query($con,$fetch);


?>