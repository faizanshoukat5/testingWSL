<?php 
$uniName = $_GET['university-name'];
$clientDegree = $_GET['degree-name'];

if (!isset($_GET['page-number']) || $_GET['page-number']=='undefined') {
	$pageNo=1;
} else {
	$pageNo=$_GET['page-number'];
}
?>
<!-- filter -->
<div class="card">
	<div class="card-body">
		<input type="hidden" name="" value="<?php echo $uniName;?>" id="uniName">
		<input type="hidden" name="" value="<?php echo $clientDegree;?>" id="clientDegree">
		<input type="hidden" name="page-number" value="<?php echo $pageNo;?>" id="page-number">
		<?php
		$clientDegree = $clientDegree;
		include ('components/UniFilter/UniFiltersHtml.php');
		?>
		<div class="row">
			<div class="col-md-5"></div>
			<div class="col-md-2">
				<div class="float-right">
					<?php 
					$uniDetails = "SELECT italy_uni_deadline_link FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_degree='mbbs' AND italy_uni_name='".$uniName."' ";
					$uniDetails_ex = mysqli_query($con, $uniDetails);
					$addRow = mysqli_fetch_assoc($uniDetails_ex);
					if($addRow){
					?>
					<a class="btn btn-purple btn-sm" href="<?php echo $addRow['italy_uni_deadline_link'];?>" target="_blank">Deadline Link</a>
					<?php } ?>
				</div>
			</div>
			<input type="hidden" name="degreeName" value="mbbs" id="degreeName">
			<input type="hidden" name="universityName" value="<?php echo $uniName;?>" id="universityName">
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-6">
						<div class="float-right">
							<button type="button" class="btn btn-custom" onclick="openingClosingDate();"><i class="mdi mdi-plus-circle"></i> Add Opening & Closing Date</button>
						</div>
					</div>
					<div class="col-md-6">
						<div class="float-right">
							<button type="button" class="btn btn-warning" onclick="uniCGPA();"><i class="mdi mdi-plus-circle"></i> Add University CGPA</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="alert alert-primary mt-1">
			<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-7">
							<h5><?php echo $uniName;?></h5>
						</div>
						<?php 
						$selectQuery = "SELECT italy_opening_date, italy_closing_date, italy_note FROM italy_university_dates WHERE status='1' AND close='1' AND italy_university_name ='$uniName' AND italy_degree_name='mbbs' ORDER BY italy_dates_id DESC LIMIT 1";
						$result = mysqli_query($con, $selectQuery);
						$dateRow = mysqli_fetch_assoc($result);
						if ($dateRow) {
							$openingDate = $dateRow['italy_opening_date'];
							$closingDate = $dateRow['italy_closing_date'];
						?>
						<div class="col-md-5">
							<?php if($openingDate!='0000-00-00' && $closingDate!='0000-00-00'){ ?>
							<h5><span data-toggle="tooltip" data-placement="top" title="Opening Date"><?php echo date('d-m-Y', strtotime($openingDate)); ?></span> / <span data-toggle="tooltip" data-placement="top" title="Closing Date"><?php echo date('d-m-Y', strtotime($closingDate)); ?></span></h5>
							<?php } ?>
						</div>
						<?php 
						}else{
						?>
						<div class="col-md-5"></div>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="float-left">
						<?php 
						$selectQuery = "SELECT italy_uni_cgpa FROM italy_university_cgpa WHERE status='1' AND close='1' AND italy_cgpa_uni_name ='$uniName' AND italy_cgpa_uni_degree='mbbs' ORDER BY italy_cgpa_uni_id DESC LIMIT 1";
						$result = mysqli_query($con, $selectQuery);
						$uniRow = mysqli_fetch_assoc($result);
						if($uniRow){
						$uniCGPA = $uniRow['italy_uni_cgpa'];
						?>
						<h5>Uni CGPA: <span data-toggle="tooltip" data-placement="top" title="University CGPA"><?php echo $uniCGPA;?></span></h5>
						<?php } ?>
					</div>
					<div class="float-left ml-3">
						<!-- <h5>Round:
						<?php 
						if($addRow){
							echo $addRow['italy_uni_round'];
						}?>
						</h5> -->
					</div>
					<?php if($dateRow['italy_note']!=''){ ?>
					<div class="float-right">
						<span id="blink" class="text-danger"><b>Note:</b></span> <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".addUniNote"><i class="mdi mdi-eye"></i></button>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<!--  Modal content for the above example -->
		<div class="modal fade addUniNote" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">University Opening & Closing Note</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12 text-left">
								<?php echo $dateRow['italy_note'];?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- Model Close -->
		<!-- Track client Modal -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="viewModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Track Client</h4>
					</div>
					<div class="modal-body viewModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Add Note -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Add Note -->
		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient1" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title showModalTitle1" id="myLargeModalLabel"></h4>
					</div>
					<div class="modal-body showModalClient1">

					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- search input & select option & loader -->
		<?php include ("components/SearchSelectOption.php"); ?>

	</div>
</div>
<!-- script file include using php -->
<?php
$ajaxUrl = "models/viewMasterClientsModel.php";
include ('components/UniFilter/UniFiltersFunction.php');
?>
<?php 
include ("js-helpers/allClients.php");
?>