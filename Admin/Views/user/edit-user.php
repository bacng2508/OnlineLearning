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
                        <h1 class="text-center my-3">Cập nhật thông tin người dùng</h1>
                        <form class="border p-4 rounded" action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_SESSION['notice__editUser'])) {
                                    $state = $_SESSION['notice__editUser']['state'];
                                    $msg = $_SESSION['notice__editUser']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__editUser']);
                                }
                            ?>
                            
                            <div class="mb-3">
                                <label for="chapter_order" class="form-label">Vai trò người dùng</label>
                                <select class="form-select" aria-label="Default select example" name="user_role" disabled>
                                    <option selected value="0">Chọn vai trò user</option>
                                        <?php
                                            if ($_SESSION['admin']['role'] == 1) {
                                                ?>
                                                    <option value="1" <?=($userToEdit['roles']==1)?"selected":FALSE;?> >SuperAdmin</option> 
                                                    <option value="2" <?=($userToEdit['roles']==2)?"selected":FALSE;?> >Admin</option> 
                                                <?php
                                            }
                                        ?>
                                        <option value="3" <?=($userToEdit['roles']==3)?"selected":FALSE;?> >Customer</option> 
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control bg-grey" id="loginName" name="loginName" value="<?=$userToEdit['user_loginName']?>" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Email</label>
                                <input type="gmail" class="form-control bg-grey" id="user_email" name="user_email" value="<?=$userToEdit['user_email']?>" disabled />
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Họ tên</label>
                                <input type="text" class="form-control bg-white" id="user_name" name="user_name" value="<?=$userToEdit['user_name']?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="chapter_name" class="form-label">Ảnh đại diện</label>
                                <input type="file" class="form-control bg-white" id="user_avatar" name="user_avatar"/>
                                <img src="../Public/images/Avatar/<?=$userToEdit['user_avatar']?>" class="p-3" style="width: 300px;" alt="">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Cập nhật thông tin" name="editUserBtn" />
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

