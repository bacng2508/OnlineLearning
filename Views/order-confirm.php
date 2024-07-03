<div class="container-fluid w-1400 my-5" id="relative-course" style="min-height: 600px;">
    <h1 class="mb-4 ps-2 ps-lg-0">Xác nhận đơn hàng</h1>
    <!-- Row 1 -->
    <div class="row p-3 rounded-1 mx-2 mx-lg-0" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
        <div class="col-12 col-lg-8 mb-lg-0 mb-5 mb-lg-0 overflow-hidden px-3">
            <h4>Thông tin đơn hàng</h4>

            <div class="overflow-x-auto">
                <table class="table align-middle mt-3" style="min-width: 700px">
                    <thead class="text-center">
                        <tr>
                            <th scope="col" width="5%">
                                STT
                            </th>
                            <th scope="col">Khóa học</th>
                            <th scope="col">Giá tiền</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="cartItemContainer">
                        <?php
                            $totalMoney = 0;
                            $count = 1;
                        ?>
                        <?php foreach($itemsInCart as $item) : ?>
                        <tr>
                            <td scope="row" class="text-center" >
                                <?=$count++;?>
                            </td>
                            <td>
                                <div class="ms-5 d-flex align-items-center ">
                                    <img src="Public/images/imgCourse/<?=$item['course_image']?>" class="" alt="error"  width="120px" height="68px">
                                    <h6 class="ms-3 fw-normal "><?=$item['course_name']?></h6>
                                </div>
                            </td>
                            <td class="">
                                <div class="d-flex flex-column ">
                                    <?php if ($item["course_price_sale"] != 0) { ?>
                                        <span class="fw-bold text-danger fs-5"><?=format_currency($item['course_price_sale'])?></span>
                                        <span class="text-decoration-line-through text-secondary " style="font-size: 14px;"><?=format_currency($item['course_price'])?></span>
                                    <?php } else { ?>
                                        <span class=""><?=format_currency($item['course_price'])?></span>
                                    <?php } ?>
                                </div>
                            </td>
                            <?php
                                $totalMoney = 0;
                                if ($itemsInCart > 0) {
                                    foreach ($itemsInCart as $item) {
                                        if ($item['course_price_sale'] != 0) {
                                            $totalMoney+=$item['course_price_sale'];
                                        } else {
                                            $totalMoney+=$item['course_price'];
                                        }
                                    }
                                }
                            ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12 col-lg-4 p-3 border rounded-2">
            <div>
                <h4 class="">Thành tiền</h4>
                <p class="text-end fs-4 fw-bold text-danger"><?=format_currency($totalMoney)?></p>
            </div>
            <hr class="container">
            <div>
                <h4>Phương thức thanh toán</h4>
                <form action="index.php?act=payment" class="py-3" method="POST">
                    <div class="form-check ms-3 mb-2">
                        <input class="form-check-input" type="radio" name="payment_method" id="vnpay" value="vnpay" checked>
                        <label class="form-check-label" for="vnpay" style="cursor: pointer">
                            Ví điện tử VNPAY/VNPAY QR
                            <img src="Public/images/Payment/payment_vnpay.png" alt="" width="80px;" >
                        </label>
                    </div>
                    <div class="mt-4">
                        <input type="submit" class="btn btn-danger fw-bold  rounded-1 w-100" value="Thanh toán">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>