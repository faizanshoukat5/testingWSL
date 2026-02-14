<?php
/**
 * Test script to demonstrate the JSON debug output structure
 * from viewAllClientsModel.php
 */

// Simulate POST parameters
$_POST = [
    'checkconvertStatus' => 'all',
    'checkclientCountry' => 'Pakistan',
    'checkclientDegree' => 'master',
    'checkprocessStatus' => 'all',
    'checkintakeYear' => '2024',
    'checksopStatus' => 'all',
    'checkchecklistStatus' => 'all',
    'checkassignPrograms' => 'all',
    'checkappliedPrograms' => 'all',
    'checkcheckApplication' => 'all',
    'checkuniStatus' => 'all',
    'checkassignTo' => 'all',
    'checkclientDetails' => 'test',
    'pageNumber' => 1,
    'checkselectPage' => 10,
    'debug' => '1'
];

// Simulate the filter logic to build debug data
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
$clientDetails = isset($_POST['checkclientDetails']) ? trim($_POST['checkclientDetails']) : '';
$page = isset($_POST['pageNumber']) ? (int)$_POST['pageNumber'] : 1;
$limit = isset($_POST['checkselectPage']) ? (int)$_POST['checkselectPage'] : 10;
if ($limit <= 0) $limit = 10;
$offset = ($page - 1) * $limit;

// Build WHERE parts and parameter arrays
$whereParts = [];
$params = [];
$types = '';

// Base conditions
$whereParts[] = "cl.close='1'";
$whereParts[] = "cl.status='1'";
$whereParts[] = "cl.case_status='0'";
$whereParts[] = "cl.change_status='0'";
$whereParts[] = "cl.client_pay_confirm_status='1'";
$whereParts[] = "cl.ack_confirm_status='1'";
$whereParts[] = "cl.client_country='austria'";

if ($clientStatus !== 'all') {
    $whereParts[] = "cl.client_convert_status = ?";
    $params[] = $clientStatus;
    $types .= 's';
}

if ($clientCountry !== 'all') {
    if (in_array($clientCountry, ['Pakistan','UAE','Qatar'])) {
        $whereParts[] = "cl.client_countryfrom = ?";
        $params[] = $clientCountry;
        $types .= 's';
    } elseif ($clientCountry == 'Saudi Arabia') {
        $whereParts[] = "(cl.client_countryfrom = ? OR cl.client_countryfrom = ? OR cl.client_countryfrom = ?)";
        $params[] = 'Saudi Arabia';
        $params[] = 'saudi Arabia';
        $params[] = 'saudi arabia';
        $types .= 'sss';
    } elseif ($clientCountry == 'Other Country') {
        $whereParts[] = "cl.client_countryfrom NOT IN (?,?,?,?)";
        $params[] = 'Pakistan';
        $params[] = 'UAE';
        $params[] = 'Saudi Arabia';
        $params[] = 'Qatar';
        $types .= 'ssss';
    }
}

if ($clientDegree !== 'all') {
    if ($clientDegree == 'master') {
        $degInfo = '["master"]';
    } elseif ($clientDegree == 'bachelor') {
        $degInfo = '["bachelor"]';
    } elseif ($clientDegree == 'phd') {
        $degInfo = '["phd"]';
    } else {
        $degInfo = '';
    }
    if ($degInfo !== '') {
        $whereParts[] = "cl.client_applied = ?";
        $params[] = $degInfo;
        $types .= 's';
    }
}

if ($processStatus !== 'all') {
    $whereParts[] = "cl.client_process_status = ?";
    $params[] = $processStatus;
    $types .= 's';
}

if ($intakeYear !== 'all') {
    $whereParts[] = "cl.client_intake_year = ?";
    $params[] = $intakeYear;
    $types .= 's';
}

// Checklist Status
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

// SOP Status
if ($sopStatus !== 'all') {
    if ($sopStatus == 'Sops Assign Clients') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND (acp.aus_sops_assign_to != '0' OR acp.aus_sops_status = '4')";
    } elseif ($sopStatus == 'SOPs Not Assign Clients') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.client_process_status != 'Direct Visa' AND acp.aus_sops_assign_to = '0' AND acp.aus_sops_status != '4'";
    } elseif ($sopStatus == 'SOPs Received Clients') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_sops_status = '4'";
    }
}

// Assign Programs
if ($assignPrograms != 'all') {
    if ($assignPrograms == 'All Assign Programs') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign != '0'";
    } elseif ($assignPrograms == 'All Not Assign Programs') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign = '0'";
    }
}

// Applied Programs
if ($appliedPrograms != 'all') {
    if ($appliedPrograms == 'All Applied Programs') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_direct_proof_screenshot != ''";
    } elseif ($appliedPrograms == 'New Assign But Not Applied Clients') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign != '0' AND acp.aus_direct_applied_status = '0'";
    } elseif ($appliedPrograms == 'My Pending Programs Report') {
        $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_program_status = '1'";
    }
}

// Check Application
if ($checkApplication != 'all') {
    switch ($checkApplication) {
        case 'Admission Application Submitted':
            $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND acp.aus_direct_applied_status = '5'";
            break;
        case 'Acceptance Letter Received Clients':
            $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_assign_status = '1' AND (acp.aus_direct_program1_status = 'Acceptance' OR acp.aus_direct_program2_status = 'Acceptance')";
            break;
    }
}

if ($uniStatus !== 'all') {
    $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_university_name = ?";
    $params[] = $uniStatus;
    $types .= 's';
}

if ($assignTo !== 'all') {
    $whereParts[] = "acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND acp.aus_program_assign = ?";
    $params[] = $assignTo;
    $types .= 's';
}

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

// Build the debug data structure
$debugData = [
    'time' => date('c'),
    'where' => $whereSQL,
    'params' => $params,
    'types' => $types,
    'limit' => $limit,
    'offset' => $offset,
];

// Output as formatted JSON
header('Content-Type: application/json');
echo json_encode($debugData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
?>
