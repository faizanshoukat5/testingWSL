<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
if (!isset($con) || !($con instanceof mysqli)) { include_once __DIR__ . '/../../env/main-config.php'; }
    $userID = $_SESSION['user_id'];
    if(isset($_POST['change'])){
        $password = $_POST['new_password'] ?? '';
        $last_pass = md5($password );
        $confirm_password = $_POST['confirm_password'] ?? '';
        if($password == $confirm_password){
            $sql = "UPDATE wt_users SET password = ? WHERE close='1' AND status='1' AND wt_id = ?";
            $stmt = mysqli_prepare($con, $sql);
            if ($stmt) {
                $uid = (int)$userID;
                mysqli_stmt_bind_param($stmt, 'si', $last_pass, $uid);
                $execuit = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                $execuit = false;
            }

            if ($execuit) {
                header('Location:log-out');
            }
        }else{
            $message = "Please Enter Correct Password";  
        }

    }
?>
