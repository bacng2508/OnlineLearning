<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Danh sách đơn hàng</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <?php
                        if (isset($_SESSION['notice__orderAction'])) {
                            $state = $_SESSION['notice__orderAction']['state'];
                            $msg = $_SESSION['notice__orderAction']['msg'];
                            echo 
                                '
                                    <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 mb-2" role="alert">
                                        '.$msg.'
                                    </div>
                                ';
                            unset($_SESSION['notice__orderAction']);
                        }
                    ?>
                    <!-- <div class="d-flex justify-content-end align-items-center mb-2 ">
                        <a href="index.php?act=addOrder" class="btn btn-add"><i class="fa-solid fa-plus me-2" ></i>Thêm đơn hàng</a>
                    </div> -->
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead style="vertical-align: middle;">
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Mã đơn hàng</th>
                                <th class="text-center">Tên khách hàng</th>
                                <th class="text-center">Tổng tiền</th>
                                <th class="text-center">Thời gian mua</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center" width="15%">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $count = 1;
                                foreach($listOrder as $order) {
                                    ?>
                                        <tr>
                                            <td class="text-center"  style="vertical-align: middle;"><?=$count++;?></td>
                                            <td class="text-center"  style="vertical-align: middle;"><?=$order['order_code']?></td>
                                            <td class="text-center"  style="vertical-align: middle;"><?=$order['user_name']?></td>
                                            <td class="text-center"  style="vertical-align: middle;"><?=format_currency($order['total_money'])?></td>
                                            <td class="text-center"  style="vertical-align: middle;"><?=format_timestamp($order['created_at'])?></td>
                                            <td class="text-center"  style="vertical-align: middle;">
                                                <?php 
                                                    switch ($order['order_status']) {
                                                        case 0:
                                                            echo "<span class='text-danger fw-bold'>Hủy</span>";
                                                            break;
                                                        case 1:
                                                            echo "<span class='text-success fw-bold'>Thành công</span>";
                                                            break;
                                                        case 2:
                                                            echo "<span class='text-warning fw-bold'>Thành công</span>";
                                                            echo "Chờ";
                                                            break;
                                                        default:
                                                            break;
                                                    }
                                                ?>
                                                <!-- <form action="index.php?act=changeOrderStatus&orderId=<?=$order['id']?>&userId=<?=$order['id']?>" method="post">
                                                    <select class="form-select changeOrderStatus" aria-label="Default select example" name="order_status">
                                                        <option class="text-center" value="0" <?=($order['order_status']==0)?"selected":FALSE;?> >Hủy</option> 
                                                        <option class="text-center" value="1" <?=($order['order_status']==1)?"selected":FALSE;?> >Thành công</option> 
                                                        <option class="text-center" value="2" <?=($order['order_status']==2)?"selected":FALSE;?> >Chờ</option> 
                                                    </select>
                                                </form> -->
                                            </td>
                                            <td class="text-center">
                                                <a href="index.php?act=orderDetail&orderId=<?=$order['id']?>" class="btn btn-warning text-white">Chi tiết đơn hàng</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    var deleteItemBtn = document.querySelectorAll('.deleteItem');
    deleteItemBtn.forEach((element) => {
        element.addEventListener('click', (event) => {
            if (!confirm('Bạn có muốn xóa người dùng này không?')) {
                event.preventDefault();
            }
        })
    });

    var changeOrderStatusList = document.querySelectorAll('.changeOrderStatus');
    changeOrderStatusList.forEach( (selectBox) => {
      selectBox.addEventListener('change', (item) => {
        selectBox.parentElement.submit();
      });
    });
</script>
