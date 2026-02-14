<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkcountryName'])) {
	include ('../components/AllFiltersPOST.php');
	// Initialize the base WHERE condition
	$whereCondition = "close='1' AND status='1' AND admin_status='1' AND case_status='0' AND change_status='0' AND client_document_status='0' ";
	// Add filters based on the input parameters
	include ('../components/AllFiltersData.php');
	?>
	<div class="mt-1" style="overflow-x: auto; white-space: nowrap;">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 200px;">Client Info</th>
					<th style="width: 120px;">Degree</th>
					<th style="width: 100px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 160px;">Payment Source</th>
					<th style="width: 150px;">Subject</th>
					<th style="width: 100px;">Document</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);
				?>
				<?php include ("../components/PIAQueries.php");?>
				<tr id="<?php echo $row['client_id']; ?>">
					<td><?php echo $sr;?></td>
					<td>
						<?php include ("../components/IDDateTd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/ClientInfoTd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td>
					<?php include ("../components/PIATd.php");?>
					</td>
					<td class="breakTD">
						<b><?php echo ucwords($row['client_case_status']);?></b>
						<br>
						<?php echo $payMethod;?>
					</td>
					<td class="breakTD"><?php echo $row['subject'];?> </td>
					<?php
					$getUrl = base64_encode($row['client_name']."".$row['client_email']);
					?>
					<td>
					<!-- document  -->
					<a href="admission-documents?client-id=<?= $row['client_id'] ?>&<?= $getUrl ?>" type="button" class="btn <?= $row['client_document_status']==1 ? 'btn-success' : 'btn-outline-warning' ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Admission Documents"><i class="mdi <?= $row['client_document_status']==1 ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i> Docu.</a>
					<br>

					<?php if($row['client_pro_confirm_status'] == 1 && $row['client_pay_confirm_status'] ==1 && $row['client_document_status'] == 1 && $row['client_document_status'] ==1) {?>
						<span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Forwarded to Admission Head">Forwarded</span>
					<?php }elseif($row['client_pro_confirm_status']==1 || $row['client_pay_confirm_status']==1 || $row['client_document_status']==1 || $row['client_document_status']==1){?>
						<span class="badge badge-dark" data-toggle="tooltip" data-placement="top" title="Process">Process</span>
					<?php }if($row['client_pro_confirm_status']==0 && $row['client_pay_confirm_status']==0 && $row['client_document_status']==0 && $row['client_document_status']==0) {?>
						<span class="badge badge-info" id="blink" data-toggle="tooltip" data-placement="top" title="New Client">New</span>
					<?php }?>
					</td>

					<td>
						<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Track this Client" onclick="ViewClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-eye"></i></button> 
					</td>
				</tr>
				<?php
				$sr--;
				}
				?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({ html: true });
				if ($.fn.DataTable.isDataTable("#datatable")) {
					// Destroy the existing DataTable instance
					$('#datatable').DataTable().destroy();
				}
				$("#datatable").DataTable({
					paging: false,
					searching: false,
					info: false,
					lengthChange: false,
					order: [[0, 'desc']],
				});
			});
		</script>
	</div>
	<?php include ('../components/TablePagination.php'); ?>
<?php

}
?>