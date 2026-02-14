<?php 
if (isset($_GET['update_pass'])) {
    $data = json_decode(base64_decode($_GET['update_pass']),true);
    $chk_expiry = "SELECT * FROM wt_users WHERE forgot_token = '".$data['gett']."' AND close = '1' AND status = '1'";
    $chk_expiry_ex = mysqli_query($con,$chk_expiry);
    foreach($chk_expiry_ex as $fetch){
        $exp_time = $fetch['token_exp_time'];
    }
    $current_time = strtotime(date('d-m-Y h:i:s'));
    $token_exp = strtotime($exp_time);
    if ($current_time > $token_exp) {
        echo $msg = "<div class='col-lg-12'> <div class='alert alert-danger text-center'> <strong>Link has been expired!!</strong></div> </div>";
    }else{

?>
<style type="text/css">
    .form-control{
        height: 40px;
        color: #000!important;
        font-size: 0.9rem!important;
    }
</style>
<div class="account-pages w-100 mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card mb-0">
                    <div class="card-body p-4">
                        <div class="account-box">
                            <div class="text-center account-logo-box">
                                <a href="login">
                                    <img src="images/<?php echo $_SESSION['com_logo'];?>" alt="" height="80">
                                </a>
                            </div>
                            <div class="account-content mt-4">
                                <form action="models/forgot-password.php" method="post" class="was-validated">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label class="text-dark">New Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="hidden" name="changepass" value="<?php echo $data['gett']; ?>">
                                                <input type="password" name="newPassword" class="form-control" placeholder="Enter New Password" required="required" id="newPassword" onkeyup="checkPassword();">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="password_show_hide1();">
                                                        <i class="mdi mdi-eye" id="show_eye1"></i>
                                                        <i class="mdi mdi-eye-off d-none" id="hide_eye1"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-12">
                                            <label class="text-dark">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="password" name="confirmPassword" class="form-control" placeholder="Enter Confirm Password" required="required" id="confirmPassword" onkeyup="checkPassword()">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="password_show_hide2();">
                                                        <i class="mdi mdi-eye" id="show_eye2"></i>
                                                        <i class="mdi mdi-eye-off d-none" id="hide_eye2"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="message"></div>
                                        <div class="form-group col-12 text-center mt-2">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="updatePassword" disabled="" id="submit">Change Password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-2 text-center text-muted">
                                2024 - <script>document.write(new Date().getFullYear())</script> &copy; <?php echo ucwords($_SESSION['com_name']);?> Design by <a href="https://muhammadsafdar.com/" target="blank"><strong>Muhammad Safdar</strong></a>
                            </div>
                        </div>
                        <!-- end card-box-->
                    </div>
                </div>
                <!-- end card-body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<script type="text/javascript">
    var checkPassword = function() {
        if (document.getElementById('newPassword').value ==
            document.getElementById('confirmPassword').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = '**/ Passwords match /**';
            $('#submit').attr('disabled', false);
        }else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = '**/ Passwords do not match /**';
            $('#submit').attr('disabled', true);
        }
    }

    function password_show_hide1() {
        var x = document.getElementById("newPassword");
        var show_eye = document.getElementById("show_eye1");
        var hide_eye = document.getElementById("hide_eye1");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
    function password_show_hide2() {
        var x = document.getElementById("confirmPassword");
        var show_eye = document.getElementById("show_eye2");
        var hide_eye = document.getElementById("hide_eye2");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }
</script>


<?php
}
    }else{
        header("Location: login");
    }
 ?>