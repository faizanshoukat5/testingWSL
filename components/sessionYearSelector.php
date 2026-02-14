<!-- change sesson year select -->
<div class="d-flex justify-content-center">
	<select class="form-control mt-1 text-center " style="width: 200px;" onchange="sessionHeaderStart();" id="headStart">
		<?php
		$srNo = $_SESSION['dbNo'];
		$query = " SELECT * FROM session_year WHERE close='1' AND status='1' ORDER BY (sy_id = '$srNo') DESC, start_date DESC ";
		$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_assoc($result)) {
		?>
		<option value="<?php echo $row['sy_id'];?>" <?php if($row['sy_id'] == $srNo) echo 'selected'; ?>> <?php echo date("Y", strtotime($row['start_date']))." - ".date("Y", strtotime($row['end_date'])); ?> </option>
		<?php } ?>
	</select>
</div>