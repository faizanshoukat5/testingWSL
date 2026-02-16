<?php

$select_query = "SELECT * from wt_users WHERE status = '1' AND close='1' AND wt_id ='".$_SESSION['user_id']."' ";
$user_update = mysqli_query($con,$select_query);

if(isset($_POST['update'])){
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $phone_no = mysqli_real_escape_string($con, $_POST['phoneno']);
    $userImage = $_FILES['userImage']['name'];
    $tempname = $_FILES['userImage']['tmp_name'];
    if (empty($userImage)){
        $add_user_sql = "UPDATE  wt_users SET fname='".$fname."', lname='".$lname."', phone='".$phone_no."' WHERE wt_id = '".$_SESSION['user_id']."'";
        $add_user_sql_ex = mysqli_query($con,$add_user_sql);
    }else{
        $folder = "../images/".$userImage;
        move_uploaded_file($tempname, $folder);
        $add_user_sql = "UPDATE  wt_users SET fname='".$fname."', lname='".$lname."', phone='".$phone_no."', user_image='".$userImage."' WHERE wt_id = '".$_SESSION['user_id']."'";
        $add_user_sql_ex = mysqli_query($con,$add_user_sql);
    }
    if ($add_user_sql_ex) {
        header('Location: log-out');
    }else{
        echo "error";
    }
}

?>