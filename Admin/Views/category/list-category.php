<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Danh sách danh mục</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?act=deleteManyCategory" method="POST" id="deleteAllSelectedForm">
                <div class="tile">
                    <?php
                        if (isset($_SESSION['notice__categoryAction'])) {
                            $state = $_SESSION['notice__categoryAction']['state'];
                            $msg = $_SESSION['notice__categoryAction']['msg'];
                            echo 
                                '
                                <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                    '.$msg.'
                                </div>
                                ';
                            unset($_SESSION['notice__categoryAction']);
                        }
                    ?>
                    <div class="d-flex justify-content-between align-items-center mb-2 ">
                        <div>
                            <?php
                                if ($_SESSION['admin']['role'] == 1) {
                                    ?>
                                        <input type="button" class="btn btn-primary btn-sm trash" id="deleteAllSelectedBtn" name="deleteSelectedCategoryBtn" value="Xóa các mục đã chọn">
                                    <?php
                                }
                            ?> 
                        </div>
                        <a href="index.php?act=addCategory" class="btn btn-primary"><i class="fa-solid fa-plus me-2" ></i>Thêm danh mục</a>
                    </div>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th width="10">
                                        <input type="checkbox" onchange="checkAll(this)" id="all" />
                                    </th>
                                    <th class="text-center">STT</th>
                                    <th class="text-center">Tên danh mục</th>
                                    <th class="text-center">Tổng số khóa học</th>
                                    <th class="text-center">Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach ($listCategory as $key => $category) {
                                        ?>
                                            <tr>
                                                <td class="text-center" width="10">
                                                    <input type="checkbox" name="checkbox[]" value="<?=$category['category_id']?>" />
                                                </td>
                                                <td class="text-center">
                                                    <?=$key+1?>
                                                </td>
                                                <td class="text-center">
                                                    <?=$category['category_name']?>
                                                </td>
                                                <td class="text-center">
                                                    <?=totalCourseInCategory($category['category_id'])?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                        if ($category['category_status'] == 1) {
                                                            ?>
                                                                <a href="index.php?act=hideCategory&categoryId=<?=$category['category_id']?>" class="btn btn-warning btn-sm haha" type="button" title="Ẩn" id="show-emp" data-toggle="" data-target=""><i class="fas fa-eye"></i></a>
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <a href="index.php?act=showCategory&categoryId=<?=$category['category_id']?>" class="btn btn-warning btn-sm haha" type="button" title="Ẩn" id="show-emp" data-toggle="" data-target=""><i class="fas fa-eye-slash"></i></a>
                                                            <?php
                                                        }
                                                    ?>

                                                    <a href="index.php?act=editCategory&categoryId=<?=$category['category_id']?>" class="btn btn-primary btn-sm edit" type="button">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <?php
                                                        if ($_SESSION['admin']['role'] == 1) {
                                                            ?>
                                                                <a href="index.php?act=deleteCategory&categoryId=<?=$category['category_id']?>" class="btn btn-primary btn-sm trash deleteItem" type="button" title="Xóa">
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
    // Using SweetAlert
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
