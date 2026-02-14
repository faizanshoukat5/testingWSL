<div class="card">
	<div class="card-body">

		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="viewPayModal" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">View Payment</h4>
					</div>
					<div class="modal-body viewPayModal">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<?php 
		if(isset($_GET['pay-date'])){
			$payDate = $_GET['pay-date'];
		?>
		<div class="table-responsive mt-3">
			<table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>ID</th>
						<th>Name</th>
						<th>WhatsApp</th>
						<th>Country</th>
						<th>Degree</th>
						<th>Received</th>
						<th>Action</th>
					</tr>
				</thead>
				<thead>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td class="font-weight-bold"><?php echo date("d-m-Y", strtotime($payDate)) ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					
					<?php 
					$sr=1;
					$t_received=0;
					$payClient = "SELECT * FROM clients_payments JOIN clients ON clients_payments.pay_client_id = clients.client_id WHERE clients_payments.close='1' AND clients_payments.status = '1' AND pay_date = '".$payDate."' ORDER BY clients_payments.cl_pay_id DESC "; 
					$payClient_ex = mysqli_query($con, $payClient);
					foreach ($payClient_ex as $row) {
						$received = $row['pay_receive_amount'];
						$changingApplied = $row['client_applied'];
						$appliedChanging = json_decode($changingApplied, true);
						?>
					<tr id="<?php echo $row['cl_pay_id'];?>">
						<?php 
						echo "<td>".$sr."</td><td>ID-".$row['client_id']."</td><td>".ucwords($row['client_name'])."</td><td>".$row['client_whatapp']."</td><td>".ucwords($row['client_country'])."</td>";

						echo "<td>";
						foreach ($appliedChanging as $appRow){
							echo ucwords($appRow)." ";
						}
						echo "</td>";

						echo "<td>".number_format($row['pay_receive_amount'])."</td>";
						?>
						
						<td>
							<button type="button" class="btn btn-outline-dark btn-sm" data-toggle="tooltip" data-placement="top" title="Approve" onclick="payConfirm(confirmC,<?php echo $row['cl_pay_id'];?>);"><i class="mdi mdi-check-circle"></i></button>
							<button type="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="ViewPayments(<?php echo $row['cl_pay_id'];?>);"><i class="mdi mdi-eye"></i></button>
						</td>
					</tr>
					<?php
					$t_received+=$received;
					$sr++;
					}
					?>
				</tbody>
				<thead class="bg-primary text-white">
					<tr>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th>Total</th>
						<th><?php echo number_format($t_received);?></th>
						<th></th>
					</tr>
				</thead>
			</table>
		</div>
		<?php 
		}else{
		?>
		<!-- Payment datatable -->
		<div class="table-responsive mt-3">
			<table id="datatable" class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>Date</th>
						<th>Received</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$payClient = "SELECT *,SUM(pay_receive_amount) FROM clients_payments WHERE close='1' AND status = '1' GROUP BY pay_date ORDER BY pay_date DESC"; 
					$payClient_ex = mysqli_query($con, $payClient);
					$sr = mysqli_num_rows($payClient_ex);
					foreach ($payClient_ex as $payrow) {
						$advReceived = $payrow['SUM(pay_receive_amount)'];
					?>
					<tr id="<?php echo $payrow['cl_pay_id'];?>">
						<?php 
						echo "<td>".$sr."</td><td>".date("d-m-Y", strtotime($payrow['pay_date']))."</td><td>".number_format($advReceived)."</td>";
						?>
						<td>
							<a href="payments?pay-date=<?php echo $payrow['pay_date'];?>" type="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="Approve Payment Of This Day"><i class="mdi mdi-eye"></i></a>
						</td>
					</tr>
					<?php
					$sr--;
					}
					?>
				</tbody>
			</table>
		</div>
		<?php } ?>
		
	</div>
</div>

<script type="text/javascript">
	// Edit client function
	function ViewPayments(idpay) {
		var idpay = idpay;
		// alert(idpay);
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'paymentView='+idpay,
			success: function(data){
				$(".viewPayModal").html(data);
				$("#viewPayModal").modal('show');
			}
		});
	};
	// View client function in footer
	// confirm client
	function confirmC(idpay) {
		var idpay = idpay;
		$.ajax({
			type:"POST",
			url:"getState.php",
			data: 'payApprove='+idpay,
			success:function(data) {
				Swal.fire(
					'Approved!',
					'Record has been Approved.',
					'success'
				)
				setTimeout(function () {
					location.reload();
				}, 2000);
			}
		});
	};
</script>