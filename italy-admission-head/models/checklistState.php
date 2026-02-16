<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');

// delete italy checklist
if (isset($_POST['checklistItalyDel'])) {
	$listId = $_POST['checklistItalyDel'];
	$close=0;
	$del_query = "UPDATE italy_clients_checklist".$_SESSION['dbNo']." SET close = '".$close."' WHERE italy_checklist_id = '".$listId."'";
	$del_query_ex = mysqli_query($con,$del_query);
}

// italy check list name
if (isset($_POST['checkitalylistName'])) {
	$checkClientID = $_POST['checkClientID'];
	$checkitalylistName = $_POST['checkitalylistName'];
	$select_query = "SELECT * FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' ";
	$select_query_ex = mysqli_query($con,$select_query);
	if($select_query_ex){
		foreach ($select_query_ex as $row){
			if ($row['italy_client_check_id'] == $checkClientID && $row['italy_checklist_name'] == $checkitalylistName){
				echo "yes";
			}
		}
	}else{
		echo "error";
	}
}

if (isset($_POST['checkClientName'])) {
	$checkClientName = $_POST['checkClientName'];

	if ($checkClientName=='Punjab DOV' || $checkClientName=='Punjab Visa') {
		
		$clientData = "SELECT client_id, client_name, client_province from clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE cl.close='1' AND cl.status='1' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND (cl.client_province='punjab' || cl.client_province='KPK') GROUP BY cl.client_id ORDER BY client_id DESC ";
		$clientData_ex = mysqli_query($con,$clientData);

		?>
		<label>Select Client <span class="text-danger">*</span></label>
		<select class="form-control" data-toggle='select2' name="clientID[]" required="required" autocomplete="off" id="clientNameGetID" onchange="checklistAlready()">
			<option selected value disabled class="text-center">--- Select Client ---</option>
		<?php
		foreach ($clientData_ex as $row) {
			$balClient="SELECT pay_bal_amount from clients_payments".$_SESSION['dbNo']." WHERE cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments GROUP BY pay_client_id) AND pay_client_id='".$row['client_id']."' GROUP BY pay_client_id" ;
			$balClient_ex = mysqli_query($con,$balClient);
			foreach ($balClient_ex as $balrow) {
				$sumBalance = $balrow['pay_bal_amount'];
				if ($sumBalance!='0') {

				}else{
					?>
					<option value="<?php echo $row['client_id'];?>"><?php echo ucwords($row['client_name']." / ".$row['client_province']);?></option>
					<?php
				}
			}
			?>
		<?php }?>
		</select>
		<script type="text/javascript">$('[data-toggle="select2"]').select2();</script>
		<?php

	}
	elseif ($checkClientName=='Sindh Cimea' || $checkClientName=='Sindh Visa') {

		$clientData = "SELECT client_id, client_name, client_province from clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE cl.close='1' AND cl.status='1' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND cl.client_province='sindh' GROUP BY cl.client_id ORDER BY client_id DESC ";
		$clientData_ex = mysqli_query($con,$clientData);
		?>
		<label>Select Client <span class="text-danger">*</span></label>
		<select class="form-control" data-toggle='select2' name="clientID[]" required="required" autocomplete="off" id="clientNameGetID" onchange="checklistAlready()">
			<option selected value disabled class="text-center">--- Select Client ---</option>
		<?php
		foreach ($clientData_ex as $row) {
			$balClient="SELECT pay_bal_amount from clients_payments".$_SESSION['dbNo']." WHERE cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments GROUP BY pay_client_id) AND pay_client_id='".$row['client_id']."' GROUP BY pay_client_id" ;
			$balClient_ex = mysqli_query($con,$balClient);
			foreach ($balClient_ex as $balrow) {
				$sumBalance = $balrow['pay_bal_amount'];
				if ($sumBalance!='0') {

				}else{
					?>
					<option value="<?php echo $row['client_id'];?>"><?php echo ucwords($row['client_name']." / ".$row['client_province']);?></option>
					<?php
				}
			}
			?>
		<?php }?>
		</select>
		<script type="text/javascript">$('[data-toggle="select2"]').select2();</script>
		<?php

	}
	elseif ($checkClientName=='UAE Cimea' || $checkClientName=='UAE Visa') {

		$clientData = "SELECT client_id, client_name, client_province from clients{$_SESSION['dbNo']} cl JOIN italy_clients_programs{$_SESSION['dbNo']} icp ON cl.client_id = icp.italy_clients_id WHERE cl.close='1' AND cl.status='1' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.client_country='italy' AND cl.client_province='uae' GROUP BY cl.client_id ORDER BY client_id DESC ";
		$clientData_ex = mysqli_query($con,$clientData);
		?>
		<label>Select Client <span class="text-danger">*</span></label>
		<select class="form-control" data-toggle='select2' name="clientID[]" required="required" autocomplete="off" id="clientNameGetID" onchange="checklistAlready()">
			<option selected value disabled class="text-center">--- Select Client ---</option>
		<?php
		foreach ($clientData_ex as $row) {
			$balClient="SELECT pay_bal_amount from clients_payments".$_SESSION['dbNo']." WHERE cl_pay_id IN (SELECT MAX(cl_pay_id) FROM clients_payments GROUP BY pay_client_id) AND pay_client_id='".$row['client_id']."' GROUP BY pay_client_id" ;
			$balClient_ex = mysqli_query($con,$balClient);
			foreach ($balClient_ex as $balrow) {
				$sumBalance = $balrow['pay_bal_amount'];
				if ($sumBalance!='0') {

				}else{
					?>
					<option value="<?php echo $row['client_id'];?>"><?php echo ucwords($row['client_name']." / ".$row['client_province']);?></option>
					<?php
				}
			}
			?>
		<?php }?>
		</select>
		<script type="text/javascript">$('[data-toggle="select2"]').select2();</script>
		<?php

	}

}

