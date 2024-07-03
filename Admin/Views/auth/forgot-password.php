<!DOCTYPE html>
<html lang="vi">

<head>
    <title>Đăng nhập quản trị | Website quản trị</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" href="./Views/css/util.css">
    <link rel="stylesheet" type="text/css" href="./Views/css/style.css"> -->
    <link rel="stylesheet" type="text/css" href="../Public/css/admin/util.css">
    <link rel="stylesheet" type="text/css" href="../Public/css/admin/style.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../Public/css/css_bootstrap.min.css" />
    <script src="../Public/js/js_bootstrap.bundle.min.js" defer></script>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="../Public/images/team.jpg" alt="IMG">
                </div>

                <div class="login100-form validate-form">
                    <span class="login100-form-title">
                        <b>Quên mật khẩu</b>
                    </span>

                    <form action="" method="post">
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" placeholder="Email" name="email" id="email" required>
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-user'></i>
                            </span>
                        </div>
                        <div class="wrap-input100">
                            <?php
                                if (isset($_SESSION['notice__adminForgotPassword'])) {
                                    $state = $_SESSION['notice__adminForgotPassword']['state'];
                                    $msg = $_SESSION['notice__adminForgotPassword']['msg'];
                                    echo 
                                        '
                                        <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                            '.$msg.'
                                        </div>
                                        ';
                                    unset($_SESSION['notice__adminForgotPassword']);
                                }
                            ?>
                        </div>

                        <div class="container-login100-form-btn pt-0 " >
                            <input type="submit" value="Gửi mật khẩu mới" name="forgotPasswordBtn" id="forgotPasswordBtn" />
                        </div>
                        <hr class="my-3">
                        <div class="text-center text-decoration-none">
                            <a href="index.php?act=login">Đăng nhập</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
    
