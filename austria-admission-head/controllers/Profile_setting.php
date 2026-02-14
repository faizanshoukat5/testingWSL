<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }

$select_query = "SELECT wt_id, fname, lname, phone, user_image FROM wt_users WHERE status = '1' AND close='1' AND wt_id = ?";
$stmt = mysqli_prepare($con, $select_query);
if ($stmt) {
	$userId = (int)($_SESSION['user_id'] ?? 0);
	mysqli_stmt_bind_param($stmt, 'i', $userId);
	mysqli_stmt_execute($stmt);
	$user_update = mysqli_stmt_get_result($stmt);
	mysqli_stmt_close($stmt);
} else {
	$user_update = mysqli_query($con, "SELECT wt_id, fname, lname, phone, user_image FROM wt_users WHERE status = '1' AND close='1' AND wt_id='" . intval($_SESSION['user_id'] ?? 0) . "'");
}

if(isset($_POST['update'])){
    $fname = $_POST['fname'] ?? '';
    $lname = $_POST['lname'] ?? '';
    $phone_no = $_POST['phoneno'] ?? '';
    $userImage = !empty($_FILES['userImage']['name']) ? $_FILES['userImage'] : null;

    $userId = (int)($_SESSION['user_id'] ?? 0);
    if ($userImage === null) {
        $sql = "UPDATE wt_users SET fname = ?, lname = ?, phone = ? WHERE wt_id = ?";
        $stmt2 = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt2, 'sssi', $fname, $lname, $phone_no, $userId);
        $add_user_sql_ex = mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    } else {
        $upload = upload_single_file($userImage, __DIR__ . '/../images/', ['jpg','jpeg','png','gif'], 2*1024*1024);
        if (!$upload['success']) {
            echo 'Image upload failed: ' . e($upload['error']);
            exit;
        }
        $stored = $upload['file'];
        $sql = "UPDATE wt_users SET fname = ?, lname = ?, phone = ?, user_image = ? WHERE wt_id = ?";
        $stmt2 = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt2, 'ssssi', $fname, $lname, $phone_no, $stored, $userId);
        $add_user_sql_ex = mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
    if ($add_user_sql_ex) {
        header('Location: log-out');
    }else{
        echo "error";
    }
}

?>