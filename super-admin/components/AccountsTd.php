<?php if($row['client_pay_remaining_status']=='0' && $row['client_pay_email_status']=='0' && $row['client_pay_confirm_status']=='0' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
	<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button> 
	<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button style="width: 110px" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Pay</button> </a>

<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='0' && $row['client_pay_confirm_status']=='0' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
	<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button> 
	<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button style="width: 110px" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Pay</button> </a>

<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='1'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
	<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button> 
	<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button style="width: 110px" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Pay</button> </a>

<?php }elseif($row['client_pay_remaining_status']=='0' && $row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='1'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
	<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button> 
	<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button style="width: 110px" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Pay</button> </a>

<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>
			</div>
		</div>
	</div>

<?php }elseif($row['client_pay_remaining_status']=='2' && $row['client_pay_email_status']=='0' && $row['client_pay_confirm_status']=='0' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>
			</div>
		</div>
	</div>

<?php }elseif($row['client_pay_remaining_status']=='2' && $row['client_pay_email_status']=='1' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>
			</div>
		</div>
	</div>

<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='1'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>
			</div>
		</div>
	</div>

<?php }elseif($row['client_pay_remaining_status']=='2' && $row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='1'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>
			</div>
		</div>
	</div>
	
<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='2' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='0'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2' || $row['client_pay_email_status']=='3') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm3']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm3']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='3' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client3']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>

	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=3"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment 2</button> </a>
			</div>
		</div>
	</div>

<?php }elseif($row['client_pay_remaining_status']=='1' && $row['client_pay_email_status']=='3' && $row['client_pay_confirm_status']=='1' && $row['client_pay_clear_sale']=='1'){ ?>
	<?php
	$btnPCBShow = $row['bank_pay_status']=='1' ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2' || $row['client_pay_email_status']=='3') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm2']) ? "badge-success" : "badge-warning";
	$btnPCShow = (($row['client_pay_email_status']=='1' || $row['client_pay_email_status']=='2' || $row['client_pay_email_status']=='3') && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client2']) ? "badge-success" : "badge-warning";
	?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>
	<?php
	$btnPCBShow = !empty($row['bank_pay_confirm3']) ? "badge-success" : "badge-warning";
	$btnMRShow = !empty($row['manager_pay_confirm3']) ? "badge-success" : "badge-warning";
	$btnPCShow = ($row['client_pay_email_status']=='3' && $row['client_pay_confirm_status']=='1') ? "badge-success" : "badge-warning";
	$btnACKShow = !empty($row['ack_confirm_client3']) ? "badge-success" : "badge-warning";
	?>
	<div class="mb-1">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnACKShow ?> ">Ack</span>
	</div>

	<div class="d-flex justify-content-center align-items-center">
		<?php $btnPayClass=$row['client_pay_remaining_status']==1 ? 'btn-success' : 'btn-outline-info'; ?>
		<button type="button" class="btn <?php echo $btnPayClass;?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Remaining Payments" onclick="addPaymentClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-alpha-p-circle"></i> </button>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. Payment</button> </a>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=2"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment</button> </a>

				<div class="dropdown-divider"></div>
				<a href="accounts-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=3"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> Adv. R. Payment 2</button> </a>
			</div>
		</div>
	</div>
<?php } ?>


