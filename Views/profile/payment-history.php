<!-- Profile -->
<div class="container-fluid w-1400 my-5" id="profile">
            <div class="row px-3">
                <!-- Profile: Sidebar -->
                <?php include_once "Views/layouts/profile-sidebar.php" ?>
                <!-- Profile: Sidebar -->

                <!-- Profile: Payment history -->
                <div class="col-lg-9 col-12 px-lg-5">
                    <h1 class="mb-3 mt-4 mt-lg-0">Lịch sử thanh toán</h1>
                    <div class="container">
                        <div class="row">
                            <div class="overflow-auto">
                                <table class="table table-hover align-middle text-center" style="min-width: 585px">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">STT</th>
                                            <th scope="col" class="text-center">Mã đơn hàng</th>
                                            <th scope="col" class="text-center">Ngày mua</th>
                                            <th scope="col" class="text-center">Thành tiền</th>
                                            <th scope="col" class="text-center">Trạng thái</th>
                                            <th scope="col" class="text-center" width="15%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach($orderList as $order) : ?>
                                        <tr>
                                            <th scope="row" class="text-center"><?=$count++;?></th>
                                            <td class="text-center"><?=$order['order_code']?></td>
                                            <td class="text-center"><?=date( "h:i:s d/m/Y", strtotime($order['created_at']))?></td>
                                            <td class="fw-bold text-danger text-center">
                                                <?=format_currency($order['total_money'])?>
                                            </td>
                                            <td class="text-success text-center fw-bold">
                                                <?php 
                                                    if ($order['order_status'] == 0) {
                                                        echo "Chưa thanh toán";
                                                    } else if ($order['order_status'] == 1) {
                                                        echo "Thành công";
                                                    } else if ($order['order_status'] == 2) {
                                                        echo "Hủy";
                                                    } else {
                                                        echo "Thanh toán không thành công";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="index.php?act=profile-orderDetail&orderId=<?=$order['id']?>" class="btn btn-warning rounded-1 py-1 fw-medium text-white  ">Xem chi tiết</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Profile: Payment history -->
            </div>
        </div>
        <!-- End: Profile -->