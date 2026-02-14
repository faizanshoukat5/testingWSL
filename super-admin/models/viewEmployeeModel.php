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

	$whereCondition ="close='1' AND status='1' AND type!='admin' ";

	if($clientDetails!=''){
		$whereCondition .= " AND (CONCAT(fname, ' ', lname) LIKE '%".$clientDetails."%' OR fname='".$clientDetails."' OR lname LIKE '%".$clientDetails."%' OR phone LIKE '%".$clientDetails."%' OR email LIKE '%".$clientDetails."%' OR type LIKE '%".$clientDetails."%' OR designation LIKE '%".$clientDetails."%' )";
	}
	$countQuery = "SELECT COUNT(*) as total FROM wt_users WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$clientData = "SELECT * from wt_users WHERE $whereCondition ORDER BY wt_id DESC LIMIT $limit OFFSET $offset ";
	$clientData_ex = mysqli_query($con,$clientData);
	?>
	<!-- data table -->
	<div class="table-wraper">
		<div class="mt-1 table-container" id="table-container" style="overflow-x: auto; white-space: nowrap;">
			<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
				<thead>
					<tr>
						<th style="width: 5px;">Sr.</th>
						<th style="width: 60px;">Name</th>
						<th style="width: 50px;">Phone</th>
						<th style="width: 80px;">Email</th>
						<th style="width: 80px;">Role</th>
						<th style="width: 80px;">Designation</th>
						<th style="width: 45px;">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$sr = $totalRecords - $offset;
				while ($row = mysqli_fetch_assoc($clientData_ex)) {
				?>
					<tr id="<?php echo $row['wt_id']; ?>">
						<?php 
						echo "<td>".$sr."</td><td class='breakTD'>".ucwords($row['fname']." ".$row['lname'])."</td><td>".$row['phone']."</td><td class='breakTD'>".$row['email']."</td><td class='breakTD'>".ucwords($row['type'])."</td><td class='breakTD'>".ucwords($row['designation'])."</td>";
						?>
						<td>
							<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Login This Portal" onclick="otherPortal(<?php echo $row['wt_id'];?>);"><i class="mdi mdi-login"></i></button>
							<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editEmployee(<?php echo $row['wt_id'];?>);"><i class="mdi mdi-square-edit-outline"></i></button>
							<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="del(delC,<?php echo $row['wt_id']; ?>);"><i class="mdi mdi-trash-can"></i></button>
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
	</div>
	<!-- search input & select option & loader -->
	<?php include ("../components/TablePagination.php"); ?>
<?php
}
?>