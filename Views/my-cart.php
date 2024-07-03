<!-- Cart -->
    <main class="container-fluid w-1400 my-3" style="min-height: 650px;">
        <div class="row mt-4 overflow-hidden mx-3 mx-lg-0">
            <h3 class="my-2">Giỏ hàng của tôi</h3>
            <div class="col-12 col-lg-9 mb-3 overflow-x-auto mx-3 mx-lg-0" >
                    <table class="table align-middle mt-3" style="min-width: 700px">
                        <thead class="text-center">
                            <tr>
                                <th scope="col" width="10%">STT</th>
                                <th scope="col">Khóa học</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody class="text-center" id="cartItemContainer">  
                            <?php $count = 1;?>
                            <?php foreach($itemsInCart as $item) : ?> 
                                <tr>
                                    <td scope="row" class="text-center" >
                                        <?=$count++?>
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
                                    <td>
                                        <button class="btn btn-danger deleteCartItemBtn rounded-1" type="button" data-id="<?=$item['course_id']?>">Xóa</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <!-- </form> -->
                <?php if (!sizeof($itemsInCart)) { ?>
                    <h4 class="text-center mt-4 fw-normal ">Không có khóa học nào trong giỏ hàng</h4>
                <?php } ?>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <h5 class="card-header">Tổng</h5>
                    <div class="card-body text-end p-0">
                        <h5 class="card-title my-3 text-end text-danger px-3" id="totalMoney"><?=format_currency($totalMoney)?></h5>
                        <?php if (sizeof($itemsInCart)) { ?>
                            <a href="index.php?act=order-confirm" class="btn btn-warning rounded-1 text-white mt-1 w-100 rounded-1 fw-medium">Thanh toán giỏ hàng</a>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Cart -->
    <script>
        const deleteCartItemBtns = document.querySelectorAll('.deleteCartItemBtn');
        const cartItemContainer = document.querySelector('#cartItemContainer');
        const quantityIncart = document.querySelector('#quantityIncart');
        const quantityInCartMobile = document.querySelector('#quantityInCart_mobile');
        const totalMoney = document.getElementById('totalMoney');

        // for (let element of deleteCartItemBtns) {
        deleteCartItemBtns.forEach((element) => {
            element.addEventListener('click', (e) => {
                $.ajax({
                    url: "Models/Ajax/deleteCartItem.php",
                    method: "POST",
                    data: {
                        courseId: e.target.dataset.id,
                        clientId: <?=$_SESSION['clientLogin']['id']?>,

                    },
                    dataType: "json",
                    success: function(data) {
                        element.parentElement.parentElement.remove();
                        quantityIncart.textContent = `${data.quantityInCart}`;
                        quantityInCartMobile.textContent = `${data.quantityInCart}`;
                        let moneyFormatted = formatCash(`${data.totalMoney}`);
                        totalMoney.textContent = `${moneyFormatted} đ`;
                    }
                });
            });
        }) 
    </script>