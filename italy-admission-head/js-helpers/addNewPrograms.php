<script type="text/javascript">

	function reinitializeScripts() {
		// Reinitialize tooltips
		$('[data-toggle="tooltip"]').tooltip({ html:true});
		// Synchronize scroll behavior, if applicable
		const tableContent = document.getElementById('table-container');
		const bottomScrollbarContent = document.getElementById('bottom-scrollbar-content');
		if (tableContent && bottomScrollbarContent) {
			tableContent.addEventListener('scroll', () => {
				bottomScrollbarContent.scrollLeft = tableContent.scrollLeft;
			});
			bottomScrollbarContent.addEventListener('scroll', () => {
				tableContent.scrollLeft = bottomScrollbarContent.scrollLeft;
			});
		}
	}
	function engFunProfAcc(id) {
		var engCheck = $("#engProAccept"+id);
		if (engCheck.is(":checked")) {
			$("#hidden_engProAccept"+id).val('1');
			$("#proIELTSPTE"+id).prop('readonly', true);
			$("#proIELTSPTE"+id).val('');
		} else {
			$("#hidden_engProAccept"+id).val('0');
			$("#proIELTSPTE"+id).prop('readonly', false);
			$("#proIELTSPTE"+id).val('');
		}
	}

	function requiredSOP(id) {
		var sopReq = $("#sopRequired"+id);
		if (sopReq.is(":checked")) {
			$("#hidden_sopRequired"+id).val('1');
			$("#showNoteSOP"+id).prop('readonly', false);
			$("#showNoteSOP"+id).val('');
		} else {
			$("#hidden_sopRequired"+id).val('0');
			$("#showNoteSOP"+id).prop('readonly', true);
			$("#showNoteSOP"+id).val('');
		}
	}
	function funDegreeRequired(id){
		var dreq = $("#degreeRequired"+id);
		if (dreq.is(":checked")) {
			$("#hidden_degreeRequired"+id).val('1');
		} else {
			$("#hidden_degreeRequired"+id).val('0');
		}
	}

	function funRecommendation(id){
		var dreq = $("#recommendation"+id);
		if (dreq.is(":checked")) {
			$("#hidden_recommendation"+id).val('1');
		} else {
			$("#hidden_recommendation"+id).val('0');
		}
	}

	function funNormalCV(id){
		var dreq = $("#normalCV"+id);
		if (dreq.is(":checked")) {
			$("#hidden_normalCV"+id).val('1');
		} else {
			$("#hidden_normalCV"+id).val('0');
		}
	}

	function funEuropassCV(id){
		var dreq = $("#europassCV"+id);
		if (dreq.is(":checked")) {
			$("#hidden_europassCV"+id).val('1');
		} else {
			$("#hidden_europassCV"+id).val('0');
		}
	}

	function funBeforeTOLC(id){
		var dreq = $("#beforeTOLC"+id);
		if (dreq.is(":checked")) {
			$("#hidden_beforeTOLC"+id).val('1');
		} else {
			$("#hidden_beforeTOLC"+id).val('0');
		}
	}
	function funAfterTOLC(id){
		var dreq = $("#afterTOLC"+id);
		if (dreq.is(":checked")) {
			$("#hidden_afterTOLC"+id).val('1');
		} else {
			$("#hidden_afterTOLC"+id).val('0');
		}
	}

	function funBeforeCimea(id){
		var dreq = $("#beforeCimea"+id);
		if (dreq.is(":checked")) {
			$("#hidden_beforeCimea"+id).val('1');
		} else {
			$("#hidden_beforeCimea"+id).val('0');
		}
	}
	function funAfterCimea(id){
		var dreq = $("#afterCimea"+id);
		if (dreq.is(":checked")) {
			$("#hidden_afterCimea"+id).val('1');
		} else {
			$("#hidden_afterCimea"+id).val('0');
		}
	}
	function funTestInterview(id){
		var tInt = $("#textInterview"+id);
		if (tInt.is(":checked")) {
			$("#hidden_textInterview"+id).val('1');
		} else {
			$("#hidden_textInterview"+id).val('0');
		}
	}
	function funCurriculum(id){
		var tInt = $("#Curriculum"+id);
		if (tInt.is(":checked")) {
			$("#hidden_Curriculum"+id).val('1');
		} else {
			$("#hidden_Curriculum"+id).val('0');
		}
	}

	function delRow(id) {
		Swal.fire({
			title: 'Are you sure?',
			text: "Do you really want to delete this Program?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
			cancelButtonText: 'Cancel'
		}).then((result) => {
			if (result.isConfirmed) {
				$("#row" + id).remove();
				Swal.fire(
					'Deleted!',
					'The Program has been removed.',
					'success'
				)
			}
		});
	}

	
	function addNewPrograms(id) {
		var i = $("#varInputID").val();
		var approw = `
		<div class='row' id='row${i}'>
			<div class='form-group col-md-3'>
				<label class='form-label'>Program Name <span class='text-danger'>*</span></label>
				<input type='text' name='programName[]' class='form-control' required="required" autocomplete='off' placeholder='Enter Program Name'>
			</div>
			<div class='col-md-9'>
				<div class='row'>
					<div class='form-group col-md-3'>
						<label class='form-label'>CGPA / Percentage <span class='text-danger'>*</span></label>
						<input type='text' name='proCGPAPer[]' class='form-control' required="required" autocomplete='off' placeholder='Enter CGPA / Percentage'>
					</div>
					<div class='form-group col-md-3'>
						<label class='form-label'>Language of Instruction <span class='text-danger'>*</span></label>
						<select class='form-control' name='prolanguageInstruction[]' required="required">
							<option selected disabled>--- Select Instruction ---</option>
							<option value='English'>English</option>
							<option value='Italian'>Italian</option>
							<option value='English and Italian'>English and Italian</option>
						</select>
					</div>
					<div class='form-group col-md-3'>
						<label class='form-label'>Program Application Fee <span class='text-danger'>*</span></label>
						<input type='text' name='proAppFee[]' class='form-control' required="required" autocomplete='off' placeholder='Enter Application Fee'>
					</div>
					<div class='form-group col-md-3'>
						<label class='form-label'>Program Tuition Fee </label>
						<input type='text' name='proTuitionFee[]' class='form-control' autocomplete='off' placeholder='Enter Program Tuition Fee'>
					</div>
				</div>
			</div>
			<!-- Language Requirement -->
			<div class='form-group col-md-4'>
				<label class='form-label'>Language Requirement</label><br>
				<div class='checkbox checkbox-success form-check-inline'>
					<input type='hidden' id='hidden_engProAccept${i}' name='proEngProfAccept[]' value='0'>
					<input type='checkbox' id='engProAccept${i}' onclick='engFunProfAcc(${i});'>
					<label for='engProAccept${i}'> English Proficiency Acceptable </label>
				</div>
			</div>
			<div class='form-group col-md-3'>
				<label class='form-label'>IELTS / PTE / Duo lingo / Other</label>
				<input type='text' name='proIELTSPTE[]' class='form-control' autocomplete='off' placeholder='Enter IELTS / PTE / Duo lingo / Other' id='proIELTSPTE${i}'>
			</div>
			<!-- SOP -->
			<div class='form-group col-md-2'>
				<label class='form-label'>SOP</label><br>
				<div class='checkbox checkbox-success form-check-inline'>
					<input type='hidden' id='hidden_sopRequired${i}' name='proSOPRequired[]' value='0'>
					<input type='checkbox' id='sopRequired${i}' onclick='requiredSOP(${i});'>
					<label for='sopRequired${i}'> SOP Required </label>
				</div>
			</div>
			<div class='form-group col-md-3'>
				<label class='form-label'>SOP Note</label>
				<input type='text' name='proSOPNote[]' class='form-control' autocomplete='off' placeholder='Enter SOP Note' readonly id='showNoteSOP${i}'>
			</div>
			<!-- Degree Required & Recommendation -->
			<div class='form-group col-md-2'>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_degreeRequired${i}' name='proDegreeRequired[]' value='0'>
					<input type='checkbox' id='degreeRequired${i}' onclick='funDegreeRequired(${i});'>
					<label for='degreeRequired${i}'> Degree Required </label>
				</div>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_recommendation${i}' name='proRecommendation[]' value='0'>
					<input type='checkbox' id='recommendation${i}' onclick='funRecommendation(${i});'>
					<label for='recommendation${i}'> Recommendation </label>
				</div>
			</div>
			<!-- CV -->
			<div class='form-group col-md-2'>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_normalCV${i}' name='proNormalCV[]' value='0'>
					<input type='checkbox' id='normalCV${i}' onclick='funNormalCV(${i});'>
					<label for='normalCV${i}'> Normal CV </label>
				</div>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_europassCV${i}' name='proEuropassCV[]' value='0'>
					<input type='checkbox' id='europassCV${i}' onclick='funEuropassCV(${i});'>
					<label for='europassCV${i}'> Europass CV </label>
				</div>
			</div>
			<!-- Before & After TOLC -->
			<div class='form-group col-md-4'>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_beforeTOLC${i}' name='proBeforeTolc[]' value='0'>
					<input type='checkbox' id='beforeTOLC${i}' onclick='funBeforeTOLC(${i});'>
					<label for='beforeTOLC${i}'> Before CEnT-S Apply </label>
					<input type='text' class='form-control ml-2' name='proBeforeTolcNote[]' placeholder='Enter Before CEnT-S Note' style='width:50%;'>
				</div>
				<div class='checkbox checkbox-success form-check-inline mt-1'>
					<input type='hidden' id='hidden_afterTOLC${i}' name='proAfterTolc[]' value='0'>
					<input type='checkbox' id='afterTOLC${i}' onclick='funAfterTOLC(${i});'>
					<label for='afterTOLC${i}'> After CEnT-S Apply </label>
					<input type='text' class='form-control ml-3' name='proAfterTolcNote[]' placeholder='Enter After CEnT-S Note' style='width:50%;'>
				</div>
			</div>
			<!-- Cimea -->
			<div class='form-group col-md-2'>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_beforeCimea${i}' name='probeforeCimea[]' value='0'>
					<input type='checkbox' id='beforeCimea${i}' onclick='funBeforeCimea(${i});'>
					<label for='beforeCimea${i}'> Before Cimea Apply </label>
				</div>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_afterCimea${i}' name='proAfterCimea[]' value='0'>
					<input type='checkbox' id='afterCimea${i}' onclick='funAfterCimea(${i});'>
					<label for='afterCimea${i}'> After Cimea Apply </label>
				</div>
			</div>

			<!-- Test Interview -->
			<div class='form-group col-md-2'>
				<div class='checkbox checkbox-success form-check-inline mt-2'>
					<input type='hidden' id='hidden_textInterview${i}' name='protextInterview[]' value='0'>
					<input type='checkbox' id='textInterview${i}' onclick='funTestInterview(${i});'>
					<label for='textInterview${i}'> Any Test Interview Required </label>
				</div>
				<div class='checkbox checkbox-success form-check-inline'>
					<input type='hidden' id='hidden_Curriculum${i}' name='proCurriculum[]' value='0'>
					<input type='checkbox' id='Curriculum${i}' onclick='funCurriculum(${i});'>
					<label for='Curriculum${i}'> Curriculum </label>
				</div>
			</div>
			<!-- Calls -->
			<div class='form-group col-md-3'>
				<label class='form-label'>Overall Call <span class='text-danger'>*</span></label>
				<input type='text' name='proRound[]' class='form-control' required="required" autocomplete='off' placeholder='Enter Call'>
			</div>
			<div class='form-group col-md-3'>
				<label class='form-label'>Current Call <span class='text-danger'>*</span></label>
				<input type='text' name='proCurrentRound[]' class='form-control' required="required" autocomplete='off' placeholder='Enter Call'>
			</div>
			<div class='form-group col-md-3'>
				<label class='form-label'>Current Call Opening Date</label>
				<input type='date' name='openingDate[]' class='form-control' autocomplete='off'>
			</div>
			<div class='form-group col-md-3'>
				<label class='form-label'>Current Call Actual Deadline</label>
				<input type='date' name='actualDeadline[]' class='form-control' autocomplete='off'>
			</div>
			<!-- Degree Acceptable -->
			<div class='form-group col-md-4'>
				<label class='form-label'>Degree Acceptable</label>
				<select name='degreeAcceptable[]' class='form-control'>
					<option value=''>--- Select Degree Acceptable ---</option>
					<option value='Bachelor 4 Years'>Bachelor 4 Years</option>
					<option value='2 Years Bachelor + 2 Years Master'>2 Years Bachelor + 2 Years Master</option>
					<option value='Both'>Both</option>
				</select>
			</div>
			<!-- Previous Degree -->
			<div class='form-group col-md-8'>
				<label class='form-label'>Client's Previous Degree</label>
				<select name='clientPreviousDegree[${i}][]' data-toggle='select3' class='form-control' multiple>
					<?php 
					$uniDetails = "SELECT pre_degree_name FROM previous_client_degrees WHERE status='1' AND close='1' ORDER BY pre_degree_id DESC"; 
					$uniDetails_ex = mysqli_query($con, $uniDetails); 
					foreach ($uniDetails_ex as $rowPre) { ?> 
					<option value='<?php echo $rowPre['pre_degree_name'];?>'><?php echo ucwords($rowPre['pre_degree_name']);?></option> 
					<?php } ?>
				</select>
			</div>
			<!-- Note -->
			<div class='form-group col-md-11'>
				<label class='form-label'>Note for Admission Head</label>
				<textarea name='proNoteHead[]' class='form-control'></textarea>
			</div>
			<!-- Delete -->
			<div class='form-group col-md-1'>
				<label>Status</label><br>
				<button type='button' class='btn btn-danger btn-sm' onclick='delRow(${i})'><i class='mdi mdi-trash-can'></i></button>
			</div>
			<hr width='100%' style='border:2px solid black;'>
		</div>`;

		$("#showNewPrograms").append(approw);
		$('[data-toggle="select3"]').select2();
		i++;
		$("#varInputID").val(i);
	}


	function addProgramsNew(idUni) {
		var idUni = idUni;
		var proIntake = $("#proIntake").val();
		$.ajax({
			type: "POST",
			url: "models/addNewProgramState.php",
			data: {
				proAddNew : idUni,
				proIntake : proIntake,
			},
			success: function(data){
				$(".showModalTitle").html('Add Program details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};

	function editAddPro(idUni) {
		var idUni = idUni;
		var proIntake = $("#proIntake").val();
		$.ajax({
			type: "POST",
			url: "models/addNewProgramState.php",
			data: {
				proAddEdit : idUni,
				proIntake : proIntake,
			},
			success: function(data){
				$(".showModalTitle").html('Update Program details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//del Programs
	function delC(idUni) {
		var idUni = idUni;
		$.ajax({
			type:"POST",
			url:"models/addNewProgramState.php",
			data: 'proAddDel='+idUni,
			success:function(data) {
				var rowh = "#"+idUni;
				$(rowh).remove();
				Swal.fire(
					'Deleted!',
					'Record has been deleted.',
					'success'
				)
			}
		});
	};

	// inactive and active full university
	function activeProC(idAddPro) {
		var idAddPro = idAddPro;
		var actPro = $("#actPro"+idAddPro+"").val();
		// alert(actPro);
		$.ajax({
			type:"POST",
			url:"models/addNewProgramState.php",
			data: {
				idAddPro : idAddPro,
				actProStatus : actPro,
			},
			success:function(data) {
				if(data=='1'){
					Swal.fire(
						'Active!',
						'Record has been Active.',
						'success'
					).then(() => {
						window.location.reload();
					});
				}else if(data=='0'){
					Swal.fire(
						'InActive!',
						'Record has been InActive.',
						'success'
					).then(() => {
						window.location.reload();
					});
				}
			}
		});
	};
	// inactive and active signal program
	function activeProDetC(idAddDetPro) {
		var idAddDetPro = idAddDetPro;
		var actDetPro = $("#actDetPro"+idAddDetPro+"").val();
		$.ajax({
			type:"POST",
			url:"models/addNewProgramState.php",
			data: {
				idAddDetPro : idAddDetPro,
				actDetProStatus : actDetPro,
			},
			success:function(data) {
				if(data=='1'){
					Swal.fire(
						'Active!',
						'Record has been Active.',
						'success'
					).then(() => {
						window.location.reload();
					});
				}else{
					Swal.fire(
						'InActive!',
						'Record has been InActive.',
						'success'
					).then(() => {
						window.location.reload();
					});
				}
			}
		});
	};

</script>