if (isset($_POST['clientNameGetID'])) {
	$checklistName = $_POST['checklistName'];
	if ($checklistName=='Punjab DOV') {
		$nameList = 'DOV';
	}elseif($checklistName=='Punjab Visa'){
		$nameList = 'Visa';
	}elseif($checklistName=='Sindh Cimea' || $checklistName=='UAE Cimea'){
		$nameList = 'Cimea';
	}
	elseif($checklistName=='Sindh Visa' || $checklistName=='UAE Visa'){
		$nameList = 'Visa';
	}
	$clientNameGetID = $_POST['clientNameGetID'];
	$select_query = "SELECT * FROM italy_clients_checklist".$_SESSION['dbNo']." WHERE close='1' AND status='1' ";
	$select_query_ex = mysqli_query($con,$select_query);
	if($select_query_ex){
		foreach ($select_query_ex as $row){
			if ($row['italy_client_check_id'] == $clientNameGetID && $row['italy_checklist_name'] == $nameList){
				echo "yes";
			}
		}
	}else{
		echo "error";
	}
}

// Dashboard Master Bachelor University show page
if (isset($_POST['uniAppliedInfo'])) {
	$uniAppliedInfo = $_POST['uniAppliedInfo'];
	?>
	<h4 class="text-center"><?php echo ucwords($uniAppliedInfo);?> Universities IELTS/Withnot IELTS/Application Fee</h4>
	<div class="table-responsive">
		<table class="table table-striped table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 10px;">Sr No.</th>
					<th style="width: 120px;">University Name</th>
					<th style="width: 50px;">IELTS</th>
					<th style="width: 50px;">Application Fee</th>
				</tr>
			</thead>
			<tbody>
			<?php if($uniAppliedInfo=='master'){ ?>
				<tr>
					<td>1</td>
					<td><b>CaFoscari University of Venice (FV)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>2</td>
					<td><b>Sapienza University of Rome (SPU)</b></td>
					<td>Min 5.5 Bands/ 59 PTE </td>
					<td>30 Euro Per Program </td>
				</tr>
				<tr>
					<td>3</td>
					<td><b>Universita Politecnica Delle Marche (MR)</b></td>
					<td>Not Required </td>
					<td>10 Euro Per Program </td>
				</tr>
				<tr>
					<td>4</td>
					<td><b>University of Bologna (UBN)</b></td>
					<td>Min 5.5 Bands/ 59 PTE /Tofel </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>5</td>
					<td><b>University of Campania (UC)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>6</td>
					<td><b>University of Messina (UM)</b></td>
					<td>Min 5.5 Bands/ 59 PTE  </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>7</td>
					<td><b>University of Napoli Fedrico II (UNP)</b></td>
					<td>Not Required </td>
					<td>N/A</td>
				</tr>
				<tr>
					<td>8</td>
					<td><b>University of Padua (PDU)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>9</td>
					<td><b>University of Palermo (PLM)</b></td>
					<td>Not Required </td>
					<td>N/A</td>
				</tr>
				<tr>
					<td>10</td>
					<td><b>University of Pavia (PV)</b></td>
					<td>Not Required </td>
					<td>35 Euro Per Program</td>
				</tr>
				<tr>
					<td>11</td>
					<td><b>University of Perugia (UPG)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>12</td>
					<td><b>University of Siena (US)</b></td>
					<td>Not Required </td>
					<td>50 Euro </td>
				</tr>
				<tr>
					<td>13</td>
					<td><b>University of Trieste (TR)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>14</td>
					<td><b>University of Turin (TU)</b></td>
					<td>Min 5.5 Bands/ 59 PTE  </td>
					<td>60 Euro </td>
				</tr>
				<tr>
					<td>15</td>
					<td><b>University of Bergamo (BR)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>16</td>
					<td><b>University of Ferrara (FR)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>17</td>
					<td><b>University of Florence (UF)</b></td>
					<td>Not Required </td>
					<td>20 Euro </td>
				</tr>
				<tr>
					<td>18</td>
					<td><b>University of Foggia (FG)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>19</td>
					<td><b>University of Genevo (UG)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>20</td>
					<td><b>University of Pisa (UP)</b></td>
					<td>Only for Cybersecurity </td>
					<td>10 Euro Per Program </td>
				</tr>
				<tr>
					<td>21</td>
					<td><b>University of Salerno (SL)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>22</td>
					<td><b>University of Trento (TRN)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>23</td>
					<td><b>University of Verona (VN)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>24</td>
					<td><b>University of Tuscia (TS02)</b></td>
					<td>No IELTS</td>
					<td>No application fee </td>
				</tr>
				<tr>
					<td>25</td>
					<td><b>University of Laquia (LAQ01)</b></td>
					<td>No IELTS</td>
					<td>No application fee </td>
				</tr>
				<tr>
					<td>26</td>
					<td><b>University of Milano Biccoca (MLB)</b></td>
					<td></td>
					<td></td>
				</tr>

			<?php }elseif($uniAppliedInfo=='bachelor'){ ?>
				<tr>
					<td>1</td>
					<td><b>CaFoscari University of Venice (FV)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>2</td>
					<td><b>Sapienza University of Rome (SPU)</b></td>
					<td>Min 5.5 Bands/ 59 PTE </td>
					<td>30 Euro Per Program </td>
				</tr>
				<tr>
					<td>3</td>
					<td><b>Universita Politecnica Delle Marche (MR)</b></td>
					<td>Min 5.5 Bands/ 59 PTE </td>
					<td>10 Euro Per Program </td>
				</tr>
				<tr>
					<td>4</td>
					<td><b>University of Bologna (UBN)</b></td>
					<td>Min 5.5 Bands/ 59 PTE /Tofel </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>5</td>
					<td><b>University of Campania (UC)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>6</td>
					<td><b>University of Messina (UM)</b></td>
					<td>Min 5.5 Bands/ 59 PTE  </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>7</td>
					<td><b>University of Napoli Fedrico II (UNP)</b></td>
					<td>Not Required </td>
					<td>N/A</td>
				</tr>
				<tr>
					<td>8</td>
					<td><b>University of Padua (PDU)</b></td>
					<td>Not Required </td>
					<td>30 Euro </td>
				</tr>
				<tr>
					<td>9</td>
					<td><b>University of Palermo (PLM)</b></td>
					<td>Not Required </td>
					<td>N/A</td>
				</tr>
				<tr>
					<td>10</td>
					<td><b>University of Pavia (PV)</b></td>
					<td>Not Required </td>
					<td>35 Euro Per Program</td>
				</tr>
				<tr>
					<td>11</td>
					<td><b>University of Perugia (UPG)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>12</td>
					<td><b>University of Siena (US)</b></td>
					<td>Not Required </td>
					<td>50 Euro Per Program </td>
				</tr>
				<tr>
					<td>13</td>
					<td><b>University of Trieste (TR)</b></td>
					<td>Not Required </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>14</td>
					<td><b>University of Turin (TU)</b></td>
					<td>Min 5.5 Bands/ 59 PTE  </td>
					<td>N/A </td>
				</tr>
				<tr>
					<td>15</td>
					<td><b>University of Cassino (CS)</b></td>
					<td>Min 5.5 Bands/ 59 PTE  </td>
					<td>10 Euro Per program </td>
				</tr>
				<!-- <tr>
					<td>16</td>
					<td><b>University of Tuscia (TS02)</b></td>
					<td></td>
					<td></td>
				</tr> -->

				<tr>
					<td>16</td>
					<td><b>University of Milano Biccoca (MLB)</b></td>
					<td></td>
					<td></td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
<?php
}

?>