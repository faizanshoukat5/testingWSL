<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4 class="header-title mb-3">Change Password</h4>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label >New Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input class="form-control" type="password" name="new_password" required="required" placeholder="Enter Confirm password" id="new_password" onkeyup="checkPassword();">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="newPasswordShow();">
                                        <i class="mdi mdi-eye" id="newShowEye"></i>
                                        <i class="mdi mdi-eye-off d-none" id="newHideEye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Confirm Password <span class="text-danger">*</span></label>

                            <div class="input-group">
                                <input class="form-control" type="password" name="confirm_password" required="required" placeholder="Enter Confirm password" id="confirm_password" onkeyup="checkPassword();">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="cursor: pointer;background: #3461ff;color: white;border: 1px solid #3461ff;" onclick="confirmPasswordShow();">
                                        <i class="mdi mdi-eye" id="confrimShowEye"></i>
                                        <i class="mdi mdi-eye-off d-none" id="confrimHideEye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" id="message"></div>
                        <div class="form-group col-md-12">
                            <div class="float-right">
                                <button type="submit" name="change" class="btn btn-custom" id="submit" disabled=""><i class="mdi mdi-stack-exchange"></i> Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end col -->
        </div>
    </div>
</div>


<script type="text/javascript">
    function checkPassword() {
        var newPassword = $('#new_password').val();
        var confirmPassword = $('#confirm_password').val();
        var message = $('#message');
        var submitBtn = $('#submit');

        if (newPassword === confirmPassword) {
            message.css('color', 'green').html('**/ Passwords match /**');
            submitBtn.prop('disabled', false);
        } else {
            message.css('color', 'red').html('**/ Passwords do not match /**');
            submitBtn.prop('disabled', true);
        }
    }

    function newPasswordShow() {
        var x = document.getElementById("new_password");
        var show_eye = document.getElementById("newShowEye");
        var hide_eye = document.getElementById("newHideEye");
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

    function confirmPasswordShow() {
        var x = document.getElementById("confirm_password");
        var showEye = document.getElementById("confrimShowEye");
        var hideEye = document.getElementById("confrimHideEye");
        hideEye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            showEye.style.display = "none";
            hideEye.style.display = "block";
        } else {
            x.type = "password";
            showEye.style.display = "block";
            hideEye.style.display = "none";
        }
    }
</script>