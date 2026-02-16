<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// delete steps from visa Process
if (isset($_POST['imatID'])) {
	$imatID = $_POST['imatID'];
	$delQuery = "UPDATE italy_clients_imat".$_SESSION['dbNo']." SET close='0' WHERE imat_id='".$imatID."'";
	$delQuery_ex = mysqli_query($con,$delQuery);
}

// View Inform About IMAT
if (isset($_POST['checkInfoIMAT'])) {
	$clientID = $_POST['checkInfoIMAT'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Inform IMAT <span class="text-danger">*</span>
			</legend>
			<div class="row">
				<div class="col-md-12">
					<h4>Link: <a href="https://www.universitaly.it/">https://www.universitaly.it/</a></h4>
				</div>
				<div class="col-md-12">
					<div class="row">
						<?php
						$audioFiles = [
							"IMAT Registration part 01.ogg",
							"IMAT Registration part 02.ogg",
							"IMAT Registration part 03.ogg",
							"IMAT Registration part 04.ogg",
							"IMAT Registration part 05.ogg"
						];
						$sr=1;
						foreach ($audioFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
							<audio controls preload="auto">
								<source src="https://crm.wslcms.com/italy-videos/imat-voice-note/<?php echo $file;?>" type="audio/ogg">
								Your browser does not support the audio element.
							</audio>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="col-md-12">
					<h4><b><mark>IMAT Past Papers</mark></b></h4>
				</div>
				<div class="col-md-12">
					<div class="row">
						<?php
						$pdfFiles = [
							"IMAT Main Guidance.pdf",
							"2021-AcadIMAT-Shuffled-Answers.pdf",
							"2022-AcadIMAT-Shuffled-Answers.pdf",
							"2022-IMAT-Exam.pdf",
							"2023_AcadIMAT_Shuffled_Answers.pdf",
							"2023-IMAT-Exam.pdf",
							"311133-imat-2015-paper-.pdf",
							"370030-imat-2016-paper.pdf",
							"462135-imat-past-paper-2017.pdf",
							"539381-imat-past-paper-2018.pdf",
							"580262-imat-past-paper-2019.pdf",
							"CompitoInglese2023.pdf",
							"IMAT Test paper 2025.pdf",
							"IMAT-2014.pdf",
							"IMAT-2021-Past-Paper-PDF-A-Form.pdf",
							"IMAT-2022-Past-Paper-PDF-A-Form.pdf",
							"IMAT-past-paper-2011.pdf",
							"IMAT-past-paper-2012.pdf",
							"IMAT-past-paper-2013.pdf",
							"imat-past-paper-2020.pdf"
						];
						$sr=1;
						foreach ($pdfFiles as $file) { ?>
						<div class="form-group col-md-4">
							<label><?php echo $sr;?>:) <?php echo $file;?> <span class="text-danger">Click to Download</span></label> <br>
							<a href="https://crm.wslcms.com/italy-videos/imat-past-papers/<?php echo $file;?>" target="_blank"><?php echo $file;?> </a>
						</div>
						<?php 
						$sr++;}
						?>
					</div>
				</div>
				<div class="col-md-6">
					<h3>IMAT Registration</h3>
					<!-- Embed the YouTube video -->
					<iframe width="350" height="250" src="https://www.youtube.com/embed/Da0WOwmOWMc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen> </iframe>
				</div>
			</div>
		</fieldset>
	</form>
<?php
}

?>