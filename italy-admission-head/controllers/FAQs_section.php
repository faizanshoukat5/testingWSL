<?php 

if(isset($_POST['subFaqs'])) {
	$faqsTitle = mysqli_real_escape_string($con, $_POST['faqsTitle']);
	$faqsAnswer = mysqli_real_escape_string($con, $_POST['faqsAnswer']);

	$addFAQ = "INSERT INTO `italy_faqs_questions` (`italy_faq_title`, `italy_faq_answer`, `close`, `status`, `entry_by`) VALUES ('".$faqsTitle."', '".$faqsAnswer."', '1', '1', '".$_SESSION['user_id']."')";
	$addFAQ_ex = mysqli_query($con,$addFAQ);

	if($addFAQ_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Added!',
				text: 'Your FAQs is Added Successfully.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

if(isset($_POST['updFAQs'])) {
	$updateID = mysqli_real_escape_string($con, $_POST['updateID']);
	$faqsTitle = mysqli_real_escape_string($con, $_POST['faqsTitle']);
	$faqsAnswer = mysqli_real_escape_string($con, $_POST['faqsAnswer']);

	$addFAQ = "UPDATE italy_faqs_questions SET italy_faq_title='".$faqsTitle."', italy_faq_answer='".$faqsAnswer."' WHERE italy_faq_id='".$updateID."'";
	$addFAQ_ex = mysqli_query($con,$addFAQ);

	if($addFAQ_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Update!',
				text: 'Your FAQs is Update Successfully.',
				icon: 'success'
				}).then((result) => {
					if (window.history.replaceState) {
						window.history.replaceState(null, null, window.location.href);
					}
				});
			});
		</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

?>