<?php
$btnAdPCBShow='badge-warning';
$btnAdMRShow='badge-warning';
$btnAdPCShow='badge-warning';
$btnAdACKShow='badge-warning';
$selectQuery = "SELECT after_ad_name FROM client_payafter_admission WHERE status='1' AND close='1' AND after_ad_client_id='".$row['client_id']."' ";
$selectQuery_ex = mysqli_query($con, $selectQuery);
if ($selectQuery_ex && mysqli_num_rows($selectQuery_ex) > 0) {
	foreach ($selectQuery_ex as $adRow) {
		$afterAdName = $adRow['after_ad_name'];
		if ($afterAdName == 'bank payment confirmation') {
			$btnAdPCBShow = "badge-success";
		}
		if ($afterAdName == 'manager receipt') {
			$btnAdMRShow = "badge-success";
		}
		if ($afterAdName == 'payment confirmation') {
			$btnAdPCShow = "badge-success";
		}
		if ($afterAdName == 'acknowlegment') {
			$btnAdACKShow = "badge-success";
		}
	}
}
?>
<?php if ($row['client_country']=='austria' && ($row['client_countryfrom']=='Pakistan') ) { ?>
	<div class="">
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnAdPCBShow ?> ">P.C.B</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnAdMRShow ?> ">M.R</span>
		<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnAdPCShow ?> ">P.C</span>
		<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnAdACKShow ?> ">Ack</span>
	</div>
	<a href="due-after-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>"><button type="button" class="btn <?php echo ($$btnAdACKShow==1) ? 'btn-success' : 'btn-outline-purple'; ?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dues After Verification Appointment" onclick="dueAfterAccept(<?php echo $row['client_id'] ?>);"><i class="mdi mdi-check-circle"></i> D.A.Verificat.</button> </a>

<?php }elseif ($row['client_country']=='italy' || $row['client_country']=='czech republic'){ ?>

	<?php if($row['due_after_ad_status']=='3'){ ?>
		<div class="">
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnAdPCBShow ?> ">P.C.B</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnAdMRShow ?> ">M.R</span>
			<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnAdPCShow ?> ">P.C</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnAdACKShow ?> ">Ack</span>
		</div>
		<div class="">
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnAdPCBShow ?> ">P.C.B</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnAdMRShow ?> ">M.R</span>
			<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnAdPCShow ?> ">P.C</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnAdACKShow ?> ">Ack</span>
		</div>

		<div class="dropdown notification-list topbar-dropdown ml-1">
			<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"><i class=" mdi mdi-file-account"></i> Account</button>
			<div class="dropdown-menu dropdown-menu-left profile-dropdown">
				<a href="due-after-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=1"><button type="button" class="dropdown-item notify-item text-success" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> D.A.Acceptan.</button> </a>

				<div class="dropdown-divider"></div>
				<a href="due-after-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>&account-status=3"><button type="button" class="dropdown-item notify-item text-dark" data-toggle="tooltip" data-placement="top" title="Account Confirmation"><i class="mdi mdi-alpha-a-circle"></i> D.A.Acceptan. 2</button> </a>
			</div>
		</div>

		<a href="due-after-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>"><button type="button" class="btn <?php echo ($btnAdACKShow==1) ? 'btn-success' : 'btn-outline-danger'; ?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dues After Acceptance" onclick="dueAfterAccept(<?php echo $row['client_id'] ?>);"><i class="mdi mdi-check-circle"></i> D.A.Acceptan.</button> </a>
	<?php }else{ ?>
		<div class="">
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Payment Confirm form Bank" class="badge <?= $btnAdPCBShow ?> ">P.C.B</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Account Manager Receipt" class="badge <?= $btnAdMRShow ?> ">M.R</span>
			<span data-toggle="tooltip" data-placement="top" title="Payment Confirmation Sent to Client" class="badge <?= $btnAdPCShow ?> ">P.C</span>
			<span data-toggle="tooltip" data-placement="top" title="Uploaded Acknowledge From Client" class="badge <?= $btnAdACKShow ?> ">Ack</span>
		</div>
		<a href="due-after-confirmation?client-id=<?php echo $row['client_id'];?>&<?php echo $getUrl;?>"><button type="button" class="btn <?php echo ($btnAdACKShow==1) ? 'btn-success' : 'btn-outline-danger'; ?> btn-sm mt-1" data-toggle="tooltip" data-placement="top" title="Dues After Acceptance" onclick="dueAfterAccept(<?php echo $row['client_id'] ?>);"><i class="mdi mdi-check-circle"></i> D.A.Acceptan.</button> </a>
	<?php } ?>
<?php } ?>