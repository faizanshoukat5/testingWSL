<?php
    $userID = $_SESSION['user_id'];
    if(isset($_POST['change'])){
        $password = $_POST['new_password'];
        $last_pass = md5($password );
        $confirm_password = $_POST['confirm_password'];
        if($password == $confirm_password){
            $update_q = "UPDATE wt_users SET password ='".$last_pass."' WHERE close='1' AND status='1' AND wt_id = '".$userID."' ";
            $execuit = mysqli_query($con,$update_q );
            if ($execuit) {
                header('Location:log-out');
            }
        }else{
            $message = "Please Enter Correct Password";  
        }

    }
?>
