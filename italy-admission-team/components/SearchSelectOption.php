<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="dataTables_length" id="datatable_length">
			<label>Show 
				<select name="datatable_length" aria-controls="datatable" class="custom-select custom-select-sm form-control form-control-sm" onchange="viewClientsFilter(1)" id="selectPage">
					<option value="10">10</option>
					<option value="25">25</option>
					<option value="50">50</option>
					<option value="100">100</option>
					<option value="200">200</option>
					<option value="500">500</option>
				</select> 
			entries</label>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="float-right">
			<label>Search:<input type="text" name="" class="form-control form-control-sm" onkeyup="debouncedViewClientsFilter(1)" id="clientIDGet" style="margin-left: 0.5em; display: inline-block; width: auto;"></label>
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
<div id="showClientsModel"></div>