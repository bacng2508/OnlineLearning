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
                <h2 class="text-center mb-3">Đổi mật khẩu</h2>
                <?php
                    if (isset($_SESSION['notice__adminChangePassword'])) {
                        $state = $_SESSION['notice__adminChangePassword']['state'];
                        $msg = $_SESSION['notice__adminChangePassword']['msg'];
                        echo 
                            '
                            <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                '.$msg.'
                            </div>
                            ';
                        unset($_SESSION['notice__adminChangePassword']);
                    }
                ?>

                <div class="">
                    <div class="container">
                        <div class="row ">
                            <form method="POST" action="">
                                <div class="row mb-2 align-items-center ">
                                    <label for="oldPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold ">Mật khẩu cũ</label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control bg-light" id="oldPassword" name="oldPassword" />
                                    </div>
                                </div>
                                <div class="row mb-2 align-items-center">
                                    <label for="newPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold">Mật khẩu mới</label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control bg-light" id="newPassword" name="newPassword" />
                                    </div>
                                </div>
                                <div class="row mb-3 align-items-center">
                                    <label for="confirmNewPassword" class="col-lg-4 text-lg-end mb-2 fw-semibold">Xác nhận mật khẩu mới</label>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control bg-light" id="confirmNewPassword" name="confirmNewPassword"/>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary " name="changeAdminPasswordBtn" data-bs-target="#modal__updateAccount" data-bs-toggle="modal">
                                        Đổi mật khẩu
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Profile: Account infor -->
                
            </div>
            </form>
            
        </div>
    </div>
</main>

