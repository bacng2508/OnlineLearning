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
                        <h1 class="text-center my-3">Cập nhật danh mục</h1>
                        <form class="border p-4 rounded" action="" method="POST">
                            <?php
                                if (isset($_SESSION['notice__editCategory'])) {
                                    $state = $_SESSION['notice__editCategory']['state'];
                                    $msg = $_SESSION['notice__editCategory']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-2 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__editCategory']);
                                }
                            ?>
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control bg-white" id="category_name" name="category_name" value="<?=$category['category_name']?>"/>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="cập nhật danh mục" name="editCategoryBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>