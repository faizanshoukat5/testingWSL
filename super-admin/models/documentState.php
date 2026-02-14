<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['clientDocuments'])) {
	$clientID = $_POST['clientDocuments'];
	$select_query = "SELECT client_country, client_countryfrom from clients".$_SESSION['dbNo']." WHERE status = '1' AND close='1' AND client_id='".$clientID."' ";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $row) {
		$clientCountry = $row['client_country'];
	?>
	<form action="" method="POST" enctype="multipart/form-data" class="parsley-examples">
		<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
		<fieldset class="scheduler-border">
			<legend class="scheduler-border">
				Admission Documents <span class="text-danger">*</span>
			</legend>
			<button type="button" class="btn btn-custom mb-1" onclick="downloadZip(<?php echo $clientID;?>);">Download All Documents</button>
			<div class="table-responsive">
				<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
					<thead>
						<tr>
							<th width="10">Sr No</th>
							<th width="30%">Document Name</th>
							<th width="60%">File Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$clientData = "SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
						$clientData_ex = mysqli_query($con, $clientData);
						foreach ($clientData_ex as $docrow) {
							$admissionDoc1 = $docrow['admission_doc1'];
							$admissionDoc2 = $docrow['admission_doc2'];
							$admissionDoc3 = $docrow['admission_doc3'];
							$admissionDoc4 = $docrow['admission_doc4'];
							$admissionDoc5 = $docrow['admission_doc5'];
							$admissionDoc6 = $docrow['admission_doc6'];
							$admissionDoc7 = $docrow['admission_doc7'];
							$admissionDoc8 = $docrow['admission_doc8'];
							$admissionDoc9 = $docrow['admission_doc9'];
							$admissionDoc10 = $docrow['admission_doc10'];
							$admissionDoc11 = $docrow['admission_doc11'];
							$admissionDoc12 = $docrow['admission_doc12'];
							$admissionDoc13 = $docrow['admission_doc13'];
							$admissionDoc14 = $docrow['admission_doc14'];
							$admissionDoc15 = $docrow['admission_doc15'];
							$admissionDoc16 = $docrow['admission_doc16'];
							$admissionDoc17 = $docrow['admission_doc17'];
							$admissionDoc18 = $docrow['admission_doc18'];
							$admissionDoc19 = $docrow['admission_doc19'];
							$admissionDoc20 = $docrow['admission_doc20'];
							$admissionDoc21 = $docrow['admission_doc21'];
							$admissionDoc22 = $docrow['admission_doc22'];
							$admissionDoc23 = $docrow['admission_doc23'];
							$admissionDoc24 = $docrow['admission_doc24'];
							$admissionDoc25 = $docrow['admission_doc25'];
							$admissionDoc26 = $docrow['admission_doc26'];
							$admissionDoc27 = $docrow['admission_doc27'];
							$admissionDoc28 = $docrow['admission_doc28'];
							$admissionDoc29 = $docrow['admission_doc29'];
							$admissionDoc30 = $docrow['admission_doc30'];
							$admissionDoc31 = $docrow['admission_doc31'];
							$admissionDoc32 = $docrow['admission_doc32'];
							$admissionDoc33 = $docrow['admission_doc33'];

							$noteDetails = $docrow['note_details'];
							$noteAdmission = $docrow['note_admission'];
						}
						?>
						<!-- doc1 -->
						<tr>
							<td>1</td>
							<td>Matric result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc1)){?>
								<a href="../payagreements/<?php echo $admissionDoc1; ?>" target="_blank"><?php echo $admissionDoc1; ?></a>
							<?php }else{ ?>
								No Document Found
							<?php } ?>
							</td>
						</tr>
						<!-- doc2 -->
						<tr>
							<td>2</td>
							<td>Matric Certificate in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc2)){?>
								<a href="../payagreements/<?php echo $admissionDoc2;?>" target="_blank"><?php echo $admissionDoc2; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc3 -->
						<tr>
							<td>3</td>
							<td>Intermediate part 1 result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc3)){?>
								<a href="../payagreements/<?php echo $admissionDoc3;?>" target="_blank"><?php echo $admissionDoc3; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc4 -->
						<tr>
							<td>4</td>
							<td>Intermediate part 2 result card in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc4)){?>
								<a href="../payagreements/<?php echo $admissionDoc4;?>" target="_blank"><?php echo $admissionDoc4; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc5 -->
						<tr>
							<td>5</td>
							<td>Intermediate part Part 3 result card in PDF format , if applicable</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc5)){?>
								<a href="../payagreements/<?php echo $admissionDoc5;?>" target="_blank"><?php echo $admissionDoc5; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc6 -->
						<tr>
							<td>5</td>
							<td>Intermediate Certificate in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc6)){?>
								<a href="../payagreements/<?php echo $admissionDoc6;?>" target="_blank"><?php echo $admissionDoc6; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc7 -->
						<tr>
							<td>6</td>
							<td>Bachelor's all transcripts in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc7)){?>
								<a href="../payagreements/<?php echo $admissionDoc7;?>" target="_blank"><?php echo $admissionDoc7; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc8 -->
						<tr>
							<td>7</td>
							<td>Bachelor's all degree in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc8)){?>
								<a href="../payagreements/<?php echo $admissionDoc8;?>" target="_blank"><?php echo $admissionDoc8; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='canada' || $clientCountry=='USA') {
							
						}else{
						?>
						<!-- doc9 -->
						<tr>
							<td>9</td>
							<td>Master's all Transcript in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc9)){?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc10 -->
						<tr>
							<td>10</td>
							<td>Master's all degree in PDF format</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc10)){?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="_blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc11 -->
						<tr>
							<td>11</td>
							<td>English proficiency Letter from your last educational college/university PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc11)){?>
								<a href="../payagreements/<?php echo $admissionDoc11;?>" target="_blank"><?php echo $admissionDoc11; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc12 -->
						<tr>
							<td>12</td>
							<td>IELTS / PTE in PDF format (if applicable)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc12)){?>
								<a href="../payagreements/<?php echo $admissionDoc12;?>" target="_blank"><?php echo $admissionDoc12; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc13 -->
						<tr>
							<td>13</td>
							<td>Recommendation letters From your last educational college/university PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc13)){?>
								<a href="../payagreements/<?php echo $admissionDoc13;?>" target="_blank"><?php echo $admissionDoc13; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='canada' || $clientCountry=='USA') {
							
						}else{
						?>
						<!-- doc14 -->
						<tr>
							<td>14</td>
							<td>Student current Home Address</td>
							<td>
							<?php if (!empty($admissionDoc14)){?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc14;?>" target="_blank"><?php echo $admissionDoc14; ?></a> -->
								<?php echo $admissionDoc14;?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc15 -->
						<tr>
							<td>15</td>
							<td>New Email ID and Password & Email id which you are using (without password)</td>
							<td>
							<?php if (!empty($admissionDoc15)){?>
								<<!-- a href="../payagreements/<?php echo $admissionDoc15;?>" target="_blank"><?php echo $admissionDoc15; ?></a> -->
								<?php echo $admissionDoc15; ?>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc16 -->
						<tr>
							<td>16</td>
							<td>CV with new email id (PDF Format)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc16)){?>
								<a href="../payagreements/<?php echo $admissionDoc16;?>" target="_blank"><?php echo $admissionDoc16; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc17 -->
						<tr>
							<td>17</td>
							<td>One passport size Photo with white background JPG</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc17)){?>
								<a href="../payagreements/<?php echo $admissionDoc17;?>" target="_blank"><?php echo $admissionDoc17; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc18 -->
						<tr>
							<td>18</td>
							<td>Passport 1 st two pages Scan copy ( PDF Format )</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc18)){?>
								<a href="../payagreements/<?php echo $admissionDoc18;?>" target="_blank"><?php echo $admissionDoc18; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc19 -->
						<tr>
							<td>19</td>
							<td>ID Card front & Back scan copy (PDF Format)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc19)){?>
								<a href="../payagreements/<?php echo $admissionDoc19;?>" target="_blank"><?php echo $admissionDoc19; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						if ($clientCountry=='austria' || $clientCountry =='canada' || $clientCountry == 'USA') {
						?>
						<!-- doc20 -->
						<tr>
							<td>20</td>
							<td>Parents Detail (birth year, occupation and qualification)</td>
							<td>
							<?php if (!empty($admissionDoc20)){?>
								<a href="../payagreements/<?php echo $admissionDoc20;?>" target="_blank"><?php echo $admissionDoc20; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php
						}else{
						?>
						<!-- doc20 -->
						<tr>
							<td>20</td>
							<td>Skype Profile</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc20)){?>
								<a href="../payagreements/<?php echo $admissionDoc20;?>" target="_blank"><?php echo $admissionDoc20; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						}
						if ($clientCountry=='austria') {
						?>
						<!-- doc21 -->
						<tr>
							<td>21</td>
							<td>Course details instead of cost</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc21)){?>
								<a href="../payagreements/<?php echo $admissionDoc21;?>" target="_blank"><?php echo $admissionDoc21; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc22 -->
						<tr>
							<td>22</td>
							<td>Eligibility letter from university with registrar sign & stamp PDF</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc22)){?>
								<a href="../payagreements/<?php echo $admissionDoc22;?>" target="_blank"><?php echo $admissionDoc22; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php 
						}if ($clientCountry=='canada' || $clientCountry=='USA') {
						?>
						<!-- doc9 -->
						<tr>
							<td>9</td>
							<td>Parents Detail (ID card no. , House no. , contact no.)</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc9)){?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc10 -->
						<tr>
							<td>10</td>
							<td>Last three months Bank Statement with account maintenance letter in PDF.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc10)){?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="_blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc14 -->
						<tr>
							<td>14</td>
							<td>Relative Contact detail in case of Emergency.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc14)){?>
								<a href="../payagreements/<?php echo $admissionDoc14;?>" target="_blank"><?php echo $admissionDoc14; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc15 -->
						<tr>
							<td>15</td>
							<td>In case of Sponsor bank statement contact number, house address, email id, relation with sponsor.</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc15)){?>
								<a href="../payagreements/<?php echo $admissionDoc15;?>" target="_blank"><?php echo $admissionDoc15; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc 23 -->
						<tr>
							<td>23</td>
							<td>Details Word File</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc23)){?>
									<a href="../payagreements/<?php echo $admissionDoc23;?>" target="_blank"><?php echo $admissionDoc23; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc24 -->
						<tr>
							<td>24</td>
							<td>Thesis</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc24)){?>
								<a href="../payagreements/<?php echo $admissionDoc24;?>" target="_blank"><?php echo $admissionDoc24; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
						</tr>
						<!-- doc25 -->
						<tr>
							<td>25</td>
							<td>Equivalence Certificate</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc25)){?>
									<a href="../payagreements/<?php echo $admissionDoc25;?>" target="_blank"><?php echo $admissionDoc25; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc26 -->
						<tr>
							<td>26</td>
							<td>Experience letter</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc26)){?>
									<a href="../payagreements/<?php echo $admissionDoc26;?>" target="_blank"><?php echo $admissionDoc26; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc27 -->
						<tr>
							<td>27</td>
							<td>Applicants history</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc27)){?>
									<a href="../payagreements/<?php echo $admissionDoc27;?>" target="_blank"><?php echo $admissionDoc27; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc28 -->
						<tr>
							<td>28</td>
							<td>Other Documents</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc28)){?>
									<a href="../payagreements/<?php echo $admissionDoc28;?>" target="_blank"><?php echo $admissionDoc28; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc29 -->
						<?php 
						if ($clientCountry!='austria') {
						?>
						<tr>
							<td>29</td>
							<td>Domicile</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc29)){?>
									<a href="../payagreements/<?php echo $admissionDoc29;?>" target="_blank"><?php echo $admissionDoc29; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
						<!-- doc30 -->
						<tr>
							<td>30</td>
							<td>Hope Certificate</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc30)){?>
									<a href="../payagreements/<?php echo $admissionDoc30;?>" target="_blank"><?php echo $admissionDoc30; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc31 -->
						<tr>
							<td>31</td>
							<td>Certificates</td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc31)){?>
									<a href="../payagreements/<?php echo $admissionDoc31;?>" target="_blank"><?php echo $admissionDoc31; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<!-- doc32 -->
						<?php 
						if ($clientCountry=='italy') {
						?>
						<tr>
							<td>32</td>
							<td>Portfolio </td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc32)){?>
									<a href="../payagreements/<?php echo $admissionDoc32;?>" target="_blank"><?php echo $admissionDoc32; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>

						<?php 
						if ($row['client_countryfrom']=='UAE') {
						?>
						<tr>
							<td>33</td>
							<td>Emirates ID </td>
							<td class="ellipsis">
								<?php if (!empty($admissionDoc33)){?>
									<a href="../payagreements/<?php echo $admissionDoc33;?>" target="_blank"><?php echo $admissionDoc33; ?></a>
								<?php }else{ ?>
									<p>No Document Found</p>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>

						<tr>
							<td>Note Details</td>
							<td colspan="2">
								<?php if (!empty($noteDetails)){?>
									<?php echo $noteDetails; ?>
								<?php }else{ ?>
									<p>No Note Found</p>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>Admission Note Details</td>
							<td colspan="2">
								<?php if (!empty($noteAdmission)){?>
									<?php echo $noteAdmission; ?>
								<?php }else{ ?>
									<p>No Note Found</p>
								<?php } ?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</fieldset>
	</form>
<?php } ?>
<?php }

?>