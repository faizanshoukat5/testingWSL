<?php 
if(isset($_POST['subAddUni'])) {
	$uniName = mysqli_real_escape_string($con, $_POST['uniName']);
	$uniDegree = mysqli_real_escape_string($con, $_POST['uniDegree']);
	$uniApplylink = mysqli_real_escape_string($con, $_POST['uniApplylink']);
	$uniDeadline = mysqli_real_escape_string($con, $_POST['uniDeadline']);
	$uniDirectApply = $_POST['uniDirectApply'];
	$uniPreEnrollment = $_POST['uniPreEnrollment'];
	$uniDreamApply = $_POST['uniDreamApply'];
	$uniReqNote = $_POST['uniReqNote'];
	$programSelect = mysqli_real_escape_string($con, $_POST['programSelect']);
	$programApply = mysqli_real_escape_string($con, $_POST['programApply']);

	$insert_query = "INSERT INTO `italy_add_universities".$_SESSION['dbNo']."` (`italy_uni_name`, `italy_uni_degree`, `italy_uni_apply_link`, `italy_uni_deadline_link`, `italy_uni_direct_apply`, `italy_uni_pre_enrollment`, `italy_uni_dream_apply`, `italy_uni_req_note`, `italy_uni_intake`, `italy_uni_program_select`, `italy_uni_program_apply`, `close`, `status`, `entry_by`) VALUES ('".$uniName."', '".$uniDegree."', '".$uniApplylink."', '".$uniDeadline."', '".$uniDirectApply."', '".$uniPreEnrollment."', '".$uniDreamApply."', '".$uniReqNote."', '2026', '".$programSelect."', '".$programApply."', '1', '1', '".$_SESSION['user_id']."')";
	$insert_query_ex = mysqli_query($con,$insert_query);

	if ($insert_query_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Added!',
				text: 'New University Added.',
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
		echo "<div class='alert alert-secondary'>
			<strong>There is an error in the query2!</strong>
		</div>";
	}
}

// Update query2

if(isset($_POST['updAddUni'])) {
	$updateID = $_POST['updateID'];
	$uniName = mysqli_real_escape_string($con, $_POST['uniName']);
	$uniDegree = mysqli_real_escape_string($con, $_POST['uniDegree']);
	$uniApplylink = mysqli_real_escape_string($con, $_POST['uniApplylink']);
	$uniDeadline = mysqli_real_escape_string($con, $_POST['uniDeadline']);
	$uniDirectApply = $_POST['uniDirectApply'];
	$uniPreEnrollment = $_POST['uniPreEnrollment'];
	$uniDreamApply = $_POST['uniDreamApply'];
	$uniReqNote = $_POST['uniReqNote'];
	$programSelect = mysqli_real_escape_string($con, $_POST['programSelect']);
	$programApply = mysqli_real_escape_string($con, $_POST['programApply']);

	$insert_query = "UPDATE italy_add_universities".$_SESSION['dbNo']." SET italy_uni_name='".$uniName."', italy_uni_degree='".$uniDegree."', italy_uni_apply_link='".$uniApplylink."', italy_uni_deadline_link='".$uniDeadline."', italy_uni_direct_apply='".$uniDirectApply."', italy_uni_pre_enrollment='".$uniPreEnrollment."', italy_uni_dream_apply='".$uniDreamApply."', italy_uni_req_note='".$uniReqNote."', italy_uni_program_select='".$programSelect."', italy_uni_program_apply='".$programApply."' WHERE italy_add_id='".$updateID."'";
	$insert_query_ex = mysqli_query($con,$insert_query);

	if ($insert_query_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Updated!',
				text: 'New University Updated.',
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
		echo "<div class='alert alert-secondary'>
			<strong>There is an error in the query2!</strong>
		</div>";
	}
}
if(isset($_POST['updDelUni'])) {
	$updateID = $_POST['updateID'];
	$uniDelNote = $_POST['uniDelNote'];

	$insert_query = "UPDATE italy_add_universities".$_SESSION['dbNo']." SET italy_uni_del_note='".$uniDelNote."', close='0' WHERE italy_add_id='".$updateID."'";
	$insert_query_ex = mysqli_query($con,$insert_query);

	if ($insert_query_ex) {
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Deleted!',
				text: 'University Deleted Successfully.',
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
		echo "<div class='alert alert-secondary'>
			<strong>There is an error in the query2!</strong>
		</div>";
	}
}

