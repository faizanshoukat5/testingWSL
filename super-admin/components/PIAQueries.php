<?php 
// SUM of adv payment from the client payments
$payClient = "SELECT SUM(pay_receive_amount), SUM(pay_online_amount), pay_method FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND pay_client_id='$clientID'";
$payClient_ex = mysqli_query($con, $payClient);
$payrow = mysqli_fetch_assoc($payClient_ex);
$sumReceived = $payrow['SUM(pay_receive_amount)'] + $payrow['SUM(pay_online_amount)'];
$payMethod = $payrow['pay_method'];

// fetch last balance amount and date from the clients payments
$sumBalance = 0;
$pay_due_date = null;
$balClient = "SELECT pay_bal_amount, pay_due_date FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments".$_SESSION['dbNo']." WHERE close='1' AND status='1' GROUP BY pay_client_id) AND pay_client_id='$clientID' GROUP BY pay_client_id";
$balClient_ex = mysqli_query($con, $balClient);
if ($balClient_ex && mysqli_num_rows($balClient_ex) > 0) {
	$balrow = mysqli_fetch_assoc($balClient_ex); 
	$sumBalance = $balrow['pay_bal_amount'];
	$pay_due_date = $balrow['pay_due_date'];
}

// query get first row of accept and visa rp
$select_query = "SELECT pay_after_accept, pay_aftervisa_rp FROM clients_payments".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND pay_client_id='$clientID' LIMIT 1";
$select_query_ex = mysqli_query($con, $select_query);
$pay1Row = mysqli_fetch_assoc($select_query_ex);
$payAfterAccept = $pay1Row['pay_after_accept'];
$payAfterVisaRp = $pay1Row['pay_aftervisa_rp'];
?>