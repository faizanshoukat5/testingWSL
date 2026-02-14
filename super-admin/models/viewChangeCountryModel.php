<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkcountryName'])) {
	include ('../components/AllFiltersPOST.php');
	// Initialize the base WHERE condition
	$whereCondition = "close='1' AND status='1' AND admin_status='1' AND case_status='0' AND change_status='1' ";
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
					<th style="width: 200px;">Subject</th>
					<th style="width: 200px;">Deal By</th>
					<th style="width: 200px;">Change Note</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$entryBy = $row['entry_by'];
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
					$wt = "SELECT fname, lname from wt_users WHERE close='1' AND status='1' AND wt_id='".$entryBy."'";
					$wt_ex = mysqli_query($con,$wt);
					foreach ($wt_ex as $wtrow) {
						$dealName = $wtrow['fname']." ".$wtrow['lname'];
					}
					?>
					<td><?php echo ucwords($dealName);?></td>
					<td class="ellipsis" data-toggle="tooltip" data-placement="left" title="<?php echo $row['change_country_note'];?>">
						<?php echo $row['change_country_note'];?> 
						<br><span class="text-danger"><?php echo $row['change_country_date'];?></span> <br>
						<?php 
						$fileMulti = explode(',', $row['change_country_screenshot']);
						foreach ($fileMulti as $fileName) {
							?>
							<a href="../payagreements/<?php echo $fileName;?>" target="blank"><?php echo $fileName;?></a><br>
						<?php } ?>
					</td>
					<td>
						<button type="button" class="btn btn-outline-success btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="ViewClients(<?php echo $row['client_id'];?>);"><i class="mdi mdi-eye"></i></button> 
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