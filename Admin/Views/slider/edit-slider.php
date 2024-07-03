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
                        <h1 class="text-center my-3">Chỉnh sửa slider</h1>
                        <form class="border p-4 rounded" action="" method="POST" enctype="multipart/form-data">
                            <?php
                                if (isset($_SESSION['notice__editSlider'])) {
                                    $state = $_SESSION['notice__editSlider']['state'];
                                    $msg = $_SESSION['notice__editSlider']['msg'];
                                    echo 
                                        '
                                            <div class="'.$state.' rounded-2  text-center p-2 mb-1 w-100 " role="alert">
                                                '.$msg.'
                                            </div>
                                        ';
                                    unset($_SESSION['notice__editSlider']);
                                }
                            ?>
                            
                            <div class="mb-3">
                                <label for="slider_order" class="form-label">Thứ tự của Slider chỉnh sửa</label>
                                <input type="number" class="form-control bg-white" id="slider_order" name="slider_order" value="<?=$sliderToEdit['slider_order']?>"/>
                            </div>
                            <div class="mb-3">
                                <label for="slider_img" class="form-label">Slider</label>
                                <input type="file" class="form-control bg-white" id="slider_img" name="slider_img"/>
                                <?php
                                    if (isset($_FILES['slider_img']['name'])) {
                                        echo '<pre>';
                                        print_r($_FILES['slider_img']['name']);
                                        echo '</pre>';
                                    }
                                ?>
                                <img src="../Public/images/sliders/<?=$sliderToEdit['slider_img']?>" class="p-3" height="200px" alt="">
                            </div>

                            <div class="form-group d-flex justify-content-end">
                                <input class="btn btn-primary " type="submit" value="Cập nhật slider" name="editSliderBtn" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

