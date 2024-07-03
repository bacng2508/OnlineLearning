<!-- Profile -->
        <div class="container-fluid w-1400 my-5" id="profile">
            <div class="row px-3">
                 <!-- Profile: Sidebar -->
                <?php include_once "Views/layouts/profile-sidebar.php" ?>
                <!-- Profile: Sidebar -->

                <!-- Profile: Change password -->
                <div class="col-lg-9 col-12 px-lg-5">
                    <h1 class="mt-4 mt-lg-0 mb-3">Đổi mật khẩu</h1>
                    <div class="container">
                        <div class="row ">
                            <form method="POST" id="changePasswordForm">
                                <?php
                                    if (isset($_SESSION['notice__changePassword'])) {
                                        $state = $_SESSION['notice__changePassword']['state'];
                                        $msg = $_SESSION['notice__changePassword']['msg'];
                                        echo 
                                            '
                                                <div class="alert alert-'.$state.' text-center p-2 mb-3" role="alert">
                                                    '.$msg.'
                                                </div>
                                            ';
                                        unset($_SESSION['notice__changePassword']);
                                    }
                                ?>
                                <div class="row mb-lg-3 mb-2 ">
                                        <label for="oldPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold align-self-center ">Mật khẩu cũ</label>
                                        <div class="col-lg-8 mb-2 position-relative">
                                            <input type="password" class="form-control" id="oldPassword" name="oldPassword"/>
                                            <div class="form-text oldPassword-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-2">
                                        <label for="newPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold align-self-center">Mật khẩu mới</label>
                                        <div class="col-lg-8 mb-2 position-relative">
                                            <input type="password" class="form-control" id="newPassword" name="newPassword"/>
                                            <div class="form-text newPassword-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                                        </div>
                                    </div>
                                    <div class="row mb-lg-3 mb-3">
                                        <label for="confirmNewPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold align-self-center">Xác nhận mật khẩu mới</label>
                                        <div class="col-lg-8 mb-2 position-relative">
                                            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword"/>
                                            <div class="form-text confirmNewPassword-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" id="changePasswordBtn" name="changePasswordBtn" class="btn bg__main-color rounded-0 text-light fw-bold rounded-1">
                                            Đổi mật khẩu
                                        </button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Profile: Change password -->
            </div>
        </div>
        <!-- Profile -->
