<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkappProcess'])) {

	$appProcess = $_POST['checkappProcess'];
	$clientDegree = $_POST['checkclientDegree'];

	$uniIntake = $_POST['checkuniIntake'];
	$clientDetails = $_POST['checkclientDetails'];
	$page = $_POST['pageNumber'];
	$limit = $_POST['checkselectPage'];
	$offset = ($page - 1) * $limit;

	$whereCondition = "(close='1' || close='0') AND status='1' AND italy_uni_intake='".$uniIntake."' ";

	if ($appProcess!="all") {
		if($appProcess=='Direct Apply'){
			$whereCondition .= " AND italy_uni_direct_apply='1' ";
		}
		if($appProcess=='Direct Pre Enrollment'){
			$whereCondition .= " AND italy_uni_pre_enrollment='1' ";
		}
		if($appProcess=='Dream Apply'){
			$whereCondition .= " AND italy_uni_dream_apply='1' ";
		}
	}
	if ($clientDegree!="all") {
		$whereCondition .= " AND italy_uni_degree='".$clientDegree."' ";
	}

	if($clientDetails=='' || $clientDetails!=''){
		$whereCondition .= " AND (italy_uni_name LIKE '%".$clientDetails."%' OR italy_uni_degree LIKE '%".$clientDetails."%') ";
	}
	$countQuery = "SELECT COUNT(DISTINCT italy_add_id) as total from italy_add_universities".$_SESSION['dbNo']." WHERE $whereCondition ";
	$countResult = mysqli_query($con, $countQuery);
	$totalRecords = mysqli_fetch_assoc($countResult)['total'];
	$totalPages = ceil($totalRecords / $limit);

	$clientData = "SELECT * from italy_add_universities".$_SESSION['dbNo']." WHERE $whereCondition ORDER BY italy_add_id DESC LIMIT $limit OFFSET $offset ";
	$clientData_ex = mysqli_query($con,$clientData);
	?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 200px;">Name</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 80px;">Direct</th>
					<th style="width: 80px;">Dream</th>
					<th style="width: 120px;">Pre Enrollment</th>
					<th style="width: 80px;">Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
			?>
				<tr id="<?php echo $row['italy_add_id'];?>" class="<?php echo ($row['close']=='0') ? 'bg-pink text-white' : '';?>">
					<td><?php echo $sr;?></td>
					<td class="breakTD"><?php echo $row['italy_uni_name'];?></td>
					<td><?php echo ucwords($row['italy_uni_degree']);?></td>
					<td><?= $row['italy_uni_direct_apply'] == '1' ? 'Yes' : 'No'; ?></td>
					<td><?= $row['italy_uni_dream_apply'] == '1' ? 'Yes' : 'No'; ?></td>
					<td><?= $row['italy_uni_pre_enrollment'] == '1' ? 'Yes' : 'No'; ?></td>
					<td>
						<button type="button" data-toggle="tooltip" data-placement="top" title="View" class="btn btn-<?php echo ($row['close']=='0') ? 'success' : 'outline-success';?> btn-sm" onclick="viewAddUni(<?php echo $row['italy_add_id'];?>)"><i class="mdi mdi-eye"></i></button>
						<button type="button" data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-<?php echo ($row['close']=='0') ? 'primary' : 'outline-primary';?> btn-sm" onclick="editAddUni(<?php echo $row['italy_add_id'];?>)"><i class="mdi mdi-square-edit-outline"></i></button>
						<button type="button" class="btn btn-<?php echo ($row['close']=='0') ? 'danger' : 'outline-danger';?> btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="delAddUni(<?php echo $row['italy_add_id'];?>);"><i class="mdi mdi-trash-can"></i></button>
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