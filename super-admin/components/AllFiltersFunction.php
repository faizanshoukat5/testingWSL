<script>
	$(document).ready(function(){
		var page = $("#page-number").val();
		viewClientsFilter(page);
	});

	function debounce(func, delay) {
		let timer;
		return function(...args) {
			clearTimeout(timer);
			timer = setTimeout(() => func.apply(this, args), delay);
		};
	}
	const debouncedViewClientsFilter = debounce(viewClientsFilter, 500);

	function viewClientsFilter(page) {
		var countryName = $("#country-name").val();
		var convertStatus = $("#client-convert-status").val();
		var clientCountry = $("#client-country").val();
		var clientCase = $("#client-case").val();
		var clientDegree = $("#client-degree").val();
		var startDate = $("#start-date").val(); 
		var endDate = $("#end-date").val();
		var clientStatus = $("#client-status").val();
		var processStatus = $("#process-status").val();
		var intakeYear = $("#intake-year").val();

		var selectPage = $("#selectPage").val();
		var pageNo = page || $("#page-number").val();
		$("#page-number").val(pageNo);
		var clientIDGet = $("#clientIDGet").val();

		var params = new URLSearchParams(window.location.search);
		if (countryName!== 'all') {
			params.set('country-name', countryName);
		}else {
			params.delete('country-name');
		}
		if (convertStatus!== 'all') {
			params.set('client-convert-status', convertStatus);
		}else {
			params.delete('client-convert-status');
		}
		if (clientCountry!== 'all') {
			params.set('client-country', clientCountry);
		}else {
			params.delete('client-country');
		}
		if (clientCase!== 'all') {
			params.set('client-case', clientCase);
		}else {
			params.delete('client-case');
		}
		if (clientDegree!== 'all') {
			params.set('client-degree', clientDegree);
		}else {
			params.delete('client-degree');
		}
		if (startDate || endDate) {
			params.set('start-date', startDate);
			params.set('end-date', endDate);
		}else {
			params.delete('start-date');
			params.delete('end-date');
		}
		if (clientStatus!== 'all') {
			params.set('client-status', clientStatus);
		}else {
			params.delete('client-status');
		}
		if (processStatus!== 'all') {
			params.set('process-status', processStatus);
		}else {
			params.delete('process-status');
		}
		if (intakeYear!== 'all') {
			params.set('intake-year', intakeYear);
		}else {
			params.delete('intake-year');
		}
		if (pageNo == 1) {
			params.delete('page-number');
		}else {
			params.set('page-number', pageNo);
		}

		if (params.toString()) {
			window.history.replaceState({}, '', `${window.location.pathname}?${params}`);
		}else{
			window.history.replaceState({}, '', `${window.location.pathname}`);
		}

		$("#loader").show();
		$("#showClientsModel").hide();

		$.ajax({
			type: "POST",
			url: "<?= $ajaxUrl ?>",
			data: {
				checkcountryName: countryName,
				checkconvertStatus: convertStatus,
				checkclientCountry: clientCountry,
				checkclientCase: clientCase,
				checkclientDegree: clientDegree,
				checkstartDate: startDate,
				checkendDate: endDate,
				checkclientStatus: clientStatus,
				checkprocessStatus: processStatus,
				checkintakeYear: intakeYear,
				checkselectPage: selectPage,
				pageNumber: pageNo,
				checkclientDetails: clientIDGet,
			},
			success: function(data) {
				// alert(data);
				$("#loader").hide();
				$("#showClientsModel").html(data);
				$("#showClientsModel").show();
			}
		});
	}
</script>
