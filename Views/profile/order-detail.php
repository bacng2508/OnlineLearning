<!-- Profile -->
<div class="container-fluid w-1400 my-5" id="profile">
            <div class="row px-3">
                <!-- Profile: Sidebar -->
                <?php include_once "Views/layouts/profile-sidebar.php" ?>
                <!-- Profile: Sidebar -->

                <!-- Profile: Payment history -->
                <div class="col-lg-9 col-12 px-lg-5">
                    
                    <div class="mb-2 d-flex justify-content-between ">
                        <h3 class="mb-1 mt-4 mt-lg-0">Chi tiết đơn hàng: <?=$orderCode?></h3>
                        <div class="d-flex align-items-center ">
                            <a class="btn btn-warning fw-medium rounded-1 text-white" href="index.php?act=profile-paymentHistory">
                            Quay lại lịch sử đơn hàng <i class="fa-solid fa-angle-right"></i>
                        </a>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="overflow-auto">
                                <table class="table table-hover align-middle text-center" style="min-width: 585px">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center" width="10%">
                                                STT
                                            </th>
                                            <th scope="col" class="text-center">Khóa học</th>
                                            <th scope="col" class="text-center">Giá tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; ?>
                                        <?php foreach($orderItems as $item) : ?>
                                            <tr>
                                                <td scope="row" class="text-center" >
                                                    <?=$count++;?>
                                                </td>
                                                <td>
                                                    <div class="ms-3 d-flex align-items-center ">
                                                        <img src="Public/images/imgCourse/<?=$item['course_image']?>" class="" alt="error"  width="120px" height="68px">
                                                        <h6 class="ms-3 fw-normal "><?=$item['course_name']?></h6>
                                                    </div>
                                                </td>
                                                <td class=""><?=format_currency($item['course_price'])?></td>
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