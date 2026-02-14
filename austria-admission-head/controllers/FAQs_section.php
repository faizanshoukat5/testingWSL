<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

if(isset($_POST['subFaqs'])) {
	$faqsTitle = $_POST['faqsTitle'] ?? '';
	$faqsAnswer = $_POST['faqsAnswer'] ?? '';

	$sqlFaq = "INSERT INTO `austria_faqs_questions` (aus_faq_title, aus_faq_answer, close, status, entry_by) VALUES (?, ?, '1', '1', ?)";
	$stmtFaq = mysqli_prepare($con, $sqlFaq);
	if ($stmtFaq) {
		$entryBy = (int)($_SESSION['user_id'] ?? 0);
		mysqli_stmt_bind_param($stmtFaq, 'ssi', $faqsTitle, $faqsAnswer, $entryBy);
		$addFAQ_ex = mysqli_stmt_execute($stmtFaq);
		mysqli_stmt_close($stmtFaq);
	} else {
		$addFAQ_ex = false;
	}

	if($addFAQ_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Added!', text: 'Your FAQs is Added Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

if(isset($_POST['updFAQs'])) {
	$updateID = (int)($_POST['updateID'] ?? 0);
	$faqsTitle = $_POST['faqsTitle'] ?? '';
	$faqsAnswer = $_POST['faqsAnswer'] ?? '';

	$sqlUpd = "UPDATE austria_faqs_questions SET aus_faq_title = ?, aus_faq_answer = ? WHERE aus_faq_id = ?";
	$stmtUpd = mysqli_prepare($con, $sqlUpd);
	if ($stmtUpd) {
		mysqli_stmt_bind_param($stmtUpd, 'ssi', $faqsTitle, $faqsAnswer, $updateID);
		$addFAQ_ex = mysqli_stmt_execute($stmtUpd);
		mysqli_stmt_close($stmtUpd);
	} else {
		$addFAQ_ex = false;
	}

	if($addFAQ_ex){
		echo "<script>document.addEventListener('DOMContentLoaded', function() { Swal.fire({ title: 'Update!', text: 'Your FAQs is Update Successfully.', icon: 'success' }).then((result) => { if (window.history.replaceState) { window.history.replaceState(null, null, window.location.href); } }); });</script>";
	}
	else{
		echo "<div class='alert alert-success'>
		<strong>There is an error in the query!
		</div>";
	}
}

?>