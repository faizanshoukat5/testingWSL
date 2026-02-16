<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Add note of programs
if (isset($_POST['guideUniName'])) {
	$guideName = $_POST['guideUniName'];
?>
	<?php 
	if ($guideName=='CaFoscari') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to Pay Foscari Application fee.ogg",
			"Which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/foscari guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/foscari guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
		<div class="col-md-6">
			<div class="card-box">
				<div class="embed-responsive embed-responsive-16by9">
					<video class="embed-responsive-item" width="100%" controls>
						<source src="../italy-videos/application guideline/foscari guideline/Foscari payment video.mp4" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Sapienza') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to Pay application Fee.ogg",
			"Which ATM card use for Payment.ogg",
			"Application Fee Payment Deadline.ogg",
			"Download your recipt after payment.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/sapienza guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/sapienza guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Politecnica') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to Pay application fee.ogg",
			"which ATM card use for Payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/marche guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/marche guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Bologna') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to pay application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/bologna guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
	</div>
	<?php
	}
	elseif ($guideName=='Campania') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Messina') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to Pay Application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/messina guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/messina guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Napoli') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Padua') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to pay application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/padua guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/padua guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Palermo') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Pavia') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"Pavia application fee requirement.ogg",
			"How to pay aplication fee.ogg",
			"Which ATM Card use for Application fee.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/pavia guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/pavia guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Perugia') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Siena') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Appication.ogg",
			"Siena Fee requirements.ogg",
			"How to pay application fee.ogg",
			"Which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/siena guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/siena guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Trieste') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"How to pay application fee.ogg",
			"Card guidance.ogg",
			"which ATM card use for payment.ogg",
			"File rechecking and submission.ogg"
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
	<?php
	}
	elseif ($guideName=='Turin') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to pay application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/turin guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/turin guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Cassino') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to Pay Application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/cassino guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
	</div>
	<?php
	}
	elseif ($guideName=='Bergamo') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to Pay Application fee.ogg",
			"which ATM card use for Payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/bergamo guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
	</div>
	<?php
	}
	elseif ($guideName=='Ferrara') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the application.ogg",
			"How to pay application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/ferrara guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/ferrara guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Florence') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to pay application fee.ogg",
			"Which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/florence guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/florence guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Foggia') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Genevo') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Genova application procedure and fee guidance part 1.ogg",
			"Fee guidance part 2.ogg",
			"Payment card guidance.ogg",
			"Application filling and  submission guidance.ogg",
			"Email guide.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/genevo guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<div class="card-box">
				<div class="embed-responsive embed-responsive-16by9">
					<video class="embed-responsive-item" width="100%" controls>
						<source src="../italy-videos/application guideline/genevo guideline/video guide.mp4" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Pisa') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Appication.ogg",
			"How to pay application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/pisa guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/pisa guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Salerno') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Verona') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Trento') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to pay application fee.ogg",
			"Which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/trento guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="../italy-videos/application guideline/trento guideline/Application Fee Guidelines.pdf" target="_blank">Application Fee Guidelines.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Tuscia') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Laquia') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Parma') {
	?>
	<div class="row">
		<div class="col-md-12">
			<p>Universities processing time approx. 6-8 weeks (working days)</p>
			<p>If the number of applications is high, the response can be delayed </p>
			<p>please stay active on your email and when you'll receive any response from the university then inform us</p>
		</div>
	</div>
	<?php	
	}
	elseif ($guideName=='MilanoBiccoca') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Recheck the Application.ogg",
			"How to Pay application fee.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/milano guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
	</div>
	<?php
	}
	elseif ($guideName=='TorVergata') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"How to Pay Application fee.ogg",
			"which ATM card use for payment.ogg",
			"Application Fee Payment Deadline.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="../italy-videos/application guideline/tor guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
	</div>
	<?php
	}
	elseif ($guideName=='LaquilaLAQ') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"Payment guidance via bank.ogg",
			"Payment guidance online.ogg",
			"word file instructions.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="https://crm.wslcms.com/italy-videos/application guideline/LaquilaLAQ guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<label>Application Fee Guidelines <span class="text-danger">Click to Download</span></label> <br>
			<a href="https://crm.wslcms.com/italy-videos/application guideline/LaquilaLAQ guideline/Fee_Payment_Instructions_With_Margins.pdf" target="_blank">Fee_Payment_Instructions_With_Margins.pdf </a>
		</div>
	</div>
	<?php
	}
	elseif ($guideName=='Unicamillus') {
	?>
	<div class="row">
		
	</div>
	<?php
	}
	elseif ($guideName=='Camerino') {
	?>
	<div class="row">
		<?php
		$audioFiles = [
			"01 Camerino university guidance.ogg",
			"02 Fee guidance.ogg",
			"03 Payment card guidance.ogg",
			"04 Video guidance.ogg"
		];
		$sr=1;
		foreach ($audioFiles as $file) { ?>
		<div class="col-md-4">
			<label><b><?php echo $sr;?>:) <?php echo $file;?></b></label><br>
			<audio controls preload="auto" id="audio-<?php echo $sr; ?>" data-index="<?php echo $sr; ?>">
				<source src="https://crm.wslcms.com/italy-videos/application guideline/camerino guideline/<?php echo $file;?> " type="audio/ogg">
				Your browser does not support the audio element.
			</audio>
		</div>
		<?php
		$sr++; }
		?>
		<div class="col-md-4">
			<div class="card-box">
				<div class="embed-responsive embed-responsive-16by9">
					<video class="embed-responsive-item" width="100%" controls>
						<source src="https://crm.wslcms.com/italy-videos/application guideline/camerino guideline/Camerino video.mp4" type="video/mp4">
						Your browser does not support the video tag.
					</video>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
<?php 
} ?>