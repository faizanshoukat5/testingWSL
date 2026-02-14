<div class="mt-2">
	<a href="#">
		<div class="sessionFinancial">
			<p class="sessionYear"><b><span class="text-white">Intake Year</span><br><span class="text-white"><?php echo date("Y", strtotime($_SESSION['s_date']))." - ".date("Y", strtotime($_SESSION['e_date'])) ;?></span></b></p>
		</div>
	</a>
</div>