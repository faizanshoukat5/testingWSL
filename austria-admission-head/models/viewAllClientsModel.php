<?php
ob_start();
session_start();
include_once("../../env/main-config.php");
include_once('selectFunction.php');
	if (isset($_POST['checkconvertStatus'])) {
		$clientStatus = $_POST['checkconvertStatus'];
		$clientCountry = $_POST['checkclientCountry'];
		$clientDegree = $_POST['checkclientDegree'];
		$processStatus = $_POST['checkprocessStatus'];
		$intakeYear = $_POST['checkintakeYear'];
		$sopStatus = $_POST['checksopStatus'];
		$checklistStatus = $_POST['checkchecklistStatus'];
		$assignPrograms = $_POST['checkassignPrograms'];
		$appliedPrograms = $_POST['checkappliedPrograms'];
		$checkApplication = $_POST['checkcheckApplication'];
		$uniStatus = $_POST['checkuniStatus'];
		$assignTo = $_POST['checkassignTo'];
		$current_date = date('Y-m-d');
		$clientDetails = isset($_POST['checkclientDetails']) ? trim($_POST['checkclientDetails']) : '';
		$page = isset($_POST['pageNumber']) ? (int)$_POST['pageNumber'] : 1;
		$limit = isset($_POST['checkselectPage']) ? (int)$_POST['checkselectPage'] : 10;
		if ($limit <= 0) $limit = 10;
		$offset = ($page - 1) * $limit;

		// prepare degree JSON value if needed
		if ($clientDegree == 'master') {
			$degInfo = '["master"]';
		} elseif ($clientDegree == 'bachelor') {
			$degInfo = '["bachelor"]';
		} elseif ($clientDegree == 'phd') {
			$degInfo = '["phd"]';
		} else {
			$degInfo = '';
		}

		// Build WHERE parts and parameter arrays for prepared statements
		$whereParts = [];
		$params = [];
		$types = '';
		// base conditions (safe static)
		$whereParts[] = "cl.close='1'";
		$whereParts[] = "cl.status='1'";
		$whereParts[] = "cl.case_status='0'";
		$whereParts[] = "cl.change_status='0'";
		$whereParts[] = "cl.client_pay_confirm_status='1'";
		$whereParts[] = "cl.ack_confirm_status='1'";
		$whereParts[] = "cl.client_country='austria'";

		if ($clientStatus !== 'all') {
			$whereParts[] = "cl.client_convert_status = ?";
			$params[] = $clientStatus; $types .= 's';
		}
		if ($clientCountry !== 'all') {
			if (in_array($clientCountry, ['Pakistan','UAE','Qatar'])) {
				$whereParts[] = "cl.client_countryfrom = ?";
				$params[] = $clientCountry; $types .= 's';
			} elseif ($clientCountry == 'Saudi Arabia') {
				$whereParts[] = "(cl.client_countryfrom = ? OR cl.client_countryfrom = ? OR cl.client_countryfrom = ?)";
				$params[] = 'Saudi Arabia'; $params[] = 'saudi Arabia'; $params[] = 'saudi arabia'; $types .= 'sss';
			} elseif ($clientCountry == 'Other Country') {
				$whereParts[] = "cl.client_countryfrom NOT IN (?,?,?,?)";
				$params[] = 'Pakistan'; $params[] = 'UAE'; $params[] = 'Saudi Arabia'; $params[] = 'Qatar'; $types .= 'ssss';
			}
		}
		if ($clientDegree !== 'all' && $degInfo !== '') {
			$whereParts[] = "cl.client_applied = ?";
			$params[] = $degInfo; $types .= 's';
		}
		if ($processStatus !== 'all') {
			$whereParts[] = "cl.client_process_status = ?";
			$params[] = $processStatus; $types .= 's';
		}
		if ($intakeYear !== 'all') {
			$whereParts[] = "cl.client_intake_year = ?";
			$params[] = $intakeYear; $types .= 's';
		}
		// checklistStatus
		if ($checklistStatus !== 'all') {
			if ($checklistStatus == 'Super Legalization Checklist Sent Clients') {
				$whereParts[] = "cl.country_checklist_info_file != ''";
			} elseif ($checklistStatus == 'Super Legalization Checklist Not Sent Clients') {
				$whereParts[] = "cl.country_checklist_info_file = ''";
			} elseif ($checklistStatus == 'Nostrification Checklist Sent Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_nost_checklist_file != '' AND (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance')";
			} elseif ($checklistStatus == 'Nostrification Checklist Not Sent Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_nost_checklist_file = '' AND (acp.aus_direct_program1_status='Acceptance' OR acp.aus_direct_program2_status='Acceptance')";
			}
		}
		// sop status
		if ($sopStatus !== 'all') {
			if ($sopStatus == 'Sops Assign Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND (acp.aus_sops_assign_to != '0' OR acp.aus_sops_status = '4')";
			} elseif ($sopStatus == 'SOPs Not Assign Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.client_process_status != 'Direct Visa' AND acp.aus_sops_assign_to = '0' AND acp.aus_sops_status != '4' AND EXISTS (SELECT 1 FROM austria_add_programs_details{$_SESSION['dbNo']} AS aapd WHERE aapd.status='1' AND aapd.close='1' AND aapd.aus_ad_sop_required='1' AND aapd.aus_ad_uni_name=acp.aus_university_name AND aapd.aus_ad_degree=acp.aus_client_degree AND JSON_CONTAINS(acp.aus_program_name, JSON_QUOTE(aapd.aus_ad_program_name)))";
			} elseif ($sopStatus == 'SOPs Received Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_sops_status = '4'";
			}
		}
		if ($assignPrograms != 'all') {
			if ($assignPrograms == 'All Assign Programs') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign != '0'";
			} elseif ($assignPrograms == 'All Not Assign Programs') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign = '0'";
			}
		}
		if ($appliedPrograms != 'all') {
			if ($appliedPrograms == 'All Applied Programs') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_direct_proof_screenshot != ''";
			} elseif ($appliedPrograms == 'New Assign But Not Applied Clients') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign != '0' AND acp.aus_direct_applied_status = '0'";
			} elseif ($appliedPrograms == 'My Pending Programs Report') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_program_status = '1'";
			} elseif ($appliedPrograms == 'I Have Resolved the Pending Report') {
				$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_program_status = '2'";
			}
		}
		// Check Application status Filter
		if ($checkApplication != 'all') {
			switch ($checkApplication) {
				case 'Admission Application Form Fill':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '4'";
					break;
				case 'Admission Application Submitted':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '5'";
					break;
				case 'Sent Admission Applied Proof to Client':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '6'";
					break;
				case 'Inform to Client to Pay Application Fee':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '7'";
					break;
				case 'Application Fee Paid By Client':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '8'";
					break;
				case 'Inform to Client regarding Test':
				case 'Waiting for Admission decision':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '9'";
					break;
				case 'Acceptance Letter Received Clients':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND (acp.aus_direct_program1_status = 'Acceptance' OR acp.aus_direct_program2_status = 'Acceptance')";
					break;
				case 'University Admission Rejected Clients':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND (acp.aus_direct_program1_status = 'Rejection' OR acp.aus_direct_program2_status = 'Rejection')";
					break;
				case 'After Verification Dues Not Clear Clients':
					$whereParts[] = "(acp.aus_direct_program1_status = 'Acceptance' OR acp.aus_direct_program2_status = 'Acceptance') AND cl.due_after_ad_info_file = ''";
					break;
				case 'After Verification Dues Remaining Clients':
					$whereParts[] = "(acp.aus_direct_program1_status = 'Acceptance' OR acp.aus_direct_program2_status = 'Acceptance') OR cl.due_after_ad_status = '2'";
					break;
				case 'After Verification Dues Clear Clients':
					$whereParts[] = "(acp.aus_direct_program1_status = 'Acceptance' OR acp.aus_direct_program2_status = 'Acceptance') AND cl.due_after_ad_info_file != ''";
					break;
				case 'Additional Activities Required by University':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_additional_activities_status = '1'";
					break;
				case 'Additional Activities Required Task Completed':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_additional_activities_status = '2'";
					break;
				case 'Deadline Hold':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_deadline_hold_status = '1'";
					break;
				case 'Deadline Release':
					$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_deadline_hold_status = '2'";
					break;
				case 'Self Received Acceptance':
					$whereParts[] = "cl.client_self_acceptance_file != ''";
					break;
				case 'Advance Remaining Payment Not Clear Clients':
					$whereParts[] = "cl.sale_commission = '0' AND (cl.client_pay_remaining_status = '0' OR cl.client_pay_remaining_status = '2')";
					break;
			}
		}
		if ($uniStatus !== 'all') {
			$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_university_name = ?";
			$params[] = $uniStatus; $types .= 's';
		}
		if ($assignTo !== 'all') {
			$whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign = ?";
			$params[] = $assignTo; $types .= 's';
		}
		// search / clientDetails (only add when non-empty)
		if ($clientDetails !== '') {
			$jsonQuoted = '"' . $clientDetails . '"';
			$likeAny = '%' . $clientDetails . '%';
			$likeQuoted = '%"' . $clientDetails . '"%';
			$whereParts[] = "(cl.client_id = ? OR CONCAT('ID-', cl.client_id) LIKE ? OR cl.client_name LIKE ? OR cl.client_email LIKE ? OR cl.client_whatapp LIKE ? OR cl.client_country LIKE ? OR cl.client_applied LIKE ? OR cl.client_embassy LIKE ? OR acp.aus_university_name LIKE ? OR JSON_CONTAINS(acp.aus_program_name, ?) OR acp.aus_program_name LIKE ? )";
			$params[] = $clientDetails; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $likeAny; $types .= 's';
			$params[] = $jsonQuoted; $types .= 's';
			$params[] = $likeQuoted; $types .= 's';
		}

		$whereSQL = implode(' AND ', $whereParts);

		// Optional debug logging (write generated WHERE and params to models/filter_debug.log when debug=1)
		if (isset($_POST['debug']) && $_POST['debug'] == '1') {
			$debugData = [
				'time' => date('c'),
				'where' => $whereSQL,
				'params' => $params,
				'types' => $types,
				'limit' => $limit,
				'offset' => $offset,
			];
			@file_put_contents(__DIR__ . '/filter_debug.log', json_encode($debugData) . PHP_EOL, FILE_APPEND | LOCK_EX);
			// also include debug in HTML comment so it's visible in the AJAX response if needed
			echo "<!-- FILTER DEBUG: " . htmlspecialchars(json_encode($debugData), ENT_QUOTES) . " -->\n";
		}

		// helper to bind params dynamically
		function bind_stmt_params($stmt, $types, $params) {
			if (empty($params)) return true;
			$bindNames[] = $types;
			for ($i = 0; $i < count($params); $i++) {
				$bindNames[] = & $params[$i];
			}
			return call_user_func_array(array($stmt, 'bind_param'), $bindNames);
		}

		// COUNT query using prepared statement
		$countQuery = "SELECT COUNT(DISTINCT cl.client_id) as total from clients{$_SESSION['dbNo']} cl LEFT JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id WHERE $whereSQL";
		$stmt = mysqli_prepare($con, $countQuery);
		if ($stmt === false) {
			die('Prepare failed: '.mysqli_error($con));
		}
		if ($types !== '') bind_stmt_params($stmt, $types, $params);
		mysqli_stmt_execute($stmt);
		$countResult = mysqli_stmt_get_result($stmt);
		$totalRecords = 0;
		if ($countResult) {
			$totalRecords = mysqli_fetch_assoc($countResult)['total'];
		}
		mysqli_stmt_close($stmt);
		$totalPages = ceil($totalRecords / $limit);

		// SELECT query with LIMIT/OFFSET
		$selectQuery = "SELECT cl.* from clients{$_SESSION['dbNo']} cl LEFT JOIN austria_clients_programs{$_SESSION['dbNo']} acp ON cl.client_id = acp.aus_clients_id WHERE $whereSQL GROUP BY cl.client_id ORDER BY client_id DESC LIMIT ? OFFSET ?";
		$stmt2 = mysqli_prepare($con, $selectQuery);
		if ($stmt2 === false) {
			die('Prepare failed: '.mysqli_error($con));
		}
		// bind previous params + limit and offset
		$types2 = $types . 'ii';
		$params2 = $params;
		$params2[] = $limit;
		$params2[] = $offset;
		bind_stmt_params($stmt2, $types2, $params2);
		mysqli_stmt_execute($stmt2);
		$clientData_ex = mysqli_stmt_get_result($stmt2);
		mysqli_stmt_close($stmt2);
	// include ("../components/AllQueries.php");
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-info">
				<h5>
					All Clients
					<?php if($clientStatus != 'all'){ echo " >> ".ucwords($clientStatus); } ?>
					<?php if($clientCountry != 'all'){ echo " >> ".ucwords($clientCountry); } ?>
					<?php if($clientDegree != 'all'){ echo " >> ".ucwords($clientDegree); } ?>
					<?php if($processStatus != 'all'){ echo " >> ".ucwords($processStatus); } ?>
					<?php if($intakeYear != 'all'){ echo " >> ".ucwords($intakeYear); } ?>
					<?php if($checklistStatus != 'all'){ echo " >> ".ucwords($checklistStatus); } ?>
					<?php if($sopStatus != 'all'){ echo " >> ".ucwords($sopStatus); } ?>
					<?php if($assignPrograms != 'all'){ echo " >> ".ucwords($assignPrograms); } ?>
					<?php if($appliedPrograms != 'all'){ echo " >> ".ucwords($appliedPrograms); } ?>
					<?php if($checkApplication != 'all'){ echo " >> ".ucwords($checkApplication); } ?>
					<?php if($uniStatus != 'all'){ echo " >> ".ucwords($uniStatus); } ?>
				</h5>
			</div>
		</div>
	</div>
	<div class="table-responsive mt-1">
		<table id="datatable" class="table table-bordered nowrap text-center" style="width: 100%; table-layout: fixed;">
			<thead>
				<tr>
					<th style="width: 20px;">Sr</th>
					<th style="width: 120px;">ID / Date</th>
					<th style="width: 220px;">Client Info</th>
					<th style="width: 100px;">Degree</th>
					<th style="width: 120px;" data-toggle="tooltip" data-placement="top" title="Payment in Advance">PIA</th>
					<th style="width: 200px;">Admission Status</th>
					<th style="width: 150px;">Visa Status</th>
					<th style="width: 50px;">Track</th>
				</tr>
			</thead>
			<tbody>
			<?php
			// $sr = mysqli_num_rows($clientData_ex);
			$sr = $totalRecords - $offset;
			while ($row = mysqli_fetch_assoc($clientData_ex)) {
				$clientID = $row['client_id'];
				$changingApplied = $row['client_applied'];
				$appliedChanging = json_decode($changingApplied, true);
				$getUrl = base64_encode($row['client_name']."".$row['client_email']);
				include ("../components/PIAQueries.php");
				?>
				<tr id="<?php echo $row['client_id'];?>">
					<td><?php echo $sr; ?></td>
					<td><?php include ("../components/IDDateTd.php"); ?></td>
					<td class="breakTD">
						<?php include ("../components/ClientInfoTd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/DegreeEmbassyTd.php");?>
					</td>
					<td>
						<?php include ("../components/PIATd.php");?>
					</td>
					<td class="breakTD">
						<?php include ("../components/AdmissionStatusTd.php");?>
					</td>
					<td>
						<?php include ("../components/VisaStatusTd.php");?>
					</td>
					<td>
						<?php include ("../components/ViewActionTd.php");?>
					</td>
				</tr>
			<?php
			$sr--;
			} ?>
			</tbody>
		</table>
		<script type="text/javascript">
			$(document).ready(function() {
				$('[data-toggle="tooltip"]').tooltip({ html: true });
				if ($.fn.DataTable.isDataTable("#datatable")) {
					// Destroy the existing DataTable instance
					$('#datatable').DataTable().destroy();
				}
				$("#datatable").DataTable({
					paging: false,
					searching: false,
					info: false,
					lengthChange: false,
					order: [[0, 'desc']],
				});
			});
		</script>
	</div>
	<?php include ('../components/TablePagination.php'); ?>
<?php
}
?>