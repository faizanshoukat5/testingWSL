<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['faqsEdit'])) {
	$faqsEdit = $_POST['faqsEdit'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $faqsEdit;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				FAQs Details <span class="text-danger">*</span>
			</legend>
			<?php 
			$select_query = "SELECT * from austria_faqs_questions WHERE status='1' AND close='1' AND aus_faq_id='".$faqsEdit."' ";
			$select_query_ex = mysqli_query($con,$select_query);
			foreach ($select_query_ex as $row) {
			?>
			<div class="row">
				<div class="form-group col-md-12">
					<label class="form-label">FAQs Title</label>
					<input type="text" name="faqsTitle" class="form-control" required="required" value="<?php echo $row['aus_faq_title'];?>">
				</div>
				<div class="form-group col-md-12">
					<label class="form-label">Answer</label>
					<textarea name="faqsAnswer" class="form-control" autocomplete="off" rows="8"><?php echo $row['aus_faq_answer'];?></textarea>
				</div>
			</div>
			<?php } ?>
		</fieldset>
		<div class="row">
			<div class="col-md-12">
				<div class="float-right">
					<button class="btn btn-custom" type="submit" name="updFAQs"><i class="mdi mdi-upload"></i> Update</button>
				</div>
			</div>	
		</div>
		<script type="text/javascript">$(".parsley-examples").parsley();</script>
	</form>
<?php }

?>