<div class="row">
	<div class="form-group col-md-6 col-lg-3">
		<label>Country</label>
		<select class="form-control" name="country-name" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="country-name">
			<option value="all" <?= isset($_GET['country-name']) && $_GET['country-name'] == 'all' ? 'selected' : '' ?>>All</option>
			<?php
			$country = select('country', $con);
			foreach ($country as $row) {
				$selected = isset($_GET['country-name']) && $_GET['country-name'] == $row['country_name'] ? 'selected' : '';
				?>
				<option value="<?= $row['country_name']; ?>" <?= $selected ?>><?= ucwords($row['country_name']); ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Client Status</label>
		<select class="form-control" name="client-convert-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-convert-status">
			<option value="all" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="New Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'New Client' ? 'selected' : '' ?>>New Client</option>
			<option value="Old Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Client' ? 'selected' : '' ?>>Old Client</option>
			<option value="Old Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Old Converted Client' ? 'selected' : '' ?>>Old Converted Client</option>
			<option value="Italy Old Client 2024" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Italy Old Client 2024' ? 'selected' : '' ?>>Italy Old Client 2024</option>
			<option value="Austria Converted Client" <?= isset($_GET['client-convert-status']) && $_GET['client-convert-status'] == 'Austria Converted Client' ? 'selected' : '' ?>>Austria Converted Client</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Country From</label>
		<select class="form-control" name="client-country" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-country">
			<option value="all" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Pakistan" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Pakistan' ? 'selected' : '' ?>>Pakistan</option>
			<option value="UAE" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'UAE' ? 'selected' : '' ?>>UAE</option>
			<option value="Saudi Arabia" <?= isset($_GET['client-country']) && $_GET['client-country'] == 'Saudi Arabia' ? 'selected' : '' ?>>Saudi Arabia</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Case</label>
		<select class="form-control" name="client-case" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-case">
			<option value="all" <?= isset($_GET['client-case']) && $_GET['client-case'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="cash case" <?= isset($_GET['client-case']) && $_GET['client-case'] == 'cash case' ? 'selected' : '' ?>>Cash Cases</option>
			<option value="online case" <?= isset($_GET['client-case']) && $_GET['client-case'] == 'online case' ? 'selected' : '' ?>>Online Cases</option>
			<option value="cash + online case" <?= isset($_GET['client-case']) && $_GET['client-case'] == 'cash + online case' ? 'selected' : '' ?>>Cash + Online Cases</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Degree</label>
		<select class="form-control" name="client-degree" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-degree">
			<option value="all" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="bachelor" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'bachelor' ? 'selected' : '' ?>>Bachelor</option>
			<option value="master" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'master' ? 'selected' : '' ?>>Master</option>
			<option value="mbbs" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'mbbs' ? 'selected' : '' ?>>MBBS</option>
			<option value="NonSDS" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'NonSDS' ? 'selected' : '' ?>>NonSDS</option>
			<option value="SDS" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'SDS' ? 'selected' : '' ?>>SDS</option>
			<option value="Canada Business Visit" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'Canada Business Visit' ? 'selected' : '' ?>>Canada Business Visit</option>
			<option value="Canada Tourist Vist" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'Canada Tourist Vist' ? 'selected' : '' ?>>Canada Tourist Vist</option>
			<option value="USA Study Visa" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'USA Study Visa' ? 'selected' : '' ?>>USA Study Visa</option>
			<option value="USA Business Visit" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'USA Business Visit' ? 'selected' : '' ?>>USA Business Visit</option>
			<option value="USA Tourist Visit" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'USA Tourist Visit' ? 'selected' : '' ?>>USA Tourist Visit</option>
			<option value="USA Business Visit / Tourist Visit (B1 - B2)" <?= isset($_GET['client-degree']) && $_GET['client-degree'] == 'USA Business Visit / Tourist Visit (B1 - B2)' ? 'selected' : '' ?>>USA Business Visit / Tourist Visit (B1 - B2)</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Date from</label>
		<input type="date" name="start-date" class="form-control" value="<?= isset($_GET['start-date']) ? $_GET['start-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="start-date">
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Date To</label>
		<input type="date" name="end-date" class="form-control" value="<?= isset($_GET['end-date']) ? $_GET['end-date'] : ''; ?>" onchange="viewClientsFilter(1)" id="end-date">
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Client Status</label>
		<select class="form-control" name="client-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="client-status">
			<option value="all" <?= isset($_GET['client-status']) && $_GET['client-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="New" <?= isset($_GET['client-status']) && $_GET['client-status'] == 'New' ? 'selected' : '' ?>>New</option>
			<option value="Process" <?= isset($_GET['client-status']) && $_GET['client-status'] == 'Process' ? 'selected' : '' ?>>Process</option>
			<option value="Forwarded" <?= isset($_GET['client-status']) && $_GET['client-status'] == 'Forwarded' ? 'selected' : '' ?>>Forwarded</option>
		</select>
	</div>
	
	<div class="form-group col-md-6 col-lg-3">
		<label>Process Status</label>
		<select class="form-control" name="process-status" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="process-status">
			<option value="all" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="Only Admission Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Only Admission Process' ? 'selected' : '' ?>>Only Admission Process</option>
			<option value="Overall Process" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Overall Process (Admission + Visa)' ? 'selected' : '' ?>>Overall Process (Admission + Visa)</option>
			<option value="Direct Visa" <?= isset($_GET['process-status']) && $_GET['process-status'] == 'Have Accepted Letter (Only Visa)' ? 'selected' : '' ?>>Have Accepted Letter (Only Visa)</option>
		</select>
	</div>
	<div class="form-group col-md-6 col-lg-3">
		<label>Intake</label>
		<select class="form-control" name="intake-year" required="required" autocomplete="off" onchange="viewClientsFilter(1)" id="intake-year">
			<option value="all" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'all' ? 'selected' : '' ?>>All</option>
			<option value="25-26" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '25-26' ? 'selected' : '' ?>>2025-2026</option>
			<option value="26-27" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == '26-27' ? 'selected' : '' ?>>2026-2027</option>
			<option value="Both" <?= isset($_GET['intake-year']) && $_GET['intake-year'] == 'Both' ? 'selected' : '' ?>>2025-2026/2026-2027(Both)</option>
		</select>
	</div>
</div>