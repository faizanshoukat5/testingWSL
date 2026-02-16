<style type="text/css">
	.accordion-item {
		display: block;
	}
	.accordion-item.hidden {
		display: none;
	}
	.no-results {
		display: none;
	}
</style>
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-9">
				<input type="text" name="" class="form-control" required="required" placeholder="Search..." onkeyup="searchMaterial()" id="materialID">
			</div>
			<div class="col-md-3">
				<div class="float-right">
					<button type="button" class="btn btn-warning" data-toggle="modal" data-target=".addUniCGPA"><i class="mdi mdi-plus-circle"></i> Add More FAQs</button>
				</div>
			</div>
			<div class="col-md-12 mt-1">
				<div id="no-results" class="no-results alert alert-danger text-center">
					<b>No results found</b>
				</div>
			</div>
		</div>

		<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="updateModalFAQs" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myLargeModalLabel">Update FAQs</h4>
                    </div>
                    <div class="modal-body updateModalFAQs">

                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

		<!--  Modal content for the above example -->
		<div class="modal fade addUniCGPA" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myLargeModalLabel">Add More FAQs</h4>
					</div>
					<div class="modal-body">
						<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
							<fieldset class="scheduler-border">
								<legend class="scheduler-border">
									FAQs Details <span class="text-danger">*</span>
								</legend>
								<div class="row">
									<div class="form-group col-md-12">
										<label class="form-label">FAQs Title</label>
										<input type="text" name="faqsTitle" class="form-control" required="required">
									</div>
									<div class="form-group col-md-12">
										<label class="form-label">Answer</label>
										<textarea name="faqsAnswer" class="form-control" autocomplete="off" rows="8"></textarea>
									</div>
								</div>
							</fieldset>
							<div class="row">
								<div class="col-md-12">
									<div class="float-right">
										<button class="btn btn-custom" type="submit" name="subFaqs"><i class="mdi mdi-upload"></i> Submit</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!-- model close -->

		<div class="row mt-2">
			<?php
			$sr=1;
			$AddFaq = "SELECT * from italy_faqs_questions WHERE close='1' AND status='1' ";
			$AddFaq_ex = mysqli_query($con, $AddFaq);

			if (mysqli_num_rows($AddFaq_ex) > 0) {
				$counter = 0;
				foreach ($AddFaq_ex as $row) {
					$isFirst = $counter === 0;
					?>
					<div class="col-md-6">
						<div id="accordion" class="mb-3">
							<div class="card mb-0 accordion-item">
								<div class="card-header" id="heading<?php echo $row['italy_faq_id'];?>">
									<h5 class="m-0">
										<a href="#collapse<?php echo $row['italy_faq_id'];?>" class="text-dark" data-toggle="collapse" aria-expanded="<?php echo $isFirst ? 'true' : 'false';?>" aria-controls="collapse<?php echo $row['italy_faq_id'];?>">
											<?php echo $sr;?>) <?php echo $row['italy_faq_title']; ?>
										</a>
									</h5>
								</div>

								<div id="collapse<?php echo $row['italy_faq_id'];?>" class="collapse<?php echo $isFirst ? ' show' : '';?>"  aria-labelledby="heading<?php echo $row['italy_faq_id']; ?>"  data-parent="#accordion">
									<div class="card-body">
										<?php echo $row['italy_faq_answer']; ?>
										<div class="float-right">
											<button type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editFAQs(<?php echo $row['italy_faq_id']; ?>);"><i class="mdi mdi-square-edit-outline"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php 
					$counter++;
					$sr++;
				}
			}
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
	function editFAQs(idfaq) {
		var idfaq = idfaq;
		$.ajax({
			type: "POST",
			url: "models/faqsSectionState.php",
			data: 'faqsEdit=' + idfaq,
			success: function(data) {
				$(".updateModalFAQs").html(data);
				$("#updateModalFAQs").modal('show');
			}
		});
	};

	function searchMaterial() {
		var input, filter, accordions, items, i, txtValue, found;
		input = document.getElementById('materialID');
		filter = input.value.toUpperCase();
		accordions = document.querySelectorAll('.accordion-item');
		found = false;

		for (i = 0; i < accordions.length; i++) {
			txtValue = accordions[i].textContent || accordions[i].innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				accordions[i].classList.remove('hidden');
				found = true;
			} else {
				accordions[i].classList.add('hidden');
			}
		}

		// Show or hide the "no results" message
		if (found) {
			document.getElementById('no-results').style.display = 'none';
		} else {
			document.getElementById('no-results').style.display = 'block';
		}
	}

</script>