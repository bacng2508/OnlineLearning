<!-- Profile -->
        <div class="container-fluid w-1400 my-5" id="profile">
            <div class="row px-3">
                <!-- Profile: Sidebar -->
                <?php include_once "Views/layouts/profile-sidebar.php" ?>
                <!-- Profile: Sidebar -->

                <!-- Profile: Account infor -->
                <div class="col-lg-9 col-12 px-lg-5">
                    <h1 class="mt-4 mt-lg-0 mb-lg-3">Thông tin tài khoản</h1>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 col-12 mt-2 mb-4 my-lg-0 text-center">
                                <img class="rounded-2 img-fluid" id="avatar-img" src="Public/images/Avatar/<?php if ($userInfo['user_avatar']) echo $userInfo['user_avatar']; else echo 'avatar_default.png';  ?>" alt="" />
                                <div class="mt-2">
                                    <form action="" method="POST" id="uploadAvatarForm" enctype="multipart/form-data">
                                        <input class="d-none" type="file" id="avatarUploadedFile" name="avatarUploadedFile" />
                                        <button type="button" name="uploadAvatarBtn" class="btn btn-outline-secondary rounded-0 w-100 mb-lg-3" id="btn__upload-avatar">
                                            <i class="fa-solid fa-upload pointer"></i>
                                            <label class="pointer" for="avatarUploadedFile">Thay đổi ảnh đại diện</label>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-9 col-12 ps-xl-5">
                                <h4 class="mb-xl-4 mb-2 mb-lg-3">Thông tin cá nhân</h4>
                                <?php
                                    if (isset($_SESSION['notice__editProfile'])) {
                                        $state = $_SESSION['notice__editProfile']['state'];
                                        $msg = $_SESSION['notice__editProfile']['msg'];
                                        echo 
                                            '
                                                <div class="alert alert-'.$state.' text-center p-2 mb-3" role="alert">
                                                    '.$msg.'
                                                </div>
                                            ';
                                        unset($_SESSION['notice__editProfile']);
                                    }
                                ?>
                                <form method="POST" action="" >
                                    <div class="row mb-lg-3 mb-2">
                                        <label for="loginName" class="col-lg-4 text-lg-end mb-2 fw-semibold">Tên đăng nhập</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control bg-body-secondary" id="loginName" name="loginName" value="<?=$userInfo['user_loginName']?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-3">
                                        <label for="email" class="col-lg-4 text-lg-end mb-2 fw-semibold">Email</label>
                                        <div class="col-lg-8">
                                            <input type="email" class="form-control bg-body-secondary" id="email" name="email" value="<?=$userInfo['user_email']?>" readonly/>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-2">
                                        <label for="username" class="col-lg-4 text-lg-end mb-2 fw-semibold">Tên</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" id="username" name="username" value="<?=$userInfo['user_name']?>" />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn bg__main-color rounded-0 text-light fw-bold rounded-1" name="editProfileBtn">
                                            Cập nhật thông tin
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile: Account infor -->
            </div>
        </div>
        <!-- Profile -->
         <script type="text/javascript">
            document.getElementById("avatarUploadedFile").onchange = function(){
                document.getElementById("uploadAvatarForm").submit();
            };
        </script>