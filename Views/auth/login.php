<!-- Login box -->
        <div class="d-flex align-items-center " style="min-height: 650px;">
            <div id="login-box" class="container-fluid w-1400 my-4 d-flex justify-content-center">
            <div class="row w-100 justify-content-center p-3">
                <div class="border border-1 rounded-2 p-4" style="max-width: 460px">
                    <h1 class="text-center mb-3 text__main-color">Đăng nhập</h1>
                    <?php
                        if (isset($_SESSION['notice__login'])) {
                            $state = $_SESSION['notice__login']['state'];
                            $msg = $_SESSION['notice__login']['msg'];
                            echo 
                                '
                                    <div class="alert alert-'.$state.' text-center p-2 mb-1" role="alert">
                                        '.$msg.'
                                    </div>
                                ';
                            unset($_SESSION['notice__login']);
                        }
                    ?>
                    <form id="login-form" method="POST">
                        <div class="mb-3 position-relative">
                            <label for="loginName" class="form-label fw-semibold mb-1">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="loginName" name="loginName" value="<?php if (isset($_POST['loginName'])) echo $_POST['loginName'];?>"/>
                        </div>
                        <div class="mb-2 position-relative">
                            <label for="password" class="form-label fw-semibold mb-1">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password"/>
                        </div>
                        <div class="mb-2 form-check d-flex justify-content-end">
                            <!-- <div>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                                <label class="form-check-label" for="exampleCheck1" name="remember-login">Ghi nhớ đăng nhập</label>
                            </div> -->
                            <a href="index.php?act=forgot-password" class="text-decoration-none">Quên mật khẩu</a>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn bg__main-color fw-bold text-white" type="submit" name="loginBtn" id="loginBtn">Đăng nhập</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p class="mb-0">Bạn chưa có tài khoản? <a href="index.php?act=sign-up" class="text-decoration-none fw-semibold ">Đăng ký</a></p>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Login box -->