<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="form-group col-md-12">
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro1" onclick="checkProgramUni('1');"><i class="mdi mdi-eye"></i> 1st Call</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro2" onclick="checkProgramUni('2');"><i class="mdi mdi-eye"></i> 2nd Call</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro3" onclick="checkProgramUni('3');"><i class="mdi mdi-eye"></i> 3rd Call</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro4" onclick="checkProgramUni('4');"><i class="mdi mdi-eye"></i> 4th Call</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro5" onclick="checkProgramUni('5');"><i class="mdi mdi-eye"></i> Closing in 30 Days</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro6" onclick="checkProgramUni('6');"><i class="mdi mdi-eye"></i> Add Programs</button>
				</div>
				<div class="float-left">
					<button type="button" class="btn btn-purple btn-lg mr-1" id="btnPro7" onclick="checkProgramUni('7');"><i class="mdi mdi-eye"></i> Add or Del Universities</button>
				</div>
			</div>
		</div>

		<div id="showPrograms" style="display: none;">
			<?php 
			if (!isset($_GET['page-number-pro']) || $_GET['page-number-pro']=='undefined') {
				$pageNoPro=1;
			} else {
				$pageNoPro=$_GET['page-number-pro'];
			}
			?>
			<div class="row">
				<input type="hidden" name="page-number-pro" value="<?php echo $pageNoPro;?>" id="page-number-pro">
				<input type="hidden" name="" value="2025" id="proIntake">
				<input type="hidden" name="" value="1" id="proCall">
				<div class="form-group col-md-6 col-lg-4">
					<label>University</label>
					<select class="form-control" data-toggle="select2" name="university-name" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="university-name">
						<option value="all" <?= isset($_GET['university-name']) && $_GET['university-name'] == 'all' ? 'selected' : '' ?>>All</option>
						<?php
						$uniDetails = "SELECT * FROM italy_add_universities".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_uni_intake='2025' GROUP BY italy_uni_name ORDER BY italy_add_id ASC";
						$uniDetails_ex = mysqli_query($con, $uniDetails);
						while ($rowMB = mysqli_fetch_assoc($uniDetails_ex)) {
							$selected = (isset($_GET['university-name']) && $_GET['university-name'] == $rowMB['italy_uni_name']) ? 'selected' : '';
							?>
							<option value="<?php echo $rowMB['italy_uni_name'];?>" <?php echo $selected; ?>> <?php echo $rowMB['italy_uni_name'];?> <?= ($rowMB['italy_uni_direct_apply'] == '1' ? "(DUA)" : "") . ($rowMB['italy_uni_pre_enrollment'] == '1' ? "(DPE)" : "") .  ($rowMB['italy_uni_dream_apply'] == '1' ? "(DA)" : ""); ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-2">
					<label>Degree</label>
					<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="client-degree"> 
						<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
						<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
						<option value="mbbs" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
						<option value="phd" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'phd' ? 'selected' : '' ?>>PHD</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Application Process</label>
					<select class="form-control" name="application-process" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="application-process"> 
						<option value="all" <?= isset($_GET['application-process']) && $_GET['application-process'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="Dream Apply" <?= isset($_GET['application-process']) && $_GET['application-process'] == 'Dream Apply' ? 'selected' : '' ?>>Dream Apply</option>
						<option value="Direct Apply" <?= isset($_GET['application-process']) && $_GET['application-process'] == 'Direct Apply' ? 'selected' : '' ?>>Direct Apply</option>
						<option value="Direct Pre Enrollment" <?= isset($_GET['application-process']) && $_GET['application-process'] == 'Direct Pre Enrollment' ? 'selected' : '' ?>>Direct Pre Enrollment</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Active University</label>
					<select class="form-control" name="active-uni" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="active-uni"> 
						<option value="all" <?= isset($_GET['active-uni']) && $_GET['active-uni'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="Active" <?= isset($_GET['active-uni']) && $_GET['active-uni'] == 'Active' ? 'selected' : '' ?>>Active</option>
						<option value="InActive" <?= isset($_GET['active-uni']) && $_GET['active-uni'] == 'InActive' ? 'selected' : '' ?>>InActive</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-6">
					<label>English Proficiency</label>
					<select class="form-control" name="english-proficiency" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="english-proficiency"> 
						<option value="all" <?= isset($_GET['english-proficiency']) && $_GET['english-proficiency'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="English Proficiency" <?= isset($_GET['english-proficiency']) && $_GET['english-proficiency'] == 'English Proficiency' ? 'selected' : '' ?>>English Proficiency letter accepted universities</option>
						<option value="Without English Proficiency" <?= isset($_GET['english-proficiency']) && $_GET['english-proficiency'] == 'Without English Proficiency' ? 'selected' : '' ?>>IELTS, Duolingo, and other test accepted universities</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>SOP</label>
					<select class="form-control" name="check-sop" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="check-sop"> 
						<option value="all" <?= isset($_GET['check-sop']) && $_GET['check-sop'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="SOP Required" <?= isset($_GET['check-sop']) && $_GET['check-sop'] == 'SOP Required' ? 'selected' : '' ?>>SOP Required</option>
						<option value="Without SOP" <?= isset($_GET['check-sop']) && $_GET['check-sop'] == 'Without SOP' ? 'selected' : '' ?>>Without SOP</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>OverAll Call</label>
					<select class="form-control" data-toggle="select2" name="overall-round" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="overall-round">
						<option value="all" <?= isset($_GET['overall-round']) && $_GET['overall-round'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="1" <?= isset($_GET['overall-round']) && $_GET['overall-round'] == '1' ? 'selected' : '' ?>>1st</option>
						<option value="2" <?= isset($_GET['overall-round']) && $_GET['overall-round'] == '2' ? 'selected' : '' ?>>2nd</option>
						<option value="3" <?= isset($_GET['overall-round']) && $_GET['overall-round'] == '3' ? 'selected' : '' ?>>3rd</option>
						<option value="4" <?= isset($_GET['overall-round']) && $_GET['overall-round'] == '4' ? 'selected' : '' ?>>4th</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>CGPA & %</label>
					<select class="form-control" data-toggle="select2" name="cgpa-per" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="cgpa-per">
						<option value="all" <?= isset($_GET['cgpa-per']) && $_GET['cgpa-per'] == 'all' ? 'selected' : '' ?>>All</option>
						<?php
						$cgpaDetails = "SELECT italy_ad_cgpa FROM italy_add_programs_details".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND italy_ad_intake='2025' GROUP BY italy_ad_cgpa ORDER BY FIELD(italy_ad_cgpa, '2.0') DESC, italy_ad_cgpa ASC";
						$cgpaDetails_ex = mysqli_query($con, $cgpaDetails);
						while ($rowCGPA = mysqli_fetch_assoc($cgpaDetails_ex)) {
							$selected = (isset($_GET['cgpa-per']) && $_GET['cgpa-per'] == $rowCGPA['italy_ad_cgpa']) ? 'selected' : '';
							?>
							<option value="<?php echo $rowCGPA['italy_ad_cgpa'];?>" <?php echo $selected; ?>> <?php echo $rowCGPA['italy_ad_cgpa'];?> </option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Application Fee</label>
					<select class="form-control" name="application-fee" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="application-fee">
						<option value="all" <?= isset($_GET['application-fee']) && $_GET['application-fee'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="With Application Fee Universities" <?= isset($_GET['application-fee']) && $_GET['application-fee'] == 'With Application Fee Universities' ? 'selected' : '' ?>>With Application Fee Universities</option>
						<option value="Without Application Fee Universities" <?= isset($_GET['application-fee']) && $_GET['application-fee'] == 'Without Application Fee Universities' ? 'selected' : '' ?>>Without Application Fee Universities</option>
					</select>
				</div>
				<!-- <div class="form-group col-md-6 col-lg-3">
					<label>IELTS</label>
					<select class="form-control" name="check-IELTS" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="check-IELTS"> 
						<option value="all" <?= isset($_GET['check-IELTS']) && $_GET['check-IELTS'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="IELTS Required" <?= isset($_GET['check-IELTS']) && $_GET['check-IELTS'] == 'IELTS Required' ? 'selected' : '' ?>>IELTS Required</option>
						<option value="Without IELTS" <?= isset($_GET['check-IELTS']) && $_GET['check-IELTS'] == 'Without IELTS' ? 'selected' : '' ?>>Without IELTS</option>
					</select>
				</div> -->
				
				<div class="form-group col-md-6 col-lg-3">
					<label>Opening Date From</label>
					<input type="date" name="opening-date-from" required="required" class="form-control" value="<?= isset($_GET['opening-date-from']) ? $_GET['opening-date-from'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="opening-date-from">
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Opening Date To</label>
					<input type="date" name="opening-date-to" required="required" class="form-control" value="<?= isset($_GET['opening-date-to']) ? $_GET['opening-date-to'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="opening-date-to">
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Actual Deadline From</label>
					<input type="date" name="actual-date-from" required="required" class="form-control" value="<?= isset($_GET['actual-date-from']) ? $_GET['actual-date-from'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="actual-date-from">
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Actual Deadline To</label>
					<input type="date" name="actual-date-to" required="required" class="form-control" value="<?= isset($_GET['actual-date-to']) ? $_GET['actual-date-to'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="actual-date-to">
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Sale Deadline From</label>
					<input type="date" name="sale-date-from" required="required" class="form-control" value="<?= isset($_GET['sale-date-from']) ? $_GET['sale-date-from'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="sale-date-from">
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Sale Deadline To</label>
					<input type="date" name="sale-date-to" required="required" class="form-control" value="<?= isset($_GET['sale-date-to']) ? $_GET['sale-date-to'] : ''; ?>" onchange="viewClientsFilterPro(1)" id="sale-date-to">
				</div>
				<div class="form-group col-md-6 col-lg-6">
					<label>Client's Previous Degree</label>
					<select class="form-control" data-toggle="select2" name="pre-client-degree" required="required" autocomplete="off" onchange="viewClientsFilterPro(1)" id="pre-client-degree">
						<option value="all" <?= isset($_GET['pre-client-degree']) && $_GET['pre-client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
						<?php
						$preDetails = "SELECT pre_degree_name FROM previous_client_degrees WHERE status='1' AND close='1' ";
						$preDetails_ex = mysqli_query($con, $preDetails);
						while ($rowPre = mysqli_fetch_assoc($preDetails_ex)) {
							$selected = (isset($_GET['pre-client-degree']) && $_GET['pre-client-degree'] == $rowPre['pre_degree_name']) ? 'selected' : '';
							?>
							<option value="<?php echo $rowPre['pre_degree_name'];?>" <?php echo $selected; ?>> <?php echo ucwords($rowPre['pre_degree_name']);?> </option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-md-12">
					<div class="float-right">
						<button type="button" class="btn btn-primary btn-sm" onclick="addProgramsNew('addNew');"><i class="mdi mdi-plus-circle"></i> Add New Program</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="dataTables_length" id="datatable_length">
						<label>Show 
							<select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm" onchange="viewClientsFilterPro(1)" id="selectPage">
								<!-- <option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option> -->
								<option value="200">200</option>
								<option value="500">500</option>
							</select> 
						entries</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="float-right">
						<label>Search:<input type="text" name="" class="form-control form-control-sm" onkeyup="viewClientsFilterPro(1)" id="clientIDGet" style="margin-left: 0.5em; display: inline-block; width: auto;"></label>
					</div>
				</div>
			</div>
			<div id="loader" style="display: none;">
				<div class="loader">
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
				</div>
			</div>
			<!-- show data from model name start from view -->
			<div id="showClientsModelPro"></div>
			<!-- Fixed Bottom Scrollbar synced with the table -->
			<div class="bottom-scrollbar">
				<div class="bottom-scrollbar-content" id="bottom-scrollbar-content">
					<div id="scrollbar-content-width" style="height: 3px; width: 300rem;"></div>
				</div>
			</div>
		</div>

		<div id="showUni" style="display: none;">
			<?php 
			if (!isset($_GET['page-number-uni']) || $_GET['page-number-uni']=='undefined') {
				$pageNo=1;
			} else {
				$pageNo=$_GET['page-number-uni'];
			}
			?>
			<div class="row">
				<input type="hidden" name="page-number-uni" value="<?php echo $pageNo;?>" id="page-number-uni">
				<input type="hidden" name="" value="2025" id="uniIntake-uni">
				<div class="form-group col-md-6 col-lg-3">
					<label>Application Process</label>
					<select class="form-control" name="application-process-uni" required="required" autocomplete="off" onchange="viewClientsFilterUni(1)" id="application-process-uni">
						<option value="all" <?= isset($_GET['application-process-uni']) && $_GET['application-process-uni'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="Direct Apply" <?= isset($_GET['application-process-uni']) && $_GET['application-process-uni'] == 'Direct Apply' ? 'selected' : '' ?>>Direct Apply</option>
						<option value="Direct Pre Enrollment" <?= isset($_GET['application-process-uni']) && $_GET['application-process-uni'] == 'Direct Pre Enrollment' ? 'selected' : '' ?>>Direct Pre Enrollment</option>
						<option value="Dream Apply" <?= isset($_GET['application-process-uni']) && $_GET['application-process-uni'] == 'Dream Apply' ? 'selected' : '' ?>>Dream Apply</option>
					</select>
				</div>
				<div class="form-group col-md-6 col-lg-3">
					<label>Degree</label>
					<select class="form-control" name="client-degree-uni" required="required" autocomplete="off" onchange="viewClientsFilterUni(1)" id="client-degree-uni"> 
						<option value="all" <?= isset($_GET['client-degree-uni']) && $_GET['client-degree-uni'] == 'all' ? 'selected' : '' ?>>All</option>
						<option value="bachelor" <?= isset($_GET['client-degree-uni']) && $_GET['client-degree-uni'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
						<option value="master" <?= isset($_GET['client-degree-uni']) && $_GET['client-degree-uni'] == 'master' ? 'selected' : '' ?>>Master</option>
						<option value="mbbs" <?= isset($_GET['client-degree-uni']) && $_GET['client-degree-uni'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
						<option value="phd" <?= isset($_GET['client-degree-uni']) && $_GET['client-degree-uni'] == 'phd' ? 'selected' : '' ?>>PHD</option>
					</select>
				</div>
				<div class="form-group col-md-6">
					<div class="float-right mt-4">
						<button type="button" class="btn btn-primary btn-sm" onclick="addNewUni('added');"></i> Add New University</button>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-6">
					<div class="dataTables_length" id="datatable_length">
						<label>Show 
							<select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm" onchange="viewClientsFilterUni(1)" id="selectPage-uni">
								<!-- <option value="10">10</option>
								<option value="25">25</option>
								<option value="50">50</option>
								<option value="100">100</option> -->
								<option value="200">200</option>
								<option value="500">500</option>
							</select> 
						entries</label>
					</div>
				</div>
				<div class="col-md-6">
					<div class="float-right">
						<label>Search:<input type="text" name="" class="form-control form-control-sm" onkeyup="viewClientsFilterUni(1)" id="clientIDGet-uni" style="margin-left: 0.5em; display: inline-block; width: auto;"></label>
					</div>
				</div>
			</div>
			<div id="loader" style="display: none;">
				<div class="loader">
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
					<div class="inner_loader"></div>
				</div>
			</div>
			<!-- show data from model name start from view -->
			<div id="showClientsModelUni"></div>

		</div>
	</div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showModalClient" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title showModalTitle" id="myLargeModalLabel"></h4>
			</div>
			<div class="modal-body showModalClient">

			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="../assets/js/jquery-v3.6.0.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		checkProgramUni(1);
	});
	function checkProgramUni(id) {
		// Reset background color for all #btnPro buttons (1 to 7)
		for (var i = 1; i <= 7; i++) {
			$("#btnPro" + i).css("background-color", "");
		}
		if (id >= 1 && id <= 6) {
			$("#showPrograms").css("display", "block");
			$("#showUni").css("display", "none");
			$("#btnPro" + id).css("background-color", "green");
			viewClientsFilterPro(1, id);
			$("#proCall").val(id);
		} else if (id== 7){
			$("#showPrograms").css("display", "none");
			$("#showUni").css("display", "block");
			$("#btnPro" + id).css("background-color", "green");
			viewClientsFilterUni(1);
		}
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var pageUni = $("#page-number-uni").val();
		viewClientsFilterUni(pageUni);
	});
	function viewClientsFilterUni(pageUni) {
		var uniIntake = $("#uniIntake-uni").val();
		var appProcess = $("#application-process-uni").val();
		var clientDegree = $("#client-degree-uni").val();
		
		var selectPage = $("#selectPage-uni").val();
		var pageNo = pageUni || $("#page-number-uni").val();
		$("#page-number-uni").val(pageNo);
		var clientIDGet = $("#clientIDGet-uni").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (appProcess!=='all') {
			params.set('application-process-uni', appProcess);
		}else{
			params.delete('application-process-uni');
		}
		if (clientDegree!=='all' ) {
			params.set('client-degree-uni', clientDegree);
		}else{
			params.delete('client-degree-uni');
		}
		if (pageNo == 1) {
			params.delete('page-number-uni', pageNo);
		} else {
			params.set('page-number-uni', pageNo);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else{
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModelUni").hide();
		// Perform the AJAX request
		$.ajax({
			type: "POST",
			url: "models/viewAddUniversitiesModel.php",
			data: {
				checkuniIntake: uniIntake,
				checkappProcess: appProcess,
				checkclientDegree: clientDegree,
				pageNumber: pageNo,
				checkclientDetails: clientIDGet,
				checkselectPage: selectPage,
			},
			success: function(data) {
				// alert(data);
				$("#loader").hide();
				$("#showClientsModelUni").html(data);
				$("#showClientsModelUni").show();
			}
		});
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		var pagePro = $("#page-number-pro").val();
		var call = $("#proCall").val();
		viewClientsFilterPro(pagePro, call);
	});
	function viewClientsFilterPro(pagePro, call) {
		var uniName = $("#university-name").val();
		var clientDegree = $("#client-degree").val();
		var applicationProcess = $("#application-process").val();
		var activeUni = $("#active-uni").val();
		var englishProficiency = $("#english-proficiency").val();
		var checkSop = $("#check-sop").val();
		var overallRound = $("#overall-round").val();
		var cgpaPer = $("#cgpa-per").val();
		var applicationFee = $("#application-fee").val();
		// var checkIELTS = $("#check-IELTS").val();
		var openingDateFrom = $("#opening-date-from").val();
		var openingDateTo = $("#opening-date-to").val();
		var actualDateFrom = $("#actual-date-from").val();
		var actualDateTo = $("#actual-date-to").val();
		var saleDateFrom = $("#sale-date-from").val();
		var saleDateTo = $("#sale-date-to").val();
		var preClientDegree = $("#pre-client-degree").val();
		
		var proCall = call || $("#proCall").val();
		var proIntake = $("#proIntake").val();
		var selectPage = $("#selectPage").val();
		var pageNoPro = pagePro || $("#page-number-pro").val();
		$("#page-number-pro").val(pageNoPro);
		var clientIDGet = $("#clientIDGet").val();
		// Create URLSearchParams object
		var params = new URLSearchParams(window.location.search);
		if (uniName!=='all') {
			params.set('university-name', uniName);
		}else{
			params.delete('university-name');
		}
		if (clientDegree!=='all') {
			params.set('client-degree', clientDegree);
		}else{
			params.delete('client-degree');
		}
		if (applicationProcess!=='all') {
			params.set('application-process', uniName);
		}else{
			params.delete('application-process');
		}
		if (activeUni!=='all') {
			params.set('active-uni', activeUni);
		}else{
			params.delete('active-uni');
		}
		if (englishProficiency!=='all') {
			params.set('english-proficiency', englishProficiency);
		}else{
			params.delete('english-proficiency');
		}
		if (checkSop!=='all') {
			params.set('check-sop', checkSop);
		}else{
			params.delete('check-sop');
		}
		if (overallRound!=='all') {
			params.set('overall-round', overallRound);
		}else{
			params.delete('overall-round');
		}
		if (cgpaPer!=='all') {
			params.set('cgpa-per', cgpaPer);
		}else{
			params.delete('cgpa-per');
		}
		if (applicationFee!=='all') {
			params.set('application-fee', applicationFee);
		}else{
			params.delete('application-fee');
		}
		// if (checkIELTS!=='all') {
		// 	params.set('check-IELTS', checkIELTS);
		// }else{
		// 	params.delete('check-IELTS');
		// }
		if (openingDateFrom && openingDateTo) {
			params.set('opening-date-from', openingDateFrom);
			params.set('opening-date-to', openingDateTo);
		}else{
			params.delete('opening-date-from');
			params.delete('opening-date-to');
		}
		if (actualDateFrom && actualDateTo) {
			params.set('actual-date-from', actualDateFrom);
			params.set('actual-date-to', actualDateTo);
		}else{
			params.delete('actual-date-from');
			params.delete('actual-date-to');
		}
		if (saleDateFrom && saleDateTo) {
			params.set('sale-date-from', saleDateFrom);
			params.set('sale-date-to', saleDateTo);
		}else{
			params.delete('sale-date-from');
			params.delete('sale-date-to');
		}
		if (preClientDegree!=='all') {
			params.set('pre-client-degree', preClientDegree);
		}else{
			params.delete('pre-client-degree');
		}
		if (pageNoPro == 1) {
			params.delete('page-number-pro', pageNoPro);
		}else{
			params.set('page-number-pro', pageNoPro);
		}
		// Update the URL only if there are any parameters set
		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else{
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}
		$("#loader").show();
		$("#showClientsModelPro").hide();
		// Perform the AJAX request
		$.ajax({
			type: "POST",
			url: "models/viewAddProgramsModel.php",
			data: {
				checkuniName: uniName,
				checkclientDegree: clientDegree,
				checkapplicationProcess: applicationProcess,
				checkactiveUni: activeUni,
				checkenglishProficiency: englishProficiency,
				checkcheckSop: checkSop,
				checkoverallRound: overallRound,
				checkcgpaPer: cgpaPer,
				checkapplicationFee: applicationFee,
				checkopeningDateFrom: openingDateFrom,
				checkopeningDateTo: openingDateTo,
				checkactualDateFrom: actualDateFrom,
				checkactualDateTo: actualDateTo,
				checksaleDateFrom: saleDateFrom,
				checksaleDateTo: saleDateTo,
				checkpreClientDegree: preClientDegree,
				
				checkproCall: proCall,
				checkproIntake: proIntake,
				pageNumber: pageNoPro,
				checkclientDetails: clientIDGet,
				checkselectPage: selectPage,
			},
			success: function(data) {
				// alert(data);
				$("#loader").hide();
				$("#showClientsModelPro").html(data);
				$("#showClientsModelPro").show();
				reinitializeScripts();
			}
		});
	}
</script>
<?php 
include ("js-helpers/addNewUniversities.php");
include ("js-helpers/addNewPrograms.php");
?>

<script type="text/javascript">
	function proViewTable(id) {
		var id = id;
		$("#showProTable"+id+"").toggle();
	}
</script>