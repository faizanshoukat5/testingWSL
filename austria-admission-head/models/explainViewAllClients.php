<?php
// Local-only helper: generate EXPLAIN for the query built by viewAllClientsModel.php
// Usage: POST the same params you send to viewAllClientsModel.php plus debug_explain=1

session_start();
include_once(__DIR__ . "/../../env/main-config.php");

// Only allow local requests for safety
$allowedHosts = ['127.0.0.1', '::1', 'localhost'];
$remote = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remote, $allowedHosts)) {
    header('HTTP/1.1 403 Forbidden');
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'Forbidden: explain endpoint allowed only from localhost'], JSON_PRETTY_PRINT);
    exit;
}

// Forward POST variables to the model and capture its debug output
$_POST['debug'] = '1';
ob_start();
include __DIR__ . '/viewAllClientsModel.php';
$output = ob_get_clean();

// find debug JSON in HTML comment
$matches = [];
if (!preg_match('/<!--\s*FILTER DEBUG:\s*(\{.*?\})\s*-->/', $output, $matches)) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'No debug data found. Ensure viewAllClientsModel.php supports debug=1'], JSON_PRETTY_PRINT);
    exit;
}

$debugJson = $matches[1];
$debugData = json_decode($debugJson, true);
if (!$debugData) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'Failed to parse debug JSON', 'raw' => $debugJson], JSON_PRETTY_PRINT);
    exit;
}

$whereSQL = $debugData['where'] ?? '';
$params = $debugData['params'] ?? [];
$types = $debugData['types'] ?? '';

// Build EXPLAIN query (no LIMIT/OFFSET to show full plan)
$dbNo = $_SESSION['dbNo'] ?? '';
$explainSql = "EXPLAIN SELECT cl.* FROM clients{$dbNo} cl LEFT JOIN austria_clients_programs{$dbNo} acp ON cl.client_id = acp.aus_clients_id WHERE " . $whereSQL . " GROUP BY cl.client_id ORDER BY client_id DESC";

$conn = $con; // from main-config
$stmt = mysqli_prepare($conn, $explainSql);
if ($stmt === false) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['success' => false, 'error' => 'Prepare failed: '.mysqli_error($conn), 'sql' => $explainSql], JSON_PRETTY_PRINT);
    exit;
}

// bind params if present
if (!empty($params) && $types !== '') {
    $bindNames = [];
    $bindNames[] = $types;
    for ($i = 0; $i < count($params); $i++) {
        $bindNames[] = & $params[$i];
    }
    call_user_func_array([$stmt, 'bind_param'], $bindNames);
}

mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$rows = [];
if ($res) {
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
}
mysqli_stmt_close($stmt);

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
    'success' => true,
    'explain' => $rows,
    'debug' => $debugData,
    'sql' => $explainSql
], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

?>
