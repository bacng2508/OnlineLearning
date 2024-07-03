<div class="col-lg-3 col-12 border border-secondary px-0 rounded-1" id="account__side-bar">
    <div class="d-flex px-3 pt-3 mb-4">
        <div>
            <img class="rounded-2" src="Public/images/Avatar/<?php if ($userInfo['user_avatar']) echo $userInfo['user_avatar']; else echo 'avatar_default.png';  ?>" alt="" style="max-width: 80px" />
        </div>
        <div class="px-3 align-self-center">
            <span>Tài khoản của</span>
            <span class="d-block fw-bold fs-5"><?=$_SESSION['clientLogin']['username']?></span>
        </div>
    </div>
    <div class="list-group">
        <a href="index.php?act=profile-infor" class="list-group-item list-group-item-action rounded-0 border-start-0 border-end-0 <?php if ($_GET['act']=='account-profile') echo 'active__list-item'; ?> " aria-current="true">
            <div class="d-inline-block text-end me-2" style="width: 25px">
                <i class="fa-solid fa-user fa-lg"></i>
            </div>
            <span>Thông tin tài khoản</span>
        </a>
        <a href="index.php?act=profile-changePassword" class="list-group-item list-group-item-action border-start-0 border-end-0 <?php if ($_GET['act']=='account-changePassword') echo 'active__list-item'; ?>">
            <div class="d-inline-block text-end me-2" style="width: 25px">
                <i class="fa-solid fa-key fa-lg"></i>
            </div>
            <span>Đổi mật khẩu</span>
        </a>
        <a href="index.php?act=profile-paymentHistory" class="list-group-item list-group-item-action border-start-0 border-end-0 rounded-0 <?php if ($_GET['act']=='account-historyPayment') echo 'active__list-item'; ?>">
            <div class="d-inline-block text-end me-2" style="width: 25px">
                <i class="fa-solid fa-clock-rotate-left fa-lg"></i>
            </div>
            <span>Lịch sử thanh toán</span>
        </a>
    </div>
</div>