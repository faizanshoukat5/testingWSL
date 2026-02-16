<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

if (isset($_POST['testViewGuide'])) {
	$testViewGuide = $_POST['testViewGuide'];
?>	
	<div class="tabs-vertical-env">
		<div class="row">
			<div class="col-sm-3">
				<div class="nav flex-column nav-pills tabs-vertical" role="tablist" aria-orientation="vertical">
					<a class="nav-link mb-1 active" id="TOLCIEF-tab" data-toggle="pill" href="#TOLCIEF" role="tab" aria-controls="TOLCIEF" aria-selected="true">
						<span class="d-inline-block">English TOLC E - TOLC F - TOLC I Guide</span>
					</a>
					<a class="nav-link mb-1" id="SienaEntryTestGuide-tab" data-toggle="pill" href="#SienaEntryTestGuide" role="tab" aria-controls="SienaEntryTestGuide" aria-selected="false">
						<span class="d-inline-block">Siena Entry Test Guide</span>
					</a>

					<a class="nav-link mb-1" id="BergamoInterviewGuide-tab" data-toggle="pill" href="#BergamoInterviewGuide" role="tab" aria-controls="BergamoInterviewGuide" aria-selected="false">
						<span class="d-inline-block">Bergamo Interview Guide</span>
					</a>
					<a class="nav-link mb-1" id="GenovaTestInterviewGuide-tab" data-toggle="pill" href="#GenovaTestInterviewGuide" role="tab" aria-controls="GenovaTestInterviewGuide" aria-selected="false">
						<span class="d-inline-block">Genova Entry Test & Interview Guide</span>
					</a>
					<a class="nav-link mb-1" id="TrentoVideoGuide-tab" data-toggle="pill" href="#TrentoVideoGuide" role="tab" aria-controls="TrentoVideoGuide" aria-selected="false">
						<span class="d-inline-block">Trento Video Guide</span>
					</a>
					<a class="nav-link mb-1" id="FoscariEntryTestGuide-tab" data-toggle="pill" href="#FoscariEntryTestGuide" role="tab" aria-controls="FoscariEntryTestGuide" aria-selected="false">
						<span class="d-inline-block">Foscari Entry Test Guide</span>
					</a>
					<a class="nav-link mb-1" id="PaviaInterviewGuide-tab" data-toggle="pill" href="#PaviaInterviewGuide" role="tab" aria-controls="PaviaInterviewGuide" aria-selected="false">
						<span class="d-inline-block">Pavia Interview Guide</span>
					</a>
					<a class="nav-link mb-1" id="MarcheInterviewGuide-tab" data-toggle="pill" href="#MarcheInterviewGuide" role="tab" aria-controls="MarcheInterviewGuide" aria-selected="false">
						<span class="d-inline-block">Marche Interview Guide</span>
					</a>
					<a class="nav-link mb-1" id="TriesteApplicationFee-tab" data-toggle="pill" href="#TriesteApplicationFee" role="tab" aria-controls="TriesteApplicationFee" aria-selected="false">
						<span class="d-inline-block">Trieste Application Fee Guide</span>
					</a>

					<a class="nav-link mb-1" id="ScholarshipApplicationFee-tab" data-toggle="pill" href="#ScholarshipApplicationFee" role="tab" aria-controls="ScholarshipApplicationFee" aria-selected="false">
						<span class="d-inline-block">Scholarship Details</span>
					</a>

					<a class="nav-link mb-1" id="CEnT-S-tab" data-toggle="pill" href="#CEnT-S" role="tab" aria-controls="CEnT-S" aria-selected="false">
						<span class="d-inline-block">CEnT-S Test</span>
					</a>
				</div>
			</div>

			<div class="col-sm-9">
				<div class="tab-content pt-0">
					<div id="showToastLink" class="toast">Link copied to clipboard!</div>
					<div class="tab-pane fade active show" id="TOLCIEF" role="tabpanel" aria-labelledby="TOLCIEF-tab">
						<!-- TOLC E -->
						<div class="row">
							<div class="col-md-12">
								<h4><mark>English TOLC E</mark></h4>
								<h5>TOLC E Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcE&Vo25YQ1tYS=tolcE" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcE&Vo25YQ1tYS=tolcE</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('TOLCE')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. English TOLC Intro (part 1).ogg",
								"2. English TOLC Intro (part 2).ogg",
								"3. English TOLC Structure & fee.ogg",
								"4. English TOLC-E Guide.ogg",
								"5. English TOLC Instruction part 1.ogg",
								"6. English TOLC Instruction part 2.ogg",
								"7. English TOLC Instruction final part.ogg",
								"8. English TOLC - how to pay fee.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/English TOLC E/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-4">
								<label>Syllabus english TOLC-E <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/English TOLC E/Syllabus english TOLC-E.pdf" target="_blank">Syllabus english TOLC-E.pdf </a>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC E/TOLC Booking  Step 1.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC E/TOLC Booking  Step 2.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
						</div>
						<!-- TOLC F -->
						<div class="row">
							<div class="col-md-12">
								<h4><mark>English TOLC F</mark></h4>
								<h5>TOLC F Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcF&Vo25YQ1tYS=tolcF" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcF&Vo25YQ1tYS=tolcF</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('TOLCF')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. English TOLC Intro (part 1).ogg",
								"2. English TOLC Intro (part 2).ogg",
								"3. English TOLC Structure & fee.ogg",
								"4. English TOLC-F Guide.ogg",
								"5. English TOLC Instruction part 1.ogg",
								"6. English TOLC Instruction part 2.ogg",
								"7. English TOLC Instruction final part.ogg",
								"8. English TOLC - how to pay fee.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/English TOLC F/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-4">
								<label>Syllabus english TOLC-F <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/English TOLC F/Syllabus english TOLC-F.pdf" target="_blank">Syllabus english TOLC-F.pdf </a>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC F/TOLC Booking  Step 1.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC F/TOLC Booking  Step 2.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
						</div>
						<!-- TOLC I -->
						<div class="row">
							<div class="col-md-12">
								<h4><mark>English TOLC I</mark></h4>
								<h5>TOLC I Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcI&Vo25YQ1tYS=tolcI" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=tolcI&Vo25YQ1tYS=tolcI</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('TOLCI')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. English TOLC Intro (part 1).ogg",
								"2. English TOLC Intro (part 2).ogg",
								"3. English TOLC Structure & fee.ogg",
								"4. English TOLC-I Guide.ogg",
								"5. English TOLC Instruction part 1.ogg",
								"6. English TOLC Instruction part 2.ogg",
								"7. English TOLC Instruction final part.ogg",
								"8. English TOLC - how to pay fee.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/English TOLC I/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-4">
								<label>Syllabus english TOLC-I <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/English TOLC I/Syllabus english TOLC-I.pdf" target="_blank">Syllabus english TOLC-I.pdf </a>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC I/TOLC Booking  Step 1.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="../italy-videos/Test Interview Guide/English TOLC I/TOLC Booking  Step 2.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="tab-pane fade" id="SienaEntryTestGuide" role="tabpanel" aria-labelledby="SienaEntryTestGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Siena Test Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=siena&Vo25YQ1tYS=siena" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=siena&Vo25YQ1tYS=siena</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('SienaGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Siena Test Guide.ogg",
								"2. Siena Test Topics & Pattern.ogg",
								"3. Siena Test Time Guide.ogg",
								"4. Siena Test Instructions.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Siena Entry Test Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-12">
								<label>Siena Test Guidelines <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Siena Entry Test Guide/Siena Test Guidelines.pdf" target="_blank">Siena Test Guidelines.pdf </a>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="BergamoInterviewGuide" role="tabpanel" aria-labelledby="BergamoInterviewGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Bergamo Interview Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=bergamo&Vo25YQ1tYS=bergamo" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=bergamo&Vo25YQ1tYS=bergamo</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('BergamoGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Bergamo Interview Schedule.ogg",
								"2. Bergamo Interview Guide.ogg",
								"3. Bergamo Interview Instructions.ogg",
								"4. Bergamo Interview Important Note.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Bergamo Interview Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-12">
								<label>Bergamo Interview (Questionaries) <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Bergamo Interview Guide/Bergamo Interview (Questionaries).pdf" target="_blank">Bergamo Interview (Questionaries).pdf </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="GenovaTestInterviewGuide" role="tabpanel" aria-labelledby="GenovaTestInterviewGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Genova Test Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=genova&Vo25YQ1tYS=genova" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=genova&Vo25YQ1tYS=genova</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('GenovaGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Genova Test Guide.ogg",
								"2. Genova Test date & time.ogg",
								"3. Genova Test Structure.ogg",
								"4. Genova Test Instruction.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Genova Entry Test & Interview Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-12">
								<label>Genova Test Guidelines <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Genova Entry Test & Interview Guide/Genova Test Guidelines.pdf" target="_blank">Genova Test Guidelines.pdf </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="TrentoVideoGuide" role="tabpanel" aria-labelledby="TrentoVideoGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Trento Video Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=trento&Vo25YQ1tYS=trento" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=trento&Vo25YQ1tYS=trento</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('TrentoGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Trento Video Intro.ogg",
								"2. Trento Video Structure.ogg",
								"3. Trento Video - How to upload.ogg",
								"4. Trento Video Instruction.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Trento Video Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-4">
								<label>Trento Video Guidelines <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Trento Video Guide/Trento Video Guidelines.pdf" target="_blank">Trento Video Guidelines.pdf </a>
							</div>
							<div class="col-md-4">
								<label>Trento Video Importal Note <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Trento Video Guide/Trento Video Importal Note.pdf" target="_blank">Trento Video Importal Note.pdf </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="FoscariEntryTestGuide" role="tabpanel" aria-labelledby="FoscariEntryTestGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Foscari Test Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=foscari&Vo25YQ1tYS=foscari" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=foscari&Vo25YQ1tYS=foscari</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('FoscariGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Foscari Test Intro.ogg",
								"2. Foscari Test Date & Time.ogg",
								"3. Foscari Test Structure & Points.ogg",
								"4. Foscari Test - How to Install Proctor Exam app.ogg",
								"5. Foscari Test - If you face any Technical issue.ogg",
								"6. Foscari Test Confirmation Email.ogg",
								"7. Foscari Test Instructions.ogg",
								"8. Foscari Test General Rules.ogg",
								"9. Foscari Test Important Note.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/CaFoscari Test Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-6">
								<label>Foscari Entry Test Structure & Points Guidance <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/CaFoscari Test Guide/Foscari Entry Test Structure & Points Guidance.pdf" target="_blank">Foscari Entry Test Structure & Points Guidance.pdf </a>
							</div>
							<div class="col-md-6">
								<label>ProctorExam Installation & Guidance <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/CaFoscari Test Guide/ProctorExam Installation & Guidance.pdf" target="_blank">ProctorExam Installation & Guidance.pdf </a>
							</div>

						</div>
					</div>
					<div class="tab-pane fade" id="PaviaInterviewGuide" role="tabpanel" aria-labelledby="PaviaInterviewGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Pavia Interview Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=pavia&Vo25YQ1tYS=pavia" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=pavia&Vo25YQ1tYS=pavia</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('PaviaGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Pavia Interview intro.ogg",
								"2. Pavia Interview Guide.ogg",
								"3. Pavia Interview Date & Time.ogg",
								"4. Pavia Interview Instruction.ogg",
								"5. Pavia Interview Important Note.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Pavia Interview Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-12">
								<label>Pavia Interview (Questionaries) <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Pavia Interview Guide/Pavia Interview (Questionaries).pdf" target="_blank">Pavia Interview (Questionaries).pdf </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="MarcheInterviewGuide" role="tabpanel" aria-labelledby="MarcheInterviewGuide-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Marche Interview Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=marche&Vo25YQ1tYS=marche" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=marche&Vo25YQ1tYS=marche</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('MarcheGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1. Marche Interview Intro.mp3",
								"2. Marche Interview - How to book.mp3",
								"3. Marche Interview - confirmation email.ogg",
								"4. Marche Interview Instructions.ogg",
								"5. Marche Interview Important Note.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/Test Interview Guide/Marche Interview Guide/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
							<div class="col-md-6">
								<label>Marche Interview (Questionaries) <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Marche Interview Guide/Marche Interview (Questionaries).pdf" target="_blank">Marche Interview (Questionaries).pdf </a>
							</div>
							<div class="col-md-6">
								<label>Marche Interview Booked format <span class="text-danger">Click to Download</span></label> <br>
								<a href="../italy-videos/Test Interview Guide/Marche Interview Guide/Marche Interview Booked format.pdf" target="_blank">Marche Interview Booked format.pdf </a>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="TriesteApplicationFee" role="tabpanel" aria-labelledby="TriesteApplicationFee-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Trieste Application Fee Link: <a href="https://info.wslcms.com/application-guideline?neHinA0vER06=Trieste&guiDRafiA05S=Trieste" target="_blank">https://info.wslcms.com/application-guideline?neHinA0vER06=Trieste&guiDRafiA05S=Trieste</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('TriesteGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"How to pay fee.ogg",
								"which ATM card use for payment.ogg",
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="../italy-videos/application guideline/trieste guideline/<?php echo $file;?> " type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php
							$sr++; }
							?>
						</div>
					</div>


					<div class="tab-pane fade" id="ScholarshipApplicationFee" role="tabpanel" aria-labelledby="ScholarshipApplicationFee-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>Scholarship Details Link: <a href="https://info.wslcms.com/scholarship-details" target="_blank">https://info.wslcms.com/scholarship-details</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('ScholarshipGuide')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"scholarship-voices-part01.ogg",
								"scholarship-voices-part02.ogg",
								"scholarship-voices-part03.ogg",
								"scholarship-voices-part04.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="form-group col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="https://crm.wslcms.com/italy-videos/scholarship/<?php echo $file;?>" type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php 
							$sr++;}
							?>
						</div>
						<div class="row">
							<div class="form-group col-md-3">
								<label>Announcement</label> <br>
								<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image01.jpeg" width="220" height="300">
							</div>
							<div class="form-group col-md-3">
								<label>Income Certificate</label> <br>
								<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image02.jpeg" width="220" height="300">
							</div>
							<div class="form-group col-md-3">
								<label>Property Certificate</label> <br>
								<img src="https://crm.wslcms.com/italy-videos/scholarship/scholarship-image03.jpeg" width="220" height="300">
							</div>
							<div class="form-group col-md-3">
								<label>FRC</label> <br>
								<img src="https://crm.wslcms.com/italy-videos/scholarship/FRC.png" width="220" height="300">
							</div>
						</div>
					</div>


					<div class="tab-pane fade" id="CEnT-S" role="tabpanel" aria-labelledby="CEnT-S-tab">	
						<div class="row">
							<div class="col-md-12">
								<h5>CEnT-S Test Link: <a href="https://info.wslcms.com/interview-guide?zOObUTnevER06=cents0Test&Vo25YQ1tYS=cents0Test" target="_blank">https://info.wslcms.com/interview-guide?zOObUTnevER06=cents0Test&Vo25YQ1tYS=cents0Test</a> <button type="button" data-toggle="tooltip" data-placement="top" title="Copy" class="btn btn-info btn-sm" onclick="copyLink('CentsTest')"><i class="mdi mdi-content-copy"></i></button></h5>
							</div>
							<?php
							$audioFiles = [
								"1.CenT-S Introduction.ogg",
								"2.Detail Guidance About Test Booking.ogg",
								"3.Video Guidance.ogg",
								"4.Card Requirement for payment.ogg",
								"5.Structure of Cent-S.ogg",
								"6.Time period and result guidance.ogg"
							];
							$sr=1;
							foreach ($audioFiles as $file) { ?>
							<div class="form-group col-md-4">
								<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
								<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
									<source src="https://crm.wslcms.com/italy-videos/Test Interview Guide/CEnT-S Test/<?php echo $file;?>" type="audio/ogg">
									Your browser does not support the audio element.
								</audio>
							</div>
							<?php 
							$sr++;}
							?>
							<div class="col-md-6">
								<label>CEnT - S <span class="text-danger">Click to Download</span></label> <br>
								<a href="https://crm.wslcms.com/italy-videos/Test Interview Guide/CEnT-S Test/CEnT - S.pdf" target="_blank">CEnT - S.pdf </a>
							</div>
							<div class="col-md-6">
								<div class="card-box">
									<div class="embed-responsive embed-responsive-16by9">
										<video class="embed-responsive-item" width="100%" controls>
											<source src="https://crm.wslcms.com/italy-videos/Test Interview Guide/CEnT-S Test/CEnT-S Apply.mp4" type="video/mp4">
											Your browser does not support the video tag.
										</video>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>