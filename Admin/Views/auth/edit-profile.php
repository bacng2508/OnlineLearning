<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b></b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h2 class="text-center mb-3">Thông tin tài khoản</h2>
                <?php
                    if (isset($_SESSION['notice__adminProfile'])) {
                        $state = $_SESSION['notice__adminProfile']['state'];
                        $msg = $_SESSION['notice__adminProfile']['msg'];
                        echo 
                            '
                            <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                '.$msg.'
                            </div>
                            ';
                        unset($_SESSION['notice__adminProfile']);
                    }
                ?>
                <!-- Profile: Account infor -->
                <div class="">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-3 mt-2 mb-4 my-lg-0 text-center">
                                <img class="rounded-2 img-fluid" id="avatar-img" src="../Public/images/Avatar/<?php
                                if (isset($_SESSION['admin']['user_avatar'])) {
                                    echo $_SESSION['admin']['user_avatar'];
                                } else {
                                    echo "avatar_default.png";
                                }
                                ?>
                                " alt="" />
                                <div class="mt-2">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <button type="submit" class="btn btn-primary rounded-2 fw-bold rounded-1 w-100 " name="btnChangeAdminAvatar" data-bs-target="#modal__updateAccount" data-bs-toggle="modal">
                                            Cập nhật ảnh đại diện
                                        </button>
                                        <input type="file" id="adminAvatar" name="adminAvatar" />
                                        <!-- <div class="btn btn-outline-secondary rounded-0 w-100 mb-lg-3" id="btn__upload-avatar">
                                            <i class="fa-solid fa-upload .pointer"></i>
                                            <label class="pointer" for="form__uploadAvatar">Tải ảnh lên</label>
                                        </div> -->
                                    </form>
                                </div>
                            </div>

                            <div class="col-6 mt-3">
                                <form action="" method="POST">
                                    <?php
                                        $adminProfile = getAdminInfo($_SESSION['admin']['id']);
                                    ?>
                                    <div class="row mb-lg-3 mb-2 align-items-center ">
                                        <label for="loginName" class="col-lg-4 text-lg-end mb-2 fw-semibold">Tên đăng nhập</label>
                                        <div class="col-lg-8 p-0">
                                            <input type="text" class="form-control" id="loginName" name="loginName" value="<?=$adminProfile['user_loginName']?>" disabled/>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-3 align-items-center">
                                        <label for="email" class="col-lg-4 text-lg-end mb-2 fw-semibold">Email</label>
                                        <div class="col-lg-8 p-0">
                                            <input type="email" class="form-control" id="email" name="userEmail" value="<?=$adminProfile['user_email']?>" disabled/>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-2 align-items-center">
                                        <label for="userName" class="col-lg-4 text-lg-end mb-2 fw-semibold">Tên</label>
                                        <div class="col-lg-8 p-0">
                                            <input type="text" class="form-control bg-light " id="userName" name="userName" value="<?=$adminProfile['user_name']?>" />
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-add rounded-2 fw-bold rounded-1" name="btnEditProfile" data-bs-target="#modal__updateAccount" data-bs-toggle="modal">
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
            </form>
            
        </div>
    </div>
</main>

