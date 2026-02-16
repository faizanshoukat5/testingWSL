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

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition ="close='1' AND status='1' ";

	if($clientDetails=='' || $clientDetails!=''){
		$whereCondition .=" AND (pre_degree_name LIKE '%".$clientDetails."%')";	
	}
	$countQuery = "SELECT COUNT(*) as total FROM previous_client_degrees WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$preDegreeData = "SELECT * from previous_client_degrees WHERE $whereCondition ORDER BY pre_degree_id DESC LIMIT $limit OFFSET $offset ";
	$preDegreeData_ex = mysqli_query($con,$preDegreeData);

	?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 10px;">Sr</th>
					<th style="width: 200px;">Client's Previous Degree</th>
					<th style="width: 10px;">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($preDegreeData_ex)) {
				?>
				<tr id="<?php echo $row['pre_degree_id'];?>">
					<td><?php echo $sr;?></td>
					<td><?php echo ucwords($row['pre_degree_name']);?></td>
					<td>
						<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editClientDegree(<?php echo $row['pre_degree_id'];?>);"><i class="mdi mdi-square-edit-outline"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="del(delC,<?php echo $row['pre_degree_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
					</td>
				</tr>
			<?php
			$sr--;
			}?>
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