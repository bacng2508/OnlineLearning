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
                        <h1 class="text-center my-3">Thêm khóa học</h1>
                        <form class="border p-4 rounded" action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_SESSION['notice__insertCourse'])) {
                                    $state = $_SESSION['notice__insertCourse']['state'];
                                    $msg = $_SESSION['notice__insertCourse']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__insertCourse']);
                                }
                            ?>
                            <div class="form-group">
                                <label for="course_category">Danh mục</label>
                                <select class="form-select" aria-label="Default select example" name="category_id">
                                    <option selected value="0">Chọn danh mục khóa học</option>
                                    <?php foreach($listCategory as $category) :?>
                                        <option value="<?=$category['category_id']?>"><?=$category['category_name']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Tên khóa học</label>
                                <input type="text" class="form-control bg-white" id="course_name" name="course_name" value="<?php if (isset($_POST['course_name'])) echo $_POST['course_name'];?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="course_image" class="form-label">Chọn hình ảnh</label>
                                <input class="form-control h-100 py-2" type="file" id="course_image" name="course_image"/>
                            </div>
                            <div class="mb-3">
                                <label for="course_price" class="form-label">Giá</label>
                                <input type="number" class="form-control bg-white" id="course_price" name="course_price" value="<?php if (isset($_POST['course_price'])) echo $_POST['course_price'];?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="course_price_sale" class="form-label">Giá khuyến mãi</label>
                                <input type="number" class="form-control bg-white" id="course_price_sale" name="course_price_sale" value="<?php if (isset($_POST['course_price_sale'])) echo $_POST['course_price_sale'];?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="course_content" class="form-label">Nội dung khóa học(Những nội dung cách nhau bở dấu ";")</label>
                                <textarea class="form-control bg-white " id="course_content" name="course_content" rows="2"><?=(isset($_POST['course_content']))?ltrim($_POST['course_content'], ""):FALSE?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="course_require" class="form-label">Yêu cầu khóa học(Những yêu cầu cách nhau bởi dấu ";")</label>
                                <textarea class="form-control bg-white " id="course_require" name="course_require" rows="2"><?=(isset($_POST['course_require']))?ltrim($_POST['course_require'], ""):FALSE?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="course_desc" class="form-label">Mô tả khóa học</label>
                                <textarea class="form-control bg-white " id="course_desc" name="course_desc" rows="8"><?=(isset($_POST['course_desc']))?ltrim($_POST['course_desc'], ""):FALSE?></textarea>
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Thêm khóa học" name="insertCourseBtn" />
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

