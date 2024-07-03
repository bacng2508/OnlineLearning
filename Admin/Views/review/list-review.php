<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Danh sách đánh giá</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?act=deleteManyReview" method="POST" id="deleteAllSelectedForm">
                <div class="tile">
                    <?php
                    if (isset($_SESSION['notice__reviewAction'])) {
                        $state = $_SESSION['notice__reviewAction']['state'];
                        $msg = $_SESSION['notice__reviewAction']['msg'];
                        echo 
                            '
                            <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                '.$msg.'
                            </div>
                            ';
                        unset($_SESSION['notice__reviewAction']);
                    }
                    ?>
                    <div class="d-flex justify-content-between align-items-center mb-2 ">
                        <div>
                            <?php
                                if ($_SESSION['admin']['role'] == 1) {
                                    ?>
                                        <input type="button" class="btn btn-primary btn-sm trash" id="deleteAllSelectedBtn" name="deleteSelectedCourseBtn" value="Xóa các mục đã chọn">
                                    <?php
                                }
                            ?>
                            
                        </div>
                        <!-- <a href="index.php?act=add-course" class="btn btn-primary"><i class="fa-solid fa-plus me-2" ></i>Thêm khóa học</a> -->
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10">
                                        <input type="checkbox" onchange="checkAll(this)" id="all" />
                                    </th>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tên khóa học</th>
                                    <th class="text-center">Đánh giá</th>
                                    <th class="text-center">Nội dung</th>
                                    <th class="text-center">Tên người dùng</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($listReview as $key => $review) {
                                        ?>
                                            <tr>
                                                <td class="text-center" width="10">
                                                    <input type="checkbox" name="checkbox[]" value="<?=$review['review_id']?>" />
                                                </td>
                                                <td class="text-center">
                                                    <?=$key+1?>
                                                </td>
                                                <td class="text-center">
                                                    <?=$review['course_name']?>
                                                </td>
                                                <td class="text-center">
                                                    <?php for ($i = 0; $i < $review['review_rate']; $i++) { ?>
                                                        <i class="fa-solid fa-star text-warning"></i>
                                                    <?php } ?>
                                                </td>
                                                <td class="text-center">
                                                    <?=$review['review_content']?>
                                                </td>
                                                <td class="text-center">
                                                    <?=$review['user_name']?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                        if ($_SESSION['admin']['role'] == 1) {
                                                            ?>
                                                                <a href="index.php?act=deleteReview&reviewId=<?=$review['review_id']?>" class="btn btn-primary btn-sm trash deleteItem" type="button" title="Xóa">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            <?php
                                                        }
                                                    ?>   
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
    var deleteAllSelectedForm = document.getElementById('deleteAllSelectedForm');
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
