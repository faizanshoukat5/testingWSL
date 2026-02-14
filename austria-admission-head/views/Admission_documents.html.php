<?php 
$clientID = $_GET['client-id'];
?>

<?php 
$clientData = "SELECT client_id, client_name, client_country, client_whatapp, client_applied, client_countryfrom FROM clients".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND client_id='".$clientID."' ";
$clientData_ex = mysqli_query($con, $clientData);
foreach ($clientData_ex as $row) {
	$clientID = $row['client_id'];
	$clientName = $row['client_name'];
	$clientWhatapp = $row['client_whatapp'];
	$clientCountryApply = $row['client_country'];
	$clientCountryFrom = $row['client_countryfrom'];
	$changingApplied = $row['client_applied'];
	$appliedChanging = json_decode($changingApplied, true);
}
?>


<div class="card">
	<div class="card-header ribbon-box mt-2">
		<div class="ribbon-two ribbon-two-blue"><span>Documents</span></div>
		<p> &nbsp; &nbsp;&nbsp; Documents of <b><?php echo ucwords($clientName);?></b> who applied for <b> <?php echo ucwords($clientCountryApply);?> </b>in <b><?php foreach ($appliedChanging as $appRow){ echo ucwords($appRow)." "; }?> </b></p>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>ID No: <strong><?php echo "ID-".$clientID;?></strong> </p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>Whatapp No: <strong><a class="text-warning" href="https://web.whatsapp.com/send?phone=+<?php echo $clientWhatapp;?>" target="_blank"><?php echo $clientWhatapp; ?></a></strong></p>
					</div>
				</div>
				<?php 
				$clientData = "SELECT czech_change_program_name, czech_university_name, czech_program_name FROM czech_clients_programs".$_SESSION['dbNo']." WHERE close='1' AND status='1' AND czech_clients_id='".$clientID."' AND czech_program_assign!='0' ";
				$clientData_ex = mysqli_query($con, $clientData);
				foreach ($clientData_ex as $row) {
					$uniName = $row['czech_university_name'];
					$programName = $row['czech_program_name'];
				
				?>
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>University: <strong><?php echo ucwords($uniName);?></strong> </p>
					</div>
				</div>
				<div class="col-md-6">
					<div class="alert bg-dark text-warning">
						<p>Program: <strong><?php if($row['czech_change_program_name']!=''){ ?>
							<del><?php echo ucwords($row['czech_program_name']); ?></del> / 
							<?php echo ucwords($row['czech_change_program_name']); ?>
							<?php
							}else{
								echo ucwords($row['czech_program_name']);
							}
							?></strong> </p>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="card-body">
		<button type="button" class="btn btn-custom mb-1" onclick="downloadZip(<?php echo $clientID;?>);">Download All Documents</button>
		<div class="table-responsive">
			<table class="table table-bordered nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
				<thead>
					<tr>
						<th width="5%">Sr</th>
						<th width="20%">Document Name</th>
						<th width="25%">Upload File</th>
						<th width="35%">File Status</th>
						<th width="12%">Option</th>
						<th width="3%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$clientData = "SELECT * FROM client_addmission_doc".$_SESSION['dbNo']." WHERE admission_client_id='".$clientID."' ";
					$clientData_ex = mysqli_query($con, $clientData);
					$row = mysqli_fetch_assoc($clientData_ex);
					$admissionDoc1 = $row['admission_doc1'];
					$admissionDoc2 = $row['admission_doc2'];
					$admissionDoc3 = $row['admission_doc3'];
					$admissionDoc4 = $row['admission_doc4'];
					$admissionDoc5 = $row['admission_doc5'];
					$admissionDoc6 = $row['admission_doc6'];
					$admissionDoc7 = $row['admission_doc7'];
					$admissionDoc8 = $row['admission_doc8'];
					$admissionDoc9 = $row['admission_doc9'];
					$admissionDoc10 = $row['admission_doc10'];
					$admissionDoc11 = $row['admission_doc11'];
					$admissionDoc12 = $row['admission_doc12'];
					$admissionDoc13 = $row['admission_doc13'];
					$admissionDoc14 = $row['admission_doc14'];
					$admissionDoc15 = $row['admission_doc15'];
					$admissionDoc16 = $row['admission_doc16'];
					$admissionDoc17 = $row['admission_doc17'];
					$admissionDoc18 = $row['admission_doc18'];
					$admissionDoc19 = $row['admission_doc19'];
					$admissionDoc20 = $row['admission_doc20'];
					$admissionDoc21 = $row['admission_doc21'];
					$admissionDoc22 = $row['admission_doc22'];
					$admissionDoc23 = $row['admission_doc23'];
					$admissionDoc24 = $row['admission_doc24'];
					$admissionDoc25 = $row['admission_doc25'];
					$admissionDoc26 = $row['admission_doc26'];
					$admissionDoc27 = $row['admission_doc27'];
					$admissionDoc28 = $row['admission_doc28'];
					$admissionDoc29 = $row['admission_doc29'];
					$admissionDoc30 = $row['admission_doc30'];
					$admissionDoc31 = $row['admission_doc31'];
					$admissionDoc32 = $row['admission_doc32'];
					$admissionDoc33 = $row['admission_doc33'];
					$admissionDoc34 = $row['admission_doc34'];
					$admissionDoc35 = $row['admission_doc35'];
					$admissionDoc36 = $row['admission_doc36'];
					$admissionDoc37 = $row['admission_doc37'];
					$admissionDoc38 = $row['admission_doc38'];
					$noteDetails = $row['note_details'];
					$noteAdmission = $row['note_admission'];
					$noteDocuments = $row['note_documents'];
					$noteForDocumentHead = $row['note_document_collection'];
					?>
					<!-- doc1 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc1;?>" id="admissionDoc1">
						<tr id="trDoc1" style="<?php echo $admissionDoc1!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>1</td>
							<td>Matric result card in PDF format</td>
							<td>
								<input type="file" name="admission_Doc1" class="form-control" id="admission_Doc1">
							</td>
							<td class="ellipsis" id="showDoc1">
							<?php if (!empty($admissionDoc1)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc1; ?>" target="blank"><?php echo $admissionDoc1; ?></a>
							<?php }else{ ?>
								No Document Found
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(1);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc1,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc2 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc2;?>" id="admissionDoc2">
						<tr id="trDoc2" style="<?php echo $admissionDoc2!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>2</td>
							<td>Matric Certificate in PDF format</td>
							<td>
								<input type="file" name="admission_Doc2" required="required" class="form-control" id="admission_Doc2">
							</td>
							<td class="ellipsis" id="showDoc2">
							<?php if (!empty($admissionDoc2)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc2;?>" target="blank"><?php echo $admissionDoc2; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(2);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc2,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc3 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc3;?>" id="admissionDoc3">
						<tr id="trDoc3" style="<?php echo $admissionDoc3!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>3</td>
							<td>Intermediate part 1 result card in PDF format</td>
							<td>
								<input type="file" name="admission_Doc3" <?= ($appRow == 'bachelor' || $appRow == 'mbbs') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc3">
							</td>
							<td class="ellipsis" id="showDoc3">
							<?php if (!empty($admissionDoc3)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc3;?>" target="blank"><?php echo $admissionDoc3; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(3);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc3,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc4 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc4;?>" id="admissionDoc4">
						<tr id="trDoc4" style="<?php echo $admissionDoc4!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>4</td>
							<td>Intermediate part 2 result card in PDF format</td>
							<td>
								<input type="file" name="admission_Doc4" <?= ($appRow == 'bachelor' || $appRow == 'mbbs') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc4">
							</td>
							<td class="ellipsis" id="showDoc4">
							<?php if (!empty($admissionDoc4)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc4;?>" target="blank"><?php echo $admissionDoc4; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(4);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc4,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc5 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc5;?>" id="admissionDoc5">
						<tr id="trDoc5" style="<?php echo $admissionDoc5!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>5</td>
							<td>Intermediate part Part 3 result card in PDF format , if applicable</td>
							<td>
								<input type="file" name="admission_Doc5" <?= ($appRow == 'bachelor' || $appRow == 'mbbs') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc5">
							</td>
							<td class="ellipsis" id="showDoc5">
							<?php if (!empty($admissionDoc5)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc5;?>" target="blank"><?php echo $admissionDoc5; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(5);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc5,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc6 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc6;?>" id="admissionDoc6">
						<tr id="trDoc6" style="<?php echo $admissionDoc6!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>6</td>
							<td>Intermediate Certificate in PDF format</td>
							<td>
								<input type="file" name="admission_Doc6" <?= ($appRow=='master') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc6">
							</td>
							<td class="ellipsis" id="showDoc6">
							<?php if (!empty($admissionDoc6)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc6;?>" target="blank"><?php echo $admissionDoc6; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(6);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc6,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc7 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc7;?>" id="admissionDoc7">
						<tr id="trDoc7" style="<?php echo $admissionDoc7!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>7</td>
							<td>Bachelor's all transcripts in PDF format</td>
							<td>
								<input type="file" name="admission_Doc7" <?= ($appRow=='master') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc7">
							</td>
							<td class="ellipsis" id="showDoc7">
							<?php if (!empty($admissionDoc7)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc7;?>" target="blank"><?php echo $admissionDoc7; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(7);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc7,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc8 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc8;?>" id="admissionDoc8">
						<tr id="trDoc8" style="<?php echo $admissionDoc8!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>8</td>
							<td>Bachelor's all degree in PDF format</td>
							<td>
								<input type="file" name="admission_Doc8" <?= ($appRow=='master') ? 'required="required"' : '' ?> class="form-control" id="admission_Doc8">
							</td>
							<td class="ellipsis" id="showDoc8">
							<?php if (!empty($admissionDoc8)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc8;?>" target="blank"><?php echo $admissionDoc8; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(8);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc8,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php 
					if ($clientCountryApply=='canada' || $clientCountryApply=='USA') {
						
					}else{
					?>
					<!-- doc9 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc9;?>" id="admissionDoc9">
						<tr id="trDoc9" style="<?php echo $admissionDoc9!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>9</td>
							<td>Master's all Transcript in PDF format</td>
							<td>
								<input type="file" name="admission_Doc9" class="form-control" id="admission_Doc9">
							</td>
							<td class="ellipsis" id="showDoc9">
							<?php if (!empty($admissionDoc9)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(9);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc9,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc10 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc10;?>" id="admissionDoc10">
						<tr id="trDoc10" style="<?php echo $admissionDoc10!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>10</td>
							<td>Master's all degree in PDF format</td>
							<td>
								<input type="file" name="admission_Doc10" class="form-control" id="admission_Doc10">
							</td>
							<td class="ellipsis" id="showDoc10">
							<?php if (!empty($admissionDoc10)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(10);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc10,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>
					<!-- doc11 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc11;?>" id="admissionDoc11">
						<tr id="trDoc11" style="<?php echo $admissionDoc11!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>11</td>
							<td>English proficiency Letter from your last educational college/university PDF</td>
							<td>
								<input type="file" name="admission_Doc11" required="required" class="form-control" id="admission_Doc11">
							</td>
							<td class="ellipsis" id="showDoc11">
							<?php if (!empty($admissionDoc11)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc11;?>" target="blank"><?php echo $admissionDoc11; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(11);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc11,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc12 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc12;?>" id="admissionDoc12">
						<tr id="trDoc12" style="<?php echo $admissionDoc12!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>12</td>
							<td>IELTS / PTE / TOFEL in PDF format (if applicable)</td>
							<td>
								<input type="file" name="admission_Doc12" required="required" class="form-control" id="admission_Doc12">
							</td>
							<td class="ellipsis" id="showDoc12">
							<?php if (!empty($admissionDoc12)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc12;?>" target="blank"><?php echo $admissionDoc12; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(12);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc12,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc13 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc13;?>" id="admissionDoc13">
						<tr id="trDoc13" style="<?php echo $admissionDoc13!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>13</td>
							<td>Recommendation letters From your last educational college/university PDF</td>
							<td>
								<input type="file" name="admission_Doc13" required="required" class="form-control" id="admission_Doc13">
							</td>
							<td class="ellipsis" id="showDoc13">
							<?php if (!empty($admissionDoc13)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc13;?>" target="blank"><?php echo $admissionDoc13; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(13);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc13,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php 
					if ($clientCountryApply=='canada' || $clientCountryApply=='USA') {
						
					}else{
					?>
					<!-- doc14 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc14;?>" id="admissionDoc14">
						<tr id="trDoc14" style="<?php echo $admissionDoc14!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>14</td>
							<td>Student current Home Address with Postal Code </td>
							<td>
								<textarea class="form-control" name="admission_Doc14"></textarea>
								<!-- <input type="file" name="admission_Doc14" required="required" class="form-control" id="admission_Doc14"> -->
							</td>
							<td>
							<?php if (!empty($admissionDoc14)){ ?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc14;?>" target="blank"><?php echo $admissionDoc14; ?></a> -->
								<?php echo $admissionDoc14;?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDoc14"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc14,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc15 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc15;?>" id="admissionDoc15">
						<tr id="trDoc15" style="<?php echo $admissionDoc15!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>15</td>
							<td>New Email ID and Password & Email id which you are using (without password)</td>
							<td>
								<textarea class="form-control" name="admission_Doc15"></textarea>
								<!-- <input type="file" name="admission_Doc15" required="required" class="form-control" id="admission_Doc15"> -->
							</td>
							<td>
							<?php if (!empty($admissionDoc15)){ ?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc15;?>" target="blank"><?php echo $admissionDoc15; ?></a> -->
								<?php echo $admissionDoc15; ?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDocText15"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc15,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>
					<!-- doc16 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc16;?>" id="admissionDoc16">
						<tr id="trDoc16" style="<?php echo $admissionDoc16!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>16</td>
							<td>CV with new email id (PDF Format)</td>
							<td>
								<input type="file" name="admission_Doc16" required="required" class="form-control" id="admission_Doc16">
							</td>
							<td class="ellipsis" id="showDoc16">
							<?php if (!empty($admissionDoc16)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc16;?>" target="blank"><?php echo $admissionDoc16; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(16);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc16,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc17 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc17;?>" id="admissionDoc17">
						<tr id="trDoc17" style="<?php echo $admissionDoc17!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>17</td>
							<td>One passport size Photo with white background JPG</td>
							<td>
								<input type="file" name="admission_Doc17" required="required" class="form-control" id="admission_Doc17">
							</td>
							<td class="ellipsis" id="showDoc17">
							<?php if (!empty($admissionDoc17)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc17;?>" target="blank"><?php echo $admissionDoc17; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(17);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc17,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc18 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc18;?>" id="admissionDoc18">
						<tr id="trDoc18" style="<?php echo $admissionDoc18!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>18</td>
							<td>Passport 1 st two pages Scan copy ( PDF Format )</td>
							<td>
								<input type="file" name="admission_Doc18" required="required" class="form-control" id="admission_Doc18">
							</td>
							<td class="ellipsis" id="showDoc18">
							<?php if (!empty($admissionDoc18)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc18;?>" target="blank"><?php echo $admissionDoc18; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(18);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc18,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<!-- doc19 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc19;?>" id="admissionDoc19">
						<tr id="trDoc19" style="<?php echo $admissionDoc19!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>19</td>
							<td>ID Card front & Back scan copy (PDF Format)</td>
							<td>
								<input type="file" name="admission_Doc19" required="required" class="form-control" id="admission_Doc19">
							</td>
							<td class="ellipsis" id="showDoc19">
							<?php if (!empty($admissionDoc19)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc19;?>" target="blank"><?php echo $admissionDoc19; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(19);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc19,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php 
					if ($clientCountryApply=='austria' || $clientCountryApply =='canada' || $clientCountryApply == 'USA') {
					?>
					<!-- doc20 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc20;?>" id="admissionDoc20">
						<tr id="trDoc20" style="<?php echo $admissionDoc20!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>20</td>
							<td>Parents Detail (birth year, occupation and qualification)</td>
							<td>
								<textarea class="form-control" name="admission_Doc20"></textarea>
								<!-- <input type="file" name="admission_Doc20" required="required" class="form-control" id="admission_Doc20"> -->
							</td>
							<td>
							<?php if (!empty($admissionDoc20)){ ?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc20;?>" target="blank"><?php echo $admissionDoc20; ?></a> -->
								<?php echo $admissionDoc20; ?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDocText20"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc20,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php
					}else{
					?>
					<!-- doc20 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc20;?>" id="admissionDoc20">
						<tr id="trDoc20" style="<?php echo $admissionDoc20!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>20</td>
							<td>Skype Profile <?php if ($clientCountryApply=='italy' || $clientCountryApply=='france'){echo '/ Zoom ID';} ?></td>
							<td>
								<input type="file" name="admission_Doc20" required="required" class="form-control" id="admission_Doc20">
							</td>
							<td class="ellipsis" id="showDoc20">
							<?php if (!empty($admissionDoc20)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc20;?>" target="blank"><?php echo $admissionDoc20; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(20);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc20,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php 
					}
					if ($clientCountryApply=='austria') {
					?>
					<!-- doc21 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc21;?>" id="admissionDoc21">
						<tr id="trDoc21" style="<?php echo $admissionDoc21!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>21</td>
							<td>Course details instead of cost</td>
							<td>
								<input type="file" name="admission_Doc21" required="required" class="form-control" id="admission_Doc21">
							</td>
							<td class="ellipsis" id="showDoc21">
							<?php if (!empty($admissionDoc21)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc21;?>" target="blank"><?php echo $admissionDoc21; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(21);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc21,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc22 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc22;?>" id="admissionDoc22">
						<tr id="trDoc22" style="<?php echo $admissionDoc22!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>22</td>
							<td>Eligibility letter from university with registrar sign & stamp PDF</td>
							<td>
								<input type="file" name="admission_Doc22" required="required" class="form-control" id="admission_Doc22">
							</td>
							<td class="ellipsis" id="showDoc22">
							<?php if (!empty($admissionDoc22)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc22;?>" target="blank"><?php echo $admissionDoc22; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(22);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc22,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php 
					}if ($clientCountryApply=='canada' || $clientCountryApply=='USA') {
					?>
					<!-- doc9 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc9;?>" id="admissionDoc9">
						<tr id="trDoc9" style="<?php echo $admissionDoc9!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>9</td>
							<td>Parents Detail (ID card no. , House no. , contact no.)</td>
							<td>
								<input type="file" name="admission_Doc9" required="required" class="form-control" id="admission_Doc9">
							</td>
							<td class="ellipsis" id="showDoc9">
							<?php if (!empty($admissionDoc9)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc9;?>" target="blank"><?php echo $admissionDoc9; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(9);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc9,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc10 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc10;?>" id="admissionDoc10">
						<tr id="trDoc10" style="<?php echo $admissionDoc10!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>10</td>
							<td>Last three months Bank Statement with account maintenance letter in PDF.</td>
							<td>
								<input type="file" name="admission_Doc10" required="required" class="form-control" id="admission_Doc10">
							</td>
							<td class="ellipsis" id="showDoc10">
							<?php if (!empty($admissionDoc10)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc10;?>" target="blank"><?php echo $admissionDoc10; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(10);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc10,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc14 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc14;?>" id="admissionDoc14">
						<tr id="trDoc14" style="<?php echo $admissionDoc14!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>14</td>
							<td>Relative Contact detail in case of Emergency.</td>
							<td>
								<textarea class="form-control" name="admission_Doc14"></textarea>
								<!-- <input type="file" name="admission_Doc14" required="required" class="form-control" id="admission_Doc14"> -->
							</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc14)){ ?>
								<!-- <a href="../payagreements/<?php echo $admissionDoc14;?>" target="blank"><?php echo $admissionDoc14; ?></a> -->
								<?php echo $admissionDoc14;?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDoc14"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc14,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc15 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc15;?>" id="admissionDoc15">
						<tr id="trDoc15" style="<?php echo $admissionDoc15!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>15</td>
							<td>In case of Sponsor bank statement contact number, house address, email id, relation with sponsor.</td>
							<td>
								<input type="file" name="admission_Doc15" required="required" class="form-control" id="admission_Doc15">
							</td>
							<td class="ellipsis" id="showDoc15">
							<?php if (!empty($admissionDoc15)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc15;?>" target="blank"><?php echo $admissionDoc15; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(15);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc15,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>

					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc23;?>" id="admissionDoc23">
						<tr id="trDoc23" style="<?php echo $admissionDoc23!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "21";}else{echo "23";}?></td>
							<td>Details Word File</td>
							<td>
								<input type="file" name="admission_Doc23" required="required" class="form-control" id="admission_Doc23">
							</td>
							<td class="ellipsis" id="showDoc23">
							<?php if (!empty($admissionDoc23)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc23;?>" target="blank"><?php echo $admissionDoc23; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(23);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc23,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<!-- doc24 -->
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc24;?>" id="admissionDoc24">
						<tr id="trDoc24" style="<?php echo $admissionDoc24!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "22";}else{echo "24";}?></td>
							<td>Thesis</td>
							<td>
								<input type="file" name="admission_Doc24" class="form-control" id="admission_Doc24">
							</td>
							<td class="ellipsis" id="showDoc24">
							<?php if (!empty($admissionDoc24)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc24;?>" target="blank"><?php echo $admissionDoc24; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(24);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc24,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc25;?>" id="admissionDoc25">
						<tr id="trDoc25" style="<?php echo $admissionDoc25!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "23";}else{echo "25";}?></td>
							<td>Equivalence Certificate</td>
							<td>
								<input type="file" name="admission_Doc25" class="form-control" id="admission_Doc25">
							</td>
							<td class="ellipsis" id="showDoc25">
							<?php if (!empty($admissionDoc25)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc25;?>" target="blank"><?php echo $admissionDoc25; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(25);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc25,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc26;?>" id="admissionDoc26">
						<tr id="trDoc26" style="<?php echo $admissionDoc26!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "24";}else{echo "26";}?> </td>
							<td>Experience letter</td>
							<td>
								<input type="file" name="admission_Doc26" class="form-control" id="admission_Doc26">
							</td>
							<td class="ellipsis" id="showDoc26">
							<?php if (!empty($admissionDoc26)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc26;?>" target="blank"><?php echo $admissionDoc26; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(26);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc26,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc27;?>" id="admissionDoc27">
						<tr id="trDoc27" style="<?php echo $admissionDoc27!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "25";}else{echo "27";}?></td>
							<td>Applicants History</td>
							<td>
								<input type="file" name="admission_Doc27" class="form-control" id="admission_Doc27">
							</td>
							<td class="ellipsis" id="showDoc27">
							<?php if (!empty($admissionDoc27)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc27;?>" target="blank"><?php echo $admissionDoc27; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(27);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc27,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc28;?>" id="admissionDoc28">
						<tr id="trDoc28" style="<?php echo $admissionDoc28!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "26";}else{echo "28";}?></td>
							<td>Other Documents</td>
							<td>
								<input type="file" name="admission_Doc28" class="form-control" id="admission_Doc28">
							</td>
							<td class="ellipsis" id="showDoc28">
							<?php if (!empty($admissionDoc28)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc28;?>" target="blank"><?php echo $admissionDoc28; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(28);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc28,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<?php 
					if ($clientCountryApply!='austria') {
					?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc29;?>" id="admissionDoc29">
						<tr id="trDoc29" style="<?php echo $admissionDoc29!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "27";}else{echo "29";}?></td>
							<td>Domicile</td>
							<td>
								<input type="file" name="admission_Doc29" class="form-control" id="admission_Doc29">
							</td>
							<td class="ellipsis" id="showDoc29">
							<?php if (!empty($admissionDoc29)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc29;?>" target="blank"><?php echo $admissionDoc29; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(29);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc29,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc30;?>" id="admissionDoc30">
						<tr id="trDoc30" style="<?php echo $admissionDoc30!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "28";}else{echo "30";}?></td>
							<td>Hope Certificate</td>
							<td>
								<input type="file" name="admission_Doc30" class="form-control" id="admission_Doc30">
							</td>
							<td class="ellipsis" id="showDoc30">
							<?php if (!empty($admissionDoc30)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc30;?>" target="blank"><?php echo $admissionDoc30; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(30);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc30,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc31;?>" id="admissionDoc31">
						<tr id="trDoc31" style="<?php echo $admissionDoc31!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='italy'){echo "29";}else{echo "31";}?></td>
							<td>Certificates </td>
							<td>
								<input type="file" name="admission_Doc31" class="form-control" id="admission_Doc31">
							</td>
							<td class="ellipsis" id="showDoc31">
							<?php if (!empty($admissionDoc31)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc31;?>" target="blank"><?php echo $admissionDoc31; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(31);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc31,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<?php 
					if ($clientCountryApply=='italy' || $clientCountryApply=='austria' || $clientCountryApply=='czech republic') {
					?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc32;?>" id="admissionDoc32">
						<tr id="trDoc32" style="<?php echo $admissionDoc32!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>30</td>
							<td>Portfolio </td>
							<td>
								<input type="file" name="admission_Doc32" class="form-control" id="admission_Doc32">
							</td>
							<td class="ellipsis" id="showDoc32">
							<?php if (!empty($admissionDoc32)){
								?>
								<a href="../payagreements/<?php echo $admissionDoc32;?>" target="blank"><?php echo $admissionDoc32; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(32);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc32,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>
					<?php if ($clientCountryApply=='italy') { ?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc34;?>" id="admissionDoc34">
						<tr id="trDoc34" style="<?php echo $admissionDoc34!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>31</td>
							<td>Emergency Contact No, Name, Relation, Email </td>
							<td>
								<textarea class="form-control" name="admission_Doc34"></textarea>
							</td>
							<td>
							<?php if (!empty($admissionDoc34)){
								echo $admissionDoc34;?>
							<?php }else{ ?>
								<p>No Note Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDoc34"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc34,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>">
						<input type="hidden" name="" value="<?php echo $admissionDoc35;?>" id="admissionDoc35">
						<tr id="trDoc35" style="<?php echo $admissionDoc35!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>32</td>
							<td>Extra Documents <span class="text-danger">(Select Multi File)</span></td>
							<td>
								<input type="file" name="admission_Doc35[]" class="form-control" multiple="">
							</td>
							<td class="ellipsis">
							<?php if (!empty($admissionDoc35)){ 
								$fileMulti = explode(',', $admissionDoc35);
								foreach ($fileMulti as $fileName) {
								?>
								<a href="../payagreements/<?php echo $fileName;?>" target="_blank"><?php echo $fileName;?></a><br>
								<?php } ?>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="submit" name="subDoc35"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc35,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc36;?>" id="admissionDoc36">
						<tr id="trDoc36" style="<?php echo $admissionDoc36!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>32</td>
							<td>Europass CV <span class="text-danger">(Select Multi File)</span></td>
							<td>
								<input type="file" name="admission_Doc36" class="form-control" id="admission_Doc36">
							</td>
							<td class="ellipsis" id="showDoc36">
							<?php if (!empty($admissionDoc36)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc36;?>" target="blank"><?php echo $admissionDoc36;?></a><br>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(36);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc36,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc38;?>" id="admissionDoc38">
						<tr id="trDoc38" style="<?php echo $admissionDoc38!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td>33</td>
							<td>Garde Conversion Certificate</td>
							<td>
								<input type="file" name="admission_Doc38" class="form-control" id="admission_Doc38">
							</td>
							<td class="ellipsis" id="showDoc38">
							<?php if (!empty($admissionDoc38)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc38;?>" target="blank"><?php echo $admissionDoc38;?></a><br>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(38);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc38,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>

					<?php } ?>

					<?php if ($clientCountryFrom=='UAE') { ?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc33;?>" id="admissionDoc33">
						<tr id="trDoc33" style="<?php echo $admissionDoc33!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryFrom=='UAE'){echo "32";}else{}?></td>
							<td>Emirates ID </td>
							<td>
								<input type="file" name="admission_Doc33" class="form-control" id="admission_Doc33">
							</td>
							<td class="ellipsis" id="showDoc33">
							<?php if (!empty($admissionDoc33)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc33;?>" target="blank"><?php echo $admissionDoc33; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(33);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc33,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>
					<?php if ($clientCountryApply=='austria') { ?>
					<form action="" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="updateID" value="<?php echo $clientID;?>" id="clientID">
						<input type="hidden" name="" value="<?php echo $admissionDoc37;?>" id="admissionDoc37">
						<tr id="trDoc37" style="<?php echo $admissionDoc37!='' ? 'background: #52c234; font-weight: 600;' : 'font-weight: 600;'; ?>">
							<td><?php if($clientCountryApply=='austria'){echo "31";}else{}?></td>
							<td>Curriculum </td>
							<td>
								<input type="file" name="admission_Doc37" class="form-control" id="admission_Doc37">
							</td>
							<td class="ellipsis" id="showDoc37">
							<?php if (!empty($admissionDoc37)){ ?>
								<a href="../payagreements/<?php echo $admissionDoc37;?>" target="blank"><?php echo $admissionDoc37; ?></a>
							<?php }else{ ?>
								<p>No Document Found</p>
							<?php } ?>
							</td>
							<td><button class="btn btn-primary" type="button" name="" onclick="uploadDocument(37);"><i class="mdi mdi-upload"></i> Upload</button></td>
							<td><button class="btn btn-danger btn-sm" type="button" onclick="del(delDoc37,<?php echo $clientID;?>)"><i class="mdi mdi-trash-can"></i></button></td>
						</tr>
					</form>
					<?php } ?>	
				</tbody>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	function uploadDocument(id) {
		var clientID = $("#clientID").val();
		var fileInput = $("#admission_Doc" + id)[0];
		var file = fileInput.files[0];
		if (!file) {
			Swal.fire('Error!', 'Please select a file before uploading.', 'error');
			return;
		}
		var formData = new FormData();
		formData.append("clientID", clientID);
		formData.append("adDocument", file); 
		formData.append("docType", id);

		$.ajax({
			url: "getState.php",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				Swal.fire(
					'Uploaded!',
					'Document uploaded successfully.',
					'success'
				);
				$("#showDoc"+id).html('<a href="../payagreements/'+response+'" target="_blank">'+response+'</a>');
				$("#trDoc"+id).css({
					"background": "#52c234",
					"font-weight": "600"
				});
			}
		});
	}


function deleteAdmissionDoc(id, type) {
	var admissionDoc = $("#admissionDoc" + type).val();
	$.ajax({
		type: "POST",
		url: "getState.php",
		data: {
			clientID: id,
			admissionDocDel: admissionDoc,
			docType: type,
		},
		success: function (data) {
			Swal.fire(
				'Deleted!', 
				'Record has been deleted.', 
				'success'
			).then(() => {
				window.location.reload();
			});
		}
	});
}
// Call the function for document 1
function delDoc1(iddoc) {
	deleteAdmissionDoc(iddoc, 1);
}
// Call the function for document 2
function delDoc2(iddoc) {
	deleteAdmissionDoc(iddoc, 2);
}
// Call the function for document 3
function delDoc3(iddoc) {
	deleteAdmissionDoc(iddoc, 3);
}
// Call the function for document 4
function delDoc4(iddoc) {
	deleteAdmissionDoc(iddoc, 4);
}
// Call the function for document 5
function delDoc5(iddoc) {
	deleteAdmissionDoc(iddoc, 5);
}
// Call the function for document 6
function delDoc6(iddoc) {
	deleteAdmissionDoc(iddoc, 6);
}
// Call the function for document 7
function delDoc7(iddoc) {
	deleteAdmissionDoc(iddoc, 7);
}
// Call the function for document 8
function delDoc8(iddoc) {
	deleteAdmissionDoc(iddoc, 8);
}
// Call the function for document 9
function delDoc9(iddoc) {
	deleteAdmissionDoc(iddoc, 9);
}
// Call the function for document 10
function delDoc10(iddoc) {
	deleteAdmissionDoc(iddoc, 10);
}
// Call the function for document 11
function delDoc11(iddoc) {
	deleteAdmissionDoc(iddoc, 11);
}
// Call the function for document 12
function delDoc12(iddoc) {
	deleteAdmissionDoc(iddoc, 12);
}
// Call the function for document 13
function delDoc13(iddoc) {
	deleteAdmissionDoc(iddoc, 13);
}
// Call the function for document 14
function delDoc14(iddoc) {
	deleteAdmissionDoc(iddoc, 14);
}
// Call the function for document 15
function delDoc15(iddoc) {
	deleteAdmissionDoc(iddoc, 15);
}
// Call the function for document 16
function delDoc16(iddoc) {
	deleteAdmissionDoc(iddoc, 16);
}
// Call the function for document 17
function delDoc17(iddoc) {
	deleteAdmissionDoc(iddoc, 17);
}
// Call the function for document 18
function delDoc18(iddoc) {
	deleteAdmissionDoc(iddoc, 18);
}
// Call the function for document 19
function delDoc19(iddoc) {
	deleteAdmissionDoc(iddoc, 19);
}
// Call the function for document 20
function delDoc20(iddoc) {
	deleteAdmissionDoc(iddoc, 20);
}
// Call the function for document 21
function delDoc21(iddoc) {
	deleteAdmissionDoc(iddoc, 21);
}
// Call the function for document 22
function delDoc22(iddoc) {
	deleteAdmissionDoc(iddoc, 22);
}
function delDoc23(iddoc) {
	deleteAdmissionDoc(iddoc, 23);
}
function delDoc24(iddoc) {
	deleteAdmissionDoc(iddoc, 24);
}
function delDoc25(iddoc) {
	deleteAdmissionDoc(iddoc, 25);
}
function delDoc26(iddoc) {
	deleteAdmissionDoc(iddoc, 26);
}
function delDoc27(iddoc) {
	deleteAdmissionDoc(iddoc, 27);
}
function delDoc28(iddoc) {
	deleteAdmissionDoc(iddoc, 28);
}
function delDoc29(iddoc) {
	deleteAdmissionDoc(iddoc, 29);
}
function delDoc30(iddoc) {
	deleteAdmissionDoc(iddoc, 30);
}
function delDoc31(iddoc) {
	deleteAdmissionDoc(iddoc, 31);
}
function delDoc32(iddoc) {
	deleteAdmissionDoc(iddoc, 32);
}
function delDoc33(iddoc) {
	deleteAdmissionDoc(iddoc, 33);
}
function delDoc34(iddoc) {
	deleteAdmissionDoc(iddoc, 34);
}
function delDoc35(iddoc) {
	deleteAdmissionDoc(iddoc, 35);
}
function delDoc36(iddoc) {
	deleteAdmissionDoc(iddoc, 36);
}
function delDoc37(iddoc) {
	deleteAdmissionDoc(iddoc, 37);
}
function delDoc38(iddoc) {
	deleteAdmissionDoc(iddoc, 38);
}
// Delete note from the admission doc table function
function delNote(id) {
	var noteDetails = $("#noteDetails").val();

	$.ajax({
		type: "POST",
		url: "getState.php",
		data: {
			clientID: id,
			noteDetailsDel: noteDetails
		},
		success: function (data) {
			Swal.fire('Deleted!', 'Record has been deleted.', 'success');
			setTimeout(function () {
				window.location.reload();
			}, 1000);
		}
	});
}
</script>