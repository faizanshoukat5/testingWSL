<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkclientDegree'])) {
	$uniIntake = $_POST['checkuniIntake'];
	$clientDegree = $_POST['checkclientDegree'];
	$uniStatus = $_POST['checkuniStatus'];
	$applicationProcess = $_POST['checkapplicationProcess'];

	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition = "(close='1' || close='0') AND status='1' ";

	if ($clientDegree!="all") {
		$whereCondition .= " AND aus_uni_degree='".$clientDegree."' ";
	}
	if ($uniStatus!="all") {
		$whereCondition .= " AND aus_uni_status='".$uniStatus."' ";
	}
	if ($applicationProcess!="all") {
		if($applicationProcess=='Direct Apply'){
			$whereCondition .= " AND aus_uni_direct_apply='1' ";
		}
		if($applicationProcess=='Courier Apply'){
			$whereCondition .= " AND aus_uni_courier_apply='1' ";
		}
	}
	if($clientDetails=='' || $clientDetails!=''){
		$whereCondition .= " AND (aus_uni_name LIKE '%".$clientDetails."%' OR aus_uni_degree LIKE '%".$clientDetails."%') ";
	}
	$countQuery = "SELECT COUNT(DISTINCT aus_add_id) as total from austria_add_universities".$_SESSION['dbNo']." WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$clientData = "SELECT * from austria_add_universities".$_SESSION['dbNo']." WHERE $whereCondition ORDER BY aus_add_id DESC LIMIT $limit OFFSET $offset ";
	$clientData_ex = mysqli_query($con,$clientData);
	?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 200px;">Name</th>
					<th style="width: 50px;">Degree</th>
					<th style="width: 50px;">Status</th>
					<th style="width: 80px;">Direct</th>
					<th style="width: 80px;">Courier</th>
					<th style="width: 80px;">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
			?>
				<tr id="<?php echo $row['aus_add_id'];?>" class="<?php echo ($row['close']=='0') ? 'bg-pink text-white' : '';?>">
					<td><?php echo $sr;?></td>
					<td class="breakTD"><?php echo $row['aus_uni_name'];?></td>
					<td><?php echo ucwords($row['aus_uni_degree']);?></td>
					<td><?php echo ucwords($row['aus_uni_status']);?></td>
					<td><?= $row['aus_uni_direct_apply'] == '1' ? 'Yes' : 'No'; ?></td>
					<td><?= $row['aus_uni_courier_apply'] == '1' ? 'Yes' : 'No'; ?></td>
					<td>
						<button type="button" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-outline-success btn-sm" onclick="viewAddUni(<?php echo $row['aus_add_id'];?>)"><i class="mdi mdi-eye"></i></button>
						<button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-outline-primary btn-sm" onclick="editAddUni(<?php echo $row['aus_add_id'];?>)"><i class="mdi mdi-square-edit-outline"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="delAddUni(<?php echo $row['aus_add_id'];?>);"><i class="mdi mdi-trash-can"></i></button>
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
	<div class="row mt-2">
		<div class="col-md-5">
			<div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">
				<?php
				$start = $offset + 1;
				$end = min($offset + $limit, $totalRecords);
				echo "Showing $start to $end of $totalRecords entries";
				?>
			</div>
		</div>
		<div class="col-md-7">
			<ul class="pagination float-right">
				<?php
				// Previous button
				if ($page > 1) {
					echo '<li style="cursor: pointer;" class="paginate_button page-item previous" onclick="viewClientsFilter('.($page - 1).');"><span class="page-link">Previous</span></li>';
				} else {
					echo '<li class="paginate_button page-item previous disabled"><span class="page-link">Previous</span></li>';
				}
				// Maximum number of pages around the current page
				$range = 1;
				// Always display the first and last few pages
				$startRange = max(4, $page - $range); 
				$endRange = min($totalPages - 3, $page + $range);
				// Show first three pages
				$i=1;
				for ($i = 1; $i <= 3; $i++) {
					if ($i > $totalPages) break;
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis before the middle range
				if ($startRange > 4) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Pages around the current page
				for ($i = $startRange; $i <= $endRange; $i++) {
					if ($i > $totalPages || $i < 4) continue;
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Ellipsis after the middle range
				if ($endRange < $totalPages - 3) {
					echo '<li class="paginate_button page-item disabled"><span class="page-link">...</span></li>';
				}
				// Show last three pages
				for ($i = max($totalPages - 2, 4); $i <= $totalPages; $i++) {
					$active = $i == $page ? 'active' : '';
					echo '<li style="cursor: pointer;" class="paginate_button page-item '.$active.'" onclick="viewClientsFilter('.$i.');"><span class="page-link">'.$i.'</span></li>';
				}
				// Next button
				if ($page < $totalPages) {
					echo '<li style="cursor: pointer;" class="paginate_button page-item next" onclick="viewClientsFilter('.($page + 1).');"><span class="page-link">Next</span></li>';
				} else {
					echo '<li class="paginate_button page-item next disabled"><span class="page-link">Next</span></li>';
				}
				?>
			</ul>
		</div>
	</div>
<?php
}
?>