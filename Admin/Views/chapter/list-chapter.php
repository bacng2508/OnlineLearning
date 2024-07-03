<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b>Danh sách chương học</b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form action="index.php?act=deleteManyChapter" method="POST" id="deleteAllSelectedForm">
            <div class="tile">
                <?php
                    if (isset($_SESSION['notice__chapterAction'])) {
                        $state = $_SESSION['notice__chapterAction']['state'];
                        $msg = $_SESSION['notice__chapterAction']['msg'];
                        echo 
                            '
                                <div class="'.$state.' rounded-2  text-center p-2 mb-3 w-100 " role="alert">
                                    '.$msg.'
                                </div>
                            ';
                        unset($_SESSION['notice__chapterAction']);
                    }
                ?>
                <div class="d-flex justify-content-between align-items-center mb-2 ">
                    <div>
                        <?php
                            if ($_SESSION['admin']['role'] == 1) {
                                ?>
                                    <input type="button" class="btn btn-primary btn-sm trash" id="deleteAllSelectedBtn" name="deleteSelectedChapterBtn" value="Xóa các mục đã chọn">
                                <?php
                            }
                        ?>
                        
                    </div>
                    <a href="index.php?act=addChapter" class="btn btn-primary"><i class="fa-solid fa-plus me-2" ></i>Thêm chương học</a>
                </div>
                <div class="tile-body">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th width="10">
                                    <input type="checkbox" onchange="checkAll(this)" id="all" />
                                </th>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tên chương học</th>
                                <th class="text-center">Thứ tự</th>
                                <th class="text-center">Tổng số bài học</th>
                                <th class="text-center">Khóa học thuộc về</th>
                                <th class="text-center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $count = 1;
                                foreach ($listChapters as $chapter) {
                                    ?>
                                        <tr>
                                            <td class="text-center" width="10">
                                                <input type="checkbox" name="checkbox[]" value="<?=$chapter['chapter_id']?>" />
                                            </td>
                                            <td class="text-center">
                                                <?=$count++?>
                                            </td>
                                            <td class="text-center">
                                                <?=$chapter['chapter_name']?>
                                            </td>
                                            <td class="text-center">
                                                <?=$chapter['chapter_order']?>
                                            </td>
                                            <td class="text-center">
                                                <?=totalLessonsInChapter($chapter['chapter_id'])?>
                                            </td>
                                            <td class="text-center">
                                                <?=getCourseName($chapter['course_id'])?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($chapter['chapter_status'] == 1) {
                                                        ?>
                                                            <a href="index.php?act=hideChapter&chapterId=<?=$chapter['chapter_id']?>" class="btn btn-warning btn-sm haha" type="button" title="Ẩn" id="show-emp" data-toggle="" data-target=""><i class="fas fa-eye"></i></a>
                                                        <?php
                                                    } else {
                                                        ?>
                                                            <a href="index.php?act=showChapter&chapterId=<?=$chapter['chapter_id']?>" class="btn btn-warning btn-sm haha" type="button" title="Ẩn" id="show-emp" data-toggle="" data-target=""><i class="fas fa-eye-slash"></i></a>
                                                        <?php
                                                    }
                                                ?>

                                                <a href="index.php?act=editChapter&chapterId=<?=$chapter['chapter_id']?>" class="btn btn-primary btn-sm edit" type="button">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <?php
                                                    if ($_SESSION['admin']['role'] == 1) {
                                                        ?>
                                                            <a href="index.php?act=deleteChapter&chapterId=<?=$chapter['chapter_id']?>" class="btn btn-primary btn-sm trash deleteItem" type="button" title="Xóa">
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
    deleteAllSelectedBtn.addEventListener('click', (event) => {
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
