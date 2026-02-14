<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});
	function debounce(func, delay) {
		let timer;
		return function(...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}
	const debouncedViewClientsFilter = debounce(viewClientsFilter, 500);
	function viewClientsFilter(page) {
		var uniName = $("#uniName").val();
		var clientDegree = $("#clientDegree").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var intakeYear = $("#intake-year").val();
		var assignPrograms = $("#assign-programs").val();
		var deadlineStatus = $("#deadline-status").val();
		var sopStatus = $("#sop-status").val();
		var callStatus = $("#call-status").val();
		var admissionDue = $("#admission-due").val();
		var assignDate = $("#assign-date").val();
		var cvStatus = $("#cv-status").val();
		var applicationStatus = $("#check-application").val();
		var assignTo = $("#assign-to").val();

		if (callStatus.includes(" - ")) {
			var dates = callStatus.split(" - ");
			var startDate = dates[0].trim();
			var endDate = dates[1].trim();
		}else{
			var startDate='all';
			var endDate='all';
		}

		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();

		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (convertStatus!=='all') {
			params.set('client-convert-status', convertStatus);
		}else{
			params.delete('client-convert-status');
		}
		if (clientCountry!=='all') {
			params.set('client-country', clientCountry);
		}else{
			params.delete('client-country');
		}
		if (intakeYear!=='all') {
			params.set('intake-year', intakeYear);
		}else{
			params.delete('intake-year');
		}
		if (assignPrograms!=='all') {
			params.set('assign-programs', assignPrograms);
		}else{
			params.delete('assign-programs');
		}
		if (deadlineStatus!=='all') {
			params.set('deadline-status', deadlineStatus);
		}else{
			params.delete('deadline-status');
		}
		if (sopStatus!=='all') {
			params.set('sop-status', sopStatus);
		}else{
			params.delete('sop-status');
		}
		if (callStatus!=='all') {
			params.set('call-status', callStatus);
		}else{
			params.delete('call-status');
		}
		if (admissionDue!=='all') {
			params.set('admission-due', admissionDue);
		}else{
			params.delete('admission-due');
		}
		if (assignDate) {
			params.set('assign-date', assignDate);
		}else{
			params.delete('assign-date');
		}
		if (cvStatus!=='all') {
			params.set('cv-status', cvStatus);
		}else{
			params.delete('cv-status');
		}
		if (applicationStatus!=='all') {
			params.set('check-application', applicationStatus);
		}else{
			params.delete('check-application');
		}
		if (assignTo!=='all') {
			params.set('assign-to', assignTo);
		}else{
			params.delete('assign-to');
		}
		if (pageNo == 1) {
			params.delete('page-number', pageNo);
		} else {
			params.set('page-number', pageNo);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else{
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModel").hide();
		// Perform the AJAX request

		$.ajax({
			type: "POST",
			url: "<?= $ajaxUrl ?>",
			data: {
				checkuniName: uniName,
				checkclientDegree: clientDegree,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkintakeYear: intakeYear,
				checkassignPrograms: assignPrograms,
				checkdeadlineStatus: deadlineStatus,
				checksopStatus: sopStatus,
				checkstartDate: startDate,
				checkendDate: endDate,
				checkadmissionDue: admissionDue,
				checkassignDate: assignDate,
				checkcvStatus: cvStatus,
				checkapplicationStatus: applicationStatus,
				checkassignTo: assignTo,
				pageNumber: pageNo,
				checkclientDetails: clientIDGet,
				checkselectPage: selectPage,
			},
			success: function(data) {
				// alert(data);
				$("#loader").hide();
				$("#showClientsModel").html(data);
				$("#showClientsModel").show();
			}
		});
	}

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
				url: "models/_applyProgramsControllersState.php",
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
	function addProgramNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'checkProgramNote='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
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
	// Add note to Admission Head for University Process
	function addNoteAdmissionhead(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data:'noteForAdmissionHead='+id,
			success: function(data){
				$(".showModalTitle").html('Add Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// opening closing date of universities
	function openingClosingDate() {
		var degreeName = $("#degreeName").val();
		var universityName = $("#universityName").val();
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data: {
				checkdegreeName: degreeName,
				checkuniversityName: universityName,
			},
			success: function(data){
				$(".showModalTitle").html('Add Opening & Closing Date');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	function updUniDateHidden(checkbox, hiddenId) {
		document.getElementById(hiddenId).value = checkbox.checked ? 1 : 0;
	}
	// universities CGPA
	function uniCGPA() {
		var degreeName = $("#degreeName").val();
		var universityName = $("#universityName").val();
		$.ajax({
			type: "POST",
			url: "models/applicationNoteState.php",
			data: {
				cgpadegreeName: degreeName,
				cgpauniversityName: universityName,
			},
			success: function(data){
				$(".showModalTitle").html('Add Opening & Closing Date');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
</script>
<script type="text/javascript">
	function openingYesDate() {
		var yesIDDate =	$('#yesIDDate').val();
		if (yesIDDate == 1) {
			document.getElementById("showOpeningDate").style.display = "block";
			document.getElementById("showClosingDate").style.display = "block";
			// Setting the required attribute using vanilla JS
			document.querySelector("#showOpeningDate input").setAttribute('required', true);
			document.querySelector("#showOpeningDate input").style.borderBottom = '2px solid #e33244';

			document.querySelector("#showClosingDate input").setAttribute('required', true);
			document.querySelector("#showClosingDate input").style.borderBottom = '2px solid #e33244';
		} else {
			document.getElementById("showOpeningDate").style.display = "none";
			document.getElementById("showClosingDate").style.display = "none";
			// Removing the required attribute
			document.querySelector("#showOpeningDate input").removeAttribute('required');
			document.querySelector("#showClosingDate input").removeAttribute('required');
		}
	}

	function openingNoDate() {
		var noIDDate =	$('#noIDDate').val();
		if (noIDDate==2) {
			document.getElementById("showOpeningDate").style.display = "none";
			document.getElementById("showClosingDate").style.display = "none";
			document.querySelector("#showOpeningDate input").removeAttribute('required');
			document.querySelector("#showClosingDate input").removeAttribute('required');
		}else{
			document.getElementById("showOpeningDate").style.display = "block";
			document.getElementById("showClosingDate").style.display = "block";
			document.querySelector("#showOpeningDate input").setAttribute('required', true);
			document.querySelector("#showOpeningDate input").style.borderBottom = '2px solid #e33244';
			document.querySelector("#showClosingDate input").setAttribute('required', true);
			document.querySelector("#showClosingDate input").style.borderBottom = '2px solid #e33244';
		}
	}
</script>