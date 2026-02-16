<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['checkUniName'])) {
	$checkUniName = $_POST['checkUniName'];
	$checkUniDegree = $_POST['checkUniDegree'];
	?>
	<fieldset class="scheduler-border">
		<legend class="scheduler-border">
			Info & Requirement <span class="text-danger">*</span>
		</legend>
		<?php
		$uniDetails = "SELECT italy_uni_req_note FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_name='".$checkUniName."' AND italy_uni_degree='".$checkUniDegree."' ";
		$uniDetails_ex = mysqli_query($con, $uniDetails);
		while ($addRow = mysqli_fetch_assoc($uniDetails_ex)) {
		?>
		<div class="row">
			<div class="col-md-12">
				<?php echo $addRow['italy_uni_req_note'];?>
			</div>
		</div>
		<?php } ?>
	</fieldset>

<?php
}
?>