?>


<?php 

if(isset($_POST['subAddProgram'])) {
	$uniName = mysqli_real_escape_string($con, $_POST['uniName']);
	$uniDegree = mysqli_real_escape_string($con, $_POST['uniDegree']);
	$programNote = mysqli_real_escape_string($con, $_POST['programNote']);

	$insertPro = "INSERT INTO `italy_add_programs".$_SESSION['dbNo']."` (`italy_ap_uni_name`, `italy_ap_degree`, `italy_ap_note`, `italy_active_status`, `italy_ap_intake`, `close`, `status`, `entry_by`) VALUES ('".$uniName."', '".$uniDegree."', '".$programNote."', '1', '2026', '1', '1', '".$_SESSION['user_id']."')";
	$insertPro_ex = mysqli_query($con,$insertPro);

	if ($insertPro_ex) {
		$lastID=$con->insert_id;
		$programArray = isset($_POST['clientPreviousDegree']) ? array_values($_POST['clientPreviousDegree']) : [];
		for ($i=0; $i < count($_POST['programName']); $i++) {
			$programName = mysqli_real_escape_string($con, $_POST['programName'][$i]);
			$proCGPAPer = mysqli_real_escape_string($con, $_POST['proCGPAPer'][$i]);
			$prolanguageInstruction = mysqli_real_escape_string($con, $_POST['prolanguageInstruction'][$i]);
			$proAppFee = mysqli_real_escape_string($con, $_POST['proAppFee'][$i]);
			$proRound = mysqli_real_escape_string($con, $_POST['proRound'][$i]);
			$proCurrentRound = mysqli_real_escape_string($con, $_POST['proCurrentRound'][$i]);
			$proEngProfAccept = mysqli_real_escape_string($con, $_POST['proEngProfAccept'][$i]);
			$proIELTSPTE = mysqli_real_escape_string($con, $_POST['proIELTSPTE'][$i]);
			$proSOPRequired = mysqli_real_escape_string($con, $_POST['proSOPRequired'][$i]);
			$proSOPNote = mysqli_real_escape_string($con, $_POST['proSOPNote'][$i]);
			$proTuitionFee = mysqli_real_escape_string($con, $_POST['proTuitionFee'][$i]);
			$proDegreeRequired = mysqli_real_escape_string($con, $_POST['proDegreeRequired'][$i]);
			$proRecommendation = mysqli_real_escape_string($con, $_POST['proRecommendation'][$i]);
			$proNormalCV = mysqli_real_escape_string($con, $_POST['proNormalCV'][$i]);
			$proEuropassCV = mysqli_real_escape_string($con, $_POST['proEuropassCV'][$i]);
			$proBeforeTolc = mysqli_real_escape_string($con, $_POST['proBeforeTolc'][$i]);
			$proBeforeTolcNote = mysqli_real_escape_string($con, $_POST['proBeforeTolcNote'][$i]);
			$proAfterTolc = mysqli_real_escape_string($con, $_POST['proAfterTolc'][$i]);
			$proAfterTolcNote = mysqli_real_escape_string($con, $_POST['proAfterTolcNote'][$i]);
			$probeforeCimea = mysqli_real_escape_string($con, $_POST['probeforeCimea'][$i]);
			$proAfterCimea = mysqli_real_escape_string($con, $_POST['proAfterCimea'][$i]);
			$protextInterview = mysqli_real_escape_string($con, $_POST['protextInterview'][$i]);
			$proCurriculum = mysqli_real_escape_string($con, $_POST['proCurriculum'][$i]);
			$openingDate = mysqli_real_escape_string($con, $_POST['openingDate'][$i]);
			$actualDeadline = mysqli_real_escape_string($con, $_POST['actualDeadline'][$i]);
			$degreeAcceptable = mysqli_real_escape_string($con, $_POST['degreeAcceptable'][$i]);

			$progStore = [];
			foreach ($programArray[$i] as $value) {
				$progStore[] = mysqli_real_escape_string($con, $value);
			}
			$clientPreDegJSON = json_encode($progStore);

			$proNoteHead = mysqli_real_escape_string($con, $_POST['proNoteHead'][$i]);

			if($proCurrentRound=='1'){
				$opening1stCallDate = $openingDate;
				$actual1stCallDeadline = $actualDeadline;

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='2'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = $openingDate;
				$actual2ndCallDeadline = $actualDeadline;

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='3'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = $openingDate;
				$actual3rdCallDeadline = $actualDeadline;

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='4'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = $openingDate;
				$actual4thCallDeadline = $actualDeadline;
			}

			$addProDetail = "INSERT INTO `italy_add_programs_details".$_SESSION['dbNo']."` (`italy_add_pro_id`, `italy_ad_uni_name`, `italy_ad_degree`, `italy_ad_program_name`, `italy_ad_cgpa`, `italy_ad_instruction`, `italy_ad_application_fee`, `italy_ad_round`, `italy_ad_current_round`, `italy_ad_english_pro`, `italy_ad_ielts_pte`, `italy_ad_sop_required`, `italy_ad_sop_note`, `italy_ad_tuition_fee`, `italy_ad_degree_required`, `italy_ad_recommendation`, `italy_ad_normal_cv`,`italy_ad_europass_cv`, `italy_ad_before_tolc`, `italy_ad_before_tolc_note`, `italy_ad_after_tolc`, `italy_ad_after_tolc_note`, `italy_ad_before_cimea`, `italy_ad_after_cimea`, `italy_ad_test_interview`, `italy_ad_curriculum`, `italy_ad_1st_opening_date`, `italy_ad_1st_actual_date`, `italy_ad_2nd_opening_date`, `italy_ad_2nd_actual_date`, `italy_ad_3rd_opening_date`, `italy_ad_3rd_actual_date`, `italy_ad_4th_opening_date`, `italy_ad_4th_actual_date`, `italy_ad_degree_acceptable`, `italy_ad_client_pre_degree`, `italy_ad_note_head`, `italy_ad_status`, `italy_ad_intake`, `close`, `status`, `entry_by`) VALUES ('".$lastID."', '".$uniName."', '".$uniDegree."', '".$programName."', '".$proCGPAPer."', '".$prolanguageInstruction."', '".$proAppFee."', '".$proRound."', '".$proCurrentRound."', '".$proEngProfAccept."', '".$proIELTSPTE."', '".$proSOPRequired."', '".$proSOPNote."', '".$proTuitionFee."', '".$proDegreeRequired."', '".$proRecommendation."', '".$proNormalCV."', '".$proEuropassCV."', '".$proBeforeTolc."', '".$proBeforeTolcNote."', '".$proAfterTolc."', '".$proAfterTolcNote."', '".$probeforeCimea."', '".$proAfterCimea."', '".$protextInterview."', '".$proCurriculum."', '".$opening1stCallDate."', '".$actual1stCallDeadline."', '".$opening2ndCallDate."', '".$actual2ndCallDeadline."', '".$opening3rdCallDate."', '".$actual3rdCallDeadline."', '".$opening4thCallDate."', '".$actual4thCallDeadline."', '".$degreeAcceptable."', '".$clientPreDegJSON."', '".$proNoteHead."', '1', '2026', '1', '1', '".$_SESSION['uname']."')";
			$addProDetail_ex = mysqli_query($con,$addProDetail);
		}
	}
	if($insertPro_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Added!',
				text: 'Programs Added Successfully.',
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
		echo "<div class='alert alert-secondary'>
			<strong>There is an error in the query2!</strong>
		</div>";
	}
}

// Update query 

if(isset($_POST['updAddProgram'])) {
	$updateID = $_POST['updateID'];
	$uniName = mysqli_real_escape_string($con, $_POST['uniName']);
	$uniDegree = mysqli_real_escape_string($con, $_POST['uniDegree']);
	$programNote = mysqli_real_escape_string($con, $_POST['programNote']);
	$current_date =  date('Y-m-d');
	$insertPro = "UPDATE italy_add_programs".$_SESSION['dbNo']." SET italy_ap_uni_name='".$uniName."', italy_ap_degree='".$uniDegree."', italy_ap_note='".$programNote."', italy_active_date='".$current_date."' WHERE italy_ap_id='".$updateID."'";
	$insertPro_ex = mysqli_query($con,$insertPro);

	if ($insertPro_ex) {

		$updSaleDel = "DELETE FROM italy_add_programs_details".$_SESSION['dbNo']." WHERE italy_ad_status='1' AND italy_add_pro_id='".$updateID."' ";
		$updSaleDel_ex = mysqli_query($con,$updSaleDel);
		$programArray = isset($_POST['clientPreviousDegree']) ? array_values($_POST['clientPreviousDegree']) : [];

		for ($i=0; $i < count($_POST['programName']); $i++) {
			$programName = mysqli_real_escape_string($con, $_POST['programName'][$i]);
			$proCGPAPer = mysqli_real_escape_string($con, $_POST['proCGPAPer'][$i]);
			$prolanguageInstruction = mysqli_real_escape_string($con, $_POST['prolanguageInstruction'][$i]);
			$proAppFee = mysqli_real_escape_string($con, $_POST['proAppFee'][$i]);
			$proRound = mysqli_real_escape_string($con, $_POST['proRound'][$i]);
			$proCurrentRound = mysqli_real_escape_string($con, $_POST['proCurrentRound'][$i]);
			$proEngProfAccept = mysqli_real_escape_string($con, $_POST['proEngProfAccept'][$i]);
			$proIELTSPTE = mysqli_real_escape_string($con, $_POST['proIELTSPTE'][$i]);
			$proSOPRequired = mysqli_real_escape_string($con, $_POST['proSOPRequired'][$i]);
			$proSOPNote = mysqli_real_escape_string($con, $_POST['proSOPNote'][$i]);
			$proTuitionFee = mysqli_real_escape_string($con, $_POST['proTuitionFee'][$i]);
			$proDegreeRequired = mysqli_real_escape_string($con, $_POST['proDegreeRequired'][$i]);
			$proRecommendation = mysqli_real_escape_string($con, $_POST['proRecommendation'][$i]);
			$proNormalCV = mysqli_real_escape_string($con, $_POST['proNormalCV'][$i]);
			$proEuropassCV = mysqli_real_escape_string($con, $_POST['proEuropassCV'][$i]);
			$proBeforeTolc = mysqli_real_escape_string($con, $_POST['proBeforeTolc'][$i]);
			$proBeforeTolcNote = mysqli_real_escape_string($con, $_POST['proBeforeTolcNote'][$i]);
			$proAfterTolc = mysqli_real_escape_string($con, $_POST['proAfterTolc'][$i]);
			$proAfterTolcNote = mysqli_real_escape_string($con, $_POST['proAfterTolcNote'][$i]);
			$probeforeCimea = mysqli_real_escape_string($con, $_POST['probeforeCimea'][$i]);
			$proAfterCimea = mysqli_real_escape_string($con, $_POST['proAfterCimea'][$i]);
			$protextInterview = mysqli_real_escape_string($con, $_POST['protextInterview'][$i]);
			$proCurriculum = mysqli_real_escape_string($con, $_POST['proCurriculum'][$i]);
			$openingDate = mysqli_real_escape_string($con, $_POST['openingDate'][$i]);
			$actualDeadline = mysqli_real_escape_string($con, $_POST['actualDeadline'][$i]);
			$degreeAcceptable = mysqli_real_escape_string($con, $_POST['degreeAcceptable'][$i]);
			$progStore = [];
			foreach ($programArray[$i] as $value) {
				$progStore[] = mysqli_real_escape_string($con, $value);
			}
			$clientPreDegJSON = json_encode($progStore);
			$proNoteHead = mysqli_real_escape_string($con, $_POST['proNoteHead'][$i]);

			if($proCurrentRound=='1'){
				$opening1stCallDate = $openingDate;
				$actual1stCallDeadline = $actualDeadline;

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='2'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = $openingDate;
				$actual2ndCallDeadline = $actualDeadline;

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='3'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = $openingDate;
				$actual3rdCallDeadline = $actualDeadline;

				$opening4thCallDate = '0000-00-00';
				$actual4thCallDeadline = '0000-00-00';
			}
			elseif($proCurrentRound=='4'){
				$opening1stCallDate = '0000-00-00';
				$actual1stCallDeadline = '0000-00-00';

				$opening2ndCallDate = '0000-00-00';
				$actual2ndCallDeadline = '0000-00-00';

				$opening3rdCallDate = '0000-00-00';
				$actual3rdCallDeadline = '0000-00-00';

				$opening4thCallDate = $openingDate;
				$actual4thCallDeadline = $actualDeadline;
			}

			$addProDetail = "INSERT INTO `italy_add_programs_details".$_SESSION['dbNo']."` (`italy_add_pro_id`, `italy_ad_uni_name`, `italy_ad_degree`, `italy_ad_program_name`, `italy_ad_cgpa`, `italy_ad_instruction`, `italy_ad_application_fee`, `italy_ad_round`, `italy_ad_current_round`, `italy_ad_english_pro`, `italy_ad_ielts_pte`, `italy_ad_sop_required`, `italy_ad_sop_note`, `italy_ad_tuition_fee`, `italy_ad_degree_required`, `italy_ad_recommendation`, `italy_ad_normal_cv`,`italy_ad_europass_cv`, `italy_ad_before_tolc`, `italy_ad_before_tolc_note`, `italy_ad_after_tolc`, `italy_ad_after_tolc_note`, `italy_ad_before_cimea`, `italy_ad_after_cimea`, `italy_ad_test_interview`, `italy_ad_curriculum`, `italy_ad_1st_opening_date`, `italy_ad_1st_actual_date`, `italy_ad_2nd_opening_date`, `italy_ad_2nd_actual_date`, `italy_ad_3rd_opening_date`, `italy_ad_3rd_actual_date`, `italy_ad_4th_opening_date`, `italy_ad_4th_actual_date`, `italy_ad_degree_acceptable`, `italy_ad_client_pre_degree`, `italy_ad_note_head`, `italy_ad_status`, `italy_ad_intake`, `close`, `status`, `entry_by`) VALUES ('".$updateID."', '".$uniName."', '".$uniDegree."', '".$programName."', '".$proCGPAPer."', '".$prolanguageInstruction."', '".$proAppFee."', '".$proRound."', '".$proCurrentRound."', '".$proEngProfAccept."', '".$proIELTSPTE."', '".$proSOPRequired."', '".$proSOPNote."', '".$proTuitionFee."', '".$proDegreeRequired."', '".$proRecommendation."', '".$proNormalCV."', '".$proEuropassCV."', '".$proBeforeTolc."', '".$proBeforeTolcNote."', '".$proAfterTolc."', '".$proAfterTolcNote."', '".$probeforeCimea."', '".$proAfterCimea."', '".$protextInterview."', '".$proCurriculum."', '".$opening1stCallDate."', '".$actual1stCallDeadline."', '".$opening2ndCallDate."', '".$actual2ndCallDeadline."', '".$opening3rdCallDate."', '".$actual3rdCallDeadline."', '".$opening4thCallDate."', '".$actual4thCallDeadline."', '".$degreeAcceptable."', '".$clientPreDegJSON."', '".$proNoteHead."', '1', '2026', '1', '1', '".$_SESSION['uname']."')";
			$addProDetail_ex = mysqli_query($con,$addProDetail);
		}
	}
	if($insertPro_ex){
		echo "<script>
		document.addEventListener('DOMContentLoaded', function() {
			Swal.fire({
				title: 'Updated!',
				text: 'Programs Updated Successfully.',
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
		echo "<div class='alert alert-secondary'>
			<strong>There is an error in the query2!</strong>
		</div>";
	}
}

?>