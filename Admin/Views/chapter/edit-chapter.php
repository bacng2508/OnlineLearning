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
                        <h1 class="text-center my-3">Cập nhật chương học</h1>
                        <form class="border p-4 rounded" action="" method="POST">
                            <?php
                                if (isset($_SESSION['notice__editChapter'])) {
                                    $state = $_SESSION['notice__editChapter']['state'];
                                    $msg = $_SESSION['notice__editChapter']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__editChapter']);
                                }
                            ?>
                            <div class="mb-3">
                                <label for="chapter_order" class="form-label">Thứ tự của chương học</label>
                                <input type="number" class="form-control bg-white" id="chapter_order" name="chapter_order" 
                                    value=
                                    "<?php
                                        echo $chapterToEdit['chapter_order'];
                                    ?>"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Tên chương học</label>
                                <input type="text" class="form-control bg-white" id="chapter_name" name="chapter_name" 
                                    value=
                                    "<?php
                                        echo $chapterToEdit['chapter_name']; 
                                    ?>"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="course_desc" class="form-label">Mô tả chương học</label>
                                <textarea class="form-control bg-white " id="chapter_desc" name="chapter_desc" rows="5"
                                ><?php 
                                    echo $chapterToEdit['chapter_desc']; 
                                ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="course_price" class="form-label">Khóa học thuộc về</label>
                                <select class="form-select" aria-label="Default select example" name="course_id">
                                    <option selected value="0">Chọn khóa học thuộc về</option>
                                    <?php
                                        foreach ($listCourses as $course) {
                                            ?>
                                                <option value="<?=$course['course_id']?>" 
                                                <?php
                                                    echo ($chapterToEdit['course_id']==$course['course_id'])?"selected":false;
                                                ?>
                                                >
                                                    <?=$course['course_name']?>
                                                </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Cập nhật chương học" name="editChapterBtn" />
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

