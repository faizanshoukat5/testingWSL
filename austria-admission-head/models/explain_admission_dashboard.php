<?php
/**
 * Non-invasive helper: run EXPLAIN on the dashboard queries used by
 * `models/_admissionDashboardControllersState.php` and return results as JSON.
 * Usage (dev only): open in browser or curl while logged-in as admin.
 */
ob_start();
session_start();
include_once("../../env/main-config.php");
header('Content-Type: application/json');

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo json_encode(['error' => 'authentication_required']);
    exit;
}

$queries = [];

$queries['clients_summary'] = "SELECT
\tSUM(CASE WHEN client_country='austria' THEN 1 ELSE 0 END) AS countOverallczech,
\tSUM(CASE WHEN client_country='austria' AND client_countryfrom='Pakistan' AND (client_document_status='0' OR client_pro_confirm_status='0') THEN 1 ELSE 0 END) AS countTotalNotProgramDocPakczech,
\tSUM(CASE WHEN client_country='austria' AND client_countryfrom='UAE' AND (client_document_status='0' OR client_pro_confirm_status='0') THEN 1 ELSE 0 END) AS countTotalNotProgramDocUAEczech,
\tSUM(CASE WHEN client_country='austria' AND client_document_status='1' AND client_pro_confirm_status='1' AND client_pay_confirm_status='1' AND ack_confirm_status='1' THEN 1 ELSE 0 END) AS countTotalczech
FROM clients" . $_SESSION['dbNo'] . " WHERE close='1' AND status='1' AND case_status='0' AND change_status='0' AND admin_status='1'";

$queries['programs_summary'] = "SELECT 
\tCOUNT(CASE WHEN acp.aus_assign_status='1' THEN 1 END) AS countTotalAssign,
\tCOUNT(CASE WHEN acp.aus_assign_status='0' THEN 1 END) AS countTotalNotAssign
FROM austria_clients_programs" . $_SESSION['dbNo'] . " acp JOIN clients" . $_SESSION['dbNo'] . " cl ON acp.aus_clients_id = cl.client_id WHERE acp.close='1' AND acp.status='1' AND acp.aus_change_program_status='0' AND cl.close='1' AND cl.status='1' AND cl.case_status='0' AND cl.change_status='0' AND cl.client_document_status='1' AND cl.client_pro_confirm_status='1' AND cl.client_pay_confirm_status='1' AND cl.ack_confirm_status='1' AND cl.client_country='austria'";

$out = [];
foreach ($queries as $name => $sql) {
    $explain_sql = 'EXPLAIN ' . $sql;
    $res = mysqli_query($con, $explain_sql);
    if (!$res) {
        $out[$name] = ['error' => mysqli_error($con)];
        continue;
    }
    $rows = [];
    while ($r = mysqli_fetch_assoc($res)) {
        $rows[] = $r;
    }
    $out[$name] = $rows;
}

// Also return the exact SQL used in the dashboard file for quick copy/paste
$out['_dashboard_sql_samples'] = $queries;

echo json_encode($out, JSON_PRETTY_PRINT);
