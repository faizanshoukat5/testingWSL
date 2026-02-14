<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkselectPage'])) {

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition ="close='1' AND status='1' ";

	if($clientDetails=='' || $clientDetails!=''){
		$whereCondition .= " AND (start_date='".$clientDetails."' OR end_date LIKE '%".$clientDetails."%')";
	}
	$countQuery = "SELECT COUNT(*) as total FROM session_year WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$clientData = "SELECT * from session_year WHERE $whereCondition ORDER BY sy_id DESC LIMIT $limit OFFSET $offset ";
	$clientData_ex = mysqli_query($con,$clientData);
	?>
	<!-- data table -->
	<div class="table-wraper">
		<div class="mt-1 table-container" id="table-container" style="overflow-x: auto; white-space: nowrap;">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th>Sr No.</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Active</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sr = $totalRecords - $offset;
				while ($row = mysqli_fetch_assoc($clientData_ex)) {
				?>
					<tr id="<?php echo $row['sy_id'] ?>">
						<td><?php echo $sr ?> </td>
						<td><?php echo date("d-m-Y", strtotime($row['start_date']))?> </td>
						<td><?php echo date("d-m-Y", strtotime($row['end_date'])) ?> </td>
						<?php if ($row['sy_id']==$_SESSION['dbNo']) { ?>
						<td><input checked id="<?php echo $row['sy_id'];?>" type="radio" name="radio" onclick="sessionStart(<?php echo $row['sy_id'];?>);"> </td>
						<?php }else{ ?>
						<td><input id="<?php echo $row['sy_id']?>" type="radio" name="radio" onclick="sessionStart(<?php echo $row['sy_id'] ?>);"> </td>
						<?php } ?>
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
	</div>
	<!-- search input & select option & loader -->
	<?php include ("../components/TablePagination.php"); ?>
<?php
}
?>