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
                            <div class="account-logo-box">
                                <div class="text-center">
                                    <a href="login">
                                        <img src="images/<?php echo $_SESSION['com_logo'];?>" alt="" height="80">
                                    </a>
                                </div>
                                <h5 class="mb-1 mt-2 text-center">Sign In</h5>
                                <p class="mb-0 text-center text-dark">Login to your Admin account</p>
                            </div>

                            <div class="account-content mt-2">
                                <form action="models/Login.php" method="post" class="was-validated">
                                    <?php 
                                    if (isset($_GET['change-your-password'])) { ?>
                                        <div class="form-group col-md-12" id="changeuserpassmsg">
                                            <div class="alert alert-success text-center">
                                                Your <strong>Password </strong> has been Changed. Now Login
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label class="text-dark">Username/Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="userName" id="UserNameaddress" required="required" placeholder="Enter your Username / Email" onkeyup="wrongUserNamePass();">
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label class="text-dark">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input class="form-control" type="password" name="password" required="required" id="password" placeholder="Enter your password" onkeyup="wrongUserNamePass();">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="password_show_hide();">
                                                        <i class="mdi mdi-eye" id="show_eye"></i>
                                                        <i class="mdi mdi-eye-off d-none" id="hide_eye"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        if (isset($_GET['wrong-username-and-password'])) { ?>
                                            <div class="form-group col-md-12" id="wronguserpassmsg">
                                                <div class="alert alert-danger text-center">
                                                    Wrong <strong>Username/Email or Password </strong>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-12 form-group">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="signIN">Sign In</button>
                                        </div>
                                    </div>
                                    
                                    <div class="mt-2 text-center">
                                        <a href="forgot-password" class="text-muted"><i class="mdi mdi-lock me-1"></i> <u>Forgot your password?</u></a>
                                    </div>
                                    <div class="mt-2 text-center text-muted">
                                        2024 - <script>document.write(new Date().getFullYear())</script> &copy; <?php echo ucwords($_SESSION['com_name']);?> Design by <a href="https://muhammadsafdar.com/" target="blank"><strong>Muhammad Safdar</strong></a>
                                    </div>
                                </form>
                            </div>
                        </div>
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
<!-- end page -->

<script type="text/javascript">
    function wrongUserNamePass(){
        $("#wronguserpassmsg").hide();
        $("#changeuserpassmsg").hide();
    }
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
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