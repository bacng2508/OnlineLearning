<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Danh sách slider</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?act=deleteManySlider" method="POST" id="deleteAllSelectedForm">
            <div class="tile">
                <?php
                if (isset($_SESSION['notice__sliderAction'])) {
                    $state = $_SESSION['notice__sliderAction']['state'];
                    $msg = $_SESSION['notice__sliderAction']['msg'];
                    echo 
                        '
                        <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                            '.$msg.'
                        </div>
                        ';
                    unset($_SESSION['notice__sliderAction']);
                }
                ?>
                <div class="d-flex justify-content-between align-items-center mb-2 ">
                    <div>
                        <input type="button" class="btn btn-primary btn-sm trash" id="deleteAllSelectedBtn" name="deleteSelectedSliderBtn" value="Xóa các mục đã chọn">
                    </div>
                    <div>
                        <a href="index.php?act=addSlider" class="btn btn-primary"><i class="fa-solid fa-plus me-2" ></i>Thêm slider</a>
                        <!-- <a href="index.php?act=addSlider" class="btn btn-primary btn-add">Sắp xếp thứ tự</a> -->
                    </div>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10">
                                    <input type="checkbox" onchange="checkAll(this)" id="all" />
                                </th>
                                <th class="text-center">STT</th>
                                <th class="text-center">Hình ảnh</th>
                                <th class="text-center">Số thứ tự</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach ($listSlider as $key => $slider) {
                                    ?>
                                        <tr>
                                            <td class="text-center align-middle" width="10">
                                                <input type="checkbox" name="checkbox[]" value="<?=$slider['slider_id']?>" />
                                            </td>
                                            <td class="text-center align-middle">
                                                <?=$key+1?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <img src="../Public/images/sliders/<?=$slider['slider_img']?>" alt="" height="150px;">
                                            </td>
                                            <td class="text-center align-middle">
                                                <?=$slider['slider_order']?>
                                            </td>
                                            <td class="text-center align-middle">
                                                <?php 
                                                    if ($slider['slider_status'] == 1) {
                                                        ?>
                                                            <a href="index.php?act=hideSlider&sliderId=<?=$slider['slider_id']?>" class="btn btn-warning btn-sm haha" type="button"><i class="fas fa-eye"></i></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a href="index.php?act=showSlider&sliderId=<?=$slider['slider_id']?>" class="btn btn-warning btn-sm haha" type="button"><i class="fas fa-eye-slash"></i></a>
                                                        <?php
                                                    }
                                                ?>
                                                <a href="index.php?act=editSlider&sliderId=<?=$slider['slider_id']?>" class="btn btn-primary btn-sm edit" type="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="index.php?act=deleteSlider&sliderId=<?=$slider['slider_id']?>" class="btn btn-primary btn-sm trash deleteItem" type="button" title="Xóa">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                                
                                                
                                            </td>
                                        </tr>
                                    <?php
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </form>
            
        </div>
    </div>
</main>



<script type="text/javascript">
    var checkboxes = document.querySelectorAll("input[type='checkbox']");

    function checkAll(myCheckbox) {
        if (myCheckbox.checked == true) {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = true;
            });
        } else {
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
        }
    }

    var deleteItemBtn = document.querySelectorAll('.deleteItem');
    deleteItemBtn.forEach((element) => {
        element.addEventListener('click', (e) => {
            e.preventDefault();
            var urlToReDirect = e.currentTarget.getAttribute('href');
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy bỏ"
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = urlToReDirect;
                }
            });
        })
    })

    var deleteAllSelectedBtn = document.querySelector('#deleteAllSelectedBtn');
    deleteAllSelectedBtn.addEventListener('click', (e) => {
        Swal.fire({
            title: "Bạn có chắc chắn muốn xóa các mục đã chọn không?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Đồng ý",
            cancelButtonText: "Hủy bỏ"
            }).then((result) => {
            if (result.isConfirmed) {
                deleteAllSelectedForm.submit();
            }
        });
    })

</script>
