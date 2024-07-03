<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Chi tiết đơn hàng</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row px-3">
                    <div class="d-flex justify-content-end align-items-center mb-2 pe-0">
                        <a href="index.php?act=listOrder" class="btn btn-warning text-white"><i class="fa-solid fa-chevron-left me-2"></i>Quay lại danh sách đơn hàng</a>
                    </div>
                    <div class="col-8 h-auto ps-0">
                        <table class="table table-hover table-bordered rounded-2 " id="sampleTable">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">STT</th>
                                    <th class="text-center" width="25%">Hình ảnh</th>
                                    <th class="text-center">Tên khóa học</th>
                                    <th class="text-center" width="20%">Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 1;
                                    foreach($orderItems as $item) {
                                        ?>
                                            <tr>
                                                <td class="text-center align-middle "><?= $count++ ?></td>
                                                <td class="text-center align-middle ">
                                                    <img src="../Public/images/imgCourse/<?= $item['course_image'] ?>"
                                                        alt="" width="120px;" style="margin-right: 8px;">
                                                </td>
                                                <td class="text-center align-middle">
                                                    
                                                    <?= $item['course_name'] ?>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="">
                                                        <?php if ($item["course_price_sale"] != 0) { ?>
                                                            <p class="fw-bold text-danger fs-5 mb-1"><?=format_currency($item['course_price_sale'])?></p>
                                                            <p class="text-decoration-line-through text-secondary mb-1" style="font-size: 14px;"><?=format_currency($item['course_price'])?></p>
                                                        <?php } else { ?>
                                                            <p class=""><?=format_currency($item['course_price'])?></p>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-4 border p-3 rounded-1" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;  align-self:flex-start;">
                        <div class="d-flex justify-content-between border-bottom ">
                            <h3>Mã đơn hàng</h3>
                            <p class="fw-bold fs-5"><?=$orderInfor['order_code']?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="fw-normal mb-0 ">Tổng tiền</h5>
                            <p class="mb-0" style="font-size: 16px;"><?=format_currency($orderTotalMoney)?></p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="fw-normal mb-0">Phương thức thanh toán</h5>
                            <img src="../Public/images/Payment/payment_vnpay.png" width="70px;" />
                            <!-- <p style="font-size: 16px;">VNPAY</p> -->
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <h5 class="fw-normal mb-0">Trạng thái</h5>
                            <?php
                                if ($orderInfor['order_status'] == 1) {
                                    echo "<p class='fw-bold text-success mb-0' style='font-size: 16px;'>Thành công</p>";
                                }
                                
                                if ($orderInfor['order_status'] == 0) {
                                    echo "<p class='fw-bold text-danger mb-0' style='font-size: 16px;'>Hủy</p>";
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
