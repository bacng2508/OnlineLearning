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
                        <h1 class="text-center my-3">Thêm danh mục</h1>
                        <form class="border p-4 rounded" action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_SESSION['notice__insertCategory'])) {
                                    $state = $_SESSION['notice__insertCategory']['state'];
                                    $msg = $_SESSION['notice__insertCategory']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-2 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__insertCategory']);
                                }
                            ?>
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Tên danh mục</label>
                                <input type="text" class="form-control bg-white" id="category_name" name="category_name" value="<?php if (isset($_POST['category_name'])) echo $_POST['category_name'];?>"/>
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Thêm danh mục" name="insertCategoryBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

