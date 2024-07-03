<div class="d-flex align-items-center " style="min-height: 650px;">
<!-- ForgotPassword box -->
        <div id="forgot-password" class="container-fluid w-1400 my-4 d-flex justify-content-center" >
            <div class="row w-100 justify-content-center p-3">
                <div class="border border-1 rounded-2 p-4" style="max-width: 460px">
                    <h1 class="text-center mb-3 text__main-color">Quên mật khẩu</h1>
                    <?php
                        if (isset($_SESSION['notice__forgotPassword'])) {
                            $state = $_SESSION['notice__forgotPassword']['state'];
                            $msg = $_SESSION['notice__forgotPassword']['msg'];
                            echo 
                                '
                                    <div class="alert alert-'.$state.' text-center p-2 mb-1" role="alert">
                                        '.$msg.'
                                    </div>
                                ';
                            unset($_SESSION['notice__forgotPassword']);
                        }
                    ?>
                    <form id="forgot-password" method="POST">
                        <div class="mb-4 position-relative">
                            <label for="email" class="form-label fw-semibold mb-1">Email</label>
                            <input type="email" class="form-control rounded-1 " id="email" name="email"/>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn bg__main-color fw-bold text-white rounded-1 " type="submit" name="sendToEmailBtn">Gửi mật khẩu mới tới email</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center mt-3">
                        <p class="mb-0">hoặc <a href="index.php?act=login" class="text-decoration-none fw-semibold">Đăng nhập</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Login box -->
</div>