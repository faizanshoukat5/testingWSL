<script type="text/javascript">
	function withDrawClients(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/clientCaseState.php",
			data:'caseWithDraw='+id,
			success: function(data){
				$(".showModalTitle").html('Case With Draw');
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
	function changeCountryClients(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/clientCaseState.php",
			data:'caseChangeCountry='+id,
			success: function(data){
				$(".showModalTitle").html('Change Country');
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
	// Add client cgpa
	function addClientCGPA(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/clientCaseState.php",
			data:'clientCGPA='+id,
			success: function(data){
				$(".showModalTitle").html('Add CGPA / Percentage');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Update Client Embassy
	function updEmbassyClient(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/clientCaseState.php",
			data:'clientEmbassy='+id,
			success: function(data){
				$(".showModalTitle").html('Update Embassy');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	function checkEmbassy() {
		var embassyName = $('#embassyName').val();
		if(embassyName=='Other Embassy'){
			document.getElementById("showOtherEmbassy").style.display = "block";
			$("#showOtherEmbassy input").prop('required', true);
			$("#showOtherEmbassy input").css('border-bottom', '2px solid #e33244');
		}else{
			document.getElementById("showOtherEmbassy").style.display = "none";
			$("#showOtherEmbassy input").prop('required', false);
		}
	}

	function editClient(idclient) {
		var idclient = idclient;
		$.ajax({
			type: "POST",
			url: "models/clientEditModal.php",
			data:'clientEdit='+idclient,
			success: function(data){
				$(".showModalTitle").html('Update Client');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Add payment function
	function addPaymentClients(idclient) {
		var idclient = idclient;
		// alert(idclient);
		$.ajax({
			type: "POST",
			url: "models/clientPaymentState.php",
			data:'addClientPayment='+idclient,
			success: function(data){
				$(".showModalTitle").html('Add Client Payment');
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
	// Add note to document collection 
	function docNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/docNoteState.php",
			data:'addNoteDocument='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Add note to document collection 
	function docReport(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/docNoteState.php",
			data:'checkReportNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Add note to Admission head
	function docAdmissionNote(id) {
		var id = id;
		$.ajax({
			type: "POST",
			url: "models/docNoteState.php",
			data:'checkAdmissionNote='+id,
			success: function(data){
				$(".showModalTitle").html('Note');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//del note 
	function delNote(id) {
		var id = id;
		$.ajax({
			type:"POST",
			url:"models/docNoteState.php",
			data: 'delNoteDocument='+id,
			success:function(data) {
				var rowh = "#"+id;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};
	
	// function due after visa
	function dueAfterVisa(idvisa) {
		var idvisa = idvisa;
		// alert(idvisa);
		$.ajax({
			type: "POST",
			url: "models/dueAfterState.php",
			data:'clientDueVisa='+idvisa,
			success: function(data){
				// alert(data);
				$(".showModalTitle").html('Due After Visa');
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
	// track function of client in footer

	// checklist upload from the clients
	function addChecklist(idlist) {
		var idlist = idlist;
		// alert(idlist);
		$.ajax({
			type: "POST",
			url: "models/checklistState.php",
			data:'clientChecklist='+idlist,
			success: function(data){
				// alert(data);
				$(".showModalTitle").html('Upload Check List');
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
	// Austria Check list exist
	function austriaChecklistName() {
		var austrialistName = $("#austrialistName").val();
		var clientID = $("#clientID").val();
		$.ajax({
			type: "POST",
			url: "models/checklistState.php",
			data:{
				checkaustrialistName:austrialistName,
				checkClientID:clientID,
			},
			success: function(data){
				if (data.trim() == ""){
					$('#submit').attr('disabled', false);
					$('#already-msg').empty();
				}
				else{
					$('#submit').attr('disabled', true);
					$('#already-msg').html("<div class='alert alert-danger' style = 'text-align : center;'>This <strong>Check List Name</strong> is already added!</div>");
				}
			}
		});
	};
	//del austria check list
	function delAustrialist(idlist) {
		var idlist = idlist;
		$.ajax({
			type:"POST",
			url:"models/checklistState.php",
			data: 'checklistAustriaDel='+idlist,
			success:function(data) {
				var rowh = "#"+idlist;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};
	// italy Check list exist
	function italyChecklistName() {
		var italylistName = $("#italylistName").val();
		var clientID = $("#clientID").val();
		$.ajax({
			type: "POST",
			url: "models/checklistState.php",
			data:{
				checkitalylistName:italylistName,
				checkClientID:clientID,
			},
			success: function(data){
				if (data.trim() == ""){
					$('#submit').attr('disabled', false);
					$('#already-msg').empty();
				}
				else{
					$('#submit').attr('disabled', true);
					$('#already-msg').html("<div class='alert alert-danger' style = 'text-align : center;'>This <strong>Check List Name</strong> is already added!</div>");
				}
			}
		});
	};
	
	//del italy check list
	function delItalylist(idlist) {
		var idlist = idlist;
		$.ajax({
			type:"POST",
			url:"models/checklistState.php",
			data: 'checklistItalyDel='+idlist,
			success:function(data) {
				var rowh = "#"+idlist;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};

	// czech Check list exist
	function czechChecklistName() {
		var czechlistName = $("#czechlistName").val();
		var clientID = $("#clientID").val();
		$.ajax({
			type: "POST",
			url: "models/checklistState.php",
			data:{
				checkczechlistName:czechlistName,
				checkClientID:clientID,
			},
			success: function(data){
				if (data.trim() == ""){
					$('#submit').attr('disabled', false);
					$('#already-msg').empty();
				}
				else{
					$('#submit').attr('disabled', true);
					$('#already-msg').html("<div class='alert alert-danger' style = 'text-align : center;'>This <strong>Check List Name</strong> is already added!</div>");
				}
			}
		});
	};
	
	//del Czech check list
	function delCzechlist(idlist) {
		var idlist = idlist;
		$.ajax({
			type:"POST",
			url:"models/checklistState.php",
			data: 'checklistCzechDel='+idlist,
			success:function(data) {
				var rowh = "#"+idlist;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};

	function editAustiraProName(getVal, getId){
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:{
				proAustriaName: getVal,
				proAustriaID: getId,
			},
			success: function(data) {
				Swal.fire({
					title: 'Changed!',
					text: 'Program Name Change Successfully',
					icon: 'success'
				});
			}
		});
	}
	// Update program name
	function editItalyProName(getVal, getId){
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:{
				proItalyName: getVal,
				proItalyID: getId,
			},
			success: function(data) {
				Swal.fire({
					title: 'Changed!',
					text: 'Program Name Change Successfully',
					icon: 'success'
				});
			}
		});
	}
	// Update program name
	function editCzechProName(getVal, getId){
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:{
				proCzechName: getVal,
				proCzechID: getId,
			},
			success: function(data) {
				Swal.fire({
					title: 'Changed!',
					text: 'Program Name Change Successfully',
					icon: 'success'
				});
			}
		});
	}
	//del program client
	function delAustriaProgram(idpro) {
		var idpro = idpro;
		$.ajax({
			type:"POST",
			url:"models/clientProgramState.php",
			data: 'austiraProgramDel='+idpro,
			success:function(data) {
				// var rowh = "#"+idpro;
				// $(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				);setTimeout(function () {
					window.location.reload();
				}, 2000);
			}
		});
	};
	// check Austria University
	function checkAustriaUniversity(idUni) {
		var idUni = idUni;
		// alert(idUni);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:'checkAustriaUniProgram='+idUni,
			success: function(data){
				// $(".showModalTitle").html('Check University Documents');
				$(".checkUniModalClient").html(data);
				$("#checkUniModalClient").modal('show');
			}
		});
	};

	//del program client
	function delItalyProgram(idpro) {
		var idpro = idpro;
		$.ajax({
			type:"POST",
			url:"models/clientProgramState.php",
			data: 'italyProgramDel='+idpro,
			success:function(data) {
				// var rowh = "#"+idpro;
				// $(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				);setTimeout(function () {
					window.location.reload();
				}, 2000);
			}
		});
	};
	// check Italy University
	function checkItalyUniversity(idUni) {
		var idUni = idUni;
		// alert(idUni);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:'checkItalyUniProgram='+idUni,
			success: function(data){
				// $(".showModalTitle").html('Check University Documents');
				$(".checkUniModalClient").html(data);
				$("#checkUniModalClient").modal('show');
			}
		});
	};
	// check Italy MBBS University
	function checkItalyUniversityMBBS(idUni) {
		var idUni = idUni;
		// alert(idUni);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:'checkItalyMBBSUniProgram='+idUni,
			success: function(data){
				// $(".showModalTitle").html('Check University Documents');
				$(".checkUniModalClient").html(data);
				$("#checkUniModalClient").modal('show');
			}
		});
	};

	

	// Add program function
	function programClients(idclient) {
		var idclient = idclient;
		// alert(idclient);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:'clientProgram='+idclient,
			success: function(data){
				$(".showModalTitle").html('Add Program');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	// Austria Add program function
	function delRow(id) {
		$("#row"+id+"").remove();
	};
	var a = 1;
	function austriaProgram() {
		var appliedName = $("#appliedNameID").val();
		// alert(appliedName);
		var options = "";
		if (appliedName == 'master') {
			options += "<option value='University of Innsbruck (IB-01)'>University of Innsbruck (IB-01)</option>";
			options += "<option value='Alpen Adria University Klagenfurt (AAU) (KG-02)'>Alpen Adria University Klagenfurt (AAU) (KG-02)</option>";
			options += "<option value='Carinthia University of Applied Sciences (FH Kärnten) (FHK-03)'> Carinthia University of Applied Sciences (FH Kärnten) (FHK-03)</option>";
			options += "<option value='Johannes Kepler University (JKU) (J-04)'>Johannes Kepler University (JKU) (J-04)</option>";
			options += "<option value='Vienna University of Technology (TU Vienna) (VT-05)'>Vienna University of Technology (TU Vienna) (VT-05)</option>";
			options += "<option value='FH Wiener Neustadt (FHW-06)'>FH Wiener Neustadt (FHW-06)</option>";
			options += "<option value='FH Salzburg (FHS-07)'>FH Salzburg (FHS-07)</option>";
			options += "<option value='University of Graz (UGZ-08)'>University of Graz (UGZ-08)</option>";
			options += "<option value='University of Vienna (UV-09)'>University of Vienna (UV-09)</option>";
			options += "<option value='University of Leoben (LB-10)'>University of Leoben (LB-10)</option>";
			options += "<option value='St. Pölten University of Applied Sciences (STP-11)'>St. Pölten University of Applied Sciences (STP-11)</option>";
			options += "<option value='Paris Lodran University of Salzburg (US-12)'>Paris Lodran University of Salzburg (US-12)</option>";
			options += "<option value='BFI Vienna University of Applied Sciences (BFI-13)'>BFI Vienna University of Applied Sciences (BFI-13)</option>";
			options += "<option value='Graz University of Technology (TU Graz) (TGZ-14)'>Graz University of Technology (TU Graz) (TGZ-14)</option>";
			options += "<option value='Vienna University of Economics & Business (VEB-15)'>Vienna University of Economics & Business (VEB-15)</option>";
			options += "<option value='FH Applied Sciences Upper Austria (FHU-16)'>FH Applied Sciences Upper Austria (FHU-16)</option>";
			options += "<option value='BOKU University (BK-17)'>BOKU University (BK-17)</option>";
		} else if (appliedName == 'bachelor') {
			options += "<option value='Alpen Adria University Klagenfurt (AAU) (KG-02)'>Alpen Adria University Klagenfurt (AAU) (KG-02)</option>";
			options += "<option value='Carinthia University of Applied Sciences (FH Kärnten) (FHK-03)'> Carinthia University of Applied Sciences (FH Kärnten) (FHK-03)</option>";
			options += "<option value='Johannes Kepler University (JKU) (J-04)'>Johannes Kepler University (JKU) (J-04)</option>";
			options += "<option value='FH Wiener Neustadt (FHW-06)'>FH Wiener Neustadt (FHW-06)</option>";
			options += "<option value='FH Salzburg (FHS-07)'>FH Salzburg (FHS-07)</option>";
			options += "<option value='University of Leoben (LB-10)'>University of Leoben (LB-10)</option>";
			options += "<option value='St. Pölten University of Applied Sciences (STP-11)'>St. Pölten University of Applied Sciences (STP-11)</option>";
			options += "<option value='BFI Vienna University of Applied Sciences (BFI-13)'>BFI Vienna University of Applied Sciences (BFI-13)</option>";
			options += "<option value='Vienna University of Economics & Business (VEB-15)'>Vienna University of Economics & Business (VEB-15)</option>";
			options += "<option value='FH Applied Sciences Upper Austria (FHU-16)'>FH Applied Sciences Upper Austria (FHU-16)</option>";
		}
		

		var row = "<tr id='row" + a + "'> <td> <div class='form-group col-md-12'> <select class='form-control' data-toggle='select2' name='uniName[]' autocomplete='off' required='required' onchange='checkOtherAusUni("+a+")' id='uniOtherAusName"+a+"'> <option selected value disabled class='text-center'>--- Select University ---</option>" + options + "</select> </div> <div class='form-group col-md-12' style='display: none;' id='showOtherAusUni"+a+"'> <input type='text' name='otherUniAusName[]' class='form-control' autocomplete='off' placeholder='Enter Other University'> </div></td> <td> <div class='col-md-12'> <input type='text' name='programName[]' class='form-control' required='required' autocomplete='off' placeholder='Enter Program'> </div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeName[]' class='form-control' autocomplete='off' placeholder='Enter intake'> </div> </td> <td> <button class='btn btn-outline-danger' type='button' onclick='delRow(" + a + ");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>";

		$("#showAustria").append(row);
		$('[data-toggle="select2"]').select2();
		a++;
	}
	// Czech Add program function
	function delRow(id) {
		$("#row"+id+"").remove();
	};
	var c = 1;
	function czechProgram() {
		var appliedName = $("#appliedNameID").val();
		// alert(appliedName);
		var options = "";
		options += "<option value='University of South Bohemia (Public) (USB)'>University of South Bohemia (Public) (USB)</option>";
		options += "<option value='University of Life Science Prague (Public) (LSP)'>University of Life Science Prague (Public) (LSP)</option>";
		options += "<option value='Tomas Bata University Zlin (Public) (TBU)'> Tomas Bata University Zlin (Public) (TBU)</option>";
		options += "<option value='Brno University of Technology (Public) (BUT)'>Brno University of Technology (Public) (BUT)</option>";
		options += "<option value='Silesian University in Opava (Public) (SUO)'>Silesian University in Opava (Public) (SUO)</option>";
		options += "<option value='Masaryk University (Public) (MS)'>Masaryk University (Public) (MS)</option>";
		options += "<option value='Metropolitan University Prague (Private) (MTP)'>Metropolitan University Prague (Private) (MTP)</option>";
		options += "<option value='Technical University of Ostrava (Public) (VSB)'>Technical University of Ostrava (Public) (VSB)</option>";
		options += "<option value='Mendel University (Public) (MD)'>Mendel University (Public) (MD)</option>";
		
		if (appliedName == 'bachelor') {
			options += "<option value='Newton University (Private) (NT)'>Newton University (Private) (NT)</option>";
		} else if (appliedName == 'master') {
			options += "<option value='Palacky University Olomouc (Public) (PUO)'>Palacky University Olomouc (Public) (PUO)</option>";
		}
		
		var row = "<tr id='row"+c+"'> <td> <div class='form-group col-md-12'> <select class='form-control' data-toggle='select2' name='uniName[]' autocomplete='off' required='required' onchange='checkOtherCzechUni("+c+")' id='uniOtherCzechName"+c+"'> <option selected value disabled class='text-center'>--- Select University ---</option>" + options + "</select> </div> <div class='form-group col-md-12' style='display: none;' id='showOtherCzechUni"+c+"'> <input type='text' name='otherUniCzechName[]' class='form-control' autocomplete='off' placeholder='Enter Other University'> </div></td> <td> <div class='col-md-12'> <input type='text' name='programName[]' class='form-control' required='required' autocomplete='off' placeholder='Enter Program'> </div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeName[]' class='form-control' autocomplete='off' placeholder='Enter intake'> </div> </td> <td> <button class='btn btn-outline-danger' type='button' onclick='delRow("+c+");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>";

		$("#showCzech").append(row);
		$('[data-toggle="select2"]').select2();
		c++;
	}
	// Italy add progrm function
	function ItalydelRow(id) {
		$("#row"+id+"").remove();
		$('#uniSubmit').attr('disabled', false);
		$('#addMoreButton').attr('disabled', false);
		$('#already-cgpa').empty();
	};
	var i = 1;
	function italyProgram() {
		var appliedName = $("#appliedNameID").val();
		var options = "<option selected value disabled class='text-center'>--- Select University ---</option>";

		if (appliedName === "master") {
			options += $("#masterUniversities").html();
		} else {
			options += $("#bachelorUniversities").html();
		}
		var row = "<tr id='row"+i+"'> <td> <div class='form-group col-md-12'> <select class='form-control' data-toggle='select2' name='uniName[]' required='required' onchange='checkOtherItalyUni("+i+")' id='uniOtherItalyName"+i+"'>"+options+"</select> </div> <div class='form-group col-md-12' style='display: none;' id='showOtherItalyUni"+i+"'> <input type='text' name='otherUniItalyName[]' class='form-control' autocomplete='off' placeholder='Enter Other University'> </div></td> <td> <input type='text' name='' class='form-control' readonly='readonly' id='showItalyUniCGPA"+i+"'> </td> <td> <div class='col-md-12'> <input type='text' name='programName[]' class='form-control' required='required' autocomplete='off' placeholder='Enter Program'> <span class='float-left badge bg-danger showProInput"+i+"' id='blink' style='display: none;'>Add One Program name in this Input</span></div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeName[]' class='form-control' autocomplete='off' placeholder='Enter intake'> </div> </td> <td> <div class='col-md-12'> <input type='file' name='programApproveFile["+i+"][]' class='form-control' autocomplete='off' multiple='' id='programApproveID"+i+"' onchange='uploadApproveFile("+i+");'> </div> <div class='col-md-12'> <textarea name='programApproveNote[]' class='form-control' autocomplete='off'> </textarea> </div> </td><td> <button class='btn btn-outline-danger btn-sm' type='button' onclick='ItalydelRow("+i+");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>";

		$("#showItaly").append(row);
		$('[data-toggle="select2"]').select2();
		i++;
	}
	// Italy MBBS add progrm function
	function delRowMBBS(id) {
		$("#row"+id+"").remove();
		$('#uniSubmit').attr('disabled', false);
		$('#addMBBSMoreButton').attr('disabled', false);
		$('#already-MBBScgpa').empty();
	};
	var imbbs = 1;
	function italyProgramMBBS() {
		$("#showItalyMBBS").append("<tr id='row"+imbbs+"'> <td> <div class='form-group col-md-12'> <select class='form-control' data-toggle='select2' name='uniNameMBBS[]' autocomplete='off' required='required' onchange='checkOtherMBBSUni("+imbbs+")' id='uniOtherMBBSName"+imbbs+"'> <option selected value disabled class='text-center'>--- Select University ---</option> <?php $uniDetails = "SELECT * FROM italy_add_universities WHERE status='1' AND close='1' AND italy_uni_intake='2025' AND italy_uni_degree='mbbs' ORDER BY italy_add_id ASC"; $uniDetails_ex = mysqli_query($con, $uniDetails); foreach ($uniDetails_ex as $row) { ?> <option value='<?php echo $row['italy_uni_name'];?>'><?php echo $row['italy_uni_name'];?></option> <?php } ?> </select> </div> <div class='form-group col-md-12' style='display: none;' id='showOtherMBBSUni"+i+"'> <input type='text' name='otherUniMBBSName[]' class='form-control' autocomplete='off' placeholder='Enter Other University'> </div></td> <td> <input type='text' name='' class='form-control' readonly='readonly' id='showItalyMBBSUniCGPA"+imbbs+"'> </td><td> <div class='col-md-12'> <input type='text' name='programNameMBBS[]' class='form-control' required='required' autocomplete='off' placeholder='Enter Program'> </div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeNameMBBS[]' class='form-control' autocomplete='off' placeholder='Enter intake'></div> </td> <td> <div class='col-md-12'> <input type='file' name='programMBBSApproveFile["+imbbs+"][]' class='form-control' autocomplete='off' multiple='' id='programMBBSApproveID"+imbbs+"' onchange='uploadMBBSApproveFile("+imbbs+");'> </div> <div class='col-md-12'> <textarea name='programMBBSApproveNote[]' class='form-control' autocomplete='off'> </textarea> </div> </td><td> <button class='btn btn-outline-danger btn-sm' type='button' onclick='delRowMBBS("+imbbs+");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>");
		$('[data-toggle="select2"]').select2();
		imbbs++;
	}
	// Canada add program function
	function delRow(id) {
		$("#row"+id+"").remove();
	};
	var c = 1;
	function canadaProgram() {
		$("#showCanada").append("<tr id='row"+c+"'> <td> <div class='col-md-12'> <select class='form-control' data-toggle='select2' name='uniName[]' autocomplete='off' required='required'> <option selected value disabled class='text-center'>--- Select Institute ----</option> <option value='Non SDS ESL/EAP'> Non SDS ESL/EAP</option> <option value='Non SDS Diploma'>Non SDS Diploma</option> <option value='Non SDS Degree'>Non SDS Degree</option> <option value='SDS Diploma'>SDS Diploma</option> <option value='SDS Degree'>SDS Degree</option> <option value='Business Visit'>Business Visit</option> <option value='Tourist Vist'>Tourist Vist</option> </select> </div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeName[]' class='form-control' autocomplete='off' placeholder='Enter intake'> </div> </td> <td> <button class='btn btn-outline-danger' type='button' onclick='delRow("+c+");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>");
		$('[data-toggle="select2"]').select2();
	c++;
	}
	// USA add program function
	function delRow(id) {
		$("#row"+id+"").remove();
	};
	var u = 1;
	function USAProgram() {
		$("#showUSA").append("<tr id='row"+u+"'> <td> <div class='col-md-12'> <select class='form-control' data-toggle='select2' name='uniName[]' autocomplete='off' required='required'> <option selected value disabled class='text-center'>--- Select Category ---</option> <option value='Study Visa'>Study Visa</option> <option value='Business Visit'>Business Visit</option> <option value='Tourist Vist'>Tourist Vist</option> </select> </div> </td> <td> <div class='col-md-12'> <input type='text' name='intakeName[]' class='form-control' autocomplete='off' placeholder='Enter intake'> </div> </td> <td> <button class='btn btn-outline-danger' type='button' onclick='delRow("+u+");'><i class='mdi mdi-trash-can'></i></button> </td> </tr>");
		$('[data-toggle="select2"]').select2();
	u++;
	}

	// other university 
	function checkOtherAusUni(id) {
		var uniOtherAusName = $("#uniOtherAusName"+id+"").val();
		if (uniOtherAusName == 'Other University' ) {
			$("#showOtherAusUni"+id+"").show();
			$("#showOtherAusUni"+id+" input").prop('required', true); // Corrected ID here
			$("#showOtherAusUni"+id+" input").css('border-bottom', '2px solid #e33244');
		} else {
			$("#showOtherAusUni"+id+"").hide();
			$("#showOtherAusUni"+id+" input").prop('required', false); // Corrected ID here
			$("#showOtherAusUni"+id+" input").css('border-bottom', '2px solid #e33244');
		}
	}
	function checkOtherItalyUni(id) {
		var uniOtherItalyName = $("#uniOtherItalyName"+id+"").val();
		if (uniOtherItalyName == 'Other University' ) {
			$("#showOtherItalyUni"+id+"").show();
			$("#showOtherItalyUni"+id+" input").prop('required', true); // Corrected ID here
			$("#showOtherItalyUni"+id+" input").css('border-bottom', '2px solid #e33244');
		} else {
			$("#showOtherItalyUni"+id+"").hide();
			$("#showOtherItalyUni"+id+" input").prop('required', false); // Corrected ID here
			$("#showOtherItalyUni"+id+" input").css('border-bottom', '2px solid #e33244');
		}
		italyBachMasterCGPA(id);
		checkOneProgram(id);
	}
	function checkOtherMBBSUni(id) {
		var uniOtherMBBSName = $("#uniOtherMBBSName"+id+"").val();
		if (uniOtherMBBSName == 'Other University' ) {
			$("#showOtherMBBSUni"+id+"").show();
			$("#showOtherMBBSUni"+id+" input").prop('required', true); // Corrected ID here
			$("#showOtherMBBSUni"+id+" input").css('border-bottom', '2px solid #e33244');
		} else {
			$("#showOtherMBBSUni"+id+"").hide();
			$("#showOtherMBBSUni"+id+" input").prop('required', false); // Corrected ID here
			$("#showOtherMBBSUni"+id+" input").css('border-bottom', '2px solid #e33244');
		}
		italyMBBSCGPA(id)
	}
	function checkOneProgram(id) {
		var uniName = $("#uniOtherItalyName"+id+"").val();
		var appliedID = $("#appliedNameID").val();
		// alert(appliedID);
		if(uniName=='Sapienza University of Rome (SPU)' || uniName=='Universita Politecnica Delle Marche (MR)' || uniName=='University of Bologna (UBN)' || uniName=='University of Campania (UC)' || uniName=='University of Messina (UM)' || uniName=='University of Napoli Fedrico II (UNP)' || uniName=='University of Palermo (PLM)' || (uniName=='University of Turin (TU)' && appliedID=='bachelor') || uniName=='University of Tuscia (TS02)' || uniName=='University of Camerino (UC)' || uniName=='University of Salerno (SL)' || uniName=='University of Trento (TRN)' || uniName=='University of Foggia (FG)' || uniName=='University of Pisa (UP)' || uniName=='University of Laquia (LAQ01)' || uniName=='University of Cassino (CS)' || uniName=='University of Perugia (UPG)' || uniName=='Universita Del Piemonte Orientale (UDPO)' || uniName=='University of Verona (VN)' || uniName=='Tor Vergata University of Rome (TVR)' || uniName=='University of Salento (UST)'){
			$(".showProInput"+id+"").show();
		}
		else if(uniName=='University of Genevo (UG)' && appliedID=='bachelor'){
			$(".showProInput"+id+"").show();
		}
		else{
			$(".showProInput"+id+"").hide();
		}
	}
	// check university cgpa
	function italyBachMasterCGPA(id) {
		var uniOtherItalyName = $("#uniOtherItalyName"+id+"").val();
		var appliedNameID = $("#appliedNameID").val();
		var clientIDGET = $("#clientIDGET").val();
		// alert(clientIDGET);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:{
				checkuniOtherItalyName:uniOtherItalyName,
				checkappliedNameID:appliedNameID,
				checkclientIDGET:clientIDGET,
			},
			success: function(data){
				// alert(data);
				if (data.trim()=="yes"){
					$("#programApproveID"+id+"").attr('required', false);
					$('#uniSubmit').attr('disabled', false);
					$('#addMoreButton').attr('disabled', false);
					$('#already-cgpa').empty();
				}
				else{
					$("#programApproveID"+id+"").attr('required', true);
					$('#uniSubmit').attr('disabled', true);
					$('#addMoreButton').attr('disabled', true);
					$('#already-cgpa').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
				}

				$.ajax({
					type: "POST",
					url: "models/clientProgramState.php",
					data:{
						checkCGPAuniOtherItalyName:uniOtherItalyName,
						checkCGPAappliedNameID:appliedNameID,
					},
					success: function(data){
						// alert(data);
						$("#showItalyUniCGPA"+id+"").val(data);
					}
				});
			}
		});
	}
	function italyMBBSCGPA(id) {
		var uniOtherMBBSName = $("#uniOtherMBBSName"+id+"").val();
		var appliedNameMBBS = $("#appliedNameMBBS").val();
		var clientIDGET = $("#clientIDGET").val();
		// alert(uniOtherMBBSName);
		$.ajax({
			type: "POST",
			url: "models/clientProgramState.php",
			data:{
				checkuniOtherItalyName:uniOtherMBBSName,
				checkappliedNameID:appliedNameMBBS,
				checkclientIDGET:clientIDGET,
			},
			success: function(data){
				// alert(data);
				if (data.trim()=="yes"){
					$("#programMBBSApproveID"+id+"").attr('required', false);
					$('#uniSubmit').attr('disabled', false);
					$('#addMBBSMoreButton').attr('disabled', false);
					$('#already-MBBScgpa').empty();
				}
				else{
					$("#programMBBSApproveID"+id+"").attr('required', true);
					$('#uniSubmit').attr('disabled', true);
					$('#addMBBSMoreButton').attr('disabled', true);
					$('#already-MBBScgpa').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
				}
				$.ajax({
					type: "POST",
					url: "models/clientProgramState.php",
					data:{
						checkCGPAuniOtherItalyName:uniOtherMBBSName,
						checkCGPAappliedNameID:appliedNameMBBS,
					},
					success: function(data){
						// alert(data);
						$("#showItalyMBBSUniCGPA"+id+"").val(data);
					}
				});

			}
		});
	}

	function uploadApproveFile(id) {
		var programApproveID = $("#programApproveID"+id+"").val();
		if (programApproveID!='') {
			$('#uniSubmit').attr('disabled', false);
			$('#addMoreButton').attr('disabled', false);
			$('#already-cgpa').empty();
		}else{
			$('#uniSubmit').attr('disabled', true);
			$('#addMoreButton').attr('disabled', true);
			$('#already-cgpa').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
		}
	}
	function uploadMBBSApproveFile(id) {
		var programMBBSApproveID = $("#programMBBSApproveID"+id+"").val();
		if (programMBBSApproveID!='') {
			$('#uniSubmit').attr('disabled', false);
			$('#addMBBSMoreButton').attr('disabled', false);
			$('#already-MBBScgpa').empty();
		}else{
			$('#uniSubmit').attr('disabled', true);
			$('#addMBBSMoreButton').attr('disabled', true);
			$('#already-MBBScgpa').html("<div class='alert alert-danger' style='text-align:center;'>This <strong>Client's CGPA </strong> can't meet with a <strong>University CGPA</strong>, Try to Select Another University!</div>");
		}
	}

	// check input val
	function validateInput(input) {
		// Remove non-alphabetic characters
		input.value = input.value.replace(/[^a-zA-Z]/g, ' ');
	}
	function validateNumberInput(input) {
		// Remove non-numeric characters, excluding 'e'
		input.value = input.value.replace(/[^0-9.%]/g, '').replace(/(\..*)\./g, '$1');
	}
	// to show Amount due date
	function checkAmount() {
		var balanceAmount = $("#balaceformadvance").val();
		if (balanceAmount > 0) {
			$("#balanceDueDate").show();
			$("#balanceDueDate input").prop('required', true); // Corrected ID here
			$("#balanceDueDate input").css('border-bottom', '2px solid #e33244');
			const minDate = new Date(Date.now() + 86400000).toISOString().split('T')[0];
			$("#balanceDueDate input").attr({ min: minDate, value: minDate });
		} else {
			$("#balanceDueDate").hide();
			$("#balanceDueDate input").prop('required', false); // Corrected ID here
		}
	}
	// function hide and show update
	function showCountrydegUp1() {
		var countrySelect = $("#countryShowUp").val();
		displayoptions(countrySelect);
		if (countrySelect === "austria" || countrySelect === "czech republic") {
			document.getElementById("austriaShowUp").style.display = "block";
			$("#austriaShowUp select").prop('required', true);
			$("#canadaShowUp select").prop('required', false);
			$("#usaShowUp select").prop('required', false);
			$("#italyShowUp select").prop('required', false);
			$("#ieltsShowUp select").prop('required', false);
			$("#austriaShowUp select").css('border-bottom', '2px solid #e33244');
			document.getElementById("canadaShowUp").style.display = "none";
			document.getElementById("usaShowUp").style.display = "none";
			document.getElementById("italyShowUp").style.display = "none";
			document.getElementById("ieltsShowUp").style.display = "none";
		} else if (countrySelect === "canada") {
			document.getElementById("canadaShowUp").style.display = "block";
			$("#canadaShowUp select").prop('required', true);
			$("#austriaShowUp select").prop('required', false);
			$("#usaShowUp select").prop('required', false);
			$("#italyShowUp select").prop('required', false);
			$("#ieltsShowUp select").prop('required', false);
			$("#canadaShowUp select").css('border-bottom', '2px solid #e33244');
			document.getElementById("austriaShowUp").style.display = "none";
			document.getElementById("usaShowUp").style.display = "none";
			document.getElementById("italyShowUp").style.display = "none";
			document.getElementById("ieltsShowUp").style.display = "none";
		} else if (countrySelect === "USA") {
			document.getElementById("usaShowUp").style.display = "block";
			$("#usaShowUp select").prop('required', true);
			$("#austriaShowUp select").prop('required', false);
			$("#canadaShowUp select").prop('required', false);
			$("#italyShowUp select").prop('required', false);
			$("#ieltsShowUp select").prop('required', false);
			$("#usaShowUp select").css('border-bottom', '2px solid #e33244');
			document.getElementById("austriaShowUp").style.display = "none";
			document.getElementById("canadaShowUp").style.display = "none";
			document.getElementById("italyShowUp").style.display = "none";
			document.getElementById("ieltsShowUp").style.display = "none";
		} else if (countrySelect === "italy") {
			document.getElementById("italyShowUp").style.display = "block";
			$("#italyShowUp select").prop('required', true);
			$("#austriaShowUp select").prop('required', false);
			$("#canadaShowUp select").prop('required', false);
			$("#usaShowUp select").prop('required', false);
			$("#italyShowUp select").css('border-bottom', '2px solid #e33244');
			document.getElementById("austriaShowUp").style.display = "none";
			document.getElementById("canadaShowUp").style.display = "none";
			document.getElementById("usaShowUp").style.display = "none";
			document.getElementById("ieltsShowUp").style.display = "none";
		} else if (countrySelect === "IELTS enrollment") {
			document.getElementById("ieltsShowUp").style.display = "block";
			$("#italyShowUp select").prop('required', false);
			$("#austriaShowUp select").prop('required', false);
			$("#canadaShowUp select").prop('required', false);
			$("#usaShowUp select").prop('required', false);
			$("#ieltsShowUp select").prop('required', true);
			$("#ieltsShowUp select").css('border-bottom', '2px solid #e33244');
			document.getElementById("austriaShowUp").style.display = "none";
			document.getElementById("canadaShowUp").style.display = "none";
			document.getElementById("usaShowUp").style.display = "none";
			document.getElementById("italyShowUp").style.display = "none";
		}
	}

	function showCountrydegUp1() {
		var countrySelect = $("#countryShowUp1").val();
		displayoptions(countrySelect);

		const hideAllSections = () => {
		// Hide all sections
			$("#viewInvitationModal, #viewAdmissionModal, #canadaShowUp1, #usaShowUp1, #italyShowUp1, #austriaShowUp1, #payAfterVisaUp, #payAfterRPUp, #ieltsShowUp1, #viewIeltsEnrollModal").hide();
	 		// Reset required fields
	 		$("#austriaShowUp1 select, #canadaShowUp1 select, #usaShowUp1 select, #italyShowUp1 select, #ieltsShowUp1 select").prop('required', false).css('border-bottom', '');
 		};

		hideAllSections(); // Hide everything first

		if (countrySelect === "austria" || countrySelect === "czech republic") {
			$("#viewAdmissionModal, #austriaShowUp1, #payAfterRPUp").show();
			$("#austriaShowUp1 select").prop('required', true).css('border-bottom', '2px solid #e33244');
		} else if (countrySelect === "canada") {
			$("#viewInvitationModal, #canadaShowUp1, #payAfterVisaUp").show();
			$("#canadaShowUp1 select").prop('required', true).css('border-bottom', '2px solid #e33244');
		} else if (countrySelect === "USA") {
			$("#viewInvitationModal, #usaShowUp1, #payAfterVisaUp").show();
			$("#usaShowUp1 select").prop('required', true).css('border-bottom', '2px solid #e33244');
		} else if (countrySelect === "italy") {
			$("#viewAdmissionModal, #italyShowUp1, #payAfterVisaUp").show();
			$("#italyShowUp1 select").prop('required', true).css('border-bottom', '2px solid #e33244');
		} else if (countrySelect === "IELTS enrollment") {
			$("#viewAdmissionModal, #ieltsShowUp1, #viewIeltsEnrollModal, #payAfterVisaUp").show();
			$("#ieltsShowUp1 select").prop('required', true).css('border-bottom', '2px solid #e33244');
			$("#viewAdmissionModal").hide();
		}
	}

	function displayoptions(countrySelect1) {
		const options = {
			admission: ["austria", "czech republic", "italy"],
			invitation: ["USA", "canada"],
			ielts: ["IELTS enrollment"],
		};
		const views = {
			viewAdmission1: options.admission.includes(countrySelect1),
			viewInvitation1: options.invitation.includes(countrySelect1),
			viewIeltsEnroll1: options.ielts.includes(countrySelect1),
		};
		Object.keys(views).forEach(view => {
			$("#" + view).toggle(views[view]);
		});

		if ($("#resetselect option[value='']").length === 0) {
			$("#resetselect").prepend('<option selected disabled value="" style="text-align: center;">--- Select an Option ---</option>');
		}
	}
	//this function is for display payment inputs and country
	function checkCaseStatus(caseType, val2, val3, val4, val5, val6, val7, val8, val9, val10, val11, val12) {
		const isCash = caseType === "cash case";
		const isOnline = caseType === "online case";
		const isBoth = caseType === "cash + online case";

		$("#" + val2 + " input, #" + val3 + " input").val('').prop('required', false).css('border-bottom', 'none');

		$("#" + val2).toggle(isCash || isBoth).find("input").prop('required', isCash || isBoth).css('border-bottom', isCash || isBoth ? '2px solid #e33244' : 'none');
		$("#" + val3).toggle(isOnline || isBoth).find("input").prop('required', isOnline || isBoth).css('border-bottom', isOnline || isBoth ? '2px solid #e33244' : 'none');

		$("#" + val4).toggle(isCash);
		$("#" + val5).toggle(isOnline);
		$("#" + val6).toggle(isBoth);
		$("#" + val7).toggle(isCash || isBoth);
		$("#" + val8).toggle(isOnline || isBoth);
		$("#" + val9 + ", #" + val10 + ", #" + val11).prop('required', isCash || isBoth);
		$("#" + val12).prop('required', isOnline || isBoth);
	}

</script>