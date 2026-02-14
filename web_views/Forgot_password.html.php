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
                            <?php 
                            if (isset($_GET['check-your-email'])) { ?>
                                <div class="form-group col-md-12 mt-4">
                                    <div class="alert alert-danger text-center">
                                        Check Your <strong>Email </strong> to Reset Your Password!
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-sm-12 text-center">
                                        <p class="text-muted mb-0">Back to <a href="login" class="text-dark ml-1"><b>Sign In</b></a></p>
                                    </div>
                                </div>
                            <?php }else{ ?>
                                <div class="account-content mt-4">
                                    <div class="text-center">
                                        <p class="text-muted mb-0 mb-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                                    </div>
                                    <form action="models/forgot-password.php" method="post" class="was-validated">
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label class="text-dark">Email address <span class="text-danger">*</span></label>
                                                <input type="email" name="userEmail" class="form-control" placeholder="abc@gmail.com" required="required" onkeyup="wrongEmail();">
                                            </div>
                                            <?php if (isset($_GET['enter-your-right-email'])) { ?>
                                                <div class="form-group col-md-12" id="wrongEmailMsg">
                                                    <div class="alert alert-danger text-center">
                                                        Your <strong>Email </strong> is not <strong>Exist</strong>! Enter <strong>right Email</strong>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="form-group text-center col-12">
                                                <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit" name="sendEmail">Send Email</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Back to <a href="login" class="text-dark ml-1"><b>Sign In</b></a></p>
                                        </div>
                                    </div>
                                    <div class="mt-2 text-center text-muted">
                                        2024 - <script>document.write(new Date().getFullYear())</script> &copy; <?php echo ucwords($_SESSION['com_name']);?> Design by <a href="https://muhammadsafdar.com/" target="blank"><strong>Muhammad Safdar</strong></a>
                                    </div>
                                </div>
                            <?php } ?>
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
    function wrongEmail(){
        $("#wrongEmailMsg").hide();
    }
 </script>