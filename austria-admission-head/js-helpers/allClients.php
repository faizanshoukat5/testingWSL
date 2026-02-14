<script type="text/javascript">
	document.addEventListener("contextmenu", function (e) {
		if (e.target.tagName === "BUTTON" && e.target.disabled) {
			e.preventDefault();
		}
	});
	document.addEventListener('auxclick', function(e) {
		if (e.button === 1) {
			e.preventDefault();
			e.stopPropagation();
		}
	});

	// Application accepted or Rejection
	function saveDataForm(formID, proBtn) {
		let $form = $("#"+formID);
		let $btn = $("#"+proBtn);
		if ($form.parsley().validate()) {
			// CKEditor ka data update karne ka step
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
			$btn.prop("disabled", true).text("Submitting...");
			let formData = new FormData($form[0]);
			formData.append(proBtn, 1);
			$.ajax({
				url: "models/_allClientsControllersState.php",
				type: "POST",
				data: formData,
				processData: false,
				contentType: false,
				success: function (response) {
					Swal.fire({
						title: "Uploaded",
						text: 'Record Uploaded successfully',
						icon: "success"
					}).then(() => {
						location.reload();
					});
				},
				error: function (xhr, status, error) {
					Swal.fire({
						title: "Error!",
						text: "Something went wrong: " + error,
						icon: "error"
					});
					$btn.prop("disabled", false).text("Submit");
				}
			});
		} else {
			Swal.fire({
				title: "Validation Error",
				text: "Please fill all required fields before submitting.",
				icon: "warning"
			});
		}
	}

	// Add note to Admission head
	function docAdmissionNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'checkAdmissionNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	function personalNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'checkPersonalNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	function dueAfterAcceptance(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'afterAcceptanceDue='+id,
			success: function(data){
				$(".showModalTitle").html('Due After Verification');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');

				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});

			}
		});
	};
	function delInfoAd(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"getState.php",
			data: {
				infoAdDel:id,
			},
			success:function(data) {
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				).then(() => {
					window.location.reload();
				});
			}
		});
	};

	// Dues After Visa
	function dueAfterVisa(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'afterVisaDue='+id,
			success: function(data){
				$(".showModalTitle1").html('Due After Visa');
				$(".showModalClient1").html(data);
				$("#showModalClient1").modal('show');

				$('#showModalClient1').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});

			}
		});
	};

	function selfAcceptance(id) {
		var id = id;
		var appliedDegree = $("#appliedDegree").val();
		$.ajax({
			type: "POST",
			url: "getState.php",
			data: {
				uploadAcceptance:id,
				appliedDegree:appliedDegree,
			},
			success: function(data){
				$(".showModalTitle").html('Self Received Acceptance');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').off('shown.bs.modal').on('shown.bs.modal', function () {
					document.querySelectorAll('.agreement-container').forEach(function(agreementContainer) {
						const agreementId = agreementContainer.getAttribute('data-agreement-id');
						const preview = agreementContainer.querySelector('.preview');
						preview.id = `preview${agreementId}`;
						const pasteInput = agreementContainer.querySelector('.pasteInput');
						pasteInput.id = `pasteInput${agreementId}`;
						const fileInput = agreementContainer.querySelector('.fileInput');
						fileInput.id = `fileInput${agreementId}`;
						const hiddenFileInput = agreementContainer.querySelector('input[type="file"]#uploadedFiles' + agreementId);
						hiddenFileInput.id = `uploadedFiles${agreementId}`;
						initializeAgreement(agreementId);
					});
				});
			}
		});
	};
	function showDueStatus() {
		var dueStatus = $("#duesStatus").val();
		if (dueStatus == 'Client Pays Half Payment') {
			$("#showDueRemain").css("display", "block");
			$("#showDueRemain input").prop("required", true);
			$("#showDueRemain input").css('border-bottom', '2px solid #e33244');
			$("#showDueDate").css("display", "block");
			$("#showDueDate input").prop("required", true);
			$("#showDueDate input").css('border-bottom', '2px solid #e33244');
		} else {
			$("#showDueRemain").css("display", "none");
			$("#showDueRemain input").prop("required", false);
			$("#showDueDate").css("display", "none");
			$("#showDueDate input").prop("required",false);
		}
	}
	// change intake year
	function changeIntakeYear(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "getState.php",
			data:'intakeYearChange='+id,
			success: function(data){
				$(".showModalTitle").html('Change Intake Year');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>