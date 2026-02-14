<?php
ob_start();
session_start();
include_once("../env/main-config.php");
include_once('models/selectFunction.php');
include_once('models/escape.php');
$uniName = $_GET['checkuniName'];
$clientDegree = $_GET['checkclientDegree'];
$activeUni = $_GET['checkactiveUni'];
$englishProficiency = $_GET['checkenglishProficiency'];
$checkSop = $_GET['checkcheckSop'];
$overallRound = $_GET['checkoverallRound'];
$cgpaPer = $_GET['checkcgpaPer'];
$applicationFee = $_GET['checkapplicationFee'];
$intake = $_GET['checkintake'];
$appProcess = $_GET['checkappProcess'];
$openingDateFrom = $_GET['checkopeningDateFrom'];
$openingDateTo = $_GET['checkopeningDateTo'];
$actualDateFrom = $_GET['checkactualDateFrom'];
$actualDateTo = $_GET['checkactualDateTo'];
$saleDateFrom = $_GET['checksaleDateFrom'];
$saleDateTo = $_GET['checksaleDateTo'];
$preClientDegree = $_GET['checkpreClientDegree'];
$proIntake = $_GET['checkproIntake'];
$proCall = $_GET['checkproCall'];
$clientDetails = $_GET['checkclientDetails'];

$current_date = date('d-m-Y');	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Austria-<?php echo e(ucwords($clientDegree));?>-Programs-(<?php echo $current_date;?>)</title>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<style type="text/css">
		@page {
			margin: 31px;
		}
		@media print {
			body::before{
				display: none;
			}
		}
		body::after {
			content: "";
			position: fixed;
			top: 50%;
			left: 50%;
			width: 60%;
			height: 60%;
			background: url("../images/<?php echo $_SESSION['com_logo']; ?>") no-repeat center center;
			background-size: contain;
			opacity: 0.09;
			transform: translate(-50%, -50%);
			z-index: 1;
		}
		body{
			color: #000!important;
			font-size: 20px;
		}
		table,td{
			color: #000!important;
		}
		@media print {
			* {
				-webkit-print-color-adjust: exact;
				print-color-adjust: exact;
			}
		}
	</style>
	<div class="card">
		<div class="card-body">
			<div class="float-right font-weight-bold" style="font-size: 24px;"><span><?php echo date('d-M-Y'); ?></span></div>
			<div class="row">
				<div class="col-md-3" style="width: 30%">
					<img src="<?php echo "../images/".$_SESSION['com_logo'] ?>" height="140px" width="140px">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div style="display: flex; justify-content: center; align-items: center;">
						<h3 style="display: flex; align-items: center; margin-right: 10px;">
							AUSTRIA <?php echo e(strtoupper($clientDegree)); ?> PROGRAMS
						</h3>
						<img src="../images/austria-flag.png" style="height: 30px; width: 50px;">
					</div>
				</div>
				<?php
				$whereCondition = "aap.close='1' AND aap.status='1' AND aapd.close='1' AND aapd.status='1' AND aap.aus_active_status='1' ";
				if($proCall=='1'){
					$whereCondition .= "AND aapd.aus_ad_intake='March'  ";
				}
				if($proCall=='2'){
					$whereCondition .= "AND aapd.aus_ad_intake='October' ";
				}
				if($proCall=='3'){
					$whereCondition .= "AND aapd.aus_ad_intake='March / October' ";
				}
				if($proCall=='5'){
					$whereCondition .= "AND (aapd.aus_ad_current_round < aapd.aus_ad_round) AND ( (aapd.aus_ad_1st_actual_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) OR (aapd.aus_ad_2nd_actual_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)) ) ";
				}

				if ($uniName!="all") {
					$whereCondition .= " AND aap.aus_ap_uni_name='".$uniName."' ";
				}
				if ($clientDegree!="all") {
					$whereCondition .= " AND aap.aus_ap_degree='".$clientDegree."' ";
				}

				if ($activeUni!="all") {
					if($activeUni=='Active'){
						$whereCondition .= " AND aap.aus_active_status='1' ";
					}
					if($activeUni=='InActive'){
						$whereCondition .= " AND aap.aus_active_status='0' ";
					}
				}
				if($englishProficiency=="English Proficiency"){
					$whereCondition .= "AND aapd.aus_ad_english_pro='1' ";
				}
				if($englishProficiency=="Without English Proficiency"){
					$whereCondition .= "AND aapd.aus_ad_english_pro='0' ";
				}
				if($checkSop=="SOP Required"){
					$whereCondition .= "AND aapd.aus_ad_sop_required='1' ";
				}
				if($checkSop=="Without SOP"){
					$whereCondition .= "AND aapd.aus_ad_sop_required='0' ";
				}
				if($overallRound!="all"){
					$whereCondition .= "AND aapd.aus_ad_round='".$overallRound."' ";
				}
				if($cgpaPer!="all"){
					$whereCondition .= "AND aapd.aus_ad_cgpa<='".$cgpaPer."' ";
				}
				if($applicationFee=="With Application Fee Universities"){
					$whereCondition .= "AND (aapd.aus_ad_application_fee!='0' AND aapd.aus_ad_application_fee!='N/A') ";
				}
				if($applicationFee=="Without Application Fee Universities"){
					$whereCondition .= "AND (aapd.aus_ad_application_fee='0' || aapd.aus_ad_application_fee='N/A') ";
				}

				if ($intake!="all") {
					$whereCondition .= " AND aapd.aus_ad_intake='".$intake."' ";
				}
				if ($appProcess!="all") {
					$whereCondition .= " AND aapd.aus_ad_application_process='".$appProcess."' ";
				}
				if($openingDateFrom!="" && $openingDateTo!=""){
					$whereCondition .= "AND (aapd.aus_ad_1st_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo' OR aapd.aus_ad_2nd_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo') ";
				}
				if($actualDateFrom!="" && $actualDateTo!=""){
					$whereCondition .= "AND (aapd.aus_ad_1st_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo' OR aapd.aus_ad_2nd_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo') ";
				}
				if($saleDateFrom != "" && $saleDateTo != ""){
					$whereCondition .= "AND (aapd.aus_ad_1st_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY) OR aapd.aus_ad_2nd_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY)) ";
				}
				if ($preClientDegree != "all") {
					$whereCondition .= " AND JSON_CONTAINS(aapd.aus_ad_client_pre_degree, '\"$preClientDegree\"') ";
				}
				if($clientDetails=='' || $clientDetails!=''){
					$whereCondition .= " AND (aap.aus_ap_uni_name LIKE '%".$clientDetails."%' OR aap.aus_ap_degree LIKE '%".$clientDetails."%' ) ";
				}

				$clientData = "SELECT aap.aus_ap_id, aap.aus_ap_uni_name, aap.aus_ap_degree, aap.aus_ap_note, aap.aus_active_status, MIN(aapd.aus_ad_cgpa) AS min_cgpa FROM austria_add_programs".$_SESSION['dbNo']." AS aap JOIN austria_add_programs_details".$_SESSION['dbNo']." AS aapd ON aap.aus_ap_id = aapd.aus_add_pro_id WHERE $whereCondition GROUP BY aap.aus_ap_id ORDER BY CASE WHEN aap.aus_active_status = 1 THEN 0 ELSE 1 END, min_cgpa ASC";
				$clientData_ex = mysqli_query($con,$clientData);
				
				while ($row = mysqli_fetch_assoc($clientData_ex)) {
					$clitalyProg = "SELECT aus_uni_program_select, aus_uni_degree, aus_uni_status, aus_uni_admission_valid from austria_add_universities".$_SESSION['dbNo']." WHERE aus_uni_name='".$row['aus_ap_uni_name']."' AND aus_uni_degree='".$row['aus_ap_degree']."' AND close='1' AND status='1'";
					$clCountProg = mysqli_query($con,$clitalyProg);
					$progNumb = mysqli_fetch_assoc($clCountProg);
				?>
				<div class="col-md-12 text-center">
					<span style="background-color: lightgray; display: flex; justify-content: center; align-items: center; padding: 10px 0; font-weight: bold; font-size: 24px;">
						<?php
						preg_match('/\((.*?)\)/', $row['aus_ap_uni_name'], $matches);
						echo e(strtoupper($matches[1] ?? $row['aus_ap_uni_name']));
						echo ' ';
						echo e(ucwords($progNumb['aus_uni_status']) ?? '');
						?>
					</span>
				</div>
				<div class="col-md-12">
				 	<table class="table table-bordered nowrap text-center">
				 		<thead >
				 			<tr>
				 				<th width="4%">Sr</th>
				 				<th width="14%">Program Name</th>
				 				<th width="10%">CGPA / %</th>
				 				<th width="6%">Instruction</th>
				 				<th width="13%">Application Fee</th>
				 				<th width="19%">English Proficiency</th>
				 				<th width="14%">Legalized Documents</th>
				 				<th width="14%">Application Process</th>
				 				<th width="6%">Intake</th>
				 			</tr>
				 		</thead>
				 		<tbody>
				 			<?php 
				 			$whereDetCondition = "close='1' AND status='1' AND aus_ad_status='1' AND aus_add_pro_id='".$row['aus_ap_id']."'  ";

				 			if($englishProficiency=="English Proficiency"){
								$whereDetCondition .= "AND aus_ad_english_pro='1' ";
							}
							if($englishProficiency=="Without English Proficiency"){
								$whereDetCondition .= "AND aus_ad_english_pro='0' ";
							}
							if($checkSop=="SOP Required"){
								$whereDetCondition .= "AND aus_ad_sop_required='1' ";
							}
							if($checkSop=="Without SOP"){
								$whereDetCondition .= "AND aus_ad_sop_required='0' ";
							}
							if($overallRound!="all"){
								$whereDetCondition .= "AND aus_ad_round='".$overallRound."' ";
							}
							if($cgpaPer!="all"){
								$whereDetCondition .= "AND aus_ad_cgpa<='".$cgpaPer."' ";
							}
							if($applicationFee=="With Application Fee Universities"){
								$whereCondition .= "AND (aus_ad_application_fee!='0' AND aus_ad_application_fee!='N/A') ";
							}
							if($applicationFee=="Without Application Fee Universities"){
								$whereCondition .= "AND (aus_ad_application_fee='0' || aus_ad_application_fee='N/A') ";
							}
							
							if($proCall=='1' || $proCall=='2'){
								$whereDetCondition .= "AND aus_ad_current_round='".$proCall."' ";
							}
							if($intake!="all"){
								$whereDetCondition .= "AND aus_ad_intake='".$intake."' ";
							}
							if ($appProcess!="all") {
								$whereDetCondition .= " AND aus_ad_application_process='".$appProcess."' ";
							}
							if($openingDateFrom!="" && $openingDateTo!=""){
								$whereDetCondition .= "AND (aus_ad_1st_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo' OR aus_ad_2nd_opening_date BETWEEN '$openingDateFrom' AND '$openingDateTo') ";
							}
							if($actualDateFrom!="" && $actualDateTo!=""){
								$whereDetCondition .= "AND (aus_ad_1st_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo' OR aus_ad_2nd_actual_date BETWEEN '$actualDateFrom' AND '$actualDateTo') ";
							}
							if($saleDateFrom != "" && $saleDateTo != ""){
								$whereDetCondition .= "AND (aus_ad_1st_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY) OR aus_ad_2nd_actual_date BETWEEN DATE_ADD('$saleDateFrom', INTERVAL 12 DAY) AND DATE_ADD('$saleDateTo', INTERVAL 12 DAY)) ";
							}
							if ($preClientDegree != "all") {
								$whereDetCondition .= " AND JSON_CONTAINS(aus_ad_client_pre_degree, '\"$preClientDegree\"') ";
							}

				 			$proDetails = "SELECT * from austria_add_programs_details".$_SESSION['dbNo']." WHERE $whereDetCondition ORDER BY aus_ad_cgpa ASC";
				 			$proDetails_ex = mysqli_query($con,$proDetails);
				 			$ser=1;
				 			while ($rowDet = mysqli_fetch_assoc($proDetails_ex)) {
			 				?>
			 				<tr id="<?php echo $rowDet['aus_add_pro_id'];?>">
			 					<td><?php echo $ser;?></td>
			 					<td class="breakTD"><?php echo ucwords($rowDet['aus_ad_program_name']);?></td>
			 					<td><?php echo $rowDet['aus_ad_cgpa'];?></td>
			 					<td><?php echo $rowDet['aus_ad_instruction'];?></td>
			 					<td><?php echo $rowDet['aus_ad_application_fee'];?></td>
			 					<td class="breakTD">
			 						<?php if($rowDet['aus_ad_english_pro']=='1'){ ?>
			 							<span class="text-danger"><b>Without IELTS</b></span>
			 						<?php }else{ 
			 							echo $rowDet['aus_ad_ielts_pte'];
			 						} ?>
			 					</td>
			 					<td class="breakTD">
			 						<?php if ($rowDet['aus_ad_leg_document'] == '1' ) { ?>
			 							<span>Apply with legalized documents</span>
			 						<?php }else{ ?>
			 							<span class="text-danger"><b>Apply without legalized documents</b></span>
			 						<?php } ?>
			 					</td>
			 					<td><?php echo $rowDet['aus_ad_application_process'];?></td>
			 					<td><?php echo ucwords($rowDet['aus_ad_intake']);?></td>
			 				</tr>
			 				<?php $ser++;} ?>
			 			</tbody>
			 		</table>
			 	</div>
			 	<div class="col-md-12">
		 			<label style="font-weight: bold; font-size: 18px;">
		 				<span>How Many Programs Can You Select in This University? 
		 					<?php
		 					if (!empty($progNumb['aus_uni_program_select'])) {
		 						echo '<span style="color: red;">' . $progNumb['aus_uni_program_select'] . '</span>';
		 					} ?>
		 				</span>
		 			</label>
		 			<br>
		 			<label style="font-weight: bold; font-size: 18px;">
		 				<span style="color: red;">Note</span> 
		 				<span> (<?php preg_match('/\((.*?)\)/', $row['aus_ap_uni_name'], $matches); echo strtoupper($matches[1] ?? $row['aus_ap_uni_name']);?>) </span>
		 			</label>
		 			<span> <?php echo nl2br(trim(preg_replace('/\s+/', ' ',html_entity_decode(strip_tags($row['aus_ap_note'], '<ul><li><b><i><strong><br><p>'))))); ?></span>
		 		</div>
				<?php } ?>
			</div>
			<footer class="footer">
				<hr>
				<div class="row">
					<style type="text/css">
						.email-signature1{
							background: #fff;
							padding: 30px 0px 30px 20px;
							box-shadow: 0 0 15px -8px rgba(0,0,0,0.3);
							overflow: hidden;
							position: relative;
							z-index: 1;
						}
						.email-signature1:before{
							content: "";
							background: #034694;
							border-radius: 0 30px 30px 0;
							transform: skew(-10deg);
							position: absolute;
							bottom: 15px;
							top: 15px;
							left: -35px;
							right: 60px;
							z-index: -1;
						}
						
						.email-signature1 .signature-details{ margin: 0 0 20px; }
						.email-signature1 .title{
							color: #fff;
							font-size: 20px;
							font-weight: 700;
							/*text-transform: uppercase;*/
							letter-spacing: 0.5px;
							margin: 0 0 3px;
						}
						.email-signature1 .post{
							color: #034694;
							background: #ffd53f;
							font-size: 14px;
							font-weight: 500;
							text-transform: capitalize;
							letter-spacing: 1px;
							padding: 0 10px;
							display: inline-block;
						}
						.email-signature1 .signature-content{
							padding: 0;
							margin: 0;
							list-style: none;
						}
						.email-signature1 .signature-content li{
							color: #fff;
							font-size: 14px;
							margin-bottom: 7px;
						}
						.email-signature1 .signature-content li:last-child{ margin-bottom: 0; }
						.email-signature1 .signature-content li i{
							color: #034694;
							background: #ffd53f;
							font-size: 11px;
							text-align: center;
							line-height: 18px;
							width: 18px;
							height: 18px;
							margin: 0 6px 0 0;
							border-radius: 50%;
							display: inline-block;
						}
						.email-signature1 .icon{
							background-color: #ffd53f;
							padding: 7px 8px 2px;
							margin: 0;
							list-style: none;
							border-radius: 20px 20px 0 0;
							position: absolute;
							bottom: 0;
							right: 10px;
						}
						.email-signature1 .icon li{ margin: 5px 0; }
						.email-signature1 .icon li a{
							color: #fff;
							background-color: #034694;
							font-size: 12px;
							text-align: center;
							line-height: 23px;
							height: 23px;
							width: 23px;
							border-radius: 50%;
							display: block;
							transition: all 0.3s;
						}
					</style>
					<div class="col-md-6" style="width: 50%;">
						<div class="row">
							<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
								<div class="email-signature1">
									<div class="signature-details">
										<h2 class="title">WSL Consultants (PVT) LTD</h2>
										<span class="post">Head Office Lahore</span>
									</div>
									<ul class="signature-content">
										<li><i class="fa fa-map-marker"></i> Office No 12-13, 5th Floor Rakshanda Heights. Located near Orange Line Sabzazar Station <br> No 20, opposite Ravi Block, Allama Iqbal Town, Multan Road, Lahore. </li>
									</ul>
									<ul class="icon">
										<li><a href="#" class="fa fa-facebook-f"></a></li>
										<li><a href="#" class="fa fa-twitter"></a></li>
										<li><a href="#" class="fa fa-instagram"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6" style="width: 48%;">
						<div class="row">
							<div class="col-lg-offset-3 col-lg-6 col-md-offset-2 col-md-8">
								<div class="email-signature1">
									<div class="signature-details">
										<h2 class="title">WSL Management Consultancies Co. LLC</h2>
										<span class="post">Dubai Branch Office</span>
									</div>
									<ul class="signature-content">
										<li><i class="fa fa-map-marker"></i> Office No. 201-015, 2nd Floor, R308 Building (Adidas Building), Near Burjuman Mall, <br>Dubai- UAE P.O. Box 624699</li>
									</ul>
									<ul class="icon">
										<li><a href="#" class="fa fa-facebook-f"></a></li>
										<li><a href="#" class="fa fa-twitter"></a></li>
										<li><a href="#" class="fa fa-instagram"></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script type="text/javascript">
		window.print();
		window.onafterprint = function() {
			window.history.back();
		};
	</script>
</body>
</html>