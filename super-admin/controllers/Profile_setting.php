<?php

$select_query = "SELECT * from wt_users WHERE status = '1' AND close='1' AND wt_id ='".$_SESSION['user_id']."' ";
$user_update = mysqli_query($con,$select_query);

if(isset($_POST['update'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone_no = $_POST['phoneno'];
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

$companyInfo = "SELECT * from company_info WHERE status = '1' AND close='1' ";
$companyInfo_ex = mysqli_query($con,$companyInfo);

if(isset($_POST['updateCompany'])){
    $companyname = $_POST['companyname'];
    $companyphone = isset($_POST['companyphone']) ? preg_replace('/[^!<>@&.\/\sA-Za-z0-9_-]/', '', $_POST['companyphone']) : "";
    $companyemail = isset($_POST['companyemail']) ? preg_replace('/[^!<>@&.\/\sA-Za-z0-9_-]/', '', $_POST['companyemail']) : "";
    $companyaddress = isset($_POST['companyaddress']) ? preg_replace('/[^!<>@&.\/\sA-Za-z0-9_-]/', '', $_POST['companyaddress']) : "";
    $logo_photo = $_FILES['logo_photo']['name'];
    if (empty($logo_photo)){
        $add_user_sql = "UPDATE company_info SET com_name = '".$companyname."',com_phone = '".$companyphone."',com_email = '".$companyemail."',com_address = '".$companyaddress."',close = '1',status = '1' WHERE com_id = '1' ";
         $add_user_sql_ex = mysqli_query($con,$add_user_sql);
    }else{
        $folder = "../images/".$logo_photo;   
        move_uploaded_file($tempname, $folder);
        $add_user_sql = "UPDATE  company_info SET com_name = '".$companyname."',com_phone = '".$companyphone."',com_email = '".$companyemail."',com_logo = '".$logo_photo."',com_address = '".$companyaddress."',close = '1',status = '1' WHERE com_id = '1' ";
         $add_user_sql_ex = mysqli_query($con,$add_user_sql);
    }
        
    if ($add_user_sql_ex) {
        header('Location: log-out');
    }
    else{
        echo "error";
    }
}



?>