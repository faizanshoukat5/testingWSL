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
		
	$whereCondition = " cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='italy' AND cl.client_intake_year='27-28' ";
	?>
	<?php include ("../components/AllQueries.php"); ?>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 220px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 100px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 220px;">Admission Status</th>
					<th style="width: 100px;">Track</th>
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
				$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				?>
				<?php include ("../components/PIAQueries.php");?>
				<tr id="<?php echo $row['client_id'];?>">
					<td><?php echo $sr;?></td>
					<td>
						<?php include ("../components/IDDateTd.php");?>
					</td>
					<td class="breakTD">
						<b><?php echo ucwords($row['client_name']);?> </b> <br><a href="https://web.whatsapp.com/send?phone=+<?php echo $row['client_whatapp'];?>" target="_blank"><?php echo $row['client_whatapp']; ?></a> <br><?php echo $row['client_email'];?>
						<br>
						<?php if ($row['client_convert_status']=='New Client') {
							echo "<b class='text-success'>New Client</b>";
						}elseif ($row['client_convert_status']=='Old Client') {
							echo "<b class='text-info'>Old Client</b>";
						}elseif($row['client_convert_status']=='Old Converted Client'){
							echo "<b class='text-warning'>Old Converted Client</b>";
						}elseif ($row['client_convert_status']=='Italy Old Client 2024') {
							echo "<b class='text-info'>Italy Old Client 2024</b>";
						}elseif($row['client_convert_status']=='Austria Converted Client'){
							echo "<b class='text-warning'>Austria Converted Client</b>";
						} ?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<input type="hidden" name="" value="<?php echo $appRow;?>" id="appliedDegree">
					<td>
						<?php include ("../components/PIATd.php");?>
					</td>
					<td class="breakTD">
						<?php 
						$query = "SELECT note_admission, head_personal_note FROM client_addmission_doc".$_SESSION['dbNo']." WHERE status='0' AND close='0' AND admission_client_id='".$row['client_id']."' ";
						$docRow = mysqli_fetch_assoc(mysqli_query($con, $query));
						$buttonAdClass = $docRow['note_admission'] != '' ? 'btn-success' : 'btn-outline-primary';
						$buttonPersonalClass = $docRow['head_personal_note'] != '' ? 'btn-success' : 'btn-outline-dark';
						?>
						<button type="button" class="btn <?php echo $buttonAdClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Document Collection Report" onclick="docAdmissionNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-n-circle"></i> </button>
						<button type="button" class="btn <?php echo $buttonPersonalClass; ?> btn-sm" data-toggle="tooltip" data-placement="top" title="Add Your Personal Note" onclick="personalNote(<?php echo $row['client_id'];?>);"> <i class="mdi mdi-alpha-p-box"></i> </button>
					<td>
						<?php include ("../components/ViewActionTd.php");?>
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