<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// Programs Confirmation statement
if (isset($_POST['clientConfirmProgram'])) {
	$clientID = $_POST['clientConfirmProgram'];
	$select_query="SELECT client_country, client_applied, client_id from clients".$_SESSION['dbNo']." WHERE status='1' AND close='1' AND client_id='".$clientID."'";
	$select_query_ex = mysqli_query($con,$select_query);
	foreach ($select_query_ex as $rowCountry) {
		$country = $rowCountry['client_country'];
		$clientID = $rowCountry['client_id'];

		$changingApplied = $rowCountry['client_applied'];
		$appliedChanging = json_decode($changingApplied, true);
	}
	?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
			<thead>
				<tr>
					<th>Sr.</th>
					<th>University</th>
					<th>Program</th>
					<th>Intake</th>
					<th>Status</th>
					<th>Entry By</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$sr=1;
			if ($country=='austria') {
				$select_query = "SELECT * from austria_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND (close='1' || close='0') AND aus_clients_id='".$clientID."' ";
				$select_query_ex = mysqli_query($con,$select_query);
				foreach ($select_query_ex as $row) {
				?>
				<tr id="<?php echo $row['aus_client_pro_id']; ?>">
					<td><?php echo $sr;?></td>
					<td><?php echo ucwords($row['aus_university_name']);?></td>
					<td><?php echo $row['aus_program_name']; ?> </td>
					<td><?php echo ucwords($row['aus_intake']);?></td>
					<td>
						<?php if ($row['close']=='0') {
							echo '<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="This is Program add Incorrectly.">Incorrect</span>';
						} ?>
					</td>
					<?php 
						$wt = "SELECT fname, lname from wt_users WHERE close='1' AND status='1' AND wt_id='".$row['entry_by']."'";
						$wt_ex = mysqli_query($con,$wt);
						foreach ($wt_ex as $wtrow) {
							$dealName = $wtrow['fname']." ".$wtrow['lname'];
						}
					?>
					<td><?php echo ucwords($dealName);?></td>
				</tr>
			<?php $sr++; }
			}elseif ($country=='czech republic') {
				$select_query = "SELECT * from czech_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND (close='1' || close='0') AND czech_clients_id='".$clientID."' ";
				$select_query_ex = mysqli_query($con,$select_query);
				foreach ($select_query_ex as $row) {
				?>
				<tr id="<?php echo $row['czech_client_pro_id']; ?>">
					<td><?php echo $sr;?></td>
					<td><?php echo ucwords($row['czech_university_name']);?></td>
					<td><?php echo $row['czech_program_name']; ?> </td>
					<td><?php echo ucwords($row['czech_intake']);?></td>
					<td>
						<?php if ($row['close']=='0') {
							echo '<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="This is Program add Incorrectly.">Incorrect</span>';
						} ?>
					</td>
					<?php 
						$wt = "SELECT fname, lname from wt_users WHERE close='1' AND status='1' AND wt_id='".$row['entry_by']."'";
						$wt_ex = mysqli_query($con,$wt);
						foreach ($wt_ex as $wtrow) {
							$dealName = $wtrow['fname']." ".$wtrow['lname'];
						}
					?>
					<td><?php echo ucwords($dealName);?></td>
				</tr>
			<?php $sr++; }
			}elseif($country=='italy'){
					
				$select_query = "SELECT * from italy_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND (close='1' || close='0') AND italy_clients_id='".$clientID."' ";
				$select_query_ex = mysqli_query($con,$select_query);
				foreach ($select_query_ex as $row) {
				?>
				<tr id="<?php echo $row['italy_client_pro_id']; ?>">
					<td><?php echo $sr;?></td>
					<td><?php echo ucwords($row['italy_university_name']);?></td>
					<td><?php echo $row['italy_program_name']; ?></td>
					<td><?php echo ucwords($row['italy_intake']);?></td>
					<td>
						<?php if ($row['close']=='0') {
							echo '<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="This is Program add Incorrectly.">Incorrect</span>';
						} ?>
					</td>
					<?php 
						$wt = "SELECT fname, lname from wt_users WHERE close='1' AND status='1' AND wt_id='".$row['entry_by']."'";
						$wt_ex = mysqli_query($con,$wt);
						foreach ($wt_ex as $wtrow) {
							$dealName = $wtrow['fname']." ".$wtrow['lname'];
						}
					?>
					<td><?php echo ucwords($dealName);?></td>
				</tr>
				<?php $sr++;} ?>
				

			<?php }elseif($country=='france'){
					
				$select_query = "SELECT * from france_clients_programs".$_SESSION['dbNo']." WHERE status = '1' AND (close='1' || close='0') AND france_clients_id='".$clientID."' ";
				$select_query_ex = mysqli_query($con,$select_query);
				foreach ($select_query_ex as $row) {
				?>
				<tr id="<?php echo $row['france_client_pro_id']; ?>">
					<td><?php echo $sr;?></td>
					<td><?php echo ucwords($row['france_university_name']);?></td>
					<td><?php echo $row['france_program_name']; ?></td>
					<td><?php echo ucwords($row['france_intake']);?></td>
					<td>
						<?php if ($row['close']=='0') {
							echo '<span class="badge bg-purple" data-toggle="tooltip" data-placement="top" title="This is Program add Incorrectly.">Incorrect</span>';
						} ?>
					</td>
					<?php 
						$wt = "SELECT fname, lname from wt_users WHERE close='1' AND status='1' AND wt_id='".$row['entry_by']."'";
						$wt_ex = mysqli_query($con,$wt);
						foreach ($wt_ex as $wtrow) {
							$dealName = $wtrow['fname']." ".$wtrow['lname'];
						}
					?>
					<td><?php echo ucwords($dealName);?></td>
				</tr>
				<?php $sr++;} ?>
				

			<?php }else{ ?>
				<tr>
					<td colspan="6">
						<div class="alert alert-info text-center">
							<b>Programs not Added</b>
						</div>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php }


?>