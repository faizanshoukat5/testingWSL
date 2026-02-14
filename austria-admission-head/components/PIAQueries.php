<?php 
// SUM of adv payment from the client payments
$payClient = "SELECT SUM(pay_receive_amount), SUM(pay_online_amount), pay_method, pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id='$clientID'";
$payClient_ex = mysqli_query($con, $payClient);
$payrow = mysqli_fetch_assoc($payClient_ex);
$sumReceived = $payrow['SUM(pay_receive_amount)'] + $payrow['SUM(pay_online_amount)'];
$payMethod = $payrow['pay_method'];
$payAfterAccept = $payrow['pay_after_accept'];
$payAfterVisaRp = $payrow['pay_aftervisa_rp'];

// fetch last balance amount and date from the clients payments
$sumBalance = 0;
$pay_due_date = null;
$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id='$clientID' ORDER BY cl_pay_id DESC LIMIT 1 ";
$balClient_ex = mysqli_query($con, $balClient);
if ($balClient_ex && mysqli_num_rows($balClient_ex) > 0) {
	$balrow = mysqli_fetch_assoc($balClient_ex); 
	$sumBalance = $balrow['pay_bal_amount'];
	$pay_due_date = $balrow['pay_due_date'];
}

?>