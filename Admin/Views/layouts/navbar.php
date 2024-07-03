<!-- Navbar-->
<header class="app-header py-2 px-4">
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <!-- <li>
            <a class="app-nav__item" href="/index.html"><i class="bx bx-log-out bx-rotate-180"></i> </a>
        </li> -->
    </ul>

    <div class="login d-flex flex-wrap align-content-center text-white">
        <i class="fa-regular fa-circle-user fa-xl p-2 ms-1 pointer p-2" style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false">
        </i>
        <!-- Dropdown box -->
        <div class="dropdown-menu p-0 rounded-0 mt-2 me-2">
            <div class="card">
                <div class="card-body p-0">
                    <div class="d-flex bg-body-secondary p-3">
                        <div class="d-flex align-items-center">
                            <img class="rounded-circle" src="../Public/images/Avatar/<?php
                                if (isset($_SESSION['admin']['user_avatar'])) {
                                    echo $_SESSION['admin']['user_avatar'];
                                } else {
                                    echo "avatar_default.png";
                                }
                                ?>
                            " width="40px" alt="" />
                        </div>
                        <div class="ps-3">
                            <h5 class="mb-1"><?=$_SESSION['admin']['user_name']?></h5>
                            <!-- <p class="mb-0" style="font-size: 14px">namnguyen@gmail.com</p> -->
                        </div>
                    </div>
                    <div class="list-group">
                        <a href="index.php?act=editProfileAdmin" class="list-group-item list-group-item-action border-0 p-2">
                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </div>
                            <span>Chỉnh sửa hồ sơ</span>
                        </a>
                        <a href="index.php?act=changePasswordAdmin" class="list-group-item list-group-item-action border-0 p-2">
                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                <i class="fa-solid fa-key"></i>
                            </div>
                            <span>Đổi mật khẩu</span>
                        </a>
                        <a href="index.php?act=logout" class="list-group-item list-group-item-action rounded-0 border-0 p-2">
                            <div class="d-inline-block text-end me-2" style="width: 25px">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </div>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dropdown box -->
    </div>
</header>
