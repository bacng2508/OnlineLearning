<div class="d-flex align-items-center " style="min-height: 650px;">
<!-- Signup box -->
        <div id="signup-box" class="container-fluid w-1400 my-4 d-flex justify-content-center" >
            <div class="row w-100 justify-content-center p-3">
                <div class="border border-1 rounded-2 p-4" style="max-width: 460px">
                    <h1 class="text__main-color text-center mb-3 ">Đăng ký</h1>
                    <?php
                        if (isset($_SESSION['notice__signUp'])) {
                            $state = $_SESSION['notice__signUp']['state'];
                            $msg = $_SESSION['notice__signUp']['msg'];
                            echo 
                                '
                                    <div class="alert alert-'.$state.' text-center p-2 mb-1" role="alert">
                                        '.$msg.'
                                    </div>
                                ';
                            unset($_SESSION['notice__signUp']);
                        }
                    ?>
                    <form id="signup-form" method="POST" action="">
                        <div class="mb-3 position-relative ">
                            <label for="loginName" class="form-label fw-semibold  mb-1">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="loginName" name="loginName" value="<?php if (isset($_POST['loginName'])) echo $_POST['loginName'];?>"/>
                            <div class="form-text loginName-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                        </div>
                        <div class="mb-3 position-relative ">
                            <label for="username" class="form-label fw-semibold  mb-1">Họ tên</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php if (isset($_POST['username'])) echo $_POST['username'];?>"/>
                            <div class="form-text username-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;" ></div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="email" class="form-label fw-semibold mb-1">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"/>
                            <div class="form-text email-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;" ></div>
                        </div>
                        <div class="mb-3 position-relative">
                            <label for="exampleInputPassword1" class="form-label fw-semibold mb-1">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                            <div class="form-text password-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                        </div>
                        <div class="mb-4 position-relative">
                            <label for="passwordConfirm" class="form-label fw-semibold mb-1">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"/>
                            <div class="form-text repassword-notice position-absolute ms-2" style="bottom: -18px; font-size: 11px;"></div>
                        </div>
                        <!-- <div class="mb-3">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="accepted-terms"/>
                            <label class="form-check-label" for="exampleCheck1">Tôi đồng ý với những <a href="#" class="text-decoration-none">điều khoản sử dụng</a> </label>
                            
                        </div> -->
                        <div class="d-grid gap-2">
                            <button class="btn bg__main-color fw-bold text-white pointer" type="submit" name="signUpBtn" id="signUpBtn">Đăng ký</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-end  my-2">
                        <p class="mb-0 text-center">Bạn đã có tài khoản? <a href="index.php?act=login" class="text-decoration-none fw-semibold ">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Signup box -->
</div>