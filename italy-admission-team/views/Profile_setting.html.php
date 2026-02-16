<style type="text/css">
.file-upload {
    /*background-color: #f2f2f2;*/
    margin: 0 auto;
    padding: 20px;
    text-align: center;
}

.file-upload-content {
    display: none;
    text-align: center;
    padding-bottom: 30px;
}
.file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    outline: none;
    opacity: 0;
    cursor: pointer;
}

.image-upload-wrap {
    padding-bottom: 30px;
    position: relative;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="profile-bg-picture" style="background-image:url('../images/profile-bg.png');margin: 0px!important;">
            <span class="picture-bg-overlay"></span><!-- overlay -->
        </div>
        <!-- meta -->
        <div class="profile-user-box">
            <div class="row">
                <div class="col-sm-6">
                    <span class="float-left mr-3"><img src="../images/<?php echo $_SESSION['user_image'];?>" alt="user image" class="avatar-xl rounded-circle"></span>
                    <div class="media-body">
                        <h4 class="mt-1 mb-1 font-18"><?php echo ucwords($_SESSION['uname']);?></h4>
                        <p class="font-13"> <?php echo ucwords($_SESSION['user_designation']);?></p>
                        <p class="text-muted mb-0"><?php echo $_SESSION['user_email'];?></p>
                    </div>
                </div>
            </div>
        </div>
        <!--/ meta -->
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <ul class="nav nav-tabs tabs-bordered">
                <li class="nav-item">
                    <a href="#userInfo" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        <span class="d-block d-sm-none"><i class="mdi mdi-account"></i></span>
                        <span class="d-none d-sm-block">User info</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="#companyInfo" data-toggle="tab" aria-expanded="true" class="nav-link">
                        <span class="d-block d-sm-none"><i class="mdi mdi-office-building"></i></span>
                        <span class="d-none d-sm-block">Company info</span>
                    </a>
                </li> -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="userInfo">
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php while ($user_row = mysqli_fetch_array($user_update)){ ?>
                        <div class="row">
                            <div class="form-group col-md-9">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label >First Name </label>
                                        <input value="<?php echo $user_row['fname'];?>" type="text" class="form-control" name="fname" required="required">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label >Last Name </label>
                                        <input value="<?php echo $user_row['lname'];?>" type="text" class="form-control" name="lname" required="required">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label >Phone No </label>
                                        <input value="<?php echo $user_row['phone'];?>" type="number" class="form-control" name="phoneno" required="required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <div class="row">
                                    <div class="form-group file-upload col-md-12">
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input"  name="userImage" type='file' onchange="readURL(this);" accept="image/*" />
                                            <?php 
                                                echo "<img class=''  src='../images/".$user_row['user_image']."' alt='your image' height='150px'/>";
                                            ?>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class='file-upload-image' src="#" alt='your image' height='150px'/>
                                        </div>
                                        <button class="btn btn-custom col-md-12" type="button" onclick="$('.file-upload-input').trigger('click')">Upload Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group col-md-12">
                            <button type="submit" name="update" class="btn btn-custom"><i class="mdi mdi-upload"></i> Update</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="companyInfo">
                   
                </div>
            </div>
        </div>
    </div> <!-- end col -->

</div>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image-upload-wrap').hide();
                $('.file-upload-image').attr('src', e.target.result);
                $('.file-upload-content').show();
                $('.image-title').html(input.files[0].name);
            };
            reader.readAsDataURL(input.files[0]);
        }else {
            removeUpload();
        }
    }
</script>