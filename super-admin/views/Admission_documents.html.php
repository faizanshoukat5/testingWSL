<?php 
$clientID = $_GET['client-id'];
?>

<?php 
$clientData = "SELECT client_name, client_country, client_applied, client_countryfrom FROM clients WHERE close='1' AND status='1' AND client_id='".$clientID."' ";
$clientData_ex = mysqli_query($con, $clientData);
foreach ($clientData_ex as $row) {
	$clientName = $row['client_name'];
	$clientCountry = $row['client_country'];
	$changingApplied = $row['client_applied'];
	$clientCountryFrom = $row['client_countryfrom'];
	$appliedChanging = json_decode($changingApplied, true);
}
?>

<div class="card">
	<div class="card-header ribbon-box mt-2">
		<div class="ribbon-two ribbon-two-blue"><span>Documents</span></div>
		<p> &nbsp; &nbsp;&nbsp; Documents of <b><?php echo ucwords($clientName);?></b> who applied for <b> <?php echo ucwords($clientCountry);?> </b>in <b><?php foreach ($appliedChanging as $appRow){ echo ucwords($appRow)." "; }?> </b></p>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th width="10">Sr No</th>
						<th width="30%">Document Name</th>
						<th width="60%">File Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$clientData = "SELECT * FROM client_addmission_doc WHERE admission_client_id='".$clientID."' ";
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
					}
					?>
					<!-- doc1 -->
					<tr>
						<td style="<?php echo $admissionDoc1!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">1</td>
						<td style="<?php echo $admissionDoc1!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Matric result card in PDF format</td>
						<td style="<?php echo $admissionDoc1!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc1)){?>
							<a href="../payagreements/<?php echo $admissionDoc1; ?>" target="_blank"><?php echo $admissionDoc1; ?></a>
						<?php }else{ ?>
							No Document Found
						<?php } ?>
						</td>
					</tr>
					<!-- doc2 -->
					<tr>
						<td style="<?php echo $admissionDoc2!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">2</td>
						<td style="<?php echo $admissionDoc2!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Matric Certificate in PDF format</td>
						<td style="<?php echo $admissionDoc2!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc2)){?>
							<a href="../payagreements/<?php echo $admissionDoc2;?>" target="_blank"><?php echo $admissionDoc2; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc3 -->
					<tr>
						<td style="<?php echo $admissionDoc3!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">3</td>
						<td style="<?php echo $admissionDoc3!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Intermediate part 1 result card in PDF format</td>
						<td style="<?php echo $admissionDoc3!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc3)){?>
							<a href="../payagreements/<?php echo $admissionDoc3;?>" target="_blank"><?php echo $admissionDoc3; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc4 -->
					<tr>
						<td style="<?php echo $admissionDoc4!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">4</td>
						<td style="<?php echo $admissionDoc4!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Intermediate part 2 result card in PDF format</td>
						<td style="<?php echo $admissionDoc4!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc4)){?>
							<a href="../payagreements/<?php echo $admissionDoc4;?>" target="_blank"><?php echo $admissionDoc4; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc5 -->
					<tr>
						<td style="<?php echo $admissionDoc5!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">5</td>
						<td style="<?php echo $admissionDoc5!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Intermediate part Part 3 result card in PDF format , if applicable</td>
						<td style="<?php echo $admissionDoc5!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc5)){?>
							<a href="../payagreements/<?php echo $admissionDoc5;?>" target="_blank"><?php echo $admissionDoc5; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc6 -->
					<tr>
						<td style="<?php echo $admissionDoc6!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">5</td>
						<td style="<?php echo $admissionDoc6!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Intermediate Certificate in PDF format</td>
						<td style="<?php echo $admissionDoc6!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc6)){?>
							<a href="../payagreements/<?php echo $admissionDoc6;?>" target="_blank"><?php echo $admissionDoc6; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc7 -->
					<tr>
						<td style="<?php echo $admissionDoc7!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">6</td>
						<td style="<?php echo $admissionDoc7!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Bachelor's all transcripts in PDF format</td>
						<td style="<?php echo $admissionDoc7!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc7)){?>
							<a href="../payagreements/<?php echo $admissionDoc7;?>" target="_blank"><?php echo $admissionDoc7; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc8 -->
					<tr>
						<td style="<?php echo $admissionDoc8!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">7</td>
						<td style="<?php echo $admissionDoc8!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Bachelor's all degree in PDF format</td>
						<td style="<?php echo $admissionDoc8!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">9</td>
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Master's all Transcript in PDF format</td>
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc9)){?>
							<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc10 -->
					<tr>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">10</td>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Master's all degree in PDF format</td>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc11!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">11</td>
						<td style="<?php echo $admissionDoc11!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">English proficiency Letter from your last educational college/university PDF</td>
						<td style="<?php echo $admissionDoc11!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc11)){?>
							<a href="../payagreements/<?php echo $admissionDoc11;?>" target="_blank"><?php echo $admissionDoc11; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc12 -->
					<tr>
						<td style="<?php echo $admissionDoc12!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">12</td>
						<td style="<?php echo $admissionDoc12!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">IELTS / PTE in PDF format (if applicable)</td>
						<td style="<?php echo $admissionDoc12!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc12)){?>
							<a href="../payagreements/<?php echo $admissionDoc12;?>" target="_blank"><?php echo $admissionDoc12; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc13 -->
					<tr>
						<td style="<?php echo $admissionDoc13!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">13</td>
						<td style="<?php echo $admissionDoc13!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Recommendation letters From your last educational college/university PDF</td>
						<td style="<?php echo $admissionDoc13!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">14</td>
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Student current Home Address</td>
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">
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
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">15</td>
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">New Email ID and Password & Email id which you are using (without password)</td>
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">
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
						<td style="<?php echo $admissionDoc16!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">16</td>
						<td style="<?php echo $admissionDoc16!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">CV with new email id (PDF Format)</td>
						<td style="<?php echo $admissionDoc16!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc16)){?>
							<a href="../payagreements/<?php echo $admissionDoc16;?>" target="_blank"><?php echo $admissionDoc16; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc17 -->
					<tr>
						<td style="<?php echo $admissionDoc17!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">17</td>
						<td style="<?php echo $admissionDoc17!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">One passport size Photo with white background JPG</td>
						<td style="<?php echo $admissionDoc17!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc17)){?>
							<a href="../payagreements/<?php echo $admissionDoc17;?>" target="_blank"><?php echo $admissionDoc17; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc18 -->
					<tr>
						<td style="<?php echo $admissionDoc18!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">18</td>
						<td style="<?php echo $admissionDoc18!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Passport 1 st two pages Scan copy ( PDF Format )</td>
						<td style="<?php echo $admissionDoc18!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc18)){?>
							<a href="../payagreements/<?php echo $admissionDoc18;?>" target="_blank"><?php echo $admissionDoc18; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc19 -->
					<tr>
						<td style="<?php echo $admissionDoc19!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">19</td>
						<td style="<?php echo $admissionDoc19!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">ID Card front & Back scan copy (PDF Format)</td>
						<td style="<?php echo $admissionDoc19!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">20</td>
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Parents Detail (birth year, occupation and qualification)</td>
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">
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
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">20</td>
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Skype Profile</td>
						<td style="<?php echo $admissionDoc20!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc21!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">21</td>
						<td style="<?php echo $admissionDoc21!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Course details instead of cost</td>
						<td style="<?php echo $admissionDoc21!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc21)){?>
							<a href="../payagreements/<?php echo $admissionDoc21;?>" target="_blank"><?php echo $admissionDoc21; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc22 -->
					<tr>
						<td style="<?php echo $admissionDoc22!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">22</td>
						<td style="<?php echo $admissionDoc22!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Eligibility letter from university with registrar sign & stamp PDF</td>
						<td style="<?php echo $admissionDoc22!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">9</td>
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Parents Detail (ID card no. , House no. , contact no.)</td>
						<td style="<?php echo $admissionDoc9!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc9)){?>
							<a href="../payagreements/<?php echo $admissionDoc9;?>" target="_blank"><?php echo $admissionDoc9; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc10 -->
					<tr>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">10</td>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Last three months Bank Statement with account maintenance letter in PDF.</td>
						<td style="<?php echo $admissionDoc10!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc10)){?>
							<a href="../payagreements/<?php echo $admissionDoc10;?>" target="_blank"><?php echo $admissionDoc10; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc14 -->
					<tr>
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">14</td>
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Relative Contact detail in case of Emergency.</td>
						<td style="<?php echo $admissionDoc14!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc14)){?>
							<a href="../payagreements/<?php echo $admissionDoc14;?>" target="_blank"><?php echo $admissionDoc14; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc15 -->
					<tr>
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">15</td>
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">In case of Sponsor bank statement contact number, house address, email id, relation with sponsor.</td>
						<td style="<?php echo $admissionDoc15!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc23!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">23</td>
						<td style="<?php echo $admissionDoc23!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Details Word File</td>
						<td style="<?php echo $admissionDoc23!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc23)){?>
								<a href="../payagreements/<?php echo $admissionDoc23;?>" target="_blank"><?php echo $admissionDoc23; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<!-- doc24 -->
					<tr>
						<td style="<?php echo $admissionDoc24!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">24</td>
						<td style="<?php echo $admissionDoc24!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Thesis</td>
						<td style="<?php echo $admissionDoc24!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
						<?php if (!empty($admissionDoc24)){?>
							<a href="../payagreements/<?php echo $admissionDoc24;?>" target="_blank"><?php echo $admissionDoc24; ?></a>
						<?php }else{ ?>
							<p>No Document Found</p>
						<?php } ?>
						</td>
					</tr>
					<!-- doc25 -->
					<tr>
						<td style="<?php echo $admissionDoc25!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">25</td>
						<td style="<?php echo $admissionDoc25!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Equivalence Certificate</td>
						<td style="<?php echo $admissionDoc25!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc25)){?>
								<a href="../payagreements/<?php echo $admissionDoc25;?>" target="_blank"><?php echo $admissionDoc25; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<!-- doc26 -->
					<tr>
						<td style="<?php echo $admissionDoc26!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">26</td>
						<td style="<?php echo $admissionDoc26!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Experience letter</td>
						<td style="<?php echo $admissionDoc26!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc26)){?>
								<a href="../payagreements/<?php echo $admissionDoc26;?>" target="_blank"><?php echo $admissionDoc26; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<!-- doc27 -->
					<tr>
						<td style="<?php echo $admissionDoc27!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">27</td>
						<td style="<?php echo $admissionDoc27!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Applicants history</td>
						<td style="<?php echo $admissionDoc27!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc27)){?>
								<a href="../payagreements/<?php echo $admissionDoc27;?>" target="_blank"><?php echo $admissionDoc27; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<!-- doc28 -->
					<tr>
						<td style="<?php echo $admissionDoc28!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">28</td>
						<td style="<?php echo $admissionDoc28!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Other Documents</td>
						<td style="<?php echo $admissionDoc28!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc29!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">29</td>
						<td style="<?php echo $admissionDoc29!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Domicile</td>
						<td style="<?php echo $admissionDoc29!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc30!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">30</td>
						<td style="<?php echo $admissionDoc30!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Hope Certificate</td>
						<td style="<?php echo $admissionDoc30!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc30)){?>
								<a href="../payagreements/<?php echo $admissionDoc30;?>" target="_blank"><?php echo $admissionDoc30; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<!-- doc31 -->
					<tr>
						<td style="<?php echo $admissionDoc31!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">31</td>
						<td style="<?php echo $admissionDoc31!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Certificates</td>
						<td style="<?php echo $admissionDoc31!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
						<td style="<?php echo $admissionDoc32!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">32</td>
						<td style="<?php echo $admissionDoc32!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Portfolio </td>
						<td style="<?php echo $admissionDoc32!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
							<?php if (!empty($admissionDoc32)){?>
								<a href="../payagreements/<?php echo $admissionDoc32;?>" target="_blank"><?php echo $admissionDoc32; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
						</td>
					</tr>
					<?php } ?>

					<?php 
					if ($clientCountryFrom=='UAE') {
					?>
					<tr>
						<td style="<?php echo $admissionDoc33!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">33</td>
						<td style="<?php echo $admissionDoc33!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>">Emirates ID </td>
						<td style="<?php echo $admissionDoc33!='' ? 'background: #52c234; color:#fff; font-weight: 600;' : 'font-weight: 600;'; ?>" class="ellipsis">
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
				</tbody>	
			</table>
		</div>
	</div>
</div>