<script type="text/javascript">
	function addNewUni(idUni){
		var idUni = idUni;
		$.ajax({
			type: "POST",
			url: "models/addUniversityState.php",
			data:'uniAddNew='+idUni,
			success: function(data){
				$(".showModalTitle").html('New University details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').on('shown.bs.modal', function () {
					$(this).find('input[type="checkbox"]').each(function () {
						$(this).on("change", function () {
							let hiddenInput = $("#hidden_" + this.id);
							if (hiddenInput.length) {
								hiddenInput.val(this.checked ? "1" : "0");
							}
						});
					});
				});

			}
		});
	}

	function editAddUni(idUni) {
		var idUni = idUni;
		$.ajax({
			type: "POST",
			url: "models/addUniversityState.php",
			data:'uniAddEdit='+idUni,
			success: function(data){
				$(".showModalTitle").html('Update University details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
				$('#showModalClient').on('shown.bs.modal', function () {
					$(this).find('input[type="checkbox"]').each(function () {
						$(this).on("change", function () {
							let hiddenInput = $("#hiddenUp_" + this.id);
							if (hiddenInput.length) {
								hiddenInput.val(this.checked ? "1" : "0");
							}
						});
					});
				});

			}
		});
	};
	//del University
	function delAddUni(idUni) {
		var idUni = idUni;
		$.ajax({
			type: "POST",
			url: "models/addUniversityState.php",
			data:'uniAddDel='+idUni,
			success: function(data){
				$(".showModalTitle").html('Delete details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	//View University
	function viewAddUni(idUni) {
		var idUni = idUni;
		$.ajax({
			type: "POST",
			url: "models/addUniversityState.php",
			data:'uniAddView='+idUni,
			success: function(data){
				$(".showModalTitle").html('View University details');
				$(".showModalClient").html(data);
				$("#showModalClient").modal('show');
			}
		});
	};
	function checkDelPassword(){
		var passID = $("#delUniPassword").val();
		if(passID=='EnterUni$#!'){
			$("#delBtn").prop('disabled', false);
		}
		else{
			$("#delBtn").prop('disabled', true);
		}
	}
</script>