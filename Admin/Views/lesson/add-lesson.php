<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active">
                <a href="#"><b></b></a>
            </li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="add-product">
                        <h1 class="text-center my-3">Thêm bài học</h1>
                        <form class="border p-4 rounded" action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_SESSION['notice__insertLesson'])) {
                                    $state = $_SESSION['notice__insertLesson']['state'];
                                    $msg = $_SESSION['notice__insertLesson']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__insertLesson']);
                                }
                            ?>
                            <div class="form-group">
                                <label for="course_id">Thêm bài học vào khóa học</label>
                                <select class="form-select" aria-label="Default select example" name="course_id" id="courseSelect">
                                    <option selected value="0">Chọn khóa học</option>
                                    <?php
                                        foreach ($listCourse as $course) {
                                            ?>
                                                <option value="<?=$course['course_id']?>" 
                                                <?php
                                                    echo $course['course_id'];
                                                ?>
                                                >
                                                    <?=$course['course_name']?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_id" class="form-label">Thêm bài học vào chương</label>
                                <select class="form-select" aria-label="Default select example" name="chapter_id" id="selectChapter">
                                    <option selected value="0">Chọn chương học</option>
                                    
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Thứ tự bài học</label>
                                <input type="text" class="form-control bg-white" id="lesson_order" name="lesson_order" value="<?php if (isset($_POST['lesson_order'])) echo $_POST['lesson_order'];?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Tên bài học</label>
                                <input type="text" class="form-control bg-white" id="lesson_name" name="lesson_name" value="<?php if (isset($_POST['lesson_name'])) echo $_POST['lesson_name'];?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Video bài học</label>
                                <input type="file" class="form-control bg-white" id="lesson_video" name="lesson_video"/>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Thêm bài học" name="insertLessonBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!--
  MODAL
-->
<div class="modal fade" id="ModalUP" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <span class="thong-tin-thanh-toan">
                            <h5>Chỉnh sửa thông tin sản phẩm cơ bản</h5>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label">ID khoá học</label>
                        <input class="form-control" type="number" value="71309005" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Tên khóa học</label>
                        <input class="form-control" type="text" required value="Bàn ăn gỗ Theresa" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Ảnh</label>
                        <input class="form-control" type="file" required value="20" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleSelect1" class="control-label">Danh mục</label>
                        <select class="form-control" id="exampleSelect1">
                            <option>Backend</option>
                            <option>Frontend</option>
                            <option>Devops</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Giá Sales</label>
                        <input class="form-control" type="text" value="4.000.000" />
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label">Giá bán</label>
                        <input class="form-control" type="text" value="2.600.000" />
                    </div>
                </div>
                <BR />
                <BR />
                <BR />
                <button class="btn btn-save" type="button">Lưu lại</button>
                <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
                <BR />
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
<!--
MODAL
-->

<script>
    const courseSelect = document.getElementById('courseSelect');
    // const chapterSelect = document.getElementById('chapterSelect');
    courseSelect.addEventListener('change', (e) => {
        courseSelected = e.target.value;
        // console.log(courseSelected);

        if (courseSelected != "0") {
            $.ajax({
                url: "Models/Ajax/getChapterByCourse.php",
                method: "POST",
                data: {courseId:courseSelected},
                success: function(data) {
                    $("#selectChapter").html(data);
                }
            });
        } 
    });
    console.log(1);
</